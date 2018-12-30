<?php

namespace App\Models\DAO;

use App\Models\Entidades\Cidade;

class CidadeDAO extends BaseDAO
{
    
    //verificar se cidade já esta cadastrada
    public function verificaNome($nome, $idEstado)
    {
        try{
            //realizar consulta ao banco de dados
            $query = $this->select(
                "SELECT * FROM sfm_cidade WHERE ID_Estado = '$idEstado' AND NM_Cidade = '$nome'"
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
    
    public function listarCidades()
    {
        //Selecionando no Banco de Dados
        $query = $this->select(
            "SELECT sfm_cidade.ID_Cidade, sfm_cidade.NM_Cidade, sfm_estado.NM_Estado, sfm_estado.CD_Estado  FROM sfm_cidade INNER JOIN sfm_estado ON sfm_estado.ID_Estado = sfm_cidade.ID_Estado"
        );
        return $query->fetchAll(\PDO::FETCH_CLASS, Cidade::class);
    }

    public function pegarCidade($idCidade)
        //Pegando Cidade no banco pelo Id
    {
        $query = $this->select(
            "SELECT * FROM sfm_cidade WHERE ID_Cidade = $idCidade"
        );

        return $query->fetchObject(Cidade::class);
    }

    public function excluir(Cidade $registro)
        //Excluindo cidade no banco pelo Id
    {
        try{
            $idCidade = $registro->getIdCidade();
            return $this->delete('sfm_cidade', "ID_Cidade = $idCidade");
        }
        catch(\Exception $e){
            throw new \Exception("Erro ao Excluir Cidade",500);
        }
    }

    public function atualizar(Cidade $registro)
    {
        try{
            $nome = $registro->getNome();
            $idUsuario = $registro->getIdUsuario();
            $idEstado = $registro->getIdEstado();
            $idCidade = $registro->getIdCidade();

            return $this->update(
                'sfm_cidade',
                    "NM_Cidade = :NM_Cidade, ID_Usuario_Inclusao = :ID_Usuario_Inclusao, ID_Estado = :ID_Estado",
                    [
                        ':ID_Cidade'=>$idCidade,
                        ':NM_Cidade'=>$nome,
                        ':ID_Usuario_Inclusao'=>$idUsuario,
                        ':ID_Estado'=>$idEstado
                    ],
                    "ID_Cidade = :ID_Cidade"
            );
        }
        catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados.",500);
        }
    }



}