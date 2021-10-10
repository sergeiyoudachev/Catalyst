<?php 

/*------------------------------ function ConnectDB ------------------------------*/
/*  Create connection to MySQL   */
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

/*--------------------------function CreateDB ----------------------------------*/
/*  Create MySQL DataBase  */

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
/*-----------------------------function CreateTable -------------------------------*/
/*  Create MySQL users table  */

function CreateTable(){

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "usersDB";
     // read head of CSV for insert it in the table
if (($handle = fopen("users.csv", "r")) !== FALSE) {
     $data = fgetcsv($handle, 1000, ","); 
    }
    fclose($handle);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// sql to create table
$sql = "CREATE TABLE users (
$data[0] VARCHAR(50) NOT NULL,
$data[1] VARCHAR(50) NOT NULL,
$data[2] VARCHAR(50) NOT NULL 
)";
if ($conn->query($sql) === TRUE) {
   $conn->query("ALTER TABLE `users` ADD UNIQUE KEY `$data[2]` (`$data[2]`)"); 
   echo "Table USERS created successfully \n";
} else {
  echo "Error creating table: " . $conn->error;
}
$conn->close();
}

/*-----------------------function printFile -----------------------------*/
/*    show, checking and insert file content into DataBase  */


function printFile(){

   $row = 0;
if (($handle = fopen("users.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        if($row){
        echo "  \n";
        }
        // skip the header of the csv file
         if($data[0]!='name' && !empty($data[0])){
        // make First character is UPPER case
         $data[0] = ucfirst(strtolower($data[0])); 
         $data[1] = ucfirst(strtolower($data[1])); 
        // validate email
          validateEmail($data[2]);
        // insert data into DB
          insertRow($data[0], $data[1], $data[2]);
        }
         $row++;
       
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] ." ";
        }
    }
    fclose($handle);
}


/*----------------------function insertRow ------------------------------*/
/*  insert file content into DataBase  */
}

function  insertRow($name, $surname, $email){
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "usersDB";
    // Create connection
    $conn = new mysqli($servername, $username, $password,$dbname);
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    
    $name=$conn->real_escape_string($name);
    $surname=$conn->real_escape_string($surname);
    $email=$conn->real_escape_string($email);
    mysqli_query($conn, "INSERT INTO users (name, surname, email) VALUES ('$name','$surname','$email') ");
}
/*------------------------function showFile ----------------------------*/
/*   showing file content */

function showFile(){
 echo "USERS.CSV \n\n";
   $row = 0;
if (($handle = fopen("users.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        if($row){
        echo "  \n";
        }
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] ." ";
        }
    }
    fclose($handle);
}
}
/*------------------------- function funcHelp ---------------------------*/
/*  otput list of directives with details */

function funcHelp(){
echo " Command line options: \n
--file [csv file name] – show content of the CSV file to be parsed into Data Base. \n
--insert [csv file name] - show content of the CSV file and insert content of CSV file into Data Base. \n
--create_table – build the MySQL users table. \n 
--dry_run (use with --file directive) run the script but not insert into the DB. All other functions will be executed, but the
database won't be altered. Example : --dry_run users.csv \n
-u – MySQL username.\n
-p – MySQL password.\n
-h – MySQL host.\n
--help – show list of directives with details.\n";
}

/*----------------------- function showMysqlHost -----------------------------*/
/* show MySQL host */

function showMysqlHost(){

$servername = "localhost";
$username = "root";
$password = "";
// Create connection
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error); 
}
printf("MySQL host info: %s\n", mysqli_get_host_info($conn));
}


/*------------------------- function validateEmail ---------------------------*/
/* function receive EMAIL Address and return changed EMAIL Address or message if EMAIL doesnt valid.
validate EMAIL Address and set to be lover case before insert to DB. In case if EMAIL doesnt valid - replace 
incorrect email address to message "Invalid Email address" */
    
function validateEmail($email){

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email = strtolower($email);
               } else {
                $email="Invalid EMAIL";
          echo "\n" ."WARNING! -> Email address " .$email ." is considered invalid.\n";
          }
          return $email;
}

/*----------------------- function userMySql -----------------------------*/
/* show MySQL username */

function userMySql(){

echo "MySQL username - root \n";
}
/*----------------------- function passwordMySql -----------------------------*/
/* show MySQL password */

function passwordMySql(){

echo "MySQL password ia blank \n";
}

?>






