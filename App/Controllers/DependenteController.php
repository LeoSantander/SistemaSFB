<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\DependenteDAO;
use App\Models\DAO\AssociadoDAO;
use App\Models\DAO\PessoaConvenioDAO;
use App\Models\DAO\ConvenioDAO;
use App\Models\Entidades\Dependente;
use App\Models\Entidades\PessoaConvenio;

class DependenteController extends Controller
{
    public function index()
    {
        $this->redirect('/dependente/cadastro');
    }

    public function cadastro()
    {
        if(!(Sessao::retornaUsuario())){
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');
        }

        $associadoDAO = new AssociadoDAO();
        self::setViewParam('listarAssociados',$associadoDAO->listAssoc());

        $conveioDAO = new ConvenioDAO();
        self::setViewParam('listarConvenios', $conveioDAO->listarConveniosAtivos());

        $this->render('/dependente/cadastro');

        Sessao::limpaMensagem();
        Sessao::limpaFormulario();
        Sessao::limpaSucesso();
    }

    public function salvar()
    {
        $registro = new Dependente();
        $registro->setNome(ucwords($_POST['nome']));
        $registro->setRg($_POST['rg']);
        $registro->setCpf($_POST['cpf']);
        $registro->setDataNascimento($_POST['dataNasc']);
        $registro->setIdAssociado($_POST['idAssociado']);
        $registro->setGrauDependencia($_POST['grau']);
        $registro->setIdUsuarioInclusao(Sessao::retornaidUsuario());

        $qtd = $_POST['qtdConvenios'];

        for ($i=0; $i < $qtd; $i++) {
          $convenio[$i] = $_POST['check'.$i];
        }

        Sessao::gravaFormulario($_POST);

        $dependenteDAO = new DependenteDAO();

        if($_POST['idAssociado'] == "undefined")
        {
            Sessao::gravaMensagem("Associado não Encontrado!");
            $this->redirect('/dependente/cadastro');
        }

        if($dependenteDAO->verificaCPF($_POST['cpf']))
        {
            Sessao::gravaMensagem("CPF já associado a um dependente!");
            $this->redirect('/dependente/cadastro');
        }

        $acaoConcluir = $_POST['actionConcluir'];
        $acaoCadDep = $_POST['actionCadDep'];

        if (isset($acaoConcluir)){
          if($dependenteDAO->salvar($registro))
          {
            Sessao::limpaFormulario();
            Sessao::limpaLastID();
            Sessao::gravaSucesso("Dependente ".$registro->getNome()." Cadastrado com Sucesso!");

            $dep = $dependenteDAO->pegarParaConvenio($registro->getNome(), $registro->getCPF());

            $convenioPessoa  = new PessoaConvenio();

            $ID_Dep = $dep[0];

            for ($i=0; $i < $qtd; $i++) {
              if(isset($convenio[$i])){

                $convenioPessoa->setIdAssociado($registro->getIdAssociado());
                $convenioPessoa->setIdDependente($ID_Dep);
                $convenioPessoa->setIdConvenio($convenio[$i]);
                $convenioPessoa->setIdUsuarioInclusao(Sessao::retornaidUsuario());

                $pessoaConveioDAO = new PessoaConvenioDAO();
                $pessoaConveioDAO->salvar($convenioPessoa);

              }
            }

            $this->redirect('/dependente/consultar');
          }
          else
          {
            Sessao::gravaMensagem("Erro ao gravar");
          }
        }

        if (isset($acaoCadDep)){
          if($dependenteDAO->salvar($registro))
          {
            Sessao::limpaFormulario();
            Sessao::gravaSucesso("Dependente ".$registro->getNome()." Cadastrado com Sucesso!");

            $dep = $dependenteDAO->pegarParaConvenio($registro->getNome(), $registro->getCPF());

            $convenioPessoa  = new PessoaConvenio();

            $ID_Dep = $dep[0];

            for ($i=0; $i < $qtd; $i++) {
              if(isset($convenio[$i])){

                $convenioPessoa->setIdAssociado($registro->getIdAssociado());
                $convenioPessoa->setIdDependente($ID_Dep);
                $convenioPessoa->setIdConvenio($convenio[$i]);
                $convenioPessoa->setIdUsuarioInclusao(Sessao::retornaidUsuario());

                $pessoaConveioDAO = new PessoaConvenioDAO();
                $pessoaConveioDAO->salvar($convenioPessoa);

              }
            }

            $this->redirect('/dependente/cadastro');
          }
          else
          {
            Sessao::gravaMensagem("Erro ao gravar");
          }
        }
    }

    public function consultar()
    {
        if(!(Sessao::retornaUsuario())){
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');
        }

        $busca = $_POST['buscar'];

        $dependenteDAO = new DependenteDAO();

        self::setViewParam('listarDependentes',$dependenteDAO->listarDependentes($busca));

        $this->render('/dependente/consultar');

        Sessao::limpaMensagem();
        Sessao::limpaFormulario();
        Sessao::limpaSucesso();
    }

    public function excluir()
    {
        $dependente = new Dependente();
        $dependente->setIdDependente($_POST['id']);

        $dependenteDAO = new DependenteDAO();

        if ($dependenteDAO->verificaRelacao($_POST['id'])){
          Sessao::gravaMensagem("Não foi possível excluir: Dependente possui vinculos com convenios!");
          $this->redirect('/dependente/consultar');
        }
        else{
          if(!$dependenteDAO->excluir($dependente))
          {
            Sessao::gravaMensagem("Dependente não encontrado!");
            $this->redirect('/dependente/consultar');
          }
          else{
            Sessao::gravaSucesso("Dependente Excluído com sucesso!");
            $this->redirect('/dependente/consultar');
          }
        }
    }

    public function alterar($params)
    {
        if(!(Sessao::retornaUsuario())){
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');
        }

        $associadoDAO = new AssociadoDAO();
        self::setViewParam('listarAssociados',$associadoDAO->listAssoc());

        $conveioDAO = new ConvenioDAO();
        self::setViewParam('listarConvenios', $conveioDAO->listarConveniosAtivos());

        $id = $_POST['id'];
        if ($id == null){
            $id = $params[0];
        }
        $dependenteDAO = new DependenteDAO();
        $dependente = $dependenteDAO->pegarDependente($id);

        $pessoaConveioDAO = new PessoaConvenioDAO();
        self::setViewParam('ConvenioDependentes', $pessoaConveioDAO->pegarConveniosDep($id) );

        if(!$dependente)
        {
            Sessao::gravaMensagem("Dependente Inválido");
            $this->redirect('/dependente/consultar');
        }

        self::setViewParam('dependente',$dependente);
        $this->render('/dependente/alterar');
        Sessao::limpaMensagem();
    }

    public function atualizar()
    {
        $id = $_POST['id'];
        $cpf = $_POST['cpf'];

        $registro = new Dependente();
        $registro->setCpf($cpf);
        $registro->setDataNascimento($_POST['dataNasc']);
        $registro->setGrauDependencia($_POST['grau']);
        $registro->setIdAssociado($_POST['idAssociado']);
        $registro->setIdDependente($id);
        $registro->setIdUsuarioInclusao(Sessao::retornaidUsuario());
        $registro->setNome($_POST['nome']);
        $registro->setRg($_POST['rg']);

        $dependenteDAO = new DependenteDAO();



        if($_POST['idAssociado'] == "undefined")
        {
            Sessao::gravaMensagem("Associado não Encontrado!");
            $this->redirect('/dependente/alterar/'.$id);
        }

        if($dependenteDAO->verificaAlteracao($cpf,$id))
        {
            Sessao::gravaMensagem("CPF já associado a um dependente!");
            $this->redirect('/dependente/alterar/'.$id);
        }

        $dependenteDAO->atualizar($registro);
        Sessao::limpaFormulario();
        Sessao::gravaSucesso("Dependente Alterado com Sucesso!");
        $this->redirect('/dependente/consultar');

    }

    public function aderirConvenio($params){

    $idConvenio = $params[0];//$_POST['idConvenio'];
    $idAssociado = $params[1];//$_POST['idAssociado'];

    echo $idAssociado;

    $convenioPessoa = new PessoaConvenio();
    $convenioPessoa->setIdDependente($idAssociado);
    $convenioPessoa->setIdConvenio($idConvenio);
    $convenioPessoa->setIdUsuarioInclusao(Sessao::retornaidUsuario());

    $pessoaConveioDAO = new PessoaConvenioDAO();
    $pessoaConveioDAO->salvar($convenioPessoa);

    Sessao::gravaSucesso("Convenio Aderido com sucesso");
    $this->redirect('/dependente/alterar/'.$idAssociado);
  }

  public function desvincularConvenio($params){
    $id = $params[0];

    echo $id;

    $convenioPessoa = new PessoaConvenio();
    $convenioPessoa->setIdConvenioPessoa($id);

    $pessoaConveioDAO = new PessoaConvenioDAO();
    $socio = $pessoaConveioDAO->relacaoDependente($id);
    $idDep = $socio[0];

    $pessoaConveioDAO->excluir($convenioPessoa);

    Sessao::gravaSucesso("Convenio desvinculado com sucesso");
    $this->redirect('/dependente/alterar/'.$idDep);

  }

  public function detalhes($params)
  {

    $id = $_POST['id'];
    if ($id == null){
        $id = $params[0];
    }

    $dependenteDAO = new DependenteDAO();
    self::setViewParam('dependente', $dependenteDAO->pegarDependente($id));


    $PessoaConvenioDAO = new PessoaConvenioDAO();
    self::setViewParam('convenios', $PessoaConvenioDAO->dependenteConvenios($id));

    $this->renderDetalhes('/dependente/detalhes');

    Sessao::limpaMensagem();
    Sessao::limpaFormulario();
    Sessao::limpaSucesso();
  }
}
