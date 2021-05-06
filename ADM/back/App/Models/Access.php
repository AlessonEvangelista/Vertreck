<?php

    namespace App\Models;
    use App\Config\Utils;

    class Access extends Sql
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function login($email, $passwd)
        {
            $pass_hash = (new Utils())->encrypt($passwd);

            $sql = "SELECT 
                        u.id, u.nome, u.email, u.telefone, u.data_nascimento,e.id empresa, e.tipo empresa_tipo, e.nome_fantasia, t.id as tipo
                    FROM usuario u inner join empresa e on u.empresa = e.id inner join usuario_tipo t on u.tipo = t.id 
                    WHERE u.email = :email AND u.senha = :pwd AND u.tipo <> 3 AND u.status = 1";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':pwd', $pass_hash);
            $stmt->execute();

            if($stmt->rowCount() > 0)
                return $stmt->fetch(\PDO::FETCH_ASSOC);
            else
                return false;
        }

        public function fastLogin($cpf)
        {
            $sql = "select id, nome, email from usuario
                            WHERE cpf = :cpf AND status=1";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':cpf', $cpf);
            $stmt->execute();


            if($stmt->rowCount() > 0)
                return $stmt->fetch(\PDO::FETCH_ASSOC);
            else
                return false;
        }

        public function createUsuario($data)
        {
            $sql = "INSERT INTO usuario (nome, email, cpf, telefone, data_nascimento, empresa, tipo, status) 
                        VALUES (:nome, :email, :cpf, :telefone, :data_nascimento, :empresa, :tipo, 1)";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data);

            if($stmt->rowCount()){
                return $this->conn->lastInsertId();
            } else {
                return false;
            }
        }

        public function updateUsuario($data)
        {
            $sql = "UPDATE usuario SET nome='{$data['nome']}', email='{$data['email']}', telefone='{$data['telefone']}', data_nascimento='{$data['data_nascimento']}', genero={$data['genero']}, estado={$data['estado']}, cidade={$data['cidade']} WHERE id={$_SESSION['id']}";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data);

            if($stmt->rowCount() > 0) {
                return true;
            }
            return false;
        }
    }