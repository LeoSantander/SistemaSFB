<?php

namespace App\Models\DAO;

use App\Models\Entidades\Convenio;

class ConvenioDAO extends BaseDAO
{
    public function salvar(Convenio $convenio)
    {
        $nmConvenio = $convenio->getNmConvenio();
        $empresa = $convenio->getNmEmpresa();
        $valor = $convenio->getVlConvenio();
        $valorDep = $convenio->getVlConvenioDep();
        $dataVenc = $convenio->getDtVencimento();
        $situacao = $convenio->getSituacao();
        $idUsuarioInclusao = $convenio->getIdUsuarioInclusao();

        try{
            return $this->insert(
                  'sfm_convenios',
                  ":NM_Convenio, :NM_Empresa, :VL_Convenio, :VL_Convenio_Dep, :Dia_Vencimento, :ST_Situacao, :ID_Usuario_Inclusao",
                  [
                    ':NM_Convenio'=>$nmConvenio,
                    ':NM_Empresa'=>$empresa,
                    ':VL_Convenio'=>$valor,
                    ':VL_Convenio_Dep'=>$valorDep,
                    ':Dia_Vencimento'=>$dataVenc,
                    ':ST_Situacao'=>$situacao,
                    ':ID_Usuario_Inclusao'=>$idUsuarioInclusao
                  ]
              );
        }
        catch(\Exception $e){
            throw new \Exception("Erro ao gravar os dados",500);
        }
    }//fim function salvar.

    public function verificaConvenio($convenio, $empresa)
    {
        try{
            $query=$this->select(
                "SELECT * FROM sfm_convenios WHERE NM_Convenio ='$convenio' AND NM_Empresa = '$empresa'"
            );
            return $query->fetchAll(\PDO::FETCH_CLASS, ConvenioDAO::class);
        }
        catch(\Exception $e){
            throw new \Exception ("Erro no acesso aos dados!",500);
        }
    }

    public function verificaRelacao($id)
    {
        try{
            $query=$this->select(
                "SELECT * FROM sfm_convenio_pessoa WHERE ID_Convenio ='$id'"
            );
            return $query->fetchAll(\PDO::FETCH_CLASS, ConvenioDAO::class);
        }
        catch(\Exception $e){
            throw new \Exception ("Erro no acesso aos dados!",500);
        }
    }

    public function listarConvenios($busca = '')
    {
        if(isset($busca))
        {
            $query = $this->select(
                "SELECT
                      sfm_convenios.*,
                      sfm_convenios.ID_Convenio,
                      sfm_convenios.NM_Convenio,
                      sfm_convenios.NM_Empresa,
                      sfm_convenios.Dia_Vencimento
                 FROM sfm_convenios
                 WHERE NM_Convenio LIKE '%".$busca."%' ORDER BY NM_Convenio"
            );
            return $query->fetchAll(\PDO::FETCH_CLASS, Convenio::class);
        }
        else
        {
            $query = $this->select(
                "SELECT
                      sfm_convenios.*,
                      sfm_convenios.ID_Convenio,
                      sfm_convenios.NM_Convenio,
                      sfm_convenios.NM_Empresa,
                      sfm_convenios.Dia_Vencimento
                 FROM sfm_convenios
                 ORDER BY ST_Situacao, NM_Convenio"
            );
            return $query->fetchAll(\PDO::FETCH_CLASS, Convenio::class);
        }
    }

    public function listarConveniosAtivos()
    {
        $query = $this->select(
                "SELECT
                      sfm_convenios.*
                 FROM sfm_convenios WHERE sfm_convenios.ST_Situacao = 'Ativo'
                 ORDER BY NM_Convenio"
            );
            return $query->fetchAll(\PDO::FETCH_CLASS, Convenio::class);
    }

    public function excluir(Convenio $registro)
    {
        try{
            $id = $registro->getIdConvenio();
            return $this->delete('sfm_convenios',"ID_Convenio = $id");
        }
        catch(\Exception $e){
            throw new \Exception("Erro ao excluir", 500);
        }
    }

    public function pegarConvenio($id)
    {
        $query = $this->select(
            "SELECT * FROM sfm_convenios WHERE ID_Convenio = '$id'"
        );

        return $query->fetchObject(Convenio::class);
    }

    public function atualizar(Convenio $convenio)
    {
        try{
            $empresa = $convenio->getNmEmpresa();
            $vlConvenio = $convenio->getVlConvenio();
            $valorDep = $convenio->getVlConvenioDep();
            $nmConvenio = $convenio->getNmConvenio();
            $dataVenc = $convenio->getDtVencimento();
            $situacao = $convenio->getSituacao();
            $idConvenio = $convenio->getIdConvenio();
            $idUsuario = $convenio->getIdUsuarioInclusao();
            return $this->update(
                'sfm_convenios',
                "NM_Empresa = :NM_Empresa, VL_Convenio = :VL_Convenio, VL_Convenio_Dep = :VL_Convenio_Dep, NM_Convenio = :NM_Convenio, Dia_Vencimento = :Dia_Vencimento, ST_Situacao = :ST_Situacao, ID_Usuario_Inclusao = :ID_Usuario_Inclusao",
                [
                    ':ID_Convenio'=>$idConvenio,
                    ':NM_Convenio'=>$nmConvenio,
                    ':NM_Empresa'=>$empresa,
                    ':VL_Convenio'=>$vlConvenio,
                    ':VL_Convenio_Dep'=>$valorDep,
                    ':Dia_Vencimento'=>$dataVenc,
                    ':ID_Usuario_Inclusao'=>$idUsuario,
                    ':ST_Situacao'=>$situacao

                ],
                "ID_Convenio = :ID_Convenio"
            );
        }
        catch(\Exception $e)
        {
            throw new \Exception("Erro ao atualizar",500);
        }
    }

    public function verificaAlteracao($nmConvenio, $nmEmpresa, $id)
    {
        try{
            $query = $this->select(
                "SELECT * FROM sfm_convenios WHERE ID_Convenio <> '$id' AND NM_Convenio = '$nmConvenio' AND NM_Empresa = '$nmEmpresa' "
            );
            return $query->fetch();
        }
        catch(Exception $e){
            throw new \Exception("Erro ao carregar Dados",500);
        }
    }
}//fim do programa.
