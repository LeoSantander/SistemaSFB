<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\LocalTrabalhoDAO;
use App\Models\DAO\EstadoDAO;
use App\Models\Entidades\LocalTrabalho;

class LocalTrabalhoController extends Controller
{
    public function cadastro()
    {
        $estadoDAO = new EstadoDAO();

        self::setViewParam('listarEstados', $estadoDAO->listarEstados());

        $this->render('/localTrabalho/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaSucesso();
    }
    public function index()
    {
        $this->redirect('/localTrabalho/cadastro');
    }

    public function consultar()
    {
        $nm = $_POST['buscar'];

        $this->render('/localTrabalho/consultar');
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaSucesso();
    }
}