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
        $registro->setNmConvenio    ($_POST['convenio']);
        $registro->setNmEmpresa     ($_POST['empresa']);
        $registro->setVlConvenio    ($_POST['valor']);
        $registro->setVlConvenioDep ($_POST['valorDep']);
        $registro->setDtVencimento  ($_POST['dataVenc']);
        $registro->setSituacao      ($_POST['situacao']);
        $registro->setIdUsuarioInclusao(Sessao::retornaidUsuario());

        Sessao::gravaFormulario($_POST);

        $convenioDAO = new ConvenioDAO();

        if($convenioDAO->verificaConvenio($convenio , $empresa))
        {
            Sessao::gravaMensagem("Convenio já cadastrado!");

            $this->redirect('/convenio/cadastro');
        }
        if($convenioDAO->salvar($registro))
        {
            Sessao::limpaFormulario();
            Sessao::gravaSucesso("Convenio cadastrado com Sucesso!");

            $this->redirect('/convenio/cadastro');
        }
        else
        {
            Sessao::gravaMensagem("Erro ao gravar!");
        }
    }
}
