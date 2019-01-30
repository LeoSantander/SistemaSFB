<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <h3>Editar Dependente</h3>
            <hr>

            <?php if($Sessao::retornaMensagem()){//Retorna mensagem de erro?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
                    <?php echo $Sessao::retornaMensagem(); ?>
                </div>
            <?php }?>

            <?php if($Sessao::retornaSucesso()){//Retorna mensagem de sucesso?>
                <div class="alert alert-success" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <?php echo $Sessao::retornaSucesso(); ?>
                </div>
            <?php }?>

            <form action="http://<?php echo APP_HOST; ?>/dependente/atualizar" method="post">
                <input type="hidden" name="id" value="<?php echo $viewVar['dependente']->ID_Dependente?>">

                <div class="form-group">
                    <label for="nome">Nome Completo:</label>
                    <input type="text" class="form-control" name="nome" placeholder="Nome Completo" pattern="[A-Za-zÀ-ú ]{0,}"
                           title="Use somente letras. Não use caracteres especiais ou números." value="<?php echo $viewVar['dependente']->NM_Dependente?>"
                           required>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="rg">RG:</label>
                        <input type="rg" class="form-control" name="rg" placeholder="000000000" maxlength="9" pattern="[0-9]{8}[0-9xX]{1}"
                               title="Digite somente números com 9 digitos" value="<?php echo $viewVar['dependente']->RG?>" required >
                    </div>

                    <div class="form-group col-md-6">
                        <label for="cpf">CPF:</label>
                        <input type="cpf" id="cpf" maxlength="14" pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}"  class="form-control"
                               placeholder="000.000.000-00" name="cpf" placeholder="" value="<?php echo $viewVar['dependente']->CPF?>" required oninvalid="this.setCustomValidity('Este campo deve estar preenchido e atender ao padrão exigido: 000.000.000-00')" onchange="try{setCustomValidity('')}catch(e){}" onkeydown="javascript: fMasc( this, mCPF );">
                    </div>
                </div>

                <div class="form-group">
                    <label for="dataNasc">Data de Nascimento:</label>
                    <input type="date" id="dataNasc" name="dataNasc" class="form-control" value="<?php echo $viewVar['dependente']->DT_Nascimento?>" required>
                </div>

                <div class="form-row">
                  <label for="check">Convênios Aderidos:</label>
                </div>
                <div class="table table-responsive">
                <table class="table table-bordered table-hover">
                  <thead class="thead-light">
                      <tr align="center">
                          <th scope="col">Convenio</th>
                          <th scope="col">Situação</th>
                          <th width="25%" scope="col">Ações</th>
                      </tr>
                  </thead>
                  <tbody>
                <?php $i=0;$teste=0;
                //var_dump($viewVar['ConvenioAssociado']);
                foreach($viewVar['listarConvenios'] as $convenios){ ?>
                <div class="form-row">
                  <div class="form-check">
                      <?php
                      foreach($viewVar['ConvenioDependentes'] as $convenioAssoc){
                          if($convenios->ID_Convenio == $convenioAssoc->ID_Convenio){
                              $teste = $convenioAssoc->ID_Convenio;
                              $idRelacao = $convenioAssoc->ID_convenio_associado;
                       } }?>
                  </div>
                  <tr>
                      <td>
                        <?php echo $convenios->NM_Convenio;?>
                      </td>
                      <td>
                        <?php if($convenios->ID_Convenio == $teste)echo "Aderido"; else echo "Não Aderido";?>
                      </td>
                      <td>
                        <?php if($convenios->ID_Convenio == $teste){?>
                          <a class="btn btn-danger btn-sm" href="http://<?php echo APP_HOST;?>/dependente/desvincularConvenio/<?php echo $idRelacao;?>">Desvincular</a>
                        <?php } else { ?>
                          <a class="btn btn-success" href="http://<?php echo APP_HOST;?>/dependente/aderirConvenio/<?php echo $convenios->ID_Convenio;?>/<?php echo $viewVar['dependente']->ID_Dependente?>">Aderir</button>
                        <?php } ?>
                      </td>
                    </tr>
                </div>
                <?php } ?>
              </tbody>
               </table>
               </div>

                <br><h5>Dados do Associado</h5><hr>

                <div class="form-row">
                    <div class="form-group col-md-7">
                        <label for="associado">Associado:</label>
                        <input list="list-associados" id="associado" name="associado" class="form-control" value="<?php foreach($viewVar['listarAssociados'] as $associado){if($associado->ID_Associado == $viewVar['dependente']->ID_Associado){echo $associado->NM_Associado;}}?>" onfocus="this.value='';" placeholder="Digite ou Selecione um Associado" required autocomplete="off">
                        <input type="hidden" name="idAssociado" id="idAssociado" value="<?php echo $viewVar['dependente']->ID_Associado?>">
                        <datalist id="list-associados">
                        <select >
                            <?php foreach($viewVar['listarAssociados'] as $associado){?>
                                <option data-id="<?php echo $associado->ID_Associado;?>" value="<?php echo $associado->NM_Associado;?> - <?php echo $associado->ID_Associado;?>"></option>
                            <?php } ?>
                        </select>
                        </datalist>
                    </div>

                    <div class="form-group col-md-5">
                        <label for="grau">Grau de Dependência:</label>
                        <select class="form-control" name="grau" value="<?php echo $Sessao::retornaValorFormulario('grau'); ?>" required>
                            <option name="grau" value="">Selecione um Grau</option>

                            <?php if($viewVar['dependente']->NM_Grau == "Filho(a)"){?>
                                <option selected="selected" name="grau" value="<?php echo $viewVar['dependente']->NM_Grau;?>"><?php echo $viewVar['dependente']->NM_Grau;?></option>
                                <option name="grau" value="Cônjuge">Cônjuge</option>
                            <?php }
                                else if($viewVar['dependente']->NM_Grau == "Cônjuge"){?>
                                <option selected="selected" name="grau" value="<?php echo $viewVar['dependente']->NM_Grau;?>"><?php echo $viewVar['dependente']->NM_Grau;?></option>
                                <option name="grau" value="Filho(a)">Filho(a)</option>
                            <?php }
                             else{?>
                                <option name="grau" value="Filho(a)">Filho(a)</option>
                                <option name="grau" value="Cônjuge">Cônjuge</option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <a href="http://<?php echo APP_HOST; ?>/home/" class="btn btn-outline-danger">Cancelar</a>
                </div>
            </form>

        </div>
        <div class="col-md-3"></div>
    </div>
</div>

<script>
$(document).ready(function() {
    $("input#associado").focusout(function(){
        var valor = $('input#associado').val();
        var teste = $('#list-associados [value="' + valor + '"]').data('id');
        document.getElementById("idAssociado").setAttribute('value', teste);
    });
});
</script>
