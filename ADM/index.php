﻿<?php
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
        echo "<div class='alert alert-success' role='alert'> ". $_SESSION['message'] ." </div> ";
        $_SESSION['message'] = null;
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
  <link
          href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="public/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <?php require_once "menu.php"; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

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

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; <a href="https://www.linkedin.com/in/alesson-evangelista-9393b931/" target="_blank">AlessonEvangelista</a> / Vertreck <?= date("Y") ?></span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

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
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Tem certeza que deseja sair?</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="back/app.php?url=Access/Logout">Logout</a>
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
    $('#sltUsuarioTipo').focus(function() {
        if(typeof $('#sltUsuarioTipo option:selected').val() === 'undefined') {
            getTipos("sltUsuarioTipo", "Usuario");
        }
    });

    $('#sltUsuarioEmpresa').focus(function() {
        if(typeof $('#sltUsuarioEmpresa option:selected').val() === 'undefined') {
            getEmpresaCombo("sltUsuarioEmpresa");
        }
    });
    // _______ FIM USUARIO
    // SERVICOS/EXAMES

    $('#sltServicoEmpresa').focus(function() {
        if(typeof $('#sltServicoEmpresa option:selected').val() === 'undefined') {
            getEmpresaCombo("sltServicoEmpresa");
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

    $('#pgEmpresaExameEmpresa').focus(function() {
        if(typeof $('#pgEmpresaExameEmpresa option:selected').val() === 'undefined') {
            getEmpresaCombo("pgEmpresaExameEmpresa");
        }
    });

    $("#pgEmpresaExameServico").change(function () {
        getExameServicoCombo( $("#pgEmpresaExameServico").val(), "pgEmpresaExameExame");
    });

    //______ FIM SERVICOS/EXAMES
    // AGENDA
    $('#pgAgendaEmpresa').focus(function() {
        // if(typeof $('#pgAgendaEmpresa option:selected').val() === 'undefined') {
            getEmpresaCombo("pgAgendaEmpresa");
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

    // ________ FIM AGENDA

    // EMPRESA MDL
    $('#mdlUpdateEmpresaEstado').focus(function() {
        getEstado("mdlUpdateEmpresaEstado");
    });
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

</script>

</html>