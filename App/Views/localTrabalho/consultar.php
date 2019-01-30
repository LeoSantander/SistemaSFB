<script>
    function valor{
        var idExcluir = $('input[name="btnExcluir"]').val();
    }
</script>
<div class="container">
    <table width="100%">
        <tr>
            <td><h3>Postos Cadastrados</h3></td>
        </tr>
        <tr>
        <td>
            <form action="#" method="post" id="form_cadastro">
                <div id="custom-search-input">
                    <div class="input-group col-md-12">
                        <input type="text" name="buscar" value="<?php echo $Sessao::retornaValorFormulario('buscar'); ?>" class="form-control input-lg" placeholder="Buscar" />
                        <span class="input-group-btn">
                            <button class="btn btn-info btn sm" type="submit">Buscar</button>
                        </span>
                    </div>
                </div>
                </form>
        </td>
        <td align="right">
            <a class="btn btn-success" href="http://<?php echo APP_HOST; ?>/localTrabalho/cadastro">+ Adicionar Posto</a>
        </td>
        </tr>
    </table>
    <hr>

    <?php
        if(!count($viewVar['listarLocais'])){
    ?>
        <div class="alert alert-info" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
            Nenhum Local encontrado!
        </div>
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
            <th width="13%" scope="col">Telefone</th>
            <th width="20%" scope="col">Email</th>
            <th width="30%" scope="col">Ações</th>
        </tr>
    </thead>
        <?php foreach($viewVar['listarLocais'] as $locais){?>
		    <tr>
                <td><?php echo $locais->NM_Fantasia;?></td>
                <td><?php echo $locais->Tel;?></td>
			    <td><?php echo $locais->EmailLocal;?></td>
			    <td align="center">
				    <a href='http://<?php echo APP_HOST;?>/localTrabalho/alterar/<?php echo $locais->ID_Local_Trabalho?>' class="btn btn-info btn-sm">Editar</a>
                    <a href='#' class="btn btn-secondary btn-sm" id="details-row" data-toggle="modal" data-target="#exampleModalCenter"
                               data-sigla="<?php echo $locais->CD_Local_Trabalho;?>"
                               data-fantasia="<?php echo $locais->NM_Fantasia;?>"
                               data-cnpj = "<?php echo $locais->CNPJ;?>"
                               data-endereco=  "<?php echo $locais->Rua.", Nº.: ".$locais->Num." - ".$locais->Bairro." - ".$locais->CepLocal?>"
                               data-cidade= "<?php echo $locais->NM_Cidade." - ". $locais->CD_Estado;?>"
                               data-id=  "<?php echo $locais->ID_Local_Trabalho?>"
                               data-telefone = "<?php echo $locais->Tel;?>"
                               data-email = "<?php echo $locais->EmailLocal;?>"
                               data-escritorio = "<?php echo $locais->NM_Escritorio;?>"><font color="white"> Detalhes</font></a>

                    <a class="btn btn-danger btn-sm" id="delete-row" data-toggle="modal" data-placement="bottom"
                        href="#" data-target="#myModal" aria-hidden="true" data-id="<?php echo $locais->ID_Local_Trabalho?>"
                        data-nome="<?php echo $locais->NM_Fantasia?>">Excluir</a>
		        </td>
	        </tr>
	    <?php }?>
    </table>

     <a href='http://<?php echo APP_HOST; ?>/localTrabalho/consultar/' class="btn btn-info btn sm">Listar Tudo</a>
    </div>
</div>


<!-- Abrir a Modal que será utilizada como detalhes -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalCenterTitle">Detalhes de <span id="nomeItemTitulo"></span></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="http://<?php echo APP_HOST; ?>/localTrabalho/alterar" method="post">
            <input type="hidden" class="form-control" name="id" id="idUpdate">

                <h5>Dados Cadastrais</h5>
                <strong>Nome Fantasia: </strong> <span id="cdItem"></span> <span id="nomeItemDetalhe"></span><br>
                <strong>CNPJ: </strong> <span id="cnpjItem"></span><br>
                <strong>Escritório: </strong> <span id="escritorioItem"></span><br><br>

                <h5>Endereço</h5>
                <strong>Endereço: </strong> <span id="enderecoItem"></span><br>
                <strong>Cidade: </strong><span id="cidadeItem"></span><br><br>

                <h5>Contato</h5>
                <strong>Telefone: </strong><span id="telefoneItem"></span><br>
                <strong>Email: </strong> <span id="emailItem"></span>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary btn-sm" data-dismiss="modal">Voltar</button>
                <button type="submit" id="UpdateItem" class="btn btn-info btn-sm">Editar</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!--Modal Excluir-->
<form action="http://<?php echo APP_HOST; ?>/localTrabalho/excluir" method="post">
    <input type="hidden" class="form-control" name="id" id="id">

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
					<h4 class="modal-title" id="myModalLabel">Excluir</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				</div>
				<div class="modal-body">
					Deseja realmente excluir <span id="nomeItem"></span>?
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
            //delete
            var id_delete = -1;
            var nome = "";
            var item = document.getElementById("nomeItem");

            //details
            var id_detail = -1;
            var nomeItem = "";
            var cd = "";
            var cnpj = "";
            var endereco = "";
            var cidade = "";
            var telefone = "";
            var email = "";
            var cep = "";
            var escritorio = "";
            var rTitulo = document.getElementById("nomeItemTitulo");
            var rNome = document.getElementById("nomeItemDetalhe");
            var rCD = document.getElementById("cdItem");
            var rCnpj = document.getElementById("cnpjItem");
            var rEscritorio = document.getElementById("escritorioItem");

            var rEndereco = document.getElementById("enderecoItem");
            var rCidade = document.getElementById("cidadeItem");

            var rTelefone = document.getElementById("telefoneItem");
            var rEmail = document.getElementById("emailItem");

            $("a#delete-row").click(function() {
                id_delete = $(this).attr('data-id');
                nome = $(this).attr('data-nome');
                document.getElementById('id').value = id_delete;

                item.innerHTML = "<strong>" + nome +"</strong>";
            });

            $("a#details-row").click(function() {
                id_detail = $(this).attr('data-id');
                nome = $(this).attr('data-fantasia');
                cd = $(this).attr('data-sigla');
                cnpj = $(this).attr('data-cnpj');

                endereco = $(this).attr('data-endereco');
                cidade = $(this).attr('data-cidade');
                escritorio = $(this).attr('data-escritorio');
                telefone = $(this).attr('data-telefone');
                email = $(this).attr('data-email');

                document.getElementById('idUpdate').value = id_detail;

                rTitulo.innerHTML = nome;
                rNome.innerHTML = nome;
                rCD.innerHTML = cd + " - ";
                rCnpj.innerHTML = cnpj;
                rEndereco.innerHTML = endereco;
                rCidade.innerHTML = cidade;
                rTelefone.innerHTML = telefone;
                rEmail.innerHTML = email;
                rEscritorio.innerHTML = escritorio;
            });
        });
    });
</script>
