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
            $sql = "SELECT * FROM usuario_tipo where tipo !='Administrador'";
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

        public function getEmpresaList()
        {
            $sql = "SELECT e.id, et.tipo, e.nome_fantasia, e.email, e.telefone, e.celular, c.nome as cidade FROM empresa e inner join cidades c on e.cidade = c.id inner join empresa_tipo et on e.tipo = et.id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getAllEmpresaList()
        {
            $sql = "SELECT id, nome_fantasia, endereco FROM empresa";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getEmpresaCombo()
        {
            $sql = "SELECT id, nome_fantasia FROM empresa";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getUsuarioList()
        {
            $sql = "select u.id, tu.tipo, u.nome, u.email, e.nome_fantasia as empresa, u.telefone from usuario u inner join 	usuario_tipo tu on u.tipo = tu.id inner join empresa e on u.empresa = e.id";
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
            $sql = "select id, nome from servico";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function getExameServicoList($id = null)
        {
            $sql = "select id, exame, preco_unit, preco_parc from exame where servico = $id";
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
                            inner join cidades c on e.cidade = c.id 
                            inner join estados etd on c.estado = etd.id
                            inner join empresa_tipo t on e.tipo = t.id
                            where e.id = $id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        public function deleteEmpresa( $id = null )
        {
            try {
                $sql = "DELETE FROM empresa WHERE id=$id";
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

    }