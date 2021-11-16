<?php

session_start();
include 'koneksi.php';

if (isset($_POST['submit'])) {
	
	$login = mysqli_prepare($conn, "SELECT * FROM user WHERE username = ? AND password = ?");
	mysqli_stmt_bind_param($login, "ss",$_POST['username'],$_POST['password']);
	mysqli_execute($login);
	mysqli_stmt_store_result($login);

	// yyy' OR 1=1 -- 
	// xxx
	// SELECT * FROM user WHERE username = 'yyy\' OR 1=1 -- ' AND password = 'xxx'

	if (mysqli_stmt_num_rows($login) == 0) {
		die("Username atau password salah!");
	} else {
		$_SESSION['admin'] = 1;
		header("Location: admin.php");
	}
	
}

?><!DOCTYPE html>
<html lang="en">

<head>
	<title>Admin Login</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>

<body>
	
	<h1 style="text-align: center">My Blog Login</h1>
	<hr>
	
	<form action="" method="post">
	
		<p>Username:</p>
		<input type="text" name="username">
		
		<p>Password:</p>
		<input type="password" name="password">
		
		<br>
		<br>
		<input type="submit" name="submit" value="Login">
	
	</form>
	
</body>

</html>
