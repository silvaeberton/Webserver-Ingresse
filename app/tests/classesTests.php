<?php
namespace Beto\TodoAPI;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use PDO;

class db{
    // Properties
    private $dbhost = 'mysql';
    private $dbuser = 'beto';
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

class App
{
    private $app;

    public function __construct() {
        $app = new \Slim\App;
        
        $app->get('/', function (Request $request, Response $response) {
            echo "GET ALL";
            $sql = "SELECT * FROM users";
            try{
                
                $db = new db();
                
                $db = $db->connect();        
                $stmt = $db->query($sql);
                $users = $stmt->fetchAll(PDO::FETCH_OBJ);
                $db = null;
                //echo json_encode($users);
            } catch(PDOException $e){
                echo '{"error": {"text": '.$e->getMessage().'}';
            }
        });
        
        $this->app = $app;
    }
    
    public function get()
    {
        return $this->app;
    }
}