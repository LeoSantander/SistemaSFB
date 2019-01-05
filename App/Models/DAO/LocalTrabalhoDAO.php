<?php

namespace App\Models\DAO;

use App\Models\Entidades\LocalTrabalho;

class LocalTrabalhoDAO extends BaseDAO
{
    public function verificaCNPJ($cnpj)
    {
        try {

            $query = $this->select(
                "SELECT * FROM sfm_local_trabalho WHERE CNPJ = '$cpf' "
            );

            return $query->fetch();

        }catch (Exception $e){
            throw new \Exception("Erro no acesso aos dados.", 500);
        }
    }

    public function verificaNMFantasia($nmFantasia)
    {
        try {

            $query = $this->select(
                "SELECT * FROM sfm_local_trabalho WHERE NM_Fantasia = '$nmFantasia' "
            );

            return $query->fetch();

        }catch (Exception $e){
            throw new \Exception("Erro no acesso aos dados.", 500);
        }
    }

    public  function salvar(LocalTrabalho $registro) {
        try {
            $sgLocal = $registro->getSgLocal();
            $nmFantasia = $registro->getNMFantasia();
            $cnpj = $registro->getCNPJ();
            $rua = $registro->getRua();
            $bairro = $registro->getBairro();
            $numero = $registro->getNumero();
            $ID_Cidade = $registro->getIDCidade();
            $telefone = $registro->getTelefone();
            $email = $registro->getEmail();
            $idUsuarioInclusao = $registro->getidUsuarioInclusao();

            
            return $this->insert(
                'sfm_local_trabalho',
                ":CD_Local_Trabalho,:NM_Fantasia,:NM_Rua,:NM_Bairro, :NO_Endereco, :ID_Cidade, :CNPJ, :Telefone, :Email, :ID_Usuario_Inclusao",
                [
                    ':CD_Local_Trabalho' => $sgLocal,
                    ':NM_Fantasia' => $nmFantasia,
                    ':NM_Rua' => $rua,
                    ':NM_Bairro' => $bairro, 
                    ':NO_Endereco' => $numero, 
                    ':ID_Cidade' => $ID_Cidade, 
                    ':CNPJ' => $cnpj, 
                    ':Telefone' => $telefone, 
                    ':Email' => $email, 
                    ':ID_Usuario_Inclusao' => $idUsuarioInclusao
                ]
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public function listarLocais($nm = '')
    {
        if (isset($nm)){
            $query = $this->select(
                "SELECT *, sfm_cidade.NM_Cidade as NM_Cidade, sfm_estado.CD_Estado as CD_Estado
                 FROM sfm_local_trabalho 
                      INNER JOIN sfm_cidade 
                      ON sfm_cidade.ID_Cidade = sfm_local_trabalho.ID_Cidade
                      INNER JOIN sfm_estado
                      ON sfm_estado.ID_Estado = sfm_cidade.ID_Estado
                 WHERE NM_Fantasia LIKE '%".$nm."%' ORDER BY NM_Fantasia"
            );
            return $query->fetchAll(\PDO::FETCH_CLASS, LocalTrabalhoDAO::class);
        }else{
            $query = $this->select(
                "SELECT *, sfm_cidade.NM_Cidade as NM_Cidade, sfm_estado.CD_Estado as CD_Estado 
                 FROM sfm_local_trabalho 
                      INNER JOIN sfm_cidade 
                      ON sfm_cidade.ID_Cidade = sfm_local_trabalho.ID_Cidade
                      INNER JOIN sfm_estado
                      ON sfm_estado.ID_Estado = sfm_cidade.ID_Estado
                 ORDER BY NM_Fantasia"
            );
            return $query->fetchAll(\PDO::FETCH_CLASS, LocalTrabalhoDAO::class);
        }
        return false;
    }

    public function verificaLocal($id){

        $query = $this->select(
            "SELECT * FROM sfm_associados WHERE ID_Local_Trabalho = $id"
        );

        return $query->fetch(); 
    }

    public function excluir(LocalTrabalho $registro){

        try{
            $id = $registro->getId();
            return $this->delete('sfm_local_trabalho',"ID_Local_Trabalho = $id");
        }
        catch(\Exception $e){
            throw new \Exception("Erro ao excluir Local",500);
        }
    }
}
?>