<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\AssociadoDAO;
use App\Models\DAO\LocalTrabalhoDAO;
use App\Models\DAO\CidadeDAO;
use App\Models\DAO\DependenteDAO;
use App\Models\DAO\EstadoDAO;
use App\Models\DAO\ConvenioDAO;
use App\Models\DAO\PessoaConvenioDAO;
use App\Models\Entidades\Associado;
use App\Models\Entidades\PessoaConvenio;

class AssociadoController extends Controller
{
    public function index()
    {
        $this->render('/associado/cadastro');
    }

    public function detalhes($params)
    {

      $id = $_POST['id'];
      if ($id == null){
          $id = $params[0];
      }

      $associadoDAO = new AssociadoDAO();
      $dependenteDAO = new DependenteDAO();
      $PessoaConvenioDAO = new PessoaConvenioDAO();

      self::setViewParam('associado', $associadoDAO->pegarAssociado($id));
      self::setViewParam('listarDependentes', $dependenteDAO->pegarDependenteAssociado($id));
      self::setViewParam('convenios', $PessoaConvenioDAO->associadosConvenios($id));

      $this->renderDetalhes('/associado/detalhes');

      Sessao::limpaMensagem();
      Sessao::limpaFormulario();
      Sessao::limpaSucesso();
    }

    public function cadastro()
    {
        if(!(Sessao::retornaUsuario())){
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');
        }

        $cidadeDAO = new CidadeDAO();
        self::setViewParam('listarCidades', $cidadeDAO->listarCidades());

        $localDAO = new LocalTrabalhoDAO();
        self::setViewParam('listarLocais', $localDAO->listarLocais());

        $conveioDAO = new ConvenioDAO();
        self::setViewParam('listarConvenios', $conveioDAO->listarConveniosAtivos());

        $estadoDAO = new EstadoDAO();
        self::setViewParam('listarEstados', $estadoDAO->listarEstados());


        $this->render('/associado/cadastro');

        Sessao::limpaMensagem();
        Sessao::limpaFormulario();
        Sessao::limpaSucesso();
    }

    public function salvar()
    {
        $registro = new Associado();
        $registro->setNome(ucwords($_POST['nome']));
        $registro->setRg($_POST['rg']);
        $registro->setCpf($_POST['cpf']);
        $registro->setDataNascimento($_POST['dataNasc']);
        $registro->setDataAssociacao($_POST['dataAssociacao']);
        $registro->setTelefone($_POST['telefone']);
        $registro->setCelular($_POST['celular']);
        $registro->setEmail($_POST['email']);
        $registro->setNomeRua(ucwords($_POST['rua']));
        $registro->setNomeBairro(ucwords($_POST['bairro']));
        $registro->setNumeroEndereco($_POST['numero']);
        $registro->setComplemento(ucwords($_POST['complemento']));
        $registro->setIdCidade($_POST['cidade']);
        $registro->setNumeroRegistro($_POST['registro']);
        $registro->setLocaldeTrabalho($_POST['local']);
        $registro->setCargo(ucwords($_POST['cargo']));
        $registro->setSituacao($_POST['situacao']);
        $registro->setCep($_POST['cep']);
        $registro->setSalario($_POST['salario']);
        $registro->setIdUsuarioInclusao(Sessao::retornaidUsuario());

        $qtd = $_POST['qtdConvenios'];

        for ($i=0; $i < $qtd; $i++) {
          $convenio[$i] = $_POST['check'.$i];
        }


        Sessao::gravaFormulario($_POST);

        $associadoDAO = new AssociadoDAO();

        if($associadoDAO->verificaCPF($_POST['cpf']))
        {
            Sessao::gravaMensagem("CPF já cadastrado a um Sócio!");
            $this->redirect('/associado/cadastro');
        }

        $acaoConcluir = $_POST['actionConcluir'];
        $acaoCadDep = $_POST['actionCadDep'];

        if (isset($acaoConcluir)){
          if($associadoDAO->salvar($registro)){

              Sessao::limpaFormulario();
              Sessao::gravaSucesso("Sócio cadastrado com Sucesso!");

              $socio = $associadoDAO->pegarParaConvenio($registro->getNome(), $registro->getCPF());

              $convenioPessoa  = new PessoaConvenio();

              $ID_Socio = $socio[0];

              for ($i=0; $i < $qtd; $i++) {
                if(isset($convenio[$i])){

                  printf("\nSocio: ".$ID_Socio."\nConvenio: ".$convenio[$i]);

                  $convenioPessoa->setIdAssociado($ID_Socio);
                  $convenioPessoa->setIdConvenio($convenio[$i]);
                  $convenioPessoa->setIdUsuarioInclusao(Sessao::retornaidUsuario());

                  $pessoaConveioDAO = new PessoaConvenioDAO();
                  $pessoaConveioDAO->salvar($convenioPessoa);

                }
              }

              $this->redirect('/associado/cadastro');
          }
          else{
                Sessao::gravaMensagem("Erro ao gravar!");
          }
        }
        if (isset($acaoCadDep)){
          if($associadoDAO->salvar($registro)){

            Sessao::limpaFormulario();
            Sessao::gravaSucesso("Sócio ".$registro->getNome()." cadastrado com Sucesso!");

            Sessao::gravaLastID($registro->getNome());
            Sessao::gravaLastCPF($registro->getCPF());

            $socio = $associadoDAO->pegarParaConvenio($registro->getNome(), $registro->getCPF());

            $convenioPessoa  = new PessoaConvenio();

            $ID_Socio = $socio[0];

            for ($i=0; $i < $qtd; $i++) {
              if(isset($convenio[$i])){

                printf("\nSocio: ".$ID_Socio."\nConvenio: ".$convenio[$i]);



                $convenioPessoa->setIdAssociado($ID_Socio);
                $convenioPessoa->setIdConvenio($convenio[$i]);
                $convenioPessoa->setIdUsuarioInclusao(Sessao::retornaidUsuario());

                $pessoaConveioDAO = new PessoaConvenioDAO();

                if($pessoaConveioDAO->verificaConvenio($ID_Socio, $convenio[$i])){
                  $this->redirect('/dependente/cadastro');
                } else{
                  $pessoaConveioDAO->salvar($convenioPessoa);
                }
              }
            }

            $this->redirect('/dependente/cadastro');
          }
          else{
                Sessao::gravaMensagem("Erro ao gravar!");
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
        $associadoDAO = new AssociadoDAO();
        $dependenteDAO = new DependenteDAO();

        self::setViewParam('listarAssociados', $associadoDAO->listarAssociados($busca));

        self::setViewParam('listarDependentes', $dependenteDAO->listarDependentes());
        $this->render('/associado/consultar');

        Sessao::limpaMensagem();
        Sessao::limpaFormulario();
        Sessao::limpaSucesso();
    }

    public function excluir()
    {
        $associado = new Associado();
        $associado->setIdAssociado($_POST['id']);

        $associadoDAO = new AssociadoDAO();

        if(!$associadoDAO->excluir($associado))
        {
            Sessao::gravaMensagem("Associado não encontrado!");
            $this->redirect('/associado/consultar');
        }

        Sessao::gravaSucesso("Associado Excluido com Sucesso!");
        $this->redirect('/associado/consultar');
    }

    public function alterar($params)
    {
        if(!(Sessao::retornaUsuario())){
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');
        }

        $cidadeDAO = new CidadeDAO();
        self::setViewParam('listarCidades', $cidadeDAO->listarCidades());

        $localDAO = new LocalTrabalhoDAO();
        self::setViewParam('listarLocais', $localDAO->listarLocais());

        $conveioDAO = new ConvenioDAO();
        self::setViewParam('listarConvenios', $conveioDAO->listarConveniosAtivos());

        $estadoDAO = new EstadoDAO();
        self::setViewParam('listarEstados', $estadoDAO->listarEstados());

        $id = $_POST['id'];
        if ($id == null){
            $id = $params[0];
        }
        $associadoDAO = new AssociadoDAO();
        $associado = $associadoDAO->pegarAssociado($id);

        $pessoaConveioDAO = new PessoaConvenioDAO();
        self::setViewParam('ConvenioAssociado', $pessoaConveioDAO->pegarConvenios($id) );

        if(!$associado)
        {
            Sessao::gravaMensagem("Associado Inválido");
            $this->redirect('/associado/consultar');
        }

        self::setViewParam('associado',$associado);
        $this->render('/associado/alterar');
        Sessao::limpaMensagem();
    }

    public function atualizar()
    {
        $id = $_POST['id'];

        $registro = new Associado();
        $registro->setNome(ucwords($_POST['nome']));
        $registro->setTelefone($_POST['telefone']);
        $registro->setCelular($_POST['celular']);
        $registro->setEmail($_POST['email']);
        $registro->setNomeRua(ucwords($_POST['rua']));
        $registro->setNomeBairro(ucwords($_POST['bairro']));
        $registro->setNumeroEndereco($_POST['numero']);
        $registro->setLocaldeTrabalho($_POST['local']);
        $registro->setIdCidade($_POST['cidade']);
        $registro->setCep($_POST['cep']);
        $registro->setCargo(ucwords($_POST['cargo']));
        $registro->setSalario($_POST['salario']);
        $registro->setComplemento(ucwords($_POST['complemento']));
        $registro->setSituacao($_POST['situacao']);
        $registro->setIdAssociado($id);
        $registro->setIdUsuarioInclusao(Sessao::retornaidUsuario());

        $associadoDAO = new AssociadoDAO();

        $associadoDAO->atualizar($registro);
        Sessao::limpaFormulario();
        Sessao::gravaSucesso("Associado Alterado com Sucesso!");
        $this->redirect('/associado/consultar');
    }

    public function altearstatus(){

      $id = $_POST['id'];

      $registro = new Associado();
      $registro->setSituacao($_POST['situacao']);
      $registro->setIdAssociado($id);

      $associadoDAO = new AssociadoDAO();
      if ($associadoDAO->trocarStatus($registro)){
        Sessao::limpaFormulario();
        Sessao::gravaSucesso("Situação do associado alterado com Sucesso!");
        $this->redirect('/associado/consultar');
      }
      else
      {
          Sessao::gravaMensagem("Erro ao gravar!");
      }

    }

      public function aderirConvenio($params){

      $idConvenio = $params[0];//$_POST['idConvenio'];
      $idAssociado = $params[1];//$_POST['idAssociado'];

      $convenioPessoa = new PessoaConvenio();
      $convenioPessoa->setIdAssociado($idAssociado);
      $convenioPessoa->setIdConvenio($idConvenio);
      $convenioPessoa->setIdUsuarioInclusao(Sessao::retornaidUsuario());

      $pessoaConveioDAO = new PessoaConvenioDAO();
      $pessoaConveioDAO->salvar($convenioPessoa);

      Sessao::gravaSucesso("Convenio Aderido com sucesso");
      $this->redirect('/associado/alterar/'.$idAssociado);
    }

    public function desvincularConvenio($params){
      $id = $params[0];

      echo $id;

      $convenioPessoa = new PessoaConvenio();
      $convenioPessoa->setIdConvenioPessoa($id);

      $pessoaConveioDAO = new PessoaConvenioDAO();
      $socio = $pessoaConveioDAO->relacaoAssociado($id);
      $idSocio = $socio[0];

      $pessoaConveioDAO->excluir($convenioPessoa);

      Sessao::gravaSucesso("Convenio desvinculado com sucesso");
      $this->redirect('/associado/alterar/'.$idSocio);

    }

}
