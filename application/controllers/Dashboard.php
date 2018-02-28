<?php

require_once 'Backend.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Backend {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->load->view('templates/header');
		$this->load->view('templates/nav-'. $this->session->userdata('group'));
		$this->load->view('dashboard/index');
		$this->load->view('templates/footer');
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('/');
	}

	public function inspect_session(){
		print_r($_SESSION);
	}
}
