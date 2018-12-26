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
        <h3>Excluir Estado</h3>
        <hr>

        <form action="http://<?php echo APP_HOST; ?>/estado/excluir" method="post">
            <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $viewVar['estado']->ID_Estado;?>">

            <div class="card">
                <div class="card-body">
                    Deseja realmente excluir o Estado <strong><?php echo $viewVar['estado']->NM_Estado?></strong>?
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                    <a href="http://<?php echo APP_HOST; ?>/estado/consultar" class="btn btn-info btn-sm">Voltar</a>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-3"></div>
    </div>
</div>