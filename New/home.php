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
   
   exec("C:/xampp/htdocs/New/text.bat");
print <<< HERE
  <table border = "1">
  <tr>
   <th>Id</th>
   
   <th>Group</th>
   <th>Division</th>
   <th>Username</th>
   <th>File-Link</th>
   </tr>
HERE;
  $data = file("text.txt");
  natsort($data);
  
  foreach ($data as $line){
  $lineArray = explode(",", $line);
  list($Id, $Group, $Division, $Username, $File) = $lineArray;
  print <<< HERE
   <tr>
   <td>$Id</td>
   
   <td>$Group</td>
   <td>$Division</td>
   <td>$Username</td>
   <td>$File</td>
   </tr>
HERE;
  } 
 print "</table> \n";
   
   }
   
   ?>
   <style>
body  {background-color: #b0c4de;}
{text-align: center;}


</style>

   
   
    <body>
        <h2 align='center'>Welcome to Integrator</h2>
        
		
		<br/>
        <form action="upload.php" method="post" enctype="multipart/form-data" align="center">

		Select  Microsoft Excel  File To Upload : 
	
		<input type="file" name="fileToUpload" id="fileToUpload" accept=".xlsx" accept=".xls">
		<input type="submit" value="Upload File" name="submit">
	
		<br/>
		<br/>
		</form>
		
		<button onclick="location.href = 'logout.php';"">Logout</button>        
		
		
	</body>
	
</html>
