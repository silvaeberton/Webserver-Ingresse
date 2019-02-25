<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'db.php';

$app = new \Slim\App;


$app->get('/api/users/{id}', function(Request $request, Response $response){
    echo "GET ID <br />";
    $id = $request->getAttribute("id");
    $sql = "SELECT * FROM users WHERE id=$id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();        
        $stmt = $db->query($sql);
        $user = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($user);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
    
});


$app->get('/api/users', function(Request $request, Response $response){
    echo "GET ALL <br />";
    $sql = "SELECT * FROM users";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();        
        $stmt = $db->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($users);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
    
});

$app->post('/api/users/add', function(Request $request, Response $response){
    echo "POST <br />";
    $name = $request->getParam('name');
    $email = $request->getParam('email');

    echo "Nome = " . $name . "<br />";
    echo "Email = " . $email . "<br />";
    
    $sql = "INSERT INTO users (name,email) VALUES(:name,:email)";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email',  $email);
        $stmt->execute();
        echo '{"notice": {"text": "User Added"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

$app->put('/api/users/update/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $name = $request->getParam('name');
    $email = $request->getParam('email');

    echo "ID = " . $id . "<br />";
    echo "Nome = " . $name . "<br />";
    echo "Email = " . $email . "<br />";
    
    $sql = "UPDATE users SET	name = :name, email	= :email WHERE id = $id";
     
    
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email',$email);
        $stmt->execute();
        echo '{"notice": {"text": "User Updated"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

$app->delete('/api/users/delete/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    echo "ID = " . $id . "<br />";

    $sql = "DELETE FROM users WHERE id = $id";
    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "User Deleted"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});


$app->run();