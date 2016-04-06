<?php
	$servername = "localhost";
	$username = "root";
	$password = "password";
	$dbname = "sunyin";
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	$resArray = array();
	$sql_select = "SELECT id,title, pathname, extension FROM videos;";
	$result = $conn->query($sql_select);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			array_push($resArray, $row);
		}
		$result = json_encode($resArray);
	} else {
	    $result = "[]";
	}
	echo $result;

	// header("Content-type: video/webm");
	#header('Content-disposition: attachment; filename="thing.pdf"');
	

	$conn->close();
?>