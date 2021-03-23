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
                        u.id, u.nome, u.email, u.telefone, u.data_nascimento, e.nome_fantasia, t.tipo 
                    FROM usuario u inner join empresa e on u.empresa = e.id inner join usuario_tipo t on u.tipo = t.id 
                    WHERE u.email = :email AND u.senha = :pwd";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':pwd', $pass_hash);
            $stmt->execute();


            if($stmt->rowCount() > 0)
                return $stmt->fetch(\PDO::FETCH_ASSOC);
            else
                return false;
        }

        public function loginUsuario($data)
        {
            $data['senha'] = (new Utils())->encrypt($data['senha']);

            $sqlWhere="";
            foreach (array_keys($data) as $item) {
                $sqlWhere = $sqlWhere . "$item = :$item AND ";
            }
            $sqlWhere = substr($sqlWhere, 0, -5);


            $sql = "SELECT id, nome, email
                    FROM usuario WHERE $sqlWhere";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data);

            if($stmt->rowCount() > 0)
                return $stmt->fetch(\PDO::FETCH_ASSOC);
            else
                return false;
        }
    }