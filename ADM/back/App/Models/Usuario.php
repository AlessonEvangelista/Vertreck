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
            $sql = "INSERT INTO usuario (tipo, empresa, cpf, nome, email, telefone, data_nascimento, senha) 
                                VALUES(:tipo, :empresa, :cpf, :nome, :email, :telefone, :data_nascimento, :senha)";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data);

            $_SESSION['message'] = 'Usuário Cadastrado com sucesso';
            if (!$stmt->rowCount()) {
                throw new \Exception("Ocorreu algum erro ao cadastrar. teste novamente mais tarde!");
                $_SESSION['message'] = 'Ocorreu algum erro ao cadastrar. teste novamente mais tarde!';
            }

            return $stmt->rowCount();
        }
        return false;
    }
}