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
}//fim do programa.
