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

                                            <div class="row">
                                                <div class="col">
                                                    <button type="button" class="btn btn-secondary btn-sm" style="width: 90%; padding: 15px 10px 10px 10px;">
                                                        <h6>Entrar </h6>
                                                    </button>
                                                </div>
                                                <div class="col">
                                                    <a class="btn btn-primary btn-sm" href="cadastro.php" style="width: 90%; padding: 15px 10px 10px 10px;">
                                                        <h6> Cadastrar </h6>
                                                    </a>
                                                </div>
                                            </div>

                                        </div>
                                        <form id="loginForm" method="post" action="<?= INTERNAL_BASE ?>loginUsuario">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" onkeyup="disableLoginEmail()" id="loginCpf" name="loginCpf" placeholder="CPF" >
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="email" onkeyup="disableLoginCpf()" placeholder="Email" id="loginEmail" class="form-control" name="loginEmail" >
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="password" placeholder="senha" id="loginSenha" name="loginSenha" class="form-control" required data-error="Informe a senha">
                                                        <div class="help-block with-errors"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="submit-button">
                                                        <button class="btn btn-common btn-effect" id="submit" type="submit" >Entrar</button>

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
        $("#loginForm").submit(function(e){
            let localApi = "<?= APP_BASE ?>";

            e.preventDefault();
            loginUsuario(localApi);
        });
        function disableLoginCpf() {
            $("#loginCpf").prop("disabled", true);
        }
        function disableLoginEmail() {
            $("#loginEmail").prop("disabled", true);
        }
        $("#loginCpf").focusout(function(){
            if($("#loginCpf").val() == "")
                $("#loginEmail").prop("disabled", false);
        });
        $("#loginEmail").focusout(function(){
            if($("#loginEmail").val() == "")
                $("#loginCpf").prop("disabled", false);
        });
    </script>

</html>