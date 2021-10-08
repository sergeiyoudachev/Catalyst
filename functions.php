<?php 

/*------------------------------------------------------------*/
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

/*------------------------------------------------------------*/
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
/*------------------------------------------------------------*/
/*  Create MySQL users table  */

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
  $conn->query("ALTER TABLE `users` ADD UNIQUE KEY `$param3` (`$param3`)"); 
  echo "Table USERS created successfully \n";
} else {
  echo "Error creating table: " . $conn->error;
}
$conn->close();
}

/*----------------------------------------------------*/
/*    show file content and insert file content into DataBase  */


function printFile(){

   $row = 0;
if (($handle = fopen("users.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        
        if($row){
        echo " $num fields in line $row: \n";
        }
        // skip the header of the csv file
         if($data[0]!='name' && !empty($data[0])){
          insertRow($data[0], $data[1], $data[2]);
        }
        
        $row++;
       
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] ." ";
        }
    }
    fclose($handle);
}


/*----------------------------------------------------*/
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
    echo "Connected successfully \n";
     

    mysqli_query($conn, "INSERT INTO users (name, surname, email) VALUES ('$name','$surname','$email') ");

}
/*----------------------------------------------------*/
/*   showing file content */

function showFile(){
   $row = 0;
if (($handle = fopen("users.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        if($row){
        echo " $num fields in line $row: \n";
        }
        $row++;
        
        for ($c=0; $c < $num; $c++) {
             
            echo $data[$c] ." ";
        }
    }
    fclose($handle);
}
}
/*----------------------------------------------------*/
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

/*----------------------------------------------------*/
/* show MySQL host */

function showMysqlHost(){


$servername = "localhost";
$username = "root";
$password = "";
// Create connection
$conn = new mysqli($servername, $username, $password);


//$link = mysql_connect('localhost', 'root', '');
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error); 
}
printf("MySQL host info: %s\n", mysqli_get_host_info($conn));

}

?>






