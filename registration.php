<?php
	$name = "";
	$password = "";
	$email = "";
	$nameErr = "";
	$passwordErr = "";
	$emailErr = "";
	$nameflag = false;
	$passwordflag = false;
	$emailflag = false;

	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		if($_POST['name'] == ""){
			$nameErr = "Name Feild Can;t Be Empty";
		}
		else{
			$name = $_POST['name'];
			$nameflag = true;
		}
		if($_POST['password'] == ""){
			$passwordErr = "Password Feild Can;t Be Empty";
		}
		else{
			$passwordflag = true;
			$password = $_POST['password'];
		}
		if($_POST['email'] == ""){
			$emailErr = "Email Feild Can;t Be Empty";
		}
		else{
			if(strpos ($_POST['email'], "@") < 1 || strpos ($_POST['email'], ".") < 1){
				$emailErr = "Please Insert A Valid Email.";
				$emailflag = false;
			}
			else {
				$email = $_POST['email'];
				$emailflag = true;
			}
		}

		if($nameflag && $passwordflag && $emailflag){
			$conn = mysql_connect("localhost","root","root");
			mysql_select_db('easyquize');
			$query = "INSERT INTO `users`(`name`, `password`, `role`, `email`, `total_point`) VALUES ('$name','$password','USER','$email',0)";
			mysql_query($query);

			echo "<script>";
			echo "alert('Registration Successful.');";
			echo "</script>";

			header('Refresh:0; url=login.php');
		}
	}
?>
<html>
	<head>
		<title>Registration</title>
	</head>
	<body>
		<center>
			<h1>Registration</h1>
			<form action='' method='post'>
				<table>
					<tr>
						<td>Name: </td>
						<td><input type='text' name='name' value='<?php echo $name;?>'></td>
						<td style='color:red;'><?php echo $nameErr; ?></td>
					</tr>
					<tr>
						<td>Password: </td>
						<td><input type='password' name='password' value='<?php echo $password;?>'></td>
						<td style='color:red;'><?php echo $passwordErr; ?></td>
					</tr>
					<tr>
						<td>Email: </td>
						<td><input type='text' name='email' value='<?php echo $email;?>'></td>
						<td style='color:red;'><?php echo $emailErr; ?></td>
					</tr>
					<tr>
						<td></td>
						<td><input type='submit' name='submit' value='Register'></td>
					</tr>
				</table>
			</form>
		</center>
	</body>
</html>
