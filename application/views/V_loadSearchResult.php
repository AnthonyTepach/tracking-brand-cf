<!-- Nav tabs -->
<ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home">Información General</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#historial">Historial</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#evidencia">Evidencia</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#coment">Comentarios</a>
                </li>
</ul>
<div class="tab-pane container active" id="home">
<?php foreach ($consulta->result() as $row) { ?>
    <div class="row">
        <div class="col-sm">
            <!-- Tab panes -->
            <div class="tab-content">
               
                    <div class="row">
                        <div class="col-sm">
                            <p><b> Conductor/Cliente: </b><span><?= $row->nombre_cli ?> <?= $row->apat_cli ?> <?= $row->amat_cli ?></span></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm">
                            <p><b> Correo Electronico: </b><span><a href="mailto:<?= $row->email_clie ?>"><?= $row->email_clie ?></a></span></p>
                        </div>
                        <div class="col-sm">
                            <p><b> Telefono: </b><span><a href="tel:+51<?= $row->tel_clie ?>"><?= $row->tel_clie ?></a></span></p>
                        </div>
                        <div class="col-sm">
                            <p><b> Fecha de ingreso: </b><span><?= $row->fecha_ingreso ?></span></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm">
                            <p><b>Placas: </b><span><?= $row->placas_auto ?></span></p>
                        </div>
                        <div class="col-sm">
                            <p><b>Tarjeta de circulación: </b><span><?= $row->num_tarjeta_circula ?></span></p>
                        </div>
                        <div class="col-sm">
                            <p><b>Tipo de auto: </b><span><?= $row->tipo_auto ?></span></p>
                        </div>
                        <div class="col-sm">
                            <p><b>Marca de auto: </b><span><?= $row->marca_auto ?></span></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm">

                        </div>
                        <?php if ($row->fecha_salida != null) { ?>
                            <div class="col-sm">
                                <p><b>Fecha de salida: </b><span><?= $row->fecha_salida ?></span></p>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <p><b>Detalles de ingreso: </b><span><?= $row->detalles_obs ?></span></p>
                        </div>
                        <?php
                        $porcentaje = "0%";
                        $hiden = "display:none;";

                        $status = $row->status_auto;
                        if ($status == "recepcion") {
                            $porcentaje = "20%";
                        } else if ($status == "limpieza") {
                            $porcentaje = "40%";
                        } else if ($status == "instalacion") {
                            $porcentaje = "60%";
                        } else if ($status == "inspeccion") {
                            $porcentaje = "80%";
                        } else if ($status == "Terminado") {
                            $porcentaje = "100%";
                        }
                        ?>

                    </div>
                    <center>
                        <div class="row">
                            <div class="col-sm">
                                <div class="border-red">
                                    <div class="progress"  style="height: 30px;">
                                        <div class="progress-bar bg-white progress-bar-s progress-bar-animated" role="progressbar" style="width: <?= $porcentaje ?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="status-span"><span class="status2">STATUS</span> <span class="status"><?= strtoupper($status) ?></span></span>
                                </div> 
                            </div>
                        </div>
                    </center>

                </div>
                <?php } //cierre de foreach ?> 
                <div class="tab-pane container fade" id="historial">

                

    <?php if ($consulta2->num_rows() == 0) {
        
    } else {

        foreach ($consulta2->result() as $row) {
            ?>
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">Se paso de <b><?= $row->area_terminada ?></b> a <b><?= $row->area_nueva ?></b></h5>
                                        <small><?= $row->fecha_hora_terminada ?></small>
                                    </div>
                                    <p class="mb-1"><?= $row->detalles_obs ?></p>
                                    <small><?= $row->operador_encargado ?></small>
                                </a>

                            </div>
        <?php }
    } //cierre de foreach2 ?> 
                </div>
                <div class="tab-pane container fade" id="evidencia">
                    <?php
                    if ($consulta3->num_rows() == 0) {
                        
                    } else {
                        echo '<hr class="my-4"> <h5 class="display-4">Evidencias</h5>';
                        echo'<ul class="list-unstyled">';
                        foreach ($consulta3->result() as $row) {
                            ?>

                            <li class="media">
                                <img src="<?= base_url($row->archivo_evidencia) ?>" style="width:50%;" class="mr-3 img-fluid" alt="<?= $row->tipo_evidencia ?>/<?= $row->area_evidencia ?>">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-1"><b>Tipo:</b> <?= $row->tipo_evidencia ?></h5>
                                    <b>Área: </b> <?= $row->area_evidencia ?>
                                </div>
                            </li>  


                        <?php }
                    } //cierre de foreach3?>  
                    <?php
                    if ($consulta4->num_rows() == 0) {
                        
                    } else {
                        echo "Firma recepción";
                        foreach ($consulta4->result() as $row) {
                            ?>
                            <img src="<?= base_url($row->ruta_firma) ?>" class="img-fluid" alt="Responsive image">
        <?php }
    } ?>
    <?php
    if ($consulta5->num_rows() == 0) {
        
    } else {
        echo "Firma terminado";
        foreach ($consulta5->result() as $row) {
            ?>
                            <img src="<?= base_url($row->ruta_firma) ?>" class="img-fluid" alt="Responsive image">
        <?php }
    } ?>
                </div>



			<div class="tab-pane container fade" id="coment">
				<div class="row">
					<div class="col-sm">
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span  id="input-group-text2" class="input-group-text centrado" id=""><i class="fas fa-user-friends"></i></span>
							</div>
							<input id="input-red" type="text" name="operador_encargado" class="form-control" placeholder="Nombre" aria-label="operador_encargado" aria-describedby="operador_encargado">
						</div>
					</div>
				</div>


				<div class="row">
					<div class="col-sm">
						<!---->
						<div class="input-group">
							<div class="input-group-prepend">
								<span id="input-group-text2" class="input-group-text">Comentarios</span>
							</div>
							<textarea  id="text-area-detalles" class="form-control" aria-label="Detalles" name="detalles_obs"></textarea>
						</div>
						<!---->
					</div>
				</div>
<br>
				<div class="row">
					<div class="col-sm centrado">
						<center>

							<button id="enviar"  class="btn btn-blanco " type="button">
								Comentar

							</button>
						</center>


					</div>
				</div>
			</div>










  




