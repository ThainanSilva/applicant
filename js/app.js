$(document).ready(function(){
    
          $.ajaxSetup({
               type: 'POST',
               timeout: 7000,
               error: function(xhr) {
                    alert('Sem Conexão');
                     }
             }) 
   //================================================================================
      $('#dashboard').click(function(){
       $( "#contentloader" ).load( "pages/dashboard.php" );
   })
   //================================================================================
          
   //================================================================================
      $('#new_user_link').click(function(){
       $( "#contentloader" ).load( "pages/newuser.php" );
   })
   //================================================================================
   
   //enter_administration
   
   //================================================================================
   $('#enter_administration').click(function(){
       $( "#contentloader" ).load( "pages/adminEmpresa.php" )
       $(".content-header").html('<h1>Administrar Empresa</h1>')
   }) 
   //================================================================================
   
   
   
   
  
    
    
});