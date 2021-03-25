function fastLoginClick() {
    let localApi = $("#baseUrlProject").val();
    let postLogin = $("#fastLoginApi").val();

    console.log(localApi)
    console.log(postLogin)

    if( ! ValidaCpf($("#fastLoginCpf").val()) )
    {
        swal("CPF inválido. Por favor informe um CPF válido!");
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
                    swal("Ops! não te encontramos..", "Por favor clique no botão abaixo e você será redirecionado a página de cadastro")
                        .then((value) => {
                            location.href = redirectback + "/cadastro.php?cpf="+$("#fastLoginCpf").val();
                        });
                }
            }
        },
        error: function (err) {
            swal("Ops! não te encontramos..", "Clicando no botão abaixo, você irá a tela de cadastro para refazer o seu cadastro. Caso persista o erro favor reportar no Email: vertreck@vertreck.com.br")
            .then((value) => {
                location.href = redirectback + "/cadastro.php?cpf="+$("#fastLoginCpf").val();
            });
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
    let selectboxEstado = $('#AppEstado');
    $.ajax({
        url: $("#AppFrmConsulta").attr('action') + "appGetEstadoCombo",
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

function appGetCidade()
{
    var estado = $('#AppEstado');
    var estadoSelecionado = estado.find('option:selected').val();

    if (typeof estadoSelecionado === 'undefined'){
        swal("Selecione um estado para prosseguir");
        return;
    }
    let selectboxCidade = $('#AppCidade');
    $.ajax({
        url: $("#AppFrmConsulta").attr('action') +  "appGetCidade/"+estadoSelecionado,
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

function appGetServicoByCidade()
{
    var cidade = $('#AppCidade');
    var cidadeSelecionada = cidade.find('option:selected').val();

    let selectboxServico = $('#Appservico');
    $.ajax({
        url: $("#AppFrmConsulta").attr('action') +  "appGetServicoByCidade/"+ cidadeSelecionada,
        method: "post",
        success: function (obj) {

            if (obj != null) {
                var data = obj.data;

                selectboxServico.multiselect('destroy');
                let params = [];
                if(data.length > 0)
                    params = [{label: "Selecione um Serviço", value: 0}];

                $.each(data, function (i, d) {
                    params.push({ label: d.nome, value: d.id});
                });
                selectboxServico.multiselect({
                    nableFiltering: true,
                    enableCaseInsensitiveFiltering: true,
                    buttonWidth:'100%',
                    disableIfEmpty: true,
                    disabledText: 'Não encontrado Serviço para essa cidade...',
                    nSelectedText: 'selecione.',
                    nonSelectedText: 'selecione...'
                });
                selectboxServico.multiselect('dataprovider', params);
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
    let selectboxExame = $('#AppExame');
    $.ajax({
        url: $("#AppFrmConsulta").attr('action') +  "appGetExame/"+servico,
        method: "get",
        success: function (obj) {

            if (obj != null) {
                var data = obj.data;

                selectboxExame.multiselect('destroy');
                let params = [];
                if(data.length > 0)
                    params = [{label: "Selecione um Exame", value: 0}];
                $.each(data, function (i, d) {
                    params.push({ label: d.exame, value: d.id});
                });
                selectboxExame.multiselect({
                    nableFiltering: true,
                    enableCaseInsensitiveFiltering: true,
                    buttonWidth:'100%',
                    disableIfEmpty: true,
                    disabledText: 'Não encontrado Exame...',
                    nSelectedText: 'selecione.',
                    nonSelectedText: 'selecione...'
                });
                selectboxExame.multiselect('dataprovider', params);
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
                var data = obj.data;

                let html = "";
                $.each(data, function (i, d) {

                    html = html + "<div class='card d-flex' id='card_"+d.id+"' style='margin: 10px 0;'><div class='card-body'>" +
                        "<h6 class='card-title' style='cursor: pointer; color: blue;' " +
                        "onclick='msgTextCard(`"+ d.id +"`, `"+d.descricao_agenda+"`,`"+d.email+"`,`"+d.telefone+"`,`"+d.celular+"`,`"+data.length+"`)'" +
                        "> " + d.id + " - " + d.nome + "</h6>" +
                        "<p class='card-text'> " + d.endereco + ", " + d.bairro + " <br></p> " +
                        "<p class='msgIntoCard' id='msgIntoCard_"+d.id+"' ></p>" +
                        "</div></div>";

                });
                $("#lblEmpresasExames").html(html);
                $("#lblEmpresasExames").css("display", "flex");
                
                window.scrollTo( 0, 800 );
                swal("ESCOLHA O LOCAL DE SUA PREFERÊNCIA ABAIXO E CLIQUE NELE PARA SER INFORMADO(A) DE  COMO PODERÁ REALIZAR O AGENDAMENTO.");
            }
        }

    });

});

function msgTextCard(id, msg, email, telefone, celular, rows)
{
    $(".msgIntoCard").html("");
    $(".card").css("background-color", "#fff");

    $("#card_"+id).css("background-color", "rgb(235 238 241)" );
    $("#card_"+id).css("color", "#000");
    $(".card-text").css("color", "#000");
    $(".msgIntoCard").css("color", "#000");

    let html = "<table class='table table-bordered border-primary'><tr><td style='font-size: 1.3rem;'>"+ msg +"</td></tr></table>"+
            "<div class='container px-0 pg-4'>"+
                "<div class='row'>" +
                    "<div class='col'>" +
                        "<div class='px-0 pg-3 border'>" +
                            "Email: <a href='mail:'" + email + "'>" + email + "</a>"+
                            "<br>Telefone: <a href='tel:" + telefone + "'>" + telefone + "</a>"+
                            "<br>Celular: <a href='tel:" + celular + "'>" + celular + "</a><br>" +
                        "</div>" +
                    "</div>" +
                    "<div class='col' style='padding-left: 0; padding-right: 0;'>" +
                        "<div class='px-0 pg-3 border' style='margin: 18px 0;'>" +
                            "<button onclick='enviarParaAgenda(`"+email+"`,`"+telefone+"`,`"+celular+"`)' style='width: 50%; z-index: 900;' type='button' class='btn btn-primary'>Desejo ir nesse</button>" +
                            "<button onclick='clearMsgTextCard("+rows+")' style='width: 50%; z-index: 900;' type='button' class='btn btn-danger'>Desejo escolher outro</button>" +
                        "</div>" +
                    "</div>" +
                "</div>" +
            "</div>";

    $("#msgIntoCard_"+id).html(html);
}
function clearMsgTextCard(count)
{
    for(let i = 1; i <= count; i ++){
        $("#card_"+i).css("background-color", "#fff" );
        $("#msgIntoCard_"+i).html("");
    }
    $(".card").css("background-color", "#fff");
}

function enviarParaAgenda(email, telefone, celular)
{
    swal("Estamos quase lá", "entre em contato através do email: "+ email + ", ou dos telefones: "+ telefone + ", "+ celular +".")
    .then((value) => {
        location.href = "https://vertreck.net.br";
    });
}

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


