<?php
/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');

/** PHPExcel_IOFactory */
include 'PHPExcel/IOFactory.php';
$filename = $_GET['link'];
echo $filename;
$inputFileName = 'Output/result.xlsx';  // File to read
//echo 'Loading file ',pathinfo($inputFileName,PATHINFO_BASENAME),' using IOFactory to identify the format<br />';
try {
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
} catch(Exception $e) {
	die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}
$i=0;
switch($filename)
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