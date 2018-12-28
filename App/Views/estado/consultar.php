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
                        <!--botão excluir-->
                        <a class="btn btn-danger btn-sm" id="delete-row" data-toggle="modal" data-placement="bottom" href="#" data-target="#myModal" aria-hidden="true" data-id="<?php echo $estado->ID_Estado?>" data-nome="<?php echo $estado->NM_Estado?>">Excluir</a>
                   </td>
                </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
</div>

<!--Modal-->
<form action="http://<?php echo APP_HOST; ?>/estado/excluir" method="post">
    <input type="hidden" class="form-control" name="id" id="id">

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Excluir</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				</div>
				<div class="modal-body">
					Deseja realmente excluir o Estado <span id="nomeItem"></span>?
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