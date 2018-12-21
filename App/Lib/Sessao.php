<?php

namespace App\Lib;

class Sessao
{
    //grava mensagens a serem exibidas
    public static function gravaMensagem($mensagem){
        $_SESSION['mensagem'] = $mensagem;
    }
    
    public static function limpaMensagem(){
        unset($_SESSION['mensagem']);
    }

    public static function retornaMensagem(){
        return ($_SESSION['mensagem']) ? $_SESSION['mensagem'] : "";
    }

    //grava mensagens de sucesso a serem exibidas
    public static function gravaSucesso($sucesso){
        $_SESSION['sucesso'] = $sucesso;
    }
    
    public static function limpaSucesso(){
        unset($_SESSION['sucesso']);
    }
    
    public static function retornaSucesso(){
        return ($_SESSION['sucesso']) ? $_SESSION['sucesso'] : "";
    }

    //grava dados do formulário
    public static function gravaFormulario($form){
        $_SESSION['form'] = $form;
    }

    public static function limpaFormulario(){
        unset($_SESSION['form']);
    }

    public static function retornaValorFormulario($key){
        return (isset($_SESSION['form'][$key])) ? $_SESSION['form'][$key] : "";
    }

    public static function existeFormulario(){
        return (isset($_SESSION['form'])) ? $_SESSION['form'] : "";
    }

    //grava quantidade de usuários do sistema
    public static function gravaQtdUsuarios($qtdUsuarios){
        $_SESSION['qtdUsuarios'] = $qtdUsuarios;
    }

    public static function retornaqtdUsuarios(){
        return ($_SESSION['qtdUsuarios']) ? $_SESSION['qtdUsuarios'] : "";
    }

    //Grava Usuário na Sessão
    public static function gravaUsuario($usuario){
        $_SESSION['usuario'] = $usuario;
    }

    public static function retornaUsuario(){
        return ($_SESSION['usuario']) ? $_SESSION['usuario'] : "";
    }
   
    public static function limpaUsuario(){
        unset($_SESSION['usuario']);
    }

    //Grava Senha na Sessão
    public static function gravaSenha($senha){
        $_SESSION['senha'] = $senha;
    }

    public static function retornaSenha(){
        return ($_SESSION['senha']) ? $_SESSION['senha'] : "";
    }
   
    public static function limpaSenha(){
        unset($_SESSION['senha']);
    }
    
    //TP Usuario
    public static function gravaTPUsuario($TPUsuario){
        $_SESSION['TPUsuario'] = $TPUsuario;
    }
    
    public static function retornaTPUsuario(){
        return ($_SESSION['TPUsuario']) ? $_SESSION['TPUsuario'] : "";
    }
   
    public static function limpaTPUsuario(){
        unset($_SESSION['TPUsuario']);
    }

     //Grava ID Usuario na Sessão
     public static function gravaidUsuario($idUsuario){
        $_SESSION['idUsuario'] = $idUsuario;
    }

    public static function retornaidUsuario(){
        return ($_SESSION['idUsuario']) ? $_SESSION['idUsuario'] : "";
    }
   
    public static function limpaidUsuario(){
        unset($_SESSION['idUsuario']);
    }
    
}