function noConnection(){
    window.notifications.type = 'alert';
    window.notifications.header = 'Sem Conexão';
    window.notifications.message = 'Você Está sem internet!';
    window.notifications.show();


}


window.notificationCaller = function(type, header,  message){
    window.notifications.type = type;
    window.notifications.header = header;
    window.notifications.message = message;
    window.notifications.show();


}
window.notifications = new Array;

window.notifications = {
  
  type: "",
  header: "",
  message: "",
  show: function(){

 
  $("#UNotification").remove();

  switch (this.type) {
    case 'alert':
  
      $("#contentmanager").append('<div style="display:none" id="UNotification" class="alert-box '+this.type+'">'
                  +'<div class="notificationMessage"><strong>'+this.header+' </strong> '+this.message+' </div>'
                  +'<a href="#" id="notificationClose">X</a>'
                  +'</div>');
      break;
    case "success":
      $("#contentmanager").append('<div style="display:none" id="UNotification" class="alert-box '+this.type+'">'
                  +'<div class="notificationMessage"><strong>'+this.header+' </strong> '+this.message+' </div>'
                  +'<a href="#" id="notificationClose">X</a>'
                  +'</div>');
    break;
    case "info":
      $("#contentmanager").append('<div style="display:none" id="UNotification" class="alert-box '+this.type+'">'
                  +'<div class="notificationMessage"><strong>'+this.header+' </strong> '+this.message+' </div>'
                  +'<a href="#" id="notificationClose">X</a>'
                  +'</div>');
    break;
    default:

  }
      $("#UNotification").fadeIn('slow');
  $("#notificationClose").click(function(){
    $("#UNotification").fadeOut('slow');
 
  })
    setTimeout(function(){
      $("#UNotification").fadeOut('slow');
             //do what you need here
    }, 8000);

  }
}

