<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Alterar Local de Trabalho</h3>
            <hr>
            <?php if($Sessao::retornaMensagem()){ ?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <?php echo $Sessao::retornaMensagem(); ?>
                </div>
            <?php } ?>
            <?php if($Sessao::retornaSucesso()){ ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $Sessao::retornaSucesso(); ?>
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                </div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/localTrabalho/atualizar" method="post">
            <div class="form-group">

            <input type="hidden" class="form-control"  name="id" placeholder="" value="<?php echo $viewVar['localTrabalho']->ID_Local_Trabalho; ?>"> 
            
            <div class="form-group">
                    <label for="nome">Sigla Local: </label>
                    <input type="text" class="form-control"  name="sglocal" placeholder="" value="<?php echo $viewVar['localTrabalho']->CD_Local_Trabalho; ?>"> 
            </div>
            <div class="form-group">
                    <label for="nome">Nome Fantasia:</label>
                    <input type="text" class="form-control"  name="fantasia" placeholder="Auto Posto Marilia" value="<?php echo $viewVar['localTrabalho']->NM_Fantasia; ?>" 
                           title="Este campo não pode estar vazio." required autofocus> 
            </div>
            </div>
            <div class="form-group">
                    <label for="cnpj">CNPJ:</label>
                    <input type="text"  maxlength="18"  class="form-control"  name="cnpj" placeholder=" " 
                        value="<?php echo $viewVar['localTrabalho']->CNPJ; ?>" 
                        oninvalid="this.setCustomValidity('Este campo deve estar preenchido e atender ao padrão exigido: 000.000.000-00')" onchange="try{setCustomValidity('')}catch(e){}"  pattern="[0-9]{2}.[0-9]{3}.[0-9]{3}/[0-9]{4}-[0-9]{2}" 
                        onkeydown="javascript: fMasc( this, mCNPJ );"> 
            </div>
            
            <h5>Endereço:</h5>
            <hr>
            <div class="form-row">
                <div class="form-group col-md-10">
                    <label for="rua">Rua:</label>
                    <input type="text" class="form-control"  name="rua" placeholder=" Rua Nove de Julho" 
                           value="<?php echo $viewVar['localTrabalho']->NM_Rua; ?>" pattern="[A-Za-zÀ-ú ]{0,}" 
                           title="Use somente letras. Não use caracteres especiais ou números." required autofocus> 
                </div>
                <div class="form-group col-md-2">
                    <label for="numero">Numero:</label>
                    <input type="text" class="form-control" maxlength="5" name="numero" placeholder="000" 
                        value="<?php echo $viewVar['localTrabalho']->NO_Endereco; ?>" 
                        pattern="[0-9]+$" onkeydown="javascript: fMasc( this, mNum );" required autofocus> 
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="bairro">Bairro:</label>
                    <input type="text" class="form-control" name="bairro" placeholder="Bairro Nova Marilia" 
                           value="<?php echo $viewVar['localTrabalho']->NM_Bairro; ?>" pattern="[A-Za-zÀ-ú ]{0,}" 
                           title="Use somente letras. Não use caracteres especiais ou números." required autofocus> 
                </div>
                <div class="form-group col-md-4">
                    <label for="cep">CEP:</label>
                    <input type="text" class="form-control" maxlength="10" name="cep" placeholder="00.000-00" 
                           value="<?php echo $viewVar['localTrabalho']->CEP; ?>" pattern= "[0-9]{2}.[0-9]{3}-[0-9]{3}"
                           title="Preencha conforme solicitado" onkeydown="javascript: fMasc( this, mCEP );" required autofocus> 
                </div>
            </div>
            <div class="form-group">   
                <label for="cidade">Cidade:</label>
                <select class="form-control" name= "cidade" value="" required>
                    <option name= "cidade" value="">Selecione uma Cidade</option>
		            <?php foreach($viewVar['listarCidades'] as $cidades){
                        if ($cidades->ID_Cidade == $viewVar['localTrabalho']->CIDADE){?>
                            <option selected name="cidade" value= "<?php echo $cidades->ID_Cidade;?>"><?php echo $cidades->NM_Cidade;?> - <?php echo $cidades->CD_Estado;?></option>
                        <?php } ?>
                        <option name="cidade" value= "<?php echo $cidades->ID_Cidade;?>"><?php echo $cidades->NM_Cidade;?> - <?php echo $cidades->CD_Estado;?></option>
                    <?php } ?>
                </select>
            </div>

            <br>
            <h5>Contato:</h5>
            <hr>
            <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <input type="telefone" maxlength="14" class="form-control"  name="telefone" placeholder="(XX)0000-0000" 
                        value="<?php echo $viewVar['localTrabalho']->Telefone; ?>" pattern="\([0-9]{2}\)[0-9]{4,6}-[0-9]{3,4}$"
                        title="Este campo deve atender ao formato solicitado!"  onkeydown="javascript: fMasc( this, mTel );" required autofocus> 
            </div>

            <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control"  name="email" placeholder="nome@dominio.com" 
                        value="<?php echo $viewVar['localTrabalho']->Email; ?>"
                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Este campo deve atender ao formato solicitado: nome@dominio.com" required autofocus> 
            </div>
            <hr>
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="http://<?php echo APP_HOST; ?>/localTrabalho/Consultar" class="btn btn-outline-danger">Cancelar</a>

            </div> 
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>
