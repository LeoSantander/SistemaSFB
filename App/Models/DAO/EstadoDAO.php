<?php

namespace App\Models\DAO;

use App\Models\Entidades\Estado;

class EstadoDAO extends BaseDAO
{
    //método para verificar se a sigla já está cadastrada
    public function verificaSigla($sigla)
    {
        try{
            //realizando a consulta ao banco de dados (select - método da BaseDAO)
            $query = $this->select(
                "SELECT * FROM sfm_estado WHERE CD_Estado = '$sigla' "
            );

            //retorna true or false
            return $query->fetch();
        }
        //caso ocorra alguma exceção na consulta ao bd
        catch(Exception $e){
            throw new \Exception("Erro ao Carregar Dados", 500);
        }
    }

    //método para verificar se o nome já está cadastrado
    public function verificaNome($nome)
    {
        try{
            //realizando a consulta ao banco de dados (select - método da BaseDAO)
            $query = $this->select(
                "SELECT * FROM sfm_estado WHERE NM_Estado = '$nome' "
            );
            //retorna true or false
            return $query->fetch();
        }
        //caso ocorra alguma exceção na consulta ao bd
        catch(Exception $e){
            throw new \Exception("Erro ao Carregar Dados", 500);
        }
    }

    //método para salvar os dados de um novo Estado, recebe como parametro o registro(estado) informado pelo usuário
    public function salvar(Estado $estado)
    {
        try{
            //obtendo nome e sigla do registro as variaveis 'nome e sigla'
            $nome = $estado->getNome();
            $sigla = $estado->getSigla();
            
            $idUsuarioInclusao = $estado->getidUsuarioInclusao();
            
            //printf('Nome: '.$nome. '- Sigla:' .$sigla.'Id: '.$idUsuarioInclusao);
            
            //retorna true or false, fazendo a inserção no banco de dados (insert - função da BaseDAO 
            //recebe 3 parametros: nome da tabela, campos a serem afetados, dados para inserção)
            return $this->insert(
                'sfm_estado',
                ":NM_Estado, :CD_Estado, :ID_Usuario_Inclusao",
                [
                    ':NM_Estado'=>$nome,
                    ':CD_Estado'=>$sigla,
                    ':ID_Usuario_Inclusao'=>$idUsuarioInclusao
                ]
            );
        }
        //caso ocorra alguma exceção na consulta ao bd
        catch(\Exception $e){
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    //método para listar estados, realiza uma consulta no banco
    public function listarEstados()
    {
        //fazendo seleção no banco
        $query = $this->select(
            "SELECT ID_Estado, NM_Estado, CD_Estado FROM sfm_estado ORDER BY NM_Estado"
        );
    
        return $query->fetchAll(\PDO::FETCH_CLASS, Estado::class);
    }

    //pegando estado no banco pelo id 
    public function pegarEstado($id){

        $query = $this->select(
            "SELECT * FROM sfm_estado WHERE ID_Estado = $id"
        );

        //retorna o objeto estado
        return $query->fetchObject(Estado::class);
    }

    public function excluir(Estado $registro){

        try{
            $id = $registro->getId();

            return $this->delete('sfm_estado',"ID_Estado = $id");
        }
        catch(\Exception $e){
            throw new \Exception("Erro ao excluir Estado",500);
        }
    }

}
