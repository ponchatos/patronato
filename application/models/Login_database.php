<?php

Class Login_Database extends CI_Model {

public function login($data) {
	//busca si existe en la tabla usuarios el nombre de usuario recibido
	//$condition = "user =" . "'" . $data['username'] . "' AND " . "password =" . "'" . $data['password'] . "'";
	$this->db->where('usuario',$data['usuario']);
	$this->db->where('password',$data['password']);
	$query = $this->db->get('usuarios');

	if ($query->num_rows() == 1) {
		return true;
	} else {
		return false;
	}
}

public function read_user_information($username) {
	//lee los datos del usuario en la tabla usuario y los manda de regreso
	$this->db->where('usuario',$username);
	$query = $this->db->get('usuarios');

	if ($query->num_rows() == 1) {
		return $query->row(0);
	} else {
		return false;
	}
}

public function registration_insert($data){
	if($this->user_exists($data['usuario'])==TRUE){
		return FALSE;
	}else{
		$this->db->insert('usuarios',$data);
		if($this->db->affected_rows()>0){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}

public function read_users(){
	$query=$this->db->get('usuarios');
	if($query->num_rows()>0){
		return $query->result();
	}else{
		return FALSE;
	}
}

public function read_vista_users(){
	$query=$this->db->get('vista_usuario');
	if($query->num_rows()>0){
		return $query->result();
	}else{
		return FALSE;
	}
}

public function delete_user($username){
	if($this->user_exists($username)){
		$this->db->where('usuario',$username);
		$this->db->delete('usuarios');
		if($this->db->affected_rows()>0){
			return TRUE;
		}else{
			return FALSE;
		}
	}else{
		return FALSE;
	}

}

public function user_exists($username){
	$this->db->where('usuario',$username);
	$query = $this->db->get('usuarios');
	if($query->num_rows()>0){
		return TRUE;
	}else{
		return FALSE;
	}
}

}

?>