<?php

namespace App\Models\Validacao;

use \App\Models\Validacao\ResultadoValidacao;
use \App\Models\Entidades\Estado;

class EstadoValidador{

    //método para validar os dados, recebe como parametro o estado(nome,sigla)
    public function validar(Estado $estado)
    {
        //instanciando o objeto ResultadoValidacao que vai armazenar os erros
        $resultadoValidacao = new ResultadoValidacao();

        //validando se o campo nome está preenchido
        if(empty($estado->getNome()))
        {
            $resultadoValidacao->addErro('nome',"Este campo não pode ser vazio");//adicionando um novo erro, método addErro - ResultadoValidacao.php, recebe 2 parametros: nome do campo e mensagem a ser exibida
        }
        //validando caracteres especiais
        //ainda com erros, n permitindo espaços, nem acentos nas palavras
        /*else if(!ctype_alpha($estado->getNome()))
        {
            $resultadoValidacao->addErro('nome',"Não são permitidos caracteres especiais!");
        }*/
        
        //validando se o campo sigla está preenchido
        if(empty($estado->getSigla()))
        {
            $resultadoValidacao->addErro('sigla',"Este campo não pode ser vazio");
        }
        /*validando caracteres especiais
        else if(!ctype_alpha($estado->getSigla()))
        {
            $resultadoValidacao->addErro('sigla',"Não são permitidos caracteres especiais!");
        }*/
        //verificando se a sigla está no formato correto
        else if((strlen($estado->getSigla()) > 2) or (strlen($estado->getSigla()) < 2))
        {
            $resultadoValidacao->addErro('sigla',"A sigla deve ser composta por 2 caracteres");
        }

        return $resultadoValidacao;//retornando a lista de erros encontrados
    }
}