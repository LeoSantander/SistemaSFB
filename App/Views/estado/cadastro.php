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
                <div class="alert alert-warning" role="alert"><?php echo $Sessao::retornaMensagem(); ?></div><hr>
            <?php }?>
           
            <?php if($Sessao::retornaSucesso()){//Retorna mensagem 'Estado cadastrado com sucesso!'?>
                <div class="alert alert-success" role="alert"><?php echo $Sessao::retornaSucesso()?></div><hr>
            <?php }?>

            <!--Montando o formulário-->
            <form action="http://<?php echo APP_HOST; ?>/estado/salvar" method="post">
                
                <!--Campo Nome-->
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control"  name="nome" placeholder="Ex: São Paulo" value="<?php echo $Sessao::retornaValorFormulario('nome'); ?>" 
                           required oninvalid="this.setCustomValidity('Este é um campo obrigatório')" onchange="try{setCustomValidity('')}catch(e){}">
                </div>

                <!--Campo Sigla-->
                <div class="form-group">
                    <label for="sigla">Sigla</label>
                    <input type="text" class="form-control"  name="sigla" pattern="[A-z]{2}" placeholder="Ex: SP" value="<?php echo $Sessao::retornaValorFormulario('sigla'); ?>" 
                           required oninvalid="this.setCustomValidity('Este é um campo obrigatório e deve conter 2 caracteres!')" onchange="try{setCustomValidity('')}catch(e){}" >
                </div>

                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="http://<?php echo APP_HOST; ?>/home/" class="btn btn-outline-danger">Cancelar</a>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>

