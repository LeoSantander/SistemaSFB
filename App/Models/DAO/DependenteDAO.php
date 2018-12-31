<?php

namespace App\Models\DAO;

use App\Models\Entidades\Dependente;

class DependenteDAO extends BaseDAO{

    public function salvar($dependente)
    {
        $nome = $dependente->getNome();
        $rg = $dependente->getRg();
        $cpf = $dependente->getCpf();
        //$dataNasc = $dependente->getDataNascimento();
        //$idAssociado = $dependente->getIdAssociado();
        $grauDependencia = $dependente->getGrauDependencia();
        $idUsuarioInclusao = $dependente->getIdUsuarioInclusao();

        try{
            $query = $this->insert(
                'sfm_dependentes',
                ":NM_Dependente, :NM_Grau, :RG, :CPF, :ID_Usuario_Inclusao",
                [
                    ':NM_Dependente'=>$nome,
                    ':RG'=>$rg,
                    ':CPF'=>$cpf,
                    ':NM_Grau'=>$grauDependencia,
                    ':ID_Usuario_Inclusao'=>$idUsuarioInclusao
                ]
            );
        }
        catch(\Exception $e){
            throw new \Exception("Erro ao gravar dados", 500);
        }
    }
}