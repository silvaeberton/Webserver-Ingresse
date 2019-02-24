<?php
$host = "mysql";
$user = "beto"; //getenv("MYSQL_USER");
$pass = "123456"; //getenv("MYSQL_PASSWORD");
 
$conn = mysqli_connect($host, $user, $pass);
if (!$conn) {
    exit("Connection failed: " .mysqli_connect_error().PHP_EOL);
}
 
echo "Successful database connection!".PHP_EOL;   
mysqli_close($conn);
?>