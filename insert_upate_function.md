dry function insert($table, $columns,$values){ $fields=""; foreach($columns as $column){ $fields .="$column,"; } $fields =rtrim($fields,',');

$value="";
foreach($values as $v){
    $value .="'$v',";
}
$value =rtrim($value,',');

$sql="INSERT INTO $table ($fields) VALUES ($value)";
$conn =dbconnect();
mysqli_query($conn, $sql);
$cv_id =mysqli_insert_id($conn);
return  $cv_id;
}
