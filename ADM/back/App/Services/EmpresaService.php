<?php

    namespace App\Services;

    use App\Models\Empresa;

    class EmpresaService
    {
        public function __construct()
        {
            session_start();
        }

        public function create()
        {
            $_SESSION['pagina_back'] = 'CADASTRO DE LABORATÓRIOS';
            $_SESSION['message'] = 'Ocorreu algum erro ao cadastrar. teste novamente mais tarde!';

            if( (new Empresa())->create($_POST) )
            {
                $_SESSION['message'] = 'Empresa Cadastrada com sucesso';
                return true;
            }
            return false;
        }

        public function update()
        {
            $_SESSION['pagina_back'] = 'LISTA DE LABORATÓRIOS';
            $_SESSION['message'] = 'Ocorreu algum erro ao editar empresa. tente novamente mais tarde! Ou informe ao administrador';

            if ( (new Empresa())->update($_POST) )
            {
                $_SESSION['message'] = 'Empresa alterada com sucesso!';
                return true;
            }
            return false;
        }
    }