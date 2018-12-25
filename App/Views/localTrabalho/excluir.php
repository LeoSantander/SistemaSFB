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
