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

    //Função para Cadastro
    public function cadastro()
    {
        if(!(Sessao::retornaUsuario()))
        {
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');
        }

        //renderiza a view Cadastro
        $estadoDAO = new EstadoDAO();

        self::setViewParam('listarEstados', $estadoDAO->listarEstados());
        $this->render('/cidade/cadastro');
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaSucesso();
    }


    //Função para salvar no Banco de Dados
    public function salvar()
    {
        //instancia novo objeto
        $registro = new Cidade();
        $lc = $_POST['id'];
        $registro->setNome($_POST['nome']);
        $registro->setIdEstado($_POST['estado']);
        $registro->setIdUsuario(Sessao::retornaidUsuario());

        //grava o formulario se acontecer exceções
        Sessao::gravaFormulario($_POST);

        //Nova DAO
        $cidadeDAO = new CidadeDAO();

        //Verifica se cidade ja esta cadastrada
         if(($cidadeDAO->verificaNome($_POST['nome'],$_POST['estado'])))
        {
            Sessao::gravaMensagem("Cidade já cadastrada!");
            $this->redirect('/cidade/cadastro');
        }

        //salvar no banco
        if($cidadeDAO->salvar($registro))
        {
            if ($lc == 'LC'){
                Sessao::gravaFormulario($_POST);
                Sessao::gravaSucesso("Cidade cadastrada com Sucesso");

                $this->redirect('/localTrabalho/cadastro');

            } else if($lc == 'AS'){
                Sessao::gravaFormulario($_POST);
                Sessao::gravaSucesso("Cidade cadastrada com Sucesso");

                $this->redirect('/associado/cadastro');
            }else if($lc == 'ES'){
                Sessao::gravaFormulario($_POST);
                Sessao::gravaSucesso("Cidade cadastrada com Sucesso");

                $this->redirect('/escritorio/cadastro');
            }else{
                Sessao::limpaFormulario();
                Sessao::gravaSucesso("Cidade cadastrada com Sucesso");

                $this->redirect('/cidade/cadastro');
            }
        }
        else
        {
            Sessao::gravaMensagem("Erro ao gravar");
        }
    }

    public function consultar()
    {
        if(!(Sessao::retornaUsuario()))
        {
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');
        }

        //instanciando nova DAO
        $cidadeDAO = new CidadeDAO();

        self::setViewParam('listarCidades', $cidadeDAO->listarCidades());
        $this->render('/cidade/consultar');

        Sessao::limpaFormulario();
        Sessao::limpaSucesso();
        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $cidade = new Cidade();
        $cidade->setIdCidade($_POST['id']);

        $cidadeDAO = new CidadeDAO();

        if($cidadeDAO->verificaLocaldeTrabalho($cidade->getIdCidade()) and $cidadeDAO->verificaAssociado($cidade->getIdCidade())){
            Sessao::gravaMensagem("Não é possível excluir. Cidade tem relação com algum Local de Trabalho e Associados!");
            $this->redirect('/cidade/consultar');
        }else if($cidadeDAO->verificaLocaldeTrabalho($cidade->getIdCidade())){
            Sessao::gravaMensagem("Não é possível excluir. Cidade tem relação com algum Local de Trabalho!");
            $this->redirect('/cidade/consultar');
        }else if($cidadeDAO->verificaAssociado($cidade->getIdCidade())){
            Sessao::gravaMensagem("Não é possível excluir. Cidade tem relação com algum Associado!");
            $this->redirect('/cidade/consultar');
        }

        if(!$cidadeDAO->excluir($cidade))
        {
            Sessao::gravaMensagem("Cidade inválida");
            $this->redirect('/cidade/consultar');
        }

        Sessao::gravaSucesso("Cidade excluída com sucesso!");
        $this->redirect('/cidade/consultar');
    }

    public function alterar($params)
    {
        if(!(Sessao::retornaUsuario()))
        {
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');
        }

        $estadoDAO = new EstadoDAO();
        self::setViewParam('listarEstados', $estadoDAO->listarEstados());

        $idCidade = $params[0];
        $cidadeDAO = new CidadeDAO();
        $cidade = $cidadeDAO->pegarcidade($idCidade);

        if(!$cidade){
            Sessao::gravaMensagem("Cidade Inválida");
            $this->redirect('/cidade/alterar');
        }
        self::setViewParam('cidade',$cidade);
        $this->render('/cidade/alterar');
        Sessao::limpaMensagem();
    }

    public function atualizar()
    {
        $id = $_POST['idCidade'];
        $estado = $_POST['estado'];
        $cidade = $_POST['nome'];

        $registro = new Cidade();
        $registro->setNome($_POST['nome']);
        $registro->setIdUsuario(Sessao::retornaidUsuario());
        $registro->setIdEstado($_POST['estado']);
        $registro->setIdCidade($id);

        Sessao::gravaFormulario($_POST);

        $cidadeDAO = new CidadeDAO();

        //Verifica Alteração
        if($cidadeDAO->verificaAlteracao($_POST['nome'], $_POST['estado'], $id))
        {
            Sessao::gravaMensagem("Cidade já cadastrada!");
            $this->redirect('/cidade/alterar/'.$id);
        }

        $cidadeDAO->atualizar($registro);

        Sessao::limpaFormulario();
        Sessao::gravaSucesso("Cidade alterada com Sucesso!");
        $this->redirect('/cidade/consultar');
    }
}
