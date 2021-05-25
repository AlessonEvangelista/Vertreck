<?php
    ini_set('display_errors', 0);
    session_start();

    $baseUrl = $_SERVER['HTTP_HOST'] .'/'. $_SERVER['REQUEST_URI'];
    $pathParts = pathinfo($_SERVER['DOCUMENT_ROOT'].$_SERVER['REQUEST_URI']);

    define("_FILE_ATUAL_", $pathParts['basename']);
    define("_BASE_URL_", str_replace($pathParts['basename'], "", $baseUrl) );

    if( !isset($_SESSION['usuario']) ) {
        header("Location: login.php");
    }

    if( isset($_SESSION['message']) && $_SESSION['message'] != NULL )
    {
        $class = "success";
        if( isset($_SESSION['message_tipo']) ) {
            $class = "danger";
            unset($_SESSION['message_tipo']);
        }

        echo "<div class='alert alert-{$class}' role='alert'> ". $_SESSION['message'] ." </div> ";
        unset($_SESSION['message']);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Vertreck</title>

  <!-- Custom fonts for this template-->
  <link href="public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="public/css/sb-admin-2.min.css" rel="stylesheet">
  <link href="public/css/main.css" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <?php require_once "menu.php"; ?>

        <!-- Main Content -->
        <div id="content" style="width: 100%;">

            <?php require_once "header.php"; ?>

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Painel</h1>

                </div>

                <!-- Content Row -->

                <div class="row">

                    <?php require_once "body.php";
//                        $parameters = new Parans();
//                        (new Parans())->setParans($_SESSION);
                    ?>


                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
</div>
<!-- End of Page Wrapper -->
<!-- Footer -->
<footer class="sticky-footer bg-white" style="background-color: #224abe !important;color: #cdcdcd;">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; <a href="https://www.linkedin.com/in/alesson-evangelista-9393b931/" target="_blank">AlessonEvangelista</a> / Vertreck <?= date("Y") ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Sair?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Tem certeza que deseja sair?</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-primary" href="back/app.php?url=Access/Logout">Sair</a>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="public/vendor/jquery/jquery.min.js"></script>
<script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="public/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="public/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<!--<script src="public/vendor/chart.js/Chart.min.js"></script>-->

<!-- Page level custom scripts -->
<!--<script src="public/js/demo/chart-area-demo.js"></script>-->
<!--<script src="public/js/demo/chart-pie-demo.js"></script>-->

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />

</body>

<style>
    .btn-group {
        width: 100%;
    }
    .dropdown-menu.show {
        width: 100%;
    }
    .btn-group > button {
        text-align: left;
    }
    .show>.multiselect>.multiselect-selected-text { display: none; }
</style>

<script>
    // EMPRESA
    $('#sltEmpresaEstado').focus(function() {
        getEstado("sltEmpresaEstado");
    });
    $('#sltEmpresaEstado').change(function() {
        getCidade("sltEmpresaEstado", "sltEmpresaCidade");
    });
    $('#sltEmpresaTipo').focus(function() {
        getTipos("sltEmpresaTipo", "Empresa");
    });
    // _____ FIM EMPRESA
    // USUARIO
    $('#sltUsuarioTipo').ready(function () {
        getTipos("sltUsuarioTipo", "Usuario");
    });

    $('#sltUsuarioTipo').change(function () {
        getEmpresaCombo($('#sltUsuarioTipo').val(), "sltUsuarioEmpresa");
    });
    // _______ FIM USUARIO
    // SERVICOS/EXAMES

    $('#sltServicoEmpresa').focus(function() {
        if(typeof $('#sltServicoEmpresa option:selected').val() === 'undefined') {
            getEmpresaCombo("", "sltServicoEmpresa");
        }
    });

    $('#sltServicoExame').focus(function() {
        if(typeof $('#sltServicoExame option:selected').val() === 'undefined') {
            getServico();
        }
    });

    $('#mdlSltAgendamentoExame').focus(function() {
        getExameCombo("mdlSltAgendamentoExame", document.getElementById('mdlAgendaEmpresaExame').value);
    });

    $('#pgEmpresaExameEmpresa').ready(function() {
        getEmpresaCombo("", "pgEmpresaExameEmpresa");
    });

    $("#pgEmpresaExameServico").change(function () {
        getExameServicoCombo( $("#pgEmpresaExameServico").val(), "pgEmpresaExameExame");
    });

    //______ FIM SERVICOS/EXAMES
    // AGENDA
    $('#pgAgendaEmpresa').focus(function() {
        // if(typeof $('#pgAgendaEmpresa option:selected').val() === 'undefined') {
            getEmpresaCombo("", "pgAgendaEmpresa");
        // }
    });

    $('#pgAgendaExame').focus(function() {
        if(typeof $('#pgAgendaExame option:selected').val() === 'undefined') {
            getExameCombo("pgAgendaExame", "");
        }
    });

    $('#pgAgendaEmpresa').change(function() {
        getAgendaList();
    });
    $('#pgAgendaExame').change(function() {
        getAgendaList();
        setEmpresaToExame();
    });

    $("#formFileGuia").change(function() {
        let file = $("#formFileGuia").val();
        if( file.split('.').pop().toLowerCase() !== "pdf" ) {
            alert("É preciso que o arquivo seja um PDF!");
            $("#formFileGuia").val("").focus();
            return false;
        }
    });

    $("#formFileExame").change(function() {
        let file = $("#formFileExame").val();
        if( file.split('.').pop().toLowerCase() !== "pdf" ) {
            alert("É preciso que o arquivo seja um PDF!");
            $("#formFileExame").val("").focus();
            return false;
        }
    });

    // ________ FIM AGENDA

    // EMPRESA MDL
    $('#mdlUpdateEmpresaEstado').change(function() {
        getCidade("mdlUpdateEmpresaEstado", "mdlUpdateEmpresaCidade");
    });
    $('#mdlUpdateEmpresaTipo').focus(function() {
        getTipos("mdlUpdateEmpresaTipo", "Empresa");
    });

    function openCity(evt, tabName) {
        var i, tabcontent, tablinks;

        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
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

    $("#inputEmpresaCnpj").change(function(e){
        var x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,3})(\d{0,3})(\d{0,4})(\d{0,2})/);
        e.target.value = !x[2] ? x[1] : x[1] + '.' + x[2] + '.' + x[3] + '/' + x[4] + (x[5] ? '-' + x[5] : '');
    })

    function moeda(a, e, r, t) {
        let n = ""
        , h = j = 0
        , u = tamanho2 = 0
        , l = ajd2 = ""
        , o = window.Event ? t.which : t.keyCode;
        if (13 == o || 8 == o)
            return !0;
        if (n = String.fromCharCode(o),
        -1 == "0123456789".indexOf(n))
            return !1;
        for (u = a.value.length,
        h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++)
            ;
        for (l = ""; h < u; h++)
            -1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
        if (l += n,
        0 == (u = l.length) && (a.value = ""),
        1 == u && (a.value = "0" + r + "0" + l),
        2 == u && (a.value = "0" + r + l),
        u > 2) {
            for (ajd2 = "",
            j = 0,
            h = u - 3; h >= 0; h--)
                3 == j && (ajd2 += e,
                j = 0),
                ajd2 += l.charAt(h),
                j++;
            for (a.value = "",
            tamanho2 = ajd2.length,
            h = tamanho2 - 1; h >= 0; h--)
                a.value += ajd2.charAt(h);
            a.value += r + l.substr(u - 2, u)
        }
        return !1
    }

    $("#tblExamePreco").ready(function() {
        getAllExamePreco();
        <?php if($_SESSION['tipo']) { ?>
        idEmpresaExamePreco();
        <?php } ?>
    });

    $("#idEmpresaExamePreco").change(function() {
        getAllExamePreco($("#idEmpresaExamePreco").val());
    })

    $("#sltInformeEmpresaEspecifica").change(function() {
        tblInformeEmpresaEspecifica($("#sltInformeEmpresaEspecifica").val());
    })

</script>

<?php
    unset($_SESSION['page']);
    unset($_SESSION['pagina_back']);
?>
</html>