<?php

namespace App\Models\Entidades;

use DateTime;

class Associado
{
    //Atributos de um Associado
    private $idAssociado;
    private $nome;
    private $rg;
    private $cpf;
    private $dataNascimento;
    private $dataAssociacao;
    private $telefone;
    private $celular;
    private $email;
    private $nomeRua;
    private $nomeBairro;
    private $numeroEndereco;
    private $complemento;
    private $idCidade;
    private $numeroRegistro;
    private $idLocaldeTrabalho;
    private $cargo;
    private $dataCadastro;
    private $idUsuarioInclusao;


    //Id Associado.
    public function getIdAssociado()
    {
        return $this->idAssociado;
    }
    public function setIdAssociado($idAssociado)
    {
        $this->idAssociado = $idAssociado;
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

    //Rg.
    public function getRg()
    {
        return $this->rg;
    }
    public function setRg($rg)
    {
        $this->rg = $rg;
    }

    //CPF.
    public function getCPF()
    {
        return $this->cpf;
    }
    public function setCPF($cpf)
    {
        $this->cpf = $cpf;
    }

    //Data de Nascimento.
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }
    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;
    }

    //Data de Assocação.
    public function getDataAssociacao()
    {
        return $this->dataAssociacao;
    }
    public function setDataAssociacao($dataAssociacao)
    {
        $this->dataAssociacao = $dataAssociacao;
    }

    //Telefone.
    public function getTelefone()
    {
        return $this->telefone;
    }
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    //Celular.
    public function getCelular()
    {
        return $this->celular;
    }
    public function setCelular($celular)
    {
        $this->celular = $celular;
    }

    //Email.
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    //Nome da Rua.
    public function getNomeRua()
    {
        return $this->nomeRua;
    }
    public function setNomeRua($nomeRua)
    {
        $this->nomeRua = $nomeRua;
    }

    //Nome do Bairro.
    public function getNomeBairro()
    {
        return $this->nomeBairro;
    }
    public function setNomeBairro($nomeBairro)
    {
        $this->nomeBairro = $nomeBairro;
    }

    //Numero do Endereço.
    public function getNumeroEndereco()
    {
        return $this->numeroEndereco;
    }
    public function setNumeroEndereco($numeroEndereco)
    {
        $this->numeroEndereco = $numeroEndereco;
    }

    //Complemento.
    public function getComplemento()
    {
        return $this->complemento;
    }
    public function setComplemento($complemento)
    {
        $this->complemento = $complemento;
    }

    //ID Cidade.
    public function getIdCidade()
    {
        return $this->idCidade;
    }
    public function setIdCidade($idCidade)
    {
        $this->idCidade = $idCidade;
    }

    //Numero de Registro.
    public function getNumeroRegistro()
    {
        return $this->numeroRegistro;
    }
    public function setNumeroRegistro($numeroRegistro)
    {
        $this->numeroRegistro = $numeroRegistro;
    }

    //ID Local de Trabalho.
    public function getIdLocaldeTrabalho()
    {
        return $this->idLocaldeTrabalho;
    }
    public function setIdLocaldeTrabalho($idLocaldeTrabalho)
    {
        $this->idLocaldeTrabalho = $idLocaldeTrabalho;
    }

    //Cargo.
    public function getCargo()
    {
        return $this->cargo;
    }
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;
    }

    //Data de Cadastro.
    public function getDataCadastro()
    {
        return $this->dataCadastro;
    }
    public function setDataCadastro($dataCadastro)
    {
        $this->dataCadastro = $dataCadastro;
    }

    //ID Usuario Inclusao.
    public function getIdUsuarioInclusao()
    {
        return $this->idUsuarioInclusao;
    }
    public function setIdUsuarioInclusao($idUsuarioInclusao)
    {
        $this->idUsuarioInclusao = $idUsuarioInclusao;
    }
}