<?php

    namespace App\Models;

    class Financeiro extends Sql
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function saveUploadFile($data)
        {
            try {
                $select = "SELECT id FROM exame_baixa_agendamento WHERE empresa = {$_SESSION['empresa']} AND status = 1 ORDER BY id DESC LIMIT 1";
                $stmt = $this->conn->prepare($select);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    $id = $stmt->fetch(\PDO::FETCH_ASSOC);

                    if($data['tipo'] === 1) {
                        $update = "UPDATE exame_baixa_agendamento SET pdf_laudo = '{$data['name']}' WHERE id = '{$id['id']}'";
                    } else {
                        $update = "UPDATE exame_baixa_agendamento SET pdf_nota_fiscal = '{$data['name']}' WHERE id = '{$id['id']}'";
                    }
                    $this->conn->exec($update);
                }
            } catch (\Exception $e) {}
        }

        public function concluirBaixa()
        {
            try {
                $select = "SELECT id FROM exame_baixa_agendamento WHERE empresa = {$_SESSION['empresa']} AND status = 1 ORDER BY id DESC LIMIT 1";
                $stmt = $this->conn->prepare($select);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    $id = $stmt->fetch(\PDO::FETCH_ASSOC);
                    $update = "UPDATE exame_baixa_agendamento SET status = 2 WHERE id = '{$id['id']}'";
                }
                $this->conn->exec($update);
            } catch (\Exception $e){}
        }

        public function examePendente()
        {
            try {
                $select = "SELECT id FROM exame_baixa_agendamento WHERE empresa = {$_SESSION['empresa']} AND status = 1 ORDER BY id DESC LIMIT 1";
                $stmt = $this->conn->prepare($select);
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    $id = $stmt->fetch(\PDO::FETCH_ASSOC);
                    $update = "UPDATE exame_baixa_agendamento SET status = 4 WHERE id = '{$id['id']}'";
                }
                $this->conn->exec($update);
            } catch (\Exception $e){}
        }

        public function exameDeletar($id)
        {
            try {
                $delete = "DELETE FROM exame_baixa_agendamento WHERE id = '{$id}'";
                $this->conn->exec($delete);
            } catch (\Exception $e){}
        }
    }