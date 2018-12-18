<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\UsuarioDAO;

class HomeController extends Controller
{
    public function index()
    {
        $usuarioDAO = new UsuarioDAO();
        $qtdUsuarios= $usuarioDAO->ContaUsuarios();
        Sessao::gravaQtdUsuarios($qtdUsuarios); 
    
        $this->render('home/index');
    }
}