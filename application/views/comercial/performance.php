<style>
  #sortable1, #sortable2 {
    border: 5px solid #eee;
    width: 250px;
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
        $('#sortable1').append($(item));
      }else{
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
                            <!-- <input type="date" class="datepicker" id='dt1' name='dt1'> -->
                            <select name="mes_desde">
                              <option value="01">Enero</option>
                              <option value="02">Febrero</option>
                              <option value="03">Marzo</option>
                              <option value="04">Abril</option>
                              <option value="05">Mayo</option>
                              <option value="06">Junio</option>
                              <option value="07">Julio</option>
                              <option value="08">Agosto</option>
                              <option value="09">Septiembre</option>
                              <option value="10">Octubre</option>
                              <option value="11">Noviembre</option>
                              <option value="12">Diciembre</option>
                            </select>
                            
                        <label for='dt1'><i class="zmdi zmdi-calendar"></i>&nbsp;Desde</label>
                        </div>
                        <div class="input-field col l1">
                        <select name="anho_desde">
                              <option value="2007">2007</option>
                              <option value="2008">2008</option>
                              <option value="2009">2009</option>
                              <option value="2010">2010</option>
                              <option value="2011">2011</option>
                              <option value="2012">2012</option>
                              <option value="2013">2013</option>
                              <option value="2014">2014</option>
                              <option value="2015">2015</option>
                              <option value="2016">2016</option>
                              <option value="2017">2017</option>
                            </select>
                        </div>
                        <div class="input-field col l1">
                            <!-- <input type="date" class="datepicker" id='dt1' name='dt1'> -->
                            <select name="mes_hasta">
                              <option value="01">Enero</option>
                              <option value="02">Febrero</option>
                              <option value="03">Marzo</option>
                              <option value="04">Abril</option>
                              <option value="05">Mayo</option>
                              <option value="06">Junio</option>
                              <option value="07">Julio</option>
                              <option value="08">Agosto</option>
                              <option value="09">Septiembre</option>
                              <option value="10">Octubre</option>
                              <option value="11">Noviembre</option>
                              <option value="12">Diciembre</option>
                            </select>
                            
                        <label for='dt1'><i class="zmdi zmdi-calendar"></i>&nbsp;hasta</label>
                        </div>
                        <div class="input-field col l1">
                        <select name="anho_hasta">
                              <option value="2007">2007</option>
                              <option value="2008">2008</option>
                              <option value="2009">2009</option>
                              <option value="2010">2010</option>
                              <option value="2011">2011</option>
                              <option value="2012">2012</option>
                              <option value="2013">2013</option>
                              <option value="2014">2014</option>
                              <option value="2015">2015</option>
                              <option value="2016">2016</option>
                              <option value="2017" selected>2017</option>
                            </select>
                        </div>
                    </div>
                    <div class="box col l12">

                        <div class="input-field  col l2 s12"><label>Consultores:</label><input type="hidden" id='contultores_sel' name = 'contultores_sel' ></div>

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

                                </ul>
                            </div>
                          </div>
                        </div>
                        <div class="col l12" align="center"> 
                          <div class="row">
                            
                          
                            <button onclick="javascript:ir('<?=base_url()?>performance/relatorio')" class="btn waves-effect waves-teal"><i class="zmdi zmdi-format-list-bulleted"></i> Relatorio</button> 
                            <button onclick="javascript:ir('<?=base_url()?>performance/grafico')" class="btn waves-effect waves-teal "><i class="zmdi zmdi-developer-board"></i> Gráfico</button> 
                            <button onclick="javascript:ir('<?=base_url()?>performance/pizza')" class="btn waves-effect waves-teal "><i class="zmdi zmdi-pizza"></i> Pizza</button>
                          </div>
                        </div>
                    </div>
                </FORM>
                <br><br>

                <?php 
                  if (isset($ganancia)){
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