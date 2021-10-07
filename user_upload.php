<?php include "functions.php";?>
<?php

$tempc=$argc;
$temp=$argv[1];
if($argc>2){
$temp .=" "; 
$temp.=$argv[2];
}
echo $temp;

if($temp=='--file users.csv'){
	echo "call function print file \n";
    printFile();

}elseif($temp=='--create_table') {
    echo "call func create table \n"; 
    ConnectDB();
    CreateDB();
    CreateTable('name','surname','email');
}elseif($temp=='--dry_run'){
    echo "call dry run \n";
}elseif($temp=='-u'){
    echo "call MySQL User name \n";
}elseif($temp=='-p'){
    echo "MySQL Password \n";
}elseif($temp=='-h'){
    echo "MySQL host \n";
}elseif($temp=='--help'){
    echo "Directories \n";
    }else {echo "Please enter --help for instructions";}

?>

