<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('../api/classes/db.php');
require_once('../api/isLogged.php');
require_once('../api/companycheck.php');
require $_SERVER['DOCUMENT_ROOT'].'/api/classes/Service.php';
$service = new Service();
 
//header('Content-Type: json/application; charset=utf-8');

$service->post('auth', function ($jsonRequest, $contentType) {// autenticação

    try {
        include './routes/auth.php';
    } catch (Exception $ex) {

    }


}, 'json');




$service->get('api', function ($jsonRequest, $contentType) {// autenticação

    try {
 
        echo "Cannot get this page";
    } catch (Exception $ex) {

    }


}, 'json');



$service->post('/vaga', function ($request, $contentType) {// autenticação

    try {
        echo "teste1";
    } catch (Exception $ex) {

    }


}, 'json');


$service->get('vaga/get', function ($request, $contentType) {// autenticação

    try { 
            // Recebe os dados da vaga e requisitos
        echo "Teste";
    } catch (Exception $ex) {

    }


}, 'json');
 