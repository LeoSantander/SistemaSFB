<div class="container">
     <div class="starter-template">
             <?php if($Sessao::retornaMensagem()){//Retorna mensagem de erro?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
                    <?php echo $Sessao::retornaMensagem(); ?>
                </div>
            <?php }?>

            <center><h1>Bem vindo(a)</h1>
            <h2>Sistema Sindicato dos Frentistas de Marília</h2></center><br>
            
            <table width='50%' align ='center'>
            <tr>
                <td><strong>Resumo:</strong></td>
            </tr>
            <tr>
                <td align ='center'><h3>0</h3> Associados Ativos</td>
                <!--Informações sobre Usuários | Só vai aparecer se TPUsuário Logado for = Administrador -->
                <?php if ($Sessao::retornaTPUsuario() == 'Administrador'){?>
                    <td align ='center'><h3><?php echo $Sessao::retornaqtdUsuarios()?></h3> Usuarios Cadastrados</td>
                <?php } ?>
            </tr>
            </table>
    </div>
</div>
