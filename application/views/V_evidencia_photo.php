<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tomar Fotos</title>
    <?php include APPPATH.'views/header.php';?>
</head>
<body >
<?php include APPPATH.'views/body.php';?>
    <div class="container">
        <br>
        <div class="centrado">
            <h4 class="burbuja2">Tomar Foto</h4>
        </div>
        <div class="row">
            <div class="col-sm" style="display:none">
                <!---->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="dispositivosDeVideo"><i class="fas fa-video"></i></label>
                    </div>
                    <select class="custom-select"  name="listaDeDispositivos" id="listaDeDispositivos"></select>
                </div>
                <!---->
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
            <video muted="muted" class="img-fluid camara-foto" id="video"></video>
	        <canvas id="canvas" class="img-fluid camara-foto" style="display:none"></canvas>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm">
                <center>
                <div class="btn-group " role="group" aria-label="Basic example">
                    <button  id="boton" type="button" class="btn btn-blanco"><i class="fas fa-camera"></i> Tomar Foto</button>
                    <button style="display:none;" onclick="window.location.href='<?=base_url('evidencia_auto/').$this->uri->segment(2).'/'.$this->uri->segment(3)?>'" type="button" class="btn btn-secondary">Grabar video</button>
                    <button onclick="window.location.href='<?=base_url()?>'" type="button" class="btn btn-danger">Omitir</button>
                </div>
                </center>
                <h4><span class="badge badge-light" id="estado"></span></h4>
            </div>
        </div>

      <script>
       /*
    Tomar una fotografÃ­a y guardarla en un archivo v3
    @date 2018-10-22
    @author parzibyte
    @web parzibyte.me/blog
*/
const tieneSoporteUserMedia = () =>
    !!(navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia)
const _getUserMedia = (...arguments) =>
    (navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia).apply(navigator, arguments);

// Declaramos elementos del DOM
const $video = document.querySelector("#video"),
    $canvas = document.querySelector("#canvas"),
    $estado = document.querySelector("#estado"),
    $boton = document.querySelector("#boton"),
    $listaDeDispositivos = document.querySelector("#listaDeDispositivos");

const limpiarSelect = () => {
    for (let x = $listaDeDispositivos.options.length - 1; x >= 0; x--)
        $listaDeDispositivos.remove(x);
};
const obtenerDispositivos = () => navigator
    .mediaDevices
    .enumerateDevices();

// La funciÃ³n que es llamada despuÃ©s de que ya se dieron los permisos
// Lo que hace es llenar el select con los dispositivos obtenidos
const llenarSelectConDispositivosDisponibles = () => {

    limpiarSelect();
    obtenerDispositivos()
        .then(dispositivos => {
            const dispositivosDeVideo = [];
            dispositivos.forEach(dispositivo => {
                const tipo = dispositivo.kind;
                if (tipo === "videoinput") {
                    dispositivosDeVideo.push(dispositivo);
                }
            });

            // Vemos si encontramos algÃºn dispositivo, y en caso de que si, entonces llamamos a la funciÃ³n
            if (dispositivosDeVideo.length > 0) {
                // Llenar el select
                dispositivosDeVideo.forEach(dispositivo => {
                    const option = document.createElement('option');
                    option.value = dispositivo.deviceId;
                    option.text = dispositivo.label;
                    $listaDeDispositivos.appendChild(option);
                });
            }
        });
}



(function() {
    // Comenzamos viendo si tiene soporte, si no, nos detenemos
    if (!tieneSoporteUserMedia()) {
        alert("Lo siento. Tu navegador no soporta esta caracterÃ­stica");
        $estado.innerHTML = "Parece que tu navegador no soporta esta caracterÃ­stica. Intenta actualizarlo.";
        return;
    }
    //AquÃ­ guardaremos el stream globalmente
    let stream;


    // Comenzamos pidiendo los dispositivos
    obtenerDispositivos()
        .then(dispositivos => {
            // Vamos a filtrarlos y guardar aquÃ­ los de vÃ­deo
            const dispositivosDeVideo = [];

            // Recorrer y filtrar
            dispositivos.forEach(function(dispositivo) {
                const tipo = dispositivo.kind;
                if (tipo === "videoinput") {
                    dispositivosDeVideo.push(dispositivo);
                }
            });

            // Vemos si encontramos algÃºn dispositivo, y en caso de que si, entonces llamamos a la funciÃ³n
            // y le pasamos el id de dispositivo
            if (dispositivosDeVideo.length == 0) {
                // Mostrar stream con el ID del primer dispositivo, luego el usuario puede cambiar
                mostrarStream(dispositivosDeVideo[0].deviceId);
            }else  if (dispositivosDeVideo.length >= 1) {
                mostrarStream(dispositivosDeVideo[dispositivosDeVideo.length-1].deviceId);
            }
        });

        $listaDeDispositivos.onchange = () => {
                    // Detener el stream
                    if (stream) {
                        stream.getTracks().forEach(function(track) {
                            track.stop();
                        });
                    }
                    // Mostrar el nuevo stream con el dispositivo seleccionado
                    mostrarStream($listaDeDispositivos.value);
                }

    const mostrarStream = idDeDispositivo => {
        _getUserMedia({
                video: {
                    // Justo aquÃ­ indicamos cuÃ¡l dispositivo usar
                    deviceId: idDeDispositivo,
                    width: 1280,
                    height: 720,
                    frameRate: { ideal: 60, max: 120 },
                    }
            },
            (streamObtenido) => {
                // AquÃ­ ya tenemos permisos, ahora sÃ­ llenamos el select,
                // pues si no, no nos darÃ­a el nombre de los dispositivos
                llenarSelectConDispositivosDisponibles();

                // Escuchar cuando seleccionen otra opciÃ³n y entonces llamar a esta funciÃ³n
                

                // Simple asignaciÃ³n
                stream = streamObtenido;

                // Mandamos el stream de la cÃ¡mara al elemento de vÃ­deo
                $video.srcObject = stream;
                $video.play();

                //Escuchar el click del botÃ³n para tomar la foto
                //Escuchar el click del botÃ³n para tomar la foto
                $boton.addEventListener("click", function() {

                    //Pausar reproducciÃ³n
                    $video.pause();

                    //Obtener contexto del canvas y dibujar sobre Ã©l
                    let contexto = $canvas.getContext("2d");
                    $canvas.width = $video.videoWidth;
                    $canvas.height = $video.videoHeight;
                    contexto.drawImage($video, 0, 0, $canvas.width, $canvas.height);
                    var foto = $canvas.toDataURL(); //Esta es la foto, en base 64

                    const RUTA_SERVIDOR = "<?=base_url('C_Auto/saveEvidenciaFoto/'.$uuid_auto.'/'.$this->uri->segment(3))?>";
                    $estado.innerHTML = "Enviando foto. Por favor, espera...";
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
                        }else if(xhr.status == 500){
                            console.log("Error en el servidor");
                            console.log(xhr);
                            estado.innerHTML = xhr.responseText;
                        }
                    }

                    //Reanudar reproducciÃ³n
                    $video.play();
                });
            }, (error) => {
                console.log("Permiso denegado o error: ", error);
                $estado.innerHTML = "No se puede acceder a la cÃ¡mara, o no diste permiso.";
            });
    }
})();
      </script>
    </div>
</body>
</html>