<?php
//ini_set('display_errors',0);
session_start();
$user = $_SESSION['user'];
echo $user;
$conn = mysql_connect("localhost"); 
mysql_select_db("user_login",$conn);
$sql = "SELECT filename FROM `users` WHERE user_name = '$user'";
$sql2 = "SELECT group_name FROM `users` WHERE user_name = '$user'";
$file_query = mysql_query($sql,$conn) or die(mysql_error());
$grp_query = mysql_query($sql2,$conn) or die(mysql_error());
$file = mysql_fetch_assoc($file_query);
$grp = mysql_fetch_assoc($grp_query);
$FILE = trim($file['filename']);
$GRP = $grp['group_name'];
echo $FILE;
echo $GRP;

$target_dir = "uploads/Input/$GRP/";
if(!file_exists($target_dir))
	{echo "done";
	mkdir("uploads/Input/$GRP/");	}
$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
if(basename($_FILES["fileToUpload"]["name"])!= $FILE)
	{
		echo 'Wrong File';
		exit();
	}
$uploadOk = 1;
//$FileType = pathinfo($target_file,PATHINFO_EXTENSION);
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "<br>The file ".basename($_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
$call_command = 'start /b "" "C:/xampp/htdocs/New/MergeExcel/MergeExcel/bin/Release/MergeExcel.exe" '.$GRP;
file_put_contents('call.bat', $call_command);	
exec("C:/xampp/htdocs/New/call.bat");

?>

<html>
<style>
<body>  {background-color: #b0c4de;}



</style>

	<br/>
	<br>
	<button onclick="location.href = 'home.php';">Upload another File</button>
	<button onclick="location.href = 'logout.php';">Logout</button>	<br>
	<br/>
	

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
</body>
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
switch(basename($_FILES["fileToUpload"]["name"]))
{
	case "file1.xls":
		echo 'Here Is View Of Your Uploaded File';
		$i=2;
		break;
	case 'file3.xls':
		echo 'Here Is View Of Your Uploaded File';
		$i=5;
		break;
	case 'file2.xls':
		echo 'Here Is View Of Your Uploaded File';
		$i=8;
		break;
	case 'file5.xls':
		echo 'Here Is View Of Your Uploaded File';
		$i=11;
		break;
	case 'file4.xls':
		echo 'Here Is View Of Your Uploaded File';
		$i=14;
		break;
	default:
		echo 'Wrong File';
		exit();
		$i=200;
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
