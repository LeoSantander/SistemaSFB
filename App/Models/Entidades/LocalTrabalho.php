<?php

namespace App\Models\Entidades;

use DateTime;

class LocalTrabalho
{
    private $id;
    private $sgLocal;
    private $nmFantasia;
    private $cnpj;
    private $rua;
    private $bairro;
    private $numero;
    private $ID_Cidade;
    private $telefone;
    private $email;
    private $dtCadastro;
    private $idUsuarioInclusao;
    private $cep;
    private $idEscritorio;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getSgLocal()
    {
        return $this->sgLocal;
    }

    public function setSgLocal($sgLocal)
    {
        $this->sgLocal = $sgLocal;
    }

    public function getNMFantasia()
    {
        return $this->nmFantasia;
    }

    public function setNMFantasia($nmFantasia)
    {
        $this->nmFantasia = $nmFantasia;
    }

    public function getCNPJ()
    {
        return $this->cnpj;
    }

    public function setCNPJ($cnpj)
    {
        $this->cnpj = $cnpj;
    }

    public function getRua()
    {
        return $this->rua;
    }

    public function setRua($rua)
    {
        $this->rua = $rua;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    public function getIDCidade()
    {
        return $this->ID_Cidade;
    }

    public function setIDCidade($ID_Cidade)
    {
        $this->ID_Cidade = $ID_Cidade;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getDtCadastro()
    {
        return new DateTime ($this->dtCadastro);
    }

    public function setDtCadastro($dtCadastro)
    {
        $this->dtCadastro = $dtCadastro;
    }

    public function getidUsuarioInclusao()
    {
        return $this->idUsuarioInclusao;
    }

    public function setidUsuarioInclusao($idUsuarioInclusao)
    {
        $this->idUsuarioInclusao = $idUsuarioInclusao;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    public function getIdEscritorio()
    {
        return $this->idEscritorio;
    }

    public function setIdEscritorio($idEscritorio)
    {
        $this->idEscritorio = $idEscritorio;
    }
}
?>
