<?php
    if(!($Sessao::retornaUsuario())){
        $Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
        $this->redirect('login/');
    } else if (!($Sessao::retornaTPUsuario() == 'Administrador')){
        $this->redirect('home/');
    }
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<div class="container">
	    <div class="row">
            <div class="col-md-6">
    		    <h3>Usuários Cadastrados</h3>
                <form action="http://<?php echo APP_HOST; ?>/usuario/consultar/" method="post" id="form_cadastro">
                <div id="custom-search-input">
                    <div class="input-group col-md-12">
                        <input type="text" name="buscar" value="<?php echo $Sessao::retornaValorFormulario('buscar'); ?>" class="form-control input-lg" placeholder="Buscar" />
                        <span class="input-group-btn">
                            <button id="enviar" onclick ="http://<?php echo APP_HOST; ?>/usuario/consultar/" class="btn btn-info btn-lg" type="submit">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </span>
                    </div>
                </div>
                </form>
            </div>
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
                <div class="alert alert-warning" role="alert"><?php echo $Sessao::retornaMensagem(); ?></div>
    <?php } ?>
    
    <?php if($Sessao::retornaSucesso()){ ?>
                <div class="alert alert-success" role="alert"><?php echo $Sessao::retornaSucesso(); ?></div>
     <?php } ?>

    <div class="table table-responsive">
    <table class="table table-bordered table-hover">
        <tr class = 'active'>
            <td align='center'><h4>Nome</h4></td>
            <td align='center'><h4>Usuário</h4></td>
            <td align='center'><h4>CPF</h4></td>
            <td align='center'><h4>Tipo de Usuário</h4></td>
            <td align='center'><h4>Ações</h4></td>
        </tr>   
        <?php foreach($viewVar['listarUsuarios'] as $usuarios){?>
		    <tr>
                <td><?php echo $usuarios->NM_Pessoa;?></td>
                <td><?php echo $usuarios->NM_Usuario;?></td>
			    <td><?php echo $usuarios->CPF_Usuario;?></td>
			    <td><?php echo $usuarios->TP_Usuario;?></td>
			    <td align="center">
				    <a href='http://<?php echo APP_HOST;?>/usuario/alterar/<?php echo $usuarios->ID_Usuario?>' class="btn btn-info btn sm">Editar</a>
				    <a href='http://<?php echo APP_HOST;?>/usuario/exclusao/<?php echo $usuarios->ID_Usuario?>' class="btn btn-danger btn sm">Excluir</a>
		        </td>
	        </tr>	
	    <?php }?>
    </table>
    
    <a href='http://<?php echo APP_HOST; ?>/usuario/consultar/' class="btn btn-info btn sm">Listar Tudo</a>
    </div>
