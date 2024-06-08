<?php
	include('connection.php');
	$fname = mysqli_real_escape_string($conn, $_GET['fname']);
	$rid = mysqli_real_escape_string($conn, $_GET['rid']);
	if($fname!="")
	{
		$q = "select * from Phonebook where FName like'".$fname."%'";
		$names = $conn->query($q);
				if($names->num_rows>0)
					while($name = $names->fetch_assoc())
						if($rid==('0'))
						{
							echo "<tr>";
							echo "<td><a id='del' data-eid=".$name['EID']."  href='index.php?action=delete&id=".$name['EID']."'><img id='delete' src='download.jfif'/></a></td>";
							echo "<td><img id='pro' src='uploads/".$name['Num']."/".$name['PName']."'/></td>";
							echo "<td><a data-eid='".$name['EID']."' class='name' href='#'>".$name['FName']." ".$name['LName']."</a></td>";
							echo "<td>".$name['Num']."</td>";
							echo "<td><a href='index.php?action=edit&id=".$name['EID']."'><img id='edit' src='images.png'/></a></td>";
							echo "</tr>";
						}
						elseif($name['Rell']==$rid)
						{
							echo "<tr>";
							echo "<td><a id='del' data-eid=".$name['EID']."  href='index.php?action=delete&id=".$name['EID']."'><img id='delete' src='download.jfif'/></a></td>";
							echo "<td><img id='pro' src='uploads/".$name['Num']."/".$name['PName']."'/></td>";
							echo "<td><a data-eid='".$name['EID']."' class='name' href='#'>".$name['FName']." ".$name['LName']."</a></td>";
							echo "<td>".$name['Num']."</td>";
							echo "<td><a href='index.php?action=edit&id=".$name['EID']."'><img id='edit' src='images.png'/></a></td>";
							echo "</tr>";
						}
							
			echo "</tbody></table>";
	}
	elseif($fname=="") 
	{
		$q = "select * from Phonebook where Rell = ".$rid;
		$names = $conn->query($q);
		if($names->num_rows==0)
		{
			$q = "select * from Phonebook" ;
			$names = $conn->query($q);
			if($names->num_rows>0)
					while($name = $names->fetch_assoc())
						{
							echo "<tr>";
							echo "<td><a id='del' data-eid=".$name['EID']."  href='index.php?action=delete&id=".$name['EID']."'><img id='delete' src='download.jfif'/></a></td>";
							echo "<td><img id='pro' src='uploads/".$name['Num']."/".$name['PName']."'/></td>";
							echo "<td><a data-eid='".$name['EID']."' class='name' href='#'>".$name['FName']." ".$name['LName']."</a></td>";
							echo "<td>".$name['Num']."</td>";
							echo "<td><a href='index.php?action=edit&id=".$name['EID']."'><img id='edit' src='images.png'/></a></td>";
							echo "</tr>";
						}
						echo "</tbody></table>";
		}
		else
		{
			if($names->num_rows>0)
				while($name = $names->fetch_assoc())			
					if($name['Rell']==$rid)
						{
							echo "<tr>";
							echo "<td><a id='del' data-eid=".$name['EID']."  href='index.php?action=delete&id=".$name['EID']."'><img id='delete' src='download.jfif'/></a></td>";
							echo "<td><img id='pro' src='uploads/".$name['Num']."/".$name['PName']."'/></td>";
							echo "<td><a data-eid='".$name['EID']."' class='name' href='#'>".$name['FName']." ".$name['LName']."</a></td>";
							echo "<td>".$name['Num']."</td>";
							echo "<td><a href='index.php?action=edit&id=".$name['EID']."'><img id='edit' src='images.png'/></a></td>";
							echo "</tr>";
						}
							
			echo "</tbody></table>";
		}
		
	}
	
?>