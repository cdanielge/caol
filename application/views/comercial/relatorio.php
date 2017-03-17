 <?php
    foreach ($ganancia as $key => $value) {
      //echo  $key."====>>".var_dump($value)."<br>";
      ?>

      <table border="1" class="bordered striped responsive-table">
        <tr>
          <th colspan="5"><?=$key. "<br>" . $titulo?> </th>
        </tr>
          <tr>
            <th>Periodo</th>
            <th>Ganancia Liquida</th>
            <th>Costo fijo</th>
            <th>Comisión</th>
            <th>Lucro</td>
          </tr>
          <!-- FORMATEO DE CELDAS  -->
        <?php
          foreach ($value as $value2) {
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
          }
          ?>
      </table>
      <br><br>
<?php
    };
?>
