<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <h3>Editar Associado</h3>
            <hr>

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

            <form action="http://<?php echo APP_HOST; ?>/associado/atualizar" method="post">
                <input type="hidden" name="id" value="<?php echo $viewVar['associado']->ID_Associado?>">

                <div class="form-group">
                    <label for="nome">Nome Completo:</label>
                    <input type="text" class="form-control" name="nome" placeholder="Nome Completo" pattern="[A-Za-zÀ-ú ]{0,}"
                           title="Use somente letras. Não use caracteres especiais ou números."value="<?php echo $viewVar['associado']->NM_Associado?>"
                           required autofocus>
                </div>

                <label for="local">Local de Trabalho:</label>
                    <div class="form-group">
                      <select class="form-control" name= "local" value="" required>
                          <option name= "local" value="">Selecione um Local</option>

                        <?php foreach($viewVar['listarLocais'] as $local){
                                if($viewVar['associado']->ID_Local_Trabalho== $local->ID_Local_Trabalho){?>
                                    <option selected="selected" name="local" value= "<?php echo $local->ID_Local_Trabalho;?>"><?php echo $local->NM_Fantasia;?></option>
                                <?php }
                                else{?>
                                  <option name="local" value= "<?php echo $local->ID_Local_Trabalho;?>"><?php echo $local->NM_Fantasia;?></option>
                                 <?php } ?>
                             <?php } ?>
                    </select>
                    </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cargo">Cargo:</label>
                        <input type="text" class="form-control" name="cargo" placeholder="Administrativo" value="<?php echo $viewVar['associado']->Cargo?>" pattern= "[A-Za-zÀ-ú ]{0,}"
                            title="Preencha de acordo com o que foi solicitado."autofocus>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="salario">Salário Base:</label>
                        <input type="tel" class="form-control" name="salario" maxlength="15" placeholder="$" value="<?php echo $viewVar['associado']->VL_Salario?>" onKeyPress="return(mMoeda(this,'.',',',event))" pattern= "([0-9]{1,3}\.)?[0-9]{1,3},[0-9]{2}$"
                            title="Preencha de acordo com o que foi solicitado."required autofocus>
                    </div>

                </div>
                <div class="form-group">
                        <label for="situacao">Situação Atual:</label>
                        <select name= "situacao" class="form-control" value="<?php echo $viewVar['associado']->ST_Situacao?>" required>
                            <option name="situacao" value="">Selecione</option>
                            <?php if ($viewVar['associado']->ST_Situacao == "Ativo") {?>
                              <option name="situacao" value="Ativo" selected >Ativo</option>
                              <option name="situacao" value="Inativo">Inativo</option>
                              <option name="situacao" value="Desligado">Desligado</option>
                            <?php } else if ($viewVar['associado']->ST_Situacao == "Inativo"){?>
                              <option name="situacao" value="Ativo" >Ativo</option>
                              <option name="situacao" value="Inativo" selected>Inativo</option>
                              <option name="situacao" value="Desligado">Desligado</option>
                            <?php } else if ($viewVar['associado']->ST_Situacao == "Desligado"){?>
                              <option name="situacao" value="Ativo" >Ativo</option>
                              <option name="situacao" value="Inativo" >Inativo</option>
                              <option name="situacao" value="Desligado" selected>Desligado</option>
                            <?php } ?>
                        </select>
                </div>

                <div class="form-row">
                  <label for="check">Convênios Aderidos:</label>
                </div>
                <?php $i=0;$teste=0;
                //var_dump($viewVar['ConvenioAssociado']);

                foreach($viewVar['listarConvenios'] as $convenios){ ?>
                <div class="form-row">
                  <div class="form-check">
                      <?php
                      foreach($viewVar['ConvenioAssociado'] as $convenioAssoc){
                          if($convenios->ID_Convenio == $convenioAssoc->ID_Convenio)
                              $teste = $convenioAssoc->ID_Convenio;
                       } ?>
                  </div>
                  <input type="checkbox" class="checkbox" id="check<?php echo $i?>" name="check<?php echo $i?>" value="<?php echo $convenios->ID_Convenio;?>" <?php if($convenios->ID_Convenio == $teste)echo "checked";?>>
                  <label class="form-check-label" for="check<?php echo $i?>"><?php echo $convenios->NM_Convenio; ?></label>
                </div>
                <?php $i++; } ?>

                <input type="hidden" class="form-control"  name="qtdConvenios" value="<?php echo  $i; ?>">


                <br><h5>Endereço:</h5>
                <hr>

                <div class="form-row">
                    <div class="form-group col-md-10">
                        <label for="rua">Rua:</label>
                        <input type="text" class="form-control"  name="rua" placeholder=" Rua Nove de Julho" value="<?php echo $viewVar['associado']->NM_Rua?>" pattern="[A-Za-zÀ-ú ]{0,}"
                            title="Use somente letras. Não use caracteres especiais ou números." required autofocus>
                    </div>

                    <div class="form-group col-md-2">
                        <label for="numero">Numero:</label>
                        <input type="text" class="form-control" maxlength="5" name="numero" placeholder="000" value="<?php echo $viewVar['associado']->NO_Endereco?>"
                            pattern="[0-9]+$" onkeydown="javascript: fMasc( this, mNum );" required autofocus>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="bairro">Bairro:</label>
                        <input type="text" class="form-control" name="bairro" placeholder="Bairro Nova Marilia" value="<?php echo $viewVar['associado']->NM_Bairro?>" pattern="[A-Za-zÀ-ú ]{0,}"
                            title="Use somente letras. Não use caracteres especiais ou números." required autofocus>
                    </div>

                    <div class="form-group col-4">
                        <label for="cep">CEP:</label>
                        <input type="text" class="form-control" name="cep" maxlength="10" placeholder="00.000-000"  value="<?php echo $viewVar['associado']->CEP?>" pattern= "[0-9]{2}.[0-9]{3}-[0-9]{3}"
                            title="Preencha de acordo com o que foi solicitado." onkeydown="javascript: fMasc( this, mCEP );" required autofocus>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="complemento">Complemento:</label>
                        <input type="text" class="form-control" name="complemento" placeholder="Casa"  value="<?php echo $viewVar['associado']->Complemento?>" pattern="[A-Za-zÀ-ú ]{0,}"
                              title="Use somente letras. Não use caracteres especiais ou números." autofocus>
                    </div>
                    <div class="form-group col-6 ">
                        <label for="cidade">Cidade:</label>
                            <select class="form-control" name= "cidade" value="" required>
                                <option name= "cidade" value="">Selecione Cidade</option>

                          <?php foreach($viewVar['listarCidades'] as $cidade){
                                  if($viewVar['associado']->ID_Cidade == $cidade->ID_Cidade){?>
                                      <option selected="selected" name="cidade" value= "<?php echo $cidade->ID_Cidade;?>"><?php echo $cidade->NM_Cidade;?> - <?php echo $cidade->CD_Estado;?></option>
                                  <?php }
                                  else{?>
                                    <option name="cidade" value= "<?php echo $cidade->ID_Cidade;?>"><?php echo $cidade->NM_Cidade;?> - <?php echo $cidade->CD_Estado;?></option>
                                   <?php } ?>
                               <?php } ?>
                          </select>
                    </div>
              </div>


                <br><h5>Contato:</h5>
                <hr>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="telefone">Telefone:</label>
                        <input type="text" maxlength="14" class="form-control"  name="telefone" placeholder="(14) 3300-3000"
                             value="<?php echo $viewVar['associado']->Telefone?>" pattern="\([0-9]{2}\)[0-9]{4,6}-[0-9]{3,4}$"
                            title="Este campo deve atender ao formato solicitado!"  onkeydown="javascript: fMasc( this, mTel );" autofocus>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="celular">Celular:</label>
                        <input type="text" maxlength="14" class="form-control"  name="celular" placeholder="(14) 9876-1302"
                             value="<?php echo $viewVar['associado']->Celular?>" pattern="\([0-9]{2}\)[0-9]{4,6}-[0-9]{3,4}$"
                            title="Este campo deve atender ao formato solicitado!"  onkeydown="javascript: fMasc( this, mTel );" required autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control"  name="email" placeholder="nome@email.com"  value="<?php echo $viewVar['associado']->Email?>"
                           pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Este campo deve atender ao formato solicitado: nome@email.com" autofocus>
                </div>


                <div>
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <a href="http://<?php echo APP_HOST; ?>/home/" class="btn btn-outline-danger">Cancelar</a>
                </div>
            </form>

        </div>
        <div class="col-md-3"></div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="exampleModalCenterTitle">Adicionar nova Cidade</span></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
				<div class="modal-body">
					<!--Montando o formulário-->
                    <form action="http://<?php echo APP_HOST; ?>/cidade/salvar" method="post">
                <!-- Só um campo para validar na action e depois retornar na view -->
                <input type="hidden" class="form-control"  name="id" placeholder="" value="AA">

                <!--Campo Nome-->
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control"  name="nome" placeholder="Ex: Ourinhos" value="<?php echo $Sessao::retornaValorFormulario('nome'); ?>"
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
                <h5 class="modal-title" id="exampleModalCenterTitle">Adicionar novo Local</span></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
			<div class="modal-body">

                <form action="http://<?php echo APP_HOST; ?>/localTrabalho/salvar" method="post">
                    <input type="hidden" class="form-control"  name="id" placeholder="" value="AA">
                <div class="form-group">

                <div class="form-group">
                        <label for="nome">Sigla Local(Opcional): </label>
                        <input type="text" class="form-control"  name="sglocal" placeholder="" value="<?php echo $Sessao::retornaValorFormulario('sglocal'); ?>">
                </div>
                <div class="form-group">
                        <label for="nome">Nome Fantasia:</label>
                        <input type="text" class="form-control"  name="fantasia" placeholder="Auto Posto Marilia" value="<?php echo $Sessao::retornaValorFormulario('fantasia'); ?>"
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
                        <input type="text" class="form-control"  name="rua" placeholder=" Rua Nove de Julho" value="<?php echo $Sessao::retornaValorFormulario('rua'); ?>" pattern="[A-Za-zÀ-ú ]{0,}"
                            title="Use somente letras. Não use caracteres especiais ou números." required autofocus>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="numero">Numero:</label>
                        <input type="text" class="form-control" maxlength="5" name="numero" placeholder="000" value="<?php echo $Sessao::retornaValorFormulario('numero'); ?>"
                            pattern="[0-9]+$" onkeydown="javascript: fMasc( this, mNum );" required autofocus>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-9">
                        <label for="nome">Bairro:</label>
                        <input type="text" class="form-control" name="bairro" placeholder="Bairro Nova Marilia" value="<?php echo $Sessao::retornaValorFormulario('bairro'); ?>" pattern="[A-Za-zÀ-ú ]{0,}"
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
                        <input type="telefone" maxlength="14" class="form-control"  name="telefone" placeholder="(14) 3300-3000"
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
				</div>
			</div>
		</div>
	</div>
