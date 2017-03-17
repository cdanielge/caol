<style>
  #sortable1, #sortable2 {
    border: 5px solid #eee;
    width: 240px;
    min-height: 20px;

    list-style-type: none;
    margin: 0;
    padding: 5px 0 0 0;
    float: left;
    margin-right: 10px;
  }
  #sortable1 li, #sortable2 li {
    margin: 0 5px 5px 5px;
    padding: 5px;
    background-color: #ccc;
/*    width: auto;*/
  }
  </style>

<script type="text/javascript">

    function item_click(item){      
      var padre = $(item).parent().attr('id');
      if (padre == 'sortable2'){
        a = 1
        $('#sortable1 li').each(function(indice, elemento) {
          console.log($(elemento).attr('id') + '==' + $(item).attr('id'));
          if ($(elemento).attr('id') == $(item).attr('id')){ 
            $(item).remove(); 
            a = 0;
          }
        });
        if (a){$('#sortable1').append($(item));}        
      }else{
        $('#sortable2 li').each(function(indice, elemento) {
          if ($(elemento).attr('id') == $(item).attr('id')){ $(elemento).remove(); };
        });
        $('#sortable2').append($(item));
      }
      listar_consultores();
    }

    function listar_consultores(){
      var a = [];
      $('#sortable2 li').each(function(indice, elemento) {
        a.push($(elemento).attr('id'));
      }); 
      $('#contultores_sel').val(a);
    }

    function enlazar_listas(){
      $( "#sortable1, #sortable2" ).sortable({
        connectWith: ".connectedSortable"
      }).disableSelection();
      listar_consultores();
    }

    function ir(controlador){     
        var forma = document.getElementById('forma');
        forma.action = controlador;
        forma.submit();
    }

  </script>

   <!-- Main Content -->
    <div class="row">
        <div class="col l12" >
            <ul id="tabs-swipe-demo" class="tabs">
                <li class="tab col s3"><a href="#test-swipe-1">Por Consultor</a></li>
                <li class="tab col s3"><a href="#test-swipe-2">Por Cliente</a></li>
            </ul>
            <div id="test-swipe-1" class="col s12 ">

                <br>
                <form action="" method="post" id='forma'>
                    <div class="box col l12">
                        <div class="input-field  col l2"><label>Periodo:</label></div>

                        <div class="input-field col l1">
                            <select name="mes_desde" id="mes_desde">
                              <?php 
                                if (isset($parametros)){ $p = $parametros['mes_desde']; }
                                foreach ($meses as $num => $nombre) {
                                  $sel = ($num+1 == $p )?'selected':'';
                                  echo "<option value='" . ($num +1) . "' $sel>" . $nombre . "</option>";
                                } 
                              ?>
                            </select>
                            
                        <label for='mes_desde'><i class="zmdi zmdi-calendar"></i>&nbsp;Desde</label>
                        </div>
                        <div class="input-field col l1">
                        <select name="anho_desde">
                              <?php
                                if (isset($parametros)){ $p = $parametros['anho_desde']; } 
                                for ($i=10; $i >= 0; $i--) { 
                                  $y = date("Y")-$i;
                                   $sel = ($y == $p )?'selected':'';
                                  echo "<option value='$y' $sel>$y</option>";
                                }
                              ?>

                            </select>
                        </div>
                        <div class="input-field col l1">
                            <select name="mes_hasta" id="mes_hasta">
                              <?php 
                                if (isset($parametros)){ $p = $parametros['mes_hasta']; }
                                foreach ($meses as $num => $nombre) {
                                  $sel = ($num+1 == $p )?'selected':'';
                                  echo "<option value='" . ($num +1) . "' $sel>" . $nombre . "</option>";
                                } 
                              ?>

                            </select>
                            
                        <label for='mes_hasta'><i class="zmdi zmdi-calendar"></i>&nbsp;hasta</label>
                        </div>
                        <div class="input-field col l1">

                        <select name="anho_hasta">
                              <?php                                 
                                if (isset($parametros)){ $p = $parametros['anho_hasta']; } 
                                for ($i=0; $i <= 10; $i++) { 
                                  $y = date("Y")-$i;
                                  $sel = ($y == $p )?'selected':'';
                                  echo "<option value='$y' $sel>$y</option>";
                                }
                              ?>
                            </select>
                        </div>
                    </div>
                    <div class="box col l12">

                        <div class="input-field  col l2 s12"><label>Consultores:</label>
                        <input type="hidden" id='contultores_sel' name = 'contultores_sel' value="<?php if (isset($parametros)){ echo $parametros['contultores_sel']; }?>" ></div>

                        <div class="input-field col l6 s12">
                          <div class="row">
                            
                          
                            <div class="col l6 s12">

                              Elegir<br>
                            <ul id="sortable1" class="connectedSortable" >
                                <?php 
                                if (isset($consultores)){
                                    foreach ($consultores->result() as $row) {
                                    echo "<li class='item_lista' id='".$row->co_usuario."'  onclick  ='javascript:item_click(this);'>".$row->no_usuario." (".$row->co_usuario .")</li>";      
                                    }
                                }else{
                                  echo "No hay consultores configurados";
                                }
                                ?>
                            </ul>
                            </div>
                            <div class="co l6 s12">
                              Seleccionado(s)<br>
                                <ul id="sortable2" class="connectedSortable" >
                                <?php 
                                if (isset($parametros)){
                                    $con = explode(",", $parametros['contultores_sel']);
                                    foreach ($con as $row) {
                                    echo "<li class='item_lista' id='".$row."'  onclick  ='javascript:item_click(this);'>".$row." </li>";      
                                    }
                                }
                                ?>
                                </ul>
                            </div>
                          </div>
                        </div>
                        <div class="col l12" align="center"> 
                          <div class="row">
                            
                          
                            <button onclick="javascript:ir('<?=base_url()?>performance/relatorio')" class="btn waves-effect waves-teal"><i class="zmdi zmdi-format-list-bulleted"></i> Reporte</button> 
                            <button onclick="javascript:ir('<?=base_url()?>performance/grafico')" class="btn waves-effect waves-teal "><i class="zmdi zmdi-developer-board"></i> Gráfico</button> 
                            <button onclick="javascript:ir('<?=base_url()?>performance/pizza')" class="btn waves-effect waves-teal "><i class="zmdi zmdi-pizza"></i> Pizza</button>
                          </div>
                        </div>
                    </div>
                </FORM>
                <br><br>

                <?php 
                  if (isset($ganancia) && count($ganancia) > 0){
                      $this->load->view('comercial/relatorio');
                  };
                 ?>
                <?php 
                  if (isset($pizza)){
                      echo '<div class="col l8 push-l2 " ><div id="pizza_gra"  ></div></div>';                      
                  };
                 ?>

                <?php 
                  if (isset($grafico)){
                      echo '<div class="col l8 push-l2 " ><div id="grafico_gra" ></div></div>';                      
                  };
                 ?>

            </div>

            <div id="test-swipe-2" class="col s12 ">Fuera del alcance

            
   
            </div>
        </div>
    </div>