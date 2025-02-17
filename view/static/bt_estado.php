<div class="square-switch">
   <input type="checkbox" id="square-switch<?php echo $key['id']; ?>" switch="info" <?php echo $st  ?> onclick="cambiar_estado(<?php echo $key['id'].','.$key['estado'] ?>)">
   <label for="square-switch<?php echo $key['id']; ?>" data-on-label="Activo" data-off-label="Inactivo"></label>
</div>