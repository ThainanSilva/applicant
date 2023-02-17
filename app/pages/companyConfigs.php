<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha256-ENFZrbVzylNbgnXx0n3I1g//2WeO47XxoPe0vkp3NC8=" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" integrity="sha256-yNbKY1y6h2rbVcQtf0b8lq4a+xpktyFc3pSYoGAY1qQ=" crossorigin="anonymous"></script>

<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    $("#cnpj").mask("99.999.999/9999-99");
    window.selectedProfilesDelete = [];

    function getCompanyData() {
        $.ajaxSetup({
            timeout: 6000, //time in miliseconds
            error: function(xhr) {
                noConnection();
            }
        });
        $.ajax({
                method: "POST",
                url: "../api/getCompanyData.php"
            })
            .done(function(data) {
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
                data: {
                    json: '{"function":"getTimeZone"}'
                },
                url: "../api/CompanyUniversal.php"
            })
            .done(function(data) {
                obj = jQuery.parseJSON(data);

                $.each(obj.timezones, function(key, value) {
                    if (value.id === obj.companytimezone[0].timezone) {
                        $("#timezone").append('<option selected value=' + value.id + '>' + value.name + '</option>');
                    } else {
                        $("#timezone").append('<option value=' + value.id + '>' + value.name + '</option>');
                    }
                });
            });

    }

    $(document).ready(function() {


        getTimeZone();
        getCompanyData();
    });


    /*=====================================================================================================================*/
    $('#enviarConvite').click(function() {
        if ($("#emailNewUser").val() === "") {
            window.notificationCaller('alert', 'Erro', "E-Mail não pode ficar em branco!");
        } else {



            $.ajaxSetup({
                timeout: 6000, //time in miliseconds
                error: function(xhr) {
                    noConnection();
                }
            });

            $.ajax({
                    method: "POST",
                    url: "../api/newUserSave.php",
                    data: {
                        email: $("#emailNewUser").val(),
                        profile_id: $("#profilesOption").val()
                    }
                })
                .done(function(data) {
                    console.log(data);
                    jsonResponse = jQuery.parseJSON(data);
                    switch (jsonResponse.result) {
                        case 'ERROR_USER_ALREADY_ADDED':
                            toastr.error('Usuário já cadastrado no sistema!');
                            $("#NewUser").modal('hide');
                            $("#emailNewUser").val('');
                            $('a[aria-controls="users"]').trigger('shown.bs.tab');
                            break;
                        case 'ERROR_EMAIL_NOT_SENT':
                            toastr.error('E-Mail não enviado!');
                            $("#NewUser").modal('hide');
                            $("#emailNewUser").val('');
                            $('a[aria-controls="users"]').trigger('shown.bs.tab');
                            break;
                        case 'SUCCESS':
                            toastr.success('Convite enviado com sucesso :)')
                            $("#NewUser").modal('hide');
                            $("#emailNewUser").val('');
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

    $('a[aria-controls="geral"]').on('shown.bs.tab', function(e) {
        $.ajaxSetup({
            timeout: 6000, //time in miliseconds
            error: function(xhr) {
                noConnection();
            }
        });
        $.ajax({
                method: "POST",
                url: "../api/getCompanyData.php"
            })
            .done(function(data) {
                treat = jQuery.parseJSON(data);
                obj = treat[0];
                $("#RazaoSocial").val(obj.RAZAO_SOCIAL);
                $("#cnpj").val(obj.CNPJ_CPF);
                $("#cnpj").mask("99.999.999/9999-99");
                $("#identificador").val(obj.NAME);

            });
    });


    /*============================================CompanyData==============================================================*/
    $("#saveEditCompany").click(function() {
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
                    data: {
                        json: '{"function":"SaveEditCompany","RAZAO_SOCIAL":"' + $("#RazaoSocial").val() + '","CNPJ_CPF":"' + $("#cnpj").val() + '", "timezone":"' + $("#timezone").val() + '", "NAME":"' + $("#identificador").val() + '" }'
                    },
                    url: "../api/CompanyUniversal.php"
                })
                .done(function(data) {
                    try {
                        $("#cnpj").mask("99.999.999/9999-99");
                        console.log(data);
                        if (data !== "" && data !== null) {
                            obj = jQuery.parseJSON(data);
                            if (obj.result == "success") {
                                getCompanyData();
                                getTimeZone();
                                toastr.success('Salvo com sucesso')

                            } else {
                                toastr.error('Erro ao salvar.', 'Verifique os campos e tente novamente!')
                            }
                        }
                    } catch (error) {
                        toastr.error('Erro inesperado')
                    }
                });
        }
    });
    /*==========================================================================================================*/
    $('a[aria-controls="users"]').on('shown.bs.tab', function(e) {
        $.ajaxSetup({
            timeout: 6000, //time in miliseconds
            error: function(xhr) {
                toastr.error(xhr.message)
                console.log(xhr)
                noConnection();
            }
        });
        $.ajax({
                method: "POST",
                url: "../api/getUsersInfoByCompany.php"
            })
            .done(function(data) {
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
                                tableappend += ' <td><span class="btn btn-info btn-outline"  data-whatever="@getbootstrap" data-id="' + jsonResponse[i].id + '"  data-toggle="modal"  data-target="#EditUser"  title="Editar" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span> <span style="margin-left:3px;" class="btn btn-danger btn-outline" title="desabilitar usuário" value="' + jsonResponse[i].id + '" ><i class="fa fa-trash-o fa-fw"></i> </span></td>';
                            } else {
                                alert('else');
                            }
                            tableappend += ' </tr>';
                            $("#tablepopulatebody").append(tableappend);
                            i = i + 1;
                        }
                    }
                }
            });
    });
    //mostrando as opções para novo usuario
    $('#NewUser').on('show.bs.modal', function(e) {
        $.ajaxSetup({
            timeout: 6000, //time in miliseconds
            error: function(xhr) {
                noConnection();
            }
        });
        $.ajax({
                method: "POST",
                url: "../api/getProfilesByCompany.php"
            })
            .done(function(data) {
                console.log(data);
                jsonResponse = jQuery.parseJSON(data);
                $("#loadingGif").remove();
                $("#profilesOption").html('');
                for (var k in jsonResponse) {
                    $("#profilesOption").append('<option value="' + jsonResponse[k].id + '">' + jsonResponse[k].name + '</option>');
                }
            });
    });



    //*******************************************
    $("#profilesOptionEditUser").change(function() {
        $("#saveEditUser").removeAttr("disabled");
    })
    //***************************************************************

    $("#saveEditUser").click(function() {
        $.ajaxSetup({
            timeout: 6000, //time in miliseconds
            error: function(xhr) {
                noConnection();
            }
        });
        $.ajax({
                method: "POST",
                data: {
                    "function": "saveEditUser",
                    "data": {
                        "userId": ""
                    }
                },
                url: "../api/CompanyUniversal.php"
            })
            .done(function(data) {});
    });

    //************************************************************

    $('#EditUser').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('id')

        $("#editmodaltitle").html('');
        $("#emailEditUser").val('');
        $("#nameEditUser").val('')
        $("#profilesOptionEditUser").html('');
        $.ajaxSetup({
            timeout: 6000, //time in miliseconds
            error: function(xhr) {
                noConnection();
            }
        });
        $.ajax({
                method: "POST",
                url: "../api/CompanyUniversal.php",
                data: {
                    json: '{"function":"getUserEditableInfo", "user_id":"' + id + '"}'
                }
            })
            .done(function(data) {
                console.log(data);
                jsonResponse = data;

                if (jsonResponse.result === 'error') {

                } else {
                    $("#UserEditId").val(jsonResponse.id);
                    if (jsonResponse.name) {
                        $("#nameEditUser").val(jsonResponse.name)
                    } else {
                        $("#nameEditUser").val('Sem nome definido!')
                    }

                    $("#editmodaltitle").append('editando:' + jsonResponse.email)
                    $("#emailEditUser").val(jsonResponse.email)
                    for (k in jsonResponse.all_profiles) {
                        if (jsonResponse.all_profiles[k].name == jsonResponse.perfil) {
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
        button = null;
        id = null;
    })
    /*==========================================================================================================*/
    $("#removerPerfis").click(function() {
        if (!$("#removerPerfis").prop('disabled')) {

            $('#ConfirmExclusion').click(function() {
                // handle deletion here

                $.ajaxSetup({
                    timeout: 6000, //time in miliseconds
                    error: function(xhr) {
                        //console.log(xhr.responseText);
                        noConnection();
                    }
                });
                $.ajax({
                        method: "POST",
                        url: "../api/CompanyUniversal.php",
                        data: {
                            json: '{"function":"removeProfiles", "profiles":[' + selectedProfilesDelete + ']}'
                        }
                    })
                    .done(function(data) {
                        console.log(data);

                        if (data.result == 'success') {
                            $("#DeleteProfileModal").modal('hide');
                            loadProfiles();

                        }
                        if (data.result == 'error') {

                            switch (data.errorCode) {
                                case '1001':

                                    window.notificationCaller('alert', '     Erro,', 'Sem Privilégios para Fazer isso');

                                    break;
                                case '4050':

                                    window.notificationCaller('alert', "     Erro", 'esses perfis não podem ser deletados, pois estão associados à usuários.');

                                    $("#DeleteProfileModal").modal('hide');
                                    break;
                            }
                        }


                    })


            });



        } else {
            toastr.error('Erro.', 'Selecione os perfis que serão deletados!');
        }
    })




    /*==========================================================================================================*/
    function loadProfiles(e) {
        $.ajaxSetup({
            timeout: 6000, //time in miliseconds
            error: function(xhr) {
                noConnection();
            }
        });
        $.ajax({
                method: "POST",
                url: "../api/CompanyUniversal.php",
                data: {
                    json: '{"function":"getProfiles"}'
                }
            })
            .done(function(data) {
                console.log(data)


                if (typeof(data) === 'object') {

                    obj = data;
                    $("#table-body-Users-Profiles").html('');
                    for (i = 0; i < obj.length; i++) {
                        $("#table-body-Users-Profiles").append('<tr><td><input type="checkbox" class="profileSelector" value="' + obj[i].id + '" / ></td><td> <a href="#"  data-editProfile="true" data-profileId="' + obj[i].id + '" data-reports="' + obj[i].Reports + '" data-config="' + obj[i].config + '" data-registeraccess="' + obj[i].Registeraccess + '" data-config_user="' + obj[i].config_user + '" data-devices="' + obj[i].devices + '" data-schedules="' + obj[i].schedules + '" data-visitors="' + obj[i].visitors + '" data-name="' + obj[i].name + '" data-toggle="modal" data-target="#NewProfile" >' + obj[i].name + '</a></td><td></td></tr>');
                    }
                    $(".profileSelector").click(function() {
                        if ($(this).prop('checked')) {
                            window.selectedProfilesDelete.push($(this).val());
                        } else {
                            index = window.selectedProfilesDelete.indexOf($(this).val());
                            window.selectedProfilesDelete.splice(index, 1);
                        }
                        if (selectedProfilesDelete.length > 0) {
                            $("#removerPerfis").removeAttr("disabled");
                        } else {
                            $("#removerPerfis").prop("disabled", 'disabled');
                        }

                    })

                } else {
                    $("#table-body-Users-Profiles").html('<tr><td>Sem Perfis Proprietários</td></tr>');
                }
            });

    }

    $('a[aria-controls="profiles"]').on('shown.bs.tab', function(e) {
        loadProfiles(e);


    });
    /*==========================================================================================================*/
    $('#EditUser').on('show.bs.modal', function(event) {
        $.ajaxSetup({
            timeout: 6000, //time in miliseconds
            error: function(xhr) {
                noConnection();
            }
        });
        $.ajax({
            method: "POST",
            url: "../api/CompanyUniversal.php",
            data: {
                json: '{"function":"getProfilesAttr"}'
            }
        }).done(function(data) {

        });
    });
    /*;==========================================================================================================*/
    $("#userProfilenName").keypress(function() {
        if ($(this).val() !== "") {
            $("#saveNewProfile").removeAttr('disabled');
        } else {
            $("#saveNewProfile").attr("disabled", "disabled");
        }
    })
    /*==========================================================================================================*/
    $("#saveNewProfile").click(function() {

        $.ajaxSetup({
            timeout: 6000, //time in miliseconds
            error: function(xhr) {
                noConnection();
            }
        });
        $.ajax({
            method: "POST",
            url: "../api/CompanyUniversal.php",
            data: {
                json: '{"function":"SaveNewProfile", "data":{ "name":"' + $("#userProfilenName").val() + '", "config":"' + $("#checkbox_profile_config:checked").val() + '",  "config_user":"' + $("#checkbox_profile_config_user:checked").val() + '", "visitors":"' + $("#checkbox_profile_visitors:checked").val() + '", "schedules":"' + $("#checkbox_profile_schedules:checked").val() + '", "reports":"' + $("#checkbox_profile_Reports:checked").val() + '", "registeraccess":"' + $("#checkbox_profile_regist_access:checked").val() + '", "devices":"' + $("#checkbox_profile_Devices :checked").val() + '"    } }'
            }

        }).done(function(data) {
            if (data.result == 'success') {
                $("#NewProfile").modal('hide');
                window.notificationCaller('success', 'Ok!', "Salvo com sucesso!");
                loadProfiles();
            }
            if (data.result == 'Error') {
                window.notificationCaller('alert', 'Erro !', "Esse nome de perfil já existe!");
                loadProfiles();
            }
            console.log(data);
        });
    });

    /*==========================================================================================================*/
    $('#profiles').on('show.bs.modal', function(event) {
        button = $(event.relatedTarget); // Button that triggered the modal
        editing = button.data('editprofile');
        $("#userProfilenName").val('');
        fields = ["#checkbox_profile_config", "#checkbox_profile_config_user", "#checkbox_profile_visitors", "#checkbox_profile_schedules", "#checkbox_profile_Reports", "#checkbox_profile_Devices", "#checkbox_profile_regist_access"];
        fieldsdb = ["config", "config_user", "visitors", "schedules", "reports", "devices", "registeraccess"];
        for (v in fields) {
            $(fields[v] + ":checked").prop('checked', false);
        }
        console.log(editing);
        if (editing) {
            $("#userProfilenName").val(button.data('name'));
            for (v in fields) {
                $(fields[v] + "[value='" + button.data(fieldsdb[v]) + "']").prop("checked", true);
            }
        } else {



        }
    });

    //===========================================================================================
    // função adicional em atualização a opção de remoção de perfis
    // adicionado em 17 de maio de 2019
    /*
     
     $("#ConfirmExclusion").click(function(){
     var deletingProfiles = [];
     $(".profileSelector:checked").each(function() {
     deletingobjects = deletingProfiles.push( $(this).val());
     
     })
     
     parseddelprofiles = JSON.stringify(deletingobjects);
     
     $.ajaxSetup({
     timeout: 6000, //time in miliseconds
     error: function (xhr) {
     noConnection();
     }});
     $.ajax({
     method: "POST",
     url: "../api/CompanyUniversal.php",
     data: {json: '{"function":"deleteProfile", "data":['+deletingProfiles+']}'}
     
     }).done(function (data) {
     console.log(data);
     if (data.result === 'success') {
     alert('tudo certo')
     window.notificationCaller('success', 'Ok!', "Deletado com sucesso!");
     }
     
     });
     })*/
    //========================================================================================
    $('a[aria-controls="fields"]').on('shown.bs.tab', function(e) {

        function actionFormatter(value, row, index) {
            return [
                '<a class="like" href="javascript:void(0)" title="Like">',
                '<i class="glyphicon glyphicon-heart"></i>',
                '</a>'
            ].join('');
        }

        window.actionEvents = {
            'click .like': function(e, value, row, index) {
                alert('You click like icon, row: ' + JSON.stringify(row.id));
                console.log(value, row, index);
            },
            'click .edit': function(e, value, row, index) {
                alert('You click edit icon, row: ' + JSON.stringify(row));
                console.log(value, row, index);
            },
            'click .remove': function(e, value, row, index) {
                alert('You click remove icon, row: ' + JSON.stringify(row));
                console.log(value, row, index);
            }
        };



        function GetDevices() {
            $.ajaxSetup({
                timeout: 6000, //time in miliseconds
                error: function(xhr) {
                    noConnection();
                }
            });
            $.ajax({
                url: "../api/CompanyUniversal",
                type: "POST",
                data: {
                    json: '{"function":"getFields"}'
                }

            }).done(function(data) {
                console.log(data);
                $('#fieldsTable').bootstrapTable({
                    onSort: function() {
                        alert('ola');
                    },
                    pagination: true,
                    search: true,
                    columns: [{

                        field: 'name',
                        title: 'Nome',
                        sortable: true,

                    }, {
                        field: 'ambiente',
                        title: 'Ambiente',
                        sortable: true
                    }, {
                        field: 'datetime',
                        title: 'Ultima sincronização',
                        sortable: true
                    }, {
                        field: 'options',
                        title: 'Opções',
                        formatter: actionFormatter()
                    }],
                    data: data,
                    columnDefaults: {
                        checkbox: true
                    }
                });
            });
        }
        GetDevices();



    })
    /*==========================================================================================================*/
</script>

<div class="modal" id="DeleteProfileModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="ModalExclusão">Excluir</h4>
            </div>
            <div class="modal-body">
                <p>Excluir o(s) perfi(s) selecionado(s)</p>
            </div>
            <div class="modal-footer">
                <span class="btn btn-default" data-dismiss="modal">Cancelar</span>
                <span class="btn btn-danger" id="ConfirmExclusion">Excluir</span>
            </div>
        </div>
    </div>
</div><!-- -->
<div class="panel panel-info customWindow">
    <div class="panel-heading">Configurações da empresa </div>
    <div class="panel-body">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist" id="configtabs">
            <li role="presentation" class="active"><a href="#empresa" aria-controls="empresa" role="tab" data-toggle="tab"><i class="fa fa-building-o" aria-hidden="true"></i> Dados da Empresa</a></li>
            <!--<li role="presentation"><a href="#geral" aria-controls="geral" role="tab" data-toggle="tab"><i class="fa fa-globe" aria-hidden="true"></i> Geral</a></li>
            -->
            <li role="presentation"><a href="#users" aria-controls="users" role="tab" data-toggle="tab"><i class="fa fa-user-o" aria-hidden="true"></i> Usuarios</a></li>
            <li role="presentation"><a href="#profiles" aria-controls="profiles" role="tab" data-toggle="tab"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Perfis de usuário</a></li>
            <li role="presentation"><a href="#fields" aria-controls="fields" role="tab" data-toggle="tab"><i class="fa fa-address-card-o" aria-hidden="true"></i> Campos de Cadastro</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="empresa">
                <!-- tab Geral -->
                <h3>Dados gerais da empresa</h3>

                <br />
                <form class="form-horizontal col-md-6">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Razão Social</label>
                        <div class="col-sm-10">
                            <input type="text" id="RazaoSocial" class="form-control" placeholder="Razão Social">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">CNPJ</label>
                        <div class="col-sm-10">
                            <input type="text" id="cnpj" class="form-control" placeholder="CNPJ">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Identificador</label>
                        <div class="col-sm-10">
                            <input type="text" id="identificador" class="form-control" placeholder="Minha Empresa Exemplo">
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
                        <span type="button" id="saveEditCompany" class="btn btn-primary btn-sm btn-outline">
                            <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Salvar
                        </span>
                    </div>
                </form>

                <div style="float: right;margin-top: 20%;">
                    Copyright © 2016 Nextec. Todos os direitos Reservados. v 0.8.0</div>

            </div><!-- fim da tab geral -->


            <div role="tabpanel" class="tab-pane" id="fields">

                <h3>Campos de cadastro</h3>
                <div class="col-lg-6">

                    <div class="btn-group" style="margin: 10px 0 10px 0; " role="group" aria-label="...">
                        <button type="button" class="btn btn-primary " id="btnNewProfile" data-editProfile="false" data-toggle="modal" data-target="#NewProfile">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Novo Campo de Cadastro</button>
                        <button type="button" data-title="Tem certeza que quer excluir esses Perfis?" data-toggle="modal" data-target="#DeleteProfileModal" data-title="Exclusão" id="removerPerfis" data-placement="right" data-content="Excluir os perfis selecionados?" class="btn btn-danger " disabled="disabled"><i class="fa fa-times" aria-hidden="true"></i> Remover</button>

                    </div>
                </div>
                <table id="fieldsTable" class="table">
                </table>

            </div>

            <div role="tabpanel" class="tab-pane" id="users">

                <h3>Usuários</h3>
                <div>
                    <table id="UserDataTable" class="table table-hover overflowtable">
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
                    <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Novo Usuário
                </button>

            </div>
            <div role="tabpanel" class="tab-pane" id="profiles">

                <div class="row" style="margin-top:15px;">

                    <div class="col-lg-6">

                        <div class="btn-group" style="margin: 10px 0 10px 0; " role="group" aria-label="...">
                            <button type="button" class="btn btn-primary " id="btnNewProfile" data-editProfile="false" data-toggle="modal" data-target="#NewProfile">
                                <i class="fa fa-map-signs" aria-hidden="true"></i> Novo Perfil</button>
                            <button type="button" data-title="Tem certeza que quer excluir esses Perfis?" data-toggle="modal" data-target="#DeleteProfileModal" data-title="Exclusão" id="removerPerfis" data-placement="right" data-content="Excluir os perfis selecionados?" class="btn btn-danger " disabled="disabled"><i class="fa fa-times" aria-hidden="true"></i> Remover Perfil</button>

                        </div>
                    </div>
                    <div id="profilesTable">
                        <table id="userProfiles_table" style="margin:15px;max-width: 98%;" class="table table-hover">
                            <thead>

                                <tr>
                                    <th>#</th>
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
                    </div>
                </div><!-- /.row -->


                <!-- Modal Novo perfil-->
                <div class="modal fade" id="NewProfile" tabindex="-1" role="dialog">
                    <div class="modal-dialog" style=" min-width: 85%;" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Novo Perfil</h4>
                            </div>
                            <div class="modal-body">

                                <table style="text-align: center;" class="table  table-hover table-bordered">
                                    <tr>
                                        <td><input type="text" id="userProfilenName" class="form-control" placeholder="Nome do Perfil"></td>
                                        <td>Nada</td>
                                        <td>Visualizar</td>
                                        <td>Visualizar/Criar/Alterar</td>
                                        <td>Visualizar/Criar/Alterar/remover</td>
                                    </tr>

                                    <tr>
                                        <td>Configurações</td>
                                        <td><input type="radio" name="checkbox_profile_config" value="0" checked id="checkbox_profile_config"></td>
                                        <td><input type="radio" name="checkbox_profile_config" value="1" id="checkbox_profile_config"></td>
                                        <td><input type="radio" name="checkbox_profile_config" value="2" id="checkbox_profile_config"></td>
                                        <td><input type="radio" name="checkbox_profile_config" value="3" id="checkbox_profile_config"></td>
                                    </tr>

                                    <tr>
                                        <td>Configurações de usuários</td>
                                        <td><input type="radio" name="checkbox_profile_config_user" value="0" checked id="checkbox_profile_config_user"></td>
                                        <td><input type="radio" name="checkbox_profile_config_user" value="1" id="checkbox_profile_config_user"></td>
                                        <td><input type="radio" name="checkbox_profile_config_user" value="2" id="checkbox_profile_config_user"></td>
                                        <td><input type="radio" name="checkbox_profile_config_user" value="3" id="checkbox_profile_config_user"></td>
                                    </tr>

                                    <tr>
                                        <td>Visitantes</td>
                                        <td><input type="radio" name="checkbox_profile_visitors" value="0" checked id="checkbox_profile_visitors"></td>
                                        <td><input type="radio" name="checkbox_profile_visitors" value="1" id="checkbox_profile_visitors"></td>
                                        <td><input type="radio" name="checkbox_profile_visitors" value="2" id="checkbox_profile_visitors"></td>
                                        <td><input type="radio" name="checkbox_profile_visitors" value="3" id="checkbox_profile_visitors"></td>
                                    </tr>

                                    <tr>
                                        <td>Horários</td>
                                        <td><input type="radio" name="checkbox_profile_schedules" value="0" checked id="checkbox_profile_schedules"></td>
                                        <td><input type="radio" name="checkbox_profile_schedules" value="1" id="checkbox_profile_schedules"></td>
                                        <td><input type="radio" name="checkbox_profile_schedules" value="2" id="checkbox_profile_schedules"></td>
                                        <td><input type="radio" name="checkbox_profile_schedules" value="3" id="checkbox_profile_schedules"></td>
                                    </tr>

                                    <tr>
                                        <td>Relatórios</td>
                                        <td><input type="radio" name="checkbox_profile_Reports" value="0" checked id="checkbox_profile_Reports"></td>
                                        <td><input type="radio" name="checkbox_profile_Reports" value="1" id="checkbox_profile_Reports"></td>
                                        <td><input type="radio" name="checkbox_profile_Reports" value="2" id="checkbox_profile_Reports"></td>
                                        <td><input type="radio" name="checkbox_profile_Reports" value="3" id="checkbox_profile_Reports"></td>
                                    </tr>

                                    <tr>
                                        <td>Dispositivos</td>
                                        <td><input type="radio" name="checkbox_profile_Devices" value="0" checked id="checkbox_profile_Devices"></td>
                                        <td><input type="radio" name="checkbox_profile_Devices" value="1" id="checkbox_profile_Devices"></td>
                                        <td><input type="radio" name="checkbox_profile_Devices" value="2" id="checkbox_profile_Devices"></td>
                                        <td><input type="radio" name="checkbox_profile_Devices" value="3" id="checkbox_profile_Devices"></td>
                                    </tr>

                                    <tr>
                                        <td>Registrar Acessos</td>
                                        <td>Não: <input type="radio" name="checkbox_profile_regist_access" value="0" checked id="checkbox_profile_regist_access"></td>
                                        <td>Sim: <input type="radio" name="checkbox_profile_regist_access" value="1" id="checkbox_profile_regist_access"></td>
                                        <td></td>
                                        <td> </td>
                                    </tr>
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



            <div role="tabpanel" class="tab-pane " id="geral">
                <!-- tab Geral -->
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
                <img id="loadingGif" style="margin:0 7px 0 6px;height:23px;width:25px;" src="../images/loader.gif" />

                <form class="form-inline">
                    <div class="form-group">
                        <label for="exampleInputEmail2">Email</label>
                        <input type="email" id="emailNewUser" class="form-control" placeholder="Exemplo@Nextecbrasil.com.br">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName2">Perfil</label>
                        <select class="form-control" id="profilesOption"> </select>
                    </div>

                    <span id="enviarConvite" class="btn btn-default">Enviar Convite</span>
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
                    <input type="text" disabled="disabled" id="nameEditUser" class="form-control">
                </div>
                <form class="form-inline">
                    <input type="hidden" value="0" id="UserEditId" />
                    <div class="form-group">
                        <label for="exampleInputEmail2">Email</label>
                        <input type="email" disabled id="emailEditUser" class="form-control" placeholder="Exemplo@Nextecbrasil.com.br">
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