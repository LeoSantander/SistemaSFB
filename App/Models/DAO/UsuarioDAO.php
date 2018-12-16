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

    public function listarUsuarios($nm = '')
    {
        if (isset($nm)){
            $query = $this->select(
                "SELECT ID_Usuario, NM_Pessoa, NM_Usuario, CPF_Usuario, TP_Usuario  FROM sfm_usuarios WHERE NM_Pessoa LIKE '%".$nm."%'"
            );
            return $query->fetchObject(Usuario::class);
        }else{
            $query = $this->select(
                "SELECT ID_Usuario, NM_Pessoa, NM_Usuario, CPF_Usuario, TP_Usuario  FROM sfm_usuarios"
            );
            return $query->fetchAll(\PDO::FETCH_CLASS, Usuario::class);
        }
        return false;
    }

    public function pegarUsuario($id)
    {
        $query = $this->select(
            "SELECT * FROM sfm_usuarios WHERE ID_Usuario = $id"
        );
            return $query->fetchObject(Usuario::class);
    }

    public function atualizar(Usuario $registro)
    {
        try {
        $id        = $registro->getId();    
        $nome      = $registro->getNome();
        $usuario   = $registro->getUsuario(); 
        $senha     = $registro->getSenha();
        $tpusuario = $registro->getTpUsuario();

        return $this->update(
            'sfm_usuarios',
                "NM_Pessoa = :NM_Pessoa,NM_Usuario = :NM_Usuario,Senha_Usuario = :Senha_Usuario,TP_Usuario = :TP_Usuario",  
                [
                    ':ID_Usuario'=>$id,
                    ':NM_Pessoa'=>$nome,
                    ':NM_Usuario'=>$usuario,
                    ':Senha_Usuario'=>$senha,
                    ':TP_Usuario'=>$tpusuario
                ],
                "ID_Usuario = :ID_Usuario"  
        );
        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados.", 500);
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
    public function excluir(Usuario $registro)
    {
        try {
            $id = $registro->getId();
 
            return $this->delete('sfm_usuarios',"ID_Usuario = $id");
 
        }catch (Exception $e){
 
            throw new \Exception("Erro ao deletar", 500);
        }
    }
}