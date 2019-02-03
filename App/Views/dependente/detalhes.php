    <h5>Dados Cadastrais</h5>
    <?php
      //var_dump($viewVar['convenios']);
    ?>

    <strong>Nome:               </strong> <?php echo $viewVar['dependente']->NM_Dependente; ?>  <br>
    <strong>RG:                 </strong> <?php echo $viewVar['dependente']->RG; ?>            <br>
    <strong>CPF:                </strong> <?php echo $viewVar['dependente']->CPF; ?>           <br>
    <strong>Data Nascimento:    </strong> <?php echo $viewVar['dependente']->DT_Nascimento; ?> <br>

    <?php
      if(count($viewVar['convenios'])){
    ?>
    <br>
    <table class= "table-striped">
      <thead>
        <tr>
        <td><strong>Convenio</strong></td>
        <td><strong>Empresa</strong></td>
        <td><strong>Dia do Vencimento</strong></td>
      </tr>
      </thead>
      <?php
      foreach ($viewVar['convenios'] as $convenios) {?>
      <tbody>
      <tr>
        <td width="20%"><?php echo $convenios->NM_Convenio;?></td>
        <td width="20%"><?php echo $convenios->NM_Empresa;?></td>
        <td width="20%"><?php echo $convenios->Dia_Vencimento;?></td>
      </tr>
    </tbody>
    <?php }?>
    </table>
    <?php }?> <br>

        <h5>Associado:</h5>
        <table>
          <tr>
            <td><strong>Nome</strong></td>
            <td><strong>Grau</strong></td>
          </tr>
          <tr>
            <td width="80%"><?php echo $viewVar['dependente']->NM_Associado;?></td>
            <td width="20%"><?php echo $viewVar['dependente']->NM_Grau;?></td>
          </tr>
        </table>
