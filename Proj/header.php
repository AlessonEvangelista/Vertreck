<?php
    session_start();
    if ($_SERVER['HTTP_HOST'] === 'localhost') {
        define("LOCAL_API", "http://localhost/pessoal/Vertreck/ADM/back");
        define("APP_BASE", "http://localhost/pessoal/Vertreck/Proj");
        define("INTERNAL_BASE", "../ADM/back/api.php?url=External/");
    }
    else {
        define("LOCAL_API", "https://vertreck.net.br/Adm/back");
        define("APP_BASE", "https://vertreck.net.br");
        define("INTERNAL_BASE", "Adm/back/api.php?url=External/");
    }
    if(!isset($_SESSION['nome']) and !isset($_GET['rollback'])){
        echo "<script> alert('É necessário realizar o Login para ter acesso!'); </script>";
        header("Location: index.php?rollback=true");
        exit;
    }
?>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Bootstrap, Landing page, Template, Registration, Landing">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Grayrids">
    <title>Vertreck</title>

    <!-- Bootstrap CSS -->
<!--    <link rel="stylesheet" href="css/bootstrap.min.css">-->
    <link rel="stylesheet" href="css/line-icons.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/owl.theme.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/nivo-lightbox.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/responsive.css">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <input type="hidden" id="baseUrlProject" value="<?= APP_BASE ?>">
    <input type="hidden" id="fastLoginApi" value="<?= INTERNAL_BASE ?>fastLoginUsuario">
    <style>
        .page-scroll { cursor: pointer; }
    </style>
</head>

<body style="margin-top: 15vh; height: 100vh;">

    <!-- Header Section Start -->
    <header id="home" class="hero-area-2">
        <div class="overlay"></div>
        <nav class="navbar navbar-expand-md bg-inverse fixed-top scrolling-navbar">
            <div class="container">
                <a href="index.php" class="navbar-brand"><img src="img/logo-vertreck.png" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="lni-menu"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">

                    <?php if( $_SESSION['nome'] ) { ?>
                        <ul class="navbar-nav mr-auto w-100 justify-content-end" id="menu-on" >
                            <li class="nav-item" id="UserLablLog">
                                <?= $_SESSION['nome'] ?>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link page-scroll" href="index.php">Início</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link page-scroll" href="app.php">Exame</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link page-scroll" href="ouvidoria.php">Ouvidoria</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link page-scroll" href="guias.php">Guias</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link page-scroll" href="app.php?logout=true" >
                                    <figcaption class="blockquote-footer">Sair</figcaption>
                                </a>
                            </li>
                        </ul>
                    <?php } else { ?>
                        <ul class="navbar-nav mr-auto w-100 justify-content-end" id="menu-off">
                            <li class="nav-item">
                                <a class="nav-link page-scroll" href="index.php">Início</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link page-scroll" href="ouvidoria.php">Ouvidoria</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link page-scroll" data-bs-toggle="modal" data-bs-target="#appLoginCad">Entrar</a>
                            </li>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </nav>

    </header>
    <!-- Header Section End -->