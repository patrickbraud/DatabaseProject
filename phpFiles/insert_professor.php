<!-- Sample on get data from browser input and use it to update the database Y. Zhang -->
<?php

// Create connection
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "projectdb";

	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
	} 

	// collect input

    $newProfName = $_POST['newProfName'];
    $hireDate = $_POST['hireDate'];
    $tenured = $_POST['tenured'];
    $profTitle = $_POST['profTitle'];

	
	$sql = "INSERT INTO professor VALUES('$newProfName', '$tenured', '$profTitle')";
	echo $sql;
	$result = $conn->query($sql);
	
	if ($result == false) {
		die('Query failed: ' . mysql_error());
	}
    
    $sql = "INSERT INTO instructor Values('$newProfName', '$hireDate')";
    echo $sql;
    $result = $conn->query($sql);
    
    if ($result == false) {
        die('Query failed" ' .mysql_error());
    }

	
?>


</body>