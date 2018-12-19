<!--Solicitando login para acessar o sistema-->
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

            <!--Retorna mensagem de erro-->
            <?php if($Sessao::retornaMensagem()){?>
                <div class="alert alert-warning" role="alert"><?php echo $Sessao::retornaMensagem(); ?></div>
            <?php }?>
            <!--Retorna mensagem 'Estado cadastrado com sucesso!'-->
            <?php if($Sessao::retornaSucesso()){?>
                <div class="alert alert-success" role="alert"><?php echo $Sessao::retornaSucesso()?></div>
            <?php }?>

                        
            <!--Montando o formulário-->
            <form action="http://<?php echo APP_HOST; ?>/estado/salvar" method="post" id="form_cadastro">
                
                <!--Campo Nome-->
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control"  name="nome" placeholder="Ex: São Paulo" value="<?php echo $Sessao::retornaValorFormulario('nome'); ?>" >
                    
                    <!--Mensagem de validação do campo NOME, exibida ao serem encontrados erros-->
                    <?php if($Sessao::retornaErro())
                    { 
                        foreach($Sessao::retornaErro() as $key => $mensagem)
                        {?>
                            <span class="text-danger"><?php if($key == 'nome'){echo $mensagem;}?></span>
                        <?php
                        }
                    }?> 
                </div>

                <!--Campo Sigla-->
                <div class="form-group">
                    <label for="sigla">Sigla</label>
                    <input type="text" class="form-control"  name="sigla" placeholder="Ex: SP" value="<?php echo $Sessao::retornaValorFormulario('sigla'); ?>" >
                    
                    <!--Mensagem de validação do campo SIGLA, exibida ao serem encontrados erros-->
                    <?php if($Sessao::retornaErro())
                    {
                        foreach($Sessao::retornaErro() as $key => $mensagem)
                        {?>
                            <span class="text-danger"><?php if($key == 'sigla'){echo $mensagem;}?></span>
                        <?php
                        }
                    }?>
                </div>

                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                <a href="http://<?php echo APP_HOST; ?>/home/" class="btn btn-info btn-sm">Cancelar</a>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>

