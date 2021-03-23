function fastLoginClick() {
    let localApi = $("#baseUrlProject").val();
    let postLogin = $("#fastLoginApi").val();

    console.log(localApi)
    console.log(postLogin)

    if( ! ValidaCpf($("#fastLoginCpf").val()) )
    {
        alert("CPF inválido. Por favor informe um CPF válido!");
        $("#fastLoginCpf").focus();
    }
    else {
        fastLoginApi(postLogin, localApi);
    }
}

function fastLoginApi(loginApi, redirectback)
{
    $.ajax({
        url: loginApi,
        method: "post",
        data: {
            'cpf':   $("#fastLoginCpf").val()
        },
        success: function (obj) {

            if (obj != null) {
                var data = JSON.parse(obj.data);

                if(data.status === "sucesso") {
                    saveLoginSessionRedirect(data, redirectback);
                } else {
                    alert("Ops! não te encontramos... Por favor cadastre-se :) ");
                    location.href = redirectback + "/cadastro.php";
                }
            }
        },
        error: function (err) {
            alert("Ops! não te encontramos... Por favor cadastre-se :) ");
            location.href = redirectback + "/cadastro.php";
        }
    });
}

function cadastroUsuario(redirect)
{
    $.ajax({
        url: $("#cadastroForm").attr('action'),
        method: "post",
        data: {
            'nome': $("#cadastroNome").val(),
            'email': $("#cadastroEmail").val(),
            'cpf': $("#cadastroCpf").val(),
            'telefone': $("#cadastroTelefone").val(),
            'data_nascimento': $("#cadastroData_nascimento").val(),
            'senha': $("#cadastroSenha").val()
        },
        success: function (obj) {

            if (obj != null) {
                var data = JSON.parse(obj.data);

                saveLoginSessionRedirect(data, redirect);
            }
        },
        error: function (err) {
            console.log("error");
            console.log(err);
        }
    });
}

function loginUsuario(redirect)
{
    $.ajax({
        url: $("#loginForm").attr('action'),
        method: "post",
        data: {
            'email': $("#loginEmail").val(),
            'cpf':   $("#loginCpf").val(),
            'senha': $("#loginSenha").val()
        },
        success: function (obj) {

            if (obj != null) {
                var data = JSON.parse(obj.data);

                saveLoginSessionRedirect(data, redirect);
            }
        },
        error: function (err) {
            console.log("error");
            console.log(err);
        }
    });
}

function saveLoginSessionRedirect(data, redirect)
{
    sessionStorage.setItem("id", data.data.id);
    sessionStorage.setItem("nome", data.data.nome);
    sessionStorage.setItem("email" , data.data.email);

    location.href = redirect + "/app.php";
}

$('#AppEstado').focus(function() {
    appGetEstadoCombo();
});
$('#AppEstado').change(function() {
    appGetCidade();
});
$('#AppCidade').change(function() {
    appGetServicoByCidade();
});
$('#Appservico').change(function() {
    appGetExameByServico();
});
$('#AppMedicacaoCheck1').change(function() {
    if ($('#AppMedicacaoCheck1').val() === "on") {
        $("#AppMedicamentosLbl").css("display", "flex");
    }
});
$('#AppMedicacaoCheck2').change(function() {
    if ($('#AppMedicacaoCheck2').val() === "on") {
        $("#AppMedicamentosLbl").css("display", "none");
    }
});

function appGetEstadoCombo()
{
    var selectbox = $('#AppEstado');
    $.ajax({
        url: $("#AppFrmConsulta").attr('action') + "appGetEstadoCombo",
        method: "post",
        success: function (obj) {

            if (obj != null) {
                var data = obj.data;

                selectbox.find('option').remove();
                $('<option>').val(null).text("Selecione...").appendTo(selectbox);
                $.each(data, function (i, d) {
                    $('<option>').val(d.id).text(d.nome).appendTo(selectbox);
                });
            }
        }

    });
}

function appGetCidade()
{
    var estado = $('#AppEstado');
    var estadoSelecionado = estado.find('option:selected').val();

    if (typeof estadoSelecionado === 'undefined'){
        alert("Selecione um estado para prosseguir");
        return;
    }
    var selectbox = $('#AppCidade');
    $.ajax({
        url: $("#AppFrmConsulta").attr('action') +  "appGetCidade/"+estadoSelecionado,
        method: "get",
        success: function (obj) {

            if (obj != null) {
                var data = obj.data;

                selectbox.find('option').remove();
                $('<option>').val(null).text("Selecione...").appendTo(selectbox);
                $.each(data, function (i, d) {
                    $('<option>').val(d.id).text(d.nome).appendTo(selectbox);
                });
            }
        }
    });
}

function appGetServicoByCidade()
{
    var cidade = $('#AppCidade');
    var cidadeSelecionada = cidade.find('option:selected').val();

    var selectbox = $('#Appservico');
    $.ajax({
        url: $("#AppFrmConsulta").attr('action') +  "appGetServicoByCidade/"+ cidadeSelecionada,
        method: "post",
        success: function (obj) {

            if (obj != null) {
                var data = obj.data;

                selectbox.find('option').remove();
                $('<option>').val(null).text("Selecione...").appendTo(selectbox);
                $.each(data, function (i, d) {
                    $('<option>').val(d.id).text(d.nome).appendTo(selectbox);
                });
            }

        }

    });
}

function appGetExameByServico()
{
    var servico = $('#Appservico');
    var idServicoSelecionado = servico.find('option:selected').val();
    var txtServicoSelecionado = servico.find('option:selected').text();

    let txtservico = txtServicoSelecionado.replace(/\s/g, '');

    if( txtservico.toLowerCase() === "exameslaboratoriais" )
    {
        $("#divExamesServicos").css("display", "none");
        $("#AppAgendamentoContainer").css("display", "block")
        $("#lblEmpresasExames").css("display", "none");

        appGetLaboratorioByCidadeAndServico();
    }
    else {
        $("#divExamesServicos").css("display", "block");
        $("#AppAgendamentoContainer").css("display", "none")

        appGetEmpresasByExame(idServicoSelecionado)
    }
}

function appGetEmpresasByExame(servico)
{
    var selectbox = $('#AppExame');
    $.ajax({
        url: $("#AppFrmConsulta").attr('action') +  "appGetExame/"+servico,
        method: "get",
        success: function (obj) {

            if (obj != null) {
                var data = obj.data;

                selectbox.find('option').remove();
                $('<option>').val(null).text("Selecione...").appendTo(selectbox);
                $.each(data, function (i, d) {
                    $('<option>').val(d.id).text(d.exame).appendTo(selectbox);
                });
            }
        }
    });
}

// -- CARD
$('#AppExame').change(function() {

    let data = $('#AppExame').val() +"," +$("#AppCidade").val();

    $.ajax({
        url: $("#AppFrmConsulta").attr('action') +  "appGetEmpresaByExame/"+ data,
        method: "get",
        success: function (obj) {

            if (obj != null) {
                alert("Entre em contato com os Laboratórios abaixo, para agendamento de seu exame!");
                var data = obj.data;

                let html = "";
                $.each(data, function (i, d) {

                    html = html + "<div class='card d-flex' id='card_"+d.id+"' style='margin: 10px;'><div class='card-body'>" +
                        "<h6 class='card-title'> " + d.id + " - " + d.nome + "</h6>" +
                        "<p class='card-text'> <a href='mail:' " + d.email + "'> " + d.email + " </a> <br>" +
                        "<p class='card-text'> " + d.endereco + ", " + d.bairro + " <br>" +
                        "Tel: <a href='tel:" + d.telefone + "'>" + d.telefone + "</a>; <br> Cel: <a href='tel:" + d.celular + "'>" + d.celular + "</a></p> </div></div>";

                });
                $("#lblEmpresasExames").html(html);
                $("#lblEmpresasExames").css("display", "flex");
            }
        }

    });

});

function appGetLaboratorioByCidadeAndServico()
{
    let data = $('#Appservico').find('option:selected').val() +","+$('#AppCidade').find('option:selected').val();

    var selectbox = $('#AppLaboratorio');
    $.ajax({
        url: $("#AppFrmAgendamento").attr('action') +  "appGetLaboratorioByCidadeAndServico/"+ data,
        method: "post",
        success: function (obj) {

            if (obj != null) {
                var data = obj.data;

                selectbox.find('option').remove();
                $('<option>').val(null).text("Selecione...").appendTo(selectbox);
                $.each(data, function (i, d) {
                    $('<option>').val(d.id).text(d.nome).appendTo(selectbox);
                });
            }
        }

    });
}

function appGetLaboratorioDescById(id)
{
    $.ajax({
        url: $("#AppFrmAgendamento").attr('action') +  "appGetLaboratorioDescById/"+ id,
        method: "post",
        success: function (obj) {

            if (obj != null) {
                var data = obj.data;

                $('#lblLaboratorioDesc').html("" +
                    "<div class='card d-flex' id='card_"+data.id+"'><div class='card-body'>" +
                    "<h6 class='card-title'> " + data.id + ", " + data.nome + "</h6>" +
                    "<p class='card-text'> " + data.endereco + ", " + data.bairro + " <br>" +
                    "Tel: <a href='tel:" + data.telefone + "'>" + data.telefone + "</a>; <br> Cel: <a href='tel:" + data.celular + "'>" + data.celular + "</a></p> </div></div>");
            }
        }

    });
}

$('#AppExameLaboratorio+ul>li').change(function(){
    $('#AppExameLaboratorio').text($('#AppExameLaboratorio').attr('title'));
});

$('#AppLaboratorio').change(function() {
    appGetExameByLaboratorio($('#AppLaboratorio').val());
    appGetLaboratorioDescById($('#AppLaboratorio').val());
    $('#lblLaboratorioDesc').css("display", "flex");
});


