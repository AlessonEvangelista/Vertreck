<?php

    namespace App\Api;
    use App\Models\Sql;

    class ComboApi extends Sql
    {
        public function __construct()
        {
            parent::__construct();
            header("content-type:application/json");
        }

        public function getEmpresaTipo()
        {
            $sql = "SELECT * FROM empresa_tipo";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getUsuarioTipo()
        {
            $sql = "SELECT * FROM usuario_tipo where id <> 1 AND id <> 3";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getEstado()
        {
            $sql = "SELECT * FROM estados";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getCidade($id = null)
        {
            $sql = "SELECT * FROM cidades where estado = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getUsuarioAppList()
        {
            $sql = "SELECT id, nome, email, cpf, telefone FROM usuario WHERE tipo = 3 AND status = 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getEmpresaList($status)
        {
            $sql = "SELECT e.id, et.tipo, e.nome_fantasia, e.email, e.telefone, e.celular, c.nome as cidade FROM empresa e left join cidades c on e.cidade = c.id inner join empresa_tipo et on e.tipo = et.id WHERE e.id > 1 AND e.status = {$status} order by e.id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getAllEmpresaList()
        {
            $sql = "SELECT id, nome_fantasia, endereco FROM empresa WHERE status = 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getEmpresaCombo($tipo)
        {
            $tp = ( ($tipo == 4) ? "id = 1" : "id > 1 AND status = 1" );
            $sql = "SELECT id, nome_fantasia FROM empresa WHERE ".$tp;
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getUsuarioList()
        {
            $sql = "select u.id, tu.tipo, u.nome, u.email, e.nome_fantasia as empresa, u.telefone 
                        from usuario u inner join usuario_tipo tu on u.tipo = tu.id inner join empresa e on u.empresa = e.id
                        WHERE u.status=1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getServico()
        {
            $sql = "SELECT * FROM servico";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getServicoExameList()
        {
            $sql = "select id, nome from servico WHERE status = 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getExameServicoList($id = null)
        {
            $sql = "select id, exame, preco_coleta, preco_exame from exame where servico = {$id} AND status = 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getExameCombo()
        {
            $data = $_POST['empresa'];

            $sql = "select ex.id, ex.exame from exame ex inner join servico s on ex.servico = s.id inner join empresa emp on s.empresa = emp.id WHERE emp.id = $data";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getExameList()
        {
            $sql = "select id, exame from exame";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getAgendaList()
        {
            $data = $_POST;

            $where = "ag.id";
            $where = $where . ($data['empresa'] ? " AND ag.empresa = ". $data['empresa'] : "");
            $where = $where . ($data['exame'] ? " AND ag.exame = ". $data['exame'] : "");

            $sql = "select ag.id, e.nome_fantasia as empresa, ex.exame, ag.de as dt_inicio, ag.ha as dt_fim
                    from agenda_servico ag inner join empresa e on ag.empresa = e.id left join exame ex on ag.exame = ex.id
                    where $where";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getEmpresaIntoExame()
        {
            $sql = "SELECT e.id, e.nome_fantasia FROM empresa e INNER JOIN servico s on e.id = s.empresa INNER JOIN exame ex on s.id = ex.servico
	                WHERE ex.id = ".$_POST['exame'];
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        public function getExamesToEmpresaList()
        {
            $empresa = $_POST['empresa'];
            $sql = "select ee.id, ex.exame from exame_empresa ee inner join exame ex on ee.exame = ex.id where ee.empresa = $empresa";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getEmpresaById( $id = null )
        {
            $sql = "select e.id, e.nome_fantasia, e.razao_social, e.cnpj, e.email, e.endereco, e.bairro, e.descricao_agenda,
                            e.telefone, e.celular, etd.nome as estado, c.nome as cidade, t.tipo, t.id as tipoId, c.id as cidadeId, etd.id as estadoId 
                        from empresa e 
                            left join cidades c on e.cidade = c.id 
                            left join estados etd on c.estado = etd.id
                            left join empresa_tipo t on e.tipo = t.id
                            where e.id = $id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        public function getEmpresaWithExame()
        {

        }

        public function getAllExamePreco()
        {
            $emp = ($_POST['empresa'] ? $_POST['empresa'] : $_SESSION['empresa']);
            $sql = "SELECT s.id idServico,
                        IF((select id from exame_empresa ee where ee.empresa = {$emp} and ee.exame = e.id),
                            (select id from exame_empresa ee where ee.empresa = {$emp} and ee.exame = e.id), null) as exameEmpresa,
                        IF((select 1 from exame_empresa ee where ee.empresa = {$emp} and ee.exame = e.id and ee.preco_coleta <> 0.00),
                            (select preco_coleta from exame_empresa ee where ee.empresa = {$emp} and ee.exame = e.id), 0.00) as precoColetaHabilitado,
                        IF((select 1 from exame_empresa ee where ee.empresa = {$emp} and ee.exame = e.id and ee.preco_exame <> 0.00),
                            (select preco_exame from exame_empresa ee where ee.empresa = {$emp} and ee.exame = e.id), 0.00) as precoEntregaHabilitado,
                        e.id idExame, s.nome servico, e.exame, e.preco_coleta, e.preco_exame
                        FROM exame e INNER JOIN servico s on e.servico = s.id WHERE e.status = 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getAllExameVinculadoEmpresa()
        {
            $emp = $_SESSION['empresa'];
            $sql = "SELECT e.id, e.servico, e.exame, e.preco_coleta, if( ee.preco_exame, ee.preco_exame, e.preco_exame )  as preco_exame, e.status FROM exame e INNER JOIN exame_empresa ee on ee.exame = e.id 
                        WHERE ee.empresa = {$emp} and e.status <> 0";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function setEmpresaExamePreco()
        {
            $tipo = $_POST['tipo'];
            $exame = $_POST['exame'];
            $preco = $_POST['preco'];
            $empresa = ($_POST['empresa'] ? $_POST['empresa'] : $_SESSION['empresa']);

            try {
                $sql = "SELECT id FROM exame_empresa WHERE exame=" . $exame . " AND empresa=" . $empresa;
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                if ($stmt->rowCount() === 0) {
                    if ($tipo == 1) {
                        $sql = "INSERT INTO exame_empresa (exame, empresa, preco_coleta) VALUES({$exame}, {$empresa}, '{$preco}')";
                    } else {
                        $sql = "INSERT INTO exame_empresa (exame, empresa, preco_exame) VALUES({$exame}, {$empresa}, '{$preco}')";
                    }
                    $stmt = $this->conn->prepare($sql);
                    $stmt->execute();

                } else {
                    $id = $stmt->fetch(\PDO::FETCH_ASSOC);
                    if ($tipo == 1) {
                        $sql = "UPDATE exame_empresa SET preco_coleta = '{$preco}' WHERE id = '{$id['id']}'";
                    } else {
                        $sql = "UPDATE exame_empresa SET preco_exame = '{$preco}' WHERE id = '{$id['id']}'";
                    }
                    $this->conn->exec($sql);
                }
                return true;
            } catch(\Exception $e) {
                return false;
            }
        }

        public function disEmpresaExamePreco($exame)
        {
            $tipo = $_POST['tipo'];
            $exame = $_POST['exame'];
            $empresa = ($_POST['empresa'] ? $_POST['empresa'] : $_SESSION['empresa']);

            try {
                $sql = "SELECT id, preco_coleta, preco_exame FROM exame_empresa WHERE exame=" . $exame . " AND empresa=" . $empresa;
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                $query = $stmt->fetch(\PDO::FETCH_ASSOC);

                if ($tipo == 1) {
                    if($query['preco_exame'] != '0.00') {
                        $sql = "UPDATE exame_empresa SET preco_coleta = '0.00' WHERE id = '{$query['id']}'";
                    } else {
                        $sql = "DELETE FROM exame_empresa WHERE id ={$query['id']}";
                    }
                } else {
                    if($query['preco_coleta'] != '0.00') {
                        $sql = "UPDATE exame_empresa SET preco_exame = '0.00' WHERE id = '{$query['id']}'";
                    } else {
                        $sql = "DELETE FROM exame_empresa WHERE id ={$query['id']}";
                    }
                }
                $this->conn->exec($sql);
                return true;

            } catch (\Exception $e) {
                return false;
            }
        }

        public function ativarEmpresa($id)
        {
            try {
                $sql = "UPDATE empresa SET status = '1' WHERE id = '{$id}'";
                $this->conn->exec($sql);

                return json_encode(["status" => "success", "data" => "Registro Ativo com sucesso"]);
            } catch (\Exception $e)
            {
                return json_encode(["status" => "error", "data" => $e->getMessage()]);
            }
        }

        public function deleteEmpresa( $id = null )
        {
            try {
                $sql = "UPDATE empresa SET status = '0' WHERE id = '{$id}'";
                $this->conn->exec($sql);

                return json_encode(["status" => "success", "data" => "Registro excluido com sucesso"]);
            } catch (\Exception $e)
            {
                return json_encode(["status" => "error", "data" => $e->getMessage()]);
            }
        }

        public function deleteVinculoEmpresaExame( $id = null )
        {
            try {
                $sql = "DELETE FROM exame_empresa WHERE id=$id";
                $this->conn->exec($sql);

                return json_encode(["status" => "success", "data" => "Vinculo removido com sucesso"]);
            } catch (\Exception $e)
            {
                return json_encode(["status" => "error", "data" => $e->getMessage()]);
            }
        }

        public function deletarServico($id)
        {
            try {
                $sql = "SELECT id FROM exame WHERE servico = {$id} AND status = 1";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                if($stmt->rowCount() > 0) {
                    return "Não é possível excluir serviços com exames vinculados";
                } else {
                    $sql = "UPDATE servico SET status = '0' WHERE id = '{$id}'";
                    $this->conn->exec($sql);

                    return "Excluído registro com sucesso";
                }
            } catch (\Exception $e)
            {
                return $e->getMessage();
            }
        }

        public function deletarExame($id)
        {
            try {
                $sql = "UPDATE exame SET status = '0' WHERE id = '{$id}'";
                $this->conn->exec($sql);

                return "Excluído registro com sucesso";
            } catch (\Exception $e)
            {
                return $e->getMessage();
            }
        }
    }