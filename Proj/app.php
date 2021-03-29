<?php
    session_start();
    if($_GET['nome']) {
        $_SESSION['id'] = $_GET['id'];
        $_SESSION['nome'] = $_GET['nome'];
    }
    if(isset($_GET['logout']))
    {
        session_destroy();
        header("Location: app.php");
    }

?>
<!DOCTYPE html>
<html lang="en">

<?php require_once 'header.php'; ?>
<!--<div class="separeted"></div>-->

    <div id="loadSelected" style="width: 100%; margin: 0 auto; height: 100%; position: absolute; background-color: #dcdcdc8a; display: none; z-index: 50;">
        <img src="img/loading.gif" style="width: 40px; z-index: 51; display: flex; margin: 10% auto;">
    </div>

    <div class="app-form">
        <div class="container">
            <div class="row offset-top">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="contact-block wow fadeInUp" data-wow-delay="0.2s">
                            <div class="section-header">
                                <p class="btn btn-subtitle wow fadeInDown" data-wow-delay="0.2s">Consulta de rede Credenciada</p>
                            </div>

                            <form class="form-control" method="post" action="<?= LOCAL_API ?>/api.php?url=External/" id="AppFrmConsulta" name="AppFrmConsulta">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="estado">Estado</label>
                                            <select class="form-control" id="AppEstado" name="AppEstado"></select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="estado">Cidade</label>
                                            <select class="form-control" id="AppCidade" name="AppCidade"></select>
                                        </div>
                                    </div>
                                </div>
<!--                                <div class="row">-->
<!--                                    <div class="col-md-12">-->
<!--                                        <div class="form-group">-->
<!--                                            <label for="estado">Serviço a ser realizado</label>-->
<!--                                            <select class="form-control" id="Appservico" name="Appservico"></select>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
                                <div class="row">
                                    <div class="col-md-12" id="divExamesServicos">
                                        <div class="form-group">
                                            <label for="estado">Exame por serviço</label>
                                            <input type="hidden" name="servicoExame">
                                            <select class="form-control" id="AppExame" name="AppExame"></select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row" id="lblEmpresasExames" style="display: none; padding: 10px;"></div>
                            </form>


                            <div class="row" id="AppAgendamentoContainer" style="display: none; margin: 0;">

                                <form class="form-control" method="post" action="<?= LOCAL_API ?>/api.php?url=External/" id="AppFrmAgendamento">

                                    <div class="section-header" style="margin: 15px 0 15px 0;">
                                        <p class="btn btn-subtitle wow fadeInDown" data-wow-delay="0.2s">Agendar Consulta</p>
                                    </div>

                                    <input type="hidden" name="inpAgendamentoEmpresa" id="inpAgendamentoContainerempresa">
                                    <div class="row" id="cardSelecaoAgendamento">
                                    </div>
                                    <div class="row">
                                        <label> Faz o uso de medicação?</label>

                                        <div class="row">
                                            <div class="col-md-12" id="AppMedicamentosLbl" >
                                                <div class="form-control">
                                                    <label for="AppMedicamentosDesc">Medicamentos</label>
                                                    <textarea class="form-control" id="AppMedicamentosDesc" name="AppMedicamentosDesc"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12" style="margin: 20px 0;">
                                            <button class="btn btn-primary w-100" type="submit" id="appConsultaSolicitar" >SOLICITAR</button>
                                            <a style="display: none;" class="btn btn-primary w-100" id="appConsultaFinalizar" > <span style="width: 200px; margin: 0 auto;"> CONFIRMAR LIGAÇÃO </span></a>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
            </div>
        </div>


    </div>


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


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css" />
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="js/api.js"></script>

<script>
    const BaseUrl = "<?= APP_BASE ?>";

    $(window).on("load", function(){
        <?php if( $_SESSION['nome'] ) { ?>
            verifySessionLogin( "<?= $_SESSION['id'] ?>", "<?= $_SESSION['nome'] ?>" );
        <?php } ?>

        appGetEstadoCombo();
    })

    function enabledMenu(off, on)
    {
        $("#menu-off").css("display", off)
        $("#menu-on").css("display", on)
    }

    function logout() {
        sessionStorage.clear();
        window.location = BaseUrl + "/index.php";
    }

    function appGetExameByLaboratorio(lab)
    {
        var selectbox = $('#AppExameLaboratorio');
        $.ajax({
            url: $("#AppFrmAgendamento").attr('action') +  "appGetExameByLaboratorio/"+ lab,
            method: "post",
            success: function (obj) {

                if (obj != null) {
                    var data = obj.data;

                    selectbox.multiselect('destroy');
                    let params=[]
                    $.each(data, function (i, d) {
                        params.push({ label: d.exame, value: d.id});
                    });
                    selectbox.multiselect({
                        nableFiltering: true,
                        enableCaseInsensitiveFiltering: true,
                        buttonWidth:'100%',
                        nSelectedText: 'selecione.',
                        nonSelectedText: 'selecione...'
                    });
                    selectbox.multiselect('dataprovider', params);
                }
            }

        });
    }

    $("#AppFrmAgendamento").submit(function(e)
    {
        let ApiUserAgenda = $("#AppFrmAgendamento").attr('action') +  "appUserAgendamento";
        e.preventDefault();

        if( $("#inpAgendamentoContainerempresa").val() === "" )
        {
            swal("Para SOLICITAR agendamento, por favor selecione uma empresa na lista, clicando sobre o seu nome, e selecionando ela depois!");
            return false;
        }
        else
        {
            $.ajax({
                url: ApiUserAgenda,
                method: "post",
                data: {
                    empresa: $("#inpAgendamentoContainerempresa").val(),
                    usuario: sessionStorage.getItem("id"),
                    medicamento: ( $("#AppMedicamentosDesc").val() === "" ? "" : $("#AppMedicamentosDesc").val() ),
                    exames: $("#AppExame").val()
                    // dia: null,
                    // hora: null
                },
                success: function (obj) {
                    if (obj != null) {
                        var data = JSON.parse(obj.data);

                        $("#appConsultaSolicitar").css("display", "none");
                        $("#appConsultaFinalizar").css("display", "flex");
                        swal(data.data)
                    }
                },
                error: function (y, d) {
                    console.log(y);
                }

            });
        }
    });

    $('#appConsultaFinalizar').click(function() {
        swal("Eai!", "LIGOU E CONFIRMOU A SUA CONSULTA?")
            .then((value) => {
                // TODO ENVIAR EMAIL
                document.location.reload(true);
            });
    });
</script>
<style>
    .row { margin: 10px 0; }
</style>
</html>