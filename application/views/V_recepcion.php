<!DOCTYPE html>
<html lang="ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tracking de Brandeo</title>
    <?php include APPPATH.'views/header.php';?>
    
</head>
<body >
<?php include APPPATH.'views/body.php';?>




<div class="container">
    <hr>
    <?=form_open_multipart(base_url()."nuevo_cliente",'id="f_clie"')?>
    
    <div class="row">
        <div class="col s12">
            <div class="row">
                <!-- usuario -->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="far fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Nombre(s)" aria-label="Nombre(s)" aria-describedby="basic-addon1" name="nombre_cli">
                </div>
                <!-- apat -->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon2">AP</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Apellido Paterno" aria-label="Apellido Paterno" aria-describedby="basic-addon2" name="apat_cli" >
                </div>
                <!-- amat -->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">AM</span>
                    </div>
                    <input type="text" class="form-control" placeholder="Apellido Materno" aria-label="Apellido Materno" aria-describedby="basic-addon3" name="amat_cli">
                </div>
                 <!-- email -->
                 <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon4"><i class="far fa-envelope"></i></span>
                    </div>
                    <input type="email" class="form-control" placeholder="Correo electronico" aria-label="Correo electronico" aria-describedby="basic-addon4" name="email_clie">
                </div>
                 <!-- telefono -->
                 <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon5"><i class="fas fa-phone-alt"></i></span>
                    </div>
                    <input type="tel" class="form-control" placeholder="Telefono de contacto" aria-label="Telefono de contacto" aria-describedby="basic-addon5" name="tel_clie">
                </div>
                    <button id="enviar" class="btn btn-primary" type="button">Siguiente 
                    <i class="fas fa-arrow-right"></i>
                    </button>
                
            </div>
            
        </div>
       
    </div>
    <?=form_close()?>

</div>
<script type="text/javascript">
$(document).ready(function() {
    $("#enviar").prop("disabled", true);
    //Siempre que salgamos de un campo de texto, se chequeará esta función
    $("#f_clie input").keyup(function() {
        var form = $(this).parents("#f_clie");
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
    form =$("#f_clie").serialize();
      alert(form);
      $("#f_clie").submit();           
});

</script>
</body>
</html>