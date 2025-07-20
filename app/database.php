<?php

/* database connection stuff here
 * 
 */

function db_connect() {
    try { 
        $dbh = new PDO('mysql:host=' . DB_HOST . ';port='. DB_PORT . ';dbname=' . DB_DATABASE, DB_USER, DB_PASS);
        $dbh->exec("SET time_zone = 'America/Toronto'");
        return $dbh;
    } catch (PDOException $e) {
        //We should set a global variable here so we know the DB is down
    }
}