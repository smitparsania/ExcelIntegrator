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

	$fields_num = mysql_num_fields($result);

	echo "<h1>Table: {$table}</h1>";
	echo "<table border='1'><tr>";
	// printing table headers
	for($i=0; $i<$fields_num; $i++)
	{
		$field = mysql_fetch_field($result);
		echo "<th>{$field->name}</th>";
	}
	echo "</tr>\n";
	// printing table rows
	while($row = mysql_fetch_row($result))
	{
		echo "<tr>";

		// $row is array... foreach( .. ) puts every element
		// of $row to $cell variable
		foreach($row as $cell)
			echo "<td>$cell</td>";

		echo "</tr>\n";
	}
	mysql_free_result($result);
	
?>