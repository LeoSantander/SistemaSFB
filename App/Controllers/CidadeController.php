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

    public function consultar()
    {
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
        $cidade->setIdCidade($_POST['idCidade']);

        $cidadeDAO = new CidadeDAO();
        
        if(!$cidadeDAO->excluir($cidade)){
            Sessao::gravaMensagem("Cidade inválida");
            $this->redirect('/cidade/consultar');
        }

        Sessao::gravaMensagem("Cidade excluída com sucesso!");
        $this->redirect('/cidade/consultar');
    }

    public function exclusao($params)
    {
        $idCidade = $params[0];
        $cidadeDAO = new CidadeDAO();
        $cidade = $cidadeDAO->pegarcidade($idCidade);

        self::setViewParam('cidade', $cidade);
        $this->render('/cidade/excluir');
        Sessao::limpaMensagem();
    }

    public function alterar()
    {
 
    }
}