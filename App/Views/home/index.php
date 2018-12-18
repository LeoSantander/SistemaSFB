<?php
    if(!($Sessao::retornaUsuario())){
        $Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
        $this->redirect('login/');
    }

    
?>

<div class="container">
     <div class="starter-template">
            <center><h1>Bem vindo(a)</h1>
            <h2>Sistema Sindicato dos Frentistas de Marília</h2></center><br>
            
            <table width='50%' align ='center'>
            <tr>
                <td><strong>Resumo:</strong></td>
            </tr>
            <tr>
                <td align ='center'><h3>0</h3> Associados Ativos</td>
                <td align ='center'><h3><?php echo $Sessao::retornaqtdUsuarios()?></h3> Usuarios Cadastrados</td>
            </tr>
            </table>
    </div>
</div>
