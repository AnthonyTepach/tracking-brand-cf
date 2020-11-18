<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Auto extends CI_Controller {

	public function __construct()
  	{
	    parent::__construct();
	    //if(!$this->session->userdata('login')){
	    // redirect(base_url());
	   	//}else{}
			   //$this->load->model('M_Auto');	
			   
        header("cache-Control: no-store, no-cache, must-revalidate");
		header("cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function loadForm($data=null)
	{
		$this->load->model('M_Cliente');
		$data1["uuid_cliente"]=$data;
		$data1["id_cliente"]= $this->M_Cliente->getIdCliente($data1["uuid_cliente"]);
		$this->load->view('V_registro_auto',$data1);
	}
	

	public function GuadarAuto(){
		$this->load->model('M_Auto');
		$data['placas_auto']=$this->input->post('placas_auto');
		$data['marca_auto']=$this->input->post('marca_auto');
		$data['modelo_auto']=$this->input->post('modelo_auto');
		$data['color_auto']=$this->input->post('color_auto');
		$data['fecha_ingreso']=$this->input->post('fecha_ingreso');
		$data['tipo_auto']=$this->input->post('tipo_auto');
		$data['num_tarjeta_circula']=$this->input->post('num_tarjeta_circula');
		$data['kilometraje_ini']=$this->input->post('kilometraje_ini');
		$data['gasolina_ini']=$this->input->post('gasolina_ini');
		$data['detalles_obs']=$this->input->post('detalles_obs');
		$data['id_cliente']=$this->input->post('id_cliente');
		$data['uuid_auto']=uniqid();	
		$data['status_auto']="recepcion";

		
		//echo $data['fecha_ingreso'];
		$this->M_Auto->inserAuto($data);
		//$this->enviarEmail("se registro un nuevo auto en recepcion.","El automóvil ".$data['marca_auto']."con placas: ".$data['placas_auto']."se ingreso el diá ".date("Y-m-d H:i:s"));
		//redirect('evidencia_auto_foto/'.$data['uuid_auto'].'/'.$data['status_auto'] , 'refresh');
		//despue de guardar el auto, me mande a firmar el documento
		redirect('firmar_documento/'.$data['uuid_auto'].'/'.$data['status_auto'] , 'refresh');
	}
	public function loadChangeArea($area)
	{
		# code...
		$this->load->model('M_Auto');
		if($area =="limpieza"){
			$area ="recepcion";
		}else if($area =="instalacion"){
			$area ="limpieza";
		}else if($area =="inspeccion"){
			$area ="instalacion";
		}else if($area =="PorSalir"){
			$area ="instalacion";
		}

		$data['consulta']=$this->M_Auto->getPlacasByStatus($area);
		$this->load->view('V_Cambiar_Area',$data);
	}
	public function loadSalidaAuto()
	{
		# code...
		$this->load->model('M_Auto');
		$data['consulta']=$this->M_Auto->getPlacasByStatus('inspeccion');
		$this->load->view('V_salida_automovil',$data);

	}
	public function loadEvidencia($uid=null,$area=null){
		$this->load->model('M_Auto');
		$data["uuid_auto"]=$uid;
		$data["id_automovil"]= $this->M_Auto->getIdAuto($data["uuid_auto"]);
		$this->load->view('V_evidencia_video',$data);
	}
	public function loadEvidenciaFoto($uid=null,$area=null){
		$this->load->model('M_Auto');
		$data["uuid_auto"]=$uid;
		$data["id_automovil"]= $this->M_Auto->getIdAuto($data["uuid_auto"]);
		$this->load->view('V_evidencia_photo',$data);
	}
	public function saveEvidenciaFoto($uid=null,$area=null){
		$data["uuid_auto"]=$uid;
		$this->load->model('M_Auto');
		$data["id_automovil"]= $this->M_Auto->getIdAuto($data["uuid_auto"]);
		$data['who_area']=$area;

		$imagenCodificada = file_get_contents("php://input");
		if(strlen($imagenCodificada) <= 0) exit("No se recibió ninguna imagen");
		$imagenCodificadaLimpia = str_replace("data:image/png;base64,", "", urldecode($imagenCodificada));
		$imagenDecodificada = base64_decode($imagenCodificadaLimpia);
		
		$nombreImagenGuardada="";
		if(!file_exists('assets/upload/'.$uid)){
			mkdir('assets/upload/'.$uid, 0777, true);
		}else{
			
			$nombreImagenGuardada = "assets/upload/".$uid.'/'.uniqid() . ".png";
			file_put_contents($nombreImagenGuardada, $imagenDecodificada);
			if (file_exists($nombreImagenGuardada)) {
				//echo "El fichero $rutaDeGuardado existe";
					//conexion con base de datos	
					$query["tipo_evidencia"]="foto";
					$query["area_evidencia"]=$data['who_area'];
					$query["id_automovil"]=$data["id_automovil"];
					$query["archivo_evidencia"]= $nombreImagenGuardada;
					$this->M_Auto->insertEvidencia($query);
			} else {
				echo "Hubo un error, al subir la imagen.";
			}
		}
		

		exit("La foto se subio con éxito: <a href ='".base_url($nombreImagenGuardada)."'> Ver ahora</a>");
	}
	public function saveEvidencia($uid=null,$area=null){
		
		
		$data["uuid_auto"]=$uid;
		$this->load->model('M_Auto');
		$data["id_automovil"]= $this->M_Auto->getIdAuto($data["uuid_auto"]);
		$data['who_area']=$area;

		//Guarda el video en MP4
		$rutaVideoSubido = $_FILES["video"]["tmp_name"];
		$nuevoNombre = uniqid() . ".webm";
		$rutaDeGuardado ='assets/upload/'.$uid;
				
		if(!file_exists($rutaDeGuardado)){
			mkdir($rutaDeGuardado.$uid, 0777, true);
		}else{
			$url = base_url($rutaDeGuardado);
			move_uploaded_file($_FILES["video"]["tmp_name"], $rutaDeGuardado.'/'.$nuevoNombre);

			//si existe la foto en el servidor.
			if (file_exists($rutaDeGuardado.'/',$nuevoNombre)) {
				//echo "El fichero $rutaDeGuardado existe";
					//conexion con base de datos	
					$query["tipo_evidencia"]="video";
					$query["area_evidencia"]=$data['who_area'];
					$query["id_automovil"]=$data["id_automovil"];
					$query["archivo_evidencia"]= $rutaDeGuardado;
					$this->M_Auto->insertEvidencia($query);
					$rutaDeGuardado="El video se subio con éxito: <a href ='".$url."'> Reproducir</a>";
			} else {
				$rutaDeGuardado="El video no se subio";
			}
		}
		echo $rutaDeGuardado;	
	}

	public function UpdateStatus($area)
	{
		$areaSiguiente="";
		$areaAnterior="";
		if($area == "recepcion"){
			$areaAnterior = "recepcion";
		}else if($area =="limpieza"){
			$areaAnterior = "recepcion";
		}else if($area =="instalacion"){
			$areaAnterior = "limpieza";
		}else if($area =="inspeccion"){
			$areaAnterior = "instalacion";
		}else if($area =="Terminado"){
			$areaAnterior = "inspeccion";
		}
		$this->load->model('M_Auto');
		$datai['placas_auto']=$this->input->post('placas_auto');
		$datai['uuid_auto']= $this->M_Auto->getUID($datai['placas_auto']);
		$data['id_automovil']=$this->M_Auto->getIdAuto($datai['uuid_auto']);
		$data['detalles_obs']=$this->input->post('detalles_obs');
		$data['operador_encargado']=$this->input->post('operador_encargado');
		$data['area_terminada']=$areaAnterior;
		$data['area_nueva']=$area;
		$data['fecha_hora_terminada']=date("Y-m-d H:i:s");
		$dataUpdate['status_auto']=$area;

		$this->M_Auto->updateAutomovil($datai['uuid_auto'],$dataUpdate);
		$this->M_Auto->insertTerminado($data);

		redirect('evidencia_auto_foto/'.$datai['uuid_auto'].'/'.$area , 'refresh');
	}

	public function UpdateSalida()
	{
		$this->load->model('M_Auto');
		$area="terminado";
		$areaAnterior="inspeccion";
		//update tabla de automóvil
		$data['status_auto']= "Terminado";
		$data['placas_auto']=$this->input->post('placas_auto');
		$data['kilometraje_fin']= $this->input->post('kilometraje_fin');
		$data['gasolina_fin']= $this->input->post('gasolina_fin');
		$data['fecha_salida']= $this->input->post('fecha_salida');
		$datai['uuid_auto']= $this->M_Auto->getUID($data['placas_auto']);

		//insert tabla detalles
		$dataDos['id_automovil']=$this->M_Auto->getIdAuto($datai['uuid_auto']);;
		$dataDos['detalles_obs']=$this->input->post('detalles_obs');
		$dataDos['operador_encargado']=$this->input->post('operador_encargado');
		$dataDos['area_terminada']=$areaAnterior;
		$dataDos['area_nueva']=$area;
		$dataDos['fecha_hora_terminada']=date("Y-m-d H:i:s");
		$this->M_Auto->insertTerminado($dataDos);
		//echo $datai['uuid_auto'];


		$this->M_Auto->updateAutomovil($datai['uuid_auto'],$data);
		
		redirect('firmar_documento/'.$datai['uuid_auto'].'/terminado' , 'refresh');

	}

	public function enviarEmail($asunto,$mensaje)
	{
		//Cargamos la librería email
		$this->load->library('email');
		//Indicamos el protocolo a utilizar
        $config['protocol'] = 'smtp';      
       //El servidor de correo que utilizaremos
        $config["smtp_host"] = 'smtp.office365.com';
       //Nuestro usuario
        $config["smtp_user"] = 'notificaciones@computerforms.com.mx';
       //Nuestra contraseña
        $config["smtp_pass"] = 'Tun47665';
       //El puerto que utilizará el servidor smtp
        $config["smtp_port"] = 587;
       //El juego de caracteres a utilizar
        $config['charset'] = 'utf-8';
       //Permitimos que se puedan cortar palabras
        $config['wordwrap'] = TRUE;
       //El email debe ser valido 
	   $config['validate'] = true;
	   $config['smtp_crypto'] = 'tls';
	   //Establecemos esta configuración
	   $this->email->initialize($config);
	   //Ponemos la dirección de correo que enviará el email y un nombre
		 $this->email->from('notificaciones@computerforms.com.mx', 'Notificaciones CF');
		 //Definimos el asunto del mensaje
		 $this->email->subject($asunto);
         
		 //Definimos el mensaje a enviar
		   $this->email->message(
				   "Email: ".'anthony.t@computerforms.com.mx'.
				   " Mensaje: ".$mensaje
				   );
			
		   //Enviamos el email y si se produce bien o mal que avise con una flasdata
		   if($this->email->send()){
			  // $this->session->set_flashdata('envio', 'Email enviado correctamente');
			  echo "<script>console.log('enviado');</script>";
		   }else{
			   //$this->session->set_flashdata('envio', 'No se a enviado el email');
			   echo "<script>console.log('no enviado');</script>";
		   }
	}

	public function loadDetalles()
	{
		# code...
		$this->load->model('M_Auto');
		$data['consulta']=$this->M_Auto->getPlacas();
		$this->load->view('V_loadSearch',$data);

	}

	public function informacionGeneral($placa)
	{
		# code...
		$this->load->model('M_Auto');
		$data['consulta']=$this->M_Auto->getInfoAuto($placa);
		$data['consulta2']=$this->M_Auto->getInfoAutoDetalles($placa);
		$data['consulta3']=$this->M_Auto->getMediaAuto($placa);
		$data['consulta4']=$this->M_Auto->getFirmas($placa,"recepcion");
		$data['consulta5']=$this->M_Auto->getFirmas($placa,"terminado");
		$this->load->view('V_loadSearchResult',$data);

	}

	public function loadFirma($uid,$tipo)
	{
				$this->load->view('V_Firmar');
	}
	public function saveFirmas($uid,$tipo){
		$imagenCodificada = file_get_contents("php://input");
		if(strlen($imagenCodificada) <= 0) exit("No se recibió ninguna imagen");
		$imagenCodificadaLimpia = str_replace("data:image/png;base64,", "", urldecode($imagenCodificada));
		$imagenDecodificada = base64_decode($imagenCodificadaLimpia);

		$nombreImagenGuardada="";
		if(!file_exists('assets/upload/'.$uid)){
			mkdir('assets/upload/'.$uid, 0777, true);
		}
		$nombreImagenGuardada = "assets/upload/".$uid.'/'.uniqid() . ".png";
		file_put_contents($nombreImagenGuardada, $imagenDecodificada);

		if (file_exists($nombreImagenGuardada)) {
			//echo "El fichero $rutaDeGuardado existe";
				//conexion con base de datos
				$this->load->model('M_Auto');	
				$data['id_automovil']=$this->M_Auto->getIdAuto($uid);;
				$data['tipo_firma']=$tipo;
				$data['fecha_hora_firmado']=date("Y-m-d H:i:s");
				$data['ruta_firma']=$nombreImagenGuardada;
				$this->M_Auto->insertFirma($data);

				exit( "se firmo correctmente: <a href ='".base_url($nombreImagenGuardada)."'> Ver ahora</a>");
				
		} else {
			echo "Hubo un error, al subir la imagen.";
		}	
		
	}
}