<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		//$this->session->sess_destroy();
		$user = $this->input->post('user');
		echo "". $this->input->post;
		$password = $this->input->post('password');
		$datos_session['log_in']=false;
		$userObj = null;
		$userObj = $this->usuario->getUsuario($user,$password);
		if ($userObj != null){
			$datos_session['user']=$user;
			$datos_session['id']=0;
			$datos_session['log_in']=true;
			$datos_session['nombre']= $userObj->no_usuario;

			$this->session->set_userdata($datos_session);
			echo 'USUARIO: ' . $userObj->no_usuario. '<br> PASS:' .$password;
			header("Location: ". base_url());
		}else {
			echo "datos". $user;
			//header("Location: ". base_url()."logout");
		}
		
	}
}
