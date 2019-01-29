<div class="container">

    <table width="100%">
            <tr>
                <td><h3>Convênios Cadastrados</h3><br></td>
            </tr>
            <tr>
                <td>
                    <form action="#" method="post" id="form_cadastro">
                        <div class="form-row">
                            <div class="col-md-8">
                              <input type="text" name="buscar" value="<?php echo $Sessao::retornaValorFormulario('buscar'); ?>" class="form-control " placeholder="Buscar" />
                            </div>
                            <div class="col-md-4">
                              <button class="btn btn-info" type="submit">Buscar</button>
                            </div>
                        </div>
                    </form>
                </td>
                <td align="right"><a class="btn btn-success" href="http://<?php echo APP_HOST; ?>/convenio/cadastro">+ Adicionar Convênio</a></td>
            </tr>
        </table>
    <hr>

    <?php if(!count($viewVar['listarConvenios'])){?>
        <div class="alert alert-info" role="alert">Nenhum Convênio Encontrado!</div>
    <?php }?>

    <?php if($Sessao::retornaMensagem()){//Retorna mensagem de erro?>
        <div class="alert alert-warning" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
            <?php echo $Sessao::retornaMensagem(); ?>
        </div>
    <?php }?>

    <?php if($Sessao::retornaSucesso()){//Retorna mensagem de sucesso?>
        <div class="alert alert-success" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <?php echo $Sessao::retornaSucesso(); ?>
        </div>
    <?php }?>

    <div class="table table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr align="center">
                    <th scope="col">Nome do Convênio</th>
                    <th width="30%" scope="col">Nome da Empresa</th>
                    <th width="20%" scope="col">Dia de Vencimento</th>
                    <th width="20%" scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($viewVar['listarConvenios'] as $convenio) {?>
                <tr>
                    <td><?php echo $convenio->NM_Convenio;?></td>
                    <td align="center"><?php echo $convenio->NM_Empresa;?></td>
                    <td align="center"><?php echo $convenio->Dia_Vencimento;?></td>
                    <td align="center">
                        <a href="http://<?php echo APP_HOST;?>/convenio/alterar/<?php echo $convenio->ID_Convenio?>" class="btn btn-info btn-sm">Editar</a>
                        <a class="btn btn-danger btn-sm" id="delete-row" data-toggle="modal" data-placement="bottom" href="#" data-target="#myModal" aria-hidden="true" data-id="<?php echo $convenio->ID_Convenio?>" data-nome="<?php echo $convenio->NM_Convenio?>">Excluir</a>
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
        <a href='http://<?php echo APP_HOST; ?>/convenio/consultar/' class="btn btn-info btn sm">Listar Tudo</a>
    </div>
</div>
