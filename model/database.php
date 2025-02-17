<?php
class Database extends PDO
{
    private $logEnabled = true;
    private $user;

    public function __construct($dsn, $username = null, $password = null, $options = array())
    {
        parent::__construct($dsn, $username, $password, $options);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->user = $username; // Suponiendo que el nombre de usuario de la base de datos es el usuario que realiza las consultas.
    }

    public function prepare($statement, $options = array())
    {
        $stmt = parent::prepare($statement, is_array($options) ? $options : array());
        return new LoggedPDOStatement($stmt, $this);
    }

    public function log($query, $params, $oldData = null, $newData = null, $queryType = null)
    {
        if ($this->logEnabled) {
            $sql = "INSERT INTO logs (query, user, estado, old_data, new_data, query_type) VALUES (:query, :user, :estado, :old_data, :new_data, :query_type)";
            $stmt = parent::prepare($sql);
            $stmt->execute([
                ':query' => $query,
                ':user' => $this->user,
                ':estado' => 1, // Suponiendo que el estado es 1 para éxito. Ajusta según tus necesidades.
                ':old_data' => json_encode($oldData),
                ':new_data' => json_encode($params),
                ':query_type' => $queryType
            ]);
        }
    }
}

class LoggedPDOStatement
{
    private $statement;
    private $database;

    public function __construct(PDOStatement $statement, Database $database)
    {
        $this->statement = $statement;
        $this->database = $database;
    }

    public function execute($params = null)
    {
        $query = $this->statement->queryString;
        $queryType = $this->getQueryType($query);

        // Omitir el registro si la consulta es un SELECT
        if ($queryType !== 'SELECT') {
            // Obtener datos antiguos si es una actualización o eliminación
            $oldData = null;
            if ($queryType === 'UPDATE' || $queryType === 'DELETE') {
                $oldData = $this->getOldData($query, $params);
            }

            $this->database->log($query, $params, $oldData, $params, $queryType);
        }

        return $this->statement->execute($params);
    }

    private function getOldData($query, $params)
    {
        // Lógica para obtener los datos antiguos antes de la actualización o eliminación
        // Este es un ejemplo simplificado y puede requerir ajustes según tus necesidades
        if (stripos($query, 'UPDATE') === 0 || stripos($query, 'DELETE') === 0) {
            // Extraer la tabla y la condición WHERE del query
            // Este es un ejemplo simplificado y puede requerir ajustes según tus necesidades
            if (preg_match('/FROM\s+(\S+)/i', $query, $matches)) {
                $table = $matches[1];

                if (preg_match('/WHERE\s+(.+)/i', $query, $matches)) {
                    $condition = $matches[1];

                    $selectQuery = "SELECT * FROM $table WHERE $condition";
                    $selectStmt = $this->database->prepare($selectQuery);
                    $selectStmt->execute($params);
                    return $selectStmt->fetch(PDO::FETCH_ASSOC);
                }
            }
        }

        return null;
    }

    private function getQueryType($query)
    {
        if (stripos($query, 'INSERT') === 0) {
            return 'INSERT';
        } elseif (stripos($query, 'UPDATE') === 0) {
            return 'UPDATE';
        } elseif (stripos($query, 'DELETE') === 0) {
            return 'DELETE';
        } elseif (stripos($query, 'SELECT') === 0) {
            return 'SELECT';
        }
        return 'OTHER';
    }

    // Proxy other PDOStatement methods
    public function __call($method, $args)
    {
        return call_user_func_array([$this->statement, $method], $args);
    }
}





