<?php

namespace App\Models\Entidades;

class Usuario
{
    private $id;
    private $nome;
    private $cpf;
    private $usuario;
    private $senha;
    private $tpusuario;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }
    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function getTpUsuario()
    {
        return $this->tpusuario;
    }

    public function setTpUsuario($tpusuario)
    {
        $this->tpusuario = $tpusuario;
    }
}