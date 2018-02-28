<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('id')){
			redirect('/');
		}
	}
}