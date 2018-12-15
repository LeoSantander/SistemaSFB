<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Cadastro de Usuário</h3>

            <?php if($Sessao::retornaMensagem()){ ?>
                <div class="alert alert-warning" role="alert"><?php echo $Sessao::retornaMensagem(); ?></div>
            <?php } ?>
            <?php if($Sessao::retornaSucesso()){ ?>
                <div class="alert alert-success" role="alert"><?php echo $Sessao::retornaSucesso(); ?></div>
            <?php } ?>

            <form action="http://<?php echo APP_HOST; ?>/usuario/salvar" method="post" id="form_cadastro">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control"  name="nome" placeholder="Nome Completo" value="<?php echo $Sessao::retornaValorFormulario('nome'); ?>" required>
                </div>
                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="cpf" maxlength="11" class="form-control" placeholder="Somente Números" name="cpf" placeholder="" value="<?php echo $Sessao::retornaValorFormulario('cpf'); ?>" required>
                </div>
                <div class="form-group">
                    <label for="usuario">Usuário</label>
                    <input type="usuario" class="form-control" name="usuario" placeholder="Ex.: Nome.sobrenome" value="<?php echo $Sessao::retornaValorFormulario('usuario'); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" class="form-control" name="senha" placeholder="Senha para acessar ao sistema" value="<?php echo $Sessao::retornaValorFormulario('senha'); ?>" required>
                </div>
                <div class="form-group">
                    <label for="tpusuario">Tipo Usuario</label>
                    <select name= "tpusuario" value="<?php echo $Sessao::retornaValorFormulario('tpusuario'); ?>">
                        <option class="form-control" name="tpusuario" value="Administrador">Administrador</option>
                        <option class="form-control" name="tpusuario" value="Padrao">Padrão</option>
                    </select required> 
                </div>

                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>