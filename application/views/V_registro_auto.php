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

<?=$uuid_cliente?><br>

		
    <div class="container">
    <?=form_open_multipart(base_url()."save_auto_cliente",'id="f_auto" oninput="gasolina_output.value=parseInt(gasolina_range.value)"')?>

    <div style="display:none">
    <input type="text" name="id_cliente" id="id_cliente" value="<?=$id_cliente?>">
    </div>
        <div class="row">
            <div class="col-sm">
                <!---->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-car"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Placas automovil" aria-label="Placas automovil" aria-describedby="basic-addon1" name="placas_auto">
                </div>
                <!---->
            </div>
           
            
            <div class="col-sm">
                <!---->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="marca_auto">Marca</label>
                    </div>
                    <select class="custom-select" id="marca_auto" name="marca_auto">
                        <option selected>Seleccionar...</option>
                        <option value="Nissan">Nissan</option>
                        <option value="GeneralMotors">GeneralMotors</option>
                        <option value="Volkswagen">Volkswagen</option>
                        <option value="Toyota">Toyota</option>
                        <option value="KIA">KIA</option>
                        <option value="Honda">Honda</option>
                        <option value="Mazda">Mazda</option>
                        <option value="FordMotor">FordMotor</option>
                        <option value="Chrysler">Chrysler</option>
                        <option value="Hyundai">Hyundai</option>
                        <option value="Renault">Renault</option>
                        <option value="Suzuki">Suzuki</option>
                        <option value="SEAT">SEAT</option>
                        <option value="MercedesBenz">MercedesBenz</option>
                        <option value="BMW">BMW</option>
                        <option value="Mitsubishi">Mitsubishi</option>
                        <option value="Audi">Audi</option>
                        <option value="Peugeot">Peugeot</option>
                        <option value="Fiat">Fiat</option>
                        <option value="Mini">Mini</option>
                        <option value="JAC">JAC</option>
                        <option value="BAIC">BAIC</option>
                        <option value="Volvo">Volvo</option>
                        <option value="Isuzu">Isuzu</option>
                        <option value="Acura">Acura</option>
                        <option value="Lincoln">Lincoln</option>
                        <option value="LandRover">LandRover</option>
                        <option value="Porsche">Porsche</option>
                        <option value="Infiniti">Infiniti</option>
                        <option value="Subaru">Subaru</option>
                        <option value="Jaguar">Jaguar</option>
                        <option value="AlfaRomeo">AlfaRomeo</option>
                        <option value="Smart">Smart</option>
                        <option value="Bentley">Bentley</option>

                    </select>
                </div>
                <!---->
            </div>
            <div class="col-sm">
                <!---->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="modelo_auto"><i class="fas fa-car-side"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Modelo" aria-label="modelo_auto" aria-describedby="modelo_auto" name="modelo_auto">
                </div>
                <!---->
            </div>
        </div>
        

        <div class="row">
        <div class="col-sm">
                <!---->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="num_tarjeta_circula"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="N° Tarjeta de circulacion" aria-label="num_tarjeta_circula" aria-describedby="num_tarjeta_circula" name="num_tarjeta_circula">
                </div>
                <!---->
            </div>
            <div class="col-sm">
             <!---->
             <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="color_auto"><i class="fas fa-tint"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Color" aria-label="color_auto" aria-describedby="color_auto" name="color_auto">
                </div>
                <!---->
            </div>
            <div class="col-sm">
                 <!---->
                 <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="fecha_ingresos"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" id="datepicker" class="form-control" placeholder="Fecha de entrada" aria-label="fecha_ingresos" aria-describedby="fecha_ingresos" name="fecha_ingreso">
                </div>
                <!---->
            </div>
        </div>
        <!--tipo de auto-->
        <div class="alert alert-primary" role="alert">
                Selecciona el tipo de automovil
            </div>
    <div class="row">
    <div class="col-sm">
             <!---->
             <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="tipo_auto">Tipo de automóvil</label>
                    </div>
                    <select class="custom-select" id="tipo_auto" name="tipo_auto">
                        <option value="Sedan">Sedan</option>
                        <option value="Pick-up sencilla">Pick-up sencilla</option>
                        <option value="Pick-up Doble Cabina">Pick-up Doble Cabina</option>
                        <option value="Camioneta tipo SUV">Camioneta tipo SUV</option>
                        <option value="Camioneta para pasajeros">Camioneta para pasajeros</option>
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
                        <span class="input-group-text" id="kilometraje_ini"><i class="fas fa-sort-numeric-up"></i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Kilometraje Entrada" aria-label="color_auto" aria-describedby="kilometraje_ini" name="kilometraje_ini">
                </div>
            <!---->
            </div>
            <div class="col-sm">
            
            <!---->
            <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="kilometraje_ini"><i class="fas fa-sort-numeric-up"></i> Gasolina Entrada</span>
                    </div>
                    <input type="range" placeholder="Gasolina Entrada" name="gasolina_ini" id="gasolina_range" >
                    <span class="badge badge-primary"><output name="gasolina_output" for="gasolina_range" ></output></span>
                    
                </div>
            <!---->
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
        <button id="enviar" class="btn btn-primary" type="button">Siguiente 
                    <i class="fas fa-arrow-right"></i>
        </button>


        <?=form_close()?>
    </div> <!--fin container-->

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