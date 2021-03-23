<?php

    namespace App\Services;

    use App\Models\Usuario;

    class UsuarioService
    {

        public function create()
        {
            return (new Usuario())->create($_POST);
        }
    }