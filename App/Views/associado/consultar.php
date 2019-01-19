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
                        <td><?php echo $associado->NM_Associado;?></td>
                        <td align="center"><?php echo $associado->Celular;?></td>
                        <td align="center"><?php echo $associado->Email;?></td>
                        <td align="center"><?php echo $associado->ST_Situacao;?></td>
                        <td align="center">
                            <a class="btn btn-info btn-sm" href="http://<?php echo APP_HOST;?>/associado/alterar/<?php echo $associado->ID_Associado?>">Editar</a>
                            <a href='#' class="btn btn-secondary btn-sm" id="details-row" data-toggle="modal" data-target="#exampleModalCenter"
                               data-nome= "<?php echo $associado->NM_Associado;?>"
                               data-rg= "<?php echo $associado->RG;?>"
                               data-cpf= "<?php echo $associado->CPF;?>"
                               data-cpf= "<?php echo $associado->CPF;?>"
                               data-nasc= "<?php echo date('d/m/Y', strtotime($associado->DT_Nascimento));?>"
                               data-asso= "<?php echo date('d/m/Y', strtotime($associado->DT_Associacao));?>"
                               data-local= "<?php echo $associado->NM_Fantasia;?>"
                               data-cargo= "<?php echo $associado->Cargo;?>"
                               data-salario=  "<?php echo $associado->VL_Salario;?>"
                               data-registro= "<?php echo $associado->NO_Registro;?>"
                               data-situacao= "<?php echo $associado->ST_Situacao;?>"
                               data-rua= "<?php echo $associado->NM_Rua;?>"
                               data-numero= "<?php echo $associado->NO_Endereco;?>"
                               data-bairro= "<?php echo $associado->NM_Bairro;?>"
                               data-cep= "<?php echo $associado->CEP;?>"
                               data-cidade= "<?php echo $associado->NM_Cidade;?>"
                               data-complemento= "<?php echo $associado->Complemento;?>"
                               data-telefone= "<?php echo $associado->Telefone;?>"
                               data-celular= "<?php echo $associado->Celular;?>"
                               data-email= "<?php echo $associado->Email;?>"
                               data-id= "<?php echo $associado->ID_Associado;?>"
                               >Detalhes</a>

                            <a class="btn btn-danger btn-sm" id="delete-row" data-toggle="modal" data-placement="bottom"
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
            <form action="http://<?php echo APP_HOST; ?>/associado/alterar" method="post">
                <input type="hidden" class="form-control" name="id" id="idUpdate">

                <h5>Dados Cadastrais</h5>

                <strong>Nome: </strong>  <span id="nomeItemDetalhe"></span><br>
                <strong>RG: </strong> <span id="rgItem"></span><br>
                <strong>CPF: </strong> <span id="cpfItem"></span><br>
                <strong>Data Nascimento: </strong><span id="datanascItem"></span><br>
                <strong>Data Associação: </strong><span id="dataassoItem"></span><br>
                <strong>Local de Trabalho: </strong><span id="localItem"></span><br>
                <strong>Cargo: </strong><span id="cargoItem"></span><br>
                <strong>Salário Base: </strong><span id="salarioItem"></span><br>
                <strong>Número de registro: </strong><span id="registroItem"></span><br>
                <strong>Situação: </strong><span id="situacaoItem"></span><br><br>

                <h5>Endereço:</h5>
                <strong>Rua: </strong> <span id="ruaItem"></span><br>
                <strong>Número: </strong> <span id="numeroItem"></span><br>
                <strong>Bairro: </strong> <span id="bairroItem"></span><br>
                <strong>CEP: </strong> <span id="cepItem"></span><br>
                <strong>Cidade: </strong> <span id="cidadeItem"></span><br>
                <strong>Complemento: </strong> <span id="complementoItem"></span><br><br>

                <h5>Contato:</h5>
                <strong>Telefone: </strong> <span id="telefoneItem"></span><br>
                <strong>Celular: </strong> <span id="celularItem"></span><br>
                <strong>Email: </strong> <span id="emailItem"></span><br><br>

                <h5>Dependentes Relacionados:</h5>
                <?php
                  $id_associado = (string) "<span id='rAssociado'></span>";

                  foreach ($viewVar['listarDependentes'] as $dependente ) {
                  printf($id_associado.' - '.$dependente->Associado.'; ');

                  if (($dependente->Associado) == ($id_associado)){ ?>

                        <table width=100%>
                          <tr>
                            <td  width=60%>
                                <strong>Nome: </strong>
                            </td>
                            <td>
                                <strong> Grau: </strong>
                            </td>
                          </tr>
                          <tr>
                              <td>
                                  <?php echo $dependente->NM_Dependente;?>
                              </td>
                              <td>
                                  <?php echo $dependente->NM_Grau;?>
                              </td>
                        </tr>
                      </table>
                <?php
                    }
                }
                ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary btn-sm" data-dismiss="modal">Voltar</button>
                <button type="submit" class="btn btn-info btn-sm">Editar</button>
            </div>
            </form>
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
            var dataassociacao = "";
            var local = "";
            var cargo = "";
            var salario = "";
            var registro = "";
            var situacao = "";
            var rua = "";
            var numero = "";
            var bairro = "";
            var cep = "";
            var cidade = "";
            var complemento = "";
            var telefone = "";
            var celular = "";
            var email = "";
            var rTitulo = document.getElementById("nomeItemTitulo");
            var rNome = document.getElementById("nomeItemDetalhe");
            var rRg = document.getElementById("rgItem");
            var rCpf = document.getElementById("cpfItem");
            var rDataNasc = document.getElementById("datanascItem");
            var rDataAssociacao = document.getElementById("dataassoItem");
            var rLocal = document.getElementById("localItem");
            var rCargo = document.getElementById("cargoItem");
            var rSalario = document.getElementById("salarioItem");
            var rRegistro = document.getElementById("registroItem");
            var rSituacao= document.getElementById("situacaoItem");
            var rRua = document.getElementById("ruaItem");
            var rNumero = document.getElementById("numeroItem");
            var rBairro = document.getElementById("bairroItem");
            var rCep = document.getElementById("cepItem");
            var rCidade = document.getElementById("cidadeItem");
            var rComplemento = document.getElementById("complementoItem");
            var rTelefone = document.getElementById("telefoneItem");
            var rCelular = document.getElementById("celularItem");
            var rEmail = document.getElementById("emailItem");

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
                dataasso = $(this).attr('data-asso');
                local = $(this).attr('data-local');
                cargo = $(this).attr('data-cargo');
                salario = $(this).attr('data-salario');
                registro = $(this).attr('data-registro');
                situacao = $(this).attr('data-situacao');
                rua = $(this).attr('data-rua');
                numero = $(this).attr('data-numero');
                bairro = $(this).attr('data-bairro');
                cep = $(this).attr('data-cep');
                cidade = $(this).attr('data-cidade');
                complemento = $(this).attr('data-complemento');
                telefone = $(this).attr('data-telefone');
                celular = $(this).attr('data-celular');
                email = $(this).attr('data-email');

                document.getElementById('idUpdate').value = id_detail;



                rTitulo.innerHTML = nome;
                rNome.innerHTML = nome;
                rRg.innerHTML = rg;
                rCpf.innerHTML = cpf;
                rDataNasc.innerHTML = datanasc;
                rDataAssociacao.innerHTML = dataasso;
                rLocal.innerHTML = local;
                rCargo.innerHTML = cargo;
                rSalario.innerHTML = salario;
                rRegistro.innerHTML = registro;
                rSituacao.innerHTML = situacao;
                rRua.innerHTML = rua;
                rNumero.innerHTML = numero;
                rBairro.innerHTML = bairro;
                rCep.innerHTML = cep;
                rCidade.innerHTML = cidade;
                rComplemento.innerHTML = complemento;
                rTelefone.innerHTML = telefone;
                rCelular.innerHTML = celular;
                rEmail.innerHTML = email;
                rAssociado.innerHTML = id_detail;
            });
        });
    });
</script>
