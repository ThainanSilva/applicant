<?php
include('../../api/classes/db.php');
session_start();

   if($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])){

   }
   include_once '../../api/classes/company.php';
   $company = new company($db_connect);



?>

<script></script>
<div class="panel panel-default customWindow" >
  <div class="panel-heading">Dispositivos </div>
  <div class="panel-body">

<div class="row">
  <div class="col-lg-6">
    <div class="input-group">
      <input type="text" id="serchinputvisitor" class="form-control" placeholder="Procurar dispositivo: ">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button"> <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Pesquisar</button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
<br/>
      <div id="visitors-table" class="bs-example usertable " data-example-id="simple-table">
        <table id="visitor_table" class="table table-striped table-bordered">
          <thead>
            <tr>
 
              <th>Nome</th>
              <th>Tipo</th>
              <th>IP</th>
              <th>Ultima Sincronização</th>
            </tr>
          </thead>
          <tbody class="tab_to_roll">
           </tbody>
        </table>
      </div>
    </div>
  </div>




 
