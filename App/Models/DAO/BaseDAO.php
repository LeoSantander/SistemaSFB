<?php

namespace App\Models\DAO;

use App\Lib\Conexao;

abstract class BaseDAO
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = Conexao::getConnection();
    }

    public function select($sql)
    {
        if(!empty($sql))
        {
            return $this->conexao->query($sql);
        }
    }

    public function selectRel($table, $cols, $where, $ordem,$join=null,$group=null)
    {
        if(!empty($table) && !empty($cols))
        {
            if((isset($join)) OR (isset($group)))
            {
                return $this->conexao->query("SELECT $cols FROM $table $join $where $group ORDER BY $ordem");
            }
            else {
                return $this->conexao->query("SELECT $cols FROM $table $where ORDER BY $ordem");
            }


        }
        else
        {
            return false;
        }
    }

    public function insert($table, $cols, $values)
    {
        if(!empty($table) && !empty($cols) && !empty($values))
        {
            $parametros    = $cols;
            $colunas       = str_replace(":", "", $cols);
            /*
                INSERT INTO usuario (nome,email) VALUES (:nome,:email);
            */
            var_dump($values);
            $stmt = $this->conexao->prepare("INSERT INTO $table ($colunas) VALUES ($parametros)");
            $stmt->execute($values);

            return $stmt->rowCount();
        }else{
            return false;
        }
    }

    public function update($table, $cols, $values, $where=null)
    {
        if(!empty($table) && !empty($cols) && !empty($values))
        {
            if($where)
            {
                $where = " WHERE $where ";
            }

            $stmt = $this->conexao->prepare("UPDATE $table SET $cols $where");
            $stmt->execute($values);

            return $stmt->rowCount();
        }else{
            return false;
        }
    }

    public function delete($table, $where=null)
    {
        if(!empty($table))
        {
            /*
                DELETE usuario WHERE id = 1
            */

            if($where)
            {
                $where = " WHERE $where ";
            }

            $stmt = $this->conexao->prepare("DELETE FROM $table $where");
            $stmt->execute();

            return $stmt->rowCount();
        }else{
            return false;
        }
    }

}
