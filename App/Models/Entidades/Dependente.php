<?php

namespace App\Models\Entidades;

use DateTime;

class Dependente{

    private $idDependente;
    private $nome;
    private $rg;
    private $cpf;
    private $dataNascimento;
    private $idAssociado;
    private $grauDependencia;
    private $idUsuarioInclusao;

    public function setIdDependente($idDependente)
    {
        $this->idDependente = $idDependente;
    }

    public function getIdDependente()
    {
        return $this->idDependente;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setRg($rg)
    {
        $this->rg = $rg;
    }

    public function getRg()
    {
        return $this->rg;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;
    }

    public function getDataNascimento(){
        return $this->dataNascimento;
    }

    public function setIdAssociado($idAssociado)
    {
        $this->idAssociado = $idAssociado;
    }

    public function getIdAssociado()
    {
        return $this->idAssociado;
    }

    public function setGrauDependencia($grauDependencia)
    {
        $this->grauDependencia = $grauDependencia;
    }

    public function getGrauDependencia()
    {
        return $this->grauDependencia;
    }

    public function setIdUsuarioInclusao($idUsuarioInclusao)
    {
        $this->idUsuarioInclusao = $idUsuarioInclusao;
    }

    public function getIdUsuarioInclusao()
    {
        return $this->idUsuarioInclusao;
    }
}