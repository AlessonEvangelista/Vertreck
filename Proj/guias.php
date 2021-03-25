<!DOCTYPE html>
<html lang="en">

<?php require_once 'header.php'; ?>
<div class="separeted-index"></div>

<body>
    <div class="container" >
        <div class="row space-100">
            <div class="col-lg-7 col-md-12 col-xs-12">
                    <a target="_blank" style="padding: 20px 10px 10px 10px" href="pdf/Z-Adendo-A-Anexo-1D_Formulario-para-avaliacao-medica-ocupacional-LOTE-3.pdf">
                        <div class="card" style="width: 90%; margin: 0 auto;">
                            <img style="max-width: 8rem; margin: 0 auto;" src="img/pdf.png" alt="pdf" title="pdf">
                            <div class="card-body">
                                <h6 class="card-title">Z - Adendo A - Anexo 1D_Formulário para avaliação médica ocupacional LOTE 3</h6>
                            </div>
                        </div>
                    </a>

                    <a target="_blank" style="padding: 10px" href="pdf/Z-Adendo-A-Anexo-1E_Formulario-para-avaliacao-odontologica-LOTE-3.pdf">
                        <div class="card" style="width: 90%; margin: 0 auto;">
                            <img style="max-width: 8rem; margin: 0 auto;" src="img/pdf.png" alt="pdf" title="pdf">
                            <div class="card-body">
                                <h6 class="card-title">Z - Adendo A - Anexo 1E_Formulário para avaliação odontológica LOTE 3</h6>
                            </div>
                        </div>
                    </a>

                    <a target="_blank" style="padding: 10px" href="pdf/Z-Adendo-A-Anexo-1F_Formulario-para-avaliacao-nutricional-LOTE-3.pdf">
                        <div class="card" style="width: 90%; margin: 0 auto;">
                            <img style="max-width: 8rem; margin: 0 auto;" src="img/pdf.png" alt="pdf" title="pdf">
                            <div class="card-body">
                                <h6 class="card-title">Z - Adendo A - Anexo 1F_Formulário para avaliação nutricional LOTE 3</h6>
                            </div>
                        </div>
                    </a>

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

<script src="js/api.js"></script>

<script>
    const BaseUrl = "<?= APP_BASE ?>";
    $(document).ready(function () {

        const nome = sessionStorage.getItem("nome");
        const email = sessionStorage.getItem("email");

        if( nome && nome != "undefined" )
        {
            enabledMenu("none", "flex");
        }
        else
        {
            enabledMenu("flex", "on");
            alert("É necessário realizar o Login para ter acesso!");

            window.location = BaseUrl + "/index.php";
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
</script>
</html>