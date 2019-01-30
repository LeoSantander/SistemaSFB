<?php

namespace App\Models\Entidades;

use DataTime;

class PessoaConvenio
{
  private $idConvenioPessoa;
  private $idConvenio;
  private $idAssociado;
  private $idDependente;
  private $idUsuarioInclusao;

  public function getIdConvenioPessoa()
  {
      return $this->idConvenioPessoa;
  }
  public function setIdConvenioPessoa($idConvenioPessoa)
  {
      $this->idConvenioPessoa = $idConvenioPessoa;
  }

  public function getIdConvenio()
  {
      return $this->idConvenio;
  }
  public function setIdConvenio($idConvenio)
  {
      $this->idConvenio = $idConvenio;
  }

  public function getIdAssociado()
  {
      return $this->idAssociado;
  }
  public function setIdAssociado($idAssociado)
  {
      $this->idAssociado = $idAssociado;
  }

  public function getIdDependente()
  {
      return $this->idDependente;
  }
  public function setIdDependente($idDependente)
  {
      $this->idDependente = $idDependente;
  }

  public function getIdUsuarioInclusao()
  {
      return $this->idUsuarioInclusao;
  }
  public function setIdUsuarioInclusao($idUsuarioInclusao)
  {
      $this->idUsuarioInclusao = $idUsuarioInclusao;
  }
}
