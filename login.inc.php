<?php

$inData = getRequestInfoLogin();

if(isset($_POST["submit"])){

    $login = $_POST[$inData["Login"]];
    $password = $_POST[$inData["Password"]];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputLogin($login, $password) !== false){
        //sends user back to sign up page if they didnt enter the info correctly 
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $login, $password);
}else{

    header("location: ../login.php");
        exit();
}

function getRequestInfoLogin()
{
	return json_decode(file_get_contents('php://login.inc.php'), true);
}