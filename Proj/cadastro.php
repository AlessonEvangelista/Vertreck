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
?>
<!DOCTYPE html>
<html lang="en">

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
                </div>
            </div>
        </nav>

    </header>

<div class="separeted"></div>
<!-- Contact Section Start -->
<div class="contact-form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="offset-top">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="contact-block wow fadeInUp" data-wow-delay="0.2s">
                        <div class="section-header">
                            <p class="btn btn-subtitle wow fadeInDown" data-wow-delay="0.2s">Agenciamento de exames</p>
                        </div>
                        <form id="cadastroForm" class="cadastroForm" method="post" action="<?= LOCAL_API ?>/app.php?url=Access/cadastroUsuario">

                            <input type="hidden" id="apiCadastro" value="<?= LOCAL_API ?>/api.php?url=External/">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="cadastroNome" name="nome" placeholder="Nome" required data-error="informe o Nome" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="email" placeholder="Email" id="cadastroEmail" class="form-control" name="email" required data-error="informe o Email" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="cadastroCpf" value="<?=$_GET['cpf']?>" name="cpf" onkeydown="fMasc( this, mCPF )" placeholder="Cpf" required data-error="informe o Cpf">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="cadastroTelefone" name="telefone" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);" placeholder="Whatsapp" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="date" class="form-control" id="cadastroData_nascimento" name="data_nascimento" placeholder="Data de Nascimento" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <label class="col-md-3 col-form-label" for="cadastroGenero" style="color: #464a46dd;">Gênero</label>
                                        <div class="col-md-9">
                                            <select style="max-height: 41px;margin-bottom: 20px;" id="cadastroGenero" class="form-control" name="genero">
                                                <option value="1">Masculino</option>
                                                <option value="2">Feminino</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <label class="col-md-3 col-form-label" for="cadastroEstado" style="color: #464a46dd;">Estado</label>
                                        <div class="col-md-9">
                                            <select style="max-height: 41px;margin-bottom: 20px;" id="cadastroEstado" class="form-control" name="estado"></select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label" for="cadastroCidade" style="float: left; color: #464a46dd;">Cidade</label>
                                        <div class="col-sm-9">
                                            <select style="max-height: 41px;margin-bottom: 20px;" id="cadastroCidade" class="form-control" name="cidade"></select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="cadastroEndereco" name="endereco" placeholder="Endereço">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="password" placeholder="senha" id="cadastroSenha" name="senha" class="form-control" required data-error="Informe a senha" required>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="submit-button">
                                        <button class="btn btn-common btn-effect" id="submit" type="submit" >Cadastro</button>

                                        <div id="msgSubmit" class="h3 hidden"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact Section End -->

</body>
    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="js/jquery-min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.js"></script>
    <script src="js/jquery.mixitup.js"></script>
    <script src="js/jquery.nav.js"></script>
    <script src="js/scrolling-nav.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/wow.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/nivo-lightbox.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/main.js"></script>

    <script src="js/api.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<style>
    .multiselect {
        padding: 8px 10px !important;
        max-height: 40px;
    }
    .multiselect-container {
        min-width: 230px;
    }
    .dropdown-menu.show {
        top: 260% !important;
    }
</style>

<script>

    $(window).on("load", function(){
        GetEstadoCombo();
        swal("Não deixe de informar o seu numero de Whats, para contatos futuros!");
    });

    $("#cadastroEstado").focus(function (){
        getCidadeCombo();
    })
    $("#cadastroEstado").change(function (){
        getCidadeCombo();
    })

    function ValidaCpf(cpf){
        cpf = cpf.replace(/\D/g, '');

        if(cpf.toString().length != 11 || /^(\d)\1{10}$/.test(cpf)) return false;
        var result = true;
        [9,10].forEach(function(j){
            var soma = 0, r;
            cpf.split(/(?=)/).splice(0,j).forEach(function(e, i){
                soma += parseInt(e) * ((j+2)-(i+1));
            });
            r = soma % 11;
            r = (r <2)?0:11-r;
            if(r != cpf.substring(j, j+1)) result = false;
        });
        return result;
    }

    function fMasc(objeto,mascara) {
        obj=objeto
        masc=mascara
        setTimeout("fMascEx()",1)
    }

    function fMascEx() {
        obj.value=masc(obj.value)
    }

    function mCPF(cpf){
        cpf=cpf.replace(/\D/g,"")
        cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
        cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
        cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
        return cpf
    }

    function mask(o, f) {
        setTimeout(function () {
            var v = f(o.value);
            if (v != o.value) {
                o.value = v;
            }
        }, 1);
    }

    function mphone(v) {
        var r = v.replace(/\D/g,"");
        r = r.replace(/^0/,"");
        if (r.length > 10) {
            // 11+ digits. Format as 5+4.
            r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/,"($1) $2-$3");
        }
        else if (r.length > 5) {
            // 6..10 digits. Format as 4+4
            r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/,"($1) $2-$3");
        }
        else if (r.length > 2) {
            // 3..5 digits. Add (0XX..)
            r = r.replace(/^(\d\d)(\d{0,5})/,"($1) $2");
        }
        else if (r.length > 0) {
            // 1..2 digits. Just add (0XX
            r = r.replace(/^(\d*)/, "($1");
        }
        return r;
    }

    function GetEstadoCombo()
    {
        let selectboxEstado = $('#cadastroEstado');
        $.ajax({
            url: $("#apiCadastro").val() + "appGetEstadoCombo",
            method: "get",
            crossDomain: true,
            success: function (obj) {

                if (obj != null) {
                    var data = obj.data;

                    selectboxEstado.multiselect('destroy');
                    let params = [{label: "Selecione um Estado", value: 0}];
                    $.each(data, function (i, d) {
                        params.push({ label: d.nome, value: d.id});
                    });
                    selectboxEstado.multiselect({
                        nableFiltering: true,
                        enableCaseInsensitiveFiltering: true,
                        buttonWidth:'100%',
                        nSelectedText: 'selecione.',
                        nonSelectedText: 'selecione...'
                    });
                    selectboxEstado.multiselect('dataprovider', params);
                }
            }

        });
    }

    function getCidadeCombo()
    {
        var estado = $('#cadastroEstado');
        var estadoSelecionado = estado.find('option:selected').val();

        if (typeof estadoSelecionado === 'undefined'){
            swal("Selecione um estado para prosseguir");
            return;
        }
        let selectboxCidade = $('#cadastroCidade');
        $.ajax({
            url: $("#apiCadastro").val() +  "appGetCidade/"+estadoSelecionado,
            method: "get",
            success: function (obj) {

                if (obj != null) {
                    var data = obj.data;

                    selectboxCidade.multiselect('destroy');
                    let params = [{label: "Selecione uma Cidade", value: 0}];
                    $.each(data, function (i, d) {
                        params.push({ label: d.nome, value: d.id});
                    });
                    selectboxCidade.multiselect({
                        nableFiltering: true,
                        enableCaseInsensitiveFiltering: true,
                        buttonWidth:'100%',
                        nSelectedText: 'selecione.',
                        nonSelectedText: 'selecione...'
                    });
                    selectboxCidade.multiselect('dataprovider', params);
                }
            }
        });
    }

    <?php if(isset($_GET["message"])) {?>
        window.onload = function(){
            swal("<?= $_GET["message"] ?>");
        }
    <?php } ?>

</script>

<!-- Modal -->
<div class="modal fade" id="appLoginCad" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="appLoginCadLabel" aria-hidden="true">
    <div class="modal-dialog" style="min-height: 50vh;">
        <div class="modal-content"  style="min-height: 50vh;">
            <div class="modal-header" style="background-color: #43f4fbb3; text-align: center;">
                <h5 class="modal-title" id="staticBackdropLabel" style="font-family: 'Montserrat', sans-serif; font-weight: 700;"> Informe o seu CPF </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= LOCAL_API ?>/app.php?url=Access/fastLoginClick" name="" method="post">
                <div class="modal-body" style="margin: 5vh 0 0 0;">
                    <div class="row">
                        <div class="col-md-12">
                            <h4> Agende agora mesmo o seu exame na rede redenciada Petrobras</h4>
                            <figcaption class="blockquote-footer" style="margin: 2vh 0 0 0;">
                                <span> Informe o seu CPF abaixo </span>
                            </figcaption>
                        </div>
                    </div>
                    <div class="row" style="margin: 5vh 0 0 0;">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control" onkeydown="fMasc( this, mCPF )" id="fastLoginCpf" name="fastLoginCpf" placeholder="CPF" >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-md-12">
                        <div class="submit-button">
                            <!--                            onclick="fastLoginClick()"-->
                            <button class="btn btn-common btn-effect" type="submit" id="btnFastLogin" >Entrar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

</html>