<?php
	include('connection.php');
	$q = "select * from Phonebook WHERE EID = ".$_GET['eid'];
	$persons = $conn->query($q);
	if($persons->num_rows>0)
	{
		$person = $persons->fetch_assoc();
		echo $person['FName'].";".$person['LName'].";".$person['Num'].";".$person['PName'].";".$person['Tlgrm'].";".$person['Data'].";".$person['Rell'].";".$person['Date'];
	}
?>