<?php

//session_start(); //we need to start session in order to access it through CI

Class Administracion extends CI_Controller {

public function __construct() {
parent::__construct();

// Load form helper library
$this->load->helper('form');

// Load form validation library
$this->load->library('form_validation');

// Load session library
$this->load->library('session');

// Load database
$this->load->model('login_database');
$this->load->model('leer_datos');

// Load Metodos
$this->load->model('metodos');
}

public function prueba(){
	//var_dump($this->leer_datos->get_spinner_datas());
	//$data=$this->leer_datos->get_spinner_datas();

	//$this->load->view('pruebas');
}

public function index(){
	if(isset($this->session->userdata['logged_in'])){
		$this->registrar_alumno();
	}else{
		redirect(base_url(),'refresh');
	}
}

public function get_grupos(){
	if(isset($this->session->userdata['logged_in'])){
		$this->form_validation->set_rules('id_plantel', 'ID del Plantel', 'trim|required|xss_clean|numeric');
		
		if ($this->form_validation->run() == FALSE) {
			$return[]=array(
				'success'=>-1,
				'message'=>"El plantel es necesario"
				);
		}else{
			$id_plantel=$this->input->post('id_plantel');
			$ret=$this->leer_datos->get_grupos($id_plantel);
			if($ret!=FALSE){
				$return[]=array(
					'success'=>1,
					'message'=>'Satisfactorio'
					);
				foreach ($ret as $grupo) {
					$return[]=array(
						'id_grupo'=>$grupo['id_grupo'],
						'nombre'=>$grupo['nombre'],
						'cantidad'=>$grupo['cantidad']
						);
				}
				
			}else{
				$return[]=array(
					'success'=>0,
					'message'=>"No existen grupos"
					);
			}
		}
		die(json_encode($return));
	}else{
		redirect(base_url(),'refresh');
	}
}

public function add_grupo(){
	if(isset($this->session->userdata['logged_in'])){
		$this->form_validation->set_rules('id_plantel', 'ID del Plantel', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('nombre', 'Nombre del Grupo', 'trim|required|xss_clean|alpha_numeric_spaces');
		if ($this->form_validation->run() == FALSE) {
			$return[]=array(
				'success'=>-1,
				'message'=>"Todos los campos son necesarios"
				);
		}else{
			$send=array(
				'id_plantel'=>$this->input->post('id_plantel'),
				'nombre'=>$this->input->post('nombre')
				);
			$ret=$this->metodos->registrar_grupo($send);
			if($ret!=FALSE){
				$return[]=array(
					'success'=>1,
					'message'=>"Grupo registrado correctamente"
					);
				$return[]=array(
					'id_grupo'=>$ret
					);
			}else{
				$return[]=array(
					'success'=>0,
					'message'=>"Falló al registrar grupo"
					);
			}
		}
		die(json_encode($return));
	}else{
		redirect(base_url(),'refresh');
	}
}

public function registrar_alumno(){
	if(isset($this->session->userdata['logged_in'])){
		$this->form_validation->set_rules('nombre', 'Nombre del niño', 'trim|required|xss_clean');
		$this->form_validation->set_rules('apellido_paterno', 'Apellido Paterno', 'trim|required|xss_clean|alpha');
		$this->form_validation->set_rules('apellido_materno', 'Apellido Materno', 'trim|required|xss_clean|alpha');
		$this->form_validation->set_rules('fecha_nac', 'Fecha de Nacimiento', 'trim|required|xss_clean');
		$this->form_validation->set_rules('escuela', 'Escuela donde estudia', 'trim|xss_clean');
		$this->form_validation->set_rules('pad_nombre', 'Nombre del padre', 'trim|required|xss_clean');
		$this->form_validation->set_rules('pad_apellido_p', 'Apellido Paterno Del Padre', 'trim|required|xss_clean|alpha');
		$this->form_validation->set_rules('pad_apellido_m', 'Apellido Materno Del Padre', 'trim|required|xss_clean|alpha');
		$this->form_validation->set_rules('domicilio', 'Domicilio', 'trim|required|xss_clean');
		$this->form_validation->set_rules('correo', 'Correo Electronico', 'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('telefono', 'Telefono', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('telefonocel', 'Telefono Celular', 'trim|xss_clean|numeric');
		$this->form_validation->set_rules('telefonotrabajo', 'Telefono Trabajo', 'trim|xss_clean|numeric');
		$this->form_validation->set_rules('id_talla', 'Talla de playera', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('id_entero', 'Como se entero de este curso?', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('entero', 'Otros', 'trim|xss_clean');
		$this->form_validation->set_rules('id_plantel', 'Plantel', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('id_programa', 'Programa', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('id_grupo', 'Grupo', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('id_nivel', 'Grado Escolar', 'trim|required|xss_clean|numeric');
		$this->form_validation->set_rules('costo','Costo','trim|required|xss_clean|numeric');


		if ($this->form_validation->run() == FALSE) {
			$data=$this->leer_datos->get_spinner_datas();
			$this->load->view('barra_nav');
			$this->load->view('registrar_alumno',$data);
		}else{
			$retu = $this->login_database->read_user_information($this->session->userdata['logged_in']['username']);
			//echo $retu->id_alumno;
			$data= array(
				'nombre'=>$this->input->post('nombre'),
				'apellido_paterno'=>$this->input->post('apellido_paterno'),
				'apellido_materno'=>$this->input->post('apellido_materno'),
				'fecha_nac'=>$this->input->post('fecha_nac'),
				'escuela'=>$this->input->post('escuela'),
				'pad_nombre'=>$this->input->post('pad_nombre'),
				'pad_apellido_p'=>$this->input->post('pad_apellido_p'),
				'pad_apellido_m'=>$this->input->post('pad_apellido_m'),
				'domicilio'=>$this->input->post('domicilio'),
				'correo'=>$this->input->post('correo'),
				'telefono'=>$this->input->post('telefono'),
				'telefonocel'=>$this->input->post('telefonocel'),
				'telefonotrabajo'=>$this->input->post('telefonotrabajo'),
				'id_talla'=>$this->input->post('id_talla'),
				'id_entero'=>$this->input->post('id_entero'),
				'entero'=>$this->input->post('entero'),
				'id_plantel'=>$this->input->post('id_plantel'),
				'id_programa'=>$this->input->post('id_programa'),
				'id_grupo'=>$this->input->post('id_grupo'),
				'id_nivel'=>$this->input->post('id_nivel'),
				'id_usuario'=>$retu->id_usuario,
				'costo'=>$this->input->post('costo')
				);
			if($this->input->post('telefonocel')==null){
				$data['telefonocel']="";
			}
			if($this->input->post('telefonotrabajo')==null){
				$data['telefonotrabajo']="";
			}
			if($this->input->post('entero')==null){
				$data['entero']="";
			}
			if($this->input->post('escuela')==null){
				$data['escuela']="";
			}
			$this->load->model('metodos');
			$result=$this->metodos->registrar_alumno($data);
			if($result!=FALSE){
				$arreglo=array();
				$arreglo=$this->leer_datos->get_spinner_datas();
				$arreglo['message']="Usuario registrado correctamente con el Folio: ".$result;
				$this->load->view('barra_nav');
				$this->load->view('registrar_alumno',$arreglo);
			}else{
				$arreglo=array();
				$arreglo=$this->leer_datos->get_spinner_datas();
				$arreglo['message']="Fallo la inscripcion del alumno";
				$this->load->view('barra_nav');
				$this->load->view('registrar_alumno',$arreglo);
			}
		}
	}else{
		redirect(base_url(),'refresh');
	}
}

public function admin_users(){
	if(isset($this->session->userdata['logged_in'])){
		$usuario = $this->login_database->read_user_information($this->session->userdata['logged_in']['username']);
		if($usuario->privilegios<99){
			redirect($this->index(),'refresh');
		}else{
			$result=$this->login_database->read_vista_users();
			if($result!=FALSE){
				//$array 
				foreach ($result as $row) {
					$array['usuarios'][] = array(
						'usuario'=>$row->usuario,
						'nombre'=>$row->nombre,
						'apellido'=>$row->apellido_paterno.' '.$row->apellido_materno,
						'plantel'=>$row->plantel,
						'id_usuario'=>$row->id_usuario,
						'privilegios'=>$row->privilegios
						);
				}
				$this->load->view('barra_nav');
				$this->load->view('admin_users',$array);
			}else{
				$this->load->view('barra_nav');
				$this->load->view('admin_users');
			}
			
		}
	}else{
		redirect(base_url(),'refresh');
	}
}

public function admin_register_user(){
if(isset($this->session->userdata['logged_in'])){
	$usuario = $this->login_database->read_user_information($this->session->userdata['logged_in']['username']);
	if($usuario->privilegios<99){
		redirect($this->index(),'refresh');
	}else{
		$this->form_validation->set_rules('username', 'Usuario', 'trim|required|xss_clean|alpha_numeric');
		$this->form_validation->set_rules('password', 'Contraseña', 'trim|required|xss_clean|alpha_numeric');
		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|xss_clean|alpha_numeric_spaces');
		$this->form_validation->set_rules('apellido_paterno', 'Apellido Paterno', 'trim|required|xss_clean|alpha');
		$this->form_validation->set_rules('apellido_materno', 'Apellido Materno', 'trim|required|xss_clean|alpha');
		$this->form_validation->set_rules('plantel','Plantel','required');
		$this->form_validation->set_message('alpha_numeric','El campo %s solo puede contener caracteres alfanumericos');
		$this->form_validation->set_message('alpha','El campo %s solo puede contener caracteres alfabéticos');
		if ($this->form_validation->run() == FALSE) {
			$result=$this->login_database->read_vista_users();
			if($result!=FALSE){
				//$array 
				foreach ($result as $row) {
					$array['usuarios'][] = array(
						'usuario'=>$row->usuario,
						'nombre'=>$row->nombre,
						'apellido'=>$row->apellido_paterno.' '.$row->apellido_materno,
						'plantel'=>$row->plantel,
						'id_usuario'=>$row->id_usuario,
						'privilegios'=>$row->privilegios
						);
				}
				$this->load->view('barra_nav');
				$this->load->view('admin_users',$array);
			}else{
				$this->load->view('barra_nav');
				$this->load->view('admin_users');
			}
			
		}else{
			if($this->input->post('privilegios')!=null){
				$privilegios=99;
			}else{
				$privilegios=0;
			}
			$data= array(
				'usuario'=>$this->input->post('username'),
				'password'=>$this->input->post('password'),
				'nombre'=>$this->input->post('nombre'),
				'apellido_paterno'=>$this->input->post('apellido_paterno'),
				'apellido_materno'=>$this->input->post('apellido_materno'),
				'id_plantel'=>$this->input->post('plantel'),
				'privilegios'=>$privilegios
				);
			if($this->login_database->registration_insert($data)==TRUE){
				$array=array('message'=>$data['usuario'].' agregado correctamente');
				$result=$this->login_database->read_vista_users();
				if($result!=FALSE){
					//$array 
					foreach ($result as $row) {
						$array['usuarios'][] = array(
							'usuario'=>$row->usuario,
							'nombre'=>$row->nombre,
							'apellido'=>$row->apellido_paterno.' '.$row->apellido_materno,
							'plantel'=>$row->plantel,
							'id_usuario'=>$row->id_usuario,
							'privilegios'=>$row->privilegios
							);
					}
				}
				$this->load->view('barra_nav');
				$this->load->view('admin_users',$array);
			}else{
				$array=array('message'=>'El usuario '.$data['usuario'].' ya existe');
				$result=$this->login_database->read_vista_users();
				if($result!=FALSE){
					//$array 
					foreach ($result as $row) {
						$array['usuarios'][] = array(
							'usuario'=>$row->usuario,
							'nombre'=>$row->nombre,
							'apellido'=>$row->apellido_paterno.' '.$row->apellido_materno,
							'plantel'=>$row->plantel,
							'id_usuario'=>$row->id_usuario,
							'privilegios'=>$row->privilegios
							);
					}
				}
				$this->load->view('barra_nav');
				$this->load->view('admin_users',$array);
			}
		}
	}
}else{
	redirect(base_url(),'refresh');
}
}

}
?>