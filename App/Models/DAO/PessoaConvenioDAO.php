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

    public function associadosConvenios($id){
      $query = $this->select(
          "SELECT sfm_convenios.NM_Convenio, sfm_convenios.NM_Empresa, sfm_convenios.Dia_Vencimento
           FROM sfm_convenio_pessoa
                INNER JOIN sfm_convenios
                ON sfm_convenios.ID_Convenio = sfm_convenio_pessoa.ID_Convenio
           WHERE sfm_convenio_pessoa.ID_Associado = '$id' AND sfm_convenio_pessoa.ID_Dependente IS NULL"
      );
      return $query->fetchAll(\PDO::FETCH_CLASS, PessoaConvenio::class);
    }

    public function dependenteConvenios($id){
      $query = $this->select(
          "SELECT sfm_convenio_pessoa.ID_Dependente, sfm_convenios.NM_Convenio, sfm_convenios.NM_Empresa, sfm_convenios.Dia_Vencimento
           FROM sfm_convenio_pessoa
                INNER JOIN sfm_convenios
                ON sfm_convenios.ID_Convenio = sfm_convenio_pessoa.ID_Convenio
                INNER JOIN sfm_dependentes
                ON sfm_dependentes.ID_Dependente = sfm_convenio_pessoa.ID_Dependente
           WHERE sfm_convenio_pessoa.ID_Dependente = '$id'"
      );

      return $query->fetchAll(\PDO::FETCH_CLASS, PessoaConvenio::class);

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

    public function verificaConvenio($ID_Socio, $ID_Convenio)
    {
        try{
            $query=$this->select(
                "SELECT * FROM sfm_convenio_pessoa WHERE ID_Associado='$ID_Socio' AND ID_Convenio = '$ID_Convenio'"
            );
            return $query->fetch();
        }
        catch(\Exception $e){
            throw new \Exception ("Erro no acesso aos dados!",500);
        }
    }

}//fim do programa.
