<?php 

function ConnectDB(){
$servername = "localhost";
$username = "root";
$password = "";
// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully \n";
}

//---------------------------------------------------------------------

function CreateDB(){
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE usersDB";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully \n";
} else {
  echo "Error creating database: " . $conn->error;
}
$conn->close();
}
//------------------------------------------------------------//
function CreateTable($param1,$param2,$param3){

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usersDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// sql to create table
$sql = "CREATE TABLE users (
$param1 VARCHAR(50) NOT NULL,
$param2 VARCHAR(50) NOT NULL,
$param3 VARCHAR(50) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
  echo "Table USERS created successfully \n";
} else {
  echo "Error creating table: " . $conn->error;
}
$conn->close();
}

/*----------------------------------------------------*/
function printFile(){

   $row = 1;
if (($handle = fopen("users.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo " $num fields in line $row: \n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "\n";
        }
    }
    fclose($handle);
}



}

?>






