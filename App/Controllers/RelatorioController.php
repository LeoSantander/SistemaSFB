<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\EstadoDAO;
use App\Models\DAO\CidadeDAO;
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
        if(!(Sessao::retornaUsuario()))
        {
            Sessao::gravaMensagem("É necessário realizar Login para acessar ao Sistema!");
            $this->redirect('login/');
        }

        $cidadeDAO = new CidadeDAO();

        self::setViewParam('listarCidades', $cidadeDAO->listarCidades());
        $this->render('/relatorio/lista');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaSucesso(); 
    }

    public function imprimir()
    {
        $tipo = $_POST['tipo'];
        $inicio = date('d/m/Y', strtotime($_POST['inicio']));
        $fim = date('d/m/Y', strtotime($_POST['fim']));

        //relatorio associados
        if($tipo == 'sit1')
        {
            $rel = new RelatorioAssociados();
            $rel->novo('relatorio 1');
        }

         //relatorio Postos
        else if ($tipo == 'sit2')
        {
            $rel = new RelatorioPostos();
            $rel->novo($inicio,$fim);
            
        }

         //relatorio associados/dependentes
        else if ($tipo == 'sit3')
        {
            $rel = new RelatorioAssociadosDependentes();
            $rel->novo('agora é a hora');
        }

       
        
        /*
        $estadoDAO = new EstadoDAO();
        $cidadeDAO = new CidadeDAO();
        
        $pdf = new FPDF('P','mm','A4');
        $pdf->SetTitle('SFM_Relatorio_Associados.pdf',true);
        $pdf->AddPage();//inicio do PDF
        $pdf->SetFont('Arial','B',20);

        //$pdf->Cell(0,30);
        $pdf->Cell(190,50,utf8_decode('Relatório de Associados - SFM Marília'),0,0,'C');

        $totalEstados = count($estadoDAO->listarEstados());
        foreach($estadoDAO->listarEstados() as $estado){
            $pdf->SetY("50");
            
            $i = 0;
            $totalCidade = count($cidadeDAO->listarCidades());
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->Cell(190, 10, utf8_decode($estado->NM_Estado), 1, 1, 'C');
            $pdf->Image('http://agenciaroad.tech/wp-content/uploads/2018/11/cropped-Sem-T%C3%ADtulo-2.png', 10, 15, 50);
            
            if($totalCidade != 0){
                $pdf->SetFont('Arial', '', 14);
                $pdf->Cell(190, 8, 'Cidades', 'L, B, R', 1, 'C');
                
                foreach($cidadeDAO->listarCidades() as $cidade){
                    $i = $i + 1;
                    if($totalCidade == $i){		
                        $pdf->SetFont($fonte, '', 12);
                        $pdf->Cell(190, 6, utf8_decode($cidade->NM_Cidade), 'L, B, R', 1, 'C');			
                    }else{	
                        $pdf->SetFont($fonte, '', 12);
                        $pdf->Cell(190, 6, utf8_decode($cidade->NM_Cidade), 'L, R', 1, 'C');					
                    }	
                }	
            }else{		
                $pdf->SetFont($fonte, '', 12);
                $pdf->Cell(190, 8, utf8_decode('Nenhum'), 'L, R, B', 1, 'C');
            }	
            //$pdf->AddPage();
        }
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(190,14,utf8_decode('Total de Estados: '.$totalEstados),0,1,'R');
        $pdf->Cell(190,0,utf8_decode('Total de Cidades: '.$totalCidade),0,1,'R');

        $pdf->Output();//fim do PDF*/

        /*
        $estadoDAO = new EstadoDAO();
        $cidadeDAO = new CidadeDAO();

        $pdf = new FPDF("P");
        $pdf->AddPage();
        //NOME DO ARQUIVO AO SER GERADO ou GERA O NOME DO ARQUIVO COM O LOCAL A SER SALVO
        $arquivo = "relatorio-geral.pdf";
        //DEFININDO FORMATACOES DO PDF
        $fonte = "Arial";
        $estilo = "B";
        $border = 1;
        $alinhamentoL = "L";
        $alinhamentoC = "C";
        /*
        GERAR COMO
        I: Envia o arquivo para o navegador. O visualizador de PDF é usado se disponível.
        D: Enviar para o navegador e forçar o arquivo um download com o nome especificado.
        F: Salva o arquivo local com o nome dado por name(pode incluir um caminho).
        S: Retorna o documento como uma string.
        DEFAULT: O valor padrão é I.*/
        
        /*
        $tipo_pdf = "I";
        foreach($estadoDAO->listarEstados() as $estado){
            $pdf->SetY("50");
            
            $nm = 0;
            $totalCidade = count($cidadeDAO->listarCidades());
            $total = 0;
            $pdf->SetFont($fonte, $estilo, 15);
            $pdf->Cell(190, 10, utf8_decode($estado->NM_Estado), $border, 1, $alinhamentoC);
            $pdf->Image('http://agenciaroad.tech/wp-content/uploads/2018/11/cropped-Sem-T%C3%ADtulo-2.png', 10, 15, 50);
            
            if($totalCidade != 0){
                $pdf->SetFont($fonte, $estilo, 8);
                $pdf->Cell(190, 7, 'CIDADES', 'L, B, R', 1, $alinhamentoC);
                
                foreach($cidadeDAO->listarCidades() as $cidade){
                    $nm = $nm + 1;
                    if($totalCidade == $nm){		
                        $pdf->SetFont($fonte, '', 7);
                        $pdf->Cell(190, 5, utf8_decode($cidade->NM_Cidade), 'L, B, R', 1, 'C');			
                    }else{	
                        $pdf->SetFont($fonte, '', 7);
                        $pdf->Cell(190, 5, utf8_decode($cidade->NM_Cidade), 'L, R', 1, 'C');					
                    }	
                }	
            }else{		
                $pdf->SetFont($fonte, '', 7);
                $pdf->Cell(190, 8, utf8_decode('Não tem vídeo aula'), 'L, R, B', 1, $alinhamentoC);
            }	
            //$pdf->AddPage();
        }
        //FECHANDO O ARQUIVO
        $pdf->Output($arquivo, $tipo_pdf);*/
    }
}