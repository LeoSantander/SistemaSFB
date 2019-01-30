<?php

namespace App\Models\DAO;

use App\Models\Entidades\PessoaConvenio;

class PessoaConvenioDAO extends BaseDAO
{
    public function salvar(PessoaConvenio $PessoaConvenio)
    {
        $ID_Convenio = $PessoaConvenio->getIdConvenio();
        $ID_Associado = $PessoaConvenio->getIdAssociado();
        $ID_Dependente = $PessoaConvenio->getIdDependente();
        $idUsuarioInclusao = $PessoaConvenio->getIdUsuarioInclusao();

        try{
            return $this->insert(
                  'sfm_convenio_pessoa',
                  ":ID_Convenio, :ID_Associado, :ID_Dependente, :ID_Usuario_Inclusao",
                  [
                    ':ID_Convenio'=>$ID_Convenio,
                    ':ID_Associado'=>$ID_Associado,
                    ':ID_Dependente'=>$ID_Dependente,
                    ':ID_Usuario_Inclusao'=>$idUsuarioInclusao
                  ]
              );
        }
        catch(\Exception $e){
            throw new \Exception("Erro ao gravar os dados",500);
        }
    }//fim function salvar.

    public function pegarConvenios($id){
      $query = $this->select(
          "SELECT * FROM sfm_convenio_pessoa WHERE ID_Associado = '$id'"
      );

      return $query->fetchAll(\PDO::FETCH_CLASS, PessoaConvenio::class);

    }

    public function pegarConveniosDep($id){
      $query = $this->select(
          "SELECT * FROM sfm_convenio_pessoa WHERE ID_Dependente = '$id'"
      );

      return $query->fetchAll(\PDO::FETCH_CLASS, PessoaConvenio::class);

    }

    public function relacaoAssociado($id){
      $query = $this->select(
          "SELECT ID_Associado FROM sfm_convenio_pessoa WHERE ID_convenio_associado = '$id'"
      );

      return $query->fetch();

    }

    public function relacaoDependente($id){
      $query = $this->select(
          "SELECT ID_Dependente FROM sfm_convenio_pessoa WHERE ID_convenio_associado = '$id'"
      );

      return $query->fetch();

    }

    public function excluir(PessoaConvenio $registro){
      try{
          $idRelacao = $registro->getIdConvenioPessoa();
          return $this->delete('sfm_convenio_pessoa', "ID_convenio_associado = $idRelacao");
      }
      catch(\Exception $e){
          throw new \Exception("Erro ao Excluir Cidade",500);
      }

    }

}//fim do programa.
