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
                    <input type="text" class="form-control" name="nome" placeholder="Nome Completo" pattern="[A-Za-zÀ-ú ]{0,}" 
                           title="Use somente letras. Não use caracteres especiais ou números." value="<?php echo $Sessao::retornaValorFormulario('nome'); ?>" 
                           required autofocus>
                </div>
            
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="rg">RG:</label>
                        <input type="rg" class="form-control" name="rg" placeholder="00.000.000-0" maxlength="9" pattern="[0-9]{8}[0-9xX]{1}" 
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
                
                <label for="local">Local de Trabalho:</label>
                <div class="form-row">
                    <div class="form-group col-md-9">
	                    <select name= "local" class="form-control" value="<?php echo $Sessao::retornaValorFormulario('local'); ?>" required>
                            <option name="local" value="">Selecione um Local</option>            
                            <?php foreach($viewVar['listarLocais'] as $local){?>
	                            <option  name="local" value= "<?php echo $local->ID_Local_Trabalho;?>"><?php echo $local->NM_Fantasia;?> - <?php echo $local->CD_Local_Trabalho;?></option>
                            <?php } ?>
                        </select> 
                    </div>

                    <div class="form-group"> 
                
                        <a class="btn btn-success" href="#" data-toggle="modal" data-placement="bottom" data-target="#myModal1" aria-hidden="true">+ Novo Local</a>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="cargo">Cargo:</label>
                        <input type="text" class="form-control" name="cargo" maxlength="10" placeholder="Administrativo" value="<?php echo $Sessao::retornaValorFormulario('cargo'); ?>" pattern= "[A-Za-zÀ-ú ]{0,}"
                            title="Preencha de acordo com o que foi solicitado."required autofocus> 
                    </div>

                    <div class="form-group col-md-6">
                        <label for="registro">Número de Registro:</label>
                        <input type="text" class="form-control" name="registro" maxlength="10" placeholder="-" value="<?php echo $Sessao::retornaValorFormulario('registro'); ?>" pattern= "[0-9]+$"
                            title="Preencha de acordo com o que foi solicitado."required autofocus> 
                    </div>
                </div>
            
                <div class="form-row">
                    <div class="form-group col-md-12">
                            <label for="situacao">Situação Atual:</label>
                            <select name= "situacao" class="form-control" value="<?php echo $Sessao::retornaValorFormulario('situacao'); ?>" required> 
                                <option name="situacao" value="">Selecione</option>            
                                <option name="situacao" value="Ativo" selected >Ativo</option>
                                <option name="situacao" value="Inativo">Inativo</option>
                            </select> 
                    </div>
                </div>

                <br><h5>Endereço:</h5>
                <hr>


                <div class="form-row">
                    <div class="form-group col-md-10">
                        <label for="rua">Rua:</label>
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
                    <div class="form-group col-md-8">
                        <label for="bairro">Bairro:</label>
                        <input type="text" class="form-control" name="bairro" placeholder="Bairro Nova Marilia" value="<?php echo $Sessao::retornaValorFormulario('bairro'); ?>" pattern="[A-Za-zÀ-ú ]{0,}" 
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
                    <div class="form-group col-md-9">
	                    <select name= "cidade" class="form-control" value="<?php echo $Sessao::retornaValorFormulario('cidade'); ?>" required>
                            <option name="cidade" value="">Selecione uma Cidade</option>            
                            <?php foreach($viewVar['listarCidades'] as $cidade){?>
	                            <option  name="cidade" value= "<?php echo $cidade->ID_Cidade;?>"><?php echo $cidade->NM_Cidade;?> - <?php echo $cidade->CD_Estado;?></option>
                            <?php } ?>
                        </select> 
                    </div>
                    
                    <div class="form-group col-md-3"> 
                
                        <a class="btn btn-success" href="#" data-toggle="modal" data-placement="bottom" data-target="#myModal" aria-hidden="true">+ Nova Cidade</a>
                    </div>
                </div>
                
                <div class="form-group">
                        <label for="complemento">Complemento:</label>
                        <input type="text" class="form-control" name="complemento" placeholder="Casa" value="<?php echo $Sessao::retornaValorFormulario('complemento'); ?>" pattern="[A-Za-zÀ-ú ]{0,}" 
                            title="Use somente letras. Não use caracteres especiais ou números."> 
                </div>

                <br><h5>Contato:</h5>
                <hr>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="telefone">Telefone:</label>
                        <input type="text" maxlength="14" class="form-control"  name="telefone" placeholder="(14) 3300-3000" 
                            value="<?php echo $Sessao::retornaValorFormulario('telefone'); ?>" pattern="\([0-9]{2}\)[0-9]{4,6}-[0-9]{3,4}$"
                            title="Este campo deve atender ao formato solicitado!"  onkeydown="javascript: fMasc( this, mTel );" required autofocus> 
                    </div>
                    <div class="form-group col-md-6">
                        <label for="celular">Celular:</label>
                        <input type="text" maxlength="14" class="form-control"  name="celular" placeholder="(14) 9876-1302" 
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
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <a href="http://<?php echo APP_HOST; ?>/home/" class="btn btn-outline-danger">Cancelar</a>
                </form>
                
        </div>
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
                <input type="hidden" class="form-control"  name="id" placeholder="" value="AS"> 
                
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
                    <input type="hidden" class="form-control"  name="id" placeholder="" value="AS"> 
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