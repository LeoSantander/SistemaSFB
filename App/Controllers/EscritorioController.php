<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\EscritorioDAO;
use App\Models\DAO\CidadeDAO;
use App\Models\DAO\EstadoDAO;
use App\Models\Entidades\Escritorio;

class ConvenioController extends Controller
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
        $registro = new Escritorio();
        $registro->setNmEscritorio  ($_POST['nome']);
        $registro->setCNPJ          ($_POST['cnpj']);
        $registro->setTelefone      ($_POST['telefone']);
        $registro->setNmRua         ($_POST['rua']);
        $registro->setNmBairro      ($_POST['bairro']);
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
            Sessao::limpaFormulario();
            Sessao::gravaSucesso("Escritório cadastrado com Sucesso!");

            $this->redirect('/escritorio/cadastro');
        }
        else
        {
            Sessao::gravaMensagem("Erro ao gravar!");
        }
    }
}//fim do programa
