<?php

namespace App\Models\DAO;

use App\Models\Entidades\Cidade;

class CidadeDAO extends BaseDAO
{
    public function verificaEstado($idEstado)
    {
        try{
            //buscando no banco
            $query = $this->select(
                "SELECT * FROM sfm_cidade WHERE ID_Estado = '$idEstado"
            );
            //retorna verdadeiro ou falso
            return $query->fetch();
        }
        //caso de erro
        catch(Exception $e){
            throw new \Exception("Erro ao Carregar Dados",500);
        }
    }


    //verificar se cidade já esta cadastrada
    public function verificaNome($nome)
    {
        try{
            //realizar consulta ao banco de dados
            $query = $this->select(
                "SELECT * FROM sfm_cidade WHERE NM_Cidade = '$nome'"
            );
            //retorna true ou false
            return $query->fetch();
        }
        //caso de erro na consulta
        catch(Exception $e){
            throw new \Exception("Erro ao carregar Dados",500);
        }
    }

    //salvando dados de uma nova cidade
    public function salvar(Cidade $cidade)
    {
        try{
            //obtendo nome e sigla do registro as variaveis 'nome e sigla'
            $nome = $cidade->getNome();
            $idUsuario= $cidade->getIdUsuario();
            $idEstado = $cidade->getIdEstado();
            //printf('Nome: '.$nome. '- Sigla:' .$sigla.'Id: '.$idUsuarioInclusao);
            
            //retorna true or false, fazendo a inserção no banco de dados (insert - função da BaseDAO 
            //recebe 3 parametros: nome da tabela, campos a serem afetados, dados para inserção)
            return $this->insert(
                'sfm_cidade',
                ":NM_Cidade, :ID_Usuario_Inclusao, :ID_Estado",
                [
                    ':NM_Cidade'=>$nome,
                    ':ID_Estado'=>$idEstado,
                    ':ID_Usuario_Inclusao'=>$idUsuario
                ]
            );
        }
        //caso ocorra alguma exceção na consulta ao bd
        catch(\Exception $e){
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }   
}