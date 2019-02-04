<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Cadastro de Associados</h3>
            <hr>

            <?php if($Sessao::retornaMensagem()){//Retorna mensagem de erro?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <?php echo $Sessao::retornaMensagem(); ?>
                </div>
            <?php }?>

            <?php if($Sessao::retornaSucesso()){//Retorna mensagem Associado cadastrado com sucesso!'?>
                <div class="alert alert-success" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <?php echo $Sessao::retornaSucesso()?>
                </div>
            <?php }?>

            <form action="http://<?php echo APP_HOST; ?>/associado/salvar" method="post">
                <div class="form-group">
                    <label for="nome">Nome Completo:</label>
                    <input type="text" class="form-control" name="nome" pattern="[A-Za-zÀ-ú ]{0,}"
                           title="Use somente letras. Não use caracteres especiais ou números." value="<?php echo $Sessao::retornaValorFormulario('nome'); ?>"
                           required autofocus>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="rg">RG:</label>
                        <input type="rg" class="form-control" name="rg" placeholder="000000000" maxlength="9" pattern="[0-9]{8}[0-9xX]{1}"
                               title="Digite somente números com 9 digitos" value="<?php echo $Sessao::retornaValorFormulario('rg'); ?>" required >
                    </div>

                    <div class="form-group col-md-6">
                        <label for="cpf">CPF:</label>
                        <input type="cpf" id="cpf" maxlength="14" pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}"  class="form-control"
                               placeholder="000.000.000-00" name="cpf" placeholder="" value="<?php echo $Sessao::retornaValorFormulario('cpf'); ?>" required oninvalid="this.setCustomValidity('Este campo deve estar preenchido e atender ao padrão exigido: 000.000.000-00')" onchange="try{setCustomValidity('')}catch(e){}" onkeydown="javascript: fMasc( this, mCPF );">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="dataNasc">Data de Nascimento:</label>
                        <input type="date" id="dataNasc" name="dataNasc" class="form-control" value="<?php echo $Sessao::retornaValorFormulario('dataNasc'); ?>" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="dataAssociacao">Data de Associação:</label>
                        <input type="date" id="dataAssociacao" name="dataAssociacao" class="form-control" value="<?php echo date ('Y-m-d'); ?>" required>
                    </div>
                </div>
                <br><h5>Trabalho:</h5>
                <hr>
                <label for="local">Posto:</label>
                <div class="form-row">
                    <div class="form-group col-md-9">
	                    <select name= "local" class="form-control" value="<?php echo $Sessao::retornaValorFormulario('local'); ?>" required>
                            <option name="local" value="">Selecione um Posto</option>
                            <?php foreach($viewVar['listarLocais'] as $local){?>
	                            <option  name="local" value= "<?php echo $local->ID_Local_Trabalho;?>"><?php echo $local->NM_Fantasia;?> - <?php echo $local->CD_Local_Trabalho;?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md">
                        <a class="btn btn-success btn-block" href="#" data-toggle="modal" data-placement="bottom" data-target="#myModal1" aria-hidden="true">+ Novo Posto</a>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cargo">Cargo:</label>
                        <input type="text" class="form-control" name="cargo"  value="<?php echo $Sessao::retornaValorFormulario('cargo'); ?>" pattern= "[A-Za-zÀ-ú ]{0,}"
                            title="Preencha de acordo com o que foi solicitado."autofocus>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="salario">Salário Base:</label>
                        <input type="tel" class="form-control" name="salario" maxlength="15" placeholder="R$" value="<?php echo $Sessao::retornaValorFormulario('salario'); ?>" onKeyPress="return(mMoeda(this,'.',',',event))" pattern= "([0-9]{1,3}\.)?[0-9]{1,3},[0-9]{2}$"
                            title="Preencha de acordo com o que foi solicitado."required autofocus>
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                            <label for="registro">Número de Registro:</label>
                            <input type="text" class="form-control" name="registro" maxlength="15" placeholder="-" value="<?php echo $Sessao::retornaValorFormulario('registro'); ?>" pattern= "[0-9]+$"
                                title="Preencha de acordo com o que foi solicitado."autofocus>
                    </div>

                    <div class="form-group col-md-6">
                            <label for="situacao">Situação Atual:</label>
                            <select name= "situacao" class="form-control" value="<?php echo $Sessao::retornaValorFormulario('situacao'); ?>" required>
                                <option name="situacao" value="">Selecione</option>
                                <option name="situacao" value="Ativo" selected >Ativo</option>
                                <option name="situacao" value="Inativo">Inativo</option>
                                <option name="situacao" value="Desligado">Desligado</option>
                            </select>
                    </div>
                </div>
                  <br><h5>Convênios:</h5>
                  <hr>
                <?php $i=0;
                foreach($viewVar['listarConvenios'] as $convenios){ ?>
                <div class="form-row">
                  <div class="form-check">
                      <input type="checkbox" class="checkbox" id="check<?php echo $i?>" name="check<?php echo $i?>" value="<?php echo $convenios->ID_Convenio;?>">
                      <label class="form-check-label" for="check<?php echo $i?>"><?php echo $convenios->NM_Convenio; ?></label>
                  </div>
                </div>
                <?php $i++; } ?>

                <input type="hidden" class="form-control"  name="qtdConvenios" value="<?php echo  $i; ?>">

                <br><h5>Endereço:</h5>
                <hr>

                <div class="form-row">
                    <div class="form-group col-md-10">
                        <label for="rua">Rua:</label>
                        <input type="text" class="form-control"  name="rua" value="<?php echo $Sessao::retornaValorFormulario('rua'); ?>" pattern="[A-Za-zÀ-ú ]{0,}"
                            title="Use somente letras. Não use caracteres especiais ou números." required autofocus>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="numero">Número:</label>
                        <input type="text" class="form-control" maxlength="5" name="numero" placeholder="000" value="<?php echo $Sessao::retornaValorFormulario('numero'); ?>"
                            pattern="[0-9]+$" onkeydown="javascript: fMasc( this, mNum );" required autofocus>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="bairro">Bairro:</label>
                        <input type="text" class="form-control" name="bairro"  value="<?php echo $Sessao::retornaValorFormulario('bairro'); ?>" pattern="[A-Za-zÀ-ú ]{0,}"
                            title="Use somente letras. Não use caracteres especiais ou números." required autofocus>
                    </div>

                    <div class="form-group col-4">
                        <label for="cep">CEP:</label>
                        <input type="text" class="form-control" name="cep" maxlength="10" placeholder="00.000-000" value="<?php echo $Sessao::retornaValorFormulario('cep'); ?>" pattern= "[0-9]{2}.[0-9]{3}-[0-9]{3}"
                            title="Preencha de acordo com o que foi solicitado." onkeydown="javascript: fMasc( this, mCEP );" required autofocus>
                    </div>
                </div>

                <label for="cidade">Cidade:</label>
                <div class="form-row">
                    <div class="form-group col-md-8">
	                    <select name= "cidade" class="form-control" value="<?php echo $Sessao::retornaValorFormulario('cidade'); ?>" required>
                            <option name="cidade" value="">Selecione uma Cidade</option>
                            <?php foreach($viewVar['listarCidades'] as $cidade){?>
	                            <option  name="cidade" value= "<?php echo $cidade->ID_Cidade;?>"><?php echo $cidade->NM_Cidade;?> - <?php echo $cidade->CD_Estado;?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-4">

                        <a class="btn btn-success btn-block" href="#" data-toggle="modal" data-placement="bottom" data-target="#myModal" aria-hidden="true">+ Nova Cidade</a>
                    </div>
                </div>

                <div class="form-group">
                        <label for="complemento">Complemento:</label>
                        <input type="text" class="form-control" name="complemento" value="<?php echo $Sessao::retornaValorFormulario('complemento'); ?>" pattern="[A-Za-zÀ-ú ]{0,}"
                            title="Use somente letras. Não use caracteres especiais ou números." autofocus>
                </div>

                <br><h5>Contato:</h5>
                <hr>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="telefone">Telefone:</label>
                        <input type="text" maxlength="14" class="form-control"  name="telefone" placeholder="(xx) xxxx-xxxx"
                            value="<?php echo $Sessao::retornaValorFormulario('telefone'); ?>" pattern="\([0-9]{2}\)[0-9]{4,6}-[0-9]{3,4}$"
                            title="Este campo deve atender ao formato solicitado!"  onkeydown="javascript: fMasc( this, mTel );" autofocus>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="celular">Celular:</label>
                        <input type="text" maxlength="14" class="form-control"  name="celular" placeholder="(xx) 9xxxx-xxxx"
                            value="<?php echo $Sessao::retornaValorFormulario('celular'); ?>" pattern="\([0-9]{2}\)[0-9]{4,6}-[0-9]{3,4}$"
                            title="Este campo deve atender ao formato solicitado!"  onkeydown="javascript: fMasc( this, mTel );" required autofocus>
                    </div>
                </div>


                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control"  name="email" placeholder="nome@email.com" value="<?php echo $Sessao::retornaValorFormulario('email'); ?>"
                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Este campo deve atender ao formato solicitado: nome@email.com" required autofocus>
                </div>

                <hr>
                    <button type="button" data-toggle="modal" data-target="#detalhes" data-placement="bottom" href="#" class="btn btn-success">Salvar</button>
                    <a href="http://<?php echo APP_HOST; ?>/home/" class="btn btn-outline-danger">Cancelar</a>

        </div>
    </div>
</div>

<div class="modal fade" id="detalhes" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalCenterTitle">Confirmação</span></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              Deseja adicionar dependentes?
            </div>
            <div class="modal-footer">
                <button type="submit" name="actionConcluir" value ="Concluir" class="btn btn-outline-primary btn-sm">Não, Concluir esta ação!</button>
                <button type="submit" name="actionCadDep" value ="CadDep" class="btn btn-success btn-sm">Sim, Adicionar Dependentes</button>
              </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalCenterTitle">Adicionar Nova Cidade</span></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
				<div class="modal-body">
					<!--Montando o formulário-->
                    <form action="http://<?php echo APP_HOST; ?>/cidade/salvar" method="post">
                <!-- Só um campo para validar na action e depois retornar na view -->
                <input type="hidden" class="form-control"  name="id" placeholder="" value="AS">

                <!--Campo Nome-->
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control"  name="nome" value="<?php echo $Sessao::retornaValorFormulario('nome'); ?>"
                           required pattern="[A-Za-zÀ-ú ]{0,}"
                           title="Não use caracteres especiais ou números">
                </div>

                <!--Campo Estado-->
            <div class="form-group">
	        <label for="estado">Estado:</label>

	        <!-- Inicie a ComboBox -->
	        <select required class="form-control" name= "estado" value="">
                <option name= "estado" value="">Selecione um Estado</option>

		        <?php foreach($viewVar['listarEstados'] as $estados){?>
	                <option  name="estado" value= "<?php echo $estados->ID_Estado;?>"><?php echo $estados->NM_Estado;?> - <?php echo $estados->CD_Estado;?></option>
                <?php } ?>

            </select>
            </div>
				</div>

				<div class="modal-footer">
				    <button type="button" class="btn btn-outline-primary btn-sm" data-dismiss="modal">Cancelar</button>
					  <button type="submit" class="btn btn-success">Salvar</button>
				</div>
			</div>
            </form>
		</div>
	</div>

<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalCenterTitle">Adicionar Novo Posto</span></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
			<div class="modal-body">

                <form action="http://<?php echo APP_HOST; ?>/localTrabalho/salvar" method="post">
                    <input type="hidden" class="form-control"  name="id" placeholder="" value="AS">
                <div class="form-group">

                <div class="form-group">
                        <label for="nome">Sigla Local(Opcional): </label>
                        <input type="text" class="form-control"  name="sglocal" placeholder="" value="<?php echo $Sessao::retornaValorFormulario('sglocal'); ?>">
                </div>
                <div class="form-group">
                        <label for="nome">Nome Fantasia:</label>
                        <input type="text" class="form-control"  name="fantasia" value="<?php echo $Sessao::retornaValorFormulario('fantasia'); ?>"
                            title="Este campo não pode estar vazio." required autofocus>
                </div>
                </div>
                <div class="form-group">
                        <label for="nome">CNPJ:</label>
                        <input type="text"  maxlength="18"  class="form-control"  name="cnpj" placeholder=" "
                            value="<?php echo $Sessao::retornaValorFormulario('cnpj'); ?>"
                            oninvalid="this.setCustomValidity('Este campo deve estar preenchido e atender ao padrão exigido: 000.000.000-00')" onchange="try{setCustomValidity('')}catch(e){}"  pattern="[0-9]{2}.[0-9]{3}.[0-9]{3}/[0-9]{4}-[0-9]{2}"
                            onkeydown="javascript: fMasc( this, mCNPJ );">
                </div>
                <br>
                <h5>Endereço:</h5>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-10">
                        <label for="nome">Rua:</label>
                        <input type="text" class="form-control"  name="rua" value="<?php echo $Sessao::retornaValorFormulario('rua'); ?>" pattern="[A-Za-zÀ-ú ]{0,}"
                            title="Use somente letras. Não use caracteres especiais ou números." required autofocus>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="numero">Número:</label>
                        <input type="text" class="form-control" maxlength="5" name="numero" placeholder="000" value="<?php echo $Sessao::retornaValorFormulario('numero'); ?>"
                            pattern="[0-9]+$" onkeydown="javascript: fMasc( this, mNum );" required autofocus>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-9">
                        <label for="nome">Bairro:</label>
                        <input type="text" class="form-control" name="bairro" value="<?php echo $Sessao::retornaValorFormulario('bairro'); ?>" pattern="[A-Za-zÀ-ú ]{0,}"
                            title="Use somente letras. Não use caracteres especiais ou números." required autofocus>
                    </div>
                    <div class="form-group col-md-3">
                            <label for="cep">CEP:</label>
                            <input type="text" class="form-control" name="cep" maxlength="10" placeholder="00.000-000" value="<?php echo $Sessao::retornaValorFormulario('cep'); ?>" pattern= "[0-9]{2}.[0-9]{3}-[0-9]{3}"
                            title="Preencha de acordo com o que foi solicitado." onkeydown="javascript: fMasc( this, mCEP );" required autofocus>
                        </div>
                </div>

                <label for="cidade">Cidade:</label>
                <div class="form-row">
                    <div class="form-group col-md-12">

                            <select name= "cidade" class="form-control" value="<?php echo $Sessao::retornaValorFormulario('cidade'); ?>" required>
                                <option name="cidade" value="">Selecione uma Cidade</option>
                                <?php foreach($viewVar['listarCidades'] as $cidade){?>
                                    <option  name="cidade" value= "<?php echo $cidade->ID_Cidade;?>"><?php echo $cidade->NM_Cidade;?> - <?php echo $cidade->CD_Estado;?></option>
                                <?php } ?>
                            </select>
                    </div>
                </div>

                <br>
                <h5>Contato:</h5>
                <hr>
                <div class="form-group">
                        <label for="telefone">Telefone:</label>
                        <input type="telefone" maxlength="14" class="form-control"  name="telefone" placeholder="(xx) xxxx-xxxx"
                            value="<?php echo $Sessao::retornaValorFormulario('telefone'); ?>" pattern="\([0-9]{2}\)[0-9]{4,6}-[0-9]{3,4}$"
                            title="Este campo deve atender ao formato solicitado!"  onkeydown="javascript: fMasc( this, mTel );" required autofocus>
                </div>

                <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control"  name="email" placeholder="nome@dominio.com" value="<?php echo $Sessao::retornaValorFormulario('email'); ?>"
                            pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Este campo deve atender ao formato solicitado: nome@dominio.com" required autofocus>
                </div>

			</div>

				<div class="modal-footer">
				    <button type="button" class="btn btn-outline-primary btn-sm" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success">Salvar</button>
          </form>
				</div>
			</div>
		</div>
	</div>
