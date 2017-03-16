<?php

/**
* Modelo clase Performance
* Para manejar metodos relacionados con el desempeño comercial de los consultores y los clientes
*/
class Desempenho extends CI_Model
{

  // Método para consultar el desempemño del consultor
  public function getDesempenhoConsultor($consultor, $fecha1, $fecha2 )
  {

      $q = "select sum(valor-(valor*total_imp_inc/100)) as receita, 
               sum((valor-(valor*total_imp_inc/100))*(comissao_cn/100)) as comissao, 
               YEAR(data_emissao) as anho, 
               MONTH(data_emissao) as mes          
        from cao_fatura f inner join cao_os os on f.co_os = os.co_os            
        where co_usuario = '".$consultor."' and  data_emissao >= '".$fecha1."-01' and data_emissao <= '".$fecha2."-31' 
        group by YEAR(data_emissao) , MONTH(data_emissao);";
      
      $rs = $this->db->query($q);
      
      if ($rs->num_rows()>0){
        return $rs;
      }else {
        return null;
      }
  }

    public function getCostofijoConsultor($consultor)
  {
      $rs = $this->db->query("select brut_salario as salario
          from cao_salario
          where co_usuario = '".$consultor."' ");
      if ($rs->num_rows()>0){
        return $rs->row();
      }else {
        return null;
      }
  }



}

?>