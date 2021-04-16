<?php

    namespace App\Services;

    use App\Models\Usuario;

    class UsuarioService
    {
        public function __construct()
        {
            session_start();
            $_SESSION['pagina_back'] = 'CADASTRO DE USUARIOS';
            $_SESSION['message'] = 'Ocorreu algum erro ao cadastrar. Verifique se os dados estão corretos, ou CPF já cadastrado ou tente novamente mais tarde!';
        }

        public function create()
        {
            if ( (new Usuario())->create($_POST) ) {
                $_SESSION['message'] = 'Usuário Cadastrado com sucesso';
            } else {
                $_SESSION['message_tipo']=3;
            }
            return true;
        }
    }