<div class="panel panel-default customWindow" >
  <div class="panel-heading">Acessos </div>
  <div class="panel-body">

<div class="row">
    <div class="col-lg-6">
  <div class="btn-group" role="group" aria-label="Periodo">
        <label>De</label>
      <input  type="date" class="btn btn-success btn-outline" data-toggle="modal" data-type='0' data-target="#newVisitorModal" data-whatever="@mdo">
  
    <input type="date" class="btn btn-primary btn-outline  "> 
    <div class="btn-group" role="group">
      <button type="button" class="btn btn-info dropdown-toggle btn-outline" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
        Mais
        <span class="caret"></span>
      </button>
      <ul class="dropdown-menu">
        <li><a href="#"><i class="fa fa-sign-in" aria-hidden="true"></i> Importar</a></li>
        <li><a href="#"><i class="fa fa-sign-out" aria-hidden="true"></i> Expotar</a></li>
      </ul>
    </div>
  </div> </div>
  <div class="col-lg-6">
    <div class="input-group">
      <input type="text" id="serchinputvisitor" class="form-control" placeholder="Procure por: Nome, CPF, Perfil.">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button"> <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Pesquisar</button>
      </span>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
<br/>
      <div id="visitors-table" class="bs-example usertable " data-example-id="simple-table">
        <table id="visitor_table" class="table table-striped">
          <thead>
            <tr>
              <th></th>
              <th>Nome</th>
              <th>Perfil de acesso</th>
              <th>Opções</th>
            </tr>
          </thead>
          <tbody class="tab_to_roll">
           </tbody>
        </table>
      </div>
    </div>
  </div>