<?php

$serverName = "localhost";
$dbUsername = "login";
$dbPassword = "password";
$dbName = "COP4331";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if(!$conn){
    die("Connection failed:" .mysqli_connect_error());

}