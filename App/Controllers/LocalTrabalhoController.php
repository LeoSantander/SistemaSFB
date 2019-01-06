<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\LocalTrabalhoDAO;
use App\Models\DAO\CidadeDAO;
use App\Models\Entidades\LocalTrabalho;

class LocalTrabalhoController extends Controller
{
    public function cadastro()
    {
        if(!(Sessao::retornaUsuario())){
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');
        }

        $cidadeDAO = new CidadeDAO();

        self::setViewParam('listarCidades', $cidadeDAO->listarCidades());
        $this->render('/localTrabalho/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaSucesso();
    }
    
    public function index()
    {
        if(!(Sessao::retornaUsuario())){
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');
        }
        
        $this->redirect('/localTrabalho/cadastro');
    }

    public function consultar()
    {
        if(!(Sessao::retornaUsuario())){
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');
        }
        
        $nm = $_POST['buscar'];

        $localTrabalhoDAO = new LocalTrabalhoDAO();      
       
        self::setViewParam('listarLocais', $localTrabalhoDAO->listarLocais($nm));

        $this->render('/localTrabalho/consultar');
        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaSucesso();
    }

    public function salvar()
    {
        $registro = new LocalTrabalho();
        $registro->setSgLocal($_POST['sglocal']);
        $registro->setNMFantasia($_POST['fantasia']);
        $registro->setCNPJ($_POST['cnpj']);
        $registro->setRua($_POST['rua']);
        $registro->setBairro($_POST['bairro']);
        $registro->setNumero($_POST['numero']);
        $registro->setIDCidade($_POST['cidade']);
        $registro->setTelefone($_POST['telefone']);
        $registro->setEmail($_POST['email']);
        //ID_Usuario ja esta na Sessão
        $registro->setidUsuarioInclusao(Sessao::retornaidUsuario());

        Sessao::gravaFormulario($_POST);

        $localTrabalhoDAO = new LocalTrabalhoDAO();

        if(($localTrabalhoDAO->verificaCNPJ($_POST['cnpj'])) and ($localTrabalhoDAO->verificaNMFantasia($_POST['fantasia']))){
            Sessao::gravaMensagem("Local de Trabalho ja Registrado!");
            $this->redirect('/localTrabalho/cadastro');
        } else if ($localTrabalhoDAO->verificaCNPJ($_POST['cnpj'])){
            Sessao::gravaMensagem("CNPJ já associado a um local de trabalho");
            $this->redirect('/localTrabalho/cadastro');
        }else if ($localTrabalhoDAO->verificaNMFantasia($_POST['fantasia'])){
            Sessao::gravaMensagem("Nome Fantasia já associado a um CNPJ");
            $this->redirect('/localTrabalho/cadastro');
        }

        if($localTrabalhoDAO->salvar($registro)){
            Sessao::limpaFormulario();
            Sessao::gravaSucesso($registro->getNMFantasia()." cadastrado com Sucesso");
            $this->redirect('/localTrabalho/cadastro');            
            //$this->redirect('/usuario/sucesso');
        }else{
            Sessao::gravaMensagem("Erro ao gravar");
        }
    }

     public function excluir()
     {
         $localTrabalho = new LocalTrabalho();
         $localTrabalho->setId($_POST['id']);
 
         $localTrabalhoDAO = new LocalTrabalhoDAO();
 
         if($localTrabalhoDAO->verificaLocal($localTrabalho->getId())){
             Sessao::gravaMensagem("Não é possível excluir. Local de Trabalho possui associados vinculados");
             $this->redirect('/localTrabalho/consultar');
         }
 
         if(!$localTrabalhoDAO->excluir($localTrabalho)){
             Sessao::gravaMensagem("Local inválido");
             $this->redirect('/localTrabalho/consultar');
         }
 
         Sessao::gravaSucesso("Local de trabalho excluído com sucesso!");
         $this->redirect('/localTrabalho/consultar');   
     }

     public function alterar($params)
    {
        if(!(Sessao::retornaUsuario())){
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');
        }
        
        $cidadeDAO = new CidadeDAO();
        self::setViewParam('listarCidades', $cidadeDAO->listarCidades());

        $id = $params[0];
        $localTrabalhoDAO = new LocalTrabalhoDAO();
        $localTrabalho = $localTrabalhoDAO->pegarLocal($id);
        if(!$localTrabalho){
            Sessao::gravaMensagem("Local de Trabalho Inválido");
            $this->redirect('/usuario/consultar');
        }
        self::setViewParam('localTrabalho', $localTrabalho);
        $this->render('/localTrabalho/alterar');
        Sessao::limpaMensagem();
    }
    
    public function atualizar()
    {
        $ID = $_POST['id'];
        $CNPJ = $_POST['cnpj'];

        $registro = new LocalTrabalho();
        $registro->setId($ID);
        $registro->setSgLocal($_POST['sglocal']);
        $registro->setNMFantasia($_POST['fantasia']);
        $registro->setCNPJ($CNPJ);
        $registro->setRua($_POST['rua']);
        $registro->setBairro($_POST['bairro']);
        $registro->setNumero($_POST['numero']);
        $registro->setIDCidade($_POST['cidade']);
        $registro->setTelefone($_POST['telefone']);
        $registro->setEmail($_POST['email']);

        Sessao::gravaFormulario($_POST);
        
        $localTrabalhoDAO = new LocalTrabalhoDAO();

        if ($localTrabalhoDAO->verificaAlteracao($CNPJ, $ID)){
            Sessao::gravaMensagem("CNPJ já associado a uma Empresa");
            $this->redirect('/localTrabalho/alterar/'.$ID);
        }

        $localTrabalhoDAO->atualizar($registro);
        
        Sessao::limpaFormulario();
        Sessao::gravaSucesso("Local de Trabalho alterado com Sucesso");
        $this->redirect('/localTrabalho/consultar');

    }

}