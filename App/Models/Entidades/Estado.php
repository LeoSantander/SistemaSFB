<?php

namespace App\Models\Entidades;

use DateTime;

class Estado
{
    private $id;
    private $sigla;
    private $nome;
    private $dtCadastro;
    private $idUsuario;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getSigla()
    {
        return $this->sigla;
    }

    public function setSigla($sigla)
    {
        $this->sigla = $sigla;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getDtCadastro()
    {
        return new DateTime ($this->dtCadastro);
    }

    public function setDtCadastro($dtCadastro)
    {
        $this->dtCadastro = $dtCadastro;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario = $idUsuario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }
}
