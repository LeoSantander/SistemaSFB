<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Cadastro de Local de Trabalho</h3>
            <hr>
            <?php if($Sessao::retornaMensagem()){ ?>
                <div class="alert alert-warning" role="alert"><?php echo $Sessao::retornaMensagem(); ?></div>

            <?php } ?>
            <?php if($Sessao::retornaSucesso()){ ?>
                <div class="alert alert-success" role="alert"><?php echo $Sessao::retornaSucesso(); ?></div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/cidade/salvar" method="post">
            <div class="form-group">
            
            <div class="form-group">
                    <label for="nome">Sigla Local(Opcional): </label>
                    <input type="text" class="form-control"  name="sglocal" placeholder="" value="<?php echo $Sessao::retornaValorFormulario('sglocal'); ?>"> 
            </div>
            <div class="form-group">
                    <label for="nome">Nome Fantasia:</label>
                    <input type="text" class="form-control"  name="fantasia" placeholder="Ex.: Auto Posto Marilia" value="<?php echo $Sessao::retornaValorFormulario('fantasia'); ?>" required oninvalid="this.setCustomValidity('Este é um campo obrigatório')" onchange="try{setCustomValidity('')}catch(e){}"> 
            </div>
            </div>
            <div class="form-group">
                    <label for="nome">CNPJ:</label>
                    <input type="text" class="form-control"  name="cnpj" placeholder=" " value="<?php echo $Sessao::retornaValorFormulario('cnpj'); ?>" pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}"> 
            </div>
            
            <h5>Endereço:</h5>
            <hr>
            <div class="form-group">
                    <label for="nome">Rua:</label>
                    <input type="text" class="form-control"  name="rua" placeholder="EX.: Rua Nove de Julho" value="<?php echo $Sessao::retornaValorFormulario('rua'); ?>" required oninvalid="this.setCustomValidity('Este é um campo obrigatório')" onchange="try{setCustomValidity('')}catch(e){}"> 
            </div>

            <div class="form-group">
                    <label for="nome">Bairro:</label>
                    <input type="text" class="form-control"  name="bairro" placeholder="EX.: Bairro Nova Marilia" value="<?php echo $Sessao::retornaValorFormulario('bairro'); ?>" required oninvalid="this.setCustomValidity('Este é um campo obrigatório')" onchange="try{setCustomValidity('')}catch(e){}"> 
            </div>

            <div class="form-group">
                    <label for="nome">Numero:</label>
                    <input type="text" class="form-control"  name="numero" placeholder="EX.: 871" value="<?php echo $Sessao::retornaValorFormulario('rua'); ?>" required oninvalid="this.setCustomValidity('Este é um campo obrigatório')" onchange="try{setCustomValidity('')}catch(e){}"> 
            </div>
            
            <label for="cidade">Cidade:</label>
	        <select class="form-control" name= "cidade" value="<?php echo $Sessao::retornaValorFormulario('cidade'); ?>">
                <option name="estado" value="">Selecione uma Cidade</option>            
		       <!-- Preciso que o Cadastro de cidade esteja pronto e a function consultar cidade também -->
                <?php foreach($viewVar['listarCidades'] as $cidade){?>
	                <option  name="estado" value= "<?php echo $cidade->ID_Cidade;?>"><?php echo $cidade->NM_Cidade;?> - <?php echo $cidade->CD_Estado;?></option>
                <?php } ?>
            </select required> 
            <br>
            <h5>Contato:</h5>
            <hr>
            <div class="form-group">
                    <label for="telefone">Telefone:</label>
                    <input type="telefone" class="form-control"  name="telefone" placeholder="EX.: (14) 3300-3000" value="<?php echo $Sessao::retornaValorFormulario('telefone'); ?>" required oninvalid="this.setCustomValidity('Este é um campo obrigatório')" onchange="try{setCustomValidity('')}catch(e){}"> 
            </div>

            <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control"  name="email" placeholder="EX.: nome@dominio.com" value="<?php echo $Sessao::retornaValorFormulario('email'); ?>" required oninvalid="this.setCustomValidity('Este é um campo obrigatório')" onchange="try{setCustomValidity('')}catch(e){}"> 
            </div>
            
                <button type="submit" class="btn btn-success">Salvar</button>
                <a href="http://<?php echo APP_HOST; ?>/home/" class="btn btn-outline-danger">Cancelar</a>

            </div> 
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>
