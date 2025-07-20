<?php

function generate_modal($name, $content, $size, $id, $hiddeValues, $form, $type) {

    $dataSize[1] = "modal-xl";
    $dataSize[2] = "modal-lg";
    $dataSize[3] = "modal-sm";

    
?>

<div id="<?=  $id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog <?= $dataSize[$size]; ?>">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title mt-0" id="myModalLabel"><?=  $name; ?></h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form class="needs-validation" id="<?= $form; ?>">
                    <?php foreach ($hiddeValues as $data) { ?>
                        <input type="hidden" value="" id="<?= $data; ?>">
                    <?php } ?>

				
					<div class="modal-body">
						<div class="row">
							<?php if($type == "edit"){  ?>
								<input type="hidden" value="" id="id">
							<?php } ?>	
                            <?php foreach ($content as $data) { 
                                
							if($data['type'] == "text" || $data['type'] == "password" || $data['type'] == "email" || $data['type'] == "number" || $data['type'] == "date"){
                            ?>
                            <div style="display: <?= $data['display']; ?>;" class="col-md-<?= $data['col']; ?>">
								<div class="mb-6">
									<label for="validationCustom01" class="form-label"><?= $data['name']; ?></label>
									<input  type="<?= $data['type']; ?>" class="form-control" id="<?= $data['id']; ?>" placeholder="<?= $data['name']; ?>" value="" <?= $data['required']; ?>>
								</div>
							</div>

                            <?php }else if($data['type'] == "select"){  ?>
                                <div style="display: <?= $data['display']; ?>;" class="col-md-<?= $data['col']; ?>">
								    <div class="mb-6">
									    <label for="validationCustom01" class="form-label"><?= $data['name']; ?></label>
                                        <select  name="<?= $data['id']; ?>" class="form-control" id="<?= $data['id']; ?>" <?= $data['action']; ?>>
                                        </select>
                                    </div>
                                </div>
                 
							<?php }else if($data['type'] == "select_foraneal"){  
								
									$conect = 1;
								if($data['db'] == 1){

								}else{
									include '../model/' . $data['class'] . '.php';
								}
			
								$n_model = new $data['class']();
								$method = 'buscar_' . $data['class'];
								$values = $n_model->$method();
								?>
                                <div style="display: <?= $data['display']; ?>;" class="col-md-<?= $data['col']; ?>">
								    <div class="mb-6">
									    <label for="validationCustom01" class="form-label"><?= $data['name']; ?></label>
                                        <select  name="<?= $data['id']; ?>" class="form-control" id="<?= $data['id']; ?>" <?= $data['action']; ?>>
										<?php
										foreach ($values as $key) {
											?>
												<option value="<?php echo $key['id_'.$data['class']]; ?>"><?php echo $key[$data['cam_foraneal']]; ?></option>
											<?php
											}?>

										</select>
                                    </div>
                                </div>
                            <?php }  ?>
                         
                            <?php }  ?>
							
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Cerrar</button>
						<button type="submit" class="btn btn-primary waves-effect waves-light" >Guardar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>



<?php
}




?>
