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
                WHERE a.NM_Associado LIKE '%".$busca."%' ORDER BY a.NM_Associado AND a.ST_Situacao"
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
                ORDER BY a.NM_Associado AND a.ST_Situacao"
            );
            return $query->fetchAll(\PDO::FETCH_CLASS, Associado::class);
       }
   }
}
