<?php

    namespace App\Models;

    use App\Config\Utils;

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

                $sql = "SELECT 1 FROM empresa WHERE cnpj='".$data['cnpj']."' AND status <> '0'";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();

                if($stmt->rowCount() === 0 || $data['cnpj'] === "") {
                    unset($data['estado']);
                    $sql = "INSERT INTO empresa (nome_fantasia, razao_social, cnpj, endereco, bairro, email, telefone, celular, cidade, tipo, descricao_agenda, status) 
                                VALUES(:nome_fantasia, :razao_social, :cnpj, :endereco, :bairro, :email, :telefone, :celular, :cidade, :tipo, :descricao_agenda, 1)";

                    $stmt = $this->conn->prepare($sql);
                    $stmt->execute($data);

                    if ($stmt->rowCount() > 0) {
                        return true;
                    }
                }
            }
            return false;
        }

        public function autoCreate($data)
        {
            try {
                $sql = "SELECT id FROM empresa WHERE cnpj='{$data['cnpj']}' AND status <> '0'";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();

                if ($stmt->rowCount() === 0) {
                    $sql = "INSERT INTO empresa (nome_fantasia, razao_social, cnpj, endereco, bairro, email, telefone, celular, cidade, tipo, status) 
                                VALUES('{$data['nome_fantasia']}', '{$data['razao_social']}', '{$data['cnpj']}', '{$data['endereco']}', '{$data['bairro']}', '{$data['emailInstitucional']}', '{$data['telefone']}', '{$data['celular']}', {$data['cidade']}, 1, 1)";
                    $stmt = $this->conn->prepare($sql);
                    $stmt->execute($data);

                    if ($stmt->rowCount() > 0) {
                        $empId = $this->conn->lastInsertId();

                        $sql = "SELECT id FROM usuario WHERE cpf='{$data['cpf']}' AND status <> '0'";
                        $stmt = $this->conn->prepare($sql);
                        $stmt->execute();

                        if ($stmt->rowCount() === 0) {
                            $pass_hash = (new Utils())->encrypt($data['password']);
                            $sql = "INSERT INTO usuario (nome, email, cpf, senha, empresa, tipo, status) 
                                    VALUES ('{$data['nome_fantasia']}', '{$data['emailUsuario']}', '{$data['cpf']}', '{$pass_hash}', {$empId}, 2, 1)";

                            $stmt = $this->conn->prepare($sql);
                            $stmt->execute($data);
                        }
                        else {
                            $user = $stmt->fetch(\PDO::FETCH_ASSOC);
                            $sql = "UPDATE usuario SET empresa={$empId} WHERE id={$user['id']}";
                            $stmt = $this->conn->prepare($sql);
                            $stmt->execute($data);

                        }

                        return true;
                    }
                }
            } catch(\Exception $e) {
                return false;
            }
        }

        public function update($data)
        {
            try {
                unset($data['estado']);
                $sql = "UPDATE empresa SET 
                        nome_fantasia = :nome_fantasia, razao_social = :razao_social, cnpj = :cnpj, 
                        endereco = :endereco, bairro = :bairro, tipo = :tipo, cidade = :cidade, 
                        email = :email, telefone = :telefone, celular = :celular, descricao_agenda = :descricao_agenda 
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