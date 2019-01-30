<?php

namespace App\Models\DAO;

use App\Models\Entidades\Associado;

class AssociadoDAO extends BaseDAO
{
    public function salvar(Associado $associado)
    {
        $nome = $associado->getNome();
        $rg = $associado->getRg();
        $cpf = $associado->getCpf();
        $dataNascimento = $associado->getDataNascimento();
        $dataAssociacao = $associado->getDataAssociacao();
        $telefone = $associado->getTelefone();
        $celular = $associado->getCelular();
        $email = $associado->getEmail();
        $nomeRua = $associado->getNomeRua();
        $nomeBairro = $associado->getNomeBairro();
        $numeroEndereco = $associado->getNumeroEndereco();
        $complemento = $associado->getComplemento();
        $idCidade = $associado->getIdCidade();
        $numeroRegistro = $associado->getNumeroRegistro();
        $idLocaldeTrabalho = $associado->getLocaldeTrabalho();
        $cargo = $associado->getCargo();
        $situacao = $associado->getSituacao();
        $Cep = $associado->getCep();
        $salario = $associado->getSalario();
        $idUsuarioInclusao = $associado->getIdUsuarioInclusao();

        try{
            return $this->insert(
                'sfm_associados',
                ":NM_Associado, :RG, :CPF, :DT_Nascimento, :DT_Associacao, :Telefone, :Celular, :Email, :NM_Rua, :NM_Bairro, :NO_Endereco, :CEP, :Complemento, :ID_Cidade, :NO_Registro, :ID_Local_Trabalho, :Cargo, :ST_Situacao, :ID_Usuario_Inclusao, :VL_Salario",
                [
                    ':NM_Associado'=>$nome,
                    ':RG'=>$rg,
                    ':CPF'=>$cpf,
                    ':DT_Nascimento'=>$dataNascimento,
                    ':DT_Associacao'=>$dataAssociacao,
                    ':Telefone'=>$telefone,
                    ':Celular'=>$celular,
                    ':Email'=>$email,
                    ':NM_Rua'=>$nomeRua,
                    ':NM_Bairro'=>$nomeBairro,
                    ':NO_Endereco'=>$numeroEndereco,
                    ':CEP'=>$Cep,
                    ':Complemento'=>$complemento,
                    ':ID_Cidade'=>$idCidade,
                    ':NO_Registro'=>$numeroRegistro,
                    ':ID_Local_Trabalho'=>$idLocaldeTrabalho,
                    ':Cargo'=>$cargo,
                    ':ST_Situacao'=>$situacao,
                    ':VL_Salario'=>$salario,
                    ':ID_Usuario_Inclusao'=>$idUsuarioInclusao
                ]
            );
        }
        catch(\Exception $e){
            throw new \Exception("Erro ao gravar os dados",500);
        }
    }

    public function verificaCPF($cpf)
    {
        try{
            $query=$this->select(
                "SELECT *FROM sfm_associados WHERE CPF='$cpf'"
            );
            return $query->fetch();
        }
        catch(\Exception $e){
            throw new \Exception ("Erro no acesso aos dados!",500);
        }
    }

    public function ContaAssociados()
    {
        try {
            $query = $this->select(
                "SELECT * FROM sfm_associados WHERE ST_Situacao = 'Ativo'"
            );
            return $query->rowCount();

        }catch (Exception $e){
            throw new \Exception("Erro no acesso aos dados.", 500);
        }
    }

   public function listAssoc(){
     $query = $this->select(
      "SELECT a.*
          FROM sfm_associados as a
          ORDER BY a.NM_Associado"
      );
      return $query->fetchAll(\PDO::FETCH_CLASS, Associado::class);
   }

   public function listarAssociados($busca = '')
   {
       if(isset($busca))
       {
           $query = $this->select(
               "SELECT a.*,a.Telefone as Tel, b.NM_Cidade as NM_Cidade, c.NM_Fantasia as NM_Fantasia
                FROM sfm_associados as a
                    INNER JOIN sfm_cidade as b
                    ON b.ID_Cidade = a.ID_Cidade
                    INNER JOIN sfm_local_trabalho as c
                    ON c.ID_Local_Trabalho = a.ID_Local_Trabalho
                WHERE a.NM_Associado LIKE '%".$busca."%' ORDER BY a.ST_Situacao, a.NM_Associado"
            );
           return $query->fetchAll(\PDO::FETCH_CLASS, Associado::class);
       }
       else
       {
           $query = $this->select(
            "SELECT a.*,a.Telefone as Tel, b.NM_Cidade as NM_Cidade, c.NM_Fantasia as NM_Fantasia
                FROM sfm_associados as a
                    INNER JOIN sfm_cidade as b
                    ON b.ID_Cidade = a.ID_Cidade
                    INNER JOIN sfm_local_trabalho as c
                    ON c.ID_Local_Trabalho = a.ID_Local_Trabalho
                ORDER BY a.ST_Situacao, a.NM_Associado"
            );
            return $query->fetchAll(\PDO::FETCH_CLASS, Associado::class);
       }
   }

   public function pegarParaConvenio($nm, $cpf){
     $query = $this->select(
       "SELECT sfm_associados.ID_Associado AS SocioID
        FROM sfm_associados
        WHERE sfm_associados.NM_Associado = '$nm' AND sfm_associados.CPF = '$cpf'
     ");
     return $query->fetch();

   }

   public function pegarAssociado($id)
   {
       $query = $this->select(
           "SELECT sfm_associados.*,sfm_cidade.NM_Cidade, sfm_local_trabalho.NM_Fantasia, sfm_associados.ST_Situacao AS Situacao, sfm_associados.Complemento as Comp
            FROM sfm_associados
                 INNER JOIN sfm_cidade
                 ON sfm_associados.ID_Cidade = sfm_cidade.ID_Cidade
                 INNER JOIN sfm_local_trabalho
                 ON sfm_local_trabalho.ID_Local_Trabalho = sfm_associados.ID_Local_Trabalho
            WHERE ID_Associado = '$id'"
       );

       return $query->fetchObject(Associado::class);
   }

   public function detalheAssociado($id)
   {
       $query = $this->select(
           "SELECT * FROM sfm_associados WHERE ID_Associado = '$id'"
       );

       return $query->fetchAll(\PDO::FETCH_CLASS, Associado::class);
   }

   public function excluir(Associado $registro)
   {
       try{
           $id = $registro->getIdAssociado();
           return $this->delete('sfm_associados',"ID_Associado = $id");
       }
       catch(\Exception $e){
           throw new \Exception("Erro ao excluir", 500);
       }
   }

   public function atualizar(Associado $associado)
   {
       try{
           $nome = $associado->getNome();
           $salario = $associado->getSalario();
           $telefone = $associado->getTelefone();
           $celular = $associado->getCelular();
           $email = $associado->getEmail();
           $rua = $associado->getNomeRua();
           $numeroEndereco= $associado->getNumeroEndereco();
           $bairro = $associado->getNomeBairro();
           $cep = $associado->getCep();
           $local = $associado->getLocaldeTrabalho();
           $cidade = $associado->getIdCidade();
           $cargo = $associado->getCargo();
           $complemento = $associado->getComplemento();
           $situacao = $associado->getSituacao();
           $idAssociado = $associado->getIdAssociado();
           $idUsuarioInclusao= $associado->getIdUsuarioInclusao();


           return $this->update(
               'sfm_associados',
               "NM_Associado = :NM_Associado, VL_Salario = :VL_Salario, Telefone = :Telefone, Celular = :Celular, Email = :Email, NM_Rua = :NM_Rua, NM_Bairro = :NM_Bairro, NO_Endereco = :NO_Endereco, CEP = :CEP, ID_Local_Trabalho = :ID_Local_Trabalho, ID_Cidade = :ID_Cidade, Cargo = :Cargo, ST_Situacao = :ST_Situacao, Complemento = :Complemento, ID_Usuario_Inclusao = :ID_Usuario_Inclusao",
               [
                   ':ID_Associado'=>$idAssociado,
                   ':NM_Associado'=>$nome,
                   ':NM_Rua'=>$rua,
                   ':VL_Salario'=>$salario,
                   ':Telefone'=>$telefone,
                   ':Celular'=>$celular,
                   ':Email'=>$email,
                   ':NM_Bairro'=>$bairro,
                   ':NO_Endereco'=>$numeroEndereco,
                   ':CEP'=>$cep,
                   ':ID_Local_Trabalho'=>$local,
                   ':ID_Cidade'=>$cidade,
                   ':Cargo'=>$cargo,
                   ':Complemento'=>$complemento,
                   ':ST_Situacao'=>$situacao,
                   ':ID_Usuario_Inclusao'=>$idUsuarioInclusao

               ],
               "ID_Associado = :ID_Associado"
           );
       }
       catch(\Exception $e)
       {
           throw new \Exception("Erro ao atualizar",500);
       }
   }

   public function trocarStatus(Associado $associado)
   {
       try{
           $situacao = $associado->getSituacao();
           $idAssociado = $associado->getIdAssociado();
           return $this->update(
               'sfm_associados',
               "ST_Situacao = :ST_Situacao",
               [
                   ':ID_Associado'=>$idAssociado,
                   ':ST_Situacao'=>$situacao
               ],
               "ID_Associado = :ID_Associado"
           );
       }
       catch(\Exception $e)
       {
           throw new \Exception("Erro ao atualizar",500);
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

       return $query->fetchAll(\PDO::FETCH_CLASS, AssociadoDAO::class);
   }

   public function recUltID(){
     $query = $this->select("SELECT MAX(ID_Associado) AS MaxID FROM sfm_associados");
     return $query->fetch();
   }
}
