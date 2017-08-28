<?php
	session_start();
	$emailErr = "";
	$passwordErr = "";
	$email = "";
	$password = "";
	$emailflag = false;
	$passwordflag = false;
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		if($_POST['email'] == ""){
				$emailErr = "Email Feild Can't Be Empty.";
				$emailflag = false;
		}
		else{
			if(strpos ($_POST['email'], "@") < 1 || strpos ($_POST['email'], ".") < 1){
				$emailErr = "Please Inser A Valid Email.";
				$emailflag = false;
			}
			else {
				$email = $_POST['email'];
				$emailflag = true;
			}
		}
		if($_POST['password'] == ""){
				$passwordErr = "Password Feild Can't Be Empty.";
				$passwordflag = false;
		}
		else {
			$password = $_POST['password'];
			$passwordflag = true;
		}

		if($passwordflag && $emailflag){
			$conn = mysql_connect("localhost","root","root");
			mysql_select_db('easyquize');
			$query = "SELECT * FROM `users` WHERE `email` = '".$email."' AND `password` = '".$password."'";
			$result = mysql_query($query);
			if(mysql_num_rows($result) != 0){
				if($row = mysql_fetch_assoc($result)){
					if($row['role'] == "ADMIN"){
						header('Location: adminHome.php');
					}else if($row['role'] == "USER"){
						$_SESSION['username'] = $row['name'];
						$_SESSION['useremail'] = $row['email'];
						header('Location: userHome.php');
					}
				}
			}
			mysql_free_result($result);
		}
	}
?>
<html>
	<head>
		<title>login</title>
	</head>
	<body>
		<center>
			<form action='#' method='post'>
				<table>
					<tr>
						<td>Email:</td>
						<td><input type='text' name='email' value='<?php echo $email;?>'></td>
						<td style='color:red;'><?php echo $emailErr;?></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><input type='password' name='password' value='<?php echo $password;?>'></td>
						<td style='color:red;'><?php echo $passwordErr;?></td>
					</tr>
					<tr>
						<td></td>
						<td><input type='submit' name='Submit' value='Login'></td>
					</tr>
				</table>
			</form>
		</center>
	</body>
</html>
