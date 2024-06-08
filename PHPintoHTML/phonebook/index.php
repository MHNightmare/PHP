<?php
session_start();
if(!isset($_SESSION["user"]))
	header('location:Login.php');
elseif(isset($_POST['btnLogout']))
{
	unset($_SESSION['user']);
	header('location:Login.php');
}	
	include('connection.php');
	if(isset($_GET['action']))
		switch($_GET['action'])
		{
			case 'delete' :
				$q = "delete from Phonebook where EID=".$_GET['id'];
				$conn->query($q);
			break;
			case 'edit' :
				$q = "SELECT * FROM Phonebook where EID=".$_GET['id'] ;
				$persons = $conn->query($q);
				if($persons->num_rows>0)
				$person = $persons->fetch_assoc();
		}	
?>
<html>
	<head>
		<title>دفتر تلفن</title>
		<link rel="icon"  href="images (1).jfif" />
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-theme.css">
		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="css/style.css">
		<script src="jQuery.js"></script>
		<script src="ckeditor/ckeditor.js" ></script>
		<script>
			$(document).ready(function(){
				//profile creating
				$('.name').mouseover(function(event){
					$.get('fetchInfo.php?eid='+$(this).data('eid') , function(data , status){
						if(status=="success")
						{
							if($('#info').length>0)
								$('#info').remove();
							var info = data.split(";")
							var rell = info[6] 
								if(rell==1)
									var rell = "خانواده"
								if(rell==2)
									var rell = "دوستان"
								if(rell==3)
									var rell = "شغلی"
							var infoWin = $('<div id="info"></div>')
							infoWin.html("<div id='photo'><img src='uploads/"+info[2]+"/"+info[3]+"' /></div><div id='textInfo'>نام : "+info[0]+"<br />نام خانوادگی : "+info[1]+"<br />شماره تماس : "+info[2]+"<br /> تلگرام : "+info[4]+"<br/> نسبت :"+rell+"<br/> توضیحات :"+info[5]+"<br/> تاریخ ثبت : <span dir='ltr'> "+info[7]+"</span></div>")
							infoWin.css('left' , event.clientX);
							infoWin.css('top' , event.clientY);
							$('body').append(infoWin)
							infoWin.show()
						}
					})
				})
				$('a').mouseleave(function(){
					$('#info').remove();
				})
				//search input text
				
				$('#txtFilter').keyup(function(){
					$.get("Search.php?fname="+$(this).val()+"&rid="+$('#Rell2').val() , function(data , status){
						if(status=="success")
						{
							$('tbody').empty()
							$('tbody').html(data)
						}
					})
				})
				
				$('#Rell2').change(function(){
					$.get("Search.php?fname="+$('#txtFilter').val()+"&rid="+$(this).val() , function(data , status){
						if(status=="success")
						{
							$('tbody').empty()
							$('tbody').html(data)
						}
					})
				})
				/*
				$('#del').click(function(){
					$.get('del.php?eid='+$(this).data('eid') , function(data , status){
					})
				})
				
				$('#btnSave').click(function(){
					var data = CKEDITOR.instances.Data.getData();
					$.get('update.php?eid='+$('#editedPerson').val()+"&Data="+var data , function(data , status){
				})
				*/
			})	
		</script>
		
	</head>
	<body dir="rtl" >
		<div class="form-group" id="form">
			<form action="" method="post">
				<input type="submit" class="btn btn-danger" value="خروج" id="btnLogout" name="btnLogout" />
			</form>
			<form method="post" action="" class="form-horizontal" enctype="multipart/form-data">
			
				<label class="control-label"> نام : </label> 
				<input type="text" name="FName" class="form-control" value="<?php if(!empty($person)) echo $person['FName']; else echo ""; ?>"/>					
				<label class="control-label"> نام خانوادگی : </label> 
				<input type="text" name="LName" class="form-control" value="<?php if(!empty($person)) echo $person['LName']; ?>"/> 				
				<label class="control-label"> شماره : </label> 
				<input type="text" id="Number" name="Number" class="form-control" value="<?php if(!empty($person)) echo $person['Num']; ?>"/> 
				<select name="sltRell" class="btn btn-primary dropdown-toggle">
					<option value="0" > یک گروه را انتخاب کنید </option>
					<?php
					//sltbtn
						$q= "select RID , RName from relationship";
						$rells = $conn->query($q);
						if($rells->num_rows>0)
							while($rell = $rells->fetch_assoc())
							{
								echo "<option value='".$rell['RID']."'" ;
								if(!empty($person) && $rell['RID'] == $person['Rell'])
									echo "selected='selected'";
								echo ">".$rell['RName']."</option>";
							}
					?>
				</select>	<br/>
				<label class="control-label"> تلگرام: </label> 
				<input type="text" name="Tlgrm" class="form-control" value="<?php if(!empty($person)) echo $person['Tlgrm']; ?>"/> 
				<label class="control-label"> توضیحات: </label> 
				<input type="text" id="Data" name="Data" class="form-control " value="<?php if(!empty($person)) echo $person['Data']; ?>"/>	
		<!--	<?php
					if(!empty($person))
						echo "
						<script type='text/javascript'>
							CKEDITOR.replace('Data',{
							language: 'fa'
							});   
						</script>";
				?>
		-->		
				<label class="control-label"> عکس : </label>  
				<input type="file" value="جستجو" name="Photo" class=""/> <?php if(!empty($person)) echo "<input type='checkbox' name='chkbox'/> عکس تغییر نکند <br/>"  ?>
				<input type="submit" id="<?php if(!empty($person)) echo "btnModify"; else echo "btnSave" ;?>" value="<?php if(!empty($person)) echo "بروزرسانی"; else echo "ذخیره" ;?>" name="<?php if(!empty($person)) echo "btnModify" ; else echo  "btnSave" ;?>" class="btn btn-defult"/>		
				<input type="hidden" id="editedPerson" name="editedPerson" value="<?php if(!empty($person)) echo $person['EID']; ?>" />				
			</form>
			<?php
			//insert (save)
				if(isset($_POST["btnSave"]))
				{
					if((($_FILES['Photo']['type']== "image/jpeg") || ($_FILES['Photo']['type']== "image/jpg")||($_FILES['Photo']['type']== "image/png") || ($_FILES['Photo']['type']== "image/gif")) && ($_FILES['Photo']['size']< 1048576)) 
					{
						$aks = $_FILES["Photo"]["name"];
						$Pn = explode("." , $aks);
						$photo = "profilePhoto.".$Pn[1];
							
							include('date.php');
							$data = $_POST['Data'];
							$fname = $_POST['FName'];	
							$lname = $_POST['LName'];
							$number = $_POST['Number'];
							$rell = $_POST['sltRell'];
							$tele = $_POST['Tlgrm'];
							if(!file_exists("uploads/$number/"))
								mkdir("uploads/$number/");
							move_uploaded_file($_FILES['Photo']['tmp_name'] , "uploads/$number/$photo");
							if(strlen($_POST['FName'])>5 && strlen($_POST['LName'])>5 && strlen($_POST['Number'])>8)
							{
								$q = "INSERT INTO Phonebook (FName , LName , Num , PName , Tlgrm , Data , Rell , Date) 
								VALUES ('$fname' , '$lname' , '$number' , '$photo' , '$tele' , '$data' , '$rell' , '$date')";
								$added = $conn->query($q) ;
								if($added)
								echo $conn->affected_rows."نفر اضافه شد";
							}
							else
								echo "طول بازه داده ها کم است" ;
							
					}
					else
						echo "لطفا فایلی با پسوند
						jpg 
						ویا
						jpeg
						ویا
						png
						ویا
						gif
						انتخاب نمیایید" ;
				}
				// edit ba aks
				if(isset($_POST["btnModify"]))
				{
					if(!isset($_POST['chkbox']))
					{
						if((($_FILES['Photo']['type']== "image/jpeg") || ($_FILES['Photo']['type']== "image/jpg")||($_FILES['Photo']['type']== "image/png") || ($_FILES['Photo']['type']== "image/gif")) && ($_FILES['Photo']['size']< 1048576)) 
						{
							
							$aks = $_FILES["Photo"]["name"];
							$Pn = explode("." , $aks);
							$photo = "profilePhoto.".$Pn[1];
								
								include('date.php');
								$data = $_POST['Data'];
								$fname = $_POST['FName'];	
								$lname = $_POST['LName'];
								$number = $_POST['Number'];
								$rell = $_POST['sltRell'];
								$tele = $_POST['Tlgrm'];
								$file = "uploads/$number/$photo";
								unlink($file);
								move_uploaded_file($_FILES['Photo']['tmp_name'] , "uploads/$number/$photo");
								if(strlen($_POST['FName'])>5 && strlen($_POST['LName'])>5 && strlen($_POST['Number'])>8)
								{
									$q = "Update Phonebook 
									set
									FName = '$fname' ,
									LName =  '$lname' ,
									Num = '$number' ,
									Rell = '$rell' ,
									Tlgrm = '$tele' ,
									Data = '$data' ,
									PName = '$photo',
									Date = '$date'
									where EID =".$_POST['editedPerson'];
									$edited = $conn->query($q) ;
									if($edited)
									{
										echo $conn->affected_rows."نفر ویرایش شد";
										$person="";
									}	
								}
								else
									echo "طول بازه داده ها کم است" ;
								
						}
						else
							echo "لطفا فایلی با پسوند
							jpg 
							ویا
							jpeg
							ویا
							png
							ویا
							gif
							انتخاب نمیایید" ;
					}
					else
						//edit bedoone aks
					{
						include('date.php');
						$data = $_POST['Data'];
						$fname = $_POST['FName'];	
						$lname = $_POST['LName'];
						$number = $_POST['Number'];
						$rell = $_POST['sltRell'];
						$tele = $_POST['Tlgrm'];
						if(strlen($_POST['FName'])>5 && strlen($_POST['LName'])>5 && strlen($_POST['Number'])>8)
						{
							$q = "Update Phonebook
							set
							FName = '$fname' ,
							LName =  '$lname' ,
							Num = '$number' ,
							Rell = '$rell' ,
							Tlgrm = '$tele' ,
							Data = '$data',
							Date = '$date'
							where EID =".$_POST['editedPerson'];
							$edited = $conn->query($q) ;
							if($edited)
							{
								echo $conn->affected_rows."نفر ویرایش شد";
								$person="";
								//header('location:index.php');
							}
								
						}
						else
							echo "طول بازه داده ها کم است" ;
						
					}
				}
			?>

			
		</div>	
		<center>
			<input type="search" placeholder="جستجو" id='txtFilter'   />
			<select name="sltRell2" id="Rell2" class="btn btn-primary dropdown-toggle">
					<option value="0" > همه </option>
					<?php
					//sltbtn serach
						$q= "select RID , RName from relationship";
						$rells = $conn->query($q);
						if($rells->num_rows>0)
							while($rell = $rells->fetch_assoc())
							{
								echo "<option value='".$rell['RID']."'" ;
								echo ">".$rell['RName']."</option>";
								
							}
					?>
			</select>
		</center>
				<br/>
			<?php
			//print table
				$q = "SELECT EID , FName , LName , Num , PName , Data , Date FROM Phonebook" ;
				$names = $conn->query($q);
				if($names->num_rows>0)
					echo "<table class='table-striped' id='myTable' align='center'>
							<thead>
							<tr align ='center'>
								<td>     </td>
								<td> عکس </td>
								<td> نام </td>
								<td> شماره </td>	
								<td>     </td>
							</tr>
							</thead>
							<tbody>";
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
			?>
			<div>
			</div>
	</body>
</html>