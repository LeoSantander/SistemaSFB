<?php
    //Se não existe Usuário na Sessão, redireciona para Login
    if(!($Sessao::retornaUsuario())){
        $Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
        $this->redirect('login/');
        //Senão se Usuário da Sessão não é Administrador, Retorna para Home!
    } else if (!($Sessao::retornaTPUsuario() == 'Administrador')){
        $this->redirect('home/');
    }
?>
<div class="container">
	    <div class="row">
            <div class="col-md-6">
    		    <h3>Locais de Trabalho Cadastrados</h3>
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
            </div>
	    </div>
    
    <hr>
    
    <?php 
       // if(!count($viewVar['listarLocais'])){
    ?>    
        <div class="alert alert-info" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
            Nenhum Local encontrado!
        </div>
    <?php 
       // }
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
            <th width="20%" scope="col">Endereco</th>
            <th width="10%" scope="col">Telefone</th>
            <th width="20%" scope="col">Email</th>
            <th width="30%" scope="col">Ações</th>
        </tr>
    </thead>
        <?php //foreach($viewVar['listarLocais'] as $locais){?>
		    <tr>
                <td>Teste<?php //echo $locais->NM_Pessoa;?></td>
                <td>teste<?php //echo $locais->NM_Usuario;?></td>
			    <td>teste<?php //echo $locais->CPF_Usuario;?></td>
			    <td>teste<?php //echo $locais->TP_Usuario;?></td>
			    <td align="center">
				    <a href='#' class="btn btn-info btn sm">Editar</a>
                    <a href='#' class="btn btn-secondary btn sm" data-toggle="modal" data-target="#exampleModalCenter">Detalhes</a>
				    <a href='#' class="btn btn-danger btn sm">Excluir</a>
		        </td>
	        </tr>	
	    <?php // }?>
    </table>
    
     <a href='#' class="btn btn-info btn sm">Listar Tudo</a>
    </div>
</div> 
    <!-- Abrir a Modal que será utilizada como detalhes -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Detalhes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>Nome: </strong> <br>
                    <strong>Endereço: </strong> <br>
                    <strong>Telefone: </strong> <br>
                    <strong>Email: </strong> <br>
                    <strong>CNPJ: </strong> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-info btn sm">Editar</button>
                </div>
             </div>
        </div>
    </div>
 