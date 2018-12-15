<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Usuario;

class UsuarioController extends Controller
{
    public function cadastro()
    {
        $this->render('/usuario/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaSucesso();
    }

    public function salvar()
    {
        $registro = new Usuario();
        $registro->setNome($_POST['nome']);
        $registro->setCpf($_POST['cpf']);
        $registro->setUsuario($_POST['usuario']);
        $registro->setSenha($_POST['senha']);
        $registro->setTpUsuario($_POST['tpusuario']);


        Sessao::gravaFormulario($_POST);

        $usuarioDAO = new UsuarioDAO();

        if($usuarioDAO->verificaCPF($_POST['cpf'])){
            Sessao::gravaMensagem("CPF ja foi Cadastrado");
            $this->redirect('/usuario/cadastro');
        }

        if($usuarioDAO->salvar($registro)){
            Sessao::limpaFormulario();
            Sessao::gravaSucesso("Usuário Cadastrado com Sucesso");
            $this->redirect('/usuario/cadastro');            
            //$this->redirect('/usuario/sucesso');
        }else{
            Sessao::gravaMensagem("Erro ao gravar");
        }
    }
    
    public function sucesso()
    {
        if(Sessao::retornaValorFormulario('nome')) {
            $this->render('/usuario/sucesso');

            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
        }else{
            $this->redirect('/');
        }
    }

    public function index()
    {
        $this->redirect('/usuario/cadastro');
    }

}