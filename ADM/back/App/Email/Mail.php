<?php

    namespace App\Email;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    class Mail
    {
        private $mail;

        public function __construct()
        {
            $this->mail = new PHPMailer();
            $this->configureSMTP();
        }

        private function configureSMTP()
        {
            // Configurações do servidor
            $this->mail->isSMTP();
            $this->mail->SMTPAuth = true;
            $this->mail->Username   = AUTH_SEND_EMAIL_EMAIL;
            $this->mail->Password   = AUTH_SEND_EMAIL_PASS;

            $this->mail->SMTPSecure = 'tls';

            $this->mail->Host = SMTP_HOST;
            $this->mail->Port = SMTP_PORT;
        }

        public function setRemetente($destinatario, $usuario = null)
        {
            // Define o remetente
            $this->mail->setFrom(EMAIL_VERTRECK_FROM, EMAIL_VERTRECK_FROM_NAME);

            $this->mail->addAddress($destinatario[0], $destinatario[1]);

            if($usuario)
                $this->mail->addCC($usuario[0], $usuario[1]);

            $this->mail->addCC('alesson.evangelista@autoavaliar.com.br', 'Alesson AA');
            $this->mail->addCC('alex.rodrigues@vertreck.com.br', 'Alex Vertreck APP');
            $this->mail->addCC('jose.rodrigues@vertreck.com.br', 'Nino Vertreck APP');
        }

        public function envioEmail($tipo, $data)
        {
            try {
                $this->mail->isHTML(true);  // Seta o formato do e-mail para aceitar conteúdo HTML
                switch ($tipo)
                {
                    case 1:
                        $this->mail->Subject = ' TESTE - Agendamento realizado no APP Vertreck ';
                        $this->mail->Body    = "<p> <b>Agendamento realizado</b> </p> 
                                                <p> <b>Usuário</b></p> 
                                                <p> <b>Nome: </b> {$data['usuario']['nome']} </p>
                                                <p> <b>CPF Usuário:</b> {$data['usuario']['cpf']} </p>
                                                <p> <b>Email Usuário:</b> {$data['usuario']['email']} </p>
                                                <p> <b>Data de Nascimento:</b> {$data['usuario']['nascimento']} </p>
                                                <p> <b>Telefone Usuário:</b> {$data['usuario']['telefone']} </p>
                                                <p> <b>Empresa</b></p>
                                                <p> <b>Nome Empresa: </b> {$data['empresa']['nome_fantasia']} </p>
                                                <p> <b>Endereço Empresa: </b> {$data['empresa']['endereco']} - {$data['empresa']['bairro']} </p>
                                                <p> <b>Telefone Empresa: </b> {$data['empresa']['telefone']} / {$data['empresa']['celular']} </p>
                                                <p> <b>Exame </b>
                                                <p> <b>Exame solicitado: </b> {$data['exame']} </p>
                                                <p> <b>Dia e Hora: </b> {$data['data']['dia']} - {$data['data']['hora']} </p>";
                        break;
                }

//                $this->mail->send();
                if(!$this->mail->Send())
                {
                    return "Mailer Error: " . $this->mail->ErrorInfo;
                }else {
                    return "Agenda SOLICITADA! Confira em seu e-mail sua solicitação de exame. Ligue diretamente na clinica, no Tel: " . $data['empresa']['telefone'] . " para maiores informações";
                }
            } catch (\Exception $e) {
                // TODO SET LOG ERROR MAIl
                return $e->getMessage();
            }
        }
    }
