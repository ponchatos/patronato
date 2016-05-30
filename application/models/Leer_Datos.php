<?php

Class Leer_Datos extends CI_Model {

	public function get_spinner_datas(){
		$planteles=$this->db->get('planteles');
		$programas=$this->db->get('programas');
		$tallas=$this->db->get('tallas_playeras');
		$como_entero=$this->db->get('como_entero');
		$data=array();
		if($planteles->num_rows()>0){
			$temp=array();
			foreach ($planteles->result() as $plantel) {
				$temp[]=array(
					'id_plantel'=>$plantel->id_plantel,
					'nombre'=>$plantel->nombre
					);
			}
			$data['planteles']=$temp;
		}
		if($programas->num_rows()>0){
			$temp=array();
			foreach ($programas->result() as $programa) {
				$temp[]=array(
					'id_programa'=>$programa->id_programa,
					'nombre'=>$programa->nombre,
					'tipo'=>$programa->tipo
					);
			}
			$data['programas']=$temp;
		}
		if($tallas->num_rows()>0){
			$temp=array();
			foreach ($tallas->result() as $talla) {
				$temp[]=array(
					'id_talla'=>$talla->id_talla,
					'talla'=>$talla->talla
					);
			}
			$data['tallas']=$temp;
		}
		if($como_entero->num_rows()>0){
			$temp=array();
			foreach ($como_entero->result() as $como) {
				$temp[]=array(
					'id_entero'=>$como->id_entero,
					'nombre'=>$como->nombre
					);
			}
			$data['como_entero']=$temp;
		}
		return $data;
		//&&$programas->num_rows()>0&&$tallas->num_rows()>0
	}

	public function get_grupos($id_plantel){
		$this->db->where('id_plantel',$id_plantel);
		$grupos=$this->db->get('grupos');
		if($grupos->num_rows()>0){
			$ret=array();
			foreach ($grupos->result() as $row) {
				$this->db->where('id_grupo',$row->id_grupo);
				$count=$this->db->count_all_results('vista_grupo');
				$ret[]=array(
					'id_grupo'=>$row->id_grupo,
					'nombre'=>$row->nombre,
					'cantidad'=>$count
				);
			}
			return $ret;
		}else{
			return FALSE;
		}

	}

	public function get_inscrito_info($folio){
		$this->db->where('folio',$folio);
		$query=$this->db->get('vista_recibo2');
		if($query->num_rows()==1){
			$return=array(
				'nombre'=>$query->row(0)->nombre." ".$query->row(0)->apellido_paterno." ".$query->row(0)->apellido_materno,
				'fec_nac'=>$query->row(0)->fecha_nac,
				'nombre_tutor'=>$query->row(0)->pad_nombre." ".$query->row(0)->pad_apellido_p." ".$query->row(0)->pad_apellido_m,
				'domicilio'=>$query->row(0)->domicilio,
				'telefono'=>$query->row(0)->telefono,
				'escuela'=>$query->row(0)->escuela,
				'plantel'=>$query->row(0)->plantel,
				'curso'=>$query->row(0)->curso,
				'taller'=>$query->row(0)->taller,
				'grupo'=>$query->row(0)->grupo,
				'costo'=>$query->row(0)->costo,
				'f_registro'=>$query->row(0)->f_registro
				);
			return $return;
		}else{
			return FALSE;
		}
	}

	public function get_lista_busqueda(){
		$query=$this->db->get('vista_listas2');
		if($query->num_rows()>0){
			$return['datos_tabla']=array();
			foreach ($query->result() as $row) {
				$return['datos_tabla'][]=array(
					'folio'=>$row->folio,
					'nombre'=>$row->nombre." ".$row->apellido_paterno." ".$row->apellido_materno,
					'nombre_tutor'=>$row->pad_nombre." ".$row->pad_apellido_p." ".$row->pad_apellido_m,
					'domicilio'=>$row->domicilio,
					'telefono'=>$row->telefono,
					'celular'=>$row->telefonocel,
					't_trabajo'=>$row->telefonotrabajo,
					'escuela'=>$row->escuela,
					'grado'=>$row->grado."° ".$row->nivel,
					'plantel'=>$row->plantel,
					'curso'=>$row->curso,
					'taller'=>$row->taller,
					'grupo'=>$row->grupo,
					'turno'=>$row->turno,
					'entero'=>$row->entero,
					'q_registro'=>$row->NombreU." ".$row->ApellidoU." ".$row->PlantelUs,
					'costo'=>$row->costo,
					'f_registro'=>$row->f_registro
				);

			}
			return $return;
		}else{
			return FALSE;
		}
	}


}

?>