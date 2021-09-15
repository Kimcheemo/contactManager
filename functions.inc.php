<?php

function emptyInputSignup($firstName, $lastName, $login, $password){
    $result;
    if(empty($firstName) || empty($lastName) || empty($login) || empty($password)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function uidExists($conn, $login){
    $sql = "SELECT * FROM Users WHERE Login = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    //bound data from user to statment
    mysqli_stmt_bind_param($stmt, "s", $userName);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        $result = false;
        return $result;
    }
    mysqli_stmt_close($stmt);
}

//signs up user for website
function createUser($conn, $firstName, $lastName, $login, $password){
    $sql = "INSERT INTO Users (FirstName, LastName, Login, Password) VALUES (?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    //bound data from user to statment
    mysqli_stmt_bind_param($stmt, "ssss", $firstName, $lastName, $login, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?error=none");
        exit();
}

function emptyInputLogin($login, $password){
    $result;
    if(empty($login) || empty($password)){
        $result = true;
    }else{
        $result = false;
    }
    return $result;
}

function loginUser($conn, $login, $password){
    $loginExists = uidExists($conn, $login);

    if($loginExists === false){
        header("location: ../login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $loginExists["Password"];
    $checkPwd = password_verify($password, $pwdHashed);

    if($checkPwd === false){
        header("location: ../login.php?error=wronglogin");
        exit();
    }else if($checkPwd === true){
        session_start();
        $_SESSION["ID"] = $uidExists["ID"];
        $_SESSION["login"] = $uidExists["Login"];

        //send back to the home page aka change the .php file
        //header("location: ../login.php?error=wronglogin");
        //exit();
    }
}