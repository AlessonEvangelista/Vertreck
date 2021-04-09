<?php

    namespace App\Api;
    use App\Config\Utils;
    use App\Email\Mail;
    use App\Models\Sql;

    class ExternalApi extends Sql
    {
        public function __construct()
        {
            parent::__construct();
            header("content-type:application/json");
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

        public function appGetEstadoCombo()
        {
            $sql = "select estd.id, estd.nome from estados estd 
                            inner join cidades c on c.estado = estd.id
                            inner join empresa e on e.cidade = c.id
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

        public function appGetAllExame($id)
        {
            $sql = "select e.id, e.exame, s.nome as servico from exame e inner join servico s on e.servico = s.id where s.id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }

        public function appGetEmpresaByExame($data)
        {
            $dt     = explode("-", $data);
            $cidade = $dt[1];

            $sql = "select emp.id, emp.nome_fantasia as nome, emp.email, emp.endereco, emp.bairro, emp.telefone, emp.celular, emp.descricao_agenda from empresa emp 
                        inner join exame_empresa exe on emp.id = exe.empresa
                        where exe.exame IN ({$dt[0]})  and emp.cidade = {$cidade} group by emp.id";
            $stmt = $this->conn->prepare($sql);
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

        public function appGetServicoByCidade($cidade)
        {
            $cidadesPermitidas = [1994, 1990, 1790, 1825, 1756, 1762, 1871, 1965, 1974, 6666, 6681, 6691, 6699, 6768, 6780, 6811, 6860, 6939, 9422, 9390, 8799, 9379];
            if(in_array($cidade, $cidadesPermitidas)) {
                $sql = "select 
                        s.id, s.nome from servico s 
                            inner join exame ex on ex.servico = s.id
                            left join exame_empresa eemp on eemp.exame = ex.id
                            inner join empresa e on eemp.empresa = e.id
                        WHERE 
                            e.cidade = :cidade group by s.id";
            } else {
                $sql = "select s.id, s.nome from servico s where s.id= 11";
            }

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
            $usLogin = ($_SESSION['id'] ? $_SESSION['id'] : $data['usuario']);
            $usuario_agenda = [
                "usuario" => $usLogin,
                "empresa" => $data['empresa'],
                "dia" => $data['dia'],
                "hora" => $data['hora']
            ];
            if($data['medicamento']) {
                $usuario_agenda = [
                    "usuario" => $usLogin,
                    "empresa" => $data['empresa'],
                    "dia" => $data['dia'],
                    "hora" => $data['hora'],
                    "medicamento" => $data['medicamento']
                ];
            }
            $retorno = [ "status" => "erro",  "data" => 'Não foi possível o agendamento, por aqui! Por favor, ligue para consulta.'];

            $sql = "INSERT INTO usuario_agenda (usuario, empresa, dia, hora ".($data['medicamento'] ? ", medicamento" : '')." )
                        VALUES (:usuario, :empresa, :dia, :hora ".($data['medicamento'] ? ", :medicamento" : '')." )";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($usuario_agenda);

            if($stmt->rowCount()){
                $id = $this->conn->lastInsertId();

                if($data['exames']) {
                    $exames = explode(",", $data['exames']);
                    foreach ($exames as $exame) {
                        $agenda_exame = [
                            'usuario_agenda' => $id,
                            'exame' => $exame
                        ];

                        $sql = "INSERT INTO usuario_agenda_exame (usuario_agenda, exame) VALUES (:usuario_agenda, :exame)";
                        $stmt = $this->conn->prepare($sql);
                        $stmt->execute($agenda_exame);
                    }
                }
                $empresa = $this->getEmpresaDados($data['empresa']);
                $usuario = $this->getUsuarioDados($usLogin);
                $exame = $this->getExameDados($data['exames']);

                $mail = new Mail();
                $mail->setRemetente([ EMAIL_VERTRECK_DESTINATARIO, EMAIL_VERTRECK_DESTINATARIO_NAME ], [ $usuario['email'], $usuario['nome'] ]);
                $dadosEmail = [
                    "usuario" => [
                        "nome" => $usuario['nome'],
                        "cpf" => $usuario['cpf'],
                        "nascimento" => $usuario['data_nascimento'],
                        "telefone" => $usuario['telefone'],
                        "email" => $usuario['email']
                    ],
                    "empresa" => [
                        "nome_fantasia" => $empresa["nome_fantasia"],
                        "endereco" => $empresa['endereco'],
                        "bairro" => $empresa['bairro'],
                        "telefone" => $empresa['telefone'],
                        "celular" => $empresa['celular']
                    ],
                    "data" => [
                        "dia" => $usuario_agenda['dia'],
                        "hora" => $usuario_agenda['hora']
                    ],
                    "exame" => $exame
                ];
                $retEmail = $mail->envioEmail(1, $dadosEmail);
                $retorno = [ "status" => "sucesso",  "data" => $retEmail];
            }

            return json_encode($retorno);

        }

        private function getEmpresaDados($id)
        {
            $sql = "select telefone, email, celular, endereco, bairro, nome_fantasia from empresa where id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        private function getUsuarioDados($id)
        {
            $sql = "select nome, email, cpf, data_nascimento, telefone from usuario where id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }

        public function getExameDados($ids)
        {
            $sql = "select exame from exame where id IN ({$ids})";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $res = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $itens = "";
            foreach ($res as $item) {
                $itens = $itens . $item['exame'] . ', ';
            }

            return substr($itens, 0, -2);
        }

    }