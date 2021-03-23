<?php
    ini_set('display_errors', 1);

    require_once './vendor/autoload.php';

    $parans=[];
    $url = (isset($_GET) ? explode('/', $_GET['url']) : null);
    $method = strtolower( $_SERVER['REQUEST_METHOD'] );

    $service = 'App\Api\\'.ucfirst( $url[0].'Api');
    array_shift($url);

    if ( !$_POST ) {
        if (isset($url[1])) {
            $parans[] = $url[1];
        }
    } else {
        $parans = $_POST;
    }

    try {
        $response = call_user_func_array(array(new $service, $url[0]), $parans);
        echo json_encode(
            array(
                'status' => 'success',
                'data' => $response
            )
        );

    } catch (\Exception $e) {
        echo json_encode(
            array(
                'status' => 'error',
                'data' => $e->getMessage()
            )
        );
    }
