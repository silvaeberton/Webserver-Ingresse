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




### Installation

Create database or import from _sql/slimapp.sql

Edit db/config params

Install SlimPHP and dependencies

```sh
$ composer
```
### API Endpoints
```sh
$ GET /api/users
$ GET /api/users/{id}
$ POST /api/users/add
$ PUT /api/users/update/{id}
$ DELETE /api/users/delete/{id}
```
