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
            <h3>Cadastro de Estado</h3>
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

            <!--Montando o formulário-->
            <form action="http://<?php echo APP_HOST; ?>/estado/salvar" method="post">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control"  name="nome" placeholder="Ex: São Paulo" pattern="[A-Za-zÀ-ú ']{0,}" 
                           title="Não use caracteres especiais ou números" value="<?php echo $Sessao::retornaValorFormulario('nome'); ?>" 
                           required autofocus>
                </div>
                <div class="form-group">
                    <label for="sigla">Sigla</label>
                    <input type="text" class="form-control" name="sigla" placeholder="Ex: SP" pattern="[A-z]{2}" 
                           title="Use 2 caracteres. Não use caracteres especiais ou números." 
                           value="<?php echo $Sessao::retornaValorFormulario('sigla'); ?>" required>
                </div>
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="http://<?php echo APP_HOST; ?>/home/" class="btn btn-outline-danger">Cancelar</a>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>

