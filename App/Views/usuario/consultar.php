<?php
    if(!($Sessao::retornaUsuario())){
        $Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
        $this->redirect('login/');
    } else if (!($Sessao::retornaTPUsuario() == 'Administrador')){
        $this->redirect('home/');
    }
?>
<script>
    function valor{
        var idExcluir = $('input[name="btnExcluir"]').val();
    }
</script>
<div class="container">
	<div class="row">
        <div class="col-md-6">
    		<h3>Usuários Cadastrados</h3>
            <form action="http://<?php echo APP_HOST; ?>/usuario/consultar/" method="post" id="form_cadastro">
                <div id="custom-search-input">
                    <div class="input-group col-md-12">
                        <input type="text" name="buscar" value="<?php echo $Sessao::retornaValorFormulario('buscar'); ?>" class="form-control input-lg" placeholder="Buscar" />
                        <span class="input-group-btn">
                            <button class="btn btn-info btn sm" type="submit">Buscar</button>
                        </span>
                    </div>
                </div>
             </form>
        </div>
	</div>
    <hr>
    
    <?php 
        if(!count($viewVar['listarUsuarios'])){
    ?>    
        <div class="alert alert-info" role="alert">Nenhum Usuário encontrado!</div>
    <?php 
        }
    ?>    
    <?php if($Sessao::retornaMensagem()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
                    <?php echo $Sessao::retornaMensagem(); ?>
                </div>
    <?php } ?>
    
    <?php if($Sessao::retornaSucesso()){ ?>
                <div class="alert alert-success" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
                    <?php echo $Sessao::retornaSucesso(); ?>
                </div>
     <?php } ?>

    <div class="table table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="thead-light">
            <tr align="center">
            <th scope="col">Nome</th>
                <th width="20%" scope="col">Usuário</th>
                <th width="10%" scope="col">CPF</th>
                <th width="20%" scope="col">Tipo de Usuário</th>
                <th width="20%" scope="col">Ações</th>
            </tr>
        </thead>
        <?php foreach($viewVar['listarUsuarios'] as $usuarios){?>
		    <tr>
                <td><?php echo $usuarios->NM_Pessoa;?></td>
                <td><?php echo $usuarios->NM_Usuario;?></td>
			    <td><?php echo $usuarios->CPF_Usuario;?></td>
			    <td><?php echo $usuarios->TP_Usuario;?></td>
			    <td align="center">
				    <a class="btn btn-info btn-sm" href="http://<?php echo APP_HOST;?>/usuario/alterar/<?php echo $usuarios->ID_Usuario?>">Editar</a>
				     <!--botão excluir-->
                     <a class="btn btn-danger btn-sm" id="delete-row" data-toggle="modal" data-placement="bottom" href="#" data-target="#myModal" aria-hidden="true" data-id="<?php echo $usuarios->ID_Usuario?>" data-nome="<?php echo $usuarios->NM_Usuario?>">Excluir</a>
                    
		        </td>
	        </tr>	
	    <?php }?>
    </table>
    
    <a href='http://<?php echo APP_HOST; ?>/usuario/consultar/' class="btn btn-info btn sm">Listar Tudo</a>
    </div>
</div>

<!--Modal-->
<form action="http://<?php echo APP_HOST; ?>/usuario/excluir" method="post">
    <input type="hidden" class="form-control" name="id" id="id">

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Excluir</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				</div>
				<div class="modal-body">
					Deseja realmente excluir o usuário <span id="nomeItem"></span>?
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