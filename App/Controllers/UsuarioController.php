<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\UsuarioDAO;
use App\Models\Entidades\Usuario;

class UsuarioController extends Controller
{
    public function cadastro()
    {
        if(!(Sessao::retornaUsuario())){
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');

        //Senão se Usuário da Sessão não é Administrador, Retorna para Home!
        } else if (!(Sessao::retornaTPUsuario() == 'Administrador')){
            Sessao::gravaMensagem("Parece que você não tem permissão para acessar este módulo :( ");
            $this->redirect('home/');
        }

        $this->render('/usuario/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaSucesso();
    }

    public function consultar()
    {
        if(!(Sessao::retornaUsuario())){
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');

            //Senão se Usuário da Sessão não é Administrador, Retorna para Home!
        } else if (!(Sessao::retornaTPUsuario() == 'Administrador')){
            Sessao::gravaMensagem("Parece que você não tem permissão para acessar este módulo :( ");
            $this->redirect('home/');
        }

        $nm = $_POST['buscar'];

        $usuarioDAO = new UsuarioDAO();      
       
        self::setViewParam('listarUsuarios', $usuarioDAO->listarUsuarios($nm));

        $this->render('/usuario/consultar');
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaSucesso();
    }

    public function alterar($params)
    {
        if(!(Sessao::retornaUsuario())){
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');

            //Senão se Usuário da Sessão não é Administrador, Retorna para Home!
        } else if (!(Sessao::retornaTPUsuario() == 'Administrador')){
            Sessao::gravaMensagem("Parece que você não tem permissão para acessar este módulo :( ");
            $this->redirect('home/');
            
        }

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

    public function excluir()
    {
        if(!(Sessao::retornaUsuario())){
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');
        }else if (!(Sessao::retornaTPUsuario() == 'Administrador')){
            Sessao::gravaMensagem("Parece que você não tem permissão para acessar este módulo :( ");
            $this->redirect('home/');
            
        }

        $id = $_POST['id'];

        if($id == Sessao::retornaidUsuario()){
            Sessao::gravaMensagem("Não é possível desativar o usuário logado!");
            $this->redirect('/usuario/consultar');
            
            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
            Sessao::limpaSucesso();
        } else{

            $usuario = new Usuario();
            $usuario->setId($id);
            $usuarioDAO = new UsuarioDAO();
        
            if(!$usuarioDAO->desativar($usuario)){
                Sessao::gravaMensagem("Usuário Inválido");
                $this->redirect('/usuario/consultar');
            }

            Sessao::gravaSucesso("Usuário desativado com sucesso!");
            $this->redirect('/usuario/consultar');
        }    
 
    }

    public function ativar()
    {
        $id = $_POST['id'];
            
        $usuario = new Usuario();
        $usuario->setId($id);
        $usuarioDAO = new UsuarioDAO();
        
        if(!$usuarioDAO->ativar($usuario)){
            Sessao::gravaMensagem("Usuário Inválido");
            $this->redirect('/usuario/consultar');
        }

        Sessao::gravaSucesso("Usuário pronto para ser utilizado!");
        $this->redirect('/usuario/consultar'); 
    }

    public function atualizar()
    {
        $ID = $_POST['id'];
        $Usuario = $_POST['usuario'];

        $registro = new Usuario();
        $registro->setId($ID);
        $registro->setNome($_POST['nome']);
        $registro->setUsuario($Usuario);
        $registro->setSenha($_POST['senha']);
        $registro->setTpUsuario($_POST['tpusuario']); 

        Sessao::gravaFormulario($_POST);
        
        $usuarioDAO = new UsuarioDAO();

        if ($usuarioDAO->verificaAlteracao($Usuario, $ID)){
            Sessao::gravaMensagem("Usuário já associado a um CPF");
            $this->redirect('/usuario/alterar/'.$ID);
        }

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
        $registro->setStStatus('Ativo');
        //ID_Usuario ja esta na Sessão
        $registro->setidUsuarioInclusao(Sessao::retornaidUsuario());

        Sessao::gravaFormulario($_POST);

        $usuarioDAO = new UsuarioDAO();

        if(($usuarioDAO->verificaCPF($_POST['cpf'])) and ($usuarioDAO->verificaUsuario($_POST['usuario']))){
            Sessao::gravaMensagem("Usuário e CPF já Cadastrados");
            $this->redirect('/usuario/cadastro');
        } else if ($usuarioDAO->verificaCPF($_POST['cpf'])){
            Sessao::gravaMensagem("CPF já associado a um usuário");
            $this->redirect('/usuario/cadastro');
        }else if ($usuarioDAO->verificaUsuario($_POST['usuario'])){
            Sessao::gravaMensagem("Usuário já associado a um CPF");
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

    public function logar(){
        $registro = new Usuario();
        $registro->setNome($_POST['usuario']);
        $registro->setSenha($_POST['senha']);

        $usuarioDAO = new UsuarioDAO();
       
        if ($usuarioDAO->verificaLogin($_POST['usuario'],$_POST['senha'])){ 
            
            Sessao::gravaUsuario($_POST['usuario']);
            Sessao::gravaSenha($_POST['senha']);
            
            $this->redirect('/home/index');
            
        }else{
            Sessao::gravaMensagem("Usuário e Senha incorretos, ou seu usuário pode estar impossibilitado de acessar ao Sistema!");
            $this->redirect('/login'); 
        }
    }

}