 <?php
/**
* Clase encargada de manejar los idimas en la web utulizando constantes
*/
class IDIOMA{
  //Creamos una función que detecte el idioma del navegador del cliente.
 static function getUserLanguage(){
    $idioma = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
    return $idioma;
  }
}
?>