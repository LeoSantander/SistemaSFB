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

    public function consultar($params)
    {
        $nm = $params;

        $usuarioDAO = new UsuarioDAO();      
       
        self::setViewParam('listarUsuarios', $usuarioDAO->listarUsuarios($nm));

        $this->render('/usuario/consultar');
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaSucesso();
    }

    public function alterar($params)
    {
        $id = $params[0];
        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->pegarUsuario($id);
        if(!$usuario){
            Sessao::gravaMensagem("Usuário Inválido");
            $this->redirect('/usuario/consultar');
        }
        self::setViewParam('usuario', $usuario);
        $this->render('/usuario/alterar');
        Sessao::limpaMensagem();
    }

    public function exclusao($params)
    {
        $id = $params[0];
        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->pegarUsuario($id);

        self::setViewParam('usuario', $usuario);
        $this->render('/usuario/excluir');
        Sessao::limpaMensagem();
    }

    public function excluir()
    {
        $usuario = new Usuario();
        $usuario->setId($_POST['id']);
 
        $usuarioDAO = new UsuarioDAO();
 
        if(!$usuarioDAO->excluir($usuario)){
            Sessao::gravaMensagem("Usuario Inválido");
            $this->redirect('/usuario/consultar');
        }
 
        Sessao::gravaSucesso("Usuario excluido com sucesso!");
 
        $this->redirect('/usuario/consultar');
 
    }

    public function atualizar()
    {
        $registro = new Usuario();
        $registro->setId($_POST['id']);
        $registro->setNome($_POST['nome']);
        $registro->setUsuario($_POST['usuario']);
        $registro->setSenha($_POST['senha']);
        $registro->setTpUsuario($_POST['tpusuario']); 

        Sessao::gravaFormulario($_POST);
        
        $usuarioDAO = new UsuarioDAO();
        var_dump($registro);
        $usuarioDAO->atualizar($registro);
        
        Sessao::limpaFormulario();
        Sessao::gravaSucesso("Usuário alterado com Sucesso");
        $this->redirect('/usuario/consultar');

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
    
    public function index()
    {
        $this->redirect('/usuario/cadastro');
    }

}