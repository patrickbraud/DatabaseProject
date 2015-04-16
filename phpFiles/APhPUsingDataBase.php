<!-- Morrison, Johnathan 4/7/2015 -->
<!-- revised by Y. Zhang 4/7/2015 -->
<html>
	<head>
	<title>PHP Test</title>
	</head>
	
	<body>
	
		<?php
		// informatoin about the database you will connect to
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "Example";
		
		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		 } 
		
		$sql = "SELECT id, name, shirtColor FROM table_1 ORDER BY id";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			echo "<table id = 't01' style = 'width:100%'> <caption>Table 1</caption>";
			
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        echo "<tr> 
						<td>id: " . $row["id"]. "</td>
						<td> - Name: " . $row["name"]. "</td>
						<td> - Shirt Color: " . $row["shirtColor"]. "</td> 
					  </tr>" ;
		    }
			echo "</table>";
		} else {
		    echo "<font color = 'red' >0 results";
		}
		$conn->close();
		?> 
	
		<!-- Here is an example about input form and the processing of the data -->
		
		<form name='Input Shirt Information' action='update.php' method='post'>

		   Person Id: <input type="text" name="id" value="">
		   <br><br>
		   Person Name: <input type="text" name="name" value="">
		   <br><br>
		   Shirt Color: <input type="text" name="shirtColor" value="">
		   <br><br>
		   <input type="submit" name="submit" value="Submit"> 
		</form>
	</body>
</html>