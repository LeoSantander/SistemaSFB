<?php

namespace App\Models\DAO;

use App\Models\Entidades\Dependente;

class DependenteDAO extends BaseDAO{

    public function salvar(Dependente $dependente)
    {
        $nome = $dependente->getNome();
        $rg = $dependente->getRg();
        $cpf = $dependente->getCpf();
        $dataNasc = $dependente->getDataNascimento();
        //$idAssociado = $dependente->getIdAssociado();
        $grauDependencia = $dependente->getGrauDependencia();
        $idUsuarioInclusao = $dependente->getIdUsuarioInclusao();

        try{
            return $this->insert(
                'sfm_dependentes',
                ":NM_Dependente, :NM_Grau, :RG,:DT_Nascimento, :CPF, :ID_Usuario_Inclusao",
                [
                    ':NM_Dependente'=>$nome,
                    ':RG'=>$rg,
                    ':CPF'=>$cpf,
                    ':DT_Nascimento'=>$dataNasc,
                    ':NM_Grau'=>$grauDependencia,
                    ':ID_Usuario_Inclusao'=>$idUsuarioInclusao
                ]
            );

        }
        catch(\Exception $e){
            throw new \Exception("Erro ao gravar dados", 500);
        }
    }

    public function listarDependentes()
    {
        $query = $this->select(
            "SELECT ID_Dependente, NM_Dependente, NM_Grau, RG, CPF, DT_Nascimento FROM sfm_dependentes ORDER BY NM_Dependente"
        );

        return $query->fetchAll(\PDO::FETCH_CLASS, Dependente::class);
    }

    public function excluir(Dependente $registro)
    {
        try{
            $id = $registro->getIdDependente();
            return $this->delete('sfm_dependentes',"ID_Dependente = $id");
        }
        catch(\Exception $e){
            throw new \Exception("Erro ao excluir", 500);
        }
    }
}