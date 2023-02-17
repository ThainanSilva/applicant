<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once'../api/sinesp/Sinesp.php';

use Sinesp\Sinesp;

$veiculo = new Sinesp;

try {
    $veiculo->buscar('jwz-4299');
    if ($veiculo->existe()) {
        print_r($veiculo->dados());
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}