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

            $sql = "INSERT INTO servico (nome) VALUES(:nome)";

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

            $sql = "INSERT INTO exame (servico, exame, preco_unit, preco_parc) VALUES(:servico, :exame, :preco_unit, :preco_parc)";

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
                        $sql = "INSERT INTO exame_empresa (exame, empresa) VALUES($item, " . $data['empresa'] . ")";

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