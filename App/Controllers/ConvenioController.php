<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\ConvenioDAO;
use App\Models\Entidades\Convenio;

class ConvenioController extends Controller
{
    public function index()
    {
        $this->render('/convenio/cadastro');
    }

    public function cadastro()
    {
        if(!(Sessao::retornaUsuario())){
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');
        }

        $this->render('/convenio/cadastro');
        Sessao::limpaMensagem();
        Sessao::limpaFormulario();
        Sessao::limpaSucesso();
    }

    public function salvar()
    {
        $convenio = $_POST['convenio'];
        $empresa = $_POST['empresa'];

        $registro = new Convenio();
        $registro->setNmConvenio    (ucwords($_POST['convenio']));
        $registro->setNmEmpresa     (ucwords($_POST['empresa']));
        $registro->setVlConvenio    ($_POST['valor']);
        $registro->setVlConvenioDep ($_POST['valorDep']);
        $registro->setDtVencimento  ($_POST['dataVenc']);
        $registro->setSituacao      ($_POST['situacao']);
        $registro->setIdUsuarioInclusao(Sessao::retornaidUsuario());

        Sessao::gravaFormulario($_POST);

        $convenioDAO = new ConvenioDAO();

        if($convenioDAO->verificaConvenio($convenio , $empresa))
        {
            Sessao::gravaMensagem("Convênio já cadastrado!");

            $this->redirect('/convenio/cadastro');
        }
        if($convenioDAO->salvar($registro))
        {
            Sessao::limpaFormulario();
            Sessao::gravaSucesso("Convênio cadastrado com Sucesso!");

            $this->redirect('/convenio/cadastro');
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
        $convenioDAO = new ConvenioDAO();

        self::setViewParam('listarConvenios', $convenioDAO->listarConvenios($busca));
        $this->render('/convenio/consultar');

        Sessao::limpaMensagem();
        Sessao::limpaFormulario();
        Sessao::limpaSucesso();
    }

    public function excluir()
    {
        $idConvenio = $_POST['id'];

        $convenio = new Convenio();
        $convenio->setIdConvenio($idConvenio);

        $convenioDAO = new ConvenioDAO();

        if($convenioDAO->verificaRelacao($idConvenio)){
          Sessao::gravaMensagem("Não foi possível excluir: Convênio vinculado a algum associado e/ou dependente!");
          $this->redirect('/convenio/consultar');
        }
        else {
          $convenioDAO->excluir($convenio);
          Sessao::gravaSucesso("Convênio Excluído com sucesso!");
          $this->redirect('/convenio/consultar');
        }
    }

    public function alterar($params)
    {
        if(!(Sessao::retornaUsuario())){
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');
        }

        $convenioDAO = new ConvenioDAO();

        $id = $_POST['id'];
        if ($id == null){
            $id = $params[0];
        }

        $convenio = $convenioDAO->pegarConvenio($id);

        if(!$convenio)
        {
            Sessao::gravaMensagem("Convênio Inválido");
            $this->redirect('/convenio/alterar/');
        }

        self::setViewParam('convenio',$convenio);
        $this->render('/convenio/alterar');
        Sessao::limpaMensagem();
    }

    public function atualizar()
    {
        $id = $_POST['id'];

        $registro = new Convenio();
        $registro->setNmConvenio    (ucwords($_POST['convenio']));
        $registro->setNmEmpresa     (ucwords($_POST['empresa']));
        $registro->setVlConvenio    ($_POST['valor']);
        $registro->setVlConvenioDep ($_POST['valorDep']);
        $registro->setDtVencimento  ($_POST['dataVenc']);
        $registro->setSituacao      ($_POST['situacao']);
        $registro->setIdConvenio    ($id);
        $registro->setIdUsuarioInclusao(Sessao::retornaidUsuario());

        $convenioDAO = new ConvenioDAO();

        if($convenioDAO->verificaAlteracao($_POST['convenio'], $_POST['empresa'], $id))
        {
            Sessao::gravaMensagem("Convênio já cadastrado!");
            $this->redirect('/convenio/consultar/'.$id);
        }else{
            $convenioDAO->atualizar($registro);

            Sessao::limpaFormulario();
            Sessao::gravaSucesso("Convênio Alterado com Sucesso!");
            $this->redirect('/convenio/consultar');
        }
    }
}
