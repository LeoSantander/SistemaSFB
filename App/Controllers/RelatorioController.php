<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\AssociadoDAO;
use App\Models\DAO\DependenteDAO;
use App\Models\DAO\LocalTrabalhoDAO;
use App\Lib\fpdf181\fpdf;
use App\Lib\fpdf181\RelatorioAssociados;
use App\Lib\fpdf181\RelatorioAssociadosDependentes;
use App\Lib\fpdf181\RelatorioPostos;

class RelatorioController extends Controller
{
    public function index()
    {
        $this->redirect('/relatorio/gerar');
    }

    public function gerar()
    {
        if(!(Sessao::retornaUsuario()))
        {
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');
        }

        $this->render('/relatorio/gerar');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaSucesso();
    }

    public function lista()
    {
        /*if(!(Sessao::retornaUsuario()))
        {
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');
        }

        $cidadeDAO = new CidadeDAO();

        self::setViewParam('listarCidades', $cidadeDAO->listarCidades());
        $this->render('/relatorio/lista');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaSucesso();*/
    }

    public function imprimir()
    {
        $tipo = $_POST['tipo'];
        $inicio = date('d/m/Y', strtotime($_POST['inicio']));
        $fim = date('d/m/Y', strtotime($_POST['fim']));

        //relatorio associados
        if($tipo == 'sfm_associados')
        {
            $nome = $_POST['a_NM_Associado'];
            $rg = $_POST['a_RG'];
            $cpf = $_POST['a_CPF'];
            $dataNasc = $_POST['a_DT_Nascimento'];
            $dataAss = $_POST['a_DT_Associacao'];
            $telefone = $_POST['a_Telefone'];
            $celular = $_POST['a_Celular'];
            $email = $_POST['a_Email'];
            $endereco = $_POST['a_Endereco'];
            $registro = $_POST['a_NO_Registro'];
            $local = $_POST['a_ID_Local_Trabalho'];
            $cargo = $_POST['a_Cargo'];
            $situacao = $_POST['a_ST_Associado'];
            $usuario = $_POST['a_ID_Usuario_Inclusao'];
            $dataInclusao = $_POST['a_DH_Inclusao'];
            $salario = $_POST['a_VL_Salario'];

            $situacaoEscolha = $_POST['a_situacao'];
            $dataInicio = $_POST['a_data_inicio'];
            $dataFim = $_POST['a_data_fim'];

            $colunas = (isset($nome)         ? $nome         .', ' : '').
                       (isset($rg)           ? $rg           .', ' : '').
                       (isset($cpf)          ? $cpf          .', ' : '').
                       (isset($dataNasc)     ? $dataNasc     .', ' : '').
                       (isset($telefone)     ? $telefone     .', ' : '').
                       (isset($celular)      ? $celular      .', ' : '').
                       (isset($email)        ? $email        .', ' : '').
                       (isset($endereco)     ? $endereco     .', ' : '').
                       (isset($registro)     ? $registro     .', ' : '').
                       (isset($local)        ? $local        .', ' : '').
                       (isset($cargo)        ? $cargo        .', ' : '').
                       (isset($situacao)     ? $situacao     .', ' : '').
                       (isset($usuario)      ? $usuario      .', ' : '').
                       (isset($dataInclusao) ? $dataInclusao .', ' : '').
                       (isset($salario)      ? $salario            : '');

            $condicao = (isset($situacaoEscolha) ? $situacaoEscolha .', ' : '').
                        (isset($dataInicio)      ? $dataInicio      .', ' : '').
                        (isset($dataFim)         ? $dataFim               : '');

            var_dump($colunas);
            printf("\nTESTE:  Select ".$colunas." From");

            //$associadoDAO =  new AssociadoDAO();
            //$associadoDAO->relatorio($colunas,$condicao);
            //$rel = new RelatorioAssociados();
            //$rel->novo('relatorio 1');
        }

         //relatorio Postos
        else if ($tipo == 'sfm_local_trabalho')
        {
            $nomeLocal = $_POST['p_NM_Fantasia'];
            $siglaLocal = $_POST['p_CD_Local_Trabalho'];
            $cnpj = $_POST['p_CNPJ'];
            $email = $_POST['p_Email'];
            $telefone = $_POST['p_Telefone'];
            $endereco = $_POST['p_Endereco'];
            $usuario = $_POST['p_ID_Usuario_Inclusao'];
            $dataInclusao = $_POST['p_DH_Inclusao'];
            $end = "CONCAT (p.NM_Rua,\", \", p.NO_Endereco,\" - \", p.NM_Bairro,\" - \", c.NM_Cidade, \" - \", p.CEP) AS Endereco";

            $dataInicio = $_POST['p_data_inicio'];
            $dataFim = $_POST['p_data_fim'];

            //$condicao = "WHERE $dataInicio > p.DH_Inclusao AND $dataFim < p.DH_Inclusao";

            $colunas = (isset($nomeLocal)    ? "p.NM_Fantasia"       .', ' : '').
                       (isset($siglaLocal)   ? "p.CD_Local_Trabalho" .', ' : '').
                       (isset($cnpj)         ? "p.CNPJ"              .', ' : '').
                       (isset($email)        ? "p.Email"             .', ' : '').
                       (isset($telefone)     ? "p.Telefone"          .', ' : '').
                       (isset($endereco)     ? $end                  .', ' : '').
                       (isset($usuario)      ? "u.NM_Usuario"        .', ' : '').
                       (isset($dataInclusao) ? "p.DH_Inclusao"       .', ' : '');

            $cols = (isset($nomeLocal)    ? $nomeLocal    .', ' : '').
                    (isset($siglaLocal)   ? $siglaLocal   .', ' : '').
                    (isset($cnpj)         ? $cnpj         .', ' : '').
                    (isset($email)        ? $email        .', ' : '').
                    (isset($telefone)     ? $telefone     .', ' : '').
                    (isset($endereco)     ? $endereco     .', ' : '').
                    (isset($usuario)      ? $usuario      .', ' : '').
                    (isset($dataInclusao) ? $dataInclusao .', ' : '');

            $retira = strlen($colunas);
            $colunas = substr($colunas,0, $retira-2);
            //$ordem = $nomeLocal;
            //var_dump($colunas);
            //printf("\nTESTE:  Select ".$colunas." From");
            $localTrabalhoDAO = new LocalTrabalhoDAO();

            $postos = $localTrabalhoDAO->relatorio($colunas);
            //var_dump($postos);

            $retira = strlen($cols);
            $cols = substr($cols,0,$retira-2);
            $cols = explode(",", $cols);
            //var_dump($cols);
            $rel = new RelatorioPostos();
            $rel->novo($postos, $dataInicio, $dataFim, $cols);
        }

         //relatorio associados/dependentes
        else if ($tipo == 'sfm_dependentes')
        {
            $nome = $_POST['d_NM_Associado'];
            $rg = $_POST['d_RG'];
            $cpf = $_POST['d_CPF'];
            $dataNasc = $_POST['d_DT_Nascimento'];
            $dataAss = $_POST['d_DT_Associacao'];
            $telefone = $_POST['d_Telefone'];
            $celular = $_POST['d_Celular'];
            $email = $_POST['d_Email'];
            $endereco = $_POST['d_Endereco'];
            $registro = $_POST['d_NO_Registro'];
            $local = $_POST['d_ID_Local_Trabalho'];
            $cargo = $_POST['d_Cargo'];
            $situacao = $_POST['d_ST_Associado'];
            $usuario = $_POST['d_ID_Usuario_Inclusao'];
            $dataInclusao = $_POST['d_DH_Inclusao'];
            $salario = $_POST['d_VL_Salario'];

            $nomeDependente = $_POST['d_NM_Dependente'];
            $grau = $_POST['d_NM_Grau'];

            $situacaoEscolha = $_POST['d_situacao'];
            $dataInicio = $_POST['d_data_inicio'];
            $dataFim = $_POST['d_data_fim'];

            $colunas = (isset($nome)           ? $nome           .', ' : '').
                       (isset($rg)             ? $rg             .', ' : '').
                       (isset($cpf)            ? $cpf            .', ' : '').
                       (isset($dataNasc)       ? $dataNasc       .', ' : '').
                       (isset($telefone)       ? $telefone       .', ' : '').
                       (isset($celular)        ? $celular        .', ' : '').
                       (isset($email)          ? $email          .', ' : '').
                       (isset($endereco)       ? $endereco       .', ' : '').
                       (isset($registro)       ? $registro       .', ' : '').
                       (isset($local)          ? $local          .', ' : '').
                       (isset($cargo)          ? $cargo          .', ' : '').
                       (isset($situacao)       ? $situacao       .', ' : '').
                       (isset($usuario)        ? $usuario        .', ' : '').
                       (isset($dataInclusao)   ? $dataInclusao   .', ' : '').
                       (isset($nomeDependente) ? $nomeDependente .', ' : '').
                       (isset($grau)           ? $grau           .', ' : '').
                       (isset($salario)        ? $salario              : '');

            $condicao = (isset($situacaoEscolha) ? $situacaoEscolha .', ' : '').
                        (isset($dataInicio)      ? $dataInicio      .', ' : '').
                        (isset($dataFim)         ? $dataFim               : '');


            printf("\nTESTE:  Select ".$colunas." From");
            printf("\nTESTE:  ".$condicao);

            //$rel = new RelatorioAssociadosDependentes();
            //$rel->novo('agora é a hora');
        }
    }
}
