<?php
session_start();
if ($_SERVER['HTTP_HOST'] === 'localhost') {
    define("LOCAL_API", "http://localhost/pessoal/Vertreck/ADM/back");
    define("APP_BASE", "http://localhost/pessoal/Vertreck/Proj");
    define("INTERNAL_BASE", "../ADM/back/api.php?url=External/");
    define("ASSETS", "../Proj/");
}
else {
    define("LOCAL_API", "https://vertreck.net.br/Adm/back");
    define("APP_BASE", "https://vertreck.net.br");
    define("INTERNAL_BASE", "Adm/back/api.php?url=External/");
    define("ASSETS", "../");
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
    <link rel="stylesheet" href="<?= ASSETS ?>css/line-icons.css">
    <link rel="stylesheet" href="<?= ASSETS ?>css/owl.carousel.css">
    <link rel="stylesheet" href="<?= ASSETS ?>css/owl.theme.css">
    <link rel="stylesheet" href="<?= ASSETS ?>css/animate.css">
    <link rel="stylesheet" href="<?= ASSETS ?>css/magnific-popup.css">
    <link rel="stylesheet" href="<?= ASSETS ?>css/nivo-lightbox.css">
    <link rel="stylesheet" href="<?= ASSETS ?>css/main.css">
    <link rel="stylesheet" href="<?= ASSETS ?>css/responsive.css">

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
<header id="home" >
    <div class="overlay"></div>
    <nav class="navbar navbar-expand-md bg-inverse fixed-top scrolling-navbar" style="background: #092c91;">
        <div class="container">
            <img src="<?= ASSETS ?>img/logo-vertreck.png" alt="">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <i class="lni-menu"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto w-100 justify-content-end" id="menu-off">
                    <li class="nav-item">
                        <a href="login.php" class="nav-link page-scroll">Voltar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</header>

<!-- Contact Section Start -->
<div class="contact-form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="offset-top">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="contact-block wow fadeInUp" data-wow-delay="0.2s">
                        <br>
                        <div class="row">
                            <h4>:: Cadastro de Empresa</h4>
                        </div> <br>

                        <div class="col-lg-12">
                                <form class="needs-validation" action="<?= LOCAL_API ?>/app.php?url=Empresa/autoCreate" method="post" name="formEmpresaCreate">
                                    <input type="hidden" id="apiCadastro" value="<?= LOCAL_API ?>/api.php?url=External/">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="EmpresaNomeFantasia">Nome Fantasia</label>
                                            <input type="text" name="nome_fantasia" class="form-control" id="EmpresaNomeFantasia" placeholder="Nome Fantasia" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="EmpresaRAzaoSocial">Razão Social</label>
                                            <input type="text" name="razao_social" class="form-control" id="EmpresaRAzaoSocial" placeholder="Razão Social" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmpresaCnpj">CNPJ</label>
                                            <input type="text" name="cnpj" class="form-control" id="inputEmpresaCnpj" placeholder="cnpj" onblur="if(!validarCNPJ(this.value)){alert('CNPJ Informado é inválido'); this.value='';}" required>
                                            <div class="valid-feedback">
                                                ok!
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="emailInstitucional">EMAIL INSTITUCIONAL</label>
                                            <input type="text" name="emailInstitucional" class="form-control" id="emailInstitucional" placeholder="email" required>
                                            <div class="valid-feedback">
                                                ok!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label for="EmpresaEndereco">Endereço</label>
                                            <input type="text" name="endereco" class="form-control" id="EmpresaEndereco" placeholder="Rua dos Bobos, nº 0" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="EmpresaBairro">Bairro</label>
                                            <input type="text" name="bairro" class="form-control" id="EmpresaBairro" placeholder="Jd. Barcellos... " required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="EmpresaTelefone">Telefone</label>
                                            <input type="text" name="telefone" class="form-control" id="EmpresaTelefone" placeholder="(11)3633-3333" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="EmpresaCelular">Celular</label>
                                            <input type="text" name="celular" class="form-control" id="EmpresaCelular" placeholder="(14)99999-9999" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);" >
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="estado">Estado</label>
                                            <select name="estado" id="estado" class="form-control" required>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="cidade">Cidade</label>
                                            <select name="cidade" id="cidade" class="form-control" required>
                                            </select>
                                        </div>

<!--                                        <div class="form-group col-md-2">-->
<!--                                            <label for="tipo">Tipo Empresa</label>-->
<!--                                            <select name="tipo" id="sltEmpresaTipo" class="form-control" required>-->
<!--                                            </select>-->
<!--                                        </div>-->
<!--                                    </div>-->
                                    <!--<div class="form-row">-->
                                            <!--<div class="form-group col-md-12">-->
                                            <!--<label for="descricaoAgenda">MENSAGEM AGENDA USUÁRIO</label>-->
                                            <!--<input type="text" name="descricao_agenda" class="form-control" id="descricaoAgenda" value="Para atendimento nesse local será necessário agendamento prévio. Entre em contato com um dos canais de atendimento relacionados acima." >-->
                                        <!--</div>-->
                                    <!--</div>-->
                                    <div class="row" style="margin: 15px 0;">
                                        <h4>:: Dados de Acesso</h4>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="emailUsuario">Email de acesso</label>
                                            <input type="email" name="emailUsuario" class="form-control" id="emailUsuario" placeholder="Email de acesso" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="senha">Senha</label>
                                            <input type="password" name="password" class="form-control" id="senha" placeholder="" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="cpf">CPF</label>
                                            <input type="text" name="cpf" class="form-control" id="cpf" placeholder="Cpf para acesso" onfocusout="ValidaCpf(this.value, cpf)" onkeydown="fMasc( this, mCPF )" required>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact Section End -->

</body>
<!-- jQuery first, then Tether, then Bootstrap JS. -->
<script src="<?= ASSETS ?>js/jquery-min.js"></script>
<script src="<?= ASSETS ?>js/popper.min.js"></script>
<script src="<?= ASSETS ?>js/bootstrap.min.js"></script>
<script src="<?= ASSETS ?>js/owl.carousel.js"></script>
<script src="<?= ASSETS ?>js/jquery.mixitup.js"></script>
<script src="<?= ASSETS ?>js/jquery.nav.js"></script>
<script src="<?= ASSETS ?>js/scrolling-nav.js"></script>
<script src="<?= ASSETS ?>js/jquery.easing.min.js"></script>
<script src="<?= ASSETS ?>js/wow.js"></script>
<script src="<?= ASSETS ?>js/jquery.counterup.min.js"></script>
<script src="<?= ASSETS ?>js/nivo-lightbox.js"></script>
<script src="<?= ASSETS ?>js/jquery.magnific-popup.min.js"></script>
<script src="<?= ASSETS ?>js/waypoints.min.js"></script>
<script src="<?= ASSETS ?>js/main.js"></script>

<script src="<?= ASSETS ?>js/api.js"></script>

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
    select { max-height: 40px; }
</style>

<script>
    $(window).on("load", function(){
        GetEstadoCombo();
    });

    $("#inputEmpresaCnpj").keyup(function(e){
        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,3})(\d{0,3})(\d{0,4})(\d{0,2})/);
        e.target.value = !x[2] ? x[1] : x[1] + '.' + x[2] + '.' + x[3] + '/' + x[4] + (x[5] ? '-' + x[5] : '');
    })

    function GetEstadoCombo()
    {
        let selectboxEstado = $('#estado');
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

    $("#estado").change(function() {
        getCidadeCombo();
    })
    $("#emailInstitucional").change(function() {
        $("#emailUsuario").val($("#emailInstitucional").val());
    })
    $("#inputEmpresaCnpj").focusout(function() {
        validarCNPJ($("#inputEmpresaCnpj").val());
    })

    function getCidadeCombo()
    {
        var estado = $('#estado');
        var estadoSelecionado = estado.find('option:selected').val();

        if (typeof estadoSelecionado === 'undefined'){
            swal("Selecione um estado para prosseguir");
            return;
        }
        let selectboxCidade = $('#cidade');
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

    function validarCNPJ(cnpj) {

        cnpj = cnpj.replace(/[^\d]+/g,'');

        if(cnpj == '') return false;

        if (cnpj.length != 14)
            return false;

        // Elimina CNPJs invalidos conhecidos
        if (cnpj == "00000000000000" ||
            cnpj == "11111111111111" ||
            cnpj == "22222222222222" ||
            cnpj == "33333333333333" ||
            cnpj == "44444444444444" ||
            cnpj == "55555555555555" ||
            cnpj == "66666666666666" ||
            cnpj == "77777777777777" ||
            cnpj == "88888888888888" ||
            cnpj == "99999999999999")
            return false;

        // Valida DVs
        tamanho = cnpj.length - 2
        numeros = cnpj.substring(0,tamanho);
        digitos = cnpj.substring(tamanho);
        soma = 0;
        pos = tamanho - 7;
        for (i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2)
                pos = 9;
        }
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0))
            return false;

        tamanho = tamanho + 1;
        numeros = cnpj.substring(0,tamanho);
        soma = 0;
        pos = tamanho - 7;
        for (i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2)
                pos = 9;
        }
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(1))
            return false;

        return true;
    }

    function ValidaCpf(cpf, campo){
        cpf = cpf.replace(/\D/g, '');

        var result = true;
        [9, 10].forEach(function (j) {
            var soma = 0, r;
            cpf.split(/(?=)/).splice(0, j).forEach(function (e, i) {
                soma += parseInt(e) * ((j + 2) - (i + 1));
            });
            r = soma % 11;
            r = (r < 2) ? 0 : 11 - r;
            if (r != cpf.substring(j, j + 1)) result = false;
        });

        if( cpf.toString().length > 0 && ( cpf.toString().length != 11 || /^(\d)\1{10}$/.test(cpf) || result == false) ) {
            campo.value = "";
            campo.focus();
            alert("Por favor informe um CPF válido");
            return false;
        }

        return result;
    }

    function mask(o, f) {
        setTimeout(function() {
            var v = mphone(o.value);
            if (v != o.value) {
                o.value = v;
            }
        }, 1);
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

    function mphone(v) {
        var r = v.replace(/\D/g, "");
        r = r.replace(/^0/, "");
        if (r.length > 10) {
            r = r.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
        } else if (r.length > 5) {
            r = r.replace(/^(\d\d)(\d{4})(\d{0,4}).*/, "($1) $2-$3");
        } else if (r.length > 2) {
            r = r.replace(/^(\d\d)(\d{0,5})/, "($1) $2");
        } else {
            r = r.replace(/^(\d*)/, "($1");
        }
        return r;
    }
</script>
