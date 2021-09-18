
<?php
	$inData = getRequestInfo();
	
	$first = $inData["FirstName"];
	$last = $inData["LastName"];
    $phone = $inData["PhoneNumber"];
    $email = $inData["Email"];
    $address = $inData["Address"];
    $company = $inData["Company"];
    $userID = $inData["UserID"];


	$conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331", "COP4331");
	if ($conn->connect_error) 
	{
		returnWithError( $conn->connect_error );
	} 
	else
	{
		$stmt = $conn->prepare("INSERT into Contacts (FirstName, LastName, PhoneNumber, Email, Address, Company, UserID) VALUES(?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssi", $first, $last, $phone, $email, $address, $company, $userID);
        $stmt->execute();
        $result = $stmt->get_result();
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
    function returnWithInfo( $firstName, $lastName, $id )
    {
        $retValue = '{"FirstName":"' . $first . '","LastName":"' . $last . '","PhoneNumber":"' . $phone . '","Email":"' . $email . '","Address":"' . $address . '","Company":"' . $company . '","ID":"' . $userID . '"}';
        sendResultInfoAsJson( $retValue );
    }
	
?>
