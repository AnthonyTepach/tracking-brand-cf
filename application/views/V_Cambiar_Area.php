<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siguiente área</title>
    <?php include APPPATH.'views/header.php';?>
</head>
<body >
<?php include APPPATH.'views/body.php';?>
    <div class="container">
    <hr>
    <?php if ($consulta->num_rows()==0) { ?>
        <div class="alert alert-warning" role="alert">
              <?php
                $area= $this->uri->segment(2);
                $areaCo="";
                if($area =="limpieza"){
                    $area ="recepcion";
                    $areaCo="No han completado la recepción de ningún automóvil";
                }else if($area =="instalacion"){
                    $area ="limpieza";
                    $areaCo="No han terminado la limpieza de ningún automóvil";
                }else if($area =="inspeccion"){
                    $area ="instalacion";
                    $areaCo="No han terminado la instalación de vinil en ningún automóvil";
                }
            ?>
             <?=$areaCo?> 
        </div>
    <?php } else{?>
        <?=form_open_multipart(base_url('C_Auto/UpdateStatus/').$this->uri->segment(2),'id="f_detalles"')?>
        <div class="row">
            <div class="col-sm">
                <!---->
                <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="placas_auto">Placas auto</label>
                </div>
                <select class="custom-select" id="placas_auto" name="placas_auto">
                    <option selected>selecciona una opcion...</option>
                <?php  foreach($consulta -> result() as $row){ ?>
                    <option value="<?=$row -> placas_auto?>"><?=$row -> placas_auto?></option>
                <?php } ?>
                </select>
                </div>
                <!---->
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm">
                <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="operador_encargado"><i class="fas fa-user-friends"></i></span>
                </div>
                <input type="text" name="operador_encargado" class="form-control" placeholder="Operador" aria-label="operador_encargado" aria-describedby="operador_encargado">
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm">
                <!---->
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Detalles/Observaciones</span>
                    </div>
                    <textarea class="form-control" aria-label="Detalles" name="detalles_obs"></textarea>
                </div>
                <!---->
            </div>
            </div>

        <div class="row">
            <div class="col-sm">
            
            <button id="enviar" class="btn btn-primary" type="button">
            Terminar <?=$this->uri->segment(2)?> y tomar evidencia  
                    <i class="fas fa-arrow-right"></i>
        </button>

            </div>
        </div>
        <?=form_close()?>
    <?php } ?>
        
    
    
    
    </div>
    <script type="text/javascript">

  $(document).ready(function() {
    $("#enviar").prop("disabled", true);
    //Siempre que salgamos de un campo de texto, se chequeará esta función
    $("#f_detalles input").keyup(function() {
        var form = $(this).parents("#f_detalles");
        var check = checkCampos(form);
        if(check) {
            $("#enviar").prop("disabled", false);
        }
        else {
            $("#enviar").prop("disabled", true);
        }
    });
});
//Función para comprobar los campos de texto
function checkCampos(obj) {
    var camposRellenados = true;
    obj.find("input").each(function() {
    var $this = $(this);
        if( $this.val().length <= 0 ) {
            camposRellenados = false;
            return false;
        }
    });
    if(camposRellenados == false) {
        return false;
    }
    else {
        return true;
    }
}
$('#enviar').click(function(){
    form =$("#f_detalles").serialize();
      //alert(form);
      $("#f_detalles").submit();    
             
});
    </script>


   
</body>
</html>