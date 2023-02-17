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
      window.visitorsReceiveobj = data;
      outptstring = "";    
      if(window.visitorsReceiveobj.result != "empty"){
        for (var k in window.visitorsReceiveobj){
        
          outptstring += " <tr>";
          outptstring += "<td><input type='checkbox' value='1'></td>";
          outptstring += "<td>"+window.visitorsReceiveobj[k].name+"</td>";      
          outptstring += "<td>"
                            +"<a title='Deseja realmente excluir?' data-btn-ok-label='Sim' data-btn-cancel-label='N&atilde;o' class='tipov btn btn-large btn-primary'  visitorTypeId='"+window.visitorsReceiveobj[k].id+"' href='#'>"
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

      function DeleteVisitorType(idVisitorType) {        
         
        $.ajaxSetup({
          timeout: 6000, //time in miliseconds
          error:function(xhr){
              console.log(xhr)
            toastr.error(xhr.responseText)
            }
          });

          $.ajax({
            method: "POST", 
            url: "../api/visitorsUniversal.php",            
            data:{json: '[{"function":"DeleteVisitorsType","id":"'+idVisitorType+'"}]'}            
          })
          
          .done(function( data ){
            loadvisitorsType();
            
            if(data.result  === "error"){
                toastr.error(data.message, 'O perfil não pode ser excluido.')
              
            }if(data.result  === "success"){
                toastr.success(data.message)
              
            }
          })
      }
      
      
      $('.tipov').confirmation({
                onConfirm: function() {
                  var idVisitorType = $(this).attr("visitorTypeId")
                  DeleteVisitorType(idVisitorType)
                },
                onCancel: function() {
                  
                }
  
    }) 
      $(".tipov").click(function(){
          $(this).confirmation("show")
                 
      })
    })
}

</script>

<div class="panel panel-default customWindow" >
  <div class="panel-heading">Visitantes </div>
  <div class="panel-body">

<div class="row">
    <div class="col-lg-6">
  <div class="btn-group" role="group" aria-label="...">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newvisitortype">
  Novo tipo de Visitante
</button>   
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

<!-- Modal Novo perfil-->
                <div class="modal fade" id="newvisitortype" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Novo tipo de Visitante</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
 
        </button>
      </div>
      <div class="modal-body">
          <label>Nome do tipo de visitante</label>
          <input type="text" class="form-control" placeholder="Nome do tipo de visitante" id="Visitortypename" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary">Salvar Novo tipo de visitante</button>
      </div>
    </div>
  </div>
</div>

            