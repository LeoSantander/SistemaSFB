<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\CidadeDAO;
use App\Models\Entidades\Cidade;

class CidadeController extends Controller
{
    //Cadastro
    public function cadastro()
    {
        //renderiza a view
        $this->render('/cidade/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaSucesso();
        Sessao::limpaErro();
    }

    //Salvar no BD
    public function salvar()
    {
        //instancia novo objeto
        $registro = new Cidade();
        $registro->setNome($_POST['nome']);

        //grava o formulario se acontecer exceções
        Sessao::gravaformulario($_POST);

        //validando
        $cidadeValidando = new CidadeValidando();
        $resultadoValidacao = $cidadeValidando->validar($registro);

        //verificar erros
        if($resultadoValidacao->getErros()){
            Sessao::gravaErro($resultadoValidacao->getErros());
            $this->redirect('/cidade/cadastro');
        }


        //Nova DAO
        $cidadeDAO = new CidadeDAO();

    }



}