<?php

namespace App\Lib\fpdf181;

use App\Models\DAO\EstadoDAO;
use App\Models\DAO\LocalTrabalhoDAO;
use App\Models\DAO\CidadeDAO;

class RelatorioPostos extends FPDF
{
    public function novo($postos, $inicio, $fim, $colunas)
    {
        $estadoDAO = new EstadoDAO();
        $cidadeDAO = new CidadeDAO();
        $localTrabalhoDAO = new LocalTrabalhoDAO();

        $pdf = new FPDF();

        $pdf->SetTitle('SFM_Relatorio_Postos_'.date("d/m/Y").'.pdf',true);
        $pdf->AddPage();//inicio do PDF

        $pdf->Image('http://agenciaroad.tech/wp-content/uploads/2018/11/cropped-Sem-T%C3%ADtulo-2.png', 10, 15, 50);

        $pdf->SetFont('Arial','B',20);
        $pdf->Cell(190,50,utf8_decode('Relatório de Postos - SFM Marília - '.date("d/m/Y")),0,1,'C');
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(190,-35,utf8_decode('Período: '.date('d/m/Y', strtotime($inicio)).' - '.date('d/m/Y', strtotime($fim))),0,0,'C');

        $totalEstados = count($estadoDAO->listarEstados());
        $totalPostos = count($localTrabalhoDAO->listarLocais());
        $totalCidade = count($cidadeDAO->listarCidades());

        $pdf->SetFont('Arial', '', 12);
        $pdf->SetY("50");
        $pdf->Cell(190,0,utf8_decode('Total de Postos: '.$totalPostos),0,1,'R');
        $pdf->Cell(190,14,utf8_decode('Total de Cidades: '.$totalCidade),0,1,'R');
        $pdf->Cell(190,0,utf8_decode('Total de Estados: '.$totalEstados),0,1,'R');

        //$pdf->SetFont('Arial', 'B', 16);
        $pdf->SetY("75");
        //$pdf->Cell(190, 10, utf8_decode('Postos Ativos'), 1, 1, 'C');

        foreach($colunas as $col){
          $pdf->SetFont('Arial','',10);
          //$pdf->MultiCell(0,7,utf8_decode($col),1);
          $pdf->Cell(30,7,utf8_decode($col),1);
        }
        $pdf->Ln();

        foreach($postos as $linha)
        {
          $pdf->SetFont('Arial','',8);
            foreach($linha as $col)
              $pdf->Cell(30,6,utf8_decode($col),1);
            $pdf->Ln();
        }
        $pdf->Output();//fim do PDF
    }
}
