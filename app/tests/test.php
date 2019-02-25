<?php

use Beto\TodoAPI\App;
use Slim\Http\Environment;
use Slim\Http\Request;

require "classesTests.php";

class TodoTest extends \PHPUnit\Framework\TestCase
{
    protected $app;

    public function setUp():void
    {
        $this->app = (new App())->get();
    }
    public function testTodoGet() {
        
        $env = Environment::mock([
            'REQUEST_METHOD' => 'GET',
            'REQUEST_URI'    => '/',
            'CONTENT_TYPE' => 'application/json;charset=utf8'
            ]);
        $req = Request::createFromEnvironment($env);
        $this->app->getContainer()['request'] = $req;
        $response = $this->app->run(true);
        $this->assertSame($response->getStatusCode(), 200);
        $this->assertSame((string)$response->getBody(), "GET ALL");
    } 
}