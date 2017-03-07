<?php
include('../../api/classes/db.php');
session_start();

   if($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])){

   }
   include_once '../../api/classes/company.php';
   $company = new company($db_connect);



?>

<script>

  $(document).ready(function(){
    /* defining global variables*/
    loadvisitorsType();
    window.webcamactive = 0;
    window.editingVisitor = 0;
    window.visitorPicture = "";
  })

  

  function loadvisitorsType(){
    $.ajaxSetup({
    timeout: 6000, //time in miliseconds
    error:function(xhr){
      noConnection();
      }
    });


    $.ajax({
      method: "POST",
      url: "../api/visitorsUniversal.php",
      data:{json: '[{"function":"GetVisitorsType"}]'}
    })

    .done(function( data ) {
      console.log(data);
      window.visitorsReceiveobj = data;     
      window.visitorsReceiveobj = jQuery.parseJSON(data);
      outptstring = "";    
      if(window.visitorsReceiveobj.result != "empty"){
        for (var k in window.visitorsReceiveobj){
        
          outptstring += " <tr>";
          outptstring += "<td><input type='checkbox' value='1'></td>";
          outptstring += "<td>"+window.visitorsReceiveobj[k].name+"</td>";      
          outptstring += "<td>"
                            +"<a title='Registrar Acesso' class='deleteVisitorType' data-toggle='confirmation' class='btn btn-large btn-primary'  visitorTypeId='"+window.visitorsReceiveobj[k].id+"' href='#'>"
                              +"<center>"
                                +"<i class='fa fa-trash' aria-hidden='true'>"
                                +"</i>"
                              +"</center>"
                            +"</a>"
                        +"</td>";

          outptstring += "</tr>"
        } 
      } 

      $("#visitor_table tbody").html(outptstring)

      $('.deleteVisitorType').on('click', function (e) {
        var idVisitorType = $(this).attr("visitorTypeId")
        console.log(idVisitorType);
        $.ajaxSetup({
          timeout: 6000, //time in miliseconds
          error:function(xhr){
            noConnection();
            }
          });

          /*$.ajax({
            method: "POST",
            url: "../api/visitorsUniversal.php",            
            data:{json: '[{"function":"DeleteVisitorsType","id":"'+idVisitorType+'"}]'}            
          })
          
          .done(function( data ){
            loadvisitorsType();
            console.log(data);
            if(data == "true"){
              console.log("entrou no if");
              
            }
          })*/
      })
      $('[data-toggle=confirmation]').confirmation();
    })
}

</script>
<script src="../js/bootstrap.min.js.download"></script>
<div class="panel panel-default customWindow" >
  <div class="panel-heading">Visitantes </div>
  <div class="panel-body">

<div class="row">
    <div class="col-lg-6">
  <div class="btn-group" role="group" aria-label="...">
    <button  type="button" class="btn btn-success btn-outline" id="" data-toggle="modal" data-type='0' data-whatever="@mdo">
  <i class="fa fa-user-plus" aria-hidden="true"></i>  Novo Visitante</button>    
  </div> </div>
  <div class="col-lg-6">

  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
<br/>
      <div id="visitors-table" class="bs-example usertable " data-example-id="simple-table">
        <table id="visitor_table" class="table table-striped">
          <thead>
            <tr>
              <th></th>
              <th>Tipo Visitante</th>
              <th><center>Ação</center></th>
            </tr>
          </thead>
          <tbody class="tab_to_roll">
           </tbody>
        </table>
      </div>
    </div>
  </div>