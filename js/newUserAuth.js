$(document).ready(function(){

    function noConnection(){
        showNotification("warning", "Sem conexão!", "Verificar", "iconBgcollor");

        
    }

    function showNotification(icon, header, message, iconBgcollor){

        $("#UNheader").html(header); 
        $("#UNmessage").html(message);
        $("#UniversalNotification").fadeIn('slow');
           
    } 




//================================================================================================================================================
 

    $( "#nome" ).keypress(function() {
        $("#nome-name-pro").html('Nome')
        $("#nome_fgroup").removeClass( "form-group has-error" );
        $("#nome_fgroup").addClass( "form-group " );
});

//================================================================================================================================================

       $( "#password" ).keyup(function() {
        $("#password-name-pro").html('Senha')
        $("#password-name-pro-again").html('Senha - novamente')
        $("#password_fgroup").removeClass( "form-group has-error" );
        $("#password_fgroup").addClass( "form-group " );
                  if($("#password").val() == $("#password_confirm").val() ){
               $("#password-name-pro").html('Senha')
               $("#password-name-pro-again").html('Senha - novamente')
               $("#password_fgroup").removeClass( "form-group has-error" );
               $("#password_fgroup").addClass( "form-group " );
            }else{
                $("#password_fgroup").addClass( "form-group has-error" );
                $("#password-name-pro").html('Senha - Não coincidem');

       }
});
//================================================================================================================================================

       $( "#password_confirm" ).keyup(function() {
           if($("#password").val() == $("#password_confirm").val()){
               $("#password-name-pro").html('Senha')
               $("#password-name-pro-again").html('Senha - novamente')
               $("#password_fgroup").removeClass( "form-group has-error" );
               $("#password_fgroup").addClass( "form-group " );
            }else{
                $("#password_fgroup").addClass( "form-group has-error" );
                $("#password-name-pro").html('Senha - Não coincidem');

       }

});


//================================================================================================================================================
   $('#save_execute').click(function(){
       $("#UniversalNotification").hide();
       $('#save_execute').prop("disabled", "disabled");
       $('#save_execute').html(' <img  style="margin:0 7px 0 6px;height:23px;width:25px;" src="../images/loader.gif" /> ');
       window.triger = 0
        nmlenght = $("#nome").val().length;
       if($("#nome").val() == "" || nmlenght <= 8){
           $('#save_execute').html('Salvar');
           $('#save_execute').removeAttr("disabled");
           $("#nome_fgroup").addClass( "form-group has-error" );
           $("#nome-name-pro").html('Nome - Incompleto')
           window.triger = 1
       }
       if($("#password").val() == ""){
           $('#save_execute').html('Salvar');
           $('#save_execute').removeAttr("disabled");
           $("#password_fgroup").addClass( "form-group has-error" );
           $("#password-name-pro").html('Senha - Não pode ficar em branco')
           window.triger = 1;
       }
       if($("#password").val() != $("#password_confirm").val()){
           $('#save_execute').html('Salvar');
           $('#save_execute').removeAttr("disabled");
           $("#password_fgroup").addClass( "form-group has-error" );
           $("#password-name-pro").html('Senha - Não coincidem');
           window.triger = 1;
       }

          if(triger == 1){
              return;
          }


            $.ajaxSetup({
                timeout: 6000, //time in miliseconds
                error:function(xhr){
                    noConnection();
                    $('#save_execute').removeAttr("disabled"); 
                    $('#save_execute').html('Salvar');

                console.log(xhr.statusText);
            }});
 


            $.ajax({
                method: "POST", 
                url: "NewUserFirstAuthSaveInfo.php",
                data: {name:$('#nome').val(), password:$('#password').val(), token:$('#token').val() }
                })
                .done(function( data ) {
                $('#save_execute').removeAttr("disabled"); 
                $('#save_execute').html('Salvar');

                obj = jQuery.parseJSON(data);
                console.log(obj);
                if(obj.result == 'success'){
                    showNotification("", "Salvo com sucesso!", "redirecionando", "iconBgcollor");
                    setTimeout(function(){
                        window.location.href = '../app/';                 //do what you need here
                    }, 2000);
 
               }
                  $('#save_execute').html('Salvar')



                
            
        })
                










   })
   //==============================================================================================================================================


   });
