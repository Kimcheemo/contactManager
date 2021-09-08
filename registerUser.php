//not edited yet
<?php

	$inData = getRequestInfo();
	
	$userID = 0;
	$login = "";
	$password = "";
    $phoneNumber = "";
    $email = "";

	$conn = new mysqli("localhost", "login", "password", "COP4331");
	if( $conn->connect_error )
	{
		returnWithError( $conn->connect_error );
	}
	else
	{
        //creates new user with login, password, phone#, and email
		$stmt = $conn->prepare("INSERT INTO Contact(login, password, phoneNumber, email) Values(?,?,?,?");
        //hides password
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$stmt->bind_param("ssss", $_POST["login"], $password, $_POST["phoneNumber", $_POST["email"]]);
		$stmt->execute();
		$result = $stmt->get_result();

		if( $row = $result->fetch_assoc()  )
		{
            //returns the login name and ID, not the password for security purpose
			returnWithInfo( $row['login'], $row['userID'] );
		}
		else
		{
			returnWithError("No Records Found");
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
		$retValue = '{"userID":0,"login":"","error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}
	
	function returnWithInfo( $firstName, $lastName, $id )
	{
		$retValue = '{"userID":' . $userID . ',"login":"' . $login . '","error":""}';
		sendResultInfoAsJson( $retValue );
	}
	
?>
