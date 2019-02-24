<?php

class db{
    // Properties
    private $dbhost = 'mysql';
    private $dbuser = 'root';
    private $dbpass = '123456';
    private $dbname = 'wsingresse';
    // Connect
    public function connect(){
        $mysql_connect_str = "mysql:host=$this->dbhost;dbname=$this->dbname";
        $dbConnection = new PDO($mysql_connect_str, $this->dbuser, $this->dbpass);
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbConnection;
    }
}

/*
$host = "mysql";
$user = "beto"; //getenv("MYSQL_USER");
$pass = "123456"; //getenv("MYSQL_PASSWORD");
 
$conn = mysqli_connect($host, $user, $pass);
if (!$conn) {
    exit("Connection failed: " .mysqli_connect_error().PHP_EOL);
}
 
echo "Successful database connection!".PHP_EOL;   
mysqli_close($conn);
*/
?>