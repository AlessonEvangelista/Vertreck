<?php

namespace App\Api;
use App\Models\Sql;

class FinanceiroApi extends Sql
{
    public function __construct()
    {
        parent::__construct();
        header("content-type:application/json");
    }

    public function iniciarProcessoBaixaUsuario()
    {
        list($matricula, $nome) = [$_POST["matricula"], $_POST["nome"]];
        try {
            $data = date('Y-m-d H:i:s');
            $sql = "INSERT INTO exame_baixa_agendamento (empresa, data_baixa, usuario_nome, matricula, status)
            VALUES({$_SESSION['empresa']}, '{$data}', '{$nome}', $matricula, 1)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return [1, "Iniciado processo com sucesso. \n continue o processo!"];

        } catch (\Exception $e) {
            return [0, "Ocorreu algum erro ao Iniciar o processo. \n\n {$e->getMessage()} "];
        }
    }

    public function informarExamesBaixaUsuario()
    {
        try {
            $select = "SELECT id FROM exame_baixa_agendamento WHERE empresa = {$_SESSION['empresa']} AND status = 1 ORDER BY id DESC LIMIT 1";
            $stmt = $this->conn->prepare($select);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $id = $stmt->fetch(\PDO::FETCH_ASSOC);

                foreach ($_POST['exames'] as $exame) {
                    $insert = "INSERT INTO exame_baixa_agendamento_exames (exame_baixa_agendamento, exame, exame_coleta, exame_exame)
                        VALUES({$id['id']}, {$exame['id']}, {$exame['coleta']}, {$exame['exame']})";
                    $stmt = $this->conn->prepare($insert);
                    $stmt->execute();
                }
                $update = "UPDATE exame_baixa_agendamento SET valor_total = '{$_POST['total']}' WHERE id = '{$id['id']}'";
                $this->conn->exec($update);
            }
            else {
                throw new \Exception("Não foi encontrado exames iniciados no processo de baixa!");
            }
            return [1, "Exames informados com sucesso. \n\n Só mais um passo para finalizar o processo!"];
        } catch (\Exception $e) {
            return [0, "Ocorreu um erro ao informar exames. \n\n {$e->getMessage()}"];
        }
    }
}