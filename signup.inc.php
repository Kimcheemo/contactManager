<?php
$inData = getRequestInfo();

if(isset($_POST["submit"])){
    $firstName = $_POST[$inData["FirstName"]];
    $lastName = $_POST[$inData["LastName"]];
    $login = $_POST[$inData["Login"]];
    $password = $_POST[$inData["Password"]];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(emptyInputSignup($firstName, $lastName, $login, $password) !== false){
        //sends user back to sign up page if they didnt enter the info correctly 
        header("location: ../signup.php?error=emptyinput");
        exit();
    }

    //if username already exists
    if(uidExists($conn, $login) !== false){
        //sends user back to sign up page if they didnt enter the info correctly 
        header("location: ../signup.php?error=usernametaken");
        exit();
    }

    //signs user up in our db
    createUser($conn, $firstName, $lastName, $login, $password);

}else{
    //sends user back to sign up page if they didnt enter the info correctly 
    header("location: ../signup.php");
}

function getRequestInfo()
{
	return json_decode(file_get_contents('php://input'), true);
}