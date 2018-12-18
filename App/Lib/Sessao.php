<?php

namespace App\Lib;

class Sessao
{
    public static function gravaMensagem($mensagem){
        $_SESSION['mensagem'] = $mensagem;
    }
    
    public static function gravaSucesso($sucesso){
        $_SESSION['sucesso'] = $sucesso;
    }
    
    public static function limpaSucesso(){
        unset($_SESSION['sucesso']);
    }

    public static function limpaMensagem(){
        unset($_SESSION['mensagem']);
    }

    public static function retornaMensagem(){
        return ($_SESSION['mensagem']) ? $_SESSION['mensagem'] : "";
    }
    
    public static function retornaSucesso(){
        return ($_SESSION['sucesso']) ? $_SESSION['sucesso'] : "";
    }

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

    public static function gravaQtdUsuarios($qtdUsuarios){
        $_SESSION['qtdUsuarios'] = $qtdUsuarios;
    }

    public static function retornaqtdUsuarios(){
        return ($_SESSION['qtdUsuarios']) ? $_SESSION['qtdUsuarios'] : "";
    }

    public static function gravaUsuario($usuario){
        $_SESSION['usuario'] = $usuario;
    }
    
    public static function retornaUsuario(){
        return ($_SESSION['usuario']) ? $_SESSION['usuario'] : "";
    }
   
    public static function limpaUsuario(){
        unset($_SESSION['usuario']);
    }

    public static function gravaTPUsuario($TPUsuario){
        $_SESSION['TPUsuario'] = $TPUsuario;
    }
    
    public static function retornaTPUsuario(){
        return ($_SESSION['TPUsuario']) ? $_SESSION['TPUsuario'] : "";
    }
   
    public static function limpaTPUsuario(){
        unset($_SESSION['TPUsuario']);
    }

}