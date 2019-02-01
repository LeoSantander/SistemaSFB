<?php

namespace App\Lib\fpdf181;

class RelatorioPostos extends FPDF
{
    //função para novo relatorio de postos
    public function novo($postos, $inicio, $fim, $colunas)
    {
        //instanciando FPDF, definindo titulo do arquivo e adicionando nova Pagina
        $pdf = new FPDF();
        $pdf->SetTitle('SFM_Relatorio_Postos_'.date("d-m-Y").'.pdf',true);
        $pdf->AddPage();

        //imagem que aparece no canto superior esquerdo
        $pdf->Image('http://'.APP_HOST.'/public/img/logo.png', 10, 15, 50);

        //definindo a fonte, o nome do relatorio, fonte para texto para periodo do relatorio
        $pdf->SetFont('Arial','B',20);
        $pdf->Cell(190,60,utf8_decode('Relatório de Postos - SFM Marília - '.date("d/m/Y")),0,1,'C');
        $pdf->SetFont('Arial','',14);
        $pdf->Cell(190,-45,utf8_decode('Período: '.date('d/m/Y', strtotime($inicio)).' - '.date('d/m/Y', strtotime($fim))),0,0,'C');

        //fonte para título da tabela
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->SetY("60");//localização do começo da tabela na vertical
        $pdf->Cell(190, 10, utf8_decode('Postos Ativos'), 1, 1, 'C');

        $conta = count($colunas);//contando quantas colunas o relatorio terá
        $tam = 190/$conta;//definindo tamanho identico para todas as colunas, respeitando 190(largura da pag)

        //passando para um array o tamanho de cada coluna,
        for($i=0; $i<count($colunas); $i++)
            $teste[$i] = $tam;

        //fonte e tamanho para Cabeçalho Tabela
        $pdf->SetFont('Arial','B',12);
        $pdf->SetWidths($teste);//definindo as colunas da tabela e as larguras. CADA VALOR DESTE ARRAY SERÁ A LARGURA DE CADA COLUNA

        //passando nomes das colunas para o array colunas com acentuação
        $i=0;
        foreach($colunas as $col)
        {
            $colunas[$i] = utf8_decode($colunas[$i]);
            $i++;
        }
        $pdf->Row($colunas,'C');//exibindo linha responsável pelo cabeçalho com as colunas(texto centralizado)

        $pdf->SetFont('Arial','',11);//definindo fonte dos dados da tabela
        $pdf->SetWidths($teste);//CADA VALOR DESTE ARRAY SERÁ A LARGURA DE CADA COLUNA

        //foreach para exibir os dados
        $totalPostos=0;
        foreach($postos as $linha)
        {
            $j = 0;//conta até a ultima coluna e retorna a 0 a cada iteração
            foreach($linha as $col){
                  $array[$j] = utf8_decode($col);//faz os dados de cada com acentuação
                  $j++;//conta colunas enquanto tiver
            }
            $pdf->Row($array);//exibir linha com os dados de cada coluna
            $totalPostos++;//contar +1 posto
        }
        $pdf->Ln();//pular linha

        //mostrando total de postos
        $pdf->Cell(190,0,utf8_decode('Total de Postos: '.$totalPostos),0,1,'R');
        $pdf->AliasNbPages();//exibindo contador de páginas no canto inferior direito

        $pdf->Output("SFM_Relatorio_Postos_".date("d-m-Y").".pdf",'I');//fim do PDF
    }
}
