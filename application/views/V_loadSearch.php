<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles Automóvil</title>
    <?php include APPPATH.'views/header.php';?>

    <script type="text/javascript">
        $( document ).ready(function() {

            $("#placas_auto").keypress(function(e) {
                if (e.which == 13) {
                    return false;
                }
            });
            if ($('#placas_auto').val().length == 0) {
                
            }else{
                 //$('#placas_auto').formSelect();
            $( "#placas_auto" ).ready(function() {
                $.ajax({
                    type:'POST',
                    url:'informacion_general/'+$( "#placas_auto" ).val(),
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
           
            $( "#placas_auto" ).keyup(function() {
                if($('#placas_auto').val().length == 0){

                }else{
                    $.ajax({
                    type:'POST',
                    url:'informacion_general/'+$( "#placas_auto" ).val() ,
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
        <div class="alert alert-warning" role="alert">
             No hay ningún automóvil registrado en el sistema. 
        </div>
    <?php } else{?>
        <div class="row">
            <div class="col-sm">
                <form id="f_query">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="placas_auto1"><i class="fas fa-search"></i></span>
                    </div>
                        <input type="text" class="form-control" placeholder="Buscar por placa" aria-label="Placas del automóvil" aria-describedby="placas_auto1"  id="placas_auto" name="placas_auto">
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