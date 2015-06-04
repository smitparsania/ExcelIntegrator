<html>
    <head>
        <title>Welcome to Integrator</title>
    </head>
	
	
<?php

   session_start(); //starts the session
   if($_SESSION['user']){ // checks if the user is logged in  
   }
   else{
      header("location: login.php"); // redirects if user is not logged in
   }
   $user = $_SESSION['user']; //assigns user value
   echo $user;
   echo "<br/>";
   echo 'logged-in';
   echo "<br/>";
   echo "<br/>";
   if($user == 'admin'){ 
   echo ' admin logged in';
	print <<< HERE
	
	<body>
        <h2 align='center'>Welcome to Integrator</h2>		
		<br/>	
		<br/>
		<br/>
		</form> 		
		</body>
	<button onclick="location.href = 'update.php';"">Update</button>
	<button onclick="location.href = 'view.php';"">View</button>
HERE;
	}
	else 
		{
		print <<< HERE
		<body>
        <h2 align='center'>Welcome to Integrator</h2>
        
		
		<br/>
        <form action="upload.php" method="post" enctype="multipart/form-data" align="center">

		Select  Microsoft Excel  File To Upload : 
	
		<input type="file" name="fileToUpload" id="fileToUpload" accept=".xls">
		<input type="submit" value="Upload File" name="submit">
	
		<br/>
		<br/>
		</form>
		
		<button onclick="location.href = 'logout.php';"">Logout</button>        
		
		
		</body>
HERE;
		}	
?>
<style>
body  {background-color: #b0c4de;}
{text-align: center;}


</style>
<button onclick="location.href = 'logout.php';"">Logout</button>

   
   
    
	
</html>
