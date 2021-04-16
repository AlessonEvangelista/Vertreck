<!-- Content Row -->
<?php
    $page = (isset($_SESSION['page']) ? $_SESSION['page'] : (isset($_SESSION['pagina_back']) ? $_SESSION['pagina_back'] : 'Home') );
?>

<div class="col-lg-12 mb-4">

        <!-- Illustrations -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <?php
                    switch ($page)
                    {
                        case 'LISTA DE LABORATÓRIOS' :
                            echo "<h6 class='m-0 font-weight-bold text-primary' style='float: left;'> {$page} </h6>";
                            echo "<a data-bs-toggle='modal' data-bs-target='#ModalEmpresasExcluidas' onclick='empresasExcluidas()'> <h6 class='font-weight-bold text-primary' style='float: right; cursor: pointer; margin: 0px 15px;'> Laboratórios excluídos </h6> </a>";
                            break;
                        case 'LISTA DE USUARIOS' :
                            echo "<h6 class='m-0 font-weight-bold text-primary' style='float: left;'> {$page} </h6>";
                            echo "<a data-bs-toggle='modal' data-bs-target='#ModalUsuariosApp' onclick='listaUsuariosApp()'> <h6 class='font-weight-bold text-primary' style='float: right; cursor: pointer; margin: 0px 15px;'> USUÁRIOS DO APP </h6> </a>";
                            break;
                        default:
                            echo "<h6 class='m-0 font-weight-bold text-primary'> {$page} </h6>";
                            break;
                    }
                ?>

            </div>
            <div class="card-body">
                <?php
                    switch ($page)
                    {
                        case 'Home':
                            ?>
                            <div class="text-center">

                            </div>
                        <?php
                            break;
                        case 'CADASTRO DE LABORATÓRIOS':
                            ?>
                            <div class="col-lg-12">
                                <form class="needs-validation" action="back/app.php?url=Empresa/create" method="post" name="formEmpresaCreate">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="EmpresaNomeFantasia">Nome Fantasia</label>
                                            <input type="text" name="nome_fantasia" class="form-control" id="EmpresaNomeFantasia" placeholder="Nome Fantasia" required>
                                            <div class="valid-feedback">
                                                ok!
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="EmpresaRAzaoSocial">Razão Social</label>
                                            <input type="text" name="razao_social" class="form-control" id="EmpresaRAzaoSocial" placeholder="Razão Social">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="inputEmpresaCnpj">CNPJ</label>
                                            <input type="text" name="cnpj" class="form-control" id="inputEmpresaCnpj" placeholder="cnpj" onblur="if(!validarCNPJ(this.value)){alert('CNPJ Informado é inválido'); this.value='';}" >
                                            <div class="valid-feedback">
                                                ok!
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="EmpresaCadEmail">EMAIL</label>
                                            <input type="text" name="email" class="form-control" id="EmpresaCadEmail" placeholder="email" required>
                                            <div class="valid-feedback">
                                                ok!
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="EmpresaEndereco">Endereço</label>
                                            <input type="text" name="endereco" class="form-control" id="EmpresaEndereco" placeholder="Rua dos Bobos, nº 0">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="EmpresaBairro">Bairro</label>
                                            <input type="text" name="bairro" class="form-control" id="EmpresaBairro" placeholder="Jd. Barcellos... " >
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="EmpresaTelefone">Telefone</label>
                                            <input type="text" name="telefone" class="form-control" id="EmpresaTelefone" placeholder="(11)3633-3333" >
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label for="EmpresaCelular">Celular</label>
                                            <input type="text" name="celular" class="form-control" id="EmpresaCelular" placeholder="(14)99999-9999" >
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="sltEmpresaEstado">Estado</label>
                                            <select name="estado" id="sltEmpresaEstado" class="form-control" required>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="sltEmpresaCidade">Cidade</label>
                                            <select name="cidade" id="sltEmpresaCidade" class="form-control" required>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="sltEmpresaTipo">Tipo Empresa</label>
                                            <select name="tipo" id="sltEmpresaTipo" class="form-control" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="descricaoAgenda">MENSAGEM AGENDA USUÁRIO</label>
                                            <input type="text" name="descricao_agenda" class="form-control" id="descricaoAgenda" value="Para atendimento nesse local será necessário agendamento prévio. Entre em contato com um dos canais de atendimento relacionados acima." >
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Entrar</button>
                                </form>
                            </div>
                            <?php
                            break;
                        case 'LISTA DE LABORATÓRIOS':
                            ?>
                            <div class="col-md-12">
                                <table class="table table-sm" id="tableListEmpresa" >
                                    <thead class="thead-dark" >
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col">Nome Fantasia</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Tel/Cel</th>
                                        <th scope="col">Cidade</th>
<!--                                        <th scope="col">Agenda</th>-->
                                        <th scope="col">Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tableListTbodyEmpresa">

                                    </tbody>
                                </table>
                            </div>
                            <?php
                            break;
                        case 'CADASTRO DE USUARIOS':
                            ?>
                            <div class="col-lg-12">
                                <form action="back/app.php?url=Usuario/create" method="post" name="formUsuarioCreate">
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="sltUsuarioTipo">TIPO USUÁRIO</label>
                                            <select name="tipo" id="sltUsuarioTipo" class="form-control" required>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="sltUsuarioEmpresa">EMPRESA</label>
                                            <select name="empresa" id="sltUsuarioEmpresa" class="form-control" required>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="cpf">CPF</label>
                                            <input name="cpf" type="text" class="form-control" id="cpf" placeholder="cpf" required>
                                        </div>

                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="nome">NOME</label>
                                            <input name="nome" type="text" class="form-control" id="nome" placeholder="nome" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email">EMAIL</label>
                                            <input name="email" type="email" class="form-control" id="email" placeholder="email" required>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label for="telefone">TELEFONE</label>
                                            <input name="telefone" type="text" class="form-control" id="telefone" placeholder="telefone" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="data_nascimento">DATA NASCIMENTO</label>
                                            <input name="data_nascimento" type="date" class="form-control" id="data_nascimento" placeholder="01/01/2021" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="senha">SENHA</label>
                                            <input name="senha" type="password" class="form-control" id="senha" placeholder="senha" required>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Entrar</button>
                                </form>
                            </div>
                            <?php
                            break;
                        case 'LISTA DE USUARIOS':
                            ?>
                            <div class="col-md-12">
                                <table class="table table-sm" id="tableListUsuario">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Empresa</th>
                                        <th scope="col">Telefone</th>
                                    </tr>
                                    </thead>
                                    <tbody  id="tableListTbodyUsuario">

                                    </tbody>
                                </table>
                            </div>
                            <?php
                            break;
                        case 'CADASTRO SERVICOS':
                            ?>
                            <div class="col-lg-12">
                                <div class="card position-relative">

                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">SERVIÇOS</h6>
                                    </div>
                                    <div class="card-body">
                                        <form action="back/app.php?url=Exames/createServico" method="post" name="formServicosCreate">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="ServicoNome">NOME</label>
                                                    <input name="nome" type="text" class="form-control" id="ServicoNome" placeholder="nome" required>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Entrar</button>
                                        </form>
                                    </div>

                                </div>

                            </div>
                            <br>
                            <div class="col-lg-12">
                                <div class="card position-relative">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">EXAMES</h6>
                                    </div>
                                    <div class="card-body">
                                        <form action="back/app.php?url=Exames/createExame" method="post" name="formExameCreate">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="sltServicoExame">SERVIÇO</label>
                                                    <select name="servico" id="sltServicoExame" class="form-control" required>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <div class="form-group">
                                                        <label for="ServicoExame">EXAME</label>
                                                        <input name="exame" type="text" class="form-control" id="ServicoExame" placeholder="nome" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <label for="Servicoprecobruto">PREÇO UNITARIO</label>
                                                    <input name="preco_unit" type="text" class="form-control" id="Servicoprecobruto" placeholder="R$ 250,00">
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <div class="form-group">
                                                        <label for="Servicoprecoliquido">PREÇO PARCIAL</label>
                                                        <input name="preco_parc" type="text" class="form-control" id="Servicoprecoliquido" placeholder="R$ 250,00">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Entrar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <?php
                            break;
                        case 'LISTA DE SERVICOS':
                            ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-sm">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Serviço</th>
                                            <th scope="col">Ações</th>
                                        </tr>
                                        </thead>
                                        <tbody id="tblsServicosExames"></tbody>
                                    </table>
                                </div>
                                <div class="col-md-6" >
                                    <table class="table table-sm">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Exame</th>
                                            <th scope="col">Preço Unit.</th>
                                            <th scope="col">Preço Parc.</th>
                                            <th scope="col">Ações</th>
                                        </tr>
                                        </thead>
                                        <tbody id="tblsExamesServicos"></tbody>
                                    </table>
                                </div>
                            </div>
                            <?php
                            break;
                        case 'EMPRESA EXAME':
                            ?>
                                <div class="col-md-12">
                                    <form action="back/app.php?url=Exames/setarEmpresa" method="post" name="formServicosCreate">
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="pgEmpresaExameEmpresa">Empresa:</label>
                                                <select name="pgEmpresaExameEmpresa" id="pgEmpresaExameEmpresa" class="form-control"></select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="pgEmpreesaExameServico">Serviço:</label>
                                                <select name="pgEmpresaExameServico" id="pgEmpresaExameServico" class="form-control"></select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="pgAgendaExame">Exame:</label>
                                                <select name="pgEmpresaExameExame[]" id="pgEmpresaExameExame" class="form-control" multiple aria-label="multiple select example"></select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Entrar</button>
                                        </div>
                                    </form>
                                </div>
                                <hr>
                                <div class="col-md-12">
                                    <div class="card position-relative">

                                        <div class="card-header py-3">
                                            <h6 class="m-0 font-weight-bold text-primary">EMPRESAS - EXAMES</h6>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6" style="padding: 20px">
                                                <div style="min-height: 250px; height: 250px; max-height: 250px; overflow-y: scroll;">
                                                    <table class="table table-bordered border-primary" id="pgEmpresaExameTblEmpresaList">
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="padding: 20px">
                                                <div style="min-height: 250px; height: 250px; max-height: 250px; overflow-y: scroll;"">
                                                <table class="table table-bordered border-primary" id="pgEmpresaExameTblExameList">
                                                </table>
                                            </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            <?php
                            break;
                        case 'AGENDAS':
                            ?>
                                <div class="col-md-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="pgAgendaEmpresa">Empresa:</label>
                                            <select name="pgAgendaEmpresa" id="pgAgendaEmpresa" class="form-control"></select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="pgAgendaExame">Exame:</label>
                                            <select name="pgAgendaExame" id="pgAgendaExame" class="form-control"></select>
                                        </div>
                                    </div>
                                    <hr>

                                    <div class="row">
                                        <div class="col-md-1"></div>
                                        <div class="col-md-10">
                                            <table class="table table-sm">
                                                <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Empresa</th>
                                                    <th scope="col">Exame</th>
                                                    <th scope="col">De</th>
                                                    <th scope="col">Hà</th>
                                                </tr>
                                                </thead>
                                                <tbody id="tblsListAgenda">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            break;
                    }
                ?>
            </div>
        </div>

    </div>

<script>
    window.onload = function () {
        <?php if($page === 'LISTA DE LABORATÓRIOS') { echo "getEmpresaList();"; } ?>
        <?php if($page === 'LISTA DE USUARIOS') { echo "getUsuarioList();"; } ?>
        <?php if($page === 'LISTA DE SERVICOS') { echo "getServicoExameList();"; } ?>
        <?php
            if($page === 'EMPRESA EXAME') {
                echo "getServicoExameCombo('pgEmpresaExameServico');";
                echo "getEmpresaExameList();";
            }
        ?>

        $('#pgEmpresaExameExame').multiselect({
            enableFiltering: true,
            enableCaseInsensitiveFiltering: true,
            buttonWidth:'100%',
            nSelectedText: 'selecione.',
            nonSelectedText: 'selecione...'
        });
    }

    function getTipos(select, service)
    {
        var selectbox = $('#'+select);
        if(selectbox.find('option').length === 0) {
            $.ajax({
                url: "back/api.php?url=Combo/get"+service+"Tipo",
                method: "post",
                success: function (obj) {

                    if (obj != null) {
                        var data = obj.data;
                        selectbox.multiselect('destroy');
                        let params = [{label: "Selecione...", value: 0}];
                        $.each(data, function (i, d) {
                            params.push({ label: d.tipo, value: d.id});
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
    }

    function getEstado(combo)
    {
        var selectbox = $('#'+combo);
        if(selectbox.find('option').length === 0) {
            $.ajax({
                url: "back/api.php?url=Combo/getEstado",
                method: "post",
                success: function (obj) {

                    if (obj != null) {
                        var data = obj.data;

                        selectbox.find('option').remove();
                        $.each(data, function (i, d) {
                            $('<option>').val(d.id).text(d.nome).appendTo(selectbox);
                        });
                    }

                }
            });
        }
    }

    function getCidade(comboEstado, comboCidade)
    {
        var estado = $('#'+comboEstado);
        var estadoSelecionado = $('#'+comboEstado).find('option:selected').val();

        if (typeof estadoSelecionado === 'undefined'){
            alert("Selecione um estado para prosseguir");
            return;
        }
        var selectbox = $('#'+comboCidade);
        if(selectbox.find('option').length === 0) {
            $.ajax({
                url: "back/api.php?url=Combo/getCidade/"+estadoSelecionado,
                method: "post",
                success: function (obj) {

                    if (obj != null) {
                        var data = obj.data;
                        selectbox.find('option').remove();
                        $.each(data, function (i, d) {
                            $('<option>').val(d.id).text(d.nome).appendTo(selectbox);
                        });
                    }
                }
            });
        }
    }

    function getEmpresaCombo(tipo, select)
    {
        var selectbox = $('#'+select);

        // if( selectbox.find('option').length === 0 || ( (selectbox.find('option').length === 0) === (select !== 'pgAgendaEmpresa') ) ) {
            $.ajax({
                url: "back/api.php?url=Combo/getEmpresaCombo/" + tipo,
                method: "post",
                success: function (obj) {
                    if (obj != null) {
                        let data = obj.data;

                        selectbox.multiselect('destroy');
                        let params = [{label: "Selecione...", value: 0}];

                        $.each(data, function (i, d) {
                            params.push({ label: d.nome_fantasia, value: d.id});
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
        // }
    }

    function getEmpresaList()
    {
        var trHTML;
        $.ajax({
            url: "back/api.php?url=Combo/getEmpresaList/1",
            method: "get",
            success: function (obj) {
                if (obj != null) {
                    var data = obj.data;

                    $.each(data, function (i, d) {
                        $.each(Object.keys(d), function (x, y) {
                            if(data[i][y] === null || data[i][y] === "") {
                                data[i][y] = "---";
                            }
                        })
                        trHTML += '' +
                            '<tr> ' +
                            '<td>' + data[i].id + '</td>' +
                            '<td>' + data[i].tipo + '</td>' +
                            '<td>' + data[i].nome_fantasia + '</td>' +
                            '<td>' + data[i].email + '</td>' +
                            '<td>' + data[i].telefone + ' / ' + data[i].celular + '</td>' +
                            '<td>' + data[i].cidade + '</td> ' +
                            // TODO COMENTADO VISTO NO MOMENTO NÃO ESTAR UTILIZANDO A AGENDA
                            // '<td> <button type="button" class="btn btn-sm btn-outline-success" onclick="showAgendaModal('+data[i].id+', `'+data[i].nome_fantasia+'`)"> Definir Agenda</button> </td> ' +
                            '<td> ' +
                                '<div class="btn-group" role="group">' +
                                    '<button type="button" class="btn btn-sm btn-outline-primary" onclick="editarModal(`1`, '+data[i].id+')"> Editar</button> ' +
                                    '<button type="button" class="btn btn-sm btn-outline-danger" onclick="excluirRegistro(`1`, '+data[i].id+')"> Excluir</button> ' +
                                '</div>' +
                            '</td> ' +
                            '</tr>';
                    });
                    $('#tableListTbodyEmpresa').empty().append(trHTML);
                }
            }
        });
    }

    function getUsuarioList()
    {
        var trHTML;
        $.ajax({
            url: "back/api.php?url=Combo/getUsuarioList",
            method: "get",
            success: function (obj) {

                if (obj != null) {
                    var data = obj.data;

                    $.each(data, function (i, d) {
                        trHTML += '<tr> <td>' + data[i].id + '</td><td>' + data[i].nome + '</td><td>' + data[i].email + '</td><td>' + data[i].empresa + '</td><td>' + data[i].telefone + '</td> </tr>';
                    });
                    $('#tableListTbodyUsuario').append(trHTML);
                }
            }
        });
    }

    function getServico()
    {
        var selectbox = $('#sltServicoExame');
        if(selectbox.find('option').length === 0) {
            $.ajax({
                url: "back/api.php?url=Combo/getServico",
                method: "post",
                success: function (obj) {

                    if (obj != null) {
                        var data = obj.data;
                        selectbox.find('option').remove();
                        $.each(data, function (i, d) {
                            $('<option>').val(d.id).text(d.nome).appendTo(selectbox);
                        });
                    }
                }
            });
        }
    }

    function getServicoExameList()
    {
        var trHTML;
        $.ajax({
            url: "back/api.php?url=Combo/getServicoExameList",
            method: "get",
            success: function (obj) {

                if (obj != null) {
                    var data = obj.data;
                    $.each(data, function (i, d) {
                        $.each(Object.keys(d), function (x, y) {
                            if(data[i][y] === null || data[i][y] === "") {
                                data[i][y] = "---";
                            }
                        });
                        trHTML += '<tr class="trServicoExameList_All" id="trServicoExameList_'+data[i].id+'" onclick="getExameServicoList(`'+data[i].id+'`)" > ' +
                            '<td style="cursor: pointer" >' + data[i].id + '</td>' +
                            '<td style="cursor: pointer" >' + data[i].nome + '</td> ' +
                            '<td> ' +
                                '<button class="btn btn-warning" style="float: left; " onclick="deletarservico(' + data[i].id + ')"> deletar </button> ' +
                                '<i style="font-size: 25px; text-align: center; padding: 8px 0 0 10px; " class="fas fa-angle-right"></i> ' +
                            '</td> ' +
                            '</tr>';
                    });
                    $('#tblsServicosExames').empty().append(trHTML);
                }
            }
        });
    }

    function deletarservico(id)
    {
        $.ajax({
            url: "back/api.php?url=Combo/deletarServico/" + id,
            method: "get",
            success: function (obj) {

                if (obj != null) {
                    alert(obj.data);
                    getServicoExameList();
                }
            }
        });
    }
    function getExameServicoList( id )
    {
        $(".trServicoExameList_All").css("color", "#858796");
        $("#trServicoExameList_"+id).css("color", "blue")
        var trHTML;
        $.ajax({
            url: "back/api.php?url=Combo/getExameServicoList/"+ id,
            method: "get",
            success: function (obj) {

                if (obj != null) {
                    var data = obj.data;
                    $.each(data, function (i, d) {
                        $.each(Object.keys(d), function (x, y) {
                            if(data[i][y] === null || data[i][y] === "") {
                                data[i][y] = "---";
                            }
                        });
                        trHTML += '<tr> ' +
                            '<td>' + data[i].id + '</td>' +
                            '<td>' + data[i].exame + '</td>' +
                            '<td>' + data[i].preco_unit + '</td>' +
                            '<td>' + data[i].preco_parc + '</td>' +
                            '<td> <button class="btn btn-danger" style="float: left; " onclick="deletarExame(' + id + ', ' + data[i].id + ')"> deletar </button> </td>' +
                            '</tr>';
                    });
                    $('#tblsExamesServicos').empty().append(trHTML);
                }
            }
        });
    }
    function deletarExame(servico, id)
    {
        $.ajax({
            url: "back/api.php?url=Combo/deletarExame/" + id,
            method: "get",
            success: function (obj) {

                if (obj != null) {
                    alert(obj.data);
                    getExameServicoList(servico);
                }
            }
        });
    }

    function getServicoExameCombo( combo )
    {
        var selectbox = $('#'+combo);
        $.ajax({
            url: "back/api.php?url=Combo/getServicoExameList",
            method: "get",
            success: function (obj) {

                if (obj != null) {
                    var data = obj.data;

                    selectbox.multiselect('destroy');
                    let params = [{label: "Selecione...", value: 0}];

                    $.each(data, function (i, d) {
                        params.push({ label: d.nome, value: d.id});
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

    function getExameServicoCombo( id, combo )
    {
        var selectbox = $('#'+combo);
        $.ajax({
            url: "back/api.php?url=Combo/getExameServicoList/"+id,
            method: "post",
            success: function (obj) {
                if (obj != null) {
                    var data = obj.data;
                    selectbox.multiselect('destroy');
                    // selectbox.find('option').remove();
                    let params=[]
                    $.each(data, function (i, d) {
                        params.push({ label: d.exame, value: d.id});
                    });
                    selectbox.multiselect({
                        enableFiltering: true,
                        enableCaseInsensitiveFiltering: true,
                        buttonWidth:'100%',
                        nonSelectedText: 'selecione...'
                    });
                    selectbox.multiselect('dataprovider', params);
                }
            }
        });
    }

    function getExameCombo(combo, empresa)
    {
        var selectbox = $('#'+combo);
        $.ajax({
            url: "back/api.php?url=Combo/getExameCombo",
            method: "post",
            data: {'empresa': empresa},
            success: function (obj) {

                if (obj != null) {
                    var data = obj.data;
                    selectbox.find('option').remove();
                    $.each(data, function (i, d) {
                        $('<option>').val(d.id).text(d.exame).appendTo(selectbox);
                    });
                }
            }
        });
    }

    function getAgendaList()
    {
        var trHTML;
        $.ajax({
            url: "back/api.php?url=Combo/getAgendaList",
            method: "post",
            data: {
                'empresa': $('#pgAgendaEmpresa').val(),
                'exame': $('#pgAgendaExame').val()
            },
            success: function (obj) {

                if (obj != null) {
                    var data = obj.data;

                    $.each(data, function (i, d) {
                        trHTML += '<tr> <td>' + data[i].id + '</td><td>' + data[i].empresa + '</td><td>' + data[i].exame + '</td>' +
                            '<td>' + data[i].dt_inicio + '</td><td>' + data[i].dt_fim + '</td> </tr>';
                    });
                    $('#tblsListAgenda').empty().append(trHTML);
                }
            }
        });
    }

    function setEmpresaToExame()
    {
        var trHTML;
        $.ajax({
            url: "back/api.php?url=Combo/getEmpresaIntoExame",
            method: "post",
            data: {
                'exame': $('#pgAgendaExame').val()
            },
            success: function (obj) {

                if (obj != null) {
                    var data = obj.data;

                    var selectbox = $('#pgAgendaEmpresa');
                    selectbox.find('option').remove();
                    $('<option>').val(data.id).text(data.nome_fantasia).appendTo(selectbox);
                    $('#pgAgendaEmpresa option').attr('selected', 'selected');
                    // $("#pgAgendaEmpresa select").val("val2");
                }
            }
        });
    }

    function getEmpresaExameList()
    {
        var trHTML;
        $.ajax({
            url: "back/api.php?url=Combo/getAllEmpresaList",
            method: "get",
            success: function (obj) {

                if (obj != null) {
                    var data = obj.data;
                    $.each(data, function (i, d) {
                        $.each(Object.keys(d), function (x, y) {
                            if(data[i][y] === null || data[i][y] === "") {
                                data[i][y] = "---";
                            }
                        })
                        let end = data[i].endereco;
                        trHTML += '' +
                            '<tr> ' +
                            '<td id="tblExamesToEmpresaLbl_'+data[i].id+'" class="tblExamesToEmpresaLbl_All" onclick="getExamesToEmpresa(' + data[i].id + ')" style="padding: 10px 15px; cursor: pointer; ">' +
                                data[i].id +' - '+ data[i].nome_fantasia + ' - Endereço: '+ end.substring(0, 20) +'... </td>' +
                            '</tr>';
                    });
                    $('#pgEmpresaExameTblEmpresaList').append(trHTML);
                }
            }
        });
    }

    function getExamesToEmpresa(empresa)
    {
        $("#pgEmpresaExameTblExameList tr").detach();

        var trHTML;
        $.ajax({
            url: "back/api.php?url=Combo/getExamesToEmpresaList",
            method: "post",
            data: {
                'empresa': empresa
            },
            success: function (obj) {

                if (obj != null) {
                    var data = obj.data;
                    $.each(data, function (i, d) {
                        $.each(Object.keys(d), function (x, y) {
                            if(data[i][y] === null || data[i][y] === "") {
                                data[i][y] = "---";
                            }
                        })
                        trHTML += '' +
                            '<tr> ' +
                            '<td style="padding: 10px 15px; cursor: pointer; ">' + data[i].exame + '</td>' +
                            '<td> <i class="fas fa-minus-circle" onclick="excluirRegistro(`2`, `'+data[i].id+'`)" style="font-size: 22px; text-align: right; color: red;" ></i> </td>'
                            '</tr>';
                    });
                    $('#pgEmpresaExameTblExameList').append(trHTML);
                }
            }
        });

        let qtdExameEmpresaList = document.getElementsByClassName("tblExamesToEmpresaLbl_All").length;
        for (var i=0; i < qtdExameEmpresaList; i++ )
        {
            document.getElementsByClassName("tblExamesToEmpresaLbl_All")[i].style.color = '#858796';
        }

        document.getElementById("tblExamesToEmpresaLbl_"+empresa).style.color = "blue";

    }

    let AgendaModal=null;
    function showAgendaModal(id, nome)
    {
        $('#mdlAgendamentoTitle').empty().append(nome);
        document.getElementById('mdlAgendaEmpresaPadrao').value = id;
        document.getElementById('mdlAgendaEmpresaExame').value = id;

        AgendaModal = new bootstrap.Modal(document.getElementById('AgendaModal'));
        AgendaModal.show()
    }

    let modal=null;
    function editarModal(intro, id)
    {
        let tblHtml = "";
        switch(intro) {
            case "1" :
                tblHtml = getEmpresaById(id);
                break;
        }

        modal = new bootstrap.Modal(document.getElementById('EditarModal'));
        modal.show()
    }

    let empresasExcluidasModal=null;
    function empresasExcluidas()
    {
        empresasExcluidasModal = new bootstrap.Modal(document.getElementById('ModalEmpresasExcluidas'));
        empresasExcluidasModal.show();

        var trHTML;
        $.ajax({
            url: "back/api.php?url=Combo/getEmpresaList/0",
            method: "get",
            success: function (obj) {
                if (obj != null) {
                    var data = obj.data;

                    $.each(data, function (i, d) {
                        $.each(Object.keys(d), function (x, y) {
                            if(data[i][y] === null || data[i][y] === "") {
                                data[i][y] = "---";
                            }
                        })
                        trHTML += '' +
                            '<tr> ' +
                            '<td>' + data[i].id + '</td>' +
                            '<td>' + data[i].tipo + '</td>' +
                            '<td>' + data[i].nome_fantasia + '</td>' +
                            '<td>' + data[i].email + '</td>' +
                            '<td>' + data[i].cidade + '</td> ' +
                            // '<td> <button type="button" class="btn btn-sm btn-outline-success" onclick="showAgendaModal('+data[i].id+', `'+data[i].nome_fantasia+'`)"> Definir Agenda</button> </td> ' +
                            '<td> ' +
                                '<button type="button" class="btn btn-sm btn-outline-success" onclick="ativarEmpresa('+data[i].id+')">Ativar empresa</button> ' +
                            '</td> ' +
                            '</tr>';
                    });
                    $('#tableListTbodyEmpresasExcluidas').empty().append(trHTML);
                }
            }
        });
    }

    let listaUsuariosAppModal=null;
    function listaUsuariosApp()
    {
        listaUsuariosAppModal = new bootstrap.Modal(document.getElementById('ModalListaUsuariosApp'));
        listaUsuariosAppModal.show();

        let trHTML;
        $.ajax({
            url: "back/api.php?url=Combo/getUsuarioAppList",
            method: "get",
            success: function (obj) {
                if (obj != null) {
                    var data = obj.data;

                    $.each(data, function (i, d) {
                        $.each(Object.keys(d), function (x, y) {
                            if(data[i][y] === null || data[i][y] === "") {
                                data[i][y] = "---";
                            }
                        })
                        trHTML += '' +
                            '<tr> ' +
                            '<td>' + data[i].id + '</td>' +
                            '<td>' + data[i].nome + '</td>' +
                            '<td>' + data[i].email + '</td>' +
                            '<td>' + data[i].cpf.substr( 0, 3 ) + ' ... ' + data[i].cpf.substr( data[i].cpf.length - 3, 3 ) + '</td>' +
                            '<td>' + data[i].telefone + '</td> ' +
                            // '<td> <button type="button" class="btn btn-sm btn-outline-success" onclick="showAgendaModal('+data[i].id+', `'+data[i].nome_fantasia+'`)"> Definir Agenda</button> </td> ' +
                            '<td> ' +
                            // '<button type="button" class="btn btn-sm btn-outline-success" onclick="ativarEmpresa('+data[i].id+')">Ativar empresa</button> ' +
                                ' -- ' +
                            '</td> ' +
                            '</tr>';
                    });
                    $('#tableListTbodyUsuarioApp').empty().append(trHTML);
                }
            }
        });
    }

    function ativarEmpresa(id)
    {
        if (window.confirm("Tem certeza que reativar este registro?")) {
            $.ajax({
                url: "back/api.php?url=Combo/ativarEmpresa/" + id,
                method: "get",
                success: function (obj) {
                    let ret = JSON.parse(obj.data);
                    alert(ret.data);

                    getEmpresaList();
                    closeEmpresasExcluidasModal();
                }
            });
        }
    }

    function excluirRegistro(intro, id)
    {
        // GET SERVICE TO USE FUNCTION IN WATHEVER SERVICE
        let service = "";
        if (intro === "1") { service = "deleteEmpresa"; }
        if (intro === "2") { service = "deleteVinculoEmpresaExame"; }

        if (window.confirm("Tem certeza que quer excluir esse registro?")) {
            $.ajax({
                url: "back/api.php?url=Combo/" + service + "/" + id,
                method: "get",
                success: function (obj) {
                    let ret = JSON.parse(obj.data);
                    alert(ret.data);
                    if(intro === "1") { getEmpresaList(); }
                    if(intro === "2") { document.location.reload(true); }
                }
            });
        }
    }

    function getEmpresaById(id)
    {
        $.ajax({
            url: "back/api.php?url=Combo/getEmpresaById/"+id,
            method: "post",
            success: function (obj) {
                if (obj != null) {
                    let data = obj.data;

                    montaFormEmpresa(data);
                }
            }
        });
    }

    function montaFormEmpresa(data)
    {
        let html = '<div class="col-lg-12">' +
            '<form class="needs-validation" action="back/app.php?url=Empresa/update" method="post" name="formEmpresaCreate">' +
                '<div class="form-row">' +
                    '<div class="form-group col-md-6">' +
                        '<label for="EmpresaNomeFantasia">Nome Fantasia</label>' +
                        '<input type="hidden" name="id" id="EmpresaId" value="'+data.id+'">' +
                        '<input type="text" name="nome_fantasia" class="form-control" id="EmpresaNomeFantasia" value="'+data.nome_fantasia+'" required>' +
                    '</div>' +
                    '<div class="form-group col-md-6">' +
                        '<label for="EmpresaRAzaoSocial">Razão Social</label>' +
                        '<input type="text" name="razao_social" class="form-control" id="EmpresaRAzaoSocial" value="'+data.razao_social+'" >' +
                    '</div>' +
                '</div>' +
                '<div class="form-row">' +
                    '<div class="form-group col-md-6">' +
                        '<label for="inputEmpresaCnpj">CNPJ</label>' +
                        '<input type="text" name="cnpj" class="form-control" id="inputEmpresaCnpj" value="'+data.cnpj+'" >' +
                    '</div>' +
                    '<div class="form-group col-md-6">' +
                        '<label for="EmpresaCadEmail">EMAIL</label>' +
                        '<input type="text" name="email" class="form-control" id="EmpresaCadEmail" value="'+data.email+'" required>' +
                    '</div>' +
                '</div>' +
                '<div class="form-row">' +
                    '<div class="form-group col-md-3">' +
                        '<label for="EmpresaEndereco">Endereço</label>' +
                        '<input type="text" name="endereco" class="form-control" id="EmpresaEndereco" value="'+data.endereco+'" >' +
                    '</div>'+
                    '<div class="form-group col-md-3">'+
                        '<label for="EmpresaBairro">Bairro</label>'+
                        '<input type="text" name="bairro" class="form-control" id="EmpresaBairro" value="'+data.bairro+'" >'+
                    '</div>'+
                    '<div class="form-group col-md-3">'+
                        '<label for="EmpresaTelefone">Telefone</label>'+
                        '<input type="text" name="telefone" class="form-control" id="EmpresaTelefone" value="'+data.telefone+'">'+
                    '</div>'+
                    '<div class="form-group col-md-3">'+
                        '<label for="EmpresaCelular">Celular</label>'+
                        '<input type="text" name="celular" class="form-control" id="EmpresaCelular" value="'+data.celular+'">'+
                    '</div>'+
                '</div>'+
                '<div class="form-row">'+
                    '<div class="form-group col-md-4">'+
                        '<label for="mdlUpdateEmpresaEstado">Estado</label>'+
                        '<select name="estado" id="mdlUpdateEmpresaEstado" class="form-control" required>' +
                            '<option value="'+ data.estadoId +'" selected> '+data.estado+' </option> ' +
                        '</select>'+
                    '</div>'+
                    '<div class="form-group col-md-6">'+
                        '<label for="sltEmpresaCidade">Cidade</label>'+
                        '<select name="cidade" id="mdlUpdateEmpresaCidade" class="form-control" required>' +
                            '<option value="'+data.cidadeId+'" selected> '+data.cidade+' </option> ' +
                        '</select>'+
                    '</div>'+
                    '<div class="form-group col-md-2">'+
                        '<label for="sltEmpresaTipo">Tipo Empresa</label>'+
                        '<select name="tipo" id="mdlUpdateEmpresaTipo" class="form-control" required>' +
                            '<option value="'+data.tipoId+'" selected> '+data.tipo+' </option> ' +
                        '</select>'+
                    '</div>'+
                '</div>'+
                '<div class="form-row">' +
                    '<div class="form-group col-md-12">'+
                        '<label for="mdlUpdtdescricaoAgenda">Mensagem Agenda Usuário</label>'+
                        '<input type="text" name="descricao_agenda" class="form-control" id="mdlUpdtdescricaoAgenda" value="'+data.descricao_agenda+'">'+
                    '</div>'+
                '</div>' +
                '<button type="submit" class="btn btn-primary">Entrar</button>'+
            '</form>'+
        '</div>';

        $('#EditarModalIntro').empty().append(html);
        return true;
    }

    function closeAgendaModal() { if(AgendaModal !== null) { AgendaModal.hide() }}
    function closeEditarModal() { if(modal !== null) { modal.hide() }}
    function closeEmpresasExcluidasModal() { if(empresasExcluidasModal !== null) { empresasExcluidasModal.hide() }}
    function closeListaUsuariosApp() { if(listaUsuariosAppModal !== null) { listaUsuariosAppModal.hide() }}

</script>

<!-- AGENDA Modal-->
<div class="modal fade" id="AgendaModal" tabindex="-1" role="dialog" aria-labelledby="AgendaModal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mdlAgendamentoTitle"></h5>
                <a id="CloseAgendaModal" style="cursor: pointer;" onclick="closeAgendaModal()"> X </a>
            </div>
            <div class="modal-body" >
                <h5> Horário de atendimento: </h5>
                <div class="tab">
                    <button class="btn btn-outline-primary tablinks" onclick="openCity(event, 'AgendaPadrão')">Padrão</button>
                    <button class="btn btn-outline-primary tablinks" onclick="openCity(event, 'AgendaExame')">Exame</button>
                </div>

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane tabcontent" id="AgendaPadrão" style="display: block;">

                        <p> <small>Horário padrão para atendimentos no laboratório*</small> </p>
                        <form action="back/app.php?url=Agenda/createLabAgenda" method="post" name="frmMdlAgdCreatePadrao">
                            <input type="hidden" name="empresa" id="mdlAgendaEmpresaPadrao">

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inpModalAgendamentoDe">De:</label>
                                    <select name="dia_inicial" id="inpModalAgendamentoDe" class="form-control">
                                        <option value="segunda"> Segunda </option>
                                        <option value="terca"> Terça </option>
                                        <option value="quarta"> Quarta </option>
                                        <option value="quinta"> Quinta </option>
                                        <option value="sexta"> Sexta </option>
                                        <option value="sabado"> Sábado </option>
                                        <option value="domingo"> Domingo </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inpModalAgendamentoAHr">.</label>
                                    <select name="hora_inicial" id="inpModalAgendamentoDeHr" class="form-control">
                                        <option value="06:00"> 06:00 </option>
                                        <option value="07:00"> 07:00 </option>
                                        <option value="08:00"> 08:00 </option>
                                        <option value="09:00"> 09:00 </option>
                                        <option value="10:00"> 10:00 </option>
                                        <option value="11:00"> 11:00 </option>
                                        <option value="12:00"> 12:00 </option>
                                        <option value="13:00"> 13:00 </option>
                                        <option value="14:00"> 14:00 </option>
                                        <option value="15:00"> 15:00 </option>
                                        <option value="16:00"> 16:00 </option>
                                        <option value="17:00"> 17:00 </option>
                                        <option value="18:00"> 18:00 </option>
                                        <option value="19:00"> 19:00 </option>
                                        <option value="20:00"> 20:00 </option>
                                        <option value="21:00"> 21:00 </option>
                                        <option value="22:00"> 22:00 </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inpModalAgendamentoA">Ha:</label>
                                    <select name="dia_final" id="inpModalAgendamentoA" class="form-control">
                                        <option value="segunda"> Segunda </option>
                                        <option value="terca"> Terça </option>
                                        <option value="quarta"> Quarta </option>
                                        <option value="quinta"> Quinta </option>
                                        <option value="sexta"> Sexta </option>
                                        <option value="sabado"> Sábado </option>
                                        <option value="domingo"> Domingo </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inpModalAgendamentoAHr">.</label>
                                    <select name="hora_final" id="inpModalAgendamentoAHr" class="form-control">
                                        <option value="06:00"> 06:00 </option>
                                        <option value="07:00"> 07:00 </option>
                                        <option value="08:00"> 08:00 </option>
                                        <option value="09:00"> 09:00 </option>
                                        <option value="10:00"> 10:00 </option>
                                        <option value="11:00"> 11:00 </option>
                                        <option value="12:00"> 12:00 </option>
                                        <option value="13:00"> 13:00 </option>
                                        <option value="14:00"> 14:00 </option>
                                        <option value="15:00"> 15:00 </option>
                                        <option value="16:00"> 16:00 </option>
                                        <option value="17:00"> 17:00 </option>
                                        <option value="18:00"> 18:00 </option>
                                        <option value="19:00"> 19:00 </option>
                                        <option value="20:00"> 20:00 </option>
                                        <option value="21:00"> 21:00 </option>
                                        <option value="22:00"> 22:00 </option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button class="btn btn-primary me-md-2" type="submit">Salvar horário Padrão</button>
                            </div>
                        </form>

                    </div>
                    <div class="tab-pane tabcontent" id="AgendaExame" >

                        <p> <small>Horário para atendimentos de exames específicos*</small> </p>
                        <form action="back/app.php?url=Agenda/createLabAgenda" method="post" name="frmMdlAgdCreateExame">
                            <input type="hidden" name="empresa" id="mdlAgendaEmpresaExame">

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="mdlSltAgendamentoExame">Exame:</label>
                                    <select name="mdlAgendaExame" id="mdlSltAgendamentoExame" class="form-control">
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inpModalAgendamentoDe">De:</label>
                                    <select name="dia_inicial" id="inpModalAgendamentoDe" class="form-control">
                                        <option value="segunda"> Segunda </option>
                                        <option value="terca"> Terça </option>
                                        <option value="quarta"> Quarta </option>
                                        <option value="quinta"> Quinta </option>
                                        <option value="sexta"> Sexta </option>
                                        <option value="sabado"> Sábado </option>
                                        <option value="domingo"> Domingo </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inpModalAgendamentoDeHr">.</label>
                                    <select name="hora_inicial" id="inpModalAgendamentoDeHr" class="form-control">
                                        <option value="06:00"> 06:00 </option>
                                        <option value="07:00"> 07:00 </option>
                                        <option value="08:00"> 08:00 </option>
                                        <option value="09:00"> 09:00 </option>
                                        <option value="10:00"> 10:00 </option>
                                        <option value="11:00"> 11:00 </option>
                                        <option value="12:00"> 12:00 </option>
                                        <option value="13:00"> 13:00 </option>
                                        <option value="14:00"> 14:00 </option>
                                        <option value="15:00"> 15:00 </option>
                                        <option value="16:00"> 16:00 </option>
                                        <option value="17:00"> 17:00 </option>
                                        <option value="18:00"> 18:00 </option>
                                        <option value="19:00"> 19:00 </option>
                                        <option value="20:00"> 20:00 </option>
                                        <option value="21:00"> 21:00 </option>
                                        <option value="22:00"> 22:00 </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">

                                <div class="form-group col-md-6">
                                    <label for="inpModalAgendamentoA">Ha:</label>
                                    <select name="dia_final" id="inpModalAgendamentoA" class="form-control">
                                        <option value="segunda"> Segunda </option>
                                        <option value="terca"> Terça </option>
                                        <option value="quarta"> Quarta </option>
                                        <option value="quinta"> Quinta </option>
                                        <option value="sexta"> Sexta </option>
                                        <option value="sabado"> Sábado </option>
                                        <option value="domingo"> Domingo </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inpModalAgendamentoAHr">.</label>
                                    <select name="hora_final" id="inpModalAgendamentoAHr" class="form-control">
                                        <option value="06:00"> 06:00 </option>
                                        <option value="07:00"> 07:00 </option>
                                        <option value="08:00"> 08:00 </option>
                                        <option value="09:00"> 09:00 </option>
                                        <option value="10:00"> 10:00 </option>
                                        <option value="11:00"> 11:00 </option>
                                        <option value="12:00"> 12:00 </option>
                                        <option value="13:00"> 13:00 </option>
                                        <option value="14:00"> 14:00 </option>
                                        <option value="15:00"> 15:00 </option>
                                        <option value="16:00"> 16:00 </option>
                                        <option value="17:00"> 17:00 </option>
                                        <option value="18:00"> 18:00 </option>
                                        <option value="19:00"> 19:00 </option>
                                        <option value="20:00"> 20:00 </option>
                                        <option value="21:00"> 21:00 </option>
                                        <option value="22:00"> 22:00 </option>
                                    </select>
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button class="btn btn-primary me-md-2" type="submit">Salvar horário Exame</button>
                            </div>
                        </form>

                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
</div>

<!-- EDITAR Modal-->
<div class="modal fade" id="EditarModal" tabindex="-1" role="dialog" aria-labelledby="EditarModal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" > Editar</h5>
                <a id="CloseAgendaModal" style="cursor: pointer;" onclick="closeEditarModal()"> X </a>
            </div>
            <div class="modal-body" id="EditarModalIntro">
            </div>
        </div>
    </div>
</div>

<!-- EMPRESAS EXCLUÍDAS -->
<div class="modal fade" id="ModalEmpresasExcluidas" tabindex="-1" role="dialog" aria-labelledby="ModalEmpresasExcluidas" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" > Laboratórios excluídos</h5>
                <a id="CloseAgendaModal" style="cursor: pointer;" onclick="closeEmpresasExcluidasModal()"> X </a>
            </div>
            <div class="modal-body">
                <table class="table table-sm" id="tableListEmpresa" >
                    <thead class="thead-dark" >
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Nome Fantasia</th>
                        <th scope="col">Email</th>
                        <th scope="col">Cidade</th>
                        <!--                                        <th scope="col">Agenda</th>-->
                        <th scope="col">Ações</th>
                    </tr>
                    </thead>
                    <tbody id="tableListTbodyEmpresasExcluidas">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- LISTA DE USUÁRIOS APP -->
<div class="modal fade" id="ModalListaUsuariosApp" tabindex="-1" role="dialog" aria-labelledby="ModalListaUsuariosApp" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" > Lista Usuários do App</h5>
                <a id="CloseAgendaModal" style="cursor: pointer;" onclick="closeListaUsuariosApp()"> X </a>
            </div>
            <div class="modal-body">
                <table class="table table-sm" id="tableListUsuarioApp" >
                    <thead class="thead-dark" >
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Email</th>
                        <th scope="col">Cpf</th>
                        <th scope="col">Telefone</th>
                        <!-- <th scope="col">Agenda</th>-->
                        <th scope="col">Ações</th>
                    </tr>
                    </thead>
                    <tbody id="tableListTbodyUsuarioApp">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
