<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include APPPATH.'views/header.php';?>
    <title>Auto</title>
</head>
<body >
<?php include APPPATH.'views/body.php';?>

    <img id="img-izq" src="<?=base_url('assets/recursos/carro-png.svg')?>" alt="imagen-carro" class="img-fluid">
    <div class="container">
    <div class="centrado">
        <h4 class="burbuja2">Registrar Automóvil</h4>
    </div>
        <?=form_open_multipart(base_url()."save_auto_cliente",'id="f_auto" oninput="gasolina_output.value=parseInt(gasolina_range.value)"')?>
            <div style="display:none">
                <input type="text" name="id_cliente" id="id_cliente" value="<?=$id_cliente?>">
            </div>
            <div class="row"><!--Row 1-->
                <div class="col-sm">
                    <!---->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span id="input-group-text2" class="input-group-text" id="basic-addon1"><i class="fas fa-car centrado"></i></span>
                        </div>
                        <input id="input-red" type="text" class="form-control" placeholder="Placas automovil" aria-label="Placas automovil" aria-describedby="basic-addon1" name="placas_auto">
                    </div>
                    <!---->
                </div>
                
                <div class="col-sm">
                    <!---->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span id="input-group-text2" class="input-group-text" id="modelo_auto"><i class="fas fa-car-side centrado"></i></span>
                        </div>
                        <input id="input-red" type="text" class="form-control" placeholder="Modelo" aria-label="modelo_auto" aria-describedby="modelo_auto" name="modelo_auto">
                    </div>
                    <!---->
                </div>
            </div><!--Fin Row 1-->

            <div class="row"><!--Row 2-->
                <div class="col-sm">
                    <!---->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span id="input-group-text2" class="input-group-text" id="num_tarjeta_circula"><i class="centrado fas fa-id-card"></i></span>
                        </div>
                        <input id="input-red" type="text" class="form-control" placeholder="N° Tarjeta de circulacion" aria-label="num_tarjeta_circula" aria-describedby="num_tarjeta_circula" name="num_tarjeta_circula">
                    </div>
                    <!---->
                </div>
                <div class="col-sm">
                    <!---->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span id="input-group-text2" class="input-group-text" id="color_auto"><i class="fas fa-tint centrado"></i></span>
                        </div>
                        <input id="input-red" type="text" class="form-control" placeholder="Color" aria-label="color_auto" aria-describedby="color_auto" name="color_auto">
                    </div>
                    <!---->
                </div>
                <div class="col-sm">
                    <!---->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span id="input-group-text2" class="input-group-text" id="fecha_ingresos"><i class="far fa-calendar-alt centrado"></i></span>
                        </div>
                        <input id="input-red" type="text" id="datepicker" class="form-control" placeholder="Fecha de entrada" aria-label="fecha_ingresos" aria-describedby="fecha_ingresos" name="fecha_ingreso">
                    </div>
                    <!---->
                </div>
            </div><!--fin row 2-->
            <div class="row"><!--row 3-->
                <div class="col-sm">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend centrado">
                            <span id="input-group-text2" class="input-group-text " for="tipo_auto">Tipo</span>
                        </div>
                        <select class="custom-select" id="tipo_auto" name="tipo_auto">
                            <option value="Sedan">Sedan</option>
                            <option value="Pick-up sencilla">Pick-up sencilla</option>
                            <option value="Pick-up Doble Cabina">Pick-up Doble Cabina</option>
                            <option value="Camioneta tipo SUV">Camioneta tipo SUV</option>
                            <option value="Camioneta para pasajeros">Camioneta para pasajeros</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm">
                    <!---->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span id="input-group-text2" class="input-group-text" id="kilometraje_ini">
                                 <i class="fas fa-sort-numeric-up centrado"></i>
                            </span>
                        </div>
                        <input id="input-red" type="text" class="form-control" placeholder="Kilometraje Entrada" aria-label="color_auto" aria-describedby="kilometraje_ini" name="kilometraje_ini">
                    </div>
                    <!---->
                </div>
                <div class="col-sm">
                    <!---->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span id="input-group-text2" class="input-group-text" id="kilometraje_ini"><i class="fas fa-sort-numeric-up"></i> Gasolina</span>
                        </div>
                        <span class="badge burbuja4">
                            <input  type="range" placeholder="Gasolina Entrada" name="gasolina_ini" id="gasolina_range">
                            <output name="gasolina_output" class="burbuja3"  for="gasolina_range" ></output>
                        </span>
                    </div>
                    <!---->
                </div>
            </div><!--fin row 3-->
            <div class="row"><!--row 4-->
                <div class="col-sm">
                     <!---->
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span id="input-group-text2" class="input-group-text">Detalles</span>
                        </div>
                        <textarea class="form-control" id="text-area-detalles" aria-label="Detalles" name="detalles_obs" rows="6"></textarea>
                    </div>
                    <!---->
                </div>
                
            </div>  <!--fin row 4-->
            <br>
                <div class="centrado">
                <button id="enviar" class="btn btn-blanco " type="button"> 
                        Resistrar 
                    </button> 
                </div>
                     <br>
               
        <?=form_close()?>
    </div><!--fin container-->
   

       


    <script type="text/javascript">
$(document).ready(function() {
    $("#enviar").prop("disabled", true);
    //Siempre que salgamos de un campo de texto, se chequeará esta función
    $("#f_auto input").keyup(function() {
        var form = $(this).parents("#f_auto");
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
    form =$("#f_auto").serialize();
      //alert(form);
      $("#f_auto").submit();           
});

</script>
    <script>
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
</body>
</html>