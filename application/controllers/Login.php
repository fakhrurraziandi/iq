<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('LoginModel');
		if($this->session->userdata('id')){
			redirect('dashboard');
		}
	}

	public function index(){
		$this->load->view('templates/header');
		$this->load->view('login/index');
		$this->load->view('templates/footer');
	}

	public function submit(){

		header('Content-Type: application/json');
		$result = $this->LoginModel->submitLogin();
		echo json_encode($result);
	}

}