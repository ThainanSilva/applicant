<?php

include_once $_SERVER['DOCUMENT_ROOT'].'/app/initializer.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/api/classes/privileges.php';
 
$priv = new privileges($db_connect);

if ($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])) {}

include_once $_SERVER['DOCUMENT_ROOT'].'/api/classes/company.php';
$company = new company($db_connect);
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">

<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>

<script src='https://unpkg.com/tesseract.js@v2.0.0-alpha.13/dist/tesseract.min.js'></script>
<script>
    $(document).ready(function() {

        $(document).ready(function() {
  $('#visitor_table').DataTable( {
    "language": {
        url:"//cdn.datatables.net/plug-ins/1.13.2/i18n/pt-BR.json"
        },
    dom: 'Bfrtip',
    buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print'
    ]
  } );
} );






    })
    //############################################################################################

</script>
<div class="panel panel-default customWindow">
    <div class="panel-heading">Vagas</div>
    <div class="panel-body">

        <div class="row">
            <div class="col-lg-6">
                <div class="btn-group" role="group" aria-label="...">
                    <button type="button" class="btn btn-success btn-outline" data-toggle="modal" data-type='0' data-target="#newVisitorModal" data-whatever="@mdo">
                        <i class="fa fa-user-plus" aria-hidden="true"></i> Novo Visitante
                    </button>
                    <!--
                    <button type="button" class="btn btn-primary btn-outline  "><i class="fa fa-history"
                                                                                   aria-hidden="true"></i> Ultimos
                        acessos
                    </button>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-info dropdown-toggle btn-outline" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-plus-sign"
                                                                                 aria-hidden="true"></span>
                            Mais
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="fa fa-sign-in" aria-hidden="true"></i> Importar</a></li>
                            <li><a href="#"><i class="fa fa-sign-out" aria-hidden="true"></i> Expotar</a></li>
                        </ul>
                    </div>-->
                </div>
            </div>
            <div class="col-lg-6">
                <div class="input-group">
                    <input type="text" id="serchinputvisitor" class="form-control" placeholder="Procure por: Nome, CPF, Perfil.">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"> <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Pesquisar</button>
                    </span>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <br />
        <div>








        <table id="visitor_table" class="display table table-striped" style="width:100%">
  <thead>
    <tr>
      <th>Nome</th>
      <th>Descriçao</th> 
      <th>Exigencias</th>
      <th>Criado em</th>
      <th>Salario</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Auxiliar Técnico</td>
      <td>System Architect</td> 
      <td>61</td>
      <td>2011/04/25</td>
      <td>R$1.500,00</td>
    </tr>
    <!-- Add more rows here -->
  </tbody>
</table>







        </div>
        <div id="pager">
            <nav aria-label="...">
                <ul id="pagination" class="pagination">

                </ul>
            </nav>
        </div>
    </div>

</div>


<!--  #########################################   modal novo visitante  #########################################-->
<div class="modal fade bs-example-modal-lg" id="newVisitorModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header" style="background-color: #337ab7;border-radius: 4px 4px 0 0; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel">Novo Visitante</h4>
            </div>
            <div class="modal-body">


                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist" id="configtabs">
                    <li role="presentation" class="active"><a href="#cadastro" aria-controls="cadastro" role="tab" data-toggle="tab"><i class="fa fa-user" aria-hidden="true"></i> Cadastro</a>
                    </li>
                    <li role="presentation"><a href="#schedules" aria-controls="schedules" role="tab" data-toggle="tab"><i class="fa fa-clock-o" aria-hidden="true"></i> Período</a></li>
                    <li role="presentation"><a href="#vehicles" aria-controls="vehicles" role="tab" data-toggle="tab"><i class="fa fa-car" aria-hidden="true"></i> Veiculos</a></li>
                    <!--<li role="presentation"><a href="#profiles" aria-controls="profiles" role="tab" data-toggle="tab"><i class="fa fa-map-marker" aria-hidden="true"></i> locais</a></li>-->
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">

                    <!--  #########################################   tab dados cadastrais do visitante  #########################################-->
                    <div role="tabpanel" class="tab-pane active" id="cadastro">
                        <!-- tab Geral -->

                        <form>
                            <br />
                            <fieldset>
                                <legend>Dados Pessoais</legend>

                                <div class="form-group col-md-4 ">
                                    <!--- tipo de visitante -->
                                    <label for="recipient-name" class="control-label">Tipo de Visitante:</label>
                                    <select type="text" class="form-control" id="visitor_type_new">

                                    </select>
                                </div>
                                <!--- fim tipo de visitante -->
                                <div class="form-group col-md-4">
                                    <!--- nome -->
                                    <label for="message-text" class="control-label ">Nome:</label>
                                    <Input type="text" class="form-control" id="NameNewVisitor">
                                </div>
                                <!--- nome -->
                                <div class="form-group col-md-4">
                                    <!--- CPF -->
                                    <label for="message-text" class="control-label">CPF:</label>
                                    <Input type="text" class="form-control" id="CPFNewVisitor" />
                                </div>
                                <!--- fim CPF -->
                            </fieldset>
                            <div class="form-group col-xs-6">
                                <!--- foto -->
                                <label for="message-text" style="display:block;" class=" ">Foto:</label>
                                <div style=" width: 240px; height: 185px;box-shadow: 0 0 27px -8px black;" class="img-thumbnail">
                                    <div id="visitorVideoelm" style="
                                                                                                                                       font-size: 174px;
                                                                                                                                       text-align: center;
                                                                                                                                       color: #d6e3ef;
                                                                                                                                       ">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="174" height="174" viewBox="0 0 349.75 349.749" style="enable-background:new 0 0 349.75 349.749;fill: #a2bbd2;" xml:space="preserve">
                                            <g>
                                                <g>
                                                    <path d="M174.881,0C78.441,0,0,78.441,0,174.875c0,96.434,78.441,174.874,174.887,174.874c96.422,0,174.863-78.44,174.863-174.874    C349.75,78.441,271.309,0,174.881,0z M127.08,141.626l0.352-0.384c1.426-1.036,2.12-2.657,1.861-4.354    c-3.522-21.191-1.21-30.027-0.43-32.246c6.155-18.891,25.476-27.628,29.268-29.177c0.808-0.318,2.3-0.769,3.813-1.003l0.451-0.105    l3.104-0.165l0.024,0.192l0.72-0.069c0.64-0.069,1.252-0.153,2.021-0.315l0.685-0.146c0.606,0.009,8.127,0.96,19.302,4.386    l7.765,2.672c14.201,4.194,20.734,11.997,21.947,13.57c11.373,12.884,8.322,32.339,5.506,42.784    c-0.318,1.231-0.126,2.498,0.57,3.549l0.643,0.793c0.823,1.12,1.562,5.438-0.906,14.609c-0.469,2.786-1.501,5.05-3.026,6.575    c-0.564,0.619-0.961,1.408-1.104,2.3c-3.844,22.533-24.031,47.741-45.315,47.741c-18.06,0-38.671-23.19-42.379-47.723    c-0.141-0.916-0.522-1.724-1.156-2.417c-1.543-1.601-2.528-3.906-3.122-7.317C125.861,148.958,125.684,143.785,127.08,141.626z     M86.539,239.346c0.783-0.991,5.149-6.107,13.979-9.476c7.764-2.385,26.956-8.762,37.446-16.363    c0.492-0.265,0.976-0.781,1.378-1.189c0.97-1.045,2.453-2.642,4.209-4.27l0.979-0.93l0.997,0.937    c9.242,8.713,19.467,13.486,28.796,13.486c9.8,0,19.903-4.239,29.241-12.273l0.732-0.625l1.981,0.961    c1.771,1.621,4.834,3.849,6.257,4.527l1.825,0.89l-0.191,0.197l0.811,0.492c1.723,1.039,3.597,2.048,5.795,3.135    c2.222,0.979,4.083,1.699,6.004,2.336c1.622,0.528,10.257,3.423,20.08,7.963l1.874,0.564c9.607,3.681,13.871,8.791,14.291,9.325    c11.403,16.897,15.774,48.429,17.402,65.999c-29.784,24.181-67.242,37.493-105.531,37.493c-38.308,0-75.771-13.312-105.541-37.506    C70.947,287.498,75.282,256.068,86.539,239.346z"></path>
                                                </g>
                                            </g>
                                        </svg>
                                    </div>
                                </div>
                                <div style="
                                     float: right;
                                     margin-right: 44%;
                                     margin-top: 11px;
                                     ">
                                    <button type="button" class="btn btn-primary btn-outline" id="capturePictureVisitor">Usar Foto
                                    </button>
                                    <button type="button" disabled class="btn btn-primary btn-outline" id="capturepicvisitor">Capturar Foto
                                    </button>
                                </div>
                            </div>
                            <!--- fim foto -->

                            <div class=" col-xs-6">
                                <!--- documento -->

                                <div class="form-group col-md-4 ">
                                    <div>
                                        <label for="message-text" class="control-label">Documento:</label>
                                    </div>
                                    <select type="text" class="form-control" id="visitor_type_new">
                                        <option>C.N.H</option>
                                        <option selected>RG</option>


                                    </select>
                                </div>
                                <div class="form-group col-md-8">
                                    <div>
                                        <label for="message-text" class="control-label">Nro:</label>
                                    </div>
                                    <Input type="text" class="form-control" id="" />
                                </div>
                            </div>
                            <!--- fim documento -->


                            <div class=" col-xs-6">
                                <!--- integração -->

                                <div class="form-group col-md-8">
                                    <div>
                                        <label for="message-text" class="control-label">Integração:</label>
                                    </div>
                                    <Input type="date" class="form-control" id="" />
                                </div>
                            </div>
                            <!--- fim integração -->


                            <div class=" col-xs-6">
                                <!--- Endereço -->

                                <div class="form-group col-md-8">
                                    <div>
                                        <label for="message-text" class="control-label">Endereço:</label>
                                    </div>
                                    <Input type="text" class="form-control" id="" />
                                </div>

                                <div class="form-group col-md-4">
                                    <div>
                                        <label for="message-text" class="control-label">Numero:</label>
                                    </div>
                                    <Input type="text" class="form-control" id="" />
                                </div>
                            </div>
                            <!--- fim endereço -->


                            <div class=" col-xs-6">
                                <!--- integração -->

                                <div class="form-group col-md-8 ">
                                    <div>
                                        <label for="message-text" class="control-label">Empresa:</label>
                                    </div>
                                    <select type="text" class="form-control" id="visitor_type_new">
                                        <option>empresateste1</option>
                                        <option selected>empresa teste 2</option>
                                        <option selected>empresa teste 4</option>


                                    </select>
                                </div>
                            </div>
                            <!--- fim integração -->

                            <div style="margin-top:50px;" class="form-group col-md-4">
                                <!--- documento -->

                            </div>
                            <!--- fim documento -->
                            <hr>
                            <!---  <div class="form-group col-xs-6 row" > documento
        
        
                              <div class="col-md-4">
                                <label>
                                 <input type="checkbox"> Veículo
                               </label>
                             </div>
                                <div class="col-md-4">
                                  <label for="message-text" class="control-label">Placa:</label>
                                  <Input type="text" disabled class="form-control" id="" / >
                                </div>
                                <div class="col-md-4">
                                  <label for="message-text" class="control-label">Marca/Modelo:</label>
                                  <Input type="text" disabled class="form-control" id="" / >
                                </div>
                              </div> fim documento -->
                            <div class="form-group clearfix ">
                                <!--- foto -->
                            </div>

                        </form>
                    </div><!-- fim da tab geral -->


                    <!--  #########################################   tab periodo dde visita do visitante  #########################################-->
                    <div role="tabpanel" class="tab-pane" id="schedules">
                        <br />
                        <fieldset>
                            <legend>Período</legend>
                            <div class="form-group col-md-4 ">
                                <!--- tipo de visitante -->
                                <label for="recipient-name" class="control-label">Periodo de Visita:</label>
                                <select type="text" class="form-control" id="visitor_type_new">
                                    <option>Personalizado</option>
                                    <option selected>Visita única 24 horas</option>
                                    <option>Até 2 dias</option>
                                    <option>Até o proximor mês</option>
                                    <option>Até 6 meses</option>
                                    <option>Até um ano</option>

                                </select>
                            </div>
                            <!--- fim tipo de visitante -->
                            <div class="form-group col-xs-6 row">
                                <!--- documento -->
                                <div class="col-xs-6"><label for="message-text" class="control-label">Data de
                                        Inicio:</label>
                                    <Input type="date" class="form-control" value="<?php echo date("Y-m-j"); ?>" id="inAccessDate" />
                                </div>
                                <div class="col-xs-6"><label for="message-text" class="control-label">Data de
                                        Final:</label>
                                    <?php $day = 1 + date("j"); ?>
                                    <Input type="date" class="form-control" disabled value="<?php echo date("Y") . '-' . date("m") . '-' . $day; ?>" id="inAccessDate" />
                                </div>
                            </div>
                            <!--- fim documento -->
                        </fieldset>
                        <div class="form-group clearfix ">
                            <!--- foto -->
                        </div>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="e">...asd</div>
                    <div role="tabpanel" class="tab-pane" id="vehicles">
                        <br />
                        <fieldset>
                            <legend>Veículos</legend>


                            <div class="form-group col-xs-6 row">

                                <div class="form-group col-md-8">
                                    <div>
                                        <label for="message-text" class="control-label">Placa:</label>
                                    </div>
                                    <Input type="text" class="form-control" id="" />
                                </div>
                                <div class="form-group col-md-8">
                                    <div>
                                        <label for="message-text" class="control-label">Marca/Modelo:</label>
                                    </div>
                                    <Input type="text" class="form-control" id="" />
                                </div>
                                <div class="form-group col-md-8">
                                    <div>
                                        <label for="message-text" class="control-label">Chassi:</label>
                                    </div>
                                    <Input type="text" class="form-control" id="" />
                                </div>


                            </div>
                            <div class="form-group col-xs-6">
                            <div style="">
                                    <button type="button" class="btn btn-primary btn-outline" id="capturePicturePlate">Usar Foto
                                    </button>
                                    <button type="button" disabled class="btn btn-primary btn-outline" id="capturepicPlate">Capturar placa
                                    </button>
                                </div>
                                <!--- foto -->
                                <label for="message-text" style="display:block;" class=" ">Foto:</label>
                                <div style=" width: 240px; height: 185px;box-shadow: 0 0 27px -8px black;" class="img-thumbnail">
                                    <div id="plateCamElm" style="">

                                    </div>
                                </div>
                                
                            </div>
                            <!--- fim foto -->
                        </fieldset>
                        <div class="form-group clearfix ">
                            <!--- foto -->
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <?php if ($priv->GetUsersInfo('visitors', $userProfile) > 1) { ?>
                        <button type="button" id="SaveNewVisitor" class="btn btn-primary">Salvar</button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- ######################### inicio do modal de registro rápidpo de acesso ############################-->


<div class="modal fade bs-example-modal-lg" id="RegistNewAcessModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header" style="background-color: #337ab7;border-radius: 4px 4px 0 0; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel">Registrar Acesso</h4>
            </div>
            <div class="modal-body">
                <fieldset>
                    <legend>Tipo de acesso:</legend>
                    <label for="entradaAccess"> Entrada</label>
                    <input class="registerAccessType" id="entradaAccess" name="registerAccessType" value="1" type="radio" />
                    <label for="saidaAccess">saida</label>
                    <input class="registerAccessType" id="saidaAccess" name="registerAccessType" value="0" type="radio" />
                </fieldset>
                <p class="visitorRegistText" id="visitorRegistAccessName">Registrar o acesso de: </p>
                <p class="visitorRegistText" id="visitorRegistAccesstimedate"></p>

                <label>Observações:</label>
                <textarea></textarea>

                <div class="modal-footer">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

                    <input type="hidden" id="onscreen_access" value="<?php echo $company->getCompanyConfig($_SESSION['company_id'], 'onscreen_access'); ?>" />

                    <?php if ($priv->GetUsersInfo('registeraccess', $userProfile) > 1) { ?>
                        <button type="button" id="SaveVisitorAccesRegister" class="btn btn-primary">Registrar</button>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>