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

    $newProfId = $_POST['newProfID'];
    $hireDate = $_POST['hireDate'];
    $tenured = $_POST['tenured'];
    $profTitle = $_POST['profTitle'];

	
	$sql = "INSERT INTO table_1 VALUES('$newProfId', '$tenured', '$profTitle')";
	echo $sql;
	$result = $conn->query($sql);
	
	if ($result == false) {
		die('Query failed: ' . mysql_error());
	}

	// output to the screen
	echo "<table>";  	
	  echo "<tr> 
					<td>id: " . $id. "</td>
					<td> - Name: " . $name. "</td>
					<td> - Shirt Color: " . $shirtColor. "</td> 
	        </tr>" ;
		echo "</table>";
?>


</body>