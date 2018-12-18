<?php
    if(!($Sessao::retornaUsuario())){
        $Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
        $this->redirect('login/');
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

            <?php if($Sessao::retornaSucesso()){ ?>
                <div class="alert alert-success" role="alert"><?php echo $Sessao::retornaSucesso(); ?></div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/usuario/atualizar" method="post" id="form_cadastro">
                <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $viewVar['usuario']->ID_Usuario; ?>">
                
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control"  name="nome" placeholder="Nome Completo" value="<?php echo $viewVar['usuario']->NM_Pessoa; ?>" required>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="cpf" maxlength="11" class="form-control" readonly="true" placeholder="Somente Números" name="cpf" placeholder="" value="<?php echo $viewVar['usuario']->CPF_Usuario; ?>" required>
                </div>
                <div class="form-group">
                    <label for="usuario">Usuário</label>
                    <input type="usuario" class="form-control" name="usuario" placeholder="Ex.: Nome.sobrenome" value="<?php echo $viewVar['usuario']->NM_Usuario; ?>" required>
                </div>
                
                <div class="form-group">
                    <table>
                        <tr>
                            <td><label for="senha">Senha</label></td>
                        </tr>
                        <tr>
                           <td>
                                <input type="password" id="password" class="form-control" name="senha" placeholder="Senha para acessar ao sistema" value="<?php echo $viewVar['usuario']->Senha_Usuario; ?>" required>
                            </td>
                            <td>
                                <input type="button" onclick="mostraSenha()" id="showPassword" value="Exibir Senha" class="btn btn-success btn-sm" />
                            </td>
                        </tr>
                    </table>    
                </div>
                <div class="form-group">
                    <label for="tpusuario">Tipo Usuario</label>
                    <select name= "tpusuario" value="<?php echo $viewVar['usuario']->Senha_Usuario; ?>">
                        <option class="form-control" name="tpusuario" value="Administrador">Administrador</option>
                        <option class="form-control" name="tpusuario" value="Padrao">Padrão</option>
                    </select required> 
                </div>

                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                <a href="http://<?php echo APP_HOST; ?>/usuario/consultar" class="btn btn-info btn-sm">Voltar</a>
            </form>
            
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>