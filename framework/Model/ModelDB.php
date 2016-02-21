<?php
class DB{
    public static function connect(){
        return new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
    }
    public function getDataDB($tabla, $campo){
        $query_user = DB::connect()->prepare('SELECT * FROM '.$tabla.' ');
        $query_user->execute();
        $result_row = $query_user->fetchAll(PDO::FETCH_COLUMN, 1);
        return $result_row;
    }
}