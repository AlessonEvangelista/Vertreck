<?php

namespace App\Models;

use App\Config\Utils;

class Usuario extends Sql
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create($data)
    {
        $valid = $this->validAction();

        if($valid) {
            if($data['senha']) {
                $data['senha'] = (new Utils())->encrypt($data['senha']);
            }
            $sql = "INSERT INTO usuario (tipo, empresa, cpf, nome, email, telefone, data_nascimento, senha, status) 
                                VALUES(:tipo, :empresa, :cpf, :nome, :email, :telefone, :data_nascimento, :senha, 1)";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data);

            if ($stmt->rowCount() > 0) {
                return true;
            }
        }
        return false;
    }
}