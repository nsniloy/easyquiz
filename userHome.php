<?php
	session_start();
	$useremail = $_SESSION['useremail'];
	if($useremail == "")header('Location: login.php');
	$questionNo = 0;
	$question = "";
	$option1 = "";
	$option2 = "";
	$option3 = "";
	$option4 = "";
	$answer = "";
	$userpoint = 0;
	$point = 0;

	$conn = mysql_connect("localhost","root","root");
	mysql_select_db('easyquize');
	$query = "SELECT * FROM `users` WHERE email = '".$useremail."'";
	$result = mysql_query($query);
	if(mysql_num_rows($result) != 0){
		if($row = mysql_fetch_assoc($result)){
			$userpoint = $row['total_point'];
		}
	}
	mysql_free_result($result);

	$query = "SELECT * FROM `questions` WHERE serial_no NOT IN ( SELECT qus_no FROM `answered` WHERE user_id = '".$useremail."')";
	$result = mysql_query($query);
	if(mysql_num_rows($result) != 0){
		if($row = mysql_fetch_assoc($result)){
			$questionNo = $row['serial_no'];
			$question = $row['question'];
			$option1 = $row['option_1'];
			$option2 = $row['option_2'];
			$option3 = $row['option_3'];
			$option4 = $row['option_4'];
			$answer = $row['answer'];
			$point = $row['point'];
		}
	}
	mysql_free_result($result);
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		if(isset($_POST['option']) && $_POST['option'] == $answer){
			$userpoint += $point;
			$query = "UPDATE users SET total_point = ".$userpoint." WHERE email = '".$useremail."'";
			mysql_query($query);
			$query = "INSERT INTO `answered`(`a_serial_no`, `qus_no`, `user_id`) VALUES (null,".intval($questionNo).", '".$useremail."')";
			mysql_query($query);
		}
		else{
			if($userpoint > 0){
				$userpoint--;
				$query = "UPDATE users SET total_point = ".$userpoint." WHERE email = '".$useremail."'";
				mysql_query($query);
			}
			else{
				echo "<script>";
				echo "alert('You have very low point, plz correct the answer');";
				echo "</script>";
			}
		}
	}
		$query = "SELECT * FROM `questions` WHERE serial_no NOT IN ( SELECT qus_no FROM `answered` WHERE user_id = '".$useremail."')";
		$result = mysql_query($query);
		if(mysql_num_rows($result) != 0){
			if($row = mysql_fetch_assoc($result)){
				$questionNo = $row['serial_no'];
				$question = $row['question'];
				$option1 = $row['option_1'];
				$option2 = $row['option_2'];
				$option3 = $row['option_3'];
				$option4 = $row['option_4'];
				$answer = $row['answer'];
				$point = $row['point'];
			}
		}
		mysql_free_result($result);
		if($question == ""){
			echo "<script>";
			echo "alert('NO Question Avaliable.')";
			echo "</script>";
			header('Refresh:0 url=login.php');
		}
?>
<html>
	<head>
		<title>User Home</title>
	</head>
	<body>
		<button style='float:right;'><a href='logout.php'>Logout</a></button>
		<center>
			<h1>Answer The Question</h1>
			<p>User Point: <strong><?php echo $userpoint; ?></strong></p>
			<br>
			<br>
			<form action='' method='post'>
				<table>
					<tr>
						<td>Question: </td>
						<td><pre><?php echo $question; ?></pre></td>
					</tr><br>
					<tr>
						<td><code><input type='checkbox' name='option' value='<?php echo $option1; ?>'><?php echo $option1; ?></code></td>
						<td><code><input type='checkbox' name='option' value='<?php echo $option2; ?>'><?php echo $option2; ?></code></td>
					</tr><br>
					<tr>
						<td><code><input type='checkbox' name='option' value='<?php echo $option3; ?>'><?php echo $option3; ?></code></td>
						<td><code><input type='checkbox' name='option' value='<?php echo $option4; ?>'><?php echo $option4; ?></code></td>
					</tr><br>
					<tr>
						<td></td>
						<td><input type='submit' name='Submit' value='Submit'></td>
					</tr>
				</table>
			</form>
		</center>
	</body>
</html>
