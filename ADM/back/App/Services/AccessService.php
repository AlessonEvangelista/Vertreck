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
                        header("Location:  https://vertreck.net.br/app.php?id=".$_SESSION['id']."&nome=".$_SESSION['nome']);
                        exit;
                    }
                } else {
                    if($_SERVER['HTTP_HOST'] === 'localhost'){
                        header("Location:  http://localhost/pessoal/Vertreck/Proj/cadastro.php?cpf=".$_POST['fastLoginCpf']);
                        exit;
                    } else {
                        header("Location:  https://vertreck.net.br/cadastro.php?cpf=".$_POST['fastLoginCpf']);
                        exit;
                    }
                }
            }
        }

        public function cadastroUsuario()
        {
            $data = $this->validCreateField($_POST);
            $createUser = (new Access())->createUsuario($data);

            if($createUser) {
                (new Utils())->saveSessions('login', ["id" => $id, "nome" => $data["nome"], "email" => $data["email"] ]);

                if($_SERVER['HTTP_HOST'] === 'localhost'){
                    header("Location:  http://localhost/pessoal/Vertreck/Proj/app.php?id=".$_SESSION['id']."&nome=".$_SESSION['nome']);
                    exit;
                } else {
                    header("Location:  https://vertreck.net.br/app.php?id=".$_SESSION['id']."&nome=".$_SESSION['nome']);
                    exit;
                }
            } else {
                if($_SERVER['HTTP_HOST'] === 'localhost'){
                    header("Location:  http://localhost/pessoal/Vertreck/Proj/cadastro.php?cpf=".$data['cpf']."&message=Algum-erro-ao-cadastrar");
                    exit;
                } else {
                    header("Location:  https://vertreck.net.br/cadastro.php?cpf=".$data['cpf']."&message=Algum-erro-ao-cadastrar");
                    exit;
                }
            }

            return json_encode($retorno);
        }

        private function validCreateField($data)
        {
            $data['senha'] = (new Utils())->encrypt($data['senha']);
            $data['empresa'] = 0;
            $data['tipo'] = '3';

            return $data;
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