<?php  foreach($consulta -> result() as $row){ ?>
<div class="row">
    <div class="col-sm">
    <div class="jumbotron">
        <h3 class="display-4">Información General</h3>
        <hr class="my-4">
            <div class="row">
                <div class="col-sm">
                <p><b><i class="fas fa-users"></i> Conductor/Cliente: </b><span><?=$row -> nombre_cli?> <?=$row -> apat_cli?> <?=$row -> amat_cli?></span></p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm">
                <p><b><i class="far fa-envelope"></i> Correo Electronico: </b><span><a href="mailto:<?=$row -> email_clie?>"><?=$row -> email_clie?></a></span></p>
                </div>
                <div class="col-sm">
                <p><b><i class="fas fa-mobile-alt"></i> Telefono: </b><span><a href="tel:+51<?=$row -> tel_clie?>"><?=$row -> tel_clie?></a></span></p>
                </div>
                <div class="col-sm">
                <p><b><i class="far fa-calendar-alt"></i> Fecha de ingreso: </b><span><?=$row -> fecha_ingreso?></span></p>
                </div>
            </div>
        <hr class="my-4">
            <div class="row">
                <div class="col-sm">
                    <p><b>Placas: </b><span><?=$row -> placas_auto?></span></p>
                </div>
                <div class="col-sm">
                    <p><b>Tarjeta de circulación: </b><span><?=$row -> num_tarjeta_circula?></span></p>
                </div>
                <div class="col-sm">
                    <p><b>Tipo de auto: </b><span><?=$row -> tipo_auto?></span></p>
                </div>
                <div class="col-sm">
                    <p><b>Marca de auto: </b><span><?=$row -> marca_auto?></span></p>
                </div>
            </div>
            <div class="row">
            <div class="col-sm">
                    <p><b>N° Economico: </b><span></span></p>
                </div>
                <?php if ($row -> fecha_salida != null){?>
                <div class="col-sm">
                    <p><b>Fecha de salida: </b><span><?=$row -> fecha_salida?></span></p>
                </div>
                <?php }?>
            </div>
            <div class="row">
                <div class="col-sm">
                <p><b>Detalles de ingreso: </b><span><?=$row -> detalles_obs?></span></p>
                </div>
            </div>
        


        <hr class="my-4">
        <h5 class="display-4">Status</h5>
        <?php
            $porcentaje="0%";
            $status= $row -> status_auto;
            if($status == "recepcion"){
                $porcentaje ="20%";
            }else if($status == "limpieza"){
                $porcentaje ="40%";
            }
            else if($status == "instalacion"){
                $porcentaje ="60%";
            }
            else if($status == "inspeccion"){
                $porcentaje ="80%";
            }else if($status == "Terminado"){
                $porcentaje ="100%";
            }
        ?>
        <div class="progress"  style="height: 50px;">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?=$porcentaje?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?=strtoupper($status)?></div>
        </div>
        <div class="progress" style="height: 50px;">
            <div class="progress-bar" role="progressbar" style="width: 20%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: 20%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
            <div class="progress-bar bg-info progress-bar-striped progress-bar-animated" role="progressbar" style="width: 20%"     aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
            <div class="progress-bar bg-warning  progress-bar-striped progress-bar-animated" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
            <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <?php } //cierre de foreach?>   
        
        
        <?php if ($consulta2->num_rows()==0) {}else{
            echo '<hr class="my-4"><h5 class="display-4">Historial</h5>';
             foreach($consulta2 -> result() as $row){ ?>
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">Se paso de <b><?= $row -> area_terminada?></b> a <b><?= $row -> area_nueva?></b></h5>
                        <small><?= $row -> fecha_hora_terminada?></small>
                        </div>
                        <p class="mb-1"><?= $row -> detalles_obs?></p>
                        <small><?= $row -> operador_encargado?></small>
                    </a>
                                        
                </div>
            <?php }} //cierre de foreach2?>  
            <?php 
            if ($consulta3->num_rows()==0) {

            }else{
                echo '<hr class="my-4"> <h5 class="display-4">Evidencias</h5>';
                echo'<ul class="list-unstyled">';
                foreach($consulta3 -> result() as $row){ ?>
                    
                        <li class="media">
                            <img src="<?=base_url($row -> archivo_evidencia)?>" style="width:50%;" class="mr-3 img-fluid" alt="<?=$row -> tipo_evidencia?>/<?=$row -> area_evidencia?>">
                            <div class="media-body">
                                <h5 class="mt-0 mb-1"><b>Tipo:</b> <?=$row -> tipo_evidencia?></h5>
                                <b>Área: </b> <?=$row -> area_evidencia?>
                            </div>
                        </li>  
                   
     
            <?php }} //cierre de foreach3?>  
            </ul>

            <div class="row">
            <div class="col-sm">
                Firma recepcion
                <?php
                foreach($consulta4 -> result() as $row){ ?>
                <img src="<?=base_url($row -> ruta_firma)?>" class="img-fluid" alt="Responsive image">
               <?php } ?>
            </div>
            <div class="col-sm">
                
                <?php
                if($consulta5->num_rows()==0){}else{
                echo "Firma terminado";
                foreach($consulta5 -> result() as $row){ ?>
                <img src="<?=base_url($row -> ruta_firma)?>" class="img-fluid" alt="Responsive image">
               <?php }} ?>
            </div>
        </div>
        </div>
      

    </div>
</div>