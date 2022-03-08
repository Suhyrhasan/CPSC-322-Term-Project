<html>

<body>
	<?php

	$CourseNum = $_POST["CourseNum"];
	$SectionNum = $_POST["SectionNum"];
	$hostname = "mariadb";
	$username = "cs332a18";
	$password = "project";
   
	$link = new mysqli($hostname, $username, $password, $username);

	if ($link->connect_error) {
		die("Connection failed: " . $link->connect_error);
	}
	echo "Course Number: ", $CourseNum, " Section Number: ", $SectionNum, "<br> <br>";


	$query2 = "SELECT Grade, COUNT(Grade) AS Gradecount FROM RECORDS R, COURSE C, SECTION S WHERE C.Course_num = '$CourseNum' AND S.Section_num = '$SectionNum' AND S.Course_num = C.Course_num AND R.Course_sec = S.Section_num GROUP BY Grade";
	$result = $link->query($query2);

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			echo "Number of ", $row["Grade"], " : ", $row["Gradecount"], "<br> <br>";
		}
	} else {
		echo "0 results";
	}
	$result->free_result();
    $link->close();
	?>
</body>

</html>