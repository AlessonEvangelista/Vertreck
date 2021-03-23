<!DOCTYPE html>
<html lang="en">

<?php require_once 'header.php'; ?>
<div class="separeted"></div>
<!-- Contact Section Start -->
<section id="contact">
    <div class="contact-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="offset-top">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <div class="contact-block wow fadeInUp" data-wow-delay="0.2s">
                            <div class="section-header">
                                <p class="btn btn-subtitle wow fadeInDown" data-wow-delay="0.2s">Agenciamento de exames</p>

<!--                                <div class="row">-->
<!--                                    <div class="col">-->
<!--                                        <a class="btn btn-primary btn-sm" href="login.php" style="width: 90%; padding: 15px 10px 10px 10px;">-->
<!--                                            <h6>Entrar </h6>-->
<!--                                        </a>-->
<!---->
<!--                                    </div>-->
<!--                                    <div class="col">-->
<!--                                        <button type="button" class="btn btn-secondary btn-sm" style="width: 90%; padding: 15px 10px 10px 10px;">-->
<!--                                            <h6> Cadastrar </h6>-->
<!--                                        </button>-->
<!--                                    </div>-->
<!--                                </div>-->

                            </div>
                            <form id="cadastroForm" class="cadastroForm" method="post" action="<?= LOCAL_API ?>/api.php?url=External/cadastroUsuario">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="cadastroNome" name="cadastroNome" placeholder="Nome" required data-error="informe o Nome">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" placeholder="Email" id="cadastroEmail" class="form-control" name="cadastroEmail" required data-error="informe o Email">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="cadastroCpf" name="cadastroCpf" onkeydown="fMasc( this, mCPF )" placeholder="Cpf" required data-error="informe o Cpf">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="cadastroTelefone" name="cadastroTelefone" placeholder="Telefone" >
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="date" class="form-control" id="cadastroData_nascimento" name="cadastroData_nascimento" placeholder="Data de Nascimento" >
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="password" placeholder="senha" id="cadastroSenha" name="cadastroSenha" class="form-control" required data-error="Informe a senha">
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
</section>
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

<script>
    $("#cadastroForm").submit(function(e){
        let localApi = "<?= APP_BASE ?>";

        e.preventDefault();
        cadastroUsuario(localApi);
    });

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

</script>

<!-- Modal -->
<div class="modal fade" id="appLoginCad" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="appLoginCadLabel" aria-hidden="true">
    <div class="modal-dialog" style="min-height: 50vh;">
        <div class="modal-content"  style="min-height: 50vh;">
            <div class="modal-header" style="background-color: #43f4fbb3; text-align: center;">
                <h5 class="modal-title" id="staticBackdropLabel" style="font-family: 'Montserrat', sans-serif; font-weight: 700;"> Informe o seu CPF </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
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
                        <button class="btn btn-common btn-effect" type="button" onclick="fastLoginClick()" id="btnFastLogin" >Entrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</html>