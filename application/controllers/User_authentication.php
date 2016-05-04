<?php

//session_start(); //we need to start session in order to access it through CI

Class User_Authentication extends CI_Controller {

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
	$this->load->view('login_form');
}

public function user_login_process() {
	//valida los campos username y password
$this->form_validation->set_rules('username', 'Usuario', 'trim|required|xss_clean|alpha_numeric');
$this->form_validation->set_rules('password', 'Contraseña', 'trim|required|xss_clean|alpha_numeric');
$this->form_validation->set_message('alpha_numeric','El campo %s solo puede contener caracteres alfanumericos');
if ($this->form_validation->run() == FALSE) {
	//si el usuario ya esta logeado se manda a la pagina del juego
	if(isset($this->session->userdata['logged_in'])){
		//$this->load->view('juego/header');
		//$this->load->view('juego/game');
		redirect(base_url().'administracion/','refresh');
	}else{
		$data= array('error_message'=>'El campo usuario y contraseña son obligatorios');
		$this->load->view('login_form',$data);
	}
} else {
	$data = array(
	'usuario' => $this->input->post('username'),
	'password' => $this->input->post('password')
	);
	//se llama a la funcion login y verifica si se creo el usuario o no
	$result = $this->login_database->login($data);
	if ($result == TRUE) {
		$username = $this->input->post('username');
		//llama a la funcion read_user_information buscando los datos del usuario
		$result = $this->login_database->read_user_information($username);
		if ($result != false) {
			$session_data = array(
			'username' => $result->usuario,
			'privilegios'=>$result->privilegios
			);
			// Add user data in session
			$this->session->set_userdata('logged_in', $session_data);
			redirect(base_url().'administracion/','refresh');
		}
	} else {
		$data = array(
		'error_message' => 'Usuario o Contraseña Inválido'
		);
		$this->load->view('login_form', $data);
	}
}
}
public function logout() {

	// Removing session data
	$sess_array = array(
	'username' => '',
	);
	if(isset($this->session->userdata['logged_in'])){
		$this->session->unset_userdata('logged_in', $sess_array);
		$data['message'] = 'Sesión Cerrada Correctamente';
		$this->load->view('login_form', $data);
	}
}

}

?>