<?php

    namespace App\Services;
    use App\Models\Access;
    use App\Config\Utils;

    class AccessService
    {
        public function __construct()
        {
            session_start();
        }

        public function Login()
        {
            if(isset($_POST['email']) && isset($_POST['password'])) {
                $login = (new Access())->login($_POST['email'], $_POST['password']);
            }
            if($login) {
                (new Utils())->saveSessions('login', $login);
                return true;
            }
            return false;
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
                (new Utils())->saveSessions('login', ["id" => $createUser, "nome" => $data["nome"], "email" => $data["email"] ]);

                if($_SERVER['HTTP_HOST'] === 'localhost'){
                    header("Location:  http://localhost/pessoal/Vertreck/Proj/app.php?id=".$_SESSION['id']."&nome=".$_SESSION['nome']);
                    exit;
                } else {
                    header("Location:  https://vertreck.net.br/app.php?id=".$_SESSION['id']."&nome=".$_SESSION['nome']);
                    exit;
                }
            } else {
                if($_SERVER['HTTP_HOST'] === 'localhost'){
                    header("Location:  http://localhost/pessoal/Vertreck/Proj/cadastro.php?cpf=".$data['cpf']."&message=Algum erro ao cadastrar");
                    exit;
                } else {
                    header("Location:  https://vertreck.net.br/cadastro.php?cpf=".$data['cpf']."&message=Algum erro ao cadastrar");
                    exit;
                }
            }

            return json_encode($retorno);
        }

        public function editarUsuario()
        {
            $createUser = (new Access())->updateUsuario($_POST);
            if($createUser) {
                if($_SERVER['HTTP_HOST'] === 'localhost'){
                    header("Location:  http://localhost/pessoal/Vertreck/Proj/editar.php?message=Dados atualizados com sucesso");
                    exit;
                } else {
                    header("Location:  https://vertreck.net.br/editar.php?message=Dados atualizados com sucesso");
                    exit;
                }
            } else {
                if($_SERVER['HTTP_HOST'] === 'localhost'){
                    header("Location:  http://localhost/pessoal/Vertreck/Proj/editar.php?message=Algum erro ao editar os dados");
                    exit;
                } else {
                    header("Location:  https://vertreck.net.br/editar.php?message=Algum erro ao editar os dados");
                    exit;
                }
            }

            return json_encode($retorno);
        }

        private function validCreateField($data)
        {
            // TODO removido senha pois está logando com com cpf
//            $data['senha'] = (new Utils())->encrypt($data['senha']);
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