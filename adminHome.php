<?php
	session_start();
	$useremail = $_SESSION['useremail'];
	if($useremail == "")header('Location: login.php');
	$question = "";
	$option1 = "";
	$option2 = "";
	$option3 = "";
	$option4 = "";
	$answer = "";
	$questionErr = "";
	$option1Err = "";
	$option2Err = "";
	$option3Err = "";
	$option4Err = "";
	$answerErr = "";
	$questionflag = false;
	$option1flag = false;
	$option2flag = false;
	$option3flag = false;
	$option4flag = false;
	$answerflag = false;
	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		if($_POST['question'] == ""){
			$questionErr = "Question Feild cant't be Empty.";
		}
		else {
			$question = $_POST['question'];
			$questionflag = true;
		}
		if($_POST['option1'] == ""){
			$option1Err = "Option can't be empty.";
		}
		else {
			$option1 = $_POST['option1'];
			$option1flag = true;
		}
		if($_POST['option2'] == ""){
			$option2Err = "Option can't be empty.";
		}
		else {
			$option2 = $_POST['option2'];
			$option2flag = true;
		}
		if($_POST['option3'] == ""){
			$option3Err = "Option can't be empty.";
		}
		else {
			$option3 = $_POST['option3'];
			$option3flag = true;
		}
		if($_POST['option4'] == ""){
			$option4Err = "Option can't be empty.";
		}
		else {
			$option4 = $_POST['option4'];
			$option4flag = true;
		}
		if($_POST['answer'] == ""){
			$answerErr = "answer can't be empty.";
		}
		else {
			$answer = $_POST['answer'];
			$answerflag = true;
		}
		if($questionflag && $option1flag && $option2flag && $option3flag && $option4flag && $answerflag){
			$conn = mysql_connect("localhost","root","root");
			mysql_select_db('easyquize');
			$query = "INSERT INTO `questions`(`serial_no`, `question`, `option_1`, `option_2`, `option_3`, `option_4`, `answer`, `point`) VALUES (null,'$question','$option1','$option2','$option3','$option4','$answer',1)";
			mysql_query($query);


			echo "<script>";
			echo "alert('Data Inserted.');";
			echo "</script>";

			header('Refresh:0; url=adminHome.php');
		}
	}
 ?>
<html>
	<head>
		<title>Admin Home</title>
	</head>
	<body>
		<button style='float:right;'><a href='logout.php'>Logout</a></button>
		<center>
			<h1>Create New Question.</h1>

			<form action='' method='post'>
				<table>
					<tr>
						<td>Question:</td>
						<td><code><textarea rows="4" cols="50" name='question'></textarea></code></td>
						<td style='color:red;'><?php echo $questionErr; ?></td>
					</tr>
					<tr>
						<td>Option1:</td>
						<td><code><input type='text' name='option1' value=''></code></td>
						<td style='color:red;'><?php echo $option1Err; ?></td>
						<td>Option2:</td>
						<td><code><input type='text' name='option2' value=''></code></td>
						<td style='color:red;'><?php echo $option2Err; ?></td>

					</tr>
					<tr>
						<td>Option3:</td>
						<td><code><input type='text' name='option3' value=''></code></td>
						<td style='color:red;'><?php echo $option3Err; ?></td>
						<td>Option4:</td>
						<td><code><input type='text' name='option4' value=''></code></td>
						<td style='color:red;'><?php echo $option4Err; ?></td>
					</tr>
					<tr>
						<td>Answer:</td>
						<td><code><input type='text' name='answer' value=''></code></td>
						<td style='color:red;'><?php echo $answerErr; ?></td>
					</tr>
					<tr>
						<td></td>
						<td><input type='submit' name='Submit' value='Submit'></td>
					</tr>
				</table>
			</form>
		</center>
	</body>
<html>
