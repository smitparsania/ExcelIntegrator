<?php
	
	$handle = file("text.txt");
	$conn = mysql_connect("localhost"); 
	mysql_select_db("user_login",$conn);

	foreach($handle as $line)
	{
		list($Id, $Group, $Division, $Username, $Password, $File) = explode(",",$line);
		echo $Id."-".$Group."-".$Division."-".$Username."-".$Password."-".$File."<br>";
		$sql = "INSERT INTO `users` (`group_id`,`group_name`,`division_name`,`user_name`,`password`,`filename`) VALUES('".$Id."','".$Group."','".$Division."','".$Username."','".$Password."','".$File."')";   
		mysql_query($sql,$conn) or die(mysql_error());
	}
	$table = 'users';
	$result = mysql_query("SELECT * FROM {$table} ORDER BY group_id");
	if (!$result) {
		die("Query to show fields from table failed");
	}
include 'view.php';
	
?>