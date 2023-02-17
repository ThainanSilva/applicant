<?php
include('../../api/classes/db.php');
session_start();

   if($userProfile = $priv->getUserProfile($_SESSION['user_id'], $_SESSION['company_id'])){

   }
   include_once '../../api/classes/company.php';
   $company = new company($db_connect);



?>
 
<script>
$(document).ready(function (){
     window.jsontosend = {"function":"getDevices"}; 
    GetDevices();
    function actionFormatter(value, row, index) {
    return [
        '<a class="like" href="javascript:void(0)" title="Like">',
        '<i class="glyphicon glyphicon-heart"></i>',
                '</a>',
                '<a class="edit ml10" href="javascript:void(0)" title="Edit">',
                '<i class="glyphicon glyphicon-edit"></i>',
                '</a>',
                '<a class="remove ml10" href="javascript:void(0)" title="Remove">',
                '<i class="glyphicon glyphicon-remove"></i>',
                '</a>'
            ].join('');
        }

        window.actionEvents = {
            'click .like': function (e, value, row, index) {
                alert('You click like icon, row: ' + JSON.stringify(row.id));
                console.log(value, row, index);
            },
            'click .edit': function (e, value, row, index) {
                alert('You click edit icon, row: ' + JSON.stringify(row));
                console.log(value, row, index);
            },
            'click .remove': function (e, value, row, index) {
                alert('You click remove icon, row: ' + JSON.stringify(row));
                console.log(value, row, index);
            }
        };



        function GetDevices() {
            $.ajaxSetup({
                timeout: 6000, //time in miliseconds
                error: function (xhr) {
                    noConnection();
                }});
            $.ajax({
                url: "../api/devicesUniversal",
                type: "POST",
                data: JSON.stringify(jsontosend),
                contentType: "application/json; charset=utf-8"

            }).done(function (data) {
                console.log(data);
                $('#devicesTable').bootstrapTable({
                    onRefresh: function () {
                        GetDevices()
                    },
                    onSort: function () {
                        alert('ola');
                    },
                    columns: [{

                            field: 'deviceInfo',
                            title: 'Dispositivo',
                            sortable: true,

                        }, {
                            field: 'ambiente',
                            title: 'Ambiente',
                            sortable: true
                        }, {
                            field: 'datetime',
                            title: 'Ultima sincronização',
                            sortable: true
                        }, {
                            field: 'options',
                            title: 'Opções',
                            formatter: actionFormatter(),
                            events: actionEvents
                        }],
                    data: data,
                    columnDefaults: {checkbox: true}
                });
            });
        }


    });

</script>
<div class="panel panel-default customWindow" >
  <div class="panel-heading">Dispositivos </div>
  <div class="panel-body">

<div class="row">
  <div class="col-lg-6"> 
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
<br/>
    
<table id="devicesTable" data-height="500" class="table table-striped table-bordered" data-search="true"
       data-show-refresh="true"
       data-show-columns="true"
       data-sort-order="desc"></table>
    
    </div>
  </div>




 
