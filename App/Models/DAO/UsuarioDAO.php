<?php

namespace App\Models\DAO;

use App\Models\Entidades\Usuario;

class UsuarioDAO extends BaseDAO
{
    public function verificaCPF($cpf)
    {
        try {

            $query = $this->select(
                "SELECT * FROM sfm_usuarios WHERE CPF_Usuario = '$cpf' "
            );

            return $query->fetch();

        }catch (Exception $e){
            throw new \Exception("Erro no acesso aos dados.", 500);
        }
    }
    public function ContaUsuarios()
    {
        try {
            $query = $this->select(
                "SELECT * FROM sfm_usuarios"
            );
            return $query->rowCount();
            
        }catch (Exception $e){
            throw new \Exception("Erro no acesso aos dados.", 500);
        }
    }

    public  function salvar(Usuario $registro) {
        try {
            $nome      = $registro->getNome();
            $cpf       = $registro->getCpf();
            $usuario   = $registro->getUsuario(); 
            $senha     = $registro->getSenha();
            $tpusuario = $registro->getTpUsuario();
            
           // printf ($nome.' - '.$cpf.' - '.$usuario.' - '.$senha.' - '.$tpusuario);    

            return $this->insert(
                'sfm_usuarios',
                ":NM_Pessoa,:CPF_Usuario,:NM_Usuario,:Senha_Usuario, :TP_Usuario",
                [
                    ':NM_Pessoa'=>$nome,
                    ':CPF_Usuario'=>$cpf,
                    ':NM_Usuario'=>$usuario,
                    ':Senha_Usuario'=>$senha,
                    ':TP_Usuario'=>$tpusuario
                ]
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }
}