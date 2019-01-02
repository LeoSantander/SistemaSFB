<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\DependenteDAO;
use App\Models\Entidades\Dependente;

class DependenteController extends Controller
{
    public function index()
    {
        $this->redirect('/dependente/cadastro');
    }

    public function cadastro()
    {
        $this->render('/dependente/cadastro');

        Sessao::limpaMensagem();
        Sessao::limpaFormulario();
        Sessao::limpaSucesso();
    }

    public function salvar()
    {
        $registro = new Dependente();
        $registro->setNome($_POST['nome']);
        $registro->setRg($_POST['rg']);
        $registro->setCpf($_POST['cpf']);
        $registro->setDataNascimento($_POST['dataNasc']);
        //$registro->setIdAssociado($_POST['idAssociado']);
        $registro->setGrauDependencia($_POST['grau']);
        $registro->setIdUsuarioInclusao(Sessao::retornaidUsuario());

        Sessao::gravaFormulario($_POST);

        $dependenteDAO = new DependenteDAO();

        if($dependenteDAO->salvar($registro))
        {
            Sessao::limpaFormulario();
            Sessao::gravaSucesso("Dependente Cadastrado com Sucesso!");

            $this->redirect('/dependente/cadastro');
        }
        else
        {
            Sessao::gravaMensagem("Erro ao gravar");
        }
    }

    public function consultar()
    {
        $dependenteDAO = new DependenteDAO();

        self::setViewParam('listarDependentes',$dependenteDAO->listarDependentes());
        $this->render('/dependente/consultar');

        Sessao::limpaMensagem();
        Sessao::limpaFormulario();
        Sessao::limpaSucesso();
    }

    public function excluir()
    {
        $dependente = new Dependente();
        $dependente->setIdDependente($_POST['id']);

        $dependenteDAO = new DependenteDAO();

        if(!$dependenteDAO->excluir($dependente))
        {
            Sessao::gravaMensagem("Dependente não encontrado!");
            $this->redirect('/dependente/consultar');
        }

        Sessao::gravaSucesso("Dependente Excluído com sucesso!");
        $this->redirect('/dependente/consultar');
    }
}