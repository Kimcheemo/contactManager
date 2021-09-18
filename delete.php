
<?php

	$inData = getRequestInfo();
	
	$id = $inData["ID"];

	$conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331", "COP4331"); 	
	if( $conn->connect_error )
	{
		returnWithError( $conn->connect_error );
	}
	else
	{
		$stmt = $conn->prepare("DELETE FROM Contacts WHERE ID=?");
		$stmt->bind_param("i", $id);
		$stmt->execute();

		$check = conn->prepare("SELECT * FROM Contacts WHERE ID=?");
		$check->bind_param("i",$id);
		$check->execute();
		$result = $check->get_result();

		if( $row = $result->fetch_assoc() )
		{
			returnWithError("Deletion unsuccessful");
		}
		else
		{
			returnWithError("");
		}
		
		$check->close();
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
		$retValue = '{"error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}
	
	function returnWithInfo( $firstName, $lastName, $id, $email, $company, $address)
	{
		$retValue = '{"id":' . $id . ',"firstName":"' . $firstName . '","lastName":"' . $lastName . ',"email":"' . $email . ',"company":"' . $company . ',"address":"' . $address .'","error":""}';
		sendResultInfoAsJson( $retValue );
	}
	
?>
