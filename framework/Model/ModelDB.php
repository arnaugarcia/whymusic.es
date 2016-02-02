<?php
class DB{
    public static function connect(){
        return new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
    }
}