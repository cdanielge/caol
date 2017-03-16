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
    font-size: 1.2em;
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
                <form action="<?=base_url()?>performance/relatorio" method="post">
                    <div class="box col l12">

                        <div class="input-field  col l2"><label>Periodo:</label></div>

                        <div class="input-field col l1">
                            <input type="date" class="datepicker" id='dt1' name='dt1'>
                        <label for='dt1'><i class="zmdi zmdi-calendar"></i>&nbsp;Desde</label>
                        </div>
                        <div class="input-field col l1">
                            <input type="date" class="datepicker" id='dt2'  name='dt2'>
                        <label for='dt2'><i class="zmdi zmdi-calendar"></i>&nbsp;Hasta</label>
                        </div>
                    </div>
                    <div class="box col l12">

                        <div class="input-field  col l2 s12"><label>Consultores:</label><input type="hidden" id='contultores_sel' name = 'contultores_sel' ></div>

                        <div class="input-field col l6 s12">
                            <div class="col l6 s12">

                              Elegir<br>
                            <ul id="sortable1" class="connectedSortable" >
                                <?php 
                                if (isset($consultores)){
                                    foreach ($consultores->result() as $row) {
                                    echo "<li class='item_lista' id='".$row->co_usuario."'  onclick  ='javascript:item_click(this);'>".$row->no_usuario." (".$row->co_usuario .")</li>";      
                                    }
                                }else{
                                  echo "<li class='item_lista' id='xxx'  onclick  ='javascript:item_click(this);'>LO SIENTO MARIO... la princesa está en otro castillo </li>";
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
                        <div class="col l12" align="center"> 
                            <button type="submit" class="waves-effect waves-teal btn-primary"><i class="zmdi zmdi-format-list-bulleted"></i> Relatorio</button> 
                            <button type="submit" class="waves-effect waves-teal btn-primary"><i class="zmdi zmdi-developer-board"></i> Gráfico</button> 
                            <button type="submit" class="waves-effect waves-teal btn-primary"><i class="zmdi zmdi-pizza"></i> Pizza</button>
                        </div>
                    </div>
                    
                </FORM>
                <br><br>

                <?php 

                  if (isset($ganancia)){

                    foreach ($ganancia as $key => $value) {
                      //echo  $key."====>>".var_dump($value)."<br>";
                      ?>

                      <table border="1" class="bordered striped">
                        <tr>
                          <th colspan="5"><?=$key?></th>
                        </tr>
                          <tr>
                            <th>Periodo</th>
                            <th>Ganancia Liquida</th>
                            <th>Costo fijo</th>                               
                            <th>Comisión</th>
                            <th>Lucro</td>
                          </tr>
                        <?php  foreach ($value as $value2) { 
                            if ($value2['periodo'] == 'SALDO'){
                              $fila = 'th';
                              $color = 'blue';
                            }else{
                              $fila = 'td';
                              $color = 'black';
                            }
                            if ( $value2['receita']-$value2['comissao']-$value2['costo'] <0 ){
                              $color='red';
                            }

                          ?>
                             <tr>
                               <<?=$fila?>><?= $value2['periodo'] ?></<?=$fila?>>
                               <<?=$fila?>>R$ <?=  number_format($value2['receita'],2) ?></<?=$fila?>>
                               <<?=$fila?>>R$ -<?= number_format($value2['costo'],2) ?></<?=$fila?>>                               
                               <<?=$fila?>>R$ -<?= number_format($value2['comissao'],2) ?></<?=$fila?>>
                               <<?=$fila?>><font color="<?=$color?>">R$ <?= number_format($value2['receita']-$value2['comissao']-$value2['costo'],2) ?></font></<?=$fila?>>
                             </tr>

                         <?php    
                          } ?>
                      </table>
                      <br><br>
                <?php

                    };
                  }

                 ?>

            </div>

            <div id="test-swipe-2" class="col s12 ">Fuera del alcance
                <?php 
                      echo "->". var_dump($dump);
                 ?>              

            </div>
        </div>
    </div>
    <!-- <hr> --><br><br><br><br><br><br>