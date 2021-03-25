<!DOCTYPE html>
<html lang="en">

<?php require_once 'header.php'; ?>
<div class="separeted"></div>

<section id="app">

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
                                            <select class="form-control" id="AppEstado" name="AppEstado">
                                                <option class="form-control"> selecione... </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="estado">Cidade</label>
                                            <select class="form-control" id="AppCidade" name="AppCidade">
                                                <option class="form-control"> selecione... </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="estado">Serviço a ser realizado</label>
                                            <select class="form-control" id="Appservico" name="Appservico">
                                                <option class="form-control"> selecione... </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12" id="divExamesServicos">
                                        <div class="form-group">
                                            <label for="estado">Exame por serviço</label>
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

<!--                                    <div class="col-md-12">-->
<!--                                        <div class="form-group">-->
<!--                                            <label for="AppAgendamento">Agendamento Data</label>-->
<!--                                            <input type="date" class="form-control" id="AppAgendamento" name="AppAgendamento">-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                    <div class="col-md-12">-->
<!--                                        <div class="form-group">-->
<!--                                            <label for="AppHora">Agendamento Hora</label>-->
<!--                                            <input type="time" class="form-control" id="AppHora" name="AppHora">-->
<!--                                        </div>-->
<!--                                    </div>-->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="AppLaboratorio">Laboratório</label>
                                            <select class="form-control" id="AppLaboratorio" name="AppLaboratorio"></select>
                                        </div>

                                        <div class="card" id="lblLaboratorioDesc" style="display: none; margin: 10px;">
                                        </div>

                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="AppExame">Exame laboratoriais</label>

                                            <div class="form-group">
                                            <select class="form-control" multiple id="AppExameLaboratorio" name="AppExameLaboratorio[]" aria-label="multiple select example"></select>

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label> Faz o uso de medicação?</label>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div style="float: left; padding: 10px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="AppMedicacaoCheck" id="AppMedicacaoCheck1">
                                                        <label class="form-check-label" for="AppMedicacaoCheck1">
                                                            Sim
                                                        </label>
                                                    </div>
                                                </div>
                                                <div style="float: left; padding: 10px;">
                                                    <div class="form-check col-md-1">
                                                        <input class="form-check-input" type="radio" name="AppMedicacaoCheck" id="AppMedicacaoCheck2" checked>
                                                        <label class="form-check-label" for="AppMedicacaoCheck2">
                                                            Não
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12" id="AppMedicamentosLbl" style="display: none;">
                                            <div class="form-control">
                                                <label for="AppMedicamentosDesc">Medicamentos</label>
                                                <textarea class="form-control" id="AppMedicamentosDesc" name="AppMedicamentosDesc"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12" style="margin: 20px 0;">
                                            <button class="btn btn-primary w-100" type="submit" id="appConsultaSolicitar" >SOLICITAR</button>
                                            <a style="display: none;" class="btn btn-primary w-100" id="appConsultaFinalizar" > <span style="width: 150px; margin: 0 auto;"> CONFIRMAR LIGAÇÃO </span></a>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
            </div>
        </div>


    </div>

</section>

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

    $(document).ready(function () {

        const nome = sessionStorage.getItem("nome");
        const email = sessionStorage.getItem("email");

        if( nome && nome != "undefined" )
        {
            enabledMenu("none", "flex");
            let userLbl = $("#UserLablLog").html(
                 "<label class='nav-link' >Olá "+nome+" </label>");
        }
        else
        {
            enabledMenu("flex", "on");
            alert("É necessário realizar o Login para ter acesso!");

            window.location = BaseUrl + "/index.php";
        }

        $('#AppExameLaboratorio').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth:'100%',
            nSelectedText: 'selecione.',
            nonSelectedText: 'selecione...'
        });
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

    $("#AppFrmAgendamento").submit(function(e){
        let ApiUserAgenda = $("#AppFrmAgendamento").attr('action') +  "appUserAgendamento";

        e.preventDefault();
        let data = {
            empresa: $("#AppLaboratorio").val(),
            usuario: sessionStorage.getItem("id"),
            medicamento: ( $("#AppMedicamentosDesc").val() ? $("#AppMedicamentosDesc").val() : "" ),
            exames: $("#AppExameLaboratorio").val(),
            dia: null,
            hora: ""
        }

        $.ajax({
            url: ApiUserAgenda,
            method: "post",
            data: {
                empresa: $("#AppLaboratorio").val(),
                usuario: sessionStorage.getItem("id"),
                medicamento: ( $("#AppMedicamentosDesc").val() ? $("#AppMedicamentosDesc").val() : "" ),
                exames: $("#AppExameLaboratorio").val()
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

    });

    $('#appConsultaFinalizar').click(function() {
        if (window.confirm("LIGOU E CONFIRMOU SUA CONSULTA?")) {
            window.location = "<?= APP_BASE ?>";
        }
    });
</script>

    <div id="dialog" title="Basic dialog">
        <p>icon.</p>
    </div>

</html>