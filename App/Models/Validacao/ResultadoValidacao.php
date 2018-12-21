<?php

namespace App\Models\Validacao;

//classe responsável por armazenar e listar erros de validação
class ResultadoValidacao{

    private $erros = [];//array para armazenar os erros.
    
    //método para adicionar novos erros no array $erros
    //recebe 2 parametros: nome do campo e mensagem a ser exibida na validação
    public function addErro($campo, $mensagem){
        $this->erros[$campo] = $mensagem;
    }

    //método para retornar a lista de erros
    public function getErros(){
        return $this->erros;
    }

}