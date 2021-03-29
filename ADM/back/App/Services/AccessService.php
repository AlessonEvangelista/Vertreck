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

        public function fastLoginClick()
        {
            if(isset($_POST["fastLoginCpf"])) {

                $login = (new Access())->fastLogin($_POST['fastLoginCpf']);

                if ($login) {
                    (new Utils())->saveSessions('login', $login);

                    if($_SERVER['HTTP_HOST'] === 'localhost'){
                        header("Location:  http://localhost/pessoal/Vertreck/Proj/app.php?id=".$_SESSION['id']."&nome=".$_SESSION['nome']);
                        exit;
                    } else {
                        header("Location:  https://vertreck.net.br/app.php ");
                        exit;
                    }
                }
            }


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