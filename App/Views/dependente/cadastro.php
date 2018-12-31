<?php
//Solicitando login para acessar o sistema
    if(!($Sessao::retornaUsuario())){
        $Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
        $this->redirect('login/');
    }
?>

<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Cadastro de Dependente</h3>
            <hr>

            <?php if($Sessao::retornaMensagem()){//Retorna mensagem de erro?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <?php echo $Sessao::retornaMensagem(); ?>
                </div>
            <?php }?>
           
            <?php if($Sessao::retornaSucesso()){//Retorna mensagem 'Estado cadastrado com sucesso!'?>
                <div class="alert alert-success" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <?php echo $Sessao::retornaSucesso()?>
                </div>
            <?php }?>
            
            <form action="http://<?php echo APP_HOST; ?>/dependente/salvar" method="post">
                <div class="form-group">
                    <label for="nome">Nome Completo:</label>
                    <input type="text" class="form-control"  name="nome" placeholder="Nome Completo" value="" 
                           required autofocus>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="rg">RG:</label>
                        <input type="rg" id="rg" maxlength="12" pattern="[0-9]{0,}" title="Digite somente números" class="form-control" placeholder="Somente números" name="rg" placeholder="" value="<?php echo $Sessao::retornaValorFormulario('rg'); ?>" required >
                    </div>

                    <div class="form-group col-md-6">
                        <label for="cpf">CPF:</label>
                        <input type="cpf" id="cpf" maxlength="14" pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}"  class="form-control" placeholder="000.000.000-00" name="cpf" placeholder="" value="<?php echo $Sessao::retornaValorFormulario('cpf'); ?>" required oninvalid="this.setCustomValidity('Este campo deve estar preenchido e atender ao padrão exigido: 000.000.000-00')" onchange="try{setCustomValidity('')}catch(e){}" onkeydown="javascript: fMasc( this, mCPF );">
                    </div>
                </div>

                <div class="form-group">
                    <label for="dataNasc">Data de Nascimento:</label>
                    <input type="date" name="dataNasc" class="form-control">
                </div>

                <br><h5>Dados do Associado</h5><hr>

                <div class="form-group">
                    <label for="associado">Associado:</label>
                    <select class="form-control" name="associado" value="">
                        <option name="associado">Selecione um Associado</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="grau">Grau de Dependência:</label>
                    <select class="form-control" name="grau" value="">
                        <option name="grau">Selecione um Grau de Dependência</option>
                        <option name="grau" value="Cônjuge">Cônjuge</option>
                        <option name="grau" value="Filho(a)">Filho(a)</option>
                    </select>
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