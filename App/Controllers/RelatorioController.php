<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\DependenteDAO;
use App\Lib\fpdf181\fpdf;

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

        $dependenteDAO = new DependenteDAO();

        self::setViewParam('listarDependentes', $dependenteDAO->listarDependentes());
        $this->render('/relatorio/lista');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
        Sessao::limpaSucesso(); 
    }

    public function imprimir()
    {
        $pdf = new FPDF('P','mm','A4');
        $pdf->SetTitle('SFM_Relatorio_Associados.pdf',true);
        $pdf->AddPage();//inicio do PDF
        $pdf->Image('http://agenciaroad.tech/wp-content/uploads/2018/11/cropped-Sem-T%C3%ADtulo-2.png',10,10,50);
        $pdf->SetFont('Arial','B',20);

        //$pdf->Cell(0,30);
        $pdf->Cell(190,50,utf8_decode('Relatório de Associados'),0,0,'C');
        

        $pdf->Output();//fim do PDF
    }
}