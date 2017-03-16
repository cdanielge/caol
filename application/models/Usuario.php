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


  public function getConsultores()
  {
      $rs = $this->db->query("
        select * 
        from cao_usuario u 
        inner join permissao_sistema ps on  u.co_usuario = ps.co_usuario 
        where co_sistema=1 and in_ativo='S' and co_tipo_usuario in (0,1,2)");
      if ($rs->num_rows()>0){
        return $rs;
      }else {
        return null;
      }
  }
}

?>