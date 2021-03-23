<?php

    namespace App\Services;
    use App\Models\Access;
    use App\Config\Utils;

    class AccessService
    {
        public function Login()
        {
            if(isset($_POST['email']) && isset($_POST['password'])) {
                $login = (new Access())->login($_POST['email'], $_POST['password']);
            }
            (new Utils())->saveSessions('login', $login);

            return true;
        }

        public function logout()
        {
            (new Utils())->destroySessions();
            session_destroy();
            header("Location: ../login.php");
            exit;
//            return true;
        }

    }