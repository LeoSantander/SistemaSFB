<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Usuario;

class HomeController extends Controller
{
    public function index()
    {
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