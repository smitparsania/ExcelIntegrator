<?php
	
	$html = '<html>';
	/*session_start();
	$user = 'user1';
	echo $user;	
	$handle = file("text.txt");*/
	$conn = mysql_connect("localhost"); 
	mysql_select_db("user_login",$conn);
	$table = 'users';
	/*$sql = "SELECT filename FROM $table WHERE user_name = '$user'";
	$file_query = mysql_query($sql,$conn) or die(mysql_error());
	$file = mysql_fetch_assoc($file_query);
	$FILE = $file['filename'];
	echo $FILE;*/
	$directory = "/uploads/Input/";
	$filename = '';
	$result = mysql_query("SELECT * FROM $table ORDER BY group_id");
	if (!$result) {
		die("Query to show fields from table failed");
	}
	
	$fields_num = mysql_num_fields($result);
	
	$html .= '<h1>Table:'.$table.'</h1> 
	
			  <table border="1">
			  <tr>';
	
	for($i=0; $i<$fields_num; $i++)
	{
		$field = mysql_fetch_field($result);
		$html.='<th>'.$field->name.'</th>';
	}
		$html.= '</tr>';
	// printing table rows
	
	$last_id = '';
	$div_name_html = '';
	$user_name_html = '';
	$pass_html = '';
	$file_html = '';
	
	while($row = mysql_fetch_assoc($result))
	{
		$file = trim($row['filename']);
		$filename = $directory.$row['group_name'].'/'.trim($row['filename']);
		clearstatcache();
		if($row["group_id"]==$last_id)
		{
			
			$div_name_html .= '<br>'.$row["division_name"];
			$user_name_html .= '<br>'.$row["user_name"];
			$pass_html .= '<br>'.$row["password"];
			if(stream_resolve_include_path($filename))
				{$file_html .= '<br><a href="fileview.php?link='.$file.'">'.trim($row['filename']).'</a>';}
			else
				{$file_html .= '<br>'.$row["filename"];}

		}
		else
		{
			$div_name_html .= '</td>';
			$user_name_html .= '</td>';
			$pass_html .= '</td>';
			$file_html .= '</td>';
			$html.= $div_name_html.
					$user_name_html.
					$pass_html. 
					$file_html.
					'
					</tr>
					<tr>
			
					<td>'.$row["group_id"].'</td>
					<td>'.$row["group_name"].'</td>
					
					';
			$div_name_html = '<td>'.$row["division_name"];
			$user_name_html = '<td>'.$row["user_name"];
			$pass_html = '<td>'.$row["password"];
			if(stream_resolve_include_path($filename))
				{$file_html = '<td><a href="fileview.php?link='.$file.'">'.trim($row['filename']).'</a>';}
			else
				{$file_html = '<td>'.$row["filename"];}			
		}
		
		$last_id=$row["group_id"];
		
	}
	$div_name_html .= '</td>';
	$user_name_html .= '</td>';
	$pass_html .= '</td>';
	$file_html .= '</td>';
	$html.= $div_name_html.
			$user_name_html.
			$pass_html. 
			$file_html.
			'</tr>';
	$html.= '</table>
			 </html>';
			 
	echo $html;
	
	mysql_free_result($result);
	
?>