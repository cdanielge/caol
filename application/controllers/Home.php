<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index($pp='')
	{
        if(!$this->session->userdata('log_in')){		
            header("Location: ".base_url()."logout");
        }
        $data = array('titulo' => 'CAOL', 'pp'=>$pp);
        $this->load->view('/commons/head', $data);
        $this->load->view('/commons/nav');
        $this->load->view('/commons/header');
        $resultado = $this->usuario->getUsuarios();
        $data = array('consulta' => $resultado, );
        $this->load->view('/commons/main', $data);    
        $this->load->view('/commons/footer');
    
	}
}
