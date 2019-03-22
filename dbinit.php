<?php

include_once("dbcon.php");

$link = DBcon();

$commands[] = "CREATE TABLE IF NOT EXISTS uzik (
id INT AUTO_INCREMENT,
user INT NOT NULL,
date DATETIME NOT NULL,
uzi TEXT NOT NULL,
PRIMARY KEY (id)
);";

$commands[] = "CREATE TABLE IF NOT EXISTS users (
id INT AUTO_INCREMENT,
name VARCHAR(30) NOT NULL,
password VARCHAR(32) NOT NULL,
level INT DEFAULT 0,
PRIMARY KEY (id)
);";

//$commands[] = "ALTER TABLE uzik
//ADD FOREIGN KEY user REFERENCES users(id);";

$commands[] = "INSERT INTO users VALUES(NULL, \"admin\", MD5(\"admin\"), 2);";


var_dump($commands);

foreach ($commands as $command) {
    $link->query($command);
}

$link->close();