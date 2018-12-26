<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\CidadeDAO;
use App\Models\Entidades\Cidade;
use App\Models\DAO\EstadoDAO;

class CidadeController extends Controller
{
    public function index()
    {
        $this->redirect('/cidade/cadastro');
    }

    //Cadastro
    public function cadastro()
    {
        //renderiza a view
        $estadoDAO = new EstadoDAO();
        
        self::setViewParam('listarEstados', $estadoDAO->listarEstados());
        $this->render('/cidade/cadastro');
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaSucesso(); 
    }


    //Salvar no BD
    public function salvar()
    {
        //instancia novo objeto
        $registro = new Cidade();
        $registro->setNome($_POST['nome']);
        $registro->setIdEstado($_POST['estado']);
        $registro->setIdUsuario(Sessao::retornaidUsuario());
        //grava o formulario se acontecer exceções
        Sessao::gravaFormulario($_POST);

       
        //Nova DAO
        $cidadeDAO = new CidadeDAO();
        
        //Verifica se cidade ja esta cadastrada
         if(($cidadeDAO->verificaNome($_POST['nome'])))
        {
            Sessao::gravaMensagem("Nome da Cidade já cadastrada!");
            $this->redirect('/cidade/cadastro');
        }
        
        //salvar no banco
        if($cidadeDAO->salvar($registro))
        {
            Sessao::limpaFormulario();
            Sessao::gravaSucesso("Cidade cadastrada com Sucesso");

            $this->redirect('/cidade/cadastro');
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
}