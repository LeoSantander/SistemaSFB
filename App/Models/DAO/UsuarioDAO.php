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
    
    public function verificaLogin($usuario, $senha)
    {
        try {
            $query = $this->select(
                "SELECT * FROM sfm_usuarios WHERE NM_Usuario = '$usuario' AND Senha_Usuario = '$senha' AND ST_Status = 'Ativo'"
            );

            return $query->fetchAll(\PDO::FETCH_CLASS, Usuario::class);

        }catch (Exception $e){
            throw new \Exception("Erro no acesso aos dados.", 500);
        }
    }

    public function verificaUsuario($usuario)
    {
        try {

            $query = $this->select(
                "SELECT * FROM sfm_usuarios WHERE NM_Usuario = '$usuario' "
            );

            return $query->fetch();

        }catch (Exception $e){
            throw new \Exception("Erro no acesso aos dados.", 500);
        }
    }

    public function verificaAlteracao($usuario, $id)
    {
        try {

            $query = $this->select(
                "SELECT * FROM sfm_usuarios WHERE ID_Usuario <> '$id' AND NM_Usuario = '$usuario' "
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
                "SELECT ID_Usuario, NM_Pessoa, NM_Usuario, CPF_Usuario, TP_Usuario, ST_Status  FROM sfm_usuarios WHERE NM_Pessoa LIKE '%".$nm."%' ORDER BY ST_Status"
            );
            return $query->fetchAll(\PDO::FETCH_CLASS, Usuario::class);
        }else{
            $query = $this->select(
                "SELECT ID_Usuario, NM_Pessoa, NM_Usuario, CPF_Usuario, TP_Usuario, ST_Status  FROM sfm_usuarios ORDER BY ST_Status, NM_Pessoa "
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

    public function pegarTPUsuario($usuario, $senha)
    {
        $query = $this->select(
            "SELECT ID_Usuario, NM_Pessoa, TP_Usuario FROM sfm_usuarios WHERE NM_Usuario = '$usuario' AND Senha_Usuario = '$senha'"
        );
            return $query->fetchAll(\PDO::FETCH_CLASS, Usuario::class);                
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
            $idUsuarioInclusao = $registro->getidUsuarioInclusao();
            $ststatus = $registro->getStStatus();
            
            return $this->insert(
                'sfm_usuarios',
                ":NM_Pessoa,:CPF_Usuario,:NM_Usuario,:Senha_Usuario, :TP_Usuario, :ID_Usuario_Inclusao, :ST_Status",
                [
                    ':NM_Pessoa'=>$nome,
                    ':CPF_Usuario'=>$cpf,
                    ':NM_Usuario'=>$usuario,
                    ':Senha_Usuario'=>$senha,
                    ':TP_Usuario'=>$tpusuario,
                    ':ID_Usuario_Inclusao'=> $idUsuarioInclusao,
                    ':ST_Status' => $ststatus
                ]
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }
    public function desativar(Usuario $registro)
    {
        try {
            $id = $registro->getId();

            return $this->update(
                'sfm_usuarios',
                    "ST_Status = :ST_Status",  
                    [
                        ':ID_Usuario'=>$id,
                        ':ST_Status' => 'Inativo'
                    ],
                    "ID_Usuario = :ID_Usuario"  
            );
            }catch (\Exception $e){
                throw new \Exception("Erro na gravação de dados.", 500);
            }    
    }

    public function ativar(Usuario $registro)
    {
        try {
            $id = $registro->getId();
            
            return $this->update(
                'sfm_usuarios',
                    "ST_Status = :ST_Status",  
                    [
                        ':ID_Usuario'=>$id,
                        ':ST_Status' => 'Ativo'
                    ],
                    "ID_Usuario = :ID_Usuario"  
            );
            }catch (\Exception $e){
                throw new \Exception("Erro na gravação de dados.", 500);
            }    
    }
}