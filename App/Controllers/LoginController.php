<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\UsuarioDAO;

class LoginController extends Controller
{
    
    public function index()
    {
        $this->renderLogin('login/index');
        Sessao::limpaMensagem();
    }

}