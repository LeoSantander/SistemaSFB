<div class="container">

    <table width="100%">
            <tr>
                <td><h3>Dependentes Cadastrados</h3><br></td>
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
                <td align="right"><a class="btn btn-success" href="http://<?php echo APP_HOST; ?>/dependente/cadastro">+ Adicionar Dependente</a></td>
            </tr>
        </table>

    <hr>

    <?php if(!count($viewVar['listarDependentes'])){?>
        <div class="alert alert-info" role="alert">Nenhum Dependente Encontrado!</div>
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
                    <th scope="col">Nome Dependente</th>
                    <th width="30%" scope="col">Nome Associado</th>
                    <th width="20%" scope="col">Grau</th>
                    <th width="25%" scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($viewVar['listarDependentes'] as $dependente) {?>
                    <tr>
                        <td> <form method="post">
                              <input type="hidden" class="form-control" name="id" id="idUpdate" value="<?php echo $dependente->ID_Dependente;?>">
                              <?php echo $dependente->NM_Dependente;?>
                        </td>
                        <td align="center"><?php echo $dependente->NM_Associado;?></td>
                        <td align="center"><?php echo $dependente->NM_Grau;?></td>
                        <td align="center">
                            <a class="btn btn-info btn-sm" href="http://<?php echo APP_HOST;?>/dependente/alterar/<?php echo $dependente->ID_Dependente?>">Editar</a>

                            <button class="detalhes"
                                type="button" data-toggle="modal"
                                data-id= "<?php echo $dependente->ID_Dependente;?>"
                                data-target="#detalhes" id="ler-pagina"><font color="white"> Detalhes</font></button>
                            </form>

                            <a class="btn btn-danger btn-sm" id="delete-row" data-toggle="modal" data-placement="bottom"
                               href="#" data-target="#myModal" aria-hidden="true" data-id="<?php echo $dependente->ID_Dependente?>"
                               data-nome="<?php echo $dependente->NM_Dependente?>">Excluir</a>
                        </td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
        <a href='http://<?php echo APP_HOST; ?>/dependente/consultar/' class="btn btn-info btn sm">Listar Tudo</a>
    </div>

</div>

<!--Modal Excluir-->
<form action="http://<?php echo APP_HOST; ?>/dependente/excluir" method="post">
    <input type="hidden" class="form-control" name="id" id="id">

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Excluir</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				</div>
				<div class="modal-body">
					Deseja realmente excluir o Dependente <span id="nomeItem"></span>?
				</div>

				<div class="modal-footer">
				    <button type="button" class="btn btn-outline-primary btn-sm" data-dismiss="modal">Voltar</button>
					<button type="submit" id="deleteItem" class="btn btn-danger btn-sm">Excluir</button>
				</div>
			</div>
		</div>
	</div>
</form>

<div class="modal fade" id="detalhes" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalCenterTitle">Detalhes Dependente</span></h5>
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

            //details
            var id_detail = -1;
            var nomeItem = "";
            var rg = "";
            var cpf = "";
            var datanasc = "";
            var associado = "";
            var grau = "";


            $("a#delete-row").click(function() {
                id_delete = $(this).attr('data-id');
                nome = $(this).attr('data-nome');
                document.getElementById('id').value = id_delete;

                item.innerHTML = "<strong>" + nome +"</strong>";
            });

            $("a#details-row").click(function() {
                id_detail = $(this).attr('data-id');
                nome = $(this).attr('data-nome');
                rg = $(this).attr('data-rg');
                cpf = $(this).attr('data-cpf');
                datanasc = $(this).attr('data-nasc');
                associado = $(this).attr('data-associado');
                grau = $(this).attr('data-grau');

            });

            $(".detalhes").click(function(){
                document.getElementById("detalhes-aberto").innerHTML="Carregando...";
                var id_detail = this.dataset.id;
                var detalhes = document.getElementById("detalhes-aberto");

                $("#detalhes-aberto").load("http://<?php echo APP_HOST; ?>/dependente/detalhes/"+id_detail);


            });
        });
    });
</script>
