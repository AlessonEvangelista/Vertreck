<?php

namespace App\Models;

class Exames extends Sql
{

    public function __construct()
    {
        parent::__construct();
    }

    public function createServico($data)
    {
        $valid = $this->validAction();

        if($valid) {

            $sql = "INSERT INTO servico (nome, status) VALUES(:nome, 1)";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data);

            if ($stmt->rowCount() > 0) {
                return true;
            }
        }
        return false;
    }

    public function createExame($data)
    {
        $valid = $this->validAction();

        if($valid) {

            $sql = "INSERT INTO exame (servico, exame, preco_coleta, preco_entrega, preco_petrobras, status) VALUES(:servico, :exame, :preco_coleta, :preco_entrega, :preco_petrobras, 1)";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data);

            if ($stmt->rowCount() > 0) {
                return true;
            }
        }
        return false;
    }

    public function setEmpresa($data)
    {
        $valid = $this->validAction();

        if ($valid) {
            try {
                foreach ($data['exame'] as $key => $item) {
                    $sql = "SELECT 1 FROM exame_empresa WHERE exame=".$item." AND empresa=".$data['empresa'];
                    $stmt = $this->conn->prepare($sql);
                    $stmt->execute();
                    if($stmt->rowCount() === 0) {
                        $sql = "SELECT preco_coleta, preco_entrega FROM exame WHERE id={$item}";
                        $stmt = $this->conn->prepare($sql);
                        $stmt->execute();
                        $query = $stmt->fetch(\PDO::FETCH_ASSOC);
                        $sql = "INSERT INTO exame_empresa (exame, empresa, preco_coleta, preco_entrega) VALUES({$item}, '{$data['empresa']}', '{$query['preco_coleta']}', '{$query['preco_entrega']}')";

                        $stmt = $this->conn->prepare($sql);
                        $stmt->execute();
                    }
                }

                return true;
            } catch (\Exception $e) {
                return false;
            }
        }
        return false;
    }
}