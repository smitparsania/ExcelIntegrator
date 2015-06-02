<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <title>readtextfile</title>
</head>
<body>
 <h1>Admin Table</h1>
 <div>
 <?php
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
   if($Id==1)
   {
   <td rowspan="7">$Id</td>
   
   <td rowspan="7">$Group</td>
   <td>$Division</td>
   <td>$Username</td>
   <td>$File</td>}
   </tr>
   </br>
   else
   {<tr>
    <td>$Id</td>
   
    <td>$Group</td>
    <td>$Division</td>
    <td>$Username</td>
    <td>$File</td>
   </tr>}
HERE;
  } 
 print "</table> \n";
 ?>
 </div>
</body>
</html>