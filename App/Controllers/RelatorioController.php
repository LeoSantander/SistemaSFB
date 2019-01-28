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

    public function imprimir()
    {
        $tipo = $_POST['tipo'];

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

            $end = "CONCAT (a.NM_Rua,\", \", a.NO_Endereco,\" - \", a.NM_Bairro,\" - \", c.NM_Cidade, \" - \", a.CEP, \" - \", a.Complemento) AS Endereco";

            $situacaoEscolha = $_POST['a_situacao'];
            $dataInicio = $_POST['a_data_inicio'];
            $dataFim = $_POST['a_data_fim'];

            $condicao = ($situacaoEscolha == "Todos" ? "WHERE a.DH_Inclusao BETWEEN '$dataInicio' AND '$dataFim'" .' ' :
                        "WHERE a.DH_Inclusao BETWEEN '$dataInicio' AND '$dataFim' AND ST_Situacao = '$situacaoEscolha'" .' ');
            //var_dump($condicao);

            $dependentes = $_POST['a_ID_Dependente'];
            $dep = "count(d.ID_Associado) AS QTD_Dependentes";

            $amarra = (isset($endereco) ? " LEFT OUTER JOIN sfm_cidade AS c ON c.ID_Cidade = a.ID_Cidade" .' ' : '').
                      (isset($usuario)  ? " LEFT OUTER JOIN sfm_usuarios AS u ON u.ID_Usuario = a.ID_Usuario_Inclusao" .' ' : '').
                      (isset($dependentes)  ? " LEFT OUTER JOIN sfm_dependentes AS d ON d.ID_Associado = a.ID_Associado" .' ' : '').
                      (isset($local)    ? " LEFT OUTER JOIN sfm_local_trabalho AS p ON p.ID_Local_Trabalho = a.ID_Local_Trabalho" .' ' : '');

            //var_dump($amarra);
            $colunas = ("a.NM_Associado"                                    .', ').
                       (isset($rg)           ? "a.RG"            .', ' : '').
                       (isset($cpf)          ? "a.CPF"           .', ' : '').
                       (isset($dataNasc)     ? "a.DT_Nascimento" .', ' : '').
                       (isset($dataAss)      ? "a.DT_Associacao" .', ' : '').
                       (isset($dependentes)  ? $dep              .', ' : '').
                       (isset($telefone)     ? "a.Telefone"      .', ' : '').
                       (isset($celular)      ? "a.Celular"       .', ' : '').
                       (isset($email)        ? "a.Email"         .', ' : '').
                       (isset($endereco)     ? $end              .', ' : '').
                       (isset($registro)     ? "a.NO_Registro"   .', ' : '').
                       (isset($local)        ? "p.NM_Fantasia"   .', ' : '').
                       (isset($cargo)        ? "a.Cargo"         .', ' : '').
                       (isset($situacao)     ? "a.ST_Situacao"   .', ' : '').
                       (isset($usuario)      ? "u.NM_Usuario"    .', ' : '').
                       (isset($dataInclusao) ? "a.DH_Inclusao"   .', ' : '').
                       (isset($salario)      ? "a.VL_Salario"    .', ' : '');

            $cols = ("Nome"                                    .', ').
                    (isset($rg)           ? $rg           .', ' : '').
                    (isset($cpf)          ? $cpf          .', ' : '').
                    (isset($dataNasc)     ? $dataNasc     .', ' : '').
                    (isset($dataAss)      ? $dataAss      .', ' : '').
                    (isset($dependentes)  ? "Dependentes" .', ' : '').
                    (isset($telefone)     ? $telefone     .', ' : '').
                    (isset($celular)      ? $celular      .', ' : '').
                    (isset($email)        ? $email        .', ' : '').
                    (isset($endereco)     ? "Endereço"    .', ' : '').
                    (isset($registro)     ? $registro     .', ' : '').
                    (isset($local)        ? $local        .', ' : '').
                    (isset($cargo)        ? $cargo        .', ' : '').
                    (isset($situacao)     ? $situacao     .', ' : '').
                    (isset($usuario)      ? $usuario      .', ' : '').
                    (isset($dataInclusao) ? $dataInclusao .', ' : '').
                    (isset($salario)      ? $salario      .', ' : '');

            $retira = strlen($colunas);
            $colunas = substr($colunas,0, $retira-2);

            $retira = strlen($cols);
            $cols = substr($cols,0,$retira-2);
            $cols = explode(",", $cols);

            $ordem = $_POST['a_ordem'];

            //definindo group
            if(isset($dependentes))
            {
                $group = "GROUP BY a.ID_Associado";
            }

            //var_dump($cols);
            //printf("\nTESTE:  Select ".$colunas." From sfm_associados as a". $amarra ."".$condicao ." ". $ordem);

            $associadoDAO =  new AssociadoDAO();
            $associados = $associadoDAO->relatorio($colunas,$condicao,$ordem,$amarra,$group);

            //alterando formato das datas
            if(isset($dataInclusao))
            {
                foreach($associados as $col)
                $col->DH_Inclusao = date('d/m/Y', strtotime($col->DH_Inclusao));
            }
            if(isset($dataNasc))
            {
                foreach($associados as $col)
                $col->DT_Nascimento = date('d/m/Y', strtotime($col->DT_Nascimento));
            }
            if(isset($dataAss))
            {
                foreach($associados as $col)
                $col->DT_Associacao = date('d/m/Y', strtotime($col->DT_Associacao));
            }

            //verificando se existe algum registro ou se a data é válida
            if($dataFim < $dataInicio)
            {
                $dataInicio = date('d/m/Y', strtotime($dataInicio));
                $dataFim = date('d/m/Y', strtotime($dataFim));
                Sessao::gravaMensagem("A Data Inicial, $dataInicio é superior a Data Final, $dataFim!<br> Informe outra Data Final!");
                $this->render('/relatorio/validaRelatorio');
                Sessao::limpaMensagem();
            }
            else if(!count($associados))
            {
                $dataInicio = date('d/m/Y', strtotime($dataInicio));
                $dataFim = date('d/m/Y', strtotime($dataFim));
                Sessao::gravaMensagem("Nenhum Associado Encontrado no Período de $dataInicio a $dataFim com Situação '$situacaoEscolha'! <br> Informe outro Período ou selecione outra Situação!");
                $this->render('/relatorio/validaRelatorio');
                Sessao::limpaMensagem();
            }
            //gerando relatorio de acordo com os filtros e colunas selecionadas
            else
            {
                //var_dump($associados);
                $rel = new RelatorioAssociados();
                $rel->novo($associados, $dataInicio, $dataFim, $cols, $situacaoEscolha);
            }
        }

         //relatorio Postos
        else if ($tipo == 'sfm_local_trabalho')
        {
            //Definindo valores para as colunas
            $nomeLocal = $_POST['p_NM_Fantasia'];
            $siglaLocal = $_POST['p_CD_Local_Trabalho'];
            $cnpj = $_POST['p_CNPJ'];
            $email = $_POST['p_Email'];
            $telefone = $_POST['p_Telefone'];
            $endereco = $_POST['p_Endereco'];
            $usuario = $_POST['p_ID_Usuario_Inclusao'];
            $dataInclusao = $_POST['p_DH_Inclusao'];
            $end = "CONCAT (p.NM_Rua,\", \", p.NO_Endereco,\" - \", p.NM_Bairro,\" - \", c.NM_Cidade, \" - \", p.CEP) AS Endereco";

            $associados = $_POST['p_Associados'];
            $ass = "count(a.ID_Local_Trabalho) AS QTD_Associados";

            //verificando uniões
            $amarra = (isset($endereco) ? "LEFT OUTER JOIN sfm_cidade AS c ON c.ID_Cidade = p.ID_Cidade" .' ' : '').
                      (isset($usuario) ? " LEFT OUTER JOIN sfm_usuarios AS u ON u.ID_Usuario = p.ID_Usuario_Inclusao" .' ' : '').
                      (isset($associados) ? "LEFT OUTER JOIN sfm_associados AS a ON a.ID_Local_Trabalho = p.ID_Local_Trabalho" .' ' : '');

            //definindo group
            if(isset($associados))
            {
                $group = "GROUP BY p.ID_Local_Trabalho";
            }

            //Definindo data de inicio
            $dataInicio = $_POST['p_data_inicio'];
            $dataFim = $_POST['p_data_fim'];

            //ordem a ser exibida
            $ordem = $_POST['p_ordem'];

            //condição
            $condicao = "WHERE p.DH_Inclusao BETWEEN '$dataInicio' AND '$dataFim'";
            //var_dump($amarra);

            //definindo campos para consulta ao bd
            $colunas = ("p.NM_Fantasia"                                   .', ').
                       (isset($siglaLocal)   ? "p.CD_Local_Trabalho" .', ' : '').
                       (isset($cnpj)         ? "p.CNPJ"              .', ' : '').
                       (isset($associados)   ? $ass                  .', ' : '').
                       (isset($email)        ? "p.Email"             .', ' : '').
                       (isset($telefone)     ? "p.Telefone"          .', ' : '').
                       (isset($endereco)     ? $end                  .', ' : '').
                       (isset($usuario)      ? "u.NM_Usuario"        .', ' : '').
                       (isset($dataInclusao) ? "p.DH_Inclusao"       .', ' : '');

            //definindo nomes para as colunas no relatorio
            $cols = ("Nome"                                    .', ').
                    (isset($siglaLocal)   ? $siglaLocal   .', ' : '').
                    (isset($cnpj)         ? $cnpj         .', ' : '').
                    (isset($associados)   ? "Associados"  .', ' : '').
                    (isset($email)        ? $email        .', ' : '').
                    (isset($telefone)     ? $telefone     .', ' : '').
                    (isset($endereco)     ? "Endereço"    .', ' : '').
                    (isset($usuario)      ? $usuario      .', ' : '').
                    (isset($dataInclusao) ? $dataInclusao .', ' : '');

            //formatando, removendo ", " do fim
            $retira = strlen($colunas);
            $colunas = substr($colunas,0, $retira-2);
            //printf("\nTESTE:  Select ".$colunas." From");

            $localTrabalhoDAO = new LocalTrabalhoDAO();
            $postos = $localTrabalhoDAO->relatorio($colunas, $condicao, $ordem, $amarra, $group);
            //var_dump($postos);

            if(isset($dataInclusao))
            {
                foreach($postos as $col)
                $col->DH_Inclusao = date('d/m/Y', strtotime($col->DH_Inclusao));
            }

            //formatando, removendo ", " do fim
            $retira = strlen($cols);
            $cols = substr($cols,0,$retira-2);
            $cols = explode(",", $cols);
            //var_dump($cols);

            //verificando se existe algum registro ou se a data é válida
            if($dataFim < $dataInicio)
            {
                $dataInicio = date('d/m/Y', strtotime($dataInicio));
                $dataFim = date('d/m/Y', strtotime($dataFim));
                Sessao::gravaMensagem("A Data Inicial, $dataInicio é superior a Data Final, $dataFim!<br> Informe outra Data Final!");
                $this->render('/relatorio/validaRelatorio');
                Sessao::limpaMensagem();
            }
            else if(!count($postos))
            {
                $dataInicio = date('d/m/Y', strtotime($dataInicio));
                $dataFim = date('d/m/Y', strtotime($dataFim));
                Sessao::gravaMensagem("Nenhum Posto Encontrado no Período de $dataInicio a $dataFim! <br> Informe outro período!");
                $this->render('/relatorio/validaRelatorio');
                Sessao::limpaMensagem();
            }
            //gerando relatorio de acordo com os filtros e colunas selecionadas
            else
            {
              $rel = new RelatorioPostos();
              $rel->novo($postos, $dataInicio, $dataFim, $cols);
            }
        }

         //relatorio associados/dependentes
        else if ($tipo == 'sfm_dependentes')
        {
            $nome = $_POST['d_NM_Associado'];
            $cpf = $_POST['d_CPF'];
            $dataAss = $_POST['d_DT_Associacao'];
            $cargo = $_POST['d_Cargo'];
            $situacao = $_POST['d_ST_Associado'];

            $nomeDependente = $_POST['d_NM_Dependente'];
            $grau = $_POST['d_NM_Grau'];

            $dep = (isset($grau) ? "CONCAT (d.NM_Dependente,\"- \", d.NM_Grau) AS Dependente" : "d.NM_Dependente AS Dependente");

            $situacaoEscolha = $_POST['d_situacao'];
            $dataInicio = $_POST['d_data_inicio'];
            $dataFim = $_POST['d_data_fim'];

            $asso = "a.CPF";

            $colunas = ("a.NM_Associado"                                .', ').
                       (isset($cpf)            ? "a.CPF"           .', ' : '').
                       (isset($dataAss)        ? "a.DT_Associacao" .', ' : '').
                       (isset($cargo)          ? "a.Cargo"         .', ' : '').
                       (isset($situacao)       ? "a.ST_Situacao"   .', ' : '').
                       ($dep                                            .', ');


            $cols =    ("Nome"       .', ').
                       ("Dependente" .', ');

            //formatando, removendo ", " do fim
            $retira = strlen($colunas);
            $colunas = substr($colunas,0, $retira-2);

            //formatando, removendo ", " do fim
            $retira = strlen($cols);
            $cols = substr($cols,0,$retira-2);
            $cols = explode(",", $cols);

            $condicao = ($situacaoEscolha == "Todos" ? "WHERE a.DH_Inclusao BETWEEN '$dataInicio' AND '$dataFim'" .' ' :
                        "WHERE a.DH_Inclusao BETWEEN '$dataInicio' AND '$dataFim' AND ST_Situacao = '$situacaoEscolha'" .' ');
            //var_dump($condicao);

            $amarra = ("LEFT OUTER JOIN sfm_dependentes AS d ON d.ID_Associado = a.ID_Associado" .' ');

            $ordem = $_POST['d_ordem'];

            //printf("\nTESTE:  Select ".$colunas." From sfm_associados as a ". $amarra. " ".$condicao);
            //printf("\nTESTE:  ".$condicao);

            $dependenteDAO = new DependenteDAO();
            $associadosDependentes = $dependenteDAO->relatorio($colunas, $condicao, $ordem, $amarra);

            //var_dump($associadosDependentes);

            $total=0;
            $nomeAtual='';
            foreach ($associadosDependentes as $a)
            {
                if($a->NM_Associado == $nomeAtual)
                {
                    $a->NM_Associado = "";
                }
                else {
                  $total++;
                }
                if($a->Dependente == '')
                {
                    $a->Dependente = "Sem Dependentes";
                }

                if($a->NM_Associado != '')
                    $nomeAtual=$a->NM_Associado;

            }

            //var_dump($associadosDependentes);

            $rel = new RelatorioAssociadosDependentes();
            $rel->novo($associadosDependentes, $dataInicio,$dataFim, $cols,$total);
        }
    }
}
