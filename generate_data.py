import os
import datetime
import importlib.util
import sys
import random
from faker import Faker

# Crear instancia de Faker
fake = Faker()

# Ruta donde se almacenan los archivos de esquema
ESQUEMA_DIR = "sql_date_generate"

# Función para generar datos ficticios
def generar_dato(tipo):
    if "int" in tipo:
        return str(random.randint(1, 1000))  # Convertimos a str para SQL
    elif "varchar" in tipo:
        longitud = int(tipo.split("(")[1].split(")")[0])
        return f"'{fake.text(max_nb_chars=longitud).strip().replace("'", "''")}'"  # Escapamos comillas
    elif "date" in tipo:
        return f"'{fake.date()}'"
    return "NULL"

# Función para generar SQL en un archivo
def generar_archivo_sql(tabla, tipos_datos, n_registros):
    # Crear carpeta 'migrates' si no existe
    if not os.path.exists("migrates"):
        os.makedirs("migrates")

    # Crear nombre del archivo con fecha
    fecha_actual = datetime.datetime.now().strftime("%Y%m%d_%H%M%S")
    nombre_archivo = f"migrates/{tabla}_{fecha_actual}.sql"

    with open(nombre_archivo, "w", encoding="utf-8") as archivo:
        archivo.write(f"-- 📂 Migración generada para la tabla `{tabla}` ({n_registros} registros)\n")
        archivo.write(f"-- 🕒 {datetime.datetime.now().strftime('%Y-%m-%d %H:%M:%S')}\n\n")

        for i in range(n_registros):
            valores = {campo: generar_dato(tipo) for campo, tipo in tipos_datos.items()}
            columnas = ", ".join(valores.keys())
            valores_str = ", ".join(valores.values())
            sql = f"INSERT INTO {tabla} ({columnas}) VALUES ({valores_str});\n"

            archivo.write(sql)

    print(f"✅ Archivo SQL generado: {nombre_archivo}")
    print(f"📂 Puedes ejecutarlo en MySQL con: `source {nombre_archivo};`")

# Pedir datos al usuario
tabla = input("Ingrese el nombre de la tabla (ej: usuarios, productos): ").strip()

# Construir la ruta del archivo en sql_date_generate
archivo_esquema = os.path.join(ESQUEMA_DIR, f"{tabla}.py")

try:
    print(f"🔎 Buscando archivo en '{ESQUEMA_DIR}/{tabla}.py'...")

    if not os.path.exists(archivo_esquema):
        raise FileNotFoundError(f"No se encontró el archivo '{archivo_esquema}'.")

    # Cargar módulo dinámicamente
    spec = importlib.util.spec_from_file_location(tabla, archivo_esquema)
    modulo = importlib.util.module_from_spec(spec)
    spec.loader.exec_module(modulo)

    print(f"✅ Archivo '{tabla}.py' encontrado en '{ESQUEMA_DIR}/'.")
    
    tipos_datos = modulo.tipos_datos
    print(f"📄 Esquema de la tabla '{tabla}': {tipos_datos}")

    n = int(input("Ingrese el número de registros a generar: "))

    if n <= 0:
        print("❌ El número de registros debe ser mayor que 0.")
        sys.exit()

    generar_archivo_sql(tabla, tipos_datos, n)

except FileNotFoundError as e:
    print(f"❌ {e}")
except ValueError:
    print("❌ Por favor, ingrese un número válido de registros.")
except Exception as e:
    print(f"❌ Error inesperado: {e}")
