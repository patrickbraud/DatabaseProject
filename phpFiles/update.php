<!-- Sample on get data from browser input and use it to update the database Y. Zhang -->
<?php

// Create connection
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "Example";

	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
	} 

	// collect input

    $id = $_POST['id'];
    $name = $_POST['name'];
    $shirtColor = $_POST['shirtColor'];

	
	$sql = "INSERT INTO table_1 VALUES($id, '$name', '$shirtColor')";
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