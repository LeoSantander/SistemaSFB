<?php

namespace App\Models\DAO;

use App\Models\Entidades\Estado;

class EstadoDAO extends BaseDAO
{
    public function salvar(Estado $registro)
    {
        try{
            $nome = $registro->getNome();
            $sigla = $registro->getSigla();
            
            //printf('Nome: '.$nome. '- Sigla:' .$sigla);
            
            return $this->insert(
                'sfm_estado',
                ":NM_Estado, :CD_Estado",
                [
                    ':NM_Estado'=>$nome,
                    ':CD_Estado'=>$sigla
                ]
            );

        }catch(\Exception $e){
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

}
