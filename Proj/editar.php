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

<div class="separeted"></div>
<!-- Contact Section Start -->
<div class="contact-form">
    <div class="container">
        <div class="row justify-content-center">
            <div class="offset-top">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="contact-block wow fadeInUp" data-wow-delay="0.2s">
                        <div class="section-header">
                            <p class="btn btn-subtitle wow fadeInDown" data-wow-delay="0.2s">Editar usuário</p>
                        </div>
                        <form id="cadastroForm" class="editarForm" method="post" action="<?= LOCAL_API ?>/app.php?url=Access/editarUsuario">

                            <input type="hidden" id="apiLoadDados" value="<?= LOCAL_API ?>/api.php?url=External/">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <label class="col-md-1 col-form-label" for="editarEstado" style="color: #464a46dd;">Nome</label>
                                        <div class="col-md-11">
                                           <input type="text" class="form-control" id="editarNome" name="nome" placeholder="Nome" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <label class="col-md-2 col-form-label" for="editarEstado" style="color: #464a46dd;">Email</label>
                                        <div class="col-md-10">
                                            <input type="email" placeholder="Email" id="editarEmail" class="form-control" name="email" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <label class="col-md-2 col-form-label" for="editarEstado" style="color: #464a46dd;">Cpf</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" id="editarCpf" value="<?=$_GET['cpf']?>" name="cpf" onkeydown="fMasc( this, mCPF )" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <label class="col-md-2 col-form-label" for="editarEstado" style="color: #464a46dd;">Telefone</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" id="editarTelefone" name="telefone" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <label class="col-md-3 col-form-label" for="editarEstado" style="color: #464a46dd;">Data Nascimento</label>
                                        <div class="col-md-9">
                                            <input type="date" class="form-control" id="editarData_nascimento" name="data_nascimento" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <label class="col-md-3 col-form-label" for="editarGenero" style="color: #464a46dd;">Gênero</label>
                                        <div class="col-md-9">
                                            <select style="max-height: 41px;margin-bottom: 20px;" id="editarGenero" class="form-control" name="genero" disabled>
                                                <option value="1">Masculino</option>
                                                <option value="2">Feminino</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <label class="col-md-3 col-form-label" for="editarEstado" style="color: #464a46dd;">Estado</label>
                                        <div class="col-md-9" id="groupEstado">
                                            <select style="max-height: 41px;margin-bottom: 20px;" id="editarEstado" class="form-control" name="estado" disabled="disabled"></select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label" for="editarCidade" style="float: left; color: #464a46dd;">Cidade</label>
                                        <div class="col-sm-9" id="groupCidade">
                                            <select style="max-height: 41px;margin-bottom: 20px;" id="editarCidade" class="form-control" name="cidade" disabled></select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <label class="col-md-2 col-form-label" for="editarEstado" style="color: #464a46dd;">Endereço</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" id="editarEndereco" name="endereco" placeholder="Endereço" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <label class="col-md-2 col-form-label" for="editarEstado" style="color: #464a46dd;">Senha</label>
                                        <div class="col-md-10">
                                            <input type="password" placeholder="senha" id="editarSenha" name="senha" class="form-control" value="*****" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="submit-button">
                                        <button class="btn btn-common btn-effect" id="enabledEdit" type="button" style="display: block;">Editar</button>

                                        <div class="btn-group" role="group" id="submitEdit" style="display: none;">
                                            <button class="btn btn-common btn-effect" id="submit" type="submit" >Salvar</button>
                                            <button type="button" class="btn btn-danger" id="cancelEdit" >Cancelar</button>
                                        </div>
                                        <div class="form-group">
                                        </div>

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

    let selectboxEstado = $('#editarEstado');
    let selectboxCidade = $("#editarCidade");
    let estado;
    let cidade;

    $(window).on("load", function(){
        <?php if(isset($_GET["message"])) {?>
            swal("<?= $_GET["message"] ?>");
        <?php } ?>

        carregarDadosUsuario(<?= $_SESSION["id"] ?>);
    });

    function carregarDadosUsuario(id)
    {
        $.ajax({
            url: $("#apiLoadDados").val() + "getUserDataEdit/" + id,
            method: "get",
            crossDomain: true,
            success: function (obj) {
                if (obj != null) {
                    let data = obj.data;
                    $("#editarNome").val(data.nome);
                    $("#editarEmail").val(data.email);
                    $("#editarCpf").val(data.cpf);
                    $("#editarTelefone").val(data.telefone);
                    $("#editarData_nascimento").val(data.data_nascimento);
                    $("#editarEndereco").val(data.endereco);
                    $("#editarGenero").val(data.genero);

                    let selectboxEstado = $('#editarEstado');
                    selectboxEstado.multiselect({
                        buttonWidth:'100%',
                        disabledText: data.estado
                    });

                    let selectboxCidade = $("#editarCidade");
                    selectboxCidade.multiselect({
                        buttonWidth:'100%',
                        disabledText: data.cidade
                    });
                    estado = {label: data.estado, value: data.idEstado};
                    cidade = {label: data.cidade, value: data.idCidade};
                }
            }
        });
    }

    $("#enabledEdit").click(function() {
        enabledEdit();
    });
    $("#cancelEdit").click(function() {
        disabledEdit();
    });

    function enabledEdit()
    {
        $("#editarNome").removeAttr("disabled")
        $("#editarEmail").removeAttr("disabled")
        $("#editarTelefone").removeAttr("disabled")
        $("#editarData_nascimento").removeAttr("disabled")
        $("#editarGenero").removeAttr("disabled")
        $("#editarEndereco").removeAttr("disabled")
        $("#editarEstado").removeAttr("disabled")
        $("#editarCidade").removeAttr("disabled")

        GetEstadoCombo();
        getCidadeCombo(0);

        $("#enabledEdit").css("display", "none");
        $("#submitEdit").css("display", "block");
    }
    function disabledEdit()
    {
        $("#editarNome").attr("disabled", "disabled")
        $("#editarEmail").attr("disabled", "disabled")
        $("#editarTelefone").attr("disabled", "disabled")
        $("#editarData_nascimento").attr("disabled", "disabled")
        $("#editarGenero").attr("disabled", "disabled")
        $("#editarEndereco").attr("disabled", "disabled")
        $("#editarEstado").attr("disabled", "disabled")
        $("#editarCidade").attr("disabled", "disabled")

        selectboxEstado.multiselect('destroy');
        selectboxEstado.multiselect({
            buttonWidth:'100%',
            disabledText: estado.label
        });

        selectboxCidade.multiselect('destroy');
        selectboxCidade.multiselect({
            buttonWidth:'100%',
            disabledText: cidade.label
        });

        $("#enabledEdit").css("display", "block");
        $("#submitEdit").css("display", "none");
    }

    $("#editarEstado").change(function (){
        getCidadeCombo(1);
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
        let selectboxEstado = $('#editarEstado');
        $.ajax({
            url: $("#apiLoadDados").val() + "appGetEstadoCombo",
            method: "get",
            crossDomain: true,
            success: function (obj) {

                if (obj != null) {
                    var data = obj.data;

                    selectboxEstado.multiselect('destroy');
                    let params = [{label: estado.label, value: estado.value}];
                    $.each(data, function (i, d) {
                        if(d.id != estado.value) {
                            params.push({label: d.nome, value: d.id});
                        }
                    });
                    selectboxEstado.multiselect({
                        nableFiltering: true,
                        enableCaseInsensitiveFiltering: true,
                        buttonWidth:'100%',
                        nSelectedText: estado.label,
                        nonSelectedText: estado.label
                    });
                    selectboxEstado.multiselect('dataprovider', params);
                }
            }

        });
    }

    function getCidadeCombo(chamada)
    {
        let estadoSelecionado = "";
        let state = $('#editarEstado');
        if(chamada === 0){
            estadoSelecionado = estado.value;
        } else {
            estadoSelecionado = state.find('option:selected').val();
        }

        if (typeof estadoSelecionado === ""){
            swal("Selecione um estado para prosseguir");
            return;
        }
        let selectboxCidade = $('#editarCidade');
        $.ajax({
            url: $("#apiLoadDados").val() +  "appGetCidade/"+estadoSelecionado,
            method: "get",
            success: function (obj) {

                if (obj != null) {
                    var data = obj.data;

                    selectboxCidade.multiselect('destroy');
                    let params = "";
                    if(chamada === 0){
                        params = [{label: cidade.label, value: cidade.value}];
                    } else {
                        params = [{label: "Selecione uma Cidade", value: 0}];
                    }

                    $.each(data, function (i, d) {
                        if(d.id != cidade.value) {
                            params.push({label: d.nome, value: d.id});
                        }
                    });
                    selectboxCidade.multiselect({
                        nableFiltering: true,
                        enableCaseInsensitiveFiltering: true,
                        buttonWidth:'100%',
                        nSelectedText: cidade.label,
                        nonSelectedText: cidade.label
                    });
                    selectboxCidade.multiselect('dataprovider', params);
                }
            }
        });
    }

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