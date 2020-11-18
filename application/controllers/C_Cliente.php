<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Cliente extends CI_Controller {

	public function __construct()
  	{
	    parent::__construct();
	    //if(!$this->session->userdata('login')){
	    // redirect(base_url());
	   	//}else{}
	   		$this->load->model('M_Cliente');	
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
	public function index()
	{
		$this->load->view('V_registro_auto');
    }
    
    public function GuardarCliente()
	{
        $data['nombre_cli']=$this->input->post('nombre_cli');
        $data['apat_cli']=$this->input->post('apat_cli');
        $data['amat_cli']=$this->input->post('amat_cli');
        $data['email_clie']=$this->input->post('email_clie');
		$data['tel_clie']=$this->input->post('tel_clie');
		$data['uuid_clie']=uniqid();			
        $this->M_Cliente->setCliente($data);
		//$data1['id_cliente'] = $this->M_Cliente->getMaxId();
		redirect('auto_cliente/'.$data['uuid_clie'] , 'refresh');
        //$this->load->view('V_registro_auto',$data1);
        
	}
}