<?php
//Solicitando login para acessar o sistema
    if(!($Sessao::retornaUsuario())){
        $Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
        $this->redirect('login/');
    }
?>

<div class="container">
    <div class="row">
        <h3>Estados Cadastrados</h3>
    </div>
    <hr>

    <?php if(!count($viewVar['listarEstados'])){?>
        <div class="alert alert-info" role="alert">Nenhum Estado Encontrado!</div>
    <?php }?>

    <div class="table table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr align="center">
                    <th scope="col">Nome</th>
                    <th width="20%" scope="col">Sigla</th>
                    <th width="30%" scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($viewVar['listarEstados'] as $estado) {?>
                <tr>
                    <td><?php echo $estado->NM_Estado;?></td>
                    <td align="center"><?php echo $estado->CD_Estado;?></td>
                    <td align="center">
                        <a href="http://<?php echo APP_HOST;?>/estado/alterar/<?php echo $estado->ID_Estado?>" class="btn btn-info btn-sm">Editar</a>
                        <a href="http://<?php echo APP_HOST;?>/estado/exclusao/<?php echo $estado->ID_Estado?>" class="btn btn-danger btn-sm">Excluir</a>
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
</div>