<?php

namespace App\Models\DAO;

use App\Models\Entidades\Escritorio;

class EscritorioDAO extends BaseDAO
{
    public function salvar(Escritorio $escritorio)
    {
        $nmEscritorio = $escritorio->getNmEscritorio();
        $cnpj = $escritorio->getCNPJ();
        $rua = $escritorio->getNmRua();
        $bairro = $escritorio->getNmBairro();
        $endereco = $escritorio->getNumEndereco();
        $idCidade = $escritorio->getIdCidade();
        $telefone = $escritorio->getTelefone();
        $cep = $escritorio->getCep();
        $email = $escritorio->getEmail();
        $idUsuarioInclusao = $escritorio->getIdUsuarioInclusao();

        try{
            return $this->insert(
                  'sfm_escritorios',
                  ":NM_Escritorio, :CEP, :NM_Rua, :CNPJ_Escritorio, :NM_Bairro, :NO_Endereco, :ID_Cidade, :Telefone, :Email, :ID_Usuario_Inclusao",
                  [
                    ':NM_Escritorio'=>$nmEscritorio,
                    ':CEP'=>$cep,
                    ':NM_Rua'=>$rua,
                    ':CNPJ_Escritorio'=>$cnpj,
                    ':NM_Bairro'=>$bairro,
                    ':NO_Endereco'=>$endereco,
                    ':ID_Cidade'=>$idCidade,
                    ':Telefone'=>$telefone,
                    ':Email'=>$email,
                    ':ID_Usuario_Inclusao'=>$idUsuarioInclusao
                  ]
              );
        }
        catch(\Exception $e){
            throw new \Exception("Erro ao gravar os dados".$e,500);
        }
    }

    public function verificaCNPJ($cnpj)
    {
        try {
            $query = $this->select(
                "SELECT * FROM sfm_escritorios WHERE CNPJ_Escritorio = '$cpf' "
            );

            return $query->fetch();

        }catch (Exception $e){
            throw new \Exception("Erro no acesso aos dados.", 500);
        }
    }

    public function verificaEscritorio($id)
    {
        $query = $this->select(
            "SELECT * FROM sfm_local_trabalho WHERE ID_Escritorio_Contabilidade = '$id'"
        );

        return $query->fetch();
    }

    public function listarEscritorios($busca = '')
    {
        if(isset($busca))
        {
            $query = $this->select(
                "SELECT
                      sfm_escritorios.*,
                      sfm_escritorios.ID_Escritorio,
                      sfm_escritorios.NM_Escritorio,
                      sfm_escritorios.CNPJ_Escritorio,
                      sfm_escritorios.Email,
                      sfm_cidade.NM_Cidade,
                      sfm_estado.NM_Estado
                 FROM sfm_escritorios
                      LEFT OUTER JOIN sfm_cidade
                      ON sfm_cidade.ID_Cidade = sfm_escritorios.ID_Cidade
                      LEFT OUTER JOIN sfm_estado
                      ON sfm_estado.ID_Estado = sfm_cidade.ID_Estado
                 WHERE sfm_escritorios.NM_Escritorio LIKE '%".$busca."%' ORDER BY sfm_escritorios.NM_Escritorio"
            );
            return $query->fetchAll(\PDO::FETCH_CLASS, Escritorio::class);
        }
        else
        {
            $query = $this->select(
              "SELECT
                    sfm_escritorios.*,
                    sfm_escritorios.ID_Escritorio,
                    sfm_escritorios.NM_Escritorio,
                    sfm_escritorios.CNPJ_Escritorio,
                    sfm_escritorios.Email,
                    sfm_cidade.NM_Cidade,
                    sfm_estado.CD_Estado
               FROM sfm_escritorios
                    LEFT OUTER JOIN sfm_cidade
                    ON sfm_cidade.ID_Cidade = sfm_escritorios.ID_Cidade
                    LEFT OUTER JOIN sfm_estado
                    ON sfm_estado.ID_Estado = sfm_cidade.ID_Estado
               ORDER BY sfm_escritorios.NM_Escritorio"
            );
            return $query->fetchAll(\PDO::FETCH_CLASS, Escritorio::class);
        }
    }

    public function excluir(Escritorio $registro)
    {
        try{
            $id = $registro->getIdEscritorio();
            return $this->delete('sfm_escritorios',"ID_Escritorio = $id");
        }
        catch(\Exception $e){
            throw new \Exception("Erro ao excluir", 500);
        }
    }

    public function pegarEscritorio($id)
    {
        $query = $this->select(
            "SELECT * FROM sfm_escritorios WHERE ID_Escritorio = '$id'"
        );

        return $query->fetchObject(Escritorio::class);
    }

    public function atualizar(Escritorio $escritorio)
    {
        try{
            $idEscritorio = $escritorio->getIdEscritorio();
            $nmEscritorio = $escritorio->getNmEscritorio();
            $cnpj = $escritorio->getCNPJ();
            $rua = $escritorio->getNmRua();
            $bairro = $escritorio->getNmBairro();
            $endereco = $escritorio->getNumEndereco();
            $idCidade = $escritorio->getIdCidade();
            $telefone = $escritorio->getTelefone();
            $cep = $escritorio->getCep();
            $email = $escritorio->getEmail();
            $idUsuarioInclusao = $escritorio->getIdUsuarioInclusao();

            return $this->update(
                'sfm_escritorios',
                "NM_Escritorio = :NM_Escritorio, CNPJ_Escritorio = :CNPJ_Escritorio, NM_Rua = :NM_Rua, NM_Bairro = :NM_Bairro, NO_Endereco = :NO_Endereco, ID_Cidade = :ID_Cidade, Telefone = :Telefone, CEP = :CEP, Email = :Email, ID_Usuario_Inclusao = :ID_Usuario_Inclusao",
                [
                  ':ID_Escritorio'=>$idEscritorio,
                  ':NM_Escritorio'=>$nmEscritorio,
                  ':CEP'=>$cep,
                  ':NM_Rua'=>$rua,
                  ':CNPJ_Escritorio'=>$cnpj,
                  ':NM_Bairro'=>$bairro,
                  ':NO_Endereco'=>$endereco,
                  ':ID_Cidade'=>$idCidade,
                  ':Telefone'=>$telefone,
                  ':Email'=>$email,
                  ':ID_Usuario_Inclusao'=>$idUsuarioInclusao
                ],
                "ID_Escritorio = :ID_Escritorio"
            );
        }
        catch(\Exception $e)
        {
            throw new \Exception("Erro ao atualizar",500);
        }
    }

    // public function verificaAlteracao($cnpj, $id)
    // {
    //     try{
    //         $query = $this->select(
    //             "SELECT * FROM sfm_escritorios WHERE ID_Escritorio <> '$id' AND CNPJ_Escritorio = '$cnpj'"
    //         );
    //         return $query->fetch();
    //     }
    //     catch(Exception $e){
    //         throw new \Exception("Erro ao carregar Dados",500);
    //     }
    // }
}//fim do programa
