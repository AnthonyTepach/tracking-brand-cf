<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.0.2/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/8.0.2/firebase-analytics.js"></script>

<script>
  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  var firebaseConfig = {
    apiKey: "AIzaSyCalgKWRX-8iog-VtL8mgoRHIrtVWPgzmw",
    authDomain: "tracking-cf.firebaseapp.com",
    databaseURL: "https://tracking-cf.firebaseio.com",
    projectId: "tracking-cf",
    storageBucket: "tracking-cf.appspot.com",
    messagingSenderId: "585626987152",
    appId: "1:585626987152:web:a3349cec3cbe19aa0b4615",
    measurementId: "G-Z9LDEKQYB9"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();
  // Retrieve Firebase Messaging object.
 
</script>

<nav class="navbar navbar-dark bg-barra">
  <!-- Navbar content -->
  <button class="navbar-toggler" type="button" style="color:#fff; border:0;" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
  <i class="fas fa-bars"></i> 
  </button>
  <a class="navbar-brand" href="#">
    <img src="<?=base_url('/assets/recursos/logo-wrapp.svg')?>" alt="" width="100px" >
  </a>

 
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="<?=base_url()?>"><i class="fas fa-sign-in-alt"></i> Entrada de Auto</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=base_url('siguiente_area/limpieza')?>"><i class="fas fa-hand-sparkles"></i> Pasar a limpieza</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=base_url('siguiente_area/instalacion')?>"><i class="fas fa-tools"></i> Pasar a instalación de vinil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=base_url('siguiente_area/inspeccion')?>"><i class="fas fa-check-double"></i> Pasar a Inspección y calidad</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=base_url('salida_auto')?>"><i class="fas fa-sign-out-alt"></i> Salida de auto</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?=base_url('detalles_auto')?>"><i class="fas fa-file-alt"></i> Reportes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"></a>
      </li>
    </ul>
  </div>
</nav>
