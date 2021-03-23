<?php

    namespace App\Models;

    class Empresa extends Sql
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function create($data)
        {
            $valid = $this->validAction();

            if($valid) {

                $sql = "SELECT 1 FROM empresa WHERE cnpj='".$data['cnpj']."'";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();

                if($stmt->rowCount() === 0 || $data['cnpj'] === "") {
                    unset($data['estado']);
                    $sql = "INSERT INTO empresa (nome_fantasia, razao_social, cnpj, endereco, bairro, email, telefone, celular, cidade, tipo) 
                                VALUES(:nome_fantasia, :razao_social, :cnpj, :endereco, :bairro, :email, :telefone, :celular, :cidade, :tipo)";

                    $stmt = $this->conn->prepare($sql);
                    $stmt->execute($data);

                    if ($stmt->rowCount() > 0) {
                        return true;
                    }
                }
            }
            return false;
        }

        public function update($data)
        {
            try {
                unset($data['estado']);
                $sql = "UPDATE empresa SET 
                        nome_fantasia = :nome_fantasia, razao_social = :razao_social, cnpj = :cnpj, 
                        endereco = :endereco, bairro = :bairro, tipo = :tipo, cidade = :cidade, 
                        email = :email, telefone = :telefone, celular = :celular 
                    WHERE id = :id";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute($data);

                if ($stmt->rowCount() > 0) {
                    return true;
                }
            } catch (\Exception $e) {
                return false;
            }
        }

        public function getEmpresaById($id)
        {
            $sql = "SELECT id, nome_fantasia FROM empresa WHERE id = ".$id;
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }
    }