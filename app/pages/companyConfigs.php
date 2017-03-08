
<script>
    $("#cnpj").mask("99.999.999/9999-99");

    function getCompanyData() {
        $.ajaxSetup({
            timeout: 6000, //time in miliseconds
            error: function (xhr) {
                noConnection();
            }});
        $.ajax({
            method: "POST",
            url: "../api/getCompanyData.php"
        })
                .done(function (data) {
                    treat = jQuery.parseJSON(data);
                    obj = treat[0];
                    $("#RazaoSocial").val(obj.RAZAO_SOCIAL);
                    $("#cnpj").val(obj.CNPJ_CPF);
                    $("#cnpj").mask("99.999.999/9999-99");
                    $("#identificador").val(obj.NAME);

                });
    }

//*******************************************************timezone***********************************
    function getTimeZone() {
        $.ajax({
            method: "POST",
            data: {json: '{"function":"getTimeZone"}'},
            url: "../api/CompanyUniversal.php"
        })
                .done(function (data) {
                    obj = jQuery.parseJSON(data);

                    $.each(obj.timezones, function (key, value)
                    {
                        if (value.id === obj.companytimezone[0].timezone) {
                            $("#timezone").append('<option selected value=' + value.id + '>' + value.name + '</option>');
                        } else {
                            $("#timezone").append('<option value=' + value.id + '>' + value.name + '</option>');
                        }
                    });
                });

    }

    $(document).ready(function () {


        getTimeZone();
        getCompanyData();
    });


    /*=====================================================================================================================*/
    $('#enviarConvite').click(function () {
        if ($("#emailNewUser").val() === "") {
            window.notificationCaller('alert', 'Erro', "E-Mail não pode ficar em branco!");
        } else {



            $.ajaxSetup({
                timeout: 6000, //time in miliseconds
                error: function (xhr) {
                    noConnection();
                }});

            $.ajax({
                method: "POST",
                url: "../api/newUserSave.php",
                data: {email: $("#emailNewUser").val(), profile_id: $("#profilesOption").val()}
            })
                    .done(function (data) {
                        console.log(data);
                        jsonResponse = jQuery.parseJSON(data);
                        switch (jsonResponse.result) {
                            case 'ERROR_USER_ALREADY_ADDED':
                                window.notificationCaller('alert', 'Erro:', " Usuário já cadastrado no sistema!");
                                break;
                            case 'ERROR_EMAIL_NOT_SENT':
                                window.notificationCaller('alert', 'Erro:', " E-Mail não enviado!");
                                break;
                            case 'SUCCESS':
                                window.notificationCaller('success', 'Sucesso: ', " Usuário adicionado ao sistema!");
                                $("#NewUser").modal('hide');
                                $('a[aria-controls="users"]').trigger('shown.bs.tab');
                                break;

                            default:

                        }

                        for (var k in jsonResponse) {
                            $("#profilesOption").append('<option value="' + jsonResponse[k].id + '">' + jsonResponse[k].name + '</option>');
                        }
                    });
        }
    });
    /*============================================CompanyData==============================================================*/

    $('a[aria-controls="geral"]').on('shown.bs.tab', function (e) {
        $.ajaxSetup({
            timeout: 6000, //time in miliseconds
            error: function (xhr) {
                noConnection();
            }});
        $.ajax({
            method: "POST",
            url: "../api/getCompanyData.php"
        })
                .done(function (data) {
                    treat = jQuery.parseJSON(data);
                    obj = treat[0];
                    $("#RazaoSocial").val(obj.RAZAO_SOCIAL);
                    $("#cnpj").val(obj.CNPJ_CPF);
                    $("#cnpj").mask("99.999.999/9999-99");
                    $("#identificador").val(obj.NAME);

                });
    });


    /*============================================CompanyData==============================================================*/
    $("#saveEditCompany").click(function () {
        check = ["#RazaoSocial", "#cnpj", "#identificador", "#timezone"];
        blocking = 0;
        for (i = 0; i < check.length; i++) {
            if ($(check[i]).val() === "") {
                console.log($(check[i]).val());
                $(check[i]).addClass("emptyfield");
                blocking = blocking + 1;
            } else {
                blocking = blocking - 1;
                $(check[i]).removeClass("emptyfield");

            }
        }
        if (blocking <= 0) {
            $("#cnpj").mask("99999999999999");
            $.ajax({
                method: "POST",
                data: {json: '{"function":"SaveEditCompany","RAZAO_SOCIAL":"' + $("#RazaoSocial").val() + '","CNPJ_CPF":"' + $("#cnpj").val() + '", "timezone":"' + $("#timezone").val() + '", "NAME":"' + $("#identificador").val() + '" }'},
                url: "../api/CompanyUniversal.php"
            })
                    .done(function (data) {
                        try {
                            $("#cnpj").mask("99.999.999/9999-99");
                            console.log(data);
                            if (data !== "" && data !== null) {
                                obj = jQuery.parseJSON(data);
                                if (obj.result == "success") {
                                    getCompanyData();
                                    getTimeZone();
                                    window.notificationCaller('success', 'salvo', "com sucesso");

                                } else {
                                    window.notificationCaller('alert', 'Erro', "Inesperado");
                                }
                            }
                        } catch (error) {
                            window.notificationCaller('alert', 'Erro ', error);
                        }
                    });
        }
    });
    /*==========================================================================================================*/
    $('a[aria-controls="users"]').on('shown.bs.tab', function (e) {
        $.ajaxSetup({
            timeout: 6000, //time in miliseconds
            error: function (xhr) {
                noConnection();
            }});
        $.ajax({
            method: "POST",
            url: "../api/getUsersInfoByCompany.php"
        })
                .done(function (data) {
                    jsonResponse = jQuery.parseJSON(data);
                    $("#loadingGif").remove();
                    $("#tablepopulatebody").html(' ');
                    if (jsonResponse.result == "success") {
                        i = 0
                        for (var k in jsonResponse) {
                            tableappend = '<tr>';
                            if (typeof jsonResponse[i] === 'object') {
                                if (jsonResponse[i].email !== undefined) {
                                    tableappend += '<td>' + jsonResponse[i].email + '</td>';
                                } else {
                                    tableappend += '<td></td>';
                                }
                                tableappend += '<td>' + jsonResponse[i].perfil + '</td>';
                                if (jsonResponse.privileges > 1) {
                                    tableappend += ' <td><span class="btn "  data-whatever="@getbootstrap" data-id="' + jsonResponse[i].id + '"  data-toggle="modal"  data-target="#EditUser"  title="Editar" href="#"><i class="fa fa-pencil fa-fw"></i></span><span class="btn" title="desabilitar usuário" value="' + jsonResponse[i].id + '" ><i class="fa fa-trash-o fa-fw"></i> </span></td>'
                                } else {
                                    alert('else')
                                }
                                tableappend += ' </tr>'
                                $("#tablepopulatebody").append(tableappend)
                                i = i + 1
                            }
                        }
                    }
                })
    })
//mostrando as opções para novo usuario
    $('#NewUser').on('show.bs.modal', function (e) {
        $.ajaxSetup({
            timeout: 6000, //time in miliseconds
            error: function (xhr) {
                noConnection();
            }});
        $.ajax({
            method: "POST",
            url: "../api/getProfilesByCompany.php"
        })
                .done(function (data) {
                    console.log(data)
                    jsonResponse = jQuery.parseJSON(data);
                    $("#loadingGif").remove();
                    $("#profilesOption").html('')
                    for (var k in jsonResponse) {
                        $("#profilesOption").append('<option value="' + jsonResponse[k].id + '">' + jsonResponse[k].name + '</option>')
                    }
                })
    })

    $('#EditUser').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id')

        $("#editmodaltitle").html('');
        $("#emailEditUser").val('');
        $("#nameEditUser").val('')
        $("#profilesOptionEditUser").html('');
        $.ajaxSetup({
            timeout: 6000, //time in miliseconds
            error: function (xhr) {
                noConnection();
            }});
        $.ajax({
            method: "POST",
            url: "../api/getUserEditableInfo.php",
            data: {user_id: id}
        })
                .done(function (data) {
                    jsonResponse = 
                    console.log(jsonResponse)
                    if (jsonResponse.result) {

                    } else {
                        $("#nameEditUser").val(jsonResponse[0].name)
                        $("#editmodaltitle").append('editando:' + jsonResponse[0].email)
                        $("#emailEditUser").val(jsonResponse[0].email)
                        for (var k in jsonResponse.all_profiles) {
                            if (jsonResponse.all_profiles[k].name == jsonResponse[0].perfil) {
                                $("#profilesOptionEditUser").append('<option selected value="' + jsonResponse.all_profiles[k].id + '">' + jsonResponse.all_profiles[k].name + '</option>')
                            } else {
                                $("#profilesOptionEditUser").append('<option value="' + jsonResponse.all_profiles[k].id + '">' + jsonResponse.all_profiles[k].name + '</option>')
                            }
                        }
                    }
                    for (var k in jsonResponse) {
                        $("#profilesOption").append('<option value="' + jsonResponse[k].id + '">' + jsonResponse[k].name + '</option>')
                    }
                })
    })
    /*==========================================================================================================*/
    $('a[aria-controls="profiles"]').on('shown.bs.tab', function (e) {

            $.ajaxSetup({
                timeout: 6000, //time in miliseconds
                error: function (xhr) {
                    noConnection();
                }});
            $.ajax({
                method: "POST",
                url: "../api/CompanyUniversal.php",
                data: {json: '{"function":"getProfiles"}'}
            })
                    .done(function (data) {
                        if (typeof(data) === 'object') {
                            obj = data;
                            $("#table-body-Users-Profiles").html('');
                            for (i = 0; i < obj.length; i++) {
                                $("#table-body-Users-Profiles").append('<tr><td> <a href="#"  data-editProfile="true" data-profileId="' + obj[i].id + '" data-reports="' + obj[i].Reports + '" data-config="' + obj[i].config + '" data-registeraccess="' + obj[i].Registeraccess + '" data-config_user="' + obj[i].config_user + '" data-devices="' + obj[i].devices + '" data-schedules="' + obj[i].schedules + '" data-visitors="' + obj[i].visitors + '" data-name="' + obj[i].name + '" data-toggle="modal" data-target="#NewProfile" >' + obj[i].name + '</a></td><td></td></tr>');
                            }
                        } else {
                            $("#table-body-Users-Profiles").html('<tr><td>Sem Perfis Proprietários</td></tr>');
                        }
                    });
        });
        /*==========================================================================================================*/
    $('#EditUser').on('show.bs.modal', function (event) {
        $.ajaxSetup({
            timeout: 6000, //time in miliseconds
            error: function (xhr) {
                noConnection();
            }});
        $.ajax({
            method: "POST",
            url: "../api/CompanyUniversal.php",
            data: {json: '{"function":"getProfilesAttr"}'}
        }).done(function (data) {
                     
                });
    });
        /*;==========================================================================================================*/
    $("#userProfilenName").keypress(function (){
        if($(this).val() !== ""){
            $("#saveNewProfile").removeAttr('disabled');
        }
        else{
            $("#saveNewProfile").attr("disabled", "disabled");
        }
    })
        /*==========================================================================================================*/
    $("#saveNewProfile").click(function(){
 
        $.ajaxSetup({
            timeout: 6000, //time in miliseconds
            error: function (xhr) {
                noConnection();
            }});
        $.ajax({
            method: "POST",
            url: "../api/CompanyUniversal.php",
            data: {json: '{"function":"SaveNewProfile", "data":[{ "name":"'+$("#userProfilenName").val()+'", "config":"'+$("#checkbox_profile_config").val()+'",  "config_user":"'+$("#checkbox_profile_config_user").val()+'", "visitors":"'+$("#checkbox_profile_visitors").val()+'", "schedules":"'+$("#checkbox_profile_schedules").val()+'", "reports":"'+$("#checkbox_profile_Reports").val()+'", "registeraccess":"'+$("#checkbox_profile_regist_access").val()+'"}] }'}
            
        }).done(function (data) {
                    console.log( data);
                });
    });
   
    /*==========================================================================================================*/
        $('#profiles').on('show.bs.modal', function (event) {
        button = $(event.relatedTarget); // Button that triggered the modal
        editing = button.data('editprofile');
        $("#userProfilenName").val('');
         fields = ["#checkbox_profile_config", "#checkbox_profile_config_user",  "#checkbox_profile_visitors", "#checkbox_profile_schedules", "#checkbox_profile_Reports", "#checkbox_profile_regist_access" ];
         fieldsdb = ["config", "config_user",  "visitors", "schedules", "reports", "registeraccess" ];
        for(v in fields){  
            $(fields[v]+":checked").prop('checked', false);  
        }
        console.log(editing); 
        if(editing){ 
            $("#userProfilenName").val(button.data('name'));
            for(v in fields){ 
                $(fields[v]+"[value='"+button.data(fieldsdb[v])+"']").prop("checked", true);
            }
        }else{
 

        
        }
    });
    /*==========================================================================================================*/
</script>

<div class="panel panel-info customWindow" >
    <div class="panel-heading">Configurações da empresa </div>
    <div class="panel-body">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist" id="configtabs">
            <li role="presentation" class="active"><a href="#empresa" aria-controls="empresa" role="tab" data-toggle="tab">Empresa</a></li>
            <li role="presentation"><a href="#geral" aria-controls="geral" role="tab" data-toggle="tab">Geral</a></li>
            <li role="presentation"><a href="#users" aria-controls="users" role="tab" data-toggle="tab">Usuarios</a></li>
            <li role="presentation"><a href="#profiles" aria-controls="profiles" role="tab" data-toggle="tab">Perfis de usuário</a></li>
            <li role="presentation"><a href="#fields" aria-controls="fields" role="tab" data-toggle="tab">Campos de Cadastro</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="empresa"><!-- tab Geral -->
                <h3>Dados gerais da empresa</h3>

                <br/>
                <form class="form-horizontal col-md-6">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Razão Social</label>
                        <div class="col-sm-10">
                            <input type="text" id="RazaoSocial" class="form-control"  placeholder="Razão Social">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">CNPJ</label>
                        <div class="col-sm-10">
                            <input type="text" id="cnpj"   class="form-control" placeholder="CNPJ"  >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Identificador</label>
                        <div class="col-sm-10">
                            <input type="text"  id="identificador" class="form-control" placeholder="Minha Empresa Exemplo">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label"> Time Zone </label>
                        <div class="col-sm-10">
                            <select id="timezone" class="form-control">

                            </select>
                        </div>
                    </div>
                    <span role="separator" class="divider"></span>
                    <div class="form-group">
                        <span type="button" id="saveEditCompany" class="btn btn-primary btn-sm btn-outline" >
                            <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>  Salvar
                        </span>
                    </div>
                </form>


                Copyright © 2016 5F Cloud. Todos os direitos Reservados. v 0.1.8

            </div><!-- fim da tab geral -->


            <div role="tabpanel" class="tab-pane" id="fields">  

                <h3>Usuarios</h3>
                <div class="bs-example usertable " data-example-id="simple-table">


                </div>  <!-- Button trigger modal New User -->


            </div>

            <div role="tabpanel" class="tab-pane" id="users">

                <h3>Usuarios</h3>
                <div class="bs-example usertable " data-example-id="simple-table">
                    <table id="UserDataTable" class="table">
                        <thead>
                            <tr>

                                <th>Email</th>
                                <th>Perfil</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody id="tablepopulatebody">
                        </tbody>
                    </table>

                </div>
                <!-- Button trigger modal New User -->
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#NewUser">
                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>  Novo Usuário
                </button>

            </div>
            <div role="tabpanel" class="tab-pane" id="profiles">
                <div class="row" style="margin-top:15px;">
                    <div class="col-lg-6">
                        <div class="btn-group" role="group" aria-label="...">
                            <button type="button" class="btn btn-primary btn-outline" id="btnNewProfile" data-editProfile="false" data-toggle="modal" data-target="#NewProfile">
                                <i class="fa fa-map-signs" aria-hidden="true"></i>  Novo Perfil</button>
                            <button type="button" class="btn btn-danger btn-outline" disabled="disabled"><i class="fa fa-times" aria-hidden="true"></i> Remover Perfil</button>

                        </div> </div>
                    <table style="margin:15px;"class="table table-hover">
                        <thead>

                            <tr>
                                <th>Nome</th>
                                <th>Criação</th>
                            </tr>
                        </thead>
                        <tbody id="table-body-Users-Profiles">
                            <tr>
                                <td>
                                    Carregando...
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div><!-- /.row -->


                <!-- Modal Novo Usuario-->
                <div class="modal fade" id="NewProfile" tabindex="-1" role="dialog"  >
                    <div class="modal-dialog" style="width: 50%;" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Novo Perfil</h4>
                            </div>
                            <div class="modal-body">

                                <table style="text-align: center;"class="table  table-hover table-bordered">
                                    <tr><td><input type="text"  id="userProfilenName" placeholder="Nome do Perfil"></td><td>Nada</td><td>Visualizar</td><td>Visualizar/Criar/Alterar</td><td>Visualizar/Criar/Alterar/remover</td></tr>
                                    <tr><td>Configurações</td><td><input type="radio" name="checkbox_profile_config" value="0" checked id="checkbox_profile_config"></td><td><input type="radio" name="checkbox_profile_config" value="1" id="checkbox_profile_config"></td><td><input type="radio" name="checkbox_profile_config" value="2" id="checkbox_profile_config"></td><td><input type="radio" name="checkbox_profile_config" value="3" id="checkbox_profile_config"></td></tr>

                                    <tr><td>Configurações de usuários</td><td><input type="radio" name="checkbox_profile_config_user" value="0" checked id="checkbox_profile_config_user"></td><td><input type="radio" name="checkbox_profile_config_user" value="1" id="checkbox_profile_config_user"></td><td><input type="radio" name="checkbox_profile_config_user" value="2" id="checkbox_profile_config_user"></td><td><input type="radio" name="checkbox_profile_config_user" value="3" id="checkbox_profile_config_user"></td></tr>

                                    <tr><td>Visitantes</td><td><input type="radio" name="checkbox_profile_visitors" value="0" checked id="checkbox_profile_visitors"></td><td><input type="radio" name="checkbox_profile_visitors" value="1" id="checkbox_profile_visitors"></td><td><input type="radio" name="checkbox_profile_visitors" value="2" id="checkbox_profile_visitors"></td><td><input type="radio" name="checkbox_profile_visitors" value="3" id="checkbox_profile_visitors"></td></tr>

                                    <tr><td>Horários</td><td><input type="radio" name="checkbox_profile_schedules" value="0" checked id="checkbox_profile_schedules"></td><td><input type="radio" name="checkbox_profile_schedules" value="1" id="checkbox_profile_schedules"></td><td><input type="radio" name="checkbox_profile_schedules" value="2" id="checkbox_profile_schedules"></td><td><input type="radio" name="checkbox_profile_schedules" value="3" id="checkbox_profile_schedules"></td></tr>

                                    <tr><td>Relatórios</td><td><input type="radio" name="checkbox_profile_Reports" value="0" checked id="checkbox_profile_Reports"></td><td><input type="radio" name="checkbox_profile_Reports" value="1" id="checkbox_profile_Reports"></td><td><input type="radio" name="checkbox_profile_Reports" value="2" id="checkbox_profile_Reports"></td><td><input type="radio" name="checkbox_profile_Reports" value="3" id="checkbox_profile_Reports"></td></tr>

                                    <tr><td>Registrar Acessos</td><td>Não: <input type="radio" name="checkbox_profile_regist_access" value="0" checked id="checkbox_profile_regist_access"></td><td>Sim: <input type="radio" name="checkbox_profile_regist_access" value="1" id="checkbox_profile_regist_access"></td><td></td><td> </td></tr>
                                </table>


                            </div>



                            <div class="modal-footer">
                                <span class="btn btn-default" data-dismiss="modal">Cancelar</span>
                                <span class="btn btn-primary" disabled id="saveNewProfile">Salvar</span>

                            </div>
                        </div>
                    </div>
                </div>

            </div>



            <div role="tabpanel" class="tab-pane " id="geral"><!-- tab Geral -->
                <h3>Dados gerais do sistema</h3>


            </div><!-- fim da tab geral -->
        </div>
    </div>
</div>




<!-- Modal Novo Usuario-->
<div class="modal fade" id="NewUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Novo Usuário</h4>
            </div>
            <div class="modal-body">
                <img  id="loadingGif" style="margin:0 7px 0 6px;height:23px;width:25px;" src="../images/loader.gif" />

                <form class="form-inline">
                    <div class="form-group">
                        <label for="exampleInputEmail2">Email</label>
                        <input type="email" id="emailNewUser" class="form-control"  placeholder="5fcloud@example.com">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName2">Perfil</label>
                        <select class="form-control" id="profilesOption"> </select>
                    </div>

                    <span id="enviarConvite"  class="btn btn-default">Enviar Convite</span>
                </form>

            </div>
            <div class="modal-footer">
                <span class="btn btn-default" data-dismiss="modal">Fechar</span>
            </div>
        </div>
    </div>
</div>


<!-- Modal editar funionario-->
<div class="modal fade" id="EditUser" tabindex="-1" role="dialog" aria-labelledby="Editar Usuário">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="editmodaltitle">Editando Usuário:</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputName2">Nome</label>
                    <input type="text" disabled="disabled" id="nameEditUser" class="form-control" >
                </div>
                <form class="form-inline">
                    <div class="form-group">
                        <label for="exampleInputEmail2">Email</label>
                        <input type="email" disabled id="emailEditUser" class="form-control"  placeholder="5fcloud@example.com">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName2">Perfil</label>
                        <select class="form-control" id="profilesOptionEditUser"> </select>
                    </div>


                </form>

            </div>
            <div class="modal-footer">
                <span id="saveEditUser" disabled class="btn btn-outline btn-success">Salvar</span>
                <span class="btn btn-default" data-dismiss="modal">Fechar</span>
            </div>
        </div>
    </div>
</div>
