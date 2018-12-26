<?php

namespace App\Models\Entidades;

use DateTime;

class Cidade
{
    //atributos de uma cidade.
    private $idCidade;
    private $nome;
    private $idUsuario;
    private $DtCadastro;
    private $idEstado;

    //Id Cidade.
    public function getIdCidade()
    {
        return $this->idCidade;
    }

    public function setId($idCidade)
    {
        $this->idCidade = $idCidade;
    }

    //Nome.
    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    //Id de Usuário.
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    //Data de Cadastro.
    public function getDtCadastro()
    {
        return new DateTime($this->DtCadastro);
    }
    
    public function setDtCadastro($DtCadastro)
    {
        $this->DtCadastro = $DtCadastro;
    }

    //Estado.
    public function getIdEstado()
    {
        return $this->idEstado;
    }

    public function setIdEstado($idEstado)
    {
        $this->idEstado = $idEstado;
    }
}