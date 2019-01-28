<?php

namespace App\Models\Entidades;

use DataTime;

class Convenio
{
    //atributos para Convenio
    private $idConvenio;
    private $vlConvenio;
    private $dtVencimento;
    private $nmEmpresa;
    private $nmConvenio;
    private $situacao;
    private $dtInclusao;
    private $vlConvenioDep;
    private $idUsuarioInclusao;

    //ID idConvenio
    public function getIdConvenio()
    {
        return $this->idConvenio;
    }
    public function setIdConvenio($idConvenio)
    {
        $this->idConvenio = $idConvenio;
    }

    //Valor Convenio
    public function getVlConvenio()
    {
        return $this->vlConvenio;
    }
    public function setVlConvenio($vlConvenio)
    {
        $this->vlConvenio = $vlConvenio;
    }

    //Valor do convenio para dependentes.
    public function getVlConvenioDep()
    {
        return $this->vlConvenioDep;
    }
    public function setVlConvenioDep($vlConvenioDep)
    {
        $this->vlConvenioDep = $vlConvenioDep;
    }

    //Data de Vencimento
    public function getDtVencimento()
    {
        return $this->dtVencimento;
    }
    public function setDtVencimento($dtVencimento)
    {
        $this->dtVencimento = $dtVencimento;
    }

    //Nome da Empresa
    public function getNmEmpresa()
    {
        return $this->nmEmpresa;
    }
    public function setNmEmpresa($nmEmpresa)
    {
        $this->nmEmpresa = $nmEmpresa;
    }

    //Nome do Convenio
    public function getNmConvenio()
    {
        return $this->nmConvenio;
    }
    public function setNmConvenio($nmConvenio)
    {
        $this->nmConvenio = $nmConvenio;
    }

    //Situação
    public function getSituacao()
    {
        return $this->situacao;
    }
    public function setSituacao($situacao)
    {
        $this->situacao = $situacao;
    }

    //Data Inclusao
    public function getDtInclusao()
    {
        return $this->dtInclusao;
    }
    public function setDtInclusao($dtInclusao)
    {
        $this->dtInclusao = $dtInclusao;
    }

    //ID usuario Inclusao
    public function getIdUsuarioInclusao()
    {
        return $this->idUsuarioInclusao;
    }
    public function setIdUsuarioInclusao($idUsuarioInclusao)
    {
        $this->idUsuarioInclusao = $idUsuarioInclusao;
    }
}
