<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\UsuarioDAO;
use App\Models\DAO\AssociadoDAO;
use App\Models\Entidades\Usuario;

class HomeController extends Controller
{
    public function index()
    {
        if (!(Sessao::retornaUsuario())) {
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');
        }

        $usuarioDAO = new UsuarioDAO();
        $qtdUsuarios = $usuarioDAO->ContaUsuarios();
        Sessao::gravaQtdUsuarios($qtdUsuarios);

        $associadoDAO = new AssociadoDAO();
        $qtdAssociados = $associadoDAO->ContaAssociados();
        Sessao::gravaQtdAssociados($qtdAssociados);

        $user = Sessao::retornaUsuario();
        $pwd = Sessao::retornaSenha();

        $teste = $usuarioDAO->pegarTPUsuario($user, $pwd);
        foreach ($teste as $usr) {
            Sessao::gravaTPUsuario($usr->TP_Usuario);
            Sessao::gravaidUsuario($usr->ID_Usuario);
        }


        //self::setViewParam('teste', $teste);       
        $this->render('home/index');
        Sessao::limpaMensagem();
        Sessao::limpaLastID();
        Sessao::limpaLastCPF();
    }
}
