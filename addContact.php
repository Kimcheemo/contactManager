<?php
	$inData = getRequestInfo();
	
	$first = $inData["FirstName"];
	$last = $inData["LastName"];
    $phone = $inData["PhoneNumber"];
    $email = $inData["Email"];
    $address = $inData["Address"];
    $company = $inData["Company"];
    $userID = $inData["UserId"];


	$conn = new mysqli("localhost", "root", "WeLoveCOP4331", "COP4331");
	if ($conn->connect_error) 
	{
		returnWithError( $conn->connect_error );
	} 
	else
	{
		$stmt = $conn->prepare("INSERT into Contacts (FirstName, LastName, PhoneNumber, Email, Address, Company) VALUES('$first', '$last', '$phone', '$email', '$address', '$company', '$userID')");
		mysqli_query($conn, $stmt);
		$stmt->execute();
		$stmt->close();
		$conn->close();
		returnWithError("");
	}

	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	function sendResultInfoAsJson( $obj )
	{
		header('Content-type: application/json');
		echo $obj;
	}
	
	function returnWithError( $err )
	{
		$retValue = '{"error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}
	
?>
