<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Firmar</title>
    <style>
    canvas {
    
    background-color: #fff;
    
}
    </style>
    <?php include APPPATH.'views/header.php';?>
</head>
<body >
<?php include APPPATH.'views/body.php';?>
    <div class="container">
    <hr>
        <div class="row">
            <div class="col-sm" style="border: 1px solid #000000; border-radius: 14px;">
                <center><canvas id="pizarra" class="img-fluid"></canvas></center>
                <div id="Estado"></div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm">
                <button type="button" class="btn btn-primary btn-lg btn-block" id="Firma">Firmar</button>
            </div>
        </div>
    </div>

    <script>
    //======================================================================
    // VARIABLES
    //======================================================================
    let miCanvas = document.querySelector('#pizarra');
    let lineas = [];
    let correccionX = 0;
    let correccionY = 0;
    let pintarLinea = false;

    let posicion = miCanvas.getBoundingClientRect()
    correccionX = posicion.x;
    correccionY = posicion.y;

    //======================================================================
    // FUNCIONES
    //======================================================================

    /**
     * Funcion que empieza a dibujar la linea
     */
    function empezarDibujo () {
        pintarLinea = true;
        lineas.push([]);
    };

    /**
     * Funcion dibuja la linea
     */
    function dibujarLinea (event) {
        event.preventDefault();
        if (pintarLinea) {
            let ctx = miCanvas.getContext('2d')
            // Estilos de linea
            ctx.lineJoin = ctx.lineCap = 'round';
            ctx.lineWidth = 5;
            // Color de la linea
            ctx.strokeStyle = '#000';
            // Marca el nuevo punto
            let nuevaPosicionX = 0;
            let nuevaPosicionY = 0;
            if (event.changedTouches == undefined) {
                // Versión ratón
                nuevaPosicionX = event.layerX;
                nuevaPosicionY = event.layerY;
            } else {
                // Versión touch, pantalla tactil
                nuevaPosicionX = event.changedTouches[0].pageX - correccionX;
                nuevaPosicionY = event.changedTouches[0].pageY - correccionY;
            }
            // Guarda la linea
            lineas[lineas.length - 1].push({
                x: nuevaPosicionX,
                y: nuevaPosicionY
            });
            // Redibuja todas las lineas guardadas
            ctx.beginPath();
            lineas.forEach(function (segmento) {
                ctx.moveTo(segmento[0].x, segmento[0].y);
                segmento.forEach(function (punto, index) {
                    ctx.lineTo(punto.x, punto.y);
                });
            });
            ctx.stroke();
        }
    }

    /**
     * Funcion que deja de dibujar la linea
     */
    function pararDibujar () {
        pintarLinea = false;
    }

    //======================================================================
    // EVENTOS
    //======================================================================

    // Eventos raton
    miCanvas.addEventListener('mousedown', empezarDibujo, false);
    miCanvas.addEventListener('mousemove', dibujarLinea, false);
    miCanvas.addEventListener('mouseup', pararDibujar, false);

    // Eventos pantallas táctiles
    miCanvas.addEventListener('touchstart', empezarDibujo, false);
    miCanvas.addEventListener('touchmove', dibujarLinea, false);

</script>

<script>
$( document ).ready(function() {
    
    $( "#Firma" ).click(function() {
        var canvas = document.querySelector("#pizarra");
        var estado = document.querySelector("#Estado");
        var foto = canvas.toDataURL(); //Esta es la foto, en base 64
        //alert(foto);
        const RUTA_SERVIDOR = "<?=base_url('C_Auto/saveFirmas/'.$this->uri->segment(2).'/'.$this->uri->segment(3))?>";
       
        estado.innerHTML = "Enviando foto. Por favor, espera...";
        var xhr = new XMLHttpRequest();
        xhr.open("POST", RUTA_SERVIDOR, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send(encodeURIComponent(foto)); //Codificar y enviar
        var haha = "<?=base_url()?>";
            xhr.onreadystatechange = function() {
                if(xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                    console.log("La foto fue enviada correctamente");
                    console.log(xhr);
                    estado.innerHTML = xhr.responseText;
                    var aaa = '<?=$this->uri->segment(3)?>';
                    if(aaa == "terminado"){
                        location.href = "<?=base_url('detalles_auto')?>";
                    }else{
                        location.href = "<?=base_url('evidencia_auto_foto/'.$this->uri->segment(2).'/'.$this->uri->segment(3))?>";
                    }
                }else if(xhr.status == 500){
                            console.log("Error en el servidor");
                            console.log(xhr);
                            estado.innerHTML = xhr.responseText;
                        }
            }
    });

});
</script>
</body>
</html>