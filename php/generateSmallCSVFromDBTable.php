<?php
/* the right version for exporting single csv file */
// database record to be exported
$db_record = 'z_attr_products_prodaav_all';
// optional where query
$where = '';
// filename for export
$csv_filename = 'db_export_'.$db_record.'_'.date('Y-m-d').'.csv';
// database variables
$hostname = "localhost";
$user = "root";
$password = "";
$database = "userdb_35872_2";
$port = 3306;
$conn = mysqli_connect($hostname, $user, $password, $database, $port);
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}
for($x=852;$x<855;$x++)
{

	$y= $x * 10000;
	$where = "limit ".$y.", 10000";
	// create empty variable to be filled with export data
	$myArray =  array();
	$csv_export = '';
	// query to get data from database
	$query = mysqli_query($conn, "SELECT * FROM ".$db_record." ".$where);
	$field = mysqli_field_count($conn);
	// create line with field names
	for($i = 0; $i < $field-1; $i++) {
	    $csv_export.= mysqli_fetch_field_direct($query, $i)->name.';';
	}
	$csv_export.= mysqli_fetch_field_direct($query, $field-1)->name;
	array_push($myArray, $csv_export);
	// newline (seems to work both on Linux & Windows servers)
	$csv_export = '';
	// loop through database query and fill export variable
	while($row = mysqli_fetch_array($query)) {
	    // create line with field values
	    for($i = 0; $i < $field-1; $i++) {
	        $csv_export.= $row[mysqli_fetch_field_direct($query, $i)->name].';';
	    }
	    $csv_export.= $row[mysqli_fetch_field_direct($query, $field-1)->name];
	    //$csv_export = iconv("ANSI", "UTF-8", $csv_export);
	    array_push($myArray, $csv_export);
	    $csv_export = '';
	}
	
	$fileName = 'file-'.$x.'.csv';
	
	$file = fopen($fileName,"w");
	//fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
	foreach ($myArray as $list)
	  {
	  	//echo "1"."<br>";
	  fputcsv($file,explode(';',$list));
	  }

	fclose($file); 
	unset($myArray);
	unset($csv_export);	
	//file_put_contents($file, $csv_export);
}