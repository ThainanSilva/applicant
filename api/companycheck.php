<?php

if( $_SESSION['company_id'] == 0 || $_SESSION['company_id'] == ""){
	header("location: chooseCompany.php");

}
