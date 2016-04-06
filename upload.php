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
	if (isset($_FILES['file'])) {
		$path_parts = pathinfo($_FILES["file"]["name"]);
		$extension = $path_parts['extension'];
		$stmt = $conn->prepare("INSERT INTO Videos (title, pathname, extension) VALUES (?,?,?)");
		$stmt->bind_param("sss", $_FILES['file']['name'], md5_file($_FILES['file']['tmp_name']), $extension);

		if ($stmt->execute() == TRUE) {
		    header( 'Location: videos.html' );
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	$conn->close();

	$target_path = "uploads/";
	//  Add the original filename to our target path.  
	// Result is "uploads/filename.extension" 
	$path_parts = pathinfo($_FILES["file"]["name"]);
	$extension = $path_parts['extension'];
	$target_path = $target_path . md5_file($_FILES['file']['tmp_name']) . ".".$extension;
	if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
    	echo "The file ".  basename( $_FILES['file']['name']). " has been uploaded";
	} else{
    	echo "There was an error uploading the file, please try again!";
	}
?>