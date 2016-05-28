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

}

?>