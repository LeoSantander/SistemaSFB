<?php

namespace App\Lib\fpdf181;

use App\Models\DAO\EstadoDAO;
use App\Models\DAO\LocalTrabalhoDAO;
use App\Models\DAO\CidadeDAO;

class RelatorioAssociadosDependentes extends FPDF
{
    public function novo($teste)
    {
        $estadoDAO = new EstadoDAO();
        $cidadeDAO = new CidadeDAO();

        $pdf = new FPDF();

        $pdf->SetTitle('SFM_Relatorio_Associados_Dependentes'.date("d/m/Y").'.pdf',true);
        $pdf->AddPage();//inicio do PDF

        $pdf->SetFont('Arial','B',20);
        $pdf->Cell(190,50,utf8_decode('Relatório de Postos - SFM Marília - '.date("d/m/Y")),0,0,'C');
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(190,-35,utf8_decode('Período: 14/01/2019 - 14/01/2019'),0,0,'C');

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

        $pdf->Output();//fim do PDF
    }

}
