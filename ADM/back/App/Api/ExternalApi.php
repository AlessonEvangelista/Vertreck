<?php

    namespace App\Api;
    use App\Config\Utils;
    use App\Models\Sql;
    use App\Models\Access;

    class ExternalApi extends Sql
    {
        public function __construct()
        {
            parent::__construct();
            header("content-type:application/json");
        }

        public function cadastroUsuario()
        {
            $data = $this->validCreateField($_POST);
            $retorno = [ "status" => "erro",  "data" => 'Erro ao cadastro'];

            $sql = "INSERT INTO usuario (nome, email, senha, cpf, ".(isset($data['telefone']) ? "telefone," : "" )." ". (isset($data['data_nascimento']) ? "data_nascimento," : "" ) ." empresa, tipo) 
                        VALUES (:nome, :email, :senha, :cpf, ".(isset($data['telefone']) ? ":telefone," : "" )." ". (isset($data['data_nascimento']) ? ":data_nascimento," : "" ) ." :empresa, :tipo)";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data);

            if($stmt->rowCount()){
                $id = $this->conn->lastInsertId();
                $retorno = [ "status" => "sucesso", "data" => ["id" => $id, "nome" => $data['nome'], "email" => $data['email']]];
            }

            return json_encode($retorno);
        }

        public function loginUsuario()
        {
            $retorno = [ "status" => "erro",  "data" => 'Erro ao realizar login'];
            if( isset($_POST['email']) && $_POST['email'] != "" ) {
                $data = [
                    "email" => $_POST['email'],
                    "senha" => (new Utils())->encrypt($_POST['senha'])
                ];
            }
            if( isset($_POST['cpf']) && $_POST['cpf'] != "" ) {
                $data = [
                    "cpf" => $_POST['cpf'],
                    "senha" => (new Utils())->encrypt($_POST['senha'])
                ];
            }

            if(isset($data)) {
                $sqlWhere="";
                foreach (array_keys($data) as $item) {
                    $sqlWhere = $sqlWhere . "$item = :$item AND ";
                }
                $sqlWhere = substr($sqlWhere, 0, -5);

                $sql = "SELECT id, nome, email
                    FROM usuario WHERE $sqlWhere";

                $stmt = $this->conn->prepare($sql);
                $stmt->execute($data);

                if($stmt->rowCount() > 0) {
                    $login = $stmt->fetch(\PDO::FETCH_ASSOC);
                    $retorno = ["status" => "sucesso", "data" => ["id" => $login['id'], "nome" => $login['nome'], "email" => $login['email']]];
                }
            }

            return json_encode($retorno);
        }

        public function fastLoginUsuario()
        {
            $retorno = [ "status" => "erro",  "data" => 'Erro ao realizar login'];
            $sql = "select id, nome, email from usuario
                            WHERE cpf = '".$_POST["cpf"]."'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            if($stmt->rowCount() > 0)
            {
                $login = $stmt->fetch(\PDO::FETCH_ASSOC);
                $retorno = ["status" => "sucesso", "data" => ["id" => $login['id'], "nome" => $login['nome'], "email" => $login['email']]];
            }

            return json_encode($retorno);
        }

        private function validCreateField($data)
        {
            if(isset($data['telefone']) || $data['telefone'] === "") { unset($data['telefone']); }
            if(isset($data['data_nascimento']) || $data['data_nascimento'] === "") { unset($data['data_nascimento']); }

            $data['senha'] = (new Utils())->encrypt($data['senha']);
            $data['empresa'] = null;
            $data['tipo'] = '3';

            return $data;
        }

        public function appGetEstadoCombo()
        {
            $sql = "select estd.id, estd.nome from estados estd 
                            inner join cidades c on c.estado = estd.id
                            right join empresa e on e.cidade = c.id
                            group by estd.id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function appGetCidade($id = null)
        {
            $sql = "select c.id, c.nome from cidades c inner join empresa e on e.cidade = c.id Where c.estado = :id group by c.id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function appGetExame($id =null)
        {
            $sql = "select e.id, e.exame from exame e inner join servico s on e.servico = s.id Where s.id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function appGetEmpresaByExame($data = null)
        {
            $dados = explode(",", $data);
            $sql = "select emp.id, emp.nome_fantasia as nome, emp.email, emp.endereco, emp.bairro, emp.telefone, emp.celular from empresa emp 
                        inner join exame_empresa exe on emp.id = exe.empresa
                        where exe.exame = :exame  and emp.cidade = :cidade group by emp.id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':exame', $dados[0]);
            $stmt->bindValue(':cidade', $dados[1]);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function appGetLaboratorioByCidadeAndServico($data)
        {
            $params = explode(",", $data);
            $sql = "select e.id, e.nome_fantasia as nome, e.endereco, e.bairro, e.telefone, e.celular from empresa e
                    inner join exame_empresa exe on exe.empresa = e.id
                    inner join exame ex on exe.exame = ex.id
                    inner join servico s on ex.servico = s.id
                        where s.id = :servico AND e.cidade = :cidade
                    group by e.id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':servico', $params[0]);
            $stmt->bindValue(':cidade', $params[1]);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function appGetLaboratorioDescById($id =null)
        {
            $sql = "select e.id, e.nome_fantasia as nome, e.endereco, e.bairro, e.telefone, e.celular from empresa e
                        where e.id = :id
                    group by e.id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        public function appGetServicoByCidade($cidade = null)
        {
            $sql = "select 
                        s.id, s.nome from servico s 
                            inner join exame ex on ex.servico = s.id
                            left join exame_empresa eemp on eemp.exame = ex.id
                            inner join empresa e on eemp.empresa = e.id
                        WHERE 
                            e.cidade = :cidade group by s.id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':cidade', $cidade);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function appGetExameByLaboratorio($emp)
        {
            $sql = "select ex.id, ex.exame from exame ex inner join exame_empresa exe on exe.exame = ex.id where exe.empresa = :empresa";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':empresa', $emp);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function appUserAgendamento()
        {

            $data = $_POST;
            $usuario_agenda = [
                "usuario" => $data['usuario'],
                "empresa" => $data['empresa']
            ];
            if($data['medicamento']) {
                $usuario_agenda = [
                    "usuario" => $data['usuario'],
                    "empresa" => $data['empresa'],
                    "medicamento" => $data['medicamento']
                ];
            }
            $retorno = [ "status" => "erro",  "data" => 'Não foi possível o agendamento, por aqui! Por favor, ligue para consulta.'];

            $sql = "INSERT INTO usuario_agenda (usuario, empresa ".($data['medicamento'] ? ", medicamento" : '')." )
                        VALUES (:usuario, :empresa ".($data['medicamento'] ? ", :medicamento" : '')." )";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($usuario_agenda);

            if($stmt->rowCount()){
                $id = $this->conn->lastInsertId();

                if($data['exames']) {
                    foreach ($data['exames'] as $exame) {
                        $agenda_exame = [
                            'usuario_agenda' => $id,
                            'exame' => $exame
                        ];

                        $sql = "INSERT INTO usuario_agenda_exame (usuario_agenda, exame) VALUES (:usuario_agenda, :exame)";
                        $stmt = $this->conn->prepare($sql);
                        $stmt->execute($agenda_exame);
                    }
                }
                $empresa = $this->getEmpresaTelefones($data['empresa']);
                $retorno = [ "status" => "sucesso",  "data" => "Agenda solicitada! Ligue no Tel: " . $empresa['telefone'] . " ou Cel: " . $empresa['celular'] . "! para confirmar data e horário."];
            }

            return json_encode($retorno);

        }

        private function getEmpresaTelefones($id)
        {
            $sql = "select telefone, celular from empresa where id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

    }