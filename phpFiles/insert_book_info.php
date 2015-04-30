<html>
<head>
	<style>
		ul {
			list-style-type: none;
			margin: 1;
			padding: 0;
		}

		li {
			display: inline;
		}
	</style>
<title>Text Books</title>
</head>

<body>
<ul>
  	<li><a href="page_professor.php">Back</a></li>
	<br>
	<?php
    echo "<br>Insert Text Book Info<br><br>";
	?>
</ul>

<?php
	if(isset($_POST['update']))
	{
		$dbhost = 'localhost:3306';
		$dbuser = 'root';
		$dbpass = '';
		$conn = mysql_connect($dbhost, $dbuser, $dbpass);
		if(! $conn )
		{
  			die('Could not connect: ' . mysql_error());
		}
		
		$name = $_POST['name'];
		$code = $_POST['code'];
		$title = $_POST['title'];
		$author = $_POST['author'];
		$edition = $_POST['edition'];
		$isbn = $_POST['isbn'];
		$publisher = $_POST['publisher'];
		
		$sql1 = "UPDATE assign " .
				"SET book_title = '$title', book_author = '$author', " .
				"book_edition = '$edition', book_isbn = '$isbn', book_publisher = '$publisher' " . 
				"WHERE instr_name = '$name' AND " . 
				"crn = (SELECT has.crn " .
						"FROM has " .
						"WHERE has.code = '$code')";
		
		$sql2 = "SELECT section.section_num " . 
				"FROM has, section " . 
				"WHERE has.crn = section.crn AND has.code = '$code'";
				
		mysql_select_db('projectdb');
		$retval1 = mysql_query( $sql1, $conn );
		$result = mysql_query( $sql2, $conn );
		if(! $retval1)
		{
  			die('Could not update data: ' . mysql_error());
		}
		
		
		if (mysql_num_rows($result) > 0 && $retval1 != 0) {
    		// output data of each row
    		while($row = mysql_fetch_array($result)){
        		echo "Textbook has been added to $code Section " . $row['section_num'] . "<br>";
			}
		} else {
    		echo "$name is not teaching $code";
		}
		
		mysql_close($conn);
	}
	else
	{
?>

<form method="post" action="<?php $_PHP_SELF ?>">
	<table width="400" border="0" cellspacing="1" cellpadding="2">
		<tr>
			<td width="120">Professor Name</td>
			<td><input name="name" type="text" id="name"></td>
		</tr>
		<tr>
			<td width="120">Course Code</td>
			<td><input name="code" type="text" id="code"></td>
		</tr>
		<tr>
			<td width="100">Text Title</td>
			<td><input name="title" type="text" id="title"></td>
		</tr>
		<tr>
			<td width="100">Author</td>
			<td><input name="author" type="text" id="author"></td>
		</tr>
		<tr>
			<td width="100">Edition</td>
			<td><input name="edition" type="text" id="edition"></td>
		</tr>
		<tr>
			<td width="100">ISBN#</td>
			<td><input name="isbn" type="text" id="isbn"></td>
		</tr>
		<tr>
			<td width="100">Publisher</td>
			<td><input name="publisher" type="text" id="publisher"></td>
		</tr>
		<tr>
			<td width="100"> </td>
			<td><input name="update" type="submit" id="update" value="Add"></td>
		</tr>
	</table>
</form>
<?php
}
?>
</body>
</html>