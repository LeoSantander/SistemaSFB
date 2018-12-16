<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <h3>Excluir Usuário</h3>

            <form action="http://<?php echo APP_HOST; ?>/usuario/excluir" method="post" id="form_cadastro">
                <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $viewVar['usuario']->ID_Usuario; ?>">

                <div class="panel panel-danger">
                    <div class="panel-body">
                        Deseja realmente excluir este Usuário: <strong><?php echo $viewVar['usuario']->NM_Usuario; ?></strong> ?
                    </div>
                    <div class="panel-footer"> 
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        <a href="http://<?php echo APP_HOST; ?>/usuario/consultar" class="btn btn-info btn-sm">Voltar</a>
                    </div>
                </div>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>
