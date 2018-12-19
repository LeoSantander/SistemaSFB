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
    public function salvar(Estado $registro)
    {
        try{
            //obtendo nome e sigla do registro as variaveis 'nome e sigla'
            $nome = $registro->getNome();
            $sigla = $registro->getSigla();
            
            //printf('Nome: '.$nome. '- Sigla:' .$sigla);
            
            //retorna true or false, fazendo a inserção no banco de dados (insert - função da BaseDAO 
            //recebe 3 parametros: nome da tabela, campos a serem afetados, dados para inserção)
            return $this->insert(
                'sfm_estado',
                ":NM_Estado, :CD_Estado",
                [
                    ':NM_Estado'=>$nome,
                    ':CD_Estado'=>$sigla
                ]
            );
        }
        //caso ocorra alguma exceção na consulta ao bd
        catch(\Exception $e){
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

}
