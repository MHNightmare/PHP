<?php
	session_start();
	include('connection.php');
	if(isset($_POST['btnLogin']))
	{
		$q = "select UName , Pass from Users";
		$users = $conn->query($q);
		if($users->num_rows>0)
			while($user= $users->fetch_assoc())
				if($_POST['uname']==$user['UName'] && $_POST['psw']==$user['Pass'] )
				{
					$_SESSION['user'] = $_POST['uname'];
					header('location:index.php');
				}			
	}
?>
<html>
	<head>
		<link rel="icon"  href="login.jpg" />
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-theme.css">
		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
		<script src="jQuery.js"></script>
		<style>
			/*
			img
			{
				hight : 100px;
				width : 100px;
			}
			*/
			main
			{
				align : center;
				background-color : navy;
			}

			input[type=text], input[type=password] 
			{
				width: 50%;
				padding: 12px 20px;
				margin: 8px 0;
				display: inline-block;
				border: 1px solid #ccc;
				box-sizing: border-box;
			}

			/* Set a style for all buttons */
			#btnLogin
			{
				background-color: #4CAF50;
				color: white;
				padding: 14px 20px;
				margin: 8px 0;
				border: none;
				cursor: pointer;
				width: 50%;
			}

			/* Add a hover effect for buttons */
			#btnLogin:hover 
			{
				opacity: 0.8;
			}

			/* Center the avatar image inside this container */
			.imgcontainer 
			{
				text-align: center;
				margin: 24px 0 12px 0;
			}

			/* Avatar image */
			img.avatar 
			{
				width: 20%;
				//border-radius: 50%;
			}

			/* Add padding to containers */
			.container 
			{
				padding: 16px;
			}

			/* The "Forgot password" text */
			span.psw 
			{
				float: right;
				padding-top: 16px;
			}

			/* Change styles for span and cancel button on extra small screens */
			@media screen and (max-width: 300px) 
			{
				span.psw 
				{
					display: block;
					float: none;
				}
				.cancelbtn 
				{
					width: 50%;
				}
			}

		</style>
	</head>
	<body dir="rtl">
		<div id="main" align="center">
			<form action="" method="post">
				<div class="imgcontainer">
					<img src="login.jpg" alt="Avatar" class="avatar">
				</div>

				<div class="container">
					<label for="uname"><b>نام کاربری</b></label> <br/>
					<input type="text" placeholder="  نام کاربری" name="uname" required> </br>

					<label for="psw"><b>رمز</b></label> <br/>
					<input type="password" placeholder="رمز" name="psw" required> </br><br/>
					<input type="submit" id ="btnLogin" name="btnLogin" value="ورود">
					
				</div>
			</form>
		</div>
	</body>
</html>