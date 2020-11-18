<?php

class M_Cliente extends CI_Model{


    function setCliente($data)
	{
		$this->db->insert('tb_cliente',$data);
    }
    
    public function getMaxId()
		{
			$number=$this->db->query('SELECT MAX(id_cliente) as num from tb_cliente')->row()->num;
			return intval($number);
		}

		function getIdCliente($uuid){
			$number=$this->db->query('SELECT id_cliente as num from tb_cliente WHERE uuid_clie = "'.$uuid.'"')->row()->num;
			return intval($number);
    }
}
