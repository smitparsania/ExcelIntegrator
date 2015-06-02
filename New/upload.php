<?php
$target_dir = "uploads/Input/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
	
#exec("C:/xampp/htdocs/smit/call.bat");x

?>
<html>
<style>
body  {background-color: #b0c4de;}



</style>

	<br/>
	<br>
	<button onclick="location.href = 'home.php';">Upload another File</button>
	<button onclick="location.href = 'logout.php';">Logout</button>	<br>
	<br/>
	
</html>
<?php
/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');

/** PHPExcel_IOFactory */
include 'PHPExcel/IOFactory.php';

$inputFileName = 'Output/result.xlsx';  // File to read
//echo 'Loading file ',pathinfo($inputFileName,PATHINFO_BASENAME),' using IOFactory to identify the format<br />';
try {
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
} catch(Exception $e) {
	die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}
$i=0;
switch($_FILES["fileToUpload"]["name"])
{
	case 'Kanpur Accts 2013-14.xls':
		echo 'Here Is View Of Your Uploaded File';
		$i=2;
		break;
	case 'Korwa Accts 2013-14.xls':
		echo 'Here Is View Of Your Uploaded File';
		$i=5;
		break;
	default:
		$i=0;
		break;
}

echo '<hr />';
echo "<pre>";
$objWorksheet = $objPHPExcel->setActiveSheetIndex('0') ;

$highestRow = $objWorksheet->getHighestRow(); 


echo '<table border="1">';
for ($row = 0; $row <= $highestRow; ++$row) {
    echo '<tr>';
	// Fetch the data of the columns you need
    $col0 = $objWorksheet->getCellByColumnAndRow(0, $row)->getValue();
    $col1 = $objWorksheet->getCellByColumnAndRow(1, $row)->getValue();
    $col2 = $objWorksheet->getCellByColumnAndRow($i, $row)->getValue();
    $col3 = $objWorksheet->getCellByColumnAndRow($i+1, $row)->getValue();
	$col4 = $objWorksheet->getCellByColumnAndRow($i+2, $row)->getValue();
    
	echo '<td>';
    echo $col0 . '&nbsp;';
    echo '</td>';
	
	echo '<td>';
	echo $col1 . '&nbsp;';
    echo '</td>';
	
	echo '<td>';
	echo $col2 . '&nbsp;';
    echo '</td>';
	
	echo '<td>';
	echo $col3 . '&nbsp;';
    echo '</td>';
	
	echo '<td>';
	echo $col4 . '&nbsp;';
    echo '</td>';
	
	echo '</tr>';
}
echo '</table>';

?>
<script type="text/javascript">
        function noBack()
         {
             window.history.forward()
         }
        noBack();
        window.onload = noBack;
        window.onpageshow = function(evt) { if (evt.persisted) noBack() }
        window.onunload = function() { void (0) }
    </script>
<body>
</html>