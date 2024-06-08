<?php
	include('connection.php');
	$EID=mysqli_real_escape_string($conn, $_GET['editedPerson']);
	$Data=mysqli_real_escape_string($conn, $_GET['data']);
	$q = "update phonebook 
	set
	Data = '$Data' 
	where EID =".$EID;
	$conn->query($q);
?>