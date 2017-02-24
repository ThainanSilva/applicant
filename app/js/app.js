$(document).ready(function(){





  function loadPage(page, elm){

    $('li').removeClass('active');
    $(elm).parent().addClass('active');
      $("#contentmanager").load(page);

  }


      $("#UniversalNotification").click(function(){
        $('#login_execute').removeAttr("disabled");
        $('#login_execute').html('Entrar');
        $("#UniversalNotification").hide();



      });



$("#dashboard").click(function(){
    loadPage('pages/dashboard.php', "#dashboard");
})

$("#devices").click(function(){
    loadPage('pages/devices.php', "#devices"); 
})

  $(".company-chooser-click").click(function(){
    $.ajaxSetup({
        timeout: 6000, //time in miliseconds
        error:function(xhr){
            noConnection();
    }});

    $.ajax({
        method: "POST",
        url: "../api/defineCompany.php",
        data: {company_id:$(this).attr("value")}
        })
    .done(function( data ) {
        obj = jQuery.parseJSON(data);

        if(obj.result == 'success'){
          window.location.href = '../app/';                 //do what you need here


       }else{
           showNotification("", obj.result, obj.message, "iconBgcollor");
       }
  })
  })

/*--------------------------------------------------------------------------------*/
$("#companyConfigs").click(function() {
  loadPage('pages/companyConfigs.php', '#companyConfigs');

})
$("#access").click(function() {
  loadPage('pages/access.php', '#access');

})
$("#usersConfigs").click(function() {
  loadPage('pages/companyConfigs.php', '#usersConfigs');
setTimeout(function(){
  $('#configtabs a[href="#users"]').tab('show')             //do what you need here
    }, 8000);




})



$("#visitors").click(function() {
  loadPage('pages/visitors.php', "#visitors");

})

});
