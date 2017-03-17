<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
        if(!$this->session->userdata('log_in')){		
            header("Location: ".base_url()."logout");
        }

        $this->load->view('/commons/head');
        $this->load->view('/commons/nav');
        $this->load->view('/commons/header');
        $this->load->view('/commons/main');
        $this->load->view('/commons/footer');
        $this->load->view('/commons/scripts');
        $this->load->view('/commons/close');
	}
}
