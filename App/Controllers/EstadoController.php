<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\EstadoDAO;
use App\Models\Entidades\Estado;

class EstadoController extends Controller
{
    public function cadastro()
    {
        $this->render('/estado/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaSucesso();
    }

    public function salvar()
    {
        $registro = new Estado();
        $registro->setNome($_POST['nome']);
        $registro->setSigla($_POST['sigla']);

        $estadoDAO = new EstadoDAO();

        if($estadoDAO->salvar($registro))
        {
            Sessao::limpaFormulario();
            Sessao::gravaSucesso("Estado Cadastrado com Sucesso!");

            $this->redirect('/estado/cadastro');
        }
        else
        {
            Sessao::gravaMensagem("Erro ao gravar");
        }
    }

    public function alterar()
    {

    }

    public function excluir()
    {

    }

    public function consultar()
    {

    }

    public function sucesso()
    {

    }

    public function index()
    {
        $this->redirect('/estado/cadastro');
    }
}
