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

// Load Metodos
//$this->load->model('metodos');
}

public function index(){
	//echo $user;
	echo "<a href=\"".base_url()."administracion/admin_users/\">Admin users</a>";
}

public function admin_users(){
	if(isset($this->session->userdata['logged_in'])){
		$usuario = $this->login_database->read_user_information($this->session->userdata['logged_in']['username']);
		if($usuario->privilegios<99){
			redirect($this->index(),'refresh');
		}else{
			$this->load->view('admin_users');
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
		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|xss_clean|alpha');
		$this->form_validation->set_rules('apellido_paterno', 'Apellido Paterno', 'trim|required|xss_clean|alpha');
		$this->form_validation->set_rules('apellido_materno', 'Apellido Materno', 'trim|required|xss_clean|alpha');
		$this->form_validation->set_rules('plantel','Plantel','required');
		$this->form_validation->set_message('alpha_numeric','El campo %s solo puede contener caracteres alfanumericos');
		$this->form_validation->set_message('alpha','El campo %s solo puede contener caracteres alfabéticos');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('admin_users');
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
				$message=array('message'=>$data['usuario'].' agregado correctamente');
				$this->load->view('admin_users',$message);
			}else{
				$message=array('message'=>'El usuario '.$data['usuario'].' ya existe');
				$this->load->view('admin_users',$message);
			}
		}
	}
}else{
	redirect(base_url(),'refresh');
}
}

}
?>