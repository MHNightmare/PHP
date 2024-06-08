<?php
	include('connection.php');
	$eid = mysqli_real_escape_string($conn,.$_GET['eid']);
	$q = "delete from phonebook 
	where EID = ".$eid;
	$conn-query($q);
?>