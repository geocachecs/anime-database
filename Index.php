<?php





?>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script>
	function get_title() 
    	{        
	      $.ajax({
	            type: "get",
	            url: "search.php",
	            dataType: "json",
	            data: { "title" : $('#title').val()},
	            success: function(data,status) {
	            	if(data['title'] != null)
	            	{
		            	 $("#name").html(data['title']);
		                 $("#content").html(data['description']);
		                 $("#image").html("<img src= " + data['image'] + " width = '300px' />");
		             //	 $("#popularity").html("Popularity: " +data['popularity']);
		             	 $("#year").html("Year: " + data['Year']);
	             	}
	             	else 
	             	$("#name").html("Nothing found!");
	              },
	            complete: function(data,status) { //optional, used for debugging purposes
	                 
	            }
	         });
	   }
	
	
	
</script>

<head><link rel="stylesheet" type="text/css" href="css/style.css"></head>

<body>
	
	<h1>ULTIMATE ANIME DATABASE</h1>
	
	Admin Login: (username: MrAwesome password: coolOne)</br>
	<form action = "admin.php">
		<input type="text" value = "administrator" name="username">
		<input type="text" value = "password" name="password">
		<input type = "submit" value= "submit!" name ="submit">
	</form>
	</br>
	<h1>Search Below:</h1>
	<form id="thisform">
		<input type="text" value = "search here" name="title" id="title">
		<input type = "submit" value= "submit!" name ="submit">
	</form>
	
	
	<div style='font-size:300%' id="name"></div>
	<div id="image"></div>
	<div style='font-size:150%; width:475px;' id="content"></div>
	<div style='font-size:150%;' id="year"></div>
	<div style='font-size:150%;' id="popularity"></div>
	
	
	
	<script>$("#thisform").submit(function(event) {event.preventDefault();
											get_title();
												})</script>
</body>