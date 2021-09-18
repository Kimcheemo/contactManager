
<?php

	$inData = getRequestInfo();
	
	$id = 0;
	$firstName = $inData["FirstName"];
	$lastName = $inData["LastName"];
    $userName = $inData["Login"];
    $password = $inData["Password"];

	$conn = new mysqli("localhost", "root", "WeLoveCOP4331", "COP4331");
	if( $conn->connect_error )
	{
		returnWithError( $conn->connect_error );
	}
	else
	{
		$stmt = $conn->prepare("INSERT into Users (FirstName, LastName, Login, Password) VALUES (?,?,?,?)");
        
        //FROM Users WHERE Login=? AND Password =?");
		$stmt->bind_param("ssss", $firstName, $lastName, $userName, $password);
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
