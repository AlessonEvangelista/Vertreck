<!DOCTYPE html>
<html lang="en">

    <?php require_once 'header.php'; ?>
    <div class="separeted-index"></div>

    <div class="container" >
        <div class="row space-100">
            <div class="col-lg-7 col-md-12 col-xs-12">
                <div class="contents" style="padding: 2rem 0.4rem;">
                    <h2 class="head-title">Seja bem vindo <br> à rede credenciada Petrobras</h2>
                    <p style="display: flex; margin: 2rem 0;">
                        <h4 class="head-title"> Centrais de atendimento: <br>
                            <a href="tel:08004440050" style="text-decoration: none;">0800 444 0050</a> <br></h4>
                    </p>
                    <?php if( !$_SESSION['nome'] ) { ?>
                        <div class="header-button">
                            <button type="button" class="btn btn-outline-primary" style="margin: 10px 0;" data-bs-toggle="modal" data-bs-target="#appLoginCad">Área do usuário</button>
                        </div>
                    <?php } else { ?>
                        <div class="header-button">
                            <a class="btn btn-outline-primary" style="margin: 10px 0;" href="app.php">Área do usuário</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <?php require_once 'footer.php'; ?>
  </body>



</html>