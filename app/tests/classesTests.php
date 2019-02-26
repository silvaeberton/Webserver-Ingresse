<?php
namespace Beto\APIteste;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

class App
{
    private $app;

    public function __construct() {
        $app = new \Slim\App;
        
        $app->get('/', function (Request $request, Response $response) {
            echo "GET ALL";            
        });
        
        $this->app = $app;
    }
    
    public function get()
    {
        return $this->app;
    }
}