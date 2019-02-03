<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\EscritorioDAO;
use App\Models\DAO\CidadeDAO;
use App\Models\DAO\EstadoDAO;
use App\Models\Entidades\Escritorio;

class EscritorioController extends Controller
{
    public function index()
    {
        $this->render('/escritorio/cadastro');
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

        $this->render('/escritorio/cadastro');
        Sessao::limpaMensagem();
        Sessao::limpaFormulario();
        Sessao::limpaSucesso();
    }

    public function salvar()
    {
        $lc = $_POST['id'];
        $registro = new Escritorio();
        $registro->setNmEscritorio  (ucwords($_POST['escritorio']));
        $registro->setCNPJ          ($_POST['cnpj']);
        $registro->setTelefone      ($_POST['telefone']);
        $registro->setNmRua         (ucwords($_POST['rua']));
        $registro->setNmBairro      (ucwords($_POST['bairro']));
        $registro->setNumEndereco   ($_POST['endereco']);
        $registro->setIdCidade      ($_POST['cidade']);
        $registro->setEmail         ($_POST['email']);
        $registro->setCep           ($_POST['cep']);
        $registro->setIdUsuarioInclusao(Sessao::retornaidUsuario());

        Sessao::gravaFormulario($_POST);

        $escritorioDAO = new EscritorioDAO();

        if(($escritorioDAO->verificaCNPJ($_POST['cnpj']))){
            Sessao::gravaMensagem("Escritório ja Registrado!");
            $this->redirect('/escritorio/cadastro');
        }

        if($escritorioDAO->salvar($registro))
        {
            if ($lc == 'LC'){
                Sessao::gravaFormulario($_POST);
                Sessao::gravaSucesso("Posto cadastrado com Sucesso");

                $this->redirect('/localTrabalho/cadastro');

            }
            else{
              Sessao::limpaFormulario();
              Sessao::gravaSucesso("Escritório cadastrado com Sucesso!");

              $this->redirect('/escritorio/cadastro');
            }

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
        $escritorioDAO = new EscritorioDAO();

        self::setViewParam('listarEscritorios', $escritorioDAO->listarEscritorios($busca));
        $this->render('/escritorio/consultar');

        Sessao::limpaMensagem();
        Sessao::limpaFormulario();
        Sessao::limpaSucesso();
    }
    public function excluir()
    {
        $escritorio = new Escritorio();
        $escritorio->setIdEscritorio($_POST['id']);

        $escritorioDAO = new EscritorioDAO();

        if($escritorioDAO->verificaEscritorio($escritorio->getIdEscritorio()))
        {
            Sessao::gravaMensagem('Não é possível excluir. Escritório está relacionado com algum Posto!');
            $this->redirect('/escritorio/consultar');
        }

        if(!$escritorioDAO->excluir($escritorio))
        {
            Sessao::gravaMensagem("Escritório não encontrado!");
            $this->redirect('/escritorio/consultar');
        }

        Sessao::gravaSucesso("Escritório Excluído com sucesso!");
        $this->redirect('/escritorio/consultar');
    }

    public function alterar($params)
    {
        if(!(Sessao::retornaUsuario())){
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');
        }

        $escritorioDAO = new EscritorioDAO();

        $cidadeDAO = new CidadeDAO();
        self::setViewParam('listarCidades', $cidadeDAO->listarCidades());

        $id = $_POST['id'];
        if ($id == null){
            $id = $params[0];
        }

        $escritorio = $escritorioDAO->pegarEscritorio($id);

        if(!$escritorio)
        {
            Sessao::gravaMensagem("Escritório Inválido");
            $this->redirect('/escritorio/alterar/');
        }

        self::setViewParam('escritorio',$escritorio);
        $this->render('/escritorio/alterar');
        Sessao::limpaMensagem();
    }

    public function atualizar()
    {
        $id = $_POST['id'];

        $registro = new Escritorio();
        $registro->setIdEscritorio  ($id);
        $registro->setNmEscritorio  (ucwords($_POST['escritorio']));
        $registro->setCNPJ          ($_POST['cnpj']);
        $registro->setTelefone      ($_POST['telefone']);
        $registro->setNmRua         (ucwords($_POST['rua']));
        $registro->setNmBairro      (ucwords($_POST['bairro']));
        $registro->setNumEndereco   ($_POST['endereco']);
        $registro->setIdCidade      ($_POST['cidade']);
        $registro->setEmail         ($_POST['email']);
        $registro->setCep           ($_POST['cep']);
        $registro->setIdUsuarioInclusao(Sessao::retornaidUsuario());

        $escritorioDAO = new EscritorioDAO();

        if($escritorioDAO->verificaAlteracao($_POST['cnpj'], $id))
        {
            Sessao::gravaMensagem("Escritório já cadastrado!");
            $this->redirect('/escritorio/consultar/'.$id);
        }else{
            $escritorioDAO->atualizar($registro);

            Sessao::limpaFormulario();
            Sessao::gravaSucesso("Escritório Alterado com Sucesso!");
            $this->redirect('/escritorio/consultar');
        }
    }
}//fim do programa
