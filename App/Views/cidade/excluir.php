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
        <h3>Excluir Cidade</h3>
        <hr>

        <form action="http://<?php echo APP_HOST; ?>/cidade/excluir" method="post">
            <input type="hidden" class="form-control" name="idCidade" id="idCidade" value="<?php echo $viewVar['cidade']->ID_Cidade;?>">

            <div class="card">
                <div class="card-body">
                    Deseja realmente excluir a Cidade? <strong><?php echo $viewVar['cidade']->NM_Cidade?></strong>?
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    <a href="http://<?php echo APP_HOST; ?>/cidade/consultar" class="btn btn-info btn-sm">Voltar</a>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-3"></div>
    </div>
</div>