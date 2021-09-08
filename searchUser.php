<?php

	$inData = getRequestInfo();
	
	$searchResults = "";
	$searchCount = 0;

    //added our username, password, and database name
	$conn = new mysqli("localhost", "login", "password", "COP4331");
	if ($conn->connect_error) 
	{
		returnWithError( $conn->connect_error );
	} 
	else
	{
        //changed select name from "Color" to "Contect"
		$stmt = $conn->prepare("select Name from Contact where Name like ? and UserID=?");
        
        //chagned to $inData[FN], [LN]
		$userName = "%" . $inData["search"] . "%";
		$stmt->bind_param("sss", $inData[firstName], $inData[lastName], $inData["userID"]);
		$stmt->execute();
		
		$result = $stmt->get_result();
		
		while($row = $result->fetch_assoc())
		{
			if( $searchCount > 0 )
			{
				$searchResults .= ",";
			}
			$searchCount++;
            
            //changed to firstName and lastName and userID print out
			$searchResults .= '"' . $row["userID"] . '"''"' . $row["firstName"] . '"''"' . $row["lastName"] . '"';
		}
		
		if( $searchCount == 0 )
		{
			returnWithError( "No Records Found" );
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
		$retValue = '{"userID":0,"firstName":"","lastName":"","error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}
	
	function returnWithInfo( $searchResults )
	{
		$retValue = '{"results":[' . $searchResults . '],"error":""}';
		sendResultInfoAsJson( $retValue );
	}
	
?>
