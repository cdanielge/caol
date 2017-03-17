<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Performance extends CI_Controller {

	public function index()
	{
        if(!$this->session->userdata('log_in')){		
            header("Location: ".base_url()."logout");
        }

        $this->load->view('/commons/head');
        $this->load->view('/commons/nav');
        $this->load->view('/commons/header');
        $consultores = $this->usuario->getConsultores();
        $data['consultores'] = $consultores;
        
        $this->load->view('/comercial/performance', $data);    
        $this->load->view('/commons/footer');
        $this->load->view('/commons/scripts');
        $this->load->view('/commons/close');    
	}

    public function relatorio()
    {
        if(!$this->session->userdata('log_in')){        
            header("Location: ".base_url()."logout");
        }
        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' );
        $consultores_in= explode(',', $this->input->post('contultores_sel'));
        $f1=$this->input->post('anho_desde').'-'.$this->input->post('mes_desde'); 
        $f2=$this->input->post('anho_hasta').'-'.$this->input->post('mes_hasta'); 
        $titulo = "desde ".$meses[$this->input->post('mes_desde')-1]. " de ". $this->input->post('anho_desde'). " a ". $meses[$this->input->post('mes_hasta')-1]. " de ". $this->input->post('anho_hasta');
        $desempenho=null;
        $ganancia=null;
        foreach ($consultores_in as  $consultor) {

            $ganancia[$consultor] =[];
            $desempenho = $this->desempenho->getDesempenhoConsultor($consultor, $f1, $f2 );
            $costo = $this->desempenho->getCostofijoConsultor($consultor);
            $total=null;
            $total['receita']=0;
            $total['comissao']=0;
            $total['costo']=0;
            $total['periodo']='SALDO';
            if ($desempenho){
                foreach ($desempenho->result() as $value) {
                    array_push($ganancia[$consultor],  array('receita' => $value->receita, 'comissao'=>$value->comissao, 'periodo' => $meses[$value->mes-1].' de '. $value->anho, 'costo' => $costo->salario ));
                    $total['receita']= $total['receita']+ $value->receita;
                    $total['comissao']= $total['comissao']+ $value->comissao;
                    $total['costo']= $total['costo']+ $costo->salario;
                }                
            }
            array_push($ganancia[$consultor], $total);
            
        }
        
        $this->load->view('/commons/head');
        $this->load->view('/commons/nav');
        $this->load->view('/commons/header');
        
        $consultores = $this->usuario->getConsultores();
        $data['consultores'] = $consultores;
        $data['ganancia'] = $ganancia;
        $data['titulo'] = $titulo;
        $data['dump']='$a';
        $this->load->view('/comercial/performance', $data);    
        $this->load->view('/commons/footer');
        $this->load->view('/commons/scripts');
        $this->load->view('/commons/close');
    
    }

        public function pizza()
    {
        if(!$this->session->userdata('log_in')){        
            header("Location: ".base_url()."logout");
        }
        
        $consultores_in= explode(',', $this->input->post('contultores_sel'));
        $f1=$this->input->post('anho_desde').'-'.$this->input->post('mes_desde'); 
        $f2=$this->input->post('anho_hasta').'-'.$this->input->post('mes_hasta'); 
        $titulo = "desde ".$meses[$this->input->post('mes_desde')-1]. " de ". $this->input->post('anho_desde'). " a ". $meses[$this->input->post('mes_hasta')-1]. " de ". $this->input->post('anho_hasta');

        $desempenho=null;
        $ganancia=[];
        foreach ($consultores_in as  $consultor) {
            $desempenho = $this->desempenho->getDesempenhoConsultor($consultor, $f1, $f2 );
            $total=null;
            $total['receita']=0;
            
            if ($desempenho){
                foreach ($desempenho->result() as $value) {
                    $total['receita']= $total['receita']+ $value->receita;
                }                
            }
            array_push($ganancia, array($consultor, $total['receita']));
            
        }

        $this->load->view('/commons/head');
        $this->load->view('/commons/nav');
        $this->load->view('/commons/header');
        
        $consultores = $this->usuario->getConsultores();
        $data['consultores'] = $consultores;
        $data['pizza'] = $ganancia;
        $data['titulo'] = $titulo;
        $this->load->view('/comercial/performance', $data);    
        $this->load->view('/commons/footer');
        $this->load->view('/commons/scripts');
        $this->load->view('/comercial/pizza');
        $this->load->view('/commons/close');
    
    }

    public function grafico()
    {
        if(!$this->session->userdata('log_in')){        
            header("Location: ".base_url()."logout");
        }
        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' );
        $consultores_in= explode(',', $this->input->post('contultores_sel'));
        $f1=$this->input->post('anho_desde').'-'.$this->input->post('mes_desde'); 
        $f2=$this->input->post('anho_hasta').'-'.$this->input->post('mes_hasta');
        $titulo = "desde ".$meses[$this->input->post('mes_desde')-1]. " de ". $this->input->post('anho_desde'). " a ". $meses[$this->input->post('mes_hasta')-1]. " de ". $this->input->post('anho_hasta');
        $desempenho=null;
        $ganancia=null;
        $periodos = null;
        $costos = 0;
        foreach ($consultores_in as  $consultor) {

            $ganancia[$consultor] =[];

            $desempenho = $this->desempenho->getDesempenhoConsultor($consultor, $f1, $f2 );
            $costo = $this->desempenho->getCostofijoConsultor($consultor);
            if ($costo){
                $costos = $costos + $costo->salario;    
            }
            
            if ($desempenho){
                foreach ($desempenho->result() as $value) {
                    $ganancia[$consultor][$meses[$value->mes-1].' de '. $value->anho] = $value->receita;
                    $periodos[$meses[$value->mes-1].' de '. $value->anho]=1;
                }                
            }
        }

        $costos = $costos / count($consultores_in);
        
        $this->load->view('/commons/head');
        $this->load->view('/commons/nav');
        $this->load->view('/commons/header');
        
        $consultores = $this->usuario->getConsultores();
        $data['consultores'] = $consultores;
        $data['grafico'] = $ganancia;
        $data['titulo'] = $titulo;
        $data['periodos']=$periodos;
        $data['costos']=$costos;
        $this->load->view('/comercial/performance', $data);    
        $this->load->view('/commons/footer');
        $this->load->view('/commons/scripts');
        $this->load->view('/comercial/grafico');
        $this->load->view('/commons/close');
    
    }
}
