<?php
//Solicitando login para acessar o sistema
    if(!($Sessao::retornaUsuario())){
        $Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
        $this->redirect('login/');
    }
?>

<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Editar Cidade</h3>

            <?php if($Sessao::retornaSucesso()){ ?>
                <div class="alert alert-success" role="alert"><?php echo $Sessao::retornaSucesso(); ?></div>
            <?php } ?>

            <?php if($Sessao::retornaMensagem()){//Retorna mensagem de erro?>
                <div class="alert alert-warning" role="alert"><?php echo $Sessao::retornaMensagem(); ?></div><hr>
            <?php }?>

            <form action="http://<?php echo APP_HOST; ?>/cidade/atualizar" method="post">
                <input type="hidden" class="form-control" name="idCidade" id="idCidade" value="<?php echo $viewVar['cidade']->ID_Cidade; ?>">
                
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control"  name="nome" placeholder="Nome Completo" value="<?php echo $viewVar['cidade']->NM_Cidade; ?>" required pattern="[A-Za-zÀ-ú ]{0,}" 
                           title="Não use caracteres especiais ou números">
                </div>

            
            <!--Campo Estado-->
            <div class="form-group">
	        <label for="estado">Estado:</label>
                    
	        <!-- Inicie a ComboBox --> 
	        <select class="form-control" name= "estado" value="" required>
                <option name= "estado" value="">Selecione Estado</option>

		        <?php foreach($viewVar['listarEstados'] as $estados){

                    if($viewVar['cidade']->ID_Estado == $estados->ID_Estado){?>
                        <option selected="selected" name="estado" value= "<?php echo $estados->ID_Estado;?>"><?php echo $estados->NM_Estado;?> - <?php echo $estados->CD_Estado;?></option>
                    <?php }
                    else{?>

	                    <option name="estado" value= "<?php echo $estados->ID_Estado;?>"><?php echo $estados->NM_Estado;?> - <?php echo $estados->CD_Estado;?></option>
                     <?php } ?>
   
                 <?php } ?>
            </select>
            </div> 
               
                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                <a href="http://<?php echo APP_HOST; ?>/cidade/consultar" class="btn btn-info btn-sm">Voltar</a>
            </form>
            
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>
