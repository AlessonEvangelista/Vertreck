<?php

    namespace App\Config;

    class Utils
    {
        public function encrypt($passwd)
        {
            return crypt($passwd, 'vertreck');
        }

        public function saveSessions($tipo, $dados)
        {
            foreach ($dados as $key => $data) {

                $_SESSION[$key] = $data;

            }
            if ($tipo === 'login')
            {
                $_SESSION['usuario'] = $_SESSION['nome'];
            }
        }

        public function destroySessions()
        {
            session_destroy();
        }
    }