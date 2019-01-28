<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\DependenteDAO;
use App\Models\DAO\AssociadoDAO;//alterar para AssociadoDAO
use App\Models\Entidades\Dependente;

class DependenteController extends Controller
{
    public function index()
    {
        $this->redirect('/dependente/cadastro');
    }

    public function cadastro()
    {
        if(!(Sessao::retornaUsuario())){
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');
        }

        $associadoDAO = new AssociadoDAO();
        self::setViewParam('listarAssociados',$associadoDAO->listAssoc());

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
        $registro->setIdAssociado($_POST['idAssociado']);
        $registro->setGrauDependencia($_POST['grau']);
        $registro->setIdUsuarioInclusao(Sessao::retornaidUsuario());

        Sessao::gravaFormulario($_POST);

        $dependenteDAO = new DependenteDAO();

        if($_POST['idAssociado'] == "undefined")
        {
            Sessao::gravaMensagem("Associado não Encontrado!");
            $this->redirect('/dependente/cadastro');
        }

        if($dependenteDAO->verificaCPF($_POST['cpf']))
        {
            Sessao::gravaMensagem("CPF já associado a um dependente!");
            $this->redirect('/dependente/cadastro');
        }

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
        if(!(Sessao::retornaUsuario())){
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');
        }

        $busca = $_POST['buscar'];
        $dependenteDAO = new DependenteDAO();

        self::setViewParam('listarDependentes',$dependenteDAO->listarDependentes($busca));
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

    public function alterar($params)
    {
        if(!(Sessao::retornaUsuario())){
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');
        }

        $associadoDAO = new AssociadoDAO();
        self::setViewParam('listarAssociados',$associadoDAO->listAssoc());

        $id = $_POST['id'];
        if ($id == null){
            $id = $params[0];
        }
        $dependenteDAO = new DependenteDAO();
        $dependente = $dependenteDAO->pegarDependente($id);

        if(!$dependente)
        {
            Sessao::gravaMensagem("Dependente Inválido");
            $this->redirect('/dependente/consultar');
        }

        self::setViewParam('dependente',$dependente);
        $this->render('/dependente/alterar');
        Sessao::limpaMensagem();
    }

    public function atualizar()
    {
        $id = $_POST['id'];
        $cpf = $_POST['cpf'];

        $registro = new Dependente();
        $registro->setCpf($cpf);
        $registro->setDataNascimento($_POST['dataNasc']);
        $registro->setGrauDependencia($_POST['grau']);
        $registro->setIdAssociado($_POST['idAssociado']);
        $registro->setIdDependente($id);
        $registro->setIdUsuarioInclusao(Sessao::retornaidUsuario());
        $registro->setNome($_POST['nome']);
        $registro->setRg($_POST['rg']);

        $dependenteDAO = new DependenteDAO();



        if($_POST['idAssociado'] == "undefined")
        {
            Sessao::gravaMensagem("Associado não Encontrado!");
            $this->redirect('/dependente/alterar/'.$id);
        }

        if($dependenteDAO->verificaAlteracao($cpf,$id))
        {
            Sessao::gravaMensagem("CPF já associado a um dependente!");
            $this->redirect('/dependente/alterar/'.$id);
        }

        $dependenteDAO->atualizar($registro);
        Sessao::limpaFormulario();
        Sessao::gravaSucesso("Dependente Alterado com Sucesso!");
        $this->redirect('/dependente/consultar');

    }
}
