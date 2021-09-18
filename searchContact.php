<?php

	$inData = getRequestInfo();
	
	$searchResults = "";
	$searchCount = 0;

	$conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331", "COP4331");
	if ($conn->connect_error) 
	{	
	returnWithError( $conn->connect_error );
	} 
	else
	{
		$stmt = $conn->prepare("select * from Contacts where FirstName like ? and UserID=?");
		$fName = "%" . $inData["search"] . "%";
		$stmt->bind_param("si", $fName, $inData["UserID"]);
		$stmt->execute();
		
		$result = $stmt->get_result();
		
		while($row = $result->fetch_assoc())
		{
		if( $searchCount > 0 )
		{
			$searchResults .= ",";
		}
		$searchCount++;
		$searchResults .= '{ "ID":"' . $row["ID"] . '","FirstName":"' . $row["FirstName"] . '","LastName":"' . $row["LastName"] . '","PhoneNumber":"' . $row["PhoneNumber"] . '","Email":"' . $row["Email"] . '","Address":"' . $row["Address"] . '","Company":"' . $row["Company"] . '"}';
		}
		
		if( $searchCount == 0 )
		{
			returnWithError( "There are no results matching your search!" );
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
	
	function returnWithInfo( $searchResults )
	{
		$retValue = '{"results":[' . $searchResults . '],"error":""}';
		sendResultInfoAsJson( $retValue );
	}
	
?>
