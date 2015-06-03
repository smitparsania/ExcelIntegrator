<?php

$handle = @fopen("text.txt", "r");
$conn = mysql_connect("localhost"); 
mysql_select_db("user_login",$conn);

while (!feof($handle))
{
	$buffer = fgets($handle, 4096);
	list($Id, $Group, $Division, $Username, $File) = explode(",",$buffer);
	echo $Id."-".$Group."-".$Division."-".$Username."-".$File."<br>";
	$sql = "INSERT INTO `users` (`group_id`,`group_name`,`division_name`,`user_name`,`filename`) VALUES('".$Id."','".$Group."','".$Division."','".$Username."','".$File."')";   
	mysql_query($sql,$conn) or die(mysql_error());
}

?>