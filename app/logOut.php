<?php
require_once('../api/classes/db.php');
require_once('../api/isLogged.php');

$user->logout();
header('location:../app');
