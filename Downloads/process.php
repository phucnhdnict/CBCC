<?php
// include the following 2 files
require 'E:\PHP\dnict\libraries\phpexcel\Classes\PHPExcel.php';
require_once 'E:\PHP\dnict\libraries\phpexcel\Classes\PHPExcel\IOFactory.php';

// db connection
$conn = mysql_connect ( "localhost", "root", "" );
mysql_select_db ( "cvccvc_code", $conn );

// fetch values from HTML page
$file = $_POST ['file'];
$srow = $_POST ['srow'];
$dropdownval = $_POST ['menu'];

$tname = $_POST ['tname'];

// it will create table when user enter Table name
$createTable = "CREATE TABLE $tname(
 `Guest Number` INT NOT NULL ,
 `Name` VARCHAR(100) NOT NULL ,
 `Address` VARCHAR( 100 ) NOT NULL ,
 `Proof` VARCHAR( 100 ) NOT NULL ,
 `SSN` INT( 10 ) NOT NULL ,
 `Checkin` DATE NOT NULL ,
 `Checkout` DATE NOT NULL ,
 `Room No.` INT NOT NULL ,
 `Type` VARCHAR( 100 )NOT NULL ,
 `No_of_Person` INT NOT NULL)";

if ($dropdownval != 'none' && $tname == TRUE) {
	echo "Either select from Dropdown or write table name in textfiled";
} 

else {
	
	$objPHPExcel = PHPExcel_IOFactory::load ( $file );
	foreach ( $objPHPExcel->getWorksheetIterator () as $worksheet ) {
		$worksheetTitle = $worksheet->getTitle ();
		$highestRow = $worksheet->getHighestRow (); // e.g. 10
		$highestColumn = $worksheet->getHighestColumn (); // e.g 'F'
		$highestColumnIndex = PHPExcel_Cell::columnIndexFromString ( $highestColumn );
		$nrColumns = ord ( $highestColumn ) - 64;
		echo "<br>The worksheet " . $worksheetTitle . " has ";
		echo $nrColumns . ' columns (A-' . $highestColumn . ') ';
		echo ' and ' . $highestRow . ' row.<BR><BR>';
	}
	
	echo 'Data:<BR><BR><BR><table width="100%" cellpadding="3" cellspacing="0" border=1 bordercolor="green"><tr>';
	for($row = $srow - 1; $row <= $highestRow - 2; ++ $row) {
		echo '<tr>';
		for($col = 0; $col < $highestColumnIndex; ++ $col) {
			$cell = $worksheet-> getCellByColumnAndRow ( $col, $row );
			
			$val = $cell->getValue ();
			if ($row === 1)
				echo '<td style="background:#000; color:#fff;">' . $val . '</td>';
			else
				echo '<td>' . $val . '</td>';
		}
		
		echo '</tr>';
	}
	echo '</table>';
	
	if ($dropdownval != 'none' && $tname == FALSE) {
		
		for($row = $srow; $row <= $highestRow - 2; ++ $row) {
			$val = array ();
			
			for($col = 0; $col < $highestColumnIndex; ++ $col) {
				$cell = $worksheet->getCellByColumnAndRow ( $col, $row );
				$val [] = $cell->getValue ();
			}
			
			if (is_null ( $val [0] ) || is_null ( $val [1] ) || is_null ( $val [2] ) || is_null ( $val [3] ) || is_null ( $val [4] ) || is_null ( $val [5] ) || is_null ( $val [6] ) || is_null ( $val [7] ) || is_null ( $val [8] ) || is_null ( $val [9] )) {
				
				echo "<BR><BR><font color='red'><BIG>";
				echo "Empty Cells are Reported";
				echo "</BIG></font><BR>";
				
				break;
			}
			
			// Dropdown table query starts here...
			$sql = "INSERT INTO $dropdownval(`Guest Number`,`Name`,`Address`,`Proof`,`Checkin`,`Checkout`,`Room No.`,`Type`,`Number_of_person`)
VALUES('" . $val [0] . "','" . $val [1] . "','" . $val [2] . "','" . $val [3] . "','" . $val [4] . "','" . $val [5] . "','" . $val [6] . "','" . $val [7] . "','" . $val [8] . "','" . $val [9] . "')";
			
			mysql_query ( $sql );
			$batch ++;
		}
		
		// Dropdown table query ends here...
		
		if (@mysql_query ( $sql )) {
			echo "<BR><font color='green'><BIG>Successfully Uploaded " . $file . " into table " . $dropdownval;
			echo "</BIG></font><BR>";
		} else
			echo "Error while uploading " . $file . " into table " . $dropdownval . " . Error is highlighted above in RED";
	} 

	else {
		for($row = $srow; $row <= $highestRow - 2; ++ $row) {
			
			$val = array ();
			
			for($col = 0; $col < $highestColumnIndex; ++ $col) {
				$cell = $worksheet->getCellByColumnAndRow ( $col, $row );
				
				$val [] = $cell->getValue ();
			}
			// textbox table query starts here...
			
			mysql_query ( $createTable );
			
			$sql1 = "INSERT INTO $dropdownval(`Guest Number`,`Name`,`Address`,`Proof`,`Checkin`,`Checkout`,`Room No.`,`Type`,`Number_of_person`)
VALUES('" . $val [0] . "','" . $val [1] . "','" . $val [2] . "','" . $val [3] . "','" . $val [4] . "','" . $val [5] . "','" . $val [6] . "','" . $val [7] . "','" . $val [8] . "','" . $val [9] . "')";
			mysql_query ( $sql1 );
			
			$batch ++;
		}
		
		// textbox table query ends here...
		if (mysql_query ( $sql1 ))
			echo "Table $tname has been created...Successfully Uploaded " . $file;
		else
			echo "Error while uploading " . $file;
	}
}

?>