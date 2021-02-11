<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles Automóvil</title>
    <?php include APPPATH.'views/header.php';?>

    <script type="text/javascript">
        $( document ).ready(function() {

            $("#input-red").keypress(function(e) {
                if (e.which == 13) {
                    return false;
                }
            });
            if ($('#input-red').val().length == 0) {
                
            }else{
                 //$('#placas_auto').formSelect();
            $( "#input-red" ).ready(function() {
                $.ajax({
                    type:'POST',
                    url:'informacion_general/'+$("#input-red").val(),
                    data: $("#f_query").serialize(),
                    success:function(data){
                        $('#ajaxQuery').html(data);
                    },
					error:function(jqXHR, status, errorThrown){
					  	$('#ajaxQuery').html('<div class="alert alert-danger" role="alert">'+errorThrown+'<br>'+status+'</div>');   
						    console.log( "Error: " + errorThrown );
						    console.log( "Status: " + status );
						    console.dir( jqXHR );
						  }
                     });
            });//cerrar input ready
            }
           
            $( "#input-red" ).keyup(function() {
                if($('#input-red').val().length == 0){

                }else{
                    $.ajax({
                    type:'POST',
                    url:'informacion_general/'+$( "#input-red" ).val() ,
                    data: $("#f_query").serialize(),
                    success:function(data){
                        $('#ajaxQuery').html(data);
                    },
					error:function(jqXHR, status, errorThrown){
                        $('#ajaxQuery').html('<div class="alert alert-danger" role="alert">'+errorThrown+'<br>'+status+'</div>');   
						    console.log( "Error: " + errorThrown );
						    console.log( "Status: " + status );
						    console.dir( jqXHR );
						  }
                     });
                }
               
            });//cerrar input change
        });//cerrar document ready
    </script>
</head>
<body >
<?php include APPPATH.'views/body.php';?>
    <div class="container">
    <hr>
    <?php if ($consulta->num_rows()==0) { ?>
        <div class="tamanio bg-degradado" role="alert">
             No hay ningún automóvil registrado en el sistema.  <img class="img-fluid" width="70px" src="<?=base_url('assets/recursos/camion.svg')?>" alt="vector-camion" srcset="">
        </div>
    <?php } else{?>
        <div class="row">
            <div class="col-sm">
                <div class="centrado">
                    <h4 class="burbuja2">Reporte</h4>
                </div>




                <form id="f_query">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span id="input-group-text2"  class="input-group-text" id="placas_auto1"><i class="fas fa-search"></i></span>
                        <input id="input-red" type="text" class="form-control" placeholder="Buscar por placa" aria-label="Placas del automóvil" aria-describedby="placas_auto1"   name="placas_auto">
                </div>
                </form>
            </div>
        </div>
        <div id="ajaxQuery">
            
        </div>
        <?php } ?>
    </div><!--Cierre de Container-->
</body>
</html>