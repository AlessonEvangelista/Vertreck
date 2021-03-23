<!-- Footer Section Start -->
<footer style="margin-top: 20px; ">
    <!-- Footer Area Start -->
    <section class="footer-Content">
        <!-- Copyright Start  -->
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-10">
                        <div class="site-info float-left">
                            <p>&copy; 2021 - <a href="http://vertreck.com.br" rel="nofollow">Vertreck</a></p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="float-right">
                            <ul class="footer-social">
                                <li><a class="facebook" href="#"><i class="lni-facebook-filled"></i></a></li>
                                <li><a class="twitter" href="#"><i class="lni-twitter-filled"></i></a></li>
                                <li><a class="linkedin" href="#"><i class="lni-linkedin-fill"></i></a></li>
                                <li><a class="google-plus" href="#"><i class="lni-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright End -->
    </section>
    <!-- Footer area End -->

</footer>
<!-- Footer Section End -->

<!-- Go To Top Link -->
<!--    <a href="#" class="back-to-top">-->
<!--      <i class="lni-chevron-up"></i>-->
<!--    </a> -->

<!-- Preloader -->
<div id="preloader">
    <div class="loader" id="loader-1"></div>
</div>
<!-- End Preloader -->

<!-- jQuery first, then Tether, then Bootstrap JS. -->

<script src="js/jquery-min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>

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

<script>
    const BaseUrl = "<?= APP_BASE ?>";
    $(document).ready(function () {
        const nome = sessionStorage.getItem("nome");
        const email = sessionStorage.getItem("email");

        if( nome && nome != "undefined" )
        {
            enabledMenu("none", "flex");
            let userLbl = $("#UserLablLog").html(
                "<label class='nav-link' >Olá "+nome+"</label>");
        }
        else
        {
            enabledMenu("flex", "none");
        }
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
<script src="js/api.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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