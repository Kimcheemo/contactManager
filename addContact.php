<?php
	$inData = getRequestInfo();

    //variables
    $firstName = "";
    $lastName = "";
    $phoneNumber = "";
    $email = "";
    $address = "";
    $company = "";
    $userID = 0;
    
    //added our username, password, and database name
    
	$conn = new mysqli("localhost", "ubuntu", "password", "COP4331");
	if ($conn->connect_error) 
	{
		returnWithError( $conn->connect_error );
	} 
	else
	{
        //include 5 ?'s for the values and changed INSERT into "Contact" and added FN, LN, PH, and email to ()
		$stmt = $conn->prepare("INSERT into Contact (firstName, lastName, phoneNumber, email, address, company) VALUES(?,?,?,?,?,?)");
        //changed the bind_param to include new variables
		$stmt->bind_param("sssiss", $_POST["firstName"], $_POST["lastName"], $_POST["phoneNumber",], $_POST["email"], $_POST["address"],$_POST["company"]);
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
