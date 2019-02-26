# SlimApp RESTful API

This is a REST api built with the SlimPHP framework, nginx server and uses MySQL for storage.

### Requeriments

Install Docker https://www.docker.com/

Install Git https://git-scm.com/

Install Composer https://getcomposer.org/


### Installation

git Clone https://github.com/silvaeberton/Webserver-Ingresse

Open db.php and edit db/config params

Navigate to app folder and execute docker-compose build

Navigate to app folder an execute docker-compose up

Navigate to localhost:8080 and login using db params

Create database: See below

Stop compose CTRL + C

Start again docker-compose up

### Create Database

Navigate to localhost:8080

Do login with db params previus configured

Navigate to SQL and execute this comands:

```SQL
CREATE DATABASE wsingresse if NOT EXISTS;

USE wsingresse;

CREATE TABLE users(
id int(4) AUTO_INCREMENT;
nome varchar(30) NOT NULL,
email varchar(50),
PRIMARY KEY (id)
);
```
### Usage

Use an rest client like REATEASY or POSTMAN whit Content-Type: application/json

Exemple
```json
{
    "name" : "Eberton",
    "email": "beto.eberton@rest.com.br"    
}
```

### Unitary test

Navigate to app folder and execute this command

vendor/bin/phpunit ./tests/test.php

### Cache time

To change Cache time navigate and open index.php and change line
```php
$resWithExpires = $this->cache->withExpires($response, time() + 3600 * 24);
```
Where 24 indicate time in hours

### API Endpoints
```sh
$ GET /api/users
$ GET /api/users/{id}
$ POST /api/users/add
$ PUT /api/users/update/{id}
$ DELETE /api/users/delete/{id}
```
