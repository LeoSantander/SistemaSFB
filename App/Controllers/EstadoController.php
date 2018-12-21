<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\EstadoDAO;
use App\Models\Entidades\Estado;

class EstadoController extends Controller
{
    public function index()
    {
        $this->redirect('/estado/cadastro');//redireciona ao controller estado, action cadastro
    }

    //action cadastro
    public function cadastro()
    {
        //renderiza a view cadastro
        $this->render('/estado/cadastro');

        //ao abrir a view, limpa dados de formulario, mensagem, mensagem de sucesso e erros.
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaSucesso();
    }

    //action salvar(incluir no bd)
    public function salvar()
    {
        //instanciando novo objeto e setando valores informados pelo usuario na view
        $registro = new Estado();
        $registro->setNome($_POST['nome']);
        $registro->setSigla($_POST['sigla']);
        $registro->setidUsuarioInclusao(Sessao::retornaidUsuario());
        
        //grava formulário, caso ocorra alguma exceção
        Sessao::gravaFormulario($_POST);

        //instanciando nova DAO
        $estadoDAO = new EstadoDAO();
        
        //validação de cadastro, não permite o cadastro de estados e siglas já cadastrados
        if(($estadoDAO->verificaNome($_POST['nome'])) and ($estadoDAO->verificaSigla($_POST['sigla'])))
        {
            Sessao::gravaMensagem("Estado já Cadastrado!");//mensagem a ser exibida para informar ao usuário
            $this->redirect('/estado/cadastro');//recarrega a página cadastro de estados, já renderizada
        }
        //não permite a inserção de estados já cadastrados
        else if($estadoDAO->verificaNome($_POST['nome']))
        {
            Sessao::gravaMensagem("Nome de estado já cadastrado!");
            $this->redirect('/estado/cadastro');
        }
        //não permite a inserção de siglas já cadastradas
        else if($estadoDAO->verificaSigla($_POST['sigla']))
        {
            Sessao::gravaMensagem("Sigla já cadastrada!");
            $this->redirect('/estado/cadastro');
        }

        //salvar no banco, se retornar true, salva. (salvar - método da classe EstadoController, recebe como parametro o registro de um novo estado)
        if($estadoDAO->salvar($registro))//o retorno de salvar será true ou false
        {
            Sessao::limpaFormulario();//limpa os dados do form
            Sessao::gravaSucesso("Estado Cadastrado com Sucesso!");//grava mensagem de sucesso a ser exibida ao usuário na view

            $this->redirect('/estado/cadastro');
        }
        //caso retorne false
        else
        {
            Sessao::gravaMensagem("Erro ao gravar");//grava mensagem de erro
        }
    }

    //action consultar
    public function consultar()
    {
        //instanciando nova DAO
        $estadoDAO = new EstadoDAO();

        self::setViewParam('listarEstados', $estadoDAO->listarEstados());
        $this->render('/estado/consultar');

        Sessao::limpaFormulario();
        Sessao::limpaSucesso();
        Sessao::limpaMensagem();
    }

    public function alterar()
    {

    }

    public function excluir()
    {

    }
}
