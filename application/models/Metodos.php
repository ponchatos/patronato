<?php

Class Metodos extends CI_Model {

public function registrar_alumno($data){
	$send = array(
		'nombre'=>$data['nombre'],
		'apellido_paterno'=>$data['apellido_paterno'],
		'apellido_materno'=>$data['apellido_materno'],
		'fecha_nac'=>$data['fecha_nac'],
		'escuela'=>$data['escuela'],
		'pad_nombre'=>$data['pad_nombre'],
		'pad_apellido_p'=>$data['pad_apellido_p'],
		'pad_apellido_m'=>$data['pad_apellido_m'],
		'domicilio'=>$data['domicilio'],
		'correo'=>$data['correo'],
		'telefono'=>$data['telefono'],
		'telefonocel'=>$data['telefonocel'],
		'telefonotrabajo'=>$data['telefonotrabajo'],
		'id_talla'=>$data['id_talla'],
		);
	$query = $this->registrar_datos_personales($send);
	if($query==FALSE){
		return FALSE;
	}else{
		if($data['id_entero']>3){
			$entero=registrar_entero($data['entero']);
		}else{
			$entero=$data['id_entero'];
		}
		$sendd = array(
			'id_alumno'=>$query,
			'id_plantel'=>$data['id_plantel'],
			'id_programa'=>$data['id_programa'],
			'id_usuario'=>$data['id_usuario'],
			'id_grupo'=>$data['id_grupo'],
			'id_nivel'=>$data['id_nivel'],
			'id_entero'=>$entero,
			'costo'=>$data['costo']
			);
		$return = $this->registrar_inscripcion($sendd);
		if($return!=FALSE){
			//echo $return;
			return $return;
		}else{
			//echo "Falló el registro";
			return FALSE;
		}
	}
}

public function registrar_inscripcion($data){
	$this->db->insert('inscripcion',$data);
	if($this->db->affected_rows()>0){
		return $this->db->insert_id();
	}else{
		return FALSE;
	}
}

public function registrar_entero($comentario){
	$this->db->where('nombre',$comentario);
	$query=$this->db->get('como_entero');
	if($query->num_rows()==0){
		$arr = array('nombre'=>$comentario);
		$this->db->insert('como_entero',$arr);
		if($this->db->affected_rows()>0){
			return $this->db->insert_id();
		}else{
			return FALSE;
		}
	}else{
		return $query->row(0)->id_entero;
	}
}

public function registrar_datos_personales($data){
	$this->db->insert('datos_personales',$data);
	if($this->db->affected_rows()>0){
		return $this->db->insert_id();
	}else{
		return FALSE;
	}
}

public function registrar_grupo($data){
	$this->db->insert('grupos',$data);
	if($this->db->affected_rows()>0){
		return $this->db->insert_id();
	}else{
		return FALSE;
	}
}

}

?>