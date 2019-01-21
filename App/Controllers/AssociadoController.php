<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\AssociadoDAO;
use App\Models\DAO\LocalTrabalhoDAO;
use App\Models\DAO\CidadeDAO;
use App\Models\DAO\DependenteDAO;
use App\Models\DAO\EstadoDAO;
use App\Models\Entidades\Associado;

class AssociadoController extends Controller
{
    public function index()
    {
        $this->redirect('/associado/cadastro');
    }

    public function detalhes($params)
    {

      $id = $_POST['id'];
      if ($id == null){
          $id = $params[0];
      }

      $associadoDAO = new AssociadoDAO();
      $dependenteDAO = new DependenteDAO();

      self::setViewParam('associado', $associadoDAO->pegarAssociado($id));
      self::setViewParam('listarDependentes', $dependenteDAO->pegarDependenteAssociado($id));

      $this->renderDetalhes('/associado/detalhes');
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
        $dependenteDAO = new DependenteDAO();

        self::setViewParam('listarAssociados', $associadoDAO->listarAssociados($busca));

        self::setViewParam('listarDependentes', $dependenteDAO->listarDependentes());
        $this->render('/associado/consultar');

        Sessao::limpaMensagem();
        Sessao::limpaFormulario();
        Sessao::limpaSucesso();
    }

    public function excluir()
    {
        $associado = new Associado();
        $associado->setIdAssociado($_POST['id']);

        $associadoDAO = new AssociadoDAO();

        if(!$associadoDAO->excluir($associado))
        {
            Sessao::gravaMensagem("Associado não encontrado!");
            $this->redirect('/associado/consultar');
        }

        Sessao::gravaSucesso("Associado Excluido com Sucesso!");
        $this->redirect('/associado/consultar');
    }

    public function alterar($params)
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


        $id = $_POST['id'];
        if ($id == null){
            $id = $params[0];
        }
        $associadoDAO = new AssociadoDAO();
        $associado = $associadoDAO->pegarAssociado($id);

        if(!$associado)
        {
            Sessao::gravaMensagem("Associado Inválido");
            $this->redirect('/associado/consultar');
        }

        self::setViewParam('associado',$associado);
        $this->render('/associado/alterar');
        Sessao::limpaMensagem();
    }

    public function atualizar()
    {
        $id = $_POST['id'];

        $registro = new Associado();
        $registro->setNome($_POST['nome']);
        $registro->setTelefone($_POST['telefone']);
        $registro->setCelular($_POST['celular']);
        $registro->setEmail($_POST['email']);
        $registro->setNomeRua($_POST['rua']);
        $registro->setNomeBairro($_POST['bairro']);
        $registro->setNumeroEndereco($_POST['numero']);
        $registro->setLocaldeTrabalho($_POST['local']);
        $registro->setIdCidade($_POST['cidade']);
        $registro->setCep($_POST['cep']);
        $registro->setCargo($_POST['cargo']);
        $registro->setSalario($_POST['salario']);
        $registro->setComplemento($_POST['complemento']);
        $registro->setSituacao($_POST['situacao']);
        $registro->setIdAssociado($id);
        $registro->setIdUsuarioInclusao(Sessao::retornaidUsuario());

        $associadoDAO = new AssociadoDAO();

        $associadoDAO->atualizar($registro);
        Sessao::limpaFormulario();
        Sessao::gravaSucesso("Associado Alterado com Sucesso!");
        $this->redirect('/associado/consultar');
    }
}
