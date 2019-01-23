    <h5>Dados Cadastrais</h5>
    <?php
      //echo "TESTANDO: ".$viewVar['associado']->ID_Associado;
      //var_dump($viewVar['associado']);
    ?>

    <strong>Nome:               </strong> <?php echo $viewVar['associado']->NM_Associado; ?>  <br>
    <strong>RG:                 </strong> <?php echo $viewVar['associado']->RG; ?>            <br>
    <strong>CPF:                </strong> <?php echo $viewVar['associado']->CPF; ?>           <br>
    <strong>Data Nascimento:    </strong> <?php echo $viewVar['associado']->DT_Nascimento; ?> <br>
    <strong>Data Associação:    </strong> <?php echo $viewVar['associado']->DT_Associacao; ?> <br>
    <strong>Local de Trabalho:  </strong> <?php echo $viewVar['associado']->CD_Local_Trabalho.
                                               ' - '.$viewVar['associado']->NM_Fantasia; ?>   <br>
    <strong>Cargo:              </strong> <?php echo $viewVar['associado']->Cargo; ?>         <br>
    <strong>Salário Base:       </strong> <?php echo $viewVar['associado']->VL_Salario; ?>    <br>
    <strong>Número de registro: </strong> <?php echo $viewVar['associado']->NO_Registro; ?>   <br>
    <strong>Situação:           </strong> <?php echo $viewVar['associado']->Situacao; ?>  <br><br>

    <h5>Endereço:</h5>
    <strong>Endereço:    </strong> <?php echo $viewVar['associado']->NM_Rua.
                                         ",<strong> Número: </strong>".$viewVar['associado']->NO_Endereco.
                                         " - ".$viewVar['associado']->NM_Bairro.
                                         " - ".$viewVar['associado']->CEP ?>       <br>
    <strong>Cidade:      </strong> <?php echo $viewVar['associado']->NM_Cidade; ?> <br>
    <strong>Complemento: </strong> <?php echo $viewVar['associado']->Comp; ?>  <br><br>

    <h5>Contato:</h5>
    <strong>Telefone: </strong> <?php echo $viewVar['associado']->Telefone; ?><br>
    <strong>Celular:  </strong> <?php echo $viewVar['associado']->Celular; ?><br>
    <strong>Email:    </strong> <?php echo $viewVar['associado']->Email; ?><br><br>


    <?php
      if(count($viewVar['listarDependentes'])){
    ?>
        <h5>Dependentes Relacionados:</h5>
        <?php
        foreach ($viewVar['listarDependentes'] as $dependentes) {?>
        <table>
          <tr>
            <td><strong>Nome</strong></td>
            <td><strong>Grau</strong></td>
          </tr>
          <tr>
            <td width="80%"><?php echo $dependentes->NM_Dependente;?></td>
            <td width="20%"><?php echo $dependentes->NM_Grau;?></td>
          </tr>
        </table>
      <?php }
        }
      ?>
