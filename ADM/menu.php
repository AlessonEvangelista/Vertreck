<?php
    if(isset($_POST))
    {
        $_SESSION['page'] = (isset($_POST['PAGE']) ? $_POST['PAGE'] : null);
    }
?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center">
<!--        <div class="sidebar-brand-icon rotate-n-15">-->
<!--            <i class="fas fa-laugh-wink"></i>-->
<!--        </div>-->
        <img src="public/img/logo-vertreck.png" class="img-thumbnail" style="border-radius: 86px; max-width: 60px;" alt="...">
        <div class="sidebar-brand-text mx-3"><?=  substr(strtoupper($_SESSION['nome_fantasia']), 0,18) ?></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Painel</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <?php if($_SESSION['tipo'] == 1 || $_SESSION['tipo'] == 4) {?>
        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEmp"
               aria-expanded="true" aria-controls="collapseEmp">
                <i class="fas fa-fw fa-cog"></i>
                <span>Laboratórios</span>
            </a>
            <div id="collapseEmp" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Componentes:</h6>
                        <a onclick="clickMenu('CADASTRO DE LABORATÓRIOS')" class="collapse-item" >Cadastro</a>
                        <a onclick="clickMenu('LISTA DE LABORATÓRIOS')" class="collapse-item" >Listagem</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUse"
               aria-expanded="true" aria-controls="collapseUse">
                <i class="fas fa-fw fa-cog"></i>
                <span>Usuários</span>
            </a>
            <div id="collapseUse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Componentes:</h6>
                    <?php if($_SESSION['tipo'] == 1) {?>
                        <a onclick="clickMenu('CADASTRO DE USUARIOS')" class="collapse-item" href="#">Cadastro</a>
                    <?php } ?>
                    <a onclick="clickMenu('LISTA DE USUARIOS')" class="collapse-item" href="#">Listagem</a>
                </div>
            </div>
        </li>
    <?php } ?>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSer"
           aria-expanded="true" aria-controls="collapseSer">
            <i class="fas fa-fw fa-cog"></i>
            <span>Serviços / Exames</span>
        </a>
        <div id="collapseSer" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Componentes:</h6>
                <?php if($_SESSION['tipo'] == 1 || $_SESSION['tipo'] == 4) { ?>
                    <a onclick="clickMenu('CADASTRO SERVICOS')" class="collapse-item" href="#">Cadastro</a>
                    <a onclick="clickMenu('LISTA DE SERVICOS')" class="collapse-item" href="#">Listagem</a>
                    <a onclick="clickMenu('EMPRESA EXAME')" class="collapse-item" href="#">Vincular Exame</a>
                <?php } ?>
                <a onclick="clickMenu('EXAME PRECO')" class="collapse-item" href="#">Exame Preço</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFinance"
           aria-expanded="true" aria-controls="collapseFinance">
            <i class="fas fa-fw fa-cog"></i>
            <span>Financeiro</span>
        </a>
        <div id="collapseFinance" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Exames:</h6>
                <a onclick="clickMenu('BAIXA EM EXAMES')" class="collapse-item" href="#">Baixa em Exames</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

<!--    <li class="nav-item">-->
<!--        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEsp"-->
<!--           aria-expanded="true" aria-controls="collapseEsp">-->
<!--            <i class="fas fa-fw fa-cog"></i>-->
<!--            <span>Especialista</span>-->
<!--        </a>-->
<!--        <div id="collapseEsp" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">-->
<!--            <div class="bg-white py-2 collapse-inner rounded">-->
<!--                <h6 class="collapse-header">Componentes:</h6>-->
<!--                <a onclick="clickMenu('CADASTRO ESPECIALISTAS')" class="collapse-item" href="#">Cadastro</a>-->
<!--                <a onclick="clickMenu('LISTA DE ESPECIALISTAS')" class="collapse-item" href="#">Listagem</a>-->
<!--            </div>-->
<!--        </div>-->
<!--    </li>-->

    <!-- Divider -->
<!--    <hr class="sidebar-divider">-->

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a onclick="clickMenu('AGENDAS')"  class="nav-link" href="#">
            <i class="fas fa-fw fa-table"></i>
            <span>Agendas</span></a>
    </li>



    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <div class="sidebar-card">
        <img class="sidebar-card-illustration mb-2" src="public/img/undraw_rocket.svg" alt="">
    </div>

</ul>

<form action="" method="post" id="form_menu_click">
    <input hidden id="page" name="PAGE" value="">
</form>
<!-- End of Sidebar -->
<script>
    function clickMenu(link)
    {
        document.getElementById('page').value = link;
        document.getElementById('form_menu_click').submit();
    }
</script>