<?php

namespace App\Models\Entidades;

use DateTime;

class Convenio
{


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

//Situação
public function getSituacao()
{
    return $this->situacao;
}
public function setSituacao($situacao)
{
    $this->situacao = $situacao;
}

}

?>