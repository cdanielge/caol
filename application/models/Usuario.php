<?php

/**
* Modelo clase usuario
*/
class Usuario extends CI_Model
{
  
  public function getUsuarios()
  {
    return $this->db->get('cao_usuario');
  }

  public function getUsuario($user, $pass)
  {
    $rs = $this->db->query("select * from cao_usuario where co_usuario = '$user' and ds_senha = '$pass'");
    if ($rs->num_rows()>0){
      return $rs->row();
    }else {
      return null;
    }
  }
}

?>