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
                    <th width="20%" scope="col">Nome da Empresa</th>
                    <th width="20%" scope="col">Dia de Vencimento</th>
                    <th width="15%" scope="col">Situação</th>
                    <th width="20%" scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($viewVar['listarConvenios'] as $convenio) {?>
                <tr>
                    <td><?php echo $convenio->NM_Convenio;?></td>
                    <td align="center"><?php echo $convenio->NM_Empresa;?></td>
                    <td align="center"><?php echo $convenio->Dia_Vencimento;?></td>
                    <td align="center"><?php echo $convenio->ST_Situacao;?></td>
                    <td align="center">
                        <a href="http://<?php echo APP_HOST;?>/convenio/alterar/<?php echo $convenio->ID_Convenio?>" class="btn btn-info btn-sm">Editar</a>
                        <a class="btn btn-danger btn-sm" id="delete-row" data-toggle="modal" data-placement="bottom"
                           href="#" data-target="#myModal" aria-hidden="true" data-id="<?php echo $convenio->ID_Convenio?>"
                           data-nome="<?php echo $convenio->NM_Convenio?>">Excluir</a>
                    </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
        <a href='http://<?php echo APP_HOST; ?>/convenio/consultar/' class="btn btn-info btn sm">Listar Tudo</a>
    </div>
</div>



<!--Modal Excluir-->

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Excluir</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				</div>
				<div class="modal-body">
                    <form action="http://<?php echo APP_HOST; ?>/convenio/excluir" method="post">
                    <input type="hidden" class="form-control" name="id" id="id">
					Deseja realmente excluir o Convênio <span id="nomeItem"></span>?

				</div>

				<div class="modal-footer">
				    <button type="button" class="btn btn-outline-primary btn-sm" data-dismiss="modal">Voltar</button>
					<button type="submit" id="deleteItem" class="btn btn-danger btn-sm">Excluir</button>
				</div>
			</div>
		</div>
	</div>
</form>

<script>
    $(window).load(function(){
        $(document).ready(function(){
            var id_delete = -1;
            var nome = "";
            var item = document.getElementById("nomeItem");
            $("a#delete-row").click(function() {
                id_delete = $(this).attr('data-id');
                nome = $(this).attr('data-nome');
                //$("#nome p").text(nome);
                //$("#result p").text("Id do estado selecionado: " + id_delete);
                document.getElementById('id').value = id_delete;
                //document.getElementById('nome').value = nome;

                item.innerHTML = "<strong>" + nome +"</strong>";
            });
        });
    });
</script>
