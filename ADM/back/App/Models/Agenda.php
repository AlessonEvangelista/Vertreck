<?php

    namespace App\Models;
    use App\Models\Sql;

    class Agenda extends Sql
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function createLabAgenda($data)
        {
            $valid = $this->validAction();

            if($valid) {
                $sql = "INSERT INTO agenda_servico (empresa, exame, de, ha) 
                                VALUES(:empresa, :exame, :de, :ha)";

                $stmt = $this->conn->prepare($sql);
                $stmt->execute($data);

                $_SESSION['message'] = 'Agenda Cadastrada com sucesso';
                $_SESSION['pagina_back'] = 'LISTA DE LABORATÓRIOS';
                if (!$stmt->rowCount()) {
                    throw new \Exception("Ocorreu algum erro ao cadastrar. teste novamente mais tarde!");
                    $_SESSION['message'] = 'Ocorreu algum erro ao cadastrar. teste novamente mais tarde!';
                }

                return $stmt->rowCount();
            }
            return false;
        }
    }