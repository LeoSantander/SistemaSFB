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
        $idAssociado = $dependente->getIdAssociado();
        $grauDependencia = $dependente->getGrauDependencia();
        $idUsuarioInclusao = $dependente->getIdUsuarioInclusao();

        try{
            return $this->insert(
                'sfm_dependentes',
                ":NM_Dependente, :NM_Grau, :RG,:DT_Nascimento, :CPF, :ID_Usuario_Inclusao, :ID_Associado",
                [
                    ':NM_Dependente'=>$nome,
                    ':RG'=>$rg,
                    ':CPF'=>$cpf,
                    ':DT_Nascimento'=>$dataNasc,
                    ':NM_Grau'=>$grauDependencia,
                    ':ID_Usuario_Inclusao'=>$idUsuarioInclusao,
                    ':ID_Associado'=>$idAssociado
                ]
            );

        }
        catch(\Exception $e){
            throw new \Exception("Erro ao gravar dados", 500);
        }
    }

    public function listarDependentes($busca = '')
    {
        if(isset($busca))
        {
            $query = $this->select(
                "SELECT
                      sfm_dependentes.*,
                      sfm_dependentes.ID_Associado as Associado,
                      sfm_associados.NM_Associado as NM_Associado
                 FROM sfm_dependentes
                    INNER JOIN sfm_associados
                    ON sfm_associados.ID_Associado = sfm_dependentes.ID_Associado
                 WHERE NM_Dependente LIKE '%".$busca."%' ORDER BY NM_Associado, NM_Dependente"
            );
            return $query->fetchAll(\PDO::FETCH_CLASS, Dependente::class);
        }
        else
        {
            $query = $this->select(
                "SELECT
                      sfm_dependentes.*,
                      sfm_dependentes.ID_Associado as Associado,
                      sfm_associados.NM_Associado as NM_Associado
                 FROM sfm_dependentes
                    INNER JOIN sfm_associados
                    ON sfm_associados.ID_Associado = sfm_dependentes.ID_Associado
                 ORDER BY NM_Associado, NM_Dependente"
            );
            return $query->fetchAll(\PDO::FETCH_CLASS, Dependente::class);
        }
    }

    public function pegarDependente($id)
    {
        $query = $this->select(
            "SELECT * FROM sfm_dependentes WHERE ID_Dependente = '$id'"
        );

        return $query->fetchObject(Dependente::class);
    }

    public function pegarParaConvenio($nm, $cpf){
      $query = $this->select(
        "SELECT sfm_dependentes.ID_Dependente AS DependenteID
         FROM sfm_dependentes
         WHERE sfm_dependentes.NM_Dependente = '$nm' AND sfm_dependentes.CPF = '$cpf'
      ");
      return $query->fetch();

    }

    public function pegarDependenteAssociado($id)
    {
        $query = $this->select(
            "SELECT * FROM sfm_dependentes WHERE ID_Associado = '$id'"
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

    public function atualizar(Dependente $dependente)
    {
        try{
            $cpf = $dependente->getCpf();
            $data = $dependente->getDataNascimento();
            $grau = $dependente->getGrauDependencia();
            $idAssociado = $dependente->getIdAssociado();
            $idDependente = $dependente->getIdDependente();
            $idUsuario = $dependente->getIdUsuarioInclusao();
            $nome = $dependente->getNome();
            $rg = $dependente->getRg();

            return $this->update(
                'sfm_dependentes',
                "NM_Dependente = :NM_Dependente, CPF = :CPF, RG = :RG, DT_Nascimento = :DT_Nascimento, NM_Grau = :NM_Grau, ID_Associado = :ID_Associado,ID_Usuario_Inclusao = :ID_Usuario_Inclusao",
                [
                    ':ID_Dependente'=>$idDependente,
                    ':NM_Dependente'=>$nome,
                    ':CPF'=>$cpf,
                    ':RG'=>$rg,
                    ':DT_Nascimento'=>$data,
                    ':NM_Grau'=>$grau,
                    ':ID_Usuario_Inclusao'=>$idUsuario,
                    ':ID_Associado'=>$idAssociado

                ],
                "ID_Dependente = :ID_Dependente"
            );
        }
        catch(\Exception $e)
        {
            throw new \Exception("Erro ao atualizar",500);
        }
    }

    public function verificaCPF($cpf)
    {
        try {

            $query = $this->select(
                "SELECT * FROM sfm_dependentes WHERE CPF = '$cpf' "
            );

            return $query->fetch();

        }catch (Exception $e){
            throw new \Exception("Erro no acesso aos dados.", 500);
        }
    }

    public function verificaAlteracao($cpf,$idDependente)
    {
        try {

            $query = $this->select(
                "SELECT * FROM sfm_dependentes WHERE ID_Dependente <> '$idDependente' AND CPF = '$cpf' "
            );

            return $query->fetch();

        }catch (Exception $e){
            throw new \Exception("Erro no acesso aos dados.", 500);
        }
    }

    public function relatorio($colunas, $condicao, $ordem, $amarra=null, $group=null)
    {
        $query = $this->selectRel(
          'sfm_associados as a',
          $colunas,
          $condicao,
          $ordem,
          $amarra,
          $group
        );

        //var_dump($query);

        return $query->fetchAll(\PDO::FETCH_CLASS, DependenteDAO::class);
    }
}
