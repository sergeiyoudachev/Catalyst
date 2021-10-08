<?php include "functions.php";?>
<?php

$tempc=$argc;
$temp=$argv[1];
if($argc>2){
$temp .=" "; 
$temp.=$argv[2];
}
echo $temp;

if($temp=='--insert users.csv'){
	echo "call function print and insert file \n";
    ConnectDB();
    CreateDB();
    CreateTable('name','surname','email');
    printFile();

}elseif($temp=='--file users.csv'){
	echo "call function print file \n";
    showFile();

}elseif($temp=='--create_table') {
    echo "call func create table \n"; 
    ConnectDB();
    CreateDB();
    CreateTable('name','surname','email');

}elseif($temp=='--dry_run users.csv'){
    echo "call dry run \n";
    ConnectDB();
    CreateDB();
    CreateTable('name','surname','email');
    showFile();

}elseif($temp=='-u'){
    echo "call MySQL User name \n";

}elseif($temp=='-p'){
    echo "MySQL Password \n";

}elseif($temp=='-h'){
    echo "MySQL host \n";
    showMysqlHost();

}elseif($temp=='--help'){
    funcHelp();
    }else {echo "Please enter --help for instructions";}

?>

