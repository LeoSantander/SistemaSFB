<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <h3>Editar Convênio</h3>
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

            <form action="http://<?php echo APP_HOST; ?>/convenio/atualizar" method="post">
                <input type="hidden" name="id" value="<?php echo $viewVar['convenio']->ID_Convenio?>">

                <div class="form-group">
                    <label for="nome">Nome do Convenio:</label>
                    <input type="text" class="form-control" name="convenio" placeholder="Nome Completo" pattern="[A-Za-zÀ-ú ]{0,}"
                           title="Use somente letras. Não use caracteres especiais ou números." value="<?php echo $viewVar['convenio']->NM_Convenio?>"
                           required autofocus>
                </div>

                <div class="form-group">
                    <label for="nome">Nome da Empresa:</label>
                    <input type="text" class="form-control" name="empresa" placeholder="Nome Completo" pattern="[A-Za-zÀ-ú ]{0,}"
                           title="Use somente letras. Não use caracteres especiais ou números." value="<?php echo $viewVar['convenio']->NM_Empresa?>"
                           required autofocus>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="valor">Valor para Associados:</label>
                        <input type="tel" class="form-control" name="valor" maxlength="15" placeholder="$" value="<?php echo $viewVar['convenio']->VL_Convenio?>" onKeyPress="return(mMoeda(this,'.',',',event))"
                            title="Preencha de acordo com o que foi solicitado."required autofocus>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="valorDep">Valor para Dependentes:</label>
                        <input type="tel" class="form-control" name="valorDep" maxlength="15" placeholder="$" value="<?php echo $viewVar['convenio']->VL_Convenio_Dep?>" onKeyPress="return(mMoeda(this,'.',',',event))"
                            title="Preencha de acordo com o que foi solicitado." autofocus>
                    </div>
                </div>

                <div class = "form-row">
                      <div class="form-group col-md-6">
                          <label for="dataVenc">Dia de Vencimento:</label>
                          <select class="form-control" name= "dataVenc" required>
                              <option name= "teste" value="">Selecione dia</option>
                                  <?php for($i=0; $i<32; $i++){
                                      if($viewVar['convenio']->Dia_Vencimento == $i){?>
                                          <option selected="selected" name="dataVenc" value= "<?php echo $i;?>"><?php echo $i;?></option>
                                      <?php }
                                      else{?>
                                          <option name="dataVenc" value= "<?php echo $i;?>"><?php echo $i?></option>
                                  <?php } ?>
                              <?php } ?>
                          </select>
                       </div>
                       <div class="form-group col-md-6">
                            <label for="situacao">Situação Atual:</label>
                            <select name= "situacao" class="form-control" value="<?php echo $viewVar['convenio']->ST_Situacao?>" required>
                                 <option name="situacao" value="">Selecione</option>
                                 <option name="situacao" value="Ativo" selected >Ativo</option>
                                 <option name="situacao" value="Inativo">Inativo</option>
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
