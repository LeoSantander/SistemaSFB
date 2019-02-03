    <h5>Dados Cadastrais</h5>
    <?php
      //echo "TESTANDO: ".$viewVar['associado']->ID_Associado;
      //var_dump($viewVar['associado']);
    ?>

    <strong>Nome:               </strong> <?php if (isset($viewVar['associado']->NM_Associado)) echo $viewVar['associado']->NM_Associado; else echo " Não Informado"; ?>  <br>
    <strong>RG:                 </strong> <?php if (isset($viewVar['associado']->RG)) echo $viewVar['associado']->RG; else echo " Não Informado";?>            <br>
    <strong>CPF:                </strong> <?php if (isset($viewVar['associado']->CPF)) echo $viewVar['associado']->CPF; else echo " Não Informado"; ?>           <br>
    <strong>Data Nascimento:    </strong> <?php if (isset($viewVar['associado']->DT_Nascimento)) echo date("d/m/Y", strtotime($viewVar['associado']->DT_Nascimento)); else echo " Não Informado"; ?> <br>
    <strong>Data Associação:    </strong> <?php if (isset($viewVar['associado']->DT_Associacao)) echo date("d/m/Y",strtotime($viewVar['associado']->DT_Associacao)); else echo " Não Informado"; ?> <br>
    <strong>Local de Trabalho:  </strong> <?php echo $viewVar['associado']->CD_Local_Trabalho.
                                               ' - '.$viewVar['associado']->NM_Fantasia; ?>   <br>
    <strong>Cargo:              </strong> <?php if ($viewVar['associado']->Cargo == '') echo "Não Informado"; else echo $viewVar['associado']->Cargo;   ?>         <br>
    <strong>Salário Base:       </strong> <?php echo $viewVar['associado']->VL_Salario; ?>    <br>
    <strong>Número de registro: </strong> <?php if ($viewVar['associado']->NO_Registro == '') echo "Não Informado"; else echo $viewVar['associado']->NO_Registro; ?>   <br>
    <strong>Situação:           </strong> <?php echo $viewVar['associado']->Situacao; ?>  <br><br>

    <h5>Endereço:</h5>
    <strong>Endereço:    </strong> <?php echo $viewVar['associado']->NM_Rua.
                                         ",<strong> Número: </strong>".$viewVar['associado']->NO_Endereco.
                                         " - ".$viewVar['associado']->NM_Bairro.
                                         " - ".$viewVar['associado']->CEP ?>       <br>
    <strong>Cidade:      </strong> <?php echo $viewVar['associado']->NM_Cidade; ?> <br>
    <strong>Complemento: </strong> <?php echo $viewVar['associado']->Comp; ?>  <br><br>

    <h5>Contato:</h5>
    <strong>Telefone: </strong> <?php if ($viewVar['associado']->Telefone == '') echo "Não Informado"; else echo $viewVar['associado']->Telefone; ?><br>
    <strong>Celular:  </strong> <?php if ($viewVar['associado']->Celular == '') echo "Não Informado"; else echo $viewVar['associado']->Celular; ?><br>
    <strong>Email:    </strong> <?php echo $viewVar['associado']->Email; ?><br><br>
    <?php
      if(count($viewVar['convenios'])){
    ?>
    <br>
    <h5>Convênios</h5>
    <table class="table-striped">
      <thead>
      <tr>
        <td><strong>Convênio</strong></td>
        <td><strong>Empresa</strong></td>
        <td><strong>Dia do Vencimento</strong></td>
      </tr>
      </thead>
      <?php
      foreach ($viewVar['convenios'] as $convenios) {?>
      <tr>
        <td width="20%"><?php echo $convenios->NM_Convenio;?></td>
        <td width="20%"><?php echo $convenios->NM_Empresa;?></td>
        <td width="20%"><?php echo $convenios->Dia_Vencimento;?></td>
      </tr>
    <?php }?>
    </table>
    <?php }?>

    <?php
      if(count($viewVar['listarDependentes'])){
    ?><br>
        <h5>Dependentes Relacionados:</h5>
        <table>
          <tr>
            <td><strong>Nome</strong></td>
            <td><strong>Grau</strong></td>
          </tr>
          <?php
          foreach ($viewVar['listarDependentes'] as $dependentes) {?>
          <tr>
            <td width="80%"><?php echo $dependentes->NM_Dependente;?></td>
            <td width="20%"><?php echo $dependentes->NM_Grau;?></td>
          </tr>
        <?php }?>
        </table>
    <?php }?>
