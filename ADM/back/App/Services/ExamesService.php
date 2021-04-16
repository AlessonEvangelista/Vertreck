<?php

    namespace App\Services;
    use App\Models\Exames;

    class ExamesService
    {
        public function __construct()
        {
            session_start();
            $_SESSION['message'] = 'Ocorreu algum erro ao cadastrar. tente novamente mais tarde!';
            $_SESSION['pagina_back'] = 'CADASTRO SERVICOS';
        }

        public function createServico()
        {
            if( (new Exames())->createServico($_POST) )
            {
                $_SESSION['message'] = 'Serviço Cadastrado com sucesso';
            } else {
                $_SESSION['message_tipo']=3;
            }

            return true;
        }

        public function createExame()
        {
            if( (new Exames())->createExame($_POST) )
            {
                $_SESSION['message'] = 'Exame Cadastrado com sucesso';
            } else {
                $_SESSION['message_tipo']=3;
            }

            return true;
        }

        public function setarEmpresa()
        {
            $_SESSION['pagina_back'] = 'EMPRESA EXAME';
            $_SESSION['message'] = 'Ocorreu algum erro no cadastro de Exame para empresa.';
            $data = [
                "empresa" => $_POST["pgEmpresaExameEmpresa"],
                "exame" => $_POST["pgEmpresaExameExame"]
            ];

            if( (new Exames())->setEmpresa($data) )
            {
                $_SESSION['message'] = "Cadastro Exame para empresa. Realizado com sucesso";
            } else {
                $_SESSION['message_tipo']=3;
            }

            return true;
        }
    }