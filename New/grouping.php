<?php
	$html = '';
	$handle = file("text.txt");
	$conn = mysql_connect("localhost"); 
	mysql_select_db("user_login",$conn);
	$table = 'users';
	$result = mysql_query("SELECT * FROM {$table} ORDER BY group_id");
	if (!$result) {
		die("Query to show fields from table failed");
	}

	$fields_num = mysql_num_fields($result);

	$html .= '<h1>Table: {$table}</h1> <table border="1"><tr>';
	
	for($i=0; $i<$fields_num; $i++)
	{
		$field = mysql_fetch_field($result);
		$html.='<th>{$field->name}</th>';
	}
	$html.= '</tr>\n';
	// printing table rows
	$last_id = '';
	while($row = mysql_fetch_row($result))
	{
		$html.= '<tr>';
		if($row['group_id']==$last_id)
		{
			print <<< HERE
			<td>$row['division']<br>
HERE;
		}
		echo "<td>$row['group_id']</td>";
		echo "<td>$row['group_name']</td>";
		
		// $row is array... foreach( .. ) puts every element
		// of $row to $cell variable
		foreach($row as $cell)
			echo "<td>$cell</td>";

		echo "</tr>\n";
	}
	mysql_free_result($result);
	
?>