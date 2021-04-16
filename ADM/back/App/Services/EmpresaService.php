<?php

    namespace App\Services;

    use App\Models\Empresa;

    class EmpresaService
    {
        public function __construct()
        {
            session_start();
            $_SESSION['message'] = 'Ocorreu algum erro ao cadastrar. teste novamente mais tarde!';
            $_SESSION['pagina_back'] = 'CADASTRO DE LABORATÓRIOS';
        }

        public function create()
        {
            if( (new Empresa())->create($_POST) )
            {
                $_SESSION['message'] = 'Empresa Cadastrada com sucesso';
            } else {
                $_SESSION['message_tipo']=3;
            }
            return true;
        }

        public function update()
        {
            $_SESSION['message'] = 'Ocorreu algum erro ao editar empresa. tente novamente mais tarde! Ou informe ao administrador';

            if ( (new Empresa())->update($_POST) )
            {
                $_SESSION['message'] = 'Empresa alterada com sucesso!';
            } else {
                $_SESSION['message_tipo']=3;
            }
            return true;
        }
    }