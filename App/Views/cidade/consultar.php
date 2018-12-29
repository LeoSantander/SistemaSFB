<?php
//Solicitando login para acessar o sistema
    if(!($Sessao::retornaUsuario())){
        $Sessao::gravaMensagem("É necessário realizar Login acessar o sistema!");
        $this->redirect('login/');
    }
?>

<div class="container">
    <div class="row">
        <h3>Cidades Cadastradas</h3>
    </div>
    <hr>

    <?php if(!count($viewVar['listarCidades'])){?>
        <div class="alert alert-info" role="alert">Nenhuma Cidade Encontrada!</div>
    <?php }?>

    <div class="table table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr align="center">
                    <th scope="col">Nome</th>
                    <th width="20%" scope="col">Estado</th>
                    <th width="30%" scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($viewVar['listarCidades'] as $cidade) {?>
                <tr>
                    <td><?php echo $cidade->NM_Cidade;?></td>
                    <td align="center"><?php echo $cidade->NM_Estado;?></td>
                    <td align="center">
                        <a href="http://<?php echo APP_HOST;?>/cidade/alterar/<?php echo $cidade->ID_Cidade?>" class="btn btn-info btn-sm">Editar</a>
                        <a href="http://<?php echo APP_HOST;?>/cidade/exclusao/<?php echo $cidade->ID_Cidade?>" class="btn btn-danger btn-sm">Excluir</a>
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
</div> 