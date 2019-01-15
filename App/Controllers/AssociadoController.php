<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\AssociadoDAO;
use App\Models\DAO\LocalTrabalhoDAO;
use App\Models\DAO\CidadeDAO;
use App\Models\DAO\EstadoDAO;
use App\Models\Entidades\Associado;

class AssociadoController extends Controller
{
    public function index()
    {
        $this->redirect('/associado/cadastro');
    }

    public function cadastro()
    {
        if(!(Sessao::retornaUsuario())){
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');
        }

        $cidadeDAO = new CidadeDAO();
        self::setViewParam('listarCidades', $cidadeDAO->listarCidades());

        $estadoDAO = new EstadoDAO();
        self::setViewParam('listarEstados', $estadoDAO->listarEstados());

        $localDAO = new LocalTrabalhoDAO();
        self::setViewParam('listarLocais', $localDAO->listarLocais());

        $this->render('/associado/cadastro');

        Sessao::limpaMensagem();
        Sessao::limpaFormulario();
        Sessao::limpaSucesso();
    }

    public function salvar()
    {
        $registro = new Associado();
        $registro->setNome($_POST['nome']);
        $registro->setRg($_POST['rg']);
        $registro->setCpf($_POST['cpf']);
        $registro->setDataNascimento($_POST['dataNasc']);
        $registro->setDataAssociacao($_POST['dataAssociacao']);
        $registro->setTelefone($_POST['telefone']);
        $registro->setCelular($_POST['celular']);
        $registro->setEmail($_POST['email']);
        $registro->setNomeRua($_POST['rua']);
        $registro->setNomeBairro($_POST['bairro']);
        $registro->setNumeroEndereco($_POST['numero']);
        $registro->setComplemento($_POST['complemento']);
        $registro->setIdCidade($_POST['cidade']);
        $registro->setNumeroRegistro($_POST['registro']);
        $registro->setLocaldeTrabalho($_POST['local']);
        $registro->setCargo($_POST['cargo']);
        $registro->setSituacao($_POST['situacao']);
        $registro->setCep($_POST['cep']);
        $registro->setSalario($_POST['salario']);
        $registro->setIdUsuarioInclusao(Sessao::retornaidUsuario());

        Sessao::gravaFormulario($_POST);

        $associadoDAO = new AssociadoDAO();

        if($associadoDAO->verificaCPF($_POST['cpf']))
        {
            Sessao::gravaMensagem("CPF já cadastrado a um Sócio!");
            $this->redirect('/associado/cadastro');
        }

        if($associadoDAO->salvar($registro))
        {
            Sessao::limpaFormulario();
            Sessao::gravaSucesso("Sócio cadastrado com Sucesso!");

            $this->redirect('/associado/cadastro');
        }
        else
        {
            Sessao::gravaMensagem("Erro ao gravar!");
        }
    }

    public function consultar()
    {
        if(!(Sessao::retornaUsuario())){
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');
        }

        $busca = $_POST['buscar'];
        $associadoDAO = new AssociadoDAO();

        self::setViewParam('listarAssociados', $associadoDAO->listarAssociados($busca));
        $this->render('/associado/consultar');

        Sessao::limpaMensagem();
        Sessao::limpaFormulario();
        Sessao::limpaSucesso();
    }

    public function excluir()
    {

    }
}
