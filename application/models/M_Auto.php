<?php

class M_Auto extends CI_Model{


    function inserAuto($data)
	{
		$this->db->insert('tb_automovil',$data);
    }

    function insetTable($data,$tabla)
    {
      $this->db->insert($tabla,$data);
      }

    function insertEvidencia($data)
	{
		$this->db->insert('tb_evidencia',$data);
    }
    
    function getIdAuto($uuid){
        $number=$this->db->query('SELECT id_automovil as uiddd from tb_automovil WHERE uuid_auto = "'.$uuid.'"')->row()->uiddd;
        return intval($number);
    }   

    public function insertTerminado($data)
    {
      # code...
      $this->db->insert('tb_detalles_terminado',$data);
    }
    public function getUID($placa)
	{
		$consulta=$this->db->query('SELECT uuid_auto as uidAuto FROM tb_automovil WHERE placas_auto="'.$placa.'"')->row()->uidAuto;
		return $consulta;
    }
    
    public function updateAutomovil($uid,$data)
    {
        $this->db->where('uuid_auto', $uid);
        $this->db->update('tb_automovil', $data);
    }

    public function getPlacasByStatus($status){
      $this->db->select('placas_auto');
      $this->db->from('tb_automovil');
      $this->db->where('status_auto', $status);
      return $this->db->get();
  	}
    public function getPlacas(){
      $this->db->select('placas_auto');
      $this->db->from('tb_automovil');
      return $this->db->get();
    }
    
    public function getInfoAuto($placas){
      $this->db->select('nombre_cli,apat_cli,amat_cli,email_clie,tel_clie,tipo_auto,placas_auto,marca_auto,num_tarjeta_circula,kilometraje_ini,fecha_ingreso,fecha_salida,tb_automovil.detalles_obs,status_auto');
      $this->db->from('tb_cliente');
      $this->db->join('tb_automovil','tb_cliente.id_cliente = tb_automovil.id_automovil','inner');
      $this->db->where('tb_automovil.placas_auto', $placas);
      return $this->db->get();
  
    }

    public function getInfoAutoDetalles($placas){
      $this->db->select('area_terminada,area_nueva,fecha_hora_terminada,tb_detalles_terminado.detalles_obs,operador_encargado');
      $this->db->from('tb_detalles_terminado');
      $this->db->join('tb_automovil','tb_detalles_terminado.id_automovil = tb_automovil.id_automovil','inner');
      $this->db->where('tb_automovil.placas_auto', $placas);
      return $this->db->get();
  
    }

    public function getMediaAuto($placas){
      $this->db->select('tipo_evidencia,area_evidencia,archivo_evidencia');
      $this->db->from('tb_evidencia');
      $this->db->join('tb_automovil','tb_evidencia.id_automovil = tb_automovil.id_automovil','inner');
      $this->db->where('tb_automovil.placas_auto', $placas);
      return $this->db->get();
  
    }
    public function insertFirma($data)
    {
      # code...
      $this->db->insert('tb_firmas',$data);
    }

    public function getFirmas($placas,$tipo){
      $this->db->select('tipo_firma,ruta_firma');
      $this->db->from('tb_firmas');
      $this->db->join('tb_automovil','tb_firmas.id_automovil = tb_automovil.id_automovil','inner');

      $array = array('tb_automovil.placas_auto' => $placas, 'tb_firmas.tipo_firma' => $tipo);

      $this->db->where($array);
      
      return $this->db->get();
  
    }
}