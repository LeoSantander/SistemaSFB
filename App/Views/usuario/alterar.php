<?php
    if(!($Sessao::retornaUsuario())){
        $Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
        $this->redirect('login/');
    } else if (!($Sessao::retornaTPUsuario() == 'Administrador')){
        $this->redirect('home/');
    }
?>
<script>
function mostraSenha(){
    document.getElementById("password").type = "text";
    var btn = document.getElementById("showPassword");
    btn.setAttribute('onclick', 'ocultaSenha()');
    document.getElementById("showPassword").value="Ocultar Senha";
}  
function ocultaSenha(){
    document.getElementById("password").type = "password";
    var btn = document.getElementById("showPassword");
    btn.setAttribute('onclick', 'mostraSenha()');
    document.getElementById("showPassword").value ="Exibir Senha";
}
</script>
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Editar Usuário</h3>

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

            <form action="http://<?php echo APP_HOST; ?>/usuario/atualizar" method="post">
                <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $viewVar['usuario']->ID_Usuario; ?>">
                
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control"  name="nome" placeholder="Nome Completo" value="<?php echo $viewVar['usuario']->NM_Pessoa; ?>" required oninvalid="this.setCustomValidity('Este é um campo obrigatório')" onchange="try{setCustomValidity('')}catch(e){}">
                </div>
                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="cpf" maxlength="11" class="form-control" readonly="true" placeholder="Somente Números" name="cpf" placeholder="" value="<?php echo $viewVar['usuario']->CPF_Usuario; ?>">
                </div>
                <div class="form-group">
                    <label for="usuario">Usuário</label>
                    <input type="usuario" class="form-control" name="usuario" placeholder="Ex.: Nome.sobrenome" value="<?php echo $viewVar['usuario']->NM_Usuario; ?>" required oninvalid="this.setCustomValidity('Este é um campo obrigatório')" onchange="try{setCustomValidity('')}catch(e){}">
                </div>
                
                <div class="form-group">
                    <table>
                        <tr>
                            <td><label for="senha">Senha</label></td>
                        </tr>
                        <tr>
                           <td>
                                <input type="password" id="password" class="form-control" name="senha" placeholder="Senha para acessar ao sistema" value="<?php echo $viewVar['usuario']->Senha_Usuario; ?>" required oninvalid="this.setCustomValidity('Este é um campo obrigatório')" onchange="try{setCustomValidity('')}catch(e){}">
                            </td>
                            <td>
                                <input type="button" onclick="mostraSenha()" id="showPassword" value="Exibir Senha" class="btn btn-success btn-sm" />
                            </td>
                        </tr>
                    </table>    
                </div>
                <div class="form-group">
                    <label for="tpusuario">Tipo Usuario</label>
                    <select class="form-control" name= "tpusuario" value="<?php echo $viewVar['usuario']->Senha_Usuario; ?>">
                        <option name="tpusuario" value="Administrador">Administrador</option>
                        <option name="tpusuario" value="Padrao">Padrão</option>
                    </select required> 
                </div>

                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                <a href="http://<?php echo APP_HOST; ?>/usuario/consultar" class="btn btn-info btn-sm">Voltar</a>
            </form>
            
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>