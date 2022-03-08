<html>

<body>
	<?php
	$StudentCWID = $_POST["StudentCWID"];
	$hostname = "mariadb";
	$username = "cs332a18";
	$password = "project";

	$link = new mysqli($hostname, $username, $password, $username);

	if ($link->connect_error) {
		die("Connection failed: " . $link->connect_error);
	}
	echo "Student’s CWID: ", $StudentCWID, "<br> <br>";


	$query4 = "SELECT Title, Grade FROM RECORDS R, COURSE C, SECTION S WHERE R.CWID = '$StudentCWID' AND R.Course_sec = S.Section_num AND S.Course_num = C.Course_num";
	$result = $link->query($query4);

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			echo "Course Title: ", $row["Title"], "<br>";
			echo "Grade: ", $row["Grade"], "<br> <br>";
		}
	} else {
		echo "0 results";
	}
	$result->free_result();
	$link->close();

	?>
</body>

</html>