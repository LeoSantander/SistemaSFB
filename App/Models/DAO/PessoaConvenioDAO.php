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


}//fim do programa.
