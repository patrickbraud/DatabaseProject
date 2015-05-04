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
<title>Undergraduate/Graduate Courses</title>
</head>

<body>
<ul>
  	<li><a href="page_business_manager.php">Back</a></li>
	<br>
	<?php
    echo "<br>Undergraduate/Graduate Course Info for the Last \"n\" Years <br><br>";
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
        
        mysql_select_db('projectdb');

        $name = $_POST['name'];
        $n = $_POST['years'];
        $today = getdate();
        $year = $today["year"] - 2000 - $n;
        if($year < 0){
            $year = $year + 100;
        }
        
        echo "Searching for professor '$name'... <br><br>";
        
        $sql1 = "SELECT assign.ta_hours AS ta_hours, coursesectionlink.enrollment AS enrollment, coursesectionlink.code AS code FROM coursesectionlink, assign WHERE assign.crn = coursesectionlink.crn AND coursesectionlink.instr_name = '$name' AND coursesectionlink.year >= '$year' GROUP BY coursesectionlink.code;";
        
        $sql2 = "SELECT COUNT(DISTINCT coursesectionlink.code) AS distinctCourseCount FROM coursesectionlink WHERE coursesectionlink.instr_name = '$name' AND coursesectionlink.year >= '$year'; ";
        
        $sql3 = "SELECT COUNT(assign.new) AS totalNew FROM assign, coursesectionlink WHERE coursesectionlink.instr_name = '$name' AND coursesectionlink.year >= '$year' AND coursesectionlink.crn = assign.crn AND assign.new = 'yes';";
        
        $sql4 = "SELECT code FROM coursesectionlink WHERE year >= '$year' AND instr_name = '$name';";
        
        $counter = 0;
        
        $retval = mysql_query( $sql1, $conn );
        if(! $retval)
        {
            die('Could not update data: ' . mysql_error());
        }
        if(mysql_num_rows($retval) > 0) {
            
            // output data of each row
            echo "<table id = 't01' style = 'width:50%'> <caption>Ratios</ caption><br><br>";
            $reg_sem[] = [mysql_num_rows($retval)];
            while($row = mysql_fetch_array($retval)) {
                $reg_sem[$counter] = $row;
                $counter = $counter + 1;
            }
            echo "</table>";
            $underGradTaHours = 0;
            $underGradEnrollment = 0;
            $gradTaHours = 0;
            $gradEnrollment = 0;
            for($j = 0; $j < $counter; $j++) {
                if ($reg_sem[$j]["code"][2] < 5) {
                    $underGradTaHours += $reg_sem[$j]["ta_hours"];
                    $underGradEnrollment += $reg_sem[$j]["enrollment"];
                }
                else {
                    $gradTaHours += $reg_sem[$j]["ta_hours"];
                    $gradEnrollment += $reg_sem[$j]["enrollment"];
                }
            }
            if ($underGradEnrollment == 0) {
                $ratio1 = "No Underraduate Courses";
            }
            else {
                $underGradRatio = $underGradTaHours / $underGradEnrollment;
                $ratio1 = number_format($underGradRatio, 2, '.','');

            }
            if ($gradEnrollment == 0) {
                $ratio2 = "No Graduate Courses";
            }
            else {
                $gradRatio = $gradTaHours / $gradEnrollment;
                $ratio2 = number_format($gradRatio, 2, '.','');
            }
            echo "Ratio between total number of TA hours and the total enrollment<br>";
            echo "<tr>
                    <td> - Undergraduate: " . $ratio1 ."</td>
                    <td> - Graduate: " . $ratio2 ."</td>
                </tr>" ;
        } else {
            echo "<font color = 'red' >0 results<br>";
        }
        
        $retval1 = mysql_query( $sql2, $conn );
        if(! $retval1)
        {
            die('Could not update data: ' . mysql_error());
        }
        if(mysql_num_rows($retval1) > 0) {
            echo "<table id = 't01' style = 'width:50%'> <caption><br> Distinct and New Courses</ caption><br><br>";
            $row = mysql_fetch_array($retval1);
         
            echo "<tr>
                    <td> - Number of Distinct Courses: " . $row["distinctCourseCount"]. "</td>
                </tr>" ;
            echo "</table>";
        } else {
            echo "<font color = 'red' >0 results<br>";
        }
        
        $retval2 = mysql_query( $sql3, $conn );
        if(! $retval2)
        {
            die('Could not update data: ' . mysql_error());
        }
        if(mysql_num_rows($retval1) > 0) {
            echo "<table id = 't01' style = 'width:50%'> <caption></ caption>";
            $row = mysql_fetch_array($retval2);
            
            echo "<tr>
            <td> - Number of New Courses: " . $row["totalNew"]. "</td>
            </tr>" ;
            echo "</table>";
        } else {
            echo "<font color = 'red' >0 results<br>";
        }
        
        $totalUndergradCourses = 0;
        $totalGradCourses = 0;
        $counter = 0;
        $retval3 = mysql_query( $sql4, $conn );
        if(! $retval3)
        {
            die('Could not update data: ' . mysql_error());
        }
        if(mysql_num_rows($retval3) > 0) {
            
            // output data of each row
            echo "<table id = 't01' style = 'width:50%'> <caption><br>Total Courses</ caption><br><br>";
            $reg_sem[] = [mysql_num_rows($retval3)];
            while($row = mysql_fetch_array($retval3)) {
                $reg_sem[$counter] = $row;
                $counter = $counter + 1;
            }
            echo "</table>";
         
            for($j = 0; $j < $counter; $j++) {
                if ($reg_sem[$j]["code"][2] < 5) {
                    $totalUndergradCourses++;
                    
                }
                else {
                    $totalGradCourses++;
                }
            }
        
            echo "Ratio between total number of TA hours and the total enrollment<br>";
            echo "<tr>
            <td> - Undergraduate: " . $totalUndergradCourses ."</td>
            <td> - Graduate: " . $totalGradCourses ."</td>
            </tr>" ;
        } else {
            echo "<font color = 'red' >0 results<br>";
        }
        
        
        
        
        mysql_close($conn);
    }
    else
    {
    ?>

<form method="post" action="<?php $_PHP_SELF ?>">
    <table width="400" border="0" cellspacing="1" cellpadding="2">
		<tr>
			<td width="100">Prof. Name</td>
			<td><input name="name" type="text" id="name"></td>
		</tr>
		<tr>
			<td width="100">n Years</td>
			<td><input name="years" type="text" id="years"></td>
		</tr>
		<tr>
			<td width="100"> </td>
			<td><input name="update" type="submit" id="update" value="Search"></td>
		</tr>
	</table>
</form>
<?php
    }
    ?>
</body>
</html>

