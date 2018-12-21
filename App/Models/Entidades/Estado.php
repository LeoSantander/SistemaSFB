<?php

namespace App\Models\Entidades;

use DateTime;

class Estado
{
    //atributos de um Estado
    private $id;
    private $sigla;
    private $nome;
    private $dtCadastro;
    private $idUsuarioInclusao;

    //métodos getters e setters para todos os atributos
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
        //o DateTime já retorna os dados em formato de DATA, facilitando a formatação para exibição
        return new DateTime($this->dtCadastro);
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
}