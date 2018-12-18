<?php
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

            <?php if($Sessao::retornaMensagem()){?>
                <div class="alert alert-warning" role="alert"><?php echo $Sessao::retornaMensagem(); ?></div>
            <?php }?>

            <?php if($Sessao::retornaSucesso()){?>
                <div class="alert alert-success" role="alert"><?php echo $Sessao::retornaSucesso()?></div>
            <?php }?>

            <form action="http://<?php echo APP_HOST; ?>/estado/salvar" method="post" id="form_cadastro">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control"  name="nome" placeholder="Ex: São Paulo" value="<?php echo $Sessao::retornaValorFormulario('nome'); ?>" required>
                </div>

                <div class="form-group">
                    <label for="sigla">Sigla</label>
                    <input type="text" class="form-control"  name="sigla" placeholder="Ex: SP" value="<?php echo $Sessao::retornaValorFormulario('sigla'); ?>" required>
                </div>

                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
            </form>

        </div>
        <div class=" col-md-3"></div>
    </div>
</div>