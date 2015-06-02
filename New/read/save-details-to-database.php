<html>
  <head> 
  <title>Save Excel file details to the database</title>
  </head>
  <body>
	<?php
		include 'db_connection.php';
		include 'reader.php';
    	$excel = new Spreadsheet_Excel_Reader();
	?>
	    <table border="1">
		<?php
            $excel->read('sample.xls');    
			$x=2;
			while($x<=$excel->sheets[0]['numRows']) {
				$name = isset($excel->sheets[0]['cells'][$x][1]) ? $excel->sheets[0]['cells'][$x][1] : '';
				$job = isset($excel->sheets[0]['cells'][$x][2]) ? $excel->sheets[0]['cells'][$x][2] : '';
				$email = isset($excel->sheets[0]['cells'][$x][3]) ? $excel->sheets[0]['cells'][$x][3] : '';
				
				// Save details
				$sql_insert="INSERT INTO users_details (id,name,job,email) VALUES ('','$name','$job','$email')";
				$result_insert = mysql_query($sql_insert) or die(mysql_error()); 
				 
			  $x++;
			}
        ?>    
    </table>

  </body>
</html>
