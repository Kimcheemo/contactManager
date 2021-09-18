<?php

	$inData = getRequestInfo();
	
	$id = $inData["ID"];

	$conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331", "COP4331");
	if ($conn->connect_error) 
	{	
	returnWithError( $conn->connect_error );
	} 
	else
	{
		$stmt = $conn->prepare("select * from Contacts where UserID=?");
		$stmt->bind_param("i", $inData["UserID"]);
		$stmt->execute();
		
		$result = $stmt->get_result();
		
		if ($row = $result->fetch_assoc())
		{
			returnWithInfo($row["FirstName"], $row["LastName"], $row["Company"], $row["PhoneNumber"], $row["Address"], $row["Email"]);
		}
		else
		{
			returnWithInfo( $searchResults );
		}
		
		$stmt->close();
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
		$retValue = '{"ID":0,"FirstName":"","LastName":"","error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}
	
	function returnWithInfo( $fname, $lname, $comp, $phone, $add, $email )
	{
		$retValue = '{"FirstName":"'. $fname . '","LastName":"' . $lname . '","Company":"' . $comp . '","Address":"' . $add . '","Email":"' . $email '","error":""}';
		sendResultInfoAsJson( $retValue );
	}
	
?>
