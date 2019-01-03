<?php
//Solicitando login para acessar o sistema
    if(!($Sessao::retornaUsuario())){
        $Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
        $this->redirect('login/');
    }
?>

<div class="container">
    
    <table width="100%">
            <tr>
                <td><h3>Dependentes Cadastrados</h3></td>
                <td align="right"><a class="btn btn-success" href="http://<?php echo APP_HOST; ?>/dependente/cadastro">+ Adicionar Dependente</a></td>
            </tr>
        </table>
    
    <hr>

    <?php if(!count($viewVar['listarDependentes'])){?>
        <div class="alert alert-info" role="alert">Nenhum Dependente Encontrado!  <a class="btn btn-dark btn-sm" href="http://<?php echo APP_HOST; ?>/dependente/cadastro">Cadastre</a></div>
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
                    <th width="20%" scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($viewVar['listarDependentes'] as $dependente) {?>
                    <tr>
                        <td><?php echo $dependente->NM_Dependente;?></td>
                        <td align="center" class="text-danger">Sem Associados</td>
                        <td align="center"><?php echo $dependente->NM_Grau;?></td>
                        <td align="center">
                            <a class="btn btn-info btn-sm" href="#">Editar</a>
                            <a href='#' class="btn btn-secondary btn-sm" id="details-row" data-toggle="modal" data-target="#exampleModalCenter"
                               data-nome="<?php echo $dependente->NM_Dependente;?>"
                               data-rg=  "<?php echo $dependente->RG;?>"
                               data-cpf= "<?php echo $dependente->CPF;?>"
                               data-nasc="<?php echo date('d/m/Y', strtotime($dependente->DT_Nascimento));?>"
                               data-grau="<?php echo $dependente->NM_Grau;?>"
                               data-id=  "<?php echo $dependente->ID_Dependente?>"                               
                               >Detalhes</a>

                            <a class="btn btn-danger btn-sm" id="delete-row" data-toggle="modal" data-placement="bottom" 
                               href="#" data-target="#myModal" aria-hidden="true" data-id="<?php echo $dependente->ID_Dependente?>" 
                               data-nome="<?php echo $dependente->NM_Dependente?>">Excluir</a>
                        </td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
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
            
                <strong>Nome: </strong>  <span id="nomeItemDetalhe"></span><br>
                <strong>RG: </strong> <span id="rgItem"></span><br>
                <strong>CPF: </strong> <span id="cpfItem"></span><br>
                <strong>Data Nascimento: </strong><span id="dataItem"></span><br>
                <strong>Associado: </strong><span id="associadoItem" class="text-danger">Sem associados</span><br>
                <strong>Grau de Dependência: </strong> <span id="grauItem"></span>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary btn-sm" data-dismiss="modal">Voltar</button>
                <a class="btn btn-info btn-sm" href="#">Editar</a>
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
            var rTitulo = document.getElementById("nomeItemTitulo");
            var rNome = document.getElementById("nomeItemDetalhe");
            var rRg = document.getElementById("rgItem");
            var rCpf = document.getElementById("cpfItem");
            var rData = document.getElementById("dataItem");
            var rGrau = document.getElementById("grauItem");

            $("a#delete-row").click(function() {
                id_delete = $(this).attr('data-id');
                nome = $(this).attr('data-nome');
                document.getElementById('id').value = id_delete;
                
                item.innerHTML = "<strong>" + nome +"</strong>";
            });

            $("a#details-row").click(function() {
                id_delete = $(this).attr('data-id');
                nome = $(this).attr('data-nome');
                rg = $(this).attr('data-rg');
                cpf = $(this).attr('data-cpf');
                datanasc = $(this).attr('data-nasc');
                //associado = $(this).attr('data-associado');
                grau = $(this).attr('data-grau');

                rTitulo.innerHTML = nome;
                rNome.innerHTML = nome;
                rRg.innerHTML = rg;
                rCpf.innerHTML = cpf;
                rData.innerHTML = datanasc;
                rGrau.innerHTML = grau;
            });
        });
    });
</script>