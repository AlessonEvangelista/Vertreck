<?php
    ini_set('display_errors', 0);

    require_once 'vendor/autoload.php';

    $method = strtolower( $_SERVER['REQUEST_METHOD'] );
    $url = (isset($_GET) ? explode('/', $_GET['url']) : null);

    if(!$url) {
        throw new Exception("Página não encontrada!");
    }

    try {

        $service = 'App\Services\\'.ucfirst( $url[0].'Service');
        array_shift($url);

        $response = call_user_func_array(array(new $service, $url[0]), $_POST);
        if($_SERVER['HTTP_HOST'] === 'localhost'){
            if($response){
                header("Location:  http://localhost/pessoal/Vertreck/ADM/index.php");
            } else {
                header("Location:  http://localhost/pessoal/Vertreck/ADM/login.php?message=1");
            }
        } else {
            if($response) {
                header("Location:  http://vertreck1.hospedagemdesites.ws/Adm/index.php");
            } else {
                header("Location:  http://vertreck1.hospedagemdesites.ws/Adm/login.php?message=1");
            }
        }
    } catch (\Exception $e) {
        var_dump($e->getMessage());
    }