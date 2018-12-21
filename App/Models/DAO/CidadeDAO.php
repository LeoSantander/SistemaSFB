<?php

namespace App\Models\DAO;

use App\Models\Entidades\Cidade;

class CidadeDAO extends BaseDAO
{
    //verificar se cidade já esta cadastrada
    public function verificaNome($nome)
    {
        try{
            //realizar consulta ao banco de dados
            $query = $this->select(
                "SELECT * FROM sfm_cidade WHERE NM_Cidade = '$nome"
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
    public function salvar(Cidade $registro)
    {
        try{
            //obtendo nome do registro das variaveis
            $nome = $registro->getNome();

            //retorna true ou false fazendo a inserção no banco de dados
            return $this->insert(
                'sfm_cidade',
                "NM_Cidade",
                [
                    ':NM_Cidade'=>$nome,
                ]
            );
        }
        catch(\Exception $e){
            throw new \Exception("Erro na gravação de dados.",500);
        }

    }   



}