<?php

namespace App\Lib\fpdf181;

class RelatorioAssociados extends FPDF
{
    public function novo($teste)
    {
        $pdf = new FPDF();
        
        $pdf->SetTitle('SFM_Relatorio_Associados_'.date("d/m/Y").'.pdf',true);
        $pdf->AddPage();//inicio do PDF
        
        $pdf->Image('http://agenciaroad.tech/wp-content/uploads/2018/11/cropped-Sem-T%C3%ADtulo-2.png', 10, 15, 50);

        $pdf->SetFont('Arial','B',20);
        $pdf->Cell(190,50,utf8_decode('Relatório de Associados - SFM Marília - '.date("d/m/Y")),0,1,'C');
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(190,-35,utf8_decode('Período: 14/01/2019 - 14/01/2019'),0,0,'C');

        $pdf->Output();
    }
    
}


