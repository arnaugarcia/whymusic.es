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
    public function getFieldSQL($tabla, $campo, $sql){
        $query_user = DB::connect()->prepare("SELECT ".$campo." FROM ".$tabla." ".$sql." ");
        $query_user->execute();
        $result_row = $query_user->fetchAll();
        return $result_row;
    }
    public function getUserDataEstilo($estilo_id)
    {
        if ($this->connect()) {
            $query_user = $this->connect()->prepare("SELECT estilo_nombre FROM wm_estilo WHERE estilo_id = :estilo_id");
            $query_user->bindValue(':estilo_id', $estilo_id, PDO::PARAM_STR);
            $query_user->execute();
            $result_row = $query_user->fetchObject();
            return $result_row->estilo_nombre;
        } else {
            return false;
        }
    }
    public function getIdioma($usuario_id)
    {
        if ($this->connect()) {
            $query_user = $this->connect()->prepare("SELECT usuario_idioma FROM wm_usuarios WHERE usuario_id = :usuario_id");
            $query_user->bindValue(':usuario_id', $usuario_id, PDO::PARAM_STR);
            $query_user->execute();
            $result_row = $query_user->fetchObject();
            if ($result_row->usuario_idioma=="en") {
                return "Inglés";
            }else if ($result_row->usuario_idioma=="es") {
                return "Español";
            }else if ($result_row->usuario_idioma=="ca") {
                return "Català";
            }
        } else {
            return false;
        }
    }
}