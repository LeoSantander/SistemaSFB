<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Cadastro de Convenios</h3>
            <hr>

            <?php if($Sessao::retornaMensagem()){//Retorna mensagem de erro?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <?php echo $Sessao::retornaMensagem(); ?>
                </div>
            <?php }?>

            <?php if($Sessao::retornaSucesso()){//Retorna mensagem Associado cadastrado com sucesso!'?>
                <div class="alert alert-success" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <?php echo $Sessao::retornaSucesso()?>
                </div>
            <?php }?>

            <form action="http://<?php echo APP_HOST; ?>/convenio/salvar" method="post">

                <div class="form-group">
                    <label for="nome">Nome do Convenio:</label>
                    <input type="text" class="form-control" name="convenio" placeholder="Nome Completo" pattern="[A-Za-zÀ-ú ]{0,}"
                           title="Use somente letras. Não use caracteres especiais ou números." value="<?php echo $Sessao::retornaValorFormulario('convenio'); ?>"
                           required autofocus>
                </div>

                <div class="form-group">
                    <label for="nome">Nome da Empresa:</label>
                    <input type="text" class="form-control" name="empresa" placeholder="Nome da Empresa" pattern="[A-Za-zÀ-ú ]{0,}"
                           title="Use somente letras. Não use caracteres especiais ou números." value="<?php echo $Sessao::retornaValorFormulario('empresa'); ?>"
                           required autofocus>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="valor">Valor para Associados:</label>
                        <input type="tel" class="form-control" name="valor" maxlength="15" placeholder="$" value="<?php echo $Sessao::retornaValorFormulario('valor'); ?>" onKeyPress="return(mMoeda(this,'.',',',event))"
                            title="Preencha de acordo com o que foi solicitado."required autofocus>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="valorDep">Valor para Dependentes:</label>
                        <input type="tel" class="form-control" name="valorDep" maxlength="15" placeholder="$" value="<?php echo $Sessao::retornaValorFormulario('valorDep'); ?>" onKeyPress="return(mMoeda(this,'.',',',event))"
                            title="Preencha de acordo com o que foi solicitado." autofocus>
                    </div>
                </div>

                <div class = "form-row">
                      <div class="form-group col-md-6">
                          <label for="dataVenc">Dia de Vencimento:</label>
                          <select required class="form-control" name= "dataVenc" value="<?php echo $Sessao::retornaValorFormulario('dataVenc'); ?>">
                          <option name= "dataVenc" value="">Selecione um Dia</option>

                          <?php for ($numero=1; $numero < 32; $numero++) {?>
                                <option name = "dataVenc" value= "<?php echo $numero?>"><?php echo $numero?></option>
                              <?php } ?>
                          </select>
                      </div>

                      <div class="form-group col-md-6">
                              <label for="situacao">Situação Atual:</label>
                              <select name= "situacao" class="form-control" value="<?php echo $Sessao::retornaValorFormulario('situacao'); ?>" required>
                                  <option name="situacao" value="">Selecione</option>
                                  <option name="situacao" value="Ativo" selected >Ativo</option>
                                  <option name="situacao" value="Inativo">Inativo</option>
                              </select>
                      </div>
                </div>
                <hr>
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="http://<?php echo APP_HOST; ?>/home/" class="btn btn-outline-danger">Cancelar</a>
            </form>

    </div>
</div>
</div>
