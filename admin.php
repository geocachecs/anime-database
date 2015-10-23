
<link rel="stylesheet" type="text/css" href="css/style.css">
<?php
	session_start();
	require '../dbConnection.php';
	$dbConn = getConnection();
	$password = $_GET['password'];
	$username = $_GET['username'];
	
	
	$sql = "SELECT * FROM fp_admin where password = :password AND username = :username";
	$namedParameters = array(); 
	$namedParameters[':password'] = $password;
	$namedParameters[':username'] = $username;
	$stmt = $dbConn->prepare($sql);
	$stmt->execute($namedParameters);
	$result = $stmt->fetch();
	
	if(empty($result))
	{
		header("Location: index.php");
		
	}
	else 
	{
		$_SESSION['admin'] = true;
		header("Location: edit.php");
	}
	
?>