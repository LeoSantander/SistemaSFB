<?php

namespace App\Models\Entidades;

use DataTime;

class Escritorio
{
    //atributos para Convenio
    private $idEscritorio;
    private $nome;
    private $cnpj;
    private $telefone;
    private $rua;
    private $bairro;
    private $endereco;
    private $idCidade;
    private $email;
    private $cep;
    private $dtInclusao;
    private $idUsuarioInclusao;

//id do Escritorio
    public function getIdEscritorio()
    {
        return $this->$idEscritorio;
    }
    public function setIdEscritorio($idEscritorio)
    {
        $this->idEscritorio = $idEscritorio;
    }

//Nome do Escritorio
    public function getNmEscritorio()
    {
        return $this->nome;
    }
    public function setNmEscritorio($nome)
    {
        $this->nome = $nome;
    }

//$cnpj
    public function getCNPJ()
    {
        return $this->cnpj;
    }
    public function setCNPJ($cnpj)
    {
        $this->cnpj = $cnpj;
    }

//$telefone
    public function getTelefone()
    {
        return $this->telefone;
    }
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

//$rua
    public function getNmRua()
    {
        return $this->rua;
    }
    public function setNmRua($rua)
    {
        $this->rua = $rua;
    }

//$bairro
    public function getNmBairro()
    {
        return $this->bairro;
    }
    public function setNmBairro($bairro)
    {
        $this->bairro = $bairro;
    }

//$endereco
    public function getNumEndereco()
    {
        return $this->endereco;
    }
    public function setNumEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

//$idCidade
    public function getIdCidade()
    {
        return $this->idCidade;
    }
    public function setIdCidade($idCidade)
    {
        $this->idCidade = $idCidade;
    }

//$email
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }

//CEP
    public function getCep()
    {
        return $this->cep;
    }
    public function setCep()
    {
        $this->cep = $cep;
    }
    
//data Inclusao
    public function getDtInclusao()
    {
        return $this->dtInclusao;
    }
    public function setDtInclusao($dtInclusao)
    {
        $this->dtInclusao = $dtInclusao;
    }

//Id Usuario
    public function getIdUsuarioInclusao()
    {
        return $this->idUsuarioInclusao;
    }
    public function setIdUsuarioInclusao($idUsuarioInclusao)
    {
        $this->idUsuarioInclusao = $idUsuarioInclusao;
    }
