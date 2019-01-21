<div class="container">

    <table width="100%">
            <tr>
                <td><h3>Associados Cadastrados</h3><br></td>
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
                <td align="right"><a class="btn btn-success" href="http://<?php echo APP_HOST; ?>/associado/cadastro">+ Adicionar Associado</a></td>
            </tr>
        </table>
    <hr>

    <?php if(!count($viewVar['listarAssociados'])){?>
        <div class="alert alert-info" role="alert">Nenhum Associado Encontrado!</div>
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
                    <th scope="col">Nome Associado</th>
                    <th width="15%" scope="col">Celular</th>
                    <th width="20%" scope="col">Email</th>
                    <th width="10%" scope="col">Situação</th>
                    <th width="25%" scope="col">Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($viewVar['listarAssociados'] as $associado) {?>
                    <tr>
                        <td>
                          <form method="post">
                          <input type="hidden" class="form-control" name="id" id="idUpdate" value="<?php echo $associado->ID_Associado;?>">
                          <?php echo $associado->NM_Associado;?>
                        </td>
                        <td align="center"><?php echo $associado->Celular;?></td>
                        <td align="center"><?php echo $associado->Email;?></td>
                        <td align="center"><?php echo $associado->ST_Situacao;?></td>
                        <td align="center">
                            <a class="btn btn-info btn-sm" href="http://<?php echo APP_HOST;?>/associado/alterar/<?php echo $associado->ID_Associado?>">Editar</a>
                            <button class="btn btn-secondary btn-sm"
                                                type="button" data-toggle="modal"
                                                data-id= "<?php echo $associado->ID_Associado;?>"
                                                data-target="#detalhes" id="ler-pagina">Detalhes</button>
                          </form>

                            <a class="btn btn-danger btn-sm" id="details-row" data-toggle="modal" data-placement="bottom"
                               href="#" data-target="#myModal" aria-hidden="true" data-id="<?php echo $associado->ID_Associado?>"
                               data-nome="<?php echo $associado->NM_Associado?>">Excluir</a>
                        </td>
                    </tr>
                <?php }?>
            </tbody>
    </table>

    <a href='http://<?php echo APP_HOST; ?>/associado/consultar/' class="btn btn-info btn sm">Listar Tudo</a>
    </div>
</div>

<!--Modal Excluir-->
<form action="http://<?php echo APP_HOST; ?>/associado/excluir" method="post">
    <input type="hidden" class="form-control" name="excluir" id="id">

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Excluir</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				</div>
				<div class="modal-body">
					Deseja realmente excluir o Associado <span id="nomeItem"></span>?
				</div>

				<div class="modal-footer">
				    <button type="button" class="btn btn-outline-primary btn-sm" data-dismiss="modal">Voltar</button>
					<button type="submit" id="deleteItem" class="btn btn-danger btn-sm">Excluir</button>
				</div>
			</div>
		</div>
	</div>
</form>

<!--Modal Ativar-->
    <div class="modal fade" id="myModalAtivar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Ativar Usuário</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				</div>

				<div class="modal-body">
                    <form action="http://<?php echo APP_HOST; ?>/assoiado/ativar" method="post">
                    <input type="hidden" class="form-control" name="ativar" id="id-ativar">

					Deseja realmente Ativar o usuário <span id="nomeItemAtivar"></span>?
				</div>

				<div class="modal-footer">
				    <button type="button" class="btn btn-outline-primary btn-sm" data-dismiss="modal">Voltar</button>
					<button type="submit" id="deleteItem" class="btn btn-info btn-sm">Ativar</button>
				</div>
			</div>
		</div>
	</div>
</form>



<div class="modal fade" id="detalhes" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalCenterTitle">Detalhes de <span id="nomeItemTitulo"></span></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

              <div id="detalhes-aberto"></div>

            </div>
        </div>
    </div>
</div>

<script>
    $(window).load(function(){
        $(document).ready(function(){
            //delete
            var id_delete = -1;
            var nome = "";
            var item = document.getElementById("nomeItem");
            var id_detail = -1;
            id_detail = $(this).attr('data-id');


            $("a#delete-row").click(function() {
                id_delete = $(this).attr('data-id');
                nome = $(this).attr('data-nome');
                document.getElementById('id').value = id_delete;

                item.innerHTML = "<strong>" + nome +"</strong>";
            });
        });
    });

    $(document).ready(function(){
        $("#ler-pagina").click(function(){
            var id_detail = -1;
            id_detail = $(this).attr('data-id');

            $(function(){
                $("#detalhes-aberto").load("http://<?php echo APP_HOST; ?>/associado/detalhes/"+6);
            });
        })
   });
</script>
