<?php

namespace App\Models\DAO;

use App\Models\Entidades\Escritorio;

class ConvenioDAO extends BaseDAO
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
            throw new \Exception("Erro ao gravar os dados",500);
        }
    }
