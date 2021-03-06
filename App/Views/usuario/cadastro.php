<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Cadastro de Usuário</h3>
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

            <form action="http://<?php echo APP_HOST; ?>/usuario/salvar" method="post">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control"  name="nome"  value="<?php echo $Sessao::retornaValorFormulario('nome'); ?>"  pattern="[A-Za-zÀ-ú ]{0,}"
                           title="Use somente letras. Não use caracteres especiais ou números." required autofocus>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="cpf" id="cpf" maxlength="14" pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}"  class="form-control" placeholder="000.000.000-00" name="cpf" placeholder="" value="<?php echo $Sessao::retornaValorFormulario('cpf'); ?>" required oninvalid="this.setCustomValidity('Este campo deve estar preenchido e atender ao padrão exigido: 000.000.000-00')" onchange="try{setCustomValidity('')}catch(e){}" onkeydown="javascript: fMasc( this, mCPF );">
                </div>
                <div class="form-group">
                    <label for="usuario">Usuário:</label>
                    <input type="usuario" class="form-control" name="usuario"  value="<?php echo $Sessao::retornaValorFormulario('usuario'); ?>"
                           required autofocus>
                </div>

                <div class = "form-row">
                  <div class="form-group col-md-6">
                      <label for="senha">Senha:</label>
                      <input type="password" class="form-control" name="senha"  value="<?php echo $Sessao::retornaValorFormulario('senha'); ?>" required oninvalid="this.setCustomValidity('Este é um campo obrigatório')" onchange="try{setCustomValidity('')}catch(e){}">
                  </div>
                  <div class="form-group col-md-6">
                      <label for="tpusuario">Tipo Usuário:</label>
                      <select class="form-control" name= "tpusuario" value="" required>
                          <option  name="tpusuario" value="">Selecione um Tipo de Usuário</option>
                          <option  name="tpusuario" value="Administrador">Administrador</option>
                          <option  name="tpusuario" value="Padrao">Padrão</option>
                          <!--<option  name="tpusuario" value="Financeiro">Financeiro</option>-->
                      </select>
                  </div>

                </div>
                <hr>
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="http://<?php echo APP_HOST; ?>/home/" class="btn btn-outline-danger">Cancelar</a>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>
