<?php

	$inData = getRequestInfo();
	
	$id = $inData["ID"];
	$firstName = $inData["FirstName"];
	$lastName = $inData["LastName"];
	$email = $inData["Email"];
	$phone = $inData["PhoneNumber"];
	$company = $inData["Company"];
	$address = $inData["Address"];

	$conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331", "COP4331"); 	
	if( $conn->connect_error )
	{
		returnWithError( $conn->connect_error );
	}
	else
	{
		
		$select = $conn->prepare("SELECT * FROM Contacts WHERE ID=?");
		$select->bind_param("i", $id);
		$select->execute();
		$result = $select->get_result();

		if($row = $result->fetch_assoc())
		{
			$stmt = $conn->prepare("UPDATE Contacts SET FirstName=?, LastName=?, Email=?,PhoneNumber=?, Company=?, Address=? WHERE ID=?");
			$stmt->bind_param("ssssssi", $firstName, $lastName, $email, $phone, $company, $address, $id);
			$stmt->execute();
			$stmt->close();
			returnWithError("");
		}
		else
		{
			returnWithError("No Records Found");
		}
		$select->close();
		$conn->close();
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
		$retValue = '{"Error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}
	
	function returnWithInfo( $firstName, $lastName, $id,$phone, $email, $company, $address)
	{
		$retValue = '{"ID":' . $id . ',"FirstName":"' . $firstName . '","LastName":"' . $lastName .',"PhoneNumber":"'. ',"Email":"' . $email . ',"Company":"' . $company . ',"Address":"' . $address .'","Error":""}';
		sendResultInfoAsJson( $retValue );
	}
	
?>
