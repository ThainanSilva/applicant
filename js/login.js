
  
$(document).ready(function() {



    function noConnection() {
        var noConnectionsvg = '<svg style=" fill: #bf4141; height: 46px; width: 42px;"class="svg-ac" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"' +
            'x="0px" y="0px" width="512px" height="512px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">' +
            '<path d="M256-2C114.609-2,0,112.609,0,254s114.609,256,256,256s256-114.609,256-256S397.391-2,256-2z M256,470' +
            '	c-119.297,0-216-96.703-216-216S136.703,38,256,38s216,96.703,216,216S375.297,470,256,470z"/>' +
            '<path d="M256,126c-70.688,0-128,57.312-128,128s57.312,128,128,128s128-57.312,128-128S326.688,126,256,126z M256,318' +
            '	c-8.844,0-16-7.156-16-16s7.156-16,16-16s16,7.156,16,16S264.844,318,256,318z M264,270h-16l-8-80h32L264,270z"/>' +
            ' </svg>'
        showNotification(noConnectionsvg, "Sem conexão!", "Você está sem internet.", "iconBgcollor");


    }

    function showNotification(icon, header, message, iconBgcollor) {

        $("#UNheader").html(header);
        $("#UNmessage").html(message);
        $("#UNicon").html(icon)

        $("#UniversalNotification").fadeIn('slow');
        setTimeout(function() {
            $('#login_execute').removeAttr("disabled");
            $('#login_execute').html('Entrar');
            $("#UniversalNotification").fadeOut('slow'); //do what you need here
        }, 8000);

    }
    $("#UniversalNotification").click(function() {
        $('#login_execute').removeAttr("disabled");
        $('#login_execute').html('Entrar');
        $("#UniversalNotification").hide();



    });

    $("#login").keypress(function() {
        $("#login-name-pro").html('Email')
        $("#login_fgroup").removeClass("form-group has-error");
        $("#login_fgroup").addClass("form-group ");
    });

    $("#password").keypress(function(e) {
        $("#password-name-pro").html('Senha')
        $("#password_fgroup").removeClass("form-group has-error");
        $("#password_fgroup").addClass("form-group ");

        if (e.which == 13) {
            $("#login_execute").trigger("click");

        }
    });


    //================================================================================================================================================
    $('#login_execute').click(function() {
            $('#login_execute').prop("disabled", "disabled");
            $('#login_execute').html(' <img  style="margin:0 7px 0 6px;height:23px;width:25px;" src="images/loader.gif" /> ');
            triger = 0
            if ($("#login").val() == "") {
                $('#login_execute').html('Entrar');
                $('#login_execute').removeAttr("disabled");
                $('#login').prop('title', 'Exemplo@Nextec.app.br');

                $("#login_fgroup").addClass("form-group has-error");
                $("#login-name-pro").html('Email - não pode ficar em branco')
                triger = 1
            }
            if ($("#password").val() == "") {
                $('#login_execute').html('Entrar');
                $('#login_execute').removeAttr("disabled");
                $("#password_fgroup").addClass("form-group has-error");
                $("#password-name-pro").html('Senha - não pode ficar em branco')
            }

            if (triger == 1) {
                
            }


            var x = $('#login').val();
            var atpos = x.indexOf("@");
            var dotpos = x.lastIndexOf(".");
            if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length) {
                $('#login_execute').html('Entrar');
                $('#login_execute').removeAttr("disabled");
                $("#login_fgroup").addClass("form-group has-error");
                $("#login-name-pro").html('Email - isso não é um email!')
                $('#login').prop('title', 'Exemplo@Nextecbrasil.com.br');
            } else {




                $.ajaxSetup({
                    timeout: 6000, //time in miliseconds
                    error: function(xhr) {
                        noConnection();
                        $('#save_execute').removeAttr("disabled");
                        $('#save_execute').html('Salvar');

                        console.log(xhr.statusText);
                    }
                });



                $.ajax({
                        method: "POST",
                        url: "api/authenticate.php",
                        data: { email: $('#login').val(), password: $('#password').val() }
                    })
                    .done(function(data) {
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
                        $('#login_execute').removeAttr("disabled");
                        console.log(data)
                        obj = jQuery.parseJSON(data);
                        console.log(obj)
                        if (obj.result == 'success') {
                            toastr.success('Login egetuado com sucesso, redirecionando');
                            setTimeout(function() {
                                window.location.href = 'app/'; //do what you need here
                            }, 2000);

                        } else {
                            toastr.error( obj.message);
                        }

                        $('#login_execute').html('Entrar')



                    })

            } //else do click empty








        })
        //==============================================================================================================================================


});