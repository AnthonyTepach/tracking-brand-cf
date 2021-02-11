<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salida de automovil</title>
    <?php include APPPATH.'views/header.php';?>
</head>
<body>
<?php include APPPATH.'views/body.php';?>

<div class="container">
<hr>
<?php if ($consulta->num_rows()==0) { ?>
        <div class="tamanio bg-degradado" role="alert">
             No han terminado la inspección de ningún automóvil <img class="img-fluid" width="70px" src="<?=base_url('assets/recursos/camion.svg')?>" alt="vector-camion" srcset="">
        </div>
    <?php } else{?>
<?=form_open_multipart(base_url()."UpdateSalida",'id="f_salida_auto" oninput="gasolina_output.value=parseInt(gasolina_range.value)"')?>
    <div class="row">
        <div class="col-sm">
            <!---->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label id="input-group-text2" class="input-group-text" for="placas_auto">Placas auto</label>
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
             <!---->
             <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span id="input-group-text2" class="input-group-text" id="fecha_salida"><i class="far fa-calendar-alt"></i>  Fecha</span>
                    </div>
                    <input  type="text" id="datepicker" class="form-control" placeholder="Fecha salida" aria-label="fecha_salida" aria-describedby="fecha_salida" name="fecha_salida">
                    
                </div>
                <!---->
        </div>
        <div class="col-sm">
            <!---->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span id="input-group-text2" class="input-group-text" id="kilometraje_fins"> Kilometraje</span>
                </div>
                <input type="text" id="solo_num_km" class="form-control" placeholder="Kilometraje salida" aria-label="color_auto" aria-describedby="kilometraje_fin" name="kilometraje_fin">
            </div>
            <!---->
        </div>
        <div class="col-sm">
            <!---->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span id="input-group-text2" class="input-group-text" id="gasolina_ini"> Gasolina</span>
                </div>
                <input type="range" placeholder="Gasolina Entrada" name="gasolina_fin" id="gasolina_range">
                <span class="badge badge-primary"><output name="gasolina_output" for="gasolina_range" ></output></span>
                                
                </div>

                
            <!---->
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
        <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span id="input-group-text2" class="input-group-text" id="operador_encargado"><i class="fas fa-user-friends"></i></span>
                </div>
                <input id="input-red" type="text" name="operador_encargado" class="form-control" placeholder="Operador" aria-label="operador_encargado" aria-describedby="operador_encargado">
                </div>
        </div>

        
    </div>
    <div class="row">
    <div class="col-sm">
            <!---->
            <div class="input-group">
                    <div class="input-group-prepend">
                        <span id="input-group-text2" class="input-group-text">Detalles</span>
                    </div>
                    <textarea id="text-area-detalles" class="form-control" aria-label="Detalles" name="detalles_obs"></textarea>
                </div>
                <!---->
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-sm">
        <center><button id="enviar" class="btn btn-blanco" type="button">Dar Salida</button></center>
        </div>
    </div>
    <?=form_close()?>
</div><!--container-->
<script type="text/javascript">
$(document).ready(function() {
    $('#solo_num_km').keyup(function (){
        this.value = (this.value + '').replace(/[^0-9]/g, '');
      });

    $("#enviar").prop("disabled", true);
    //Siempre que salgamos de un campo de texto, se chequeará esta función
    $("#f_salida_auto input").keyup(function() {
        var form = $(this).parents("#f_salida_auto");
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
    form =$("#f_salida_auto").serialize();
      alert(form);
      $("#f_salida_auto").submit();           
});

</script>
<script type="text/javascript">
     $('#datepicker').datepicker({
        dateFormat: 'yy-mm-dd',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: '',
        weekHeader: 'Sm',
    });
   

    
</script>
<?php } ?>
</body>
</html>