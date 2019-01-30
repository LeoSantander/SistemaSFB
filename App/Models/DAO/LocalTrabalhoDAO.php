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
            $cep = $registro->getCep();
            $idEscritorio = $registro->getIdEscritorio();

            return $this->insert(
                'sfm_local_trabalho',
                ":CD_Local_Trabalho,:NM_Fantasia,:NM_Rua,:NM_Bairro, :NO_Endereco, :ID_Cidade, :CNPJ, :Telefone, :Email, :ID_Usuario_Inclusao, :CEP, :ID_Escritorio_Contabilidade",
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
                    ':ID_Usuario_Inclusao' => $idUsuarioInclusao,
                    ':CEP' => $cep,
                    ':ID_Escritorio_Contabilidade' => $idEscritorio
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
                "SELECT *, l.Telefone as Tel, l.Email as EmailLocal, l.NM_Rua as Rua, l.NO_Endereco as Num, l.NM_Bairro as Bairro, l.CEP as CepLocal, c.NM_Cidade as NM_Cidade, e.CD_Estado as CD_Estado, s.NM_Escritorio as NM_Escritorio
                 FROM sfm_local_trabalho as l
                      INNER JOIN sfm_cidade as c
                      ON c.ID_Cidade = l.ID_Cidade
                      INNER JOIN sfm_estado as e
                      ON e.ID_Estado = c.ID_Estado
                      INNER JOIN sfm_escritorios as s
                      ON s.ID_Escritorio = l.ID_Escritorio_Contabilidade
                 WHERE l.NM_Fantasia LIKE '%".$nm."%' ORDER BY l.NM_Fantasia"
            );
            return $query->fetchAll(\PDO::FETCH_CLASS, LocalTrabalhoDAO::class);
        }else{
            $query = $this->select(
                "SELECT *, l.Telefone as Tel, l.Email as EmailLocal, l.NM_Rua as Rua, l.NO_Endereco as Num, l.NM_Bairro as Bairro, l.CEP as CepLocal, c.NM_Cidade as NM_Cidade, e.CD_Estado as CD_Estado, s.NM_Escritorio as NM_Escritorio
                 FROM sfm_local_trabalho as l
                      INNER JOIN sfm_cidade as c
                      ON c.ID_Cidade = l.ID_Cidade
                      INNER JOIN sfm_estado as e
                      ON e.ID_Estado = c.ID_Estado
                      INNER JOIN sfm_escritorios as s
                      ON s.ID_Escritorio = l.ID_Escritorio_Contabilidade
                 ORDER BY l.NM_Fantasia"
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

    public function pegarLocal($id)
    {
        $query = $this->select(
            "SELECT *, ID_Cidade as CIDADE, ID_Escritorio_Contabilidade as ESCRITORIO
             FROM sfm_local_trabalho
             WHERE ID_Local_Trabalho = $id"
        );
            return $query->fetchObject(LocalTrabalho::class);
    }

    public function atualizar(LocalTrabalho $registro)
    {
        try{
            $sgLocal = $registro->getSgLocal();
            $nmFantasia = $registro->getNMFantasia();
            $cnpj = $registro->getCNPJ();
            $rua = $registro->getRua();
            $bairro = $registro->getBairro();
            $numero = $registro->getNumero();
            $ID_Cidade = $registro->getIDCidade();
            $telefone = $registro->getTelefone();
            $email = $registro->getEmail();
            $id = $registro->getId();
            $cep = $registro->getCep();
            $idEscritorio = $registro->getIdEscritorio();

            return $this->update(
                'sfm_local_trabalho',
                "CD_Local_Trabalho = :CD_Local_Trabalho, NM_Fantasia = :NM_Fantasia, NM_Rua = :NM_Rua, NM_Bairro = :NM_Bairro, NO_Endereco = :NO_Endereco, ID_Cidade = :ID_Cidade, CNPJ = :CNPJ, Telefone = :Telefone, Email = :Email, CEP = :CEP, ID_Escritorio_Contabilidade = :ID_Escritorio_Contabilidade",
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
                        ':ID_Local_Trabalho' => $id,
                        ':CEP' => $cep,
                        ':ID_Escritorio_Contabilidade' =>$idEscritorio
                    ],
                    "ID_Local_Trabalho = :ID_Local_Trabalho"
            );
        }
        catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados.",500);
        }
    }

    public function verificaAlteracao($cnpj, $id)
    {
        try {

            $query = $this->select(
                "SELECT * FROM sfm_local_trabalho WHERE ID_Local_Trabalho <> '$id' AND CNPJ = '$cnpj' "
            );

            return $query->fetch();

        }catch (Exception $e){
            throw new \Exception("Erro no acesso aos dados.", 500);
        }
    }

    public function relatorio($colunas, $condicao, $ordem, $amarra=null, $group=null)
    {
        $query = $this->selectRel(
          'sfm_local_trabalho AS p',
          $colunas,
          $condicao,
          $ordem,
          $amarra,
          $group
        );

        //var_dump($query);

        return $query->fetchAll(\PDO::FETCH_CLASS, LocalTrabalhoDAO::class);
    }
}
?>
