<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function index()
	{
		$this->session->sess_destroy();
    $this->load->view('/commons/head');
    $this->load->view('/commons/login');
    $this->load->view('/commons/scripts');
    $this->load->view('/commons/close');
	}
}
