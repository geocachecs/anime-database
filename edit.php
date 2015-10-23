<link rel="stylesheet" type="text/css" href="css/style.css">
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<?php
	session_start();
	require '../dbConnection.php';
	

	$dbConn=getConnection();

	
	
	if($_SESSION['admin']==true)
	{
		$sql = "SELECT count(title) number FROM fp_manga where 1";
		$stmt = $dbConn -> prepare($sql); //prepare
		$stmt -> execute ();
		$result=$stmt->fetch(); //fetch	
		echo "<span style='font-size:140%'>" . $result['number'] . " mangas in library</span></br>";
		
		$sql = "SELECT count(searchId) number FROM fp_activity where 1";
		$stmt = $dbConn -> prepare($sql); //prepare
		$stmt -> execute ();
		$result=$stmt->fetch(); //fetch	
		echo "<span style='font-size:140%'>" . $result['number'] . " user searches</span></br>";
		
		echo 
		"
			<div style='font-size:200%'> Add Submission Below </div>
			<form>
				<input type='text' value='add title' name='newtitle'>
				<input type='text' value='new description' name='newdesc'></br>
				<input type='text' value='new year' name='newyear'>
				<input type='text' value='new image URL' name='newdimg'>
				<input type='submit' value='submit!' name='submit'></br></br>

			</form>
		";
		
		if(!empty($_GET['newtitle']))
		{
			$sql = "INSERT INTO `hart4492`.`fp_manga` (`mangaId`, `title`, `description`, 'Year', 'image') VALUES (NULL, :newtitle, :newdesc, :year, :image);";
			$addParameter[':newtitle'] = $_GET['newtitle'];	
			$addParameter[':newdesc'] = $_GET['newdesc'];	
			$addParameter[':year'] = $_GET['newyear'];	
			$addParameter[':image'] = $_GET['newimg'];	
			$stmt = $dbConn -> prepare($sql); //prepare
			$stmt -> execute ($addParameter); //execute
								
							
		}
		
		
		
		
		echo 
		"
		
			<form>
			<div style='font-size:200%'> Search/Modify/Delete Submissions Below </div>
				<input type='text' value='search by title' name='title'>
				<input type='submit' value='submit!' name='submit'></br></br>

			</form>
		";
		
		
		
		
		if(!empty($_GET['title']))
		{
	    	$sql = "SELECT title, description, mangaId, Year, image FROM fp_manga WHERE title = :title";
			$namedParameters[':title'] = $_GET['title'];
	    	$stmt = $dbConn -> prepare($sql); //prepare
			$stmt -> execute ($namedParameters); //execute
			$result2=$stmt->fetch(); //fetch	
		}	
			if(!empty($result2))
			{
				echo "<h3>" . $result2['title'] . "</h3>";
				
				echo "<div style = 'width:500px;'>" . $result2['description'] . "</div><br/>";
				
				echo 
				"
					<form>
						<input type='hidden' value='" . $_GET['title'] . "' name='title'>
						<input type='submit' value='modify' name='modify'>
						<input type='submit' value='delete' name='delete'>
						
					</form>
					
					
				";
				

				if(!empty($_GET['modify']))
				{
								
					echo 
					"
						<form>
							Modify description:</br>
							<input type='hidden' value='" . $_GET['title'] . "' name='title'>
							<input type='hidden' value='" . $_GET['modify'] . "' name='modify'>
							<input type='text' value='" . $result2['description'] . "' name='newDescription'>
							</br>Modify year:</br>
							<input type='text' value='" . $result2['Year'] . "' name='newYear'>
							</br>Modify image link:</br>
							<input type='text' value='" . $result2['image'] . "' name='newImage'>
							<input type='submit' value='change' name='change'>
							
						
						</form>
						
					";
				}	
				if(!empty($_GET['change']))
				{
					$sql = "UPDATE fp_manga set description = :newDescription, Year = :newYear, image = :newImage WHERE title=:title";
					$newParameter[':newDescription'] = $_GET['newDescription'];	
					$newParameter[':title'] = $_GET['title'];
					$newParameter[':newImage'] = $_GET['newImage'];
					$newParameter[':newYear'] = $_GET['newYear'];
					$stmt = $dbConn -> prepare($sql); //prepare
					$stmt -> execute ($newParameter); //execute
								
							
				}
						
				
				
			
				if(!empty($_GET['delete']))
				{
								
					echo 
					"
						<form>
							
							Are tou sure you want to delte?
							<input type='hidden' value='" . $_GET['title'] . "' name='title'>
							<input type='hidden' value='" . $_GET['delete'] ."' name='delete'>
							
							<input type='submit' value='yes' name='confirm'>
							
						
						</form>
						
					";
				}	
						if(!empty($_GET['confirm']))
						{
								$sql = "delete from fp_manga where title = :del";
								$delParameter[':del'] = $_GET['title'];	
								$stmt = $dbConn -> prepare($sql); //prepare
								$stmt -> execute ($delParameter); //execute
								
							
						}	
				

				
			}
			else 
			if(!empty($_GET['title']))
			{
				echo "Nothing found";
			}
		}
		
		
	  
	
?>

<div id="img"></div>



