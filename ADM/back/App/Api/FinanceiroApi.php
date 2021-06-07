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
        list($matricula, $nome, $dataEx) = [$_POST["matricula"], $_POST["nome"], $_POST["data_exame"]];
        try {
            $data = date('Y-m-d H:i:s');
            $sql = "INSERT INTO exame_baixa_agendamento (empresa, data_exame, data_baixa, usuario_nome, matricula, status)
            VALUES({$_SESSION['empresa']}, '{$dataEx}', '{$data}', '{$nome}', '{$matricula}', 1)";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return [1, "Processo iniciado com sucesso. \n Informe os exames realizado!"];

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
                    $insert = "INSERT INTO exame_baixa_agendamento_exames (exame_baixa_agendamento, exame, exame_coleta, exame_exame, pdf_guia, pdf_exame)
                        VALUES({$id['id']}, {$exame['id']}, {$exame['coleta']}, {$exame['exame']}, '{$exame['pdf_guia']}', '{$exame['pdf_exame']}')";
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

    public function listExamesAtivos()
    {
        $sql = "select id, matricula, usuario_nome, data_baixa, valor_total from exame_baixa_agendamento where empresa = {$_SESSION['empresa']} AND status = 2";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function encerrarExames()
    {
        try {
            $select = "SELECT id FROM exame_baixa_agendamento WHERE empresa = {$_SESSION['empresa']} AND status = 1";
            $stmt = $this->conn->prepare($select);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $ids = $stmt->fetchAll(\PDO::FETCH_ASSOC);
                foreach ($ids as $id) {
                    $update = "UPDATE exame_baixa_agendamento SET status = 0 WHERE id = '{$id['id']}'";
                    $this->conn->exec($update);
                }
            }
            return true;
        } catch (\Exception $e){}
    }

    public function enviarPagamentoLoteExames()
    {
        try {
            $sql = "INSERT INTO pagamento_exames (empresa, valor_total, status) VALUES ({$_SESSION['empresa']}, '0.00', 0)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $pagamento = $this->conn->lastInsertId();

            $ex="";
            foreach ($_POST["data"] as $exame) {
                $ist = "INSERT INTO exame_baixa_pagamento (exame_baixa, pagamento_exames) VALUES ({$exame}, {$pagamento})";
                $stmt = $this->conn->prepare($ist);
                $stmt->execute();

                $ex = $ex . $exame .", ";
            }
            $ex = substr($ex, 0, -2);

            $sqlAll = "SELECT sum(valor_total) total FROM exame_baixa_agendamento WHERE id in({$ex}) AND status = 2";
            $stmt = $this->conn->prepare($sqlAll);
            $stmt->execute();
            $val = $stmt->fetch(\PDO::FETCH_ASSOC);

            $updt = "UPDATE pagamento_exames SET valor_total = '{$val['total']}', status = '1' WHERE id = {$pagamento}";
            $this->conn->exec($updt);

            // Conclui os exames
            $updtEx = "UPDATE exame_baixa_agendamento SET status = 3 WHERE id in({$ex})";
            $this->conn->exec($updtEx);

            return [1, $pagamento];
        } catch (\Exception $e){ return [0, $e->getMessage()]; }
    }

    public function lstExameBaixaAll()
    {
        $arrHead = ['#', 'empresa', 'matricula', 'paciente', 'data', 'valor'];
        $arrBody = [];

        $sql = "select eba.id, e.nome_fantasia as empresa, eba.matricula, eba.usuario_nome as paciente, eba.data_baixa, eba.pdf_laudo, eba.pdf_nota_fiscal, eba.valor_total 
                    from exame_baixa_agendamento eba inner join empresa e on eba.empresa = e.id
                    where eba.status = 2";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $dataPacientes = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        foreach ($dataPacientes as $dataPaciente) {
            array_push($arrBody, [$dataPaciente['id'], $dataPaciente['empresa'], $dataPaciente['matricula'], $dataPaciente['paciente'], $dataPaciente['data_baixa'], $dataPaciente['valor_total']]);
        }

        $sql = "select id, exame from exame where status <> 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $exames = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($exames as $exame) {
            array_push($arrHead, $exame['exame']);
        }

        for ($x = 0; $x < count($arrBody); $x++) {
            for ($i = 0; $i < count($exames); $i++) {

                $sql = "select id, exame, exame_coleta, exame_exame from exame_baixa_agendamento_exames where exame_baixa_agendamento = {$arrBody[$x][0]}";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                $examesExames = $stmt->fetchAll(\PDO::FETCH_ASSOC);

                $marcd=0;
                foreach ($examesExames as $examesExame) {
                    if ($examesExame['exame'] === $exames[$i]['id']) {
                        $lblColeta = ($examesExame['exame_coleta']==0 ? "() Coleta" : "(x) Coleta");
                        $lblExame = ($examesExame['exame_exame']==0 ? "() Exame" : "(x) Exame");
                        array_push($arrBody[$x], $lblColeta . "-" . $lblExame);
                        $marcd=1;
                        break;
                    }
                }
                if($marcd === 0) {
                    array_push($arrBody[$x], ".");
                }
            }
        }

        $arrTable = [
            $arrHead,
            $arrBody
        ];

        return $arrTable;

    }

    public function lstEmpresasExamesAtivos()
    {
        $sql = "select ea.empresa id, e.nome_fantasia from exame_baixa_agendamento ea inner join empresa e on ea.empresa = e.id where ea.status = 2 group by ea.empresa";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getDataEmpresasInformesExames($id)
    {
        $sql = "select ea.id, e.nome_fantasia empresa, ea.matricula, ea.usuario_nome, ea.data_baixa, ea.valor_total , ea.pdf_laudo, ea.pdf_nota_fiscal
	            from exame_baixa_agendamento ea inner join empresa e on ea.empresa = e.id where ea.status = 2 AND ea.empresa = {$id}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getDataExamesDetails($id)
    {
        $sql = "select eba.id, e.exame, eba.exame_coleta, eba.exame_exame, eba.pdf_guia, eba.pdf_exame from exame_baixa_agendamento_exames eba inner join exame e on eba.exame = e.id where eba.exame_baixa_agendamento = {$id}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function enviarGuiaPdfPorExame()
    {
        $target_dir = "../././public/uploads/";
        $_SESSION['pagina_back'] = 'BAIXA EM EXAMES';

        try {
            if(!is_dir($target_dir.$_SESSION['empresa'])) {
                mkdir($target_dir.$_SESSION['empresa'], 0777, true);
            }
            $target_dir = $target_dir.$_SESSION['empresa'];
            $return = [];

            $ids = $_POST["exameIds"];
            $expd = explode(",", $ids);
            if( count($expd) > 1 ) {
                $ids = "";
                foreach ($expd as $id) {
                    $ids = $ids ."_". $id;
                }
                $ids = substr($ids, 1);
            }
            $renameFile = $_SESSION['empresa']."-".$ids."-data_".date("d_m_Y_H-i-s")."_".basename( $_FILES['guia']['name'] );

            if(move_uploaded_file( $_FILES["guia"]['tmp_name'], $target_dir ."/". "guia-".$renameFile )) {
                $txtReturnGuia =  "guia-".$renameFile;
            }
            if( isset($_FILES["exame"]) ) {
                $renameFile = $_SESSION['empresa']."-".$ids."-data_".date("d_m_Y_H-i-s")."_".basename( $_FILES['exame']['name'] );
                if(move_uploaded_file( $_FILES["exame"]['tmp_name'], $target_dir ."/". "exame-".$renameFile )) {
                    $txtReturnExame = "exame-".$renameFile;
                }
            }
            $return = [ ( isset($txtReturnGuia) ? $txtReturnGuia : "" ), ( isset($txtReturnExame) ? $txtReturnExame : "" ) ];
            return $return;

        } catch (\Exception $e) {
            return [0, "error"];
        }
    }

    public function getTotalizadores()
    {
        $exames = [];
        $TotalEmpresas = "";
        $TotalUsuarios = "";
        if ( $_SESSION['empresa'] !== "1" ) {
            $selectExames = "select count(id) total, SUM(valor_total) valor from exame_baixa_agendamento WHERE empresa={$_SESSION['empresa']} AND status =2";

            $stmt = $this->conn->prepare($selectExames);
            $stmt->execute();
            $exames = $stmt->fetch(\PDO::FETCH_ASSOC);
        }
        else {
            $selectExames = "select count(id) total, SUM(valor_total) valor from exame_baixa_agendamento WHERE status =2";
            $selectTotalEmpresas = "select count(id) total from empresa where status = 1 and tipo in(1, 2) and id <> 1";
            $selectTotalUsuarios = "select count(id) total from usuario where status = 1 and tipo = 3";

            $stmt = $this->conn->prepare($selectExames);
            $stmt->execute();
            $exames = $stmt->fetch(\PDO::FETCH_ASSOC);

            $stmt = $this->conn->prepare($selectTotalEmpresas);
            $stmt->execute();
            $TotalEmpresas = $stmt->fetch(\PDO::FETCH_ASSOC);

            $stmt = $this->conn->prepare($selectTotalUsuarios);
            $stmt->execute();
            $TotalUsuarios = $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        return [ $exames['total'], $exames['valor'], (isset($TotalEmpresas['total']) ? $TotalEmpresas['total'] : ""), ( isset($TotalUsuarios['total']) ? $TotalUsuarios['total'] : "" ) ];

    }

}