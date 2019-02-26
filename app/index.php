<?php
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

require 'database/db.php';
require 'vendor/autoload.php';

$container = new \Slim\Container;
$container['cache'] = function () {
    return new \Slim\HttpCache\CacheProvider();
};
$app = new \Slim\App($container);
$app->add(new \Slim\HttpCache\Cache('public', 86400));

$app->get('/api/users/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute("id");
    $sql = "SELECT * FROM users WHERE id=$id";

    $resWithExpires = $this->cache->withExpires($response, time() + 3600 * 24);
    $newResponse = $resWithExpires->withHeader('Content-type', 'application/json')
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE');
    try{
        $db = new db();
        $db = $db->connect();        
        $stmt = $db->query($sql);
        $user = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        return $newResponse->withJson($user);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
    
});


$app->get('/api/users', function(Request $request, Response $response){
    $sql = "SELECT * FROM users";

    $resWithExpires = $this->cache->withExpires($response, time() + 3600 * 24);
    $newResponse = $resWithExpires->withHeader('Content-type', 'application/json')
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE');

    try{
        $db = new db();
        $db = $db->connect();        
        $stmt = $db->query($sql);
        $users = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        return $newResponse->withJson($users);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
    
});

$app->post('/api/users/add', function(Request $request, Response $response){
    
    $name = $request->getParam('name');
    $email = $request->getParam('email');

    echo "Nome = " . $name . "<br />";
    echo "Email = " . $email . "<br />";
    
    $sql = "INSERT INTO users (name,email) VALUES(:name,:email)";
    try{
        $db = new db();
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
        $db = new db();
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
        $db = new db();
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