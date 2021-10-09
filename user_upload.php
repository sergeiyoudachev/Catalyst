<?php include "functions.php";?>
<?php

if($argc == 2){  

$temp=$argv[1];

}elseif($argc==3){
$temp=$argv[1];
$temp .=" "; 
$temp .=$argv[2];
}else{
$temp ='--help';
}

if($temp=='--insert users.csv'){
	
    ConnectDB();
    CreateDB();
    CreateTable('name','surname','email');
    printFile();

}elseif($temp=='--file users.csv'){
	
    showFile();

}elseif($temp=='--create_table') {
     
    ConnectDB();
    CreateDB();
    CreateTable('name','surname','email');

}elseif($temp=='--dry_run users.csv'){
    
    ConnectDB();
    CreateDB();
    CreateTable('name','surname','email');
    showFile();

}elseif($temp=='-u'){
    
    userMySql();

}elseif($temp=='-p'){

    passwordMySql();

}elseif($temp=='-h'){
 
    showMysqlHost();

}elseif($temp=='--help'){

    funcHelp();

    }else {echo "Please enter --help for instructions";}

?>

