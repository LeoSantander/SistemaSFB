<style>
#ativo:checked ~ label {
color: #00cc00;
}
#inativo:checked ~ label {
color: red;
}
#desligado:checked ~ label {
color: blue;
}
</style>

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
                            <button class="detalhes"
                                                type="button" data-toggle="modal"
                                                data-id= "<?php echo $associado->ID_Associado;?>"
                                                data-target="#detalhes" id="ler-pagina"><font color="white"> Detalhes</font></button>
                          </form>

                            <a class="btn btn-outline-success btn-sm" id="delete-row" data-toggle="modal" data-placement="bottom"
                               href="#" data-target="#myModal" aria-hidden="true"
                               data-id="<?php echo $associado->ID_Associado?>"
                               data-st="<?php echo $associado->ST_Situacao?>"
                               data-nome="<?php echo $associado->NM_Associado?>">Opções</a>
                        </td>
                    </tr>
                <?php }?>
            </tbody>
    </table>

    <a href='http://<?php echo APP_HOST; ?>/associado/consultar/' class="btn btn-info btn sm">Listar Tudo</a>
    </div>
</div>

<!--Modal Excluir-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Opções para: <span id="nomeItem"></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				</div>
				<div class="modal-body">
					<center>Atualmente o Associado encontra-se como: <span id="st"></span> <br></center>
          <form action="http://<?php echo APP_HOST; ?>/associado/altearstatus" method="post">
              <input type="hidden" class="form-control" name="id" id="id">
				</div>
        <div class="row">
          <div class="col-md-4"></div>
            <div class="col-md-4">

              <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="ativo" name="situacao" value="Ativo" required checked>
                <label class="custom-control-label" for="ativo">Ativo</label>
              </div>
              <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="inativo" name="situacao" value="Inativo">
                <label class="custom-control-label" for="inativo">Inativo</label>
              </div>

              <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" id="desligado" name="situacao" value="Desligado">
                <label class="custom-control-label" for="desligado">Desligado</label>
              </div>
            </div>
          <div class="col-md-4"></div>
        </div>

				<div class="modal-footer">
				    <button type="button" class="btn btn-outline-primary btn-sm" data-dismiss="modal">Voltar</button>
            <button type="submit" class="btn btn-success btn-sm">Alterar</button>
          </form>
				</div>
			</div>
		</div>
	</div>

<div class="modal fade" id="detalhes" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalCenterTitle">Detalhes Associado</span></h5>
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
            var st_situacao = "";
            var sit = document.getElementById("st");
            var item = document.getElementById("nomeItem");
            var id_detail = -1;

            $("a#delete-row").click(function() {
                id_delete = $(this).attr('data-id');
                nome = $(this).attr('data-nome');
                st_situacao = $(this).attr('data-st');
                document.getElementById('id').value = id_delete;
                item.innerHTML = "<strong>" + nome + "</strong>";
                sit.innerHTML = "<strong>" + st_situacao + "</strong>";
            });

            $(".detalhes").click(function(){
                document.getElementById("detalhes-aberto").innerHTML="Carregando...";
                var id_detail = this.dataset.id;
                var detalhes = document.getElementById("detalhes-aberto");
                $("#detalhes-aberto").load("http://<?php echo APP_HOST; ?>/associado/detalhes/"+id_detail);
            });
        });
    });

</script>
