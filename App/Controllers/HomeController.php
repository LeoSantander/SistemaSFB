<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Usuario;

class HomeController extends Controller
{
    public function index()
    {
        if(!(Sessao::retornaUsuario())){
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');

            //Senão se Usuário da Sessão não é Administrador, Retorna para Home!
        } else if (!(Sessao::retornaTPUsuario() == 'Administrador')){
            $this->redirect('home/');
        }
        
        $usuarioDAO = new UsuarioDAO();
        $qtdUsuarios= $usuarioDAO->ContaUsuarios();
        Sessao::gravaQtdUsuarios($qtdUsuarios); 
        
        $user= Sessao::retornaUsuario();
        $pwd = Sessao::retornaSenha();
        
        $teste = $usuarioDAO->pegarTPUsuario($user,$pwd);
        foreach ($teste as $usr){
            Sessao::gravaTPUsuario($usr->TP_Usuario);
            Sessao::gravaidUsuario($usr->ID_Usuario);
        }
        

        //self::setViewParam('teste', $teste);       
        $this->render('home/index');
    }
}