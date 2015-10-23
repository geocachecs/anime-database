

<?php
require '../dbConnection.php';
$dbConn=getConnection();

if(!empty($_GET['title']))
		{
		
		
	    	$sql = "SELECT title, description, mangaId, image, Year FROM fp_manga WHERE title = :title";
			$namedParameters[':title'] = $_GET['title'];
	    	$stmt = $dbConn -> prepare($sql); //prepare
			$stmt -> execute ($namedParameters); //execute
			$result=$stmt->fetch(); //fetch	
			
			$sql = "INSERT INTO `hart4492`.`fp_activity` (`searchId`, `title`) VALUES (NULL, :title);";
	    	$stmt = $dbConn -> prepare($sql); //prepare
			$stmt -> execute ($namedParameters); //execute
			
	
			
			/*
			if(isset($result))
			{
				echo "<h3>" . $result['title'] . "</h3>";
				
				echo $result['description'] . "<br/>";
			}
				
			}
			else {
				echo "Nothing found";
			}
<!--
<form action = "search.php">
		<input type="text" value = "search here" name="title">
		<input type = "submit" value= "submit!" name ="submit">
	</form>
	
	
</form>  !-->

*/			
			
			echo json_encode($result);
			}
?>