<?php

echo "<script src='http://code.jquery.com/jquery-1.8.2.js'></script>
      <script src='http://code.jquery.com/ui/1.9.1/jquery-ui.js'></script>";
echo "<script>
    function abrir_dialog() {
      $( '#dialog' ).dialog({
          modal: true
      });
    };
    </script>";
    echo "<body>";
    echo "<div id='dialog' title='Titulo dialog' style='display:none;'>";
    echo "<p>Contenido de la ventana.</p>";
    echo " <button onclick='abrir_dialog()'>Abrir ventana emergente</button>";
    echo "</div>";

define('E_FATAL',  E_ERROR | E_USER_ERROR | E_PARSE | E_CORE_ERROR | 
        E_COMPILE_ERROR | E_RECOVERABLE_ERROR);
define('ENV', 'dev');
//Custom error handling vars
define('DISPLAY_ERRORS', TRUE);
define('ERROR_REPORTING', E_ALL | E_STRICT);
define('LOG_ERRORS', TRUE);
register_shutdown_function('shut');
set_error_handler('handler');
//Function to catch no user error handler function errors...
function shut(){
    $error = error_get_last();
    if($error && ($error['type'] & E_FATAL)){
        handler($error['type'], $error['message'], $error['file'], $error['line']);
    }
}
function handler( $errno, $errstr, $errfile, $errline) {
    switch ($errno){
        case E_ERROR: // 1 //
            $typestr = 'E_ERROR'; break;
        case E_WARNING: // 2 //
            $typestr = 'E_WARNING'; break;
        case E_PARSE: // 4 //
            $typestr = 'E_PARSE'; break;
        case E_NOTICE: // 8 //
            $typestr = 'E_NOTICE'; break;
        case E_CORE_ERROR: // 16 //
            $typestr = 'E_CORE_ERROR'; break;
        case E_CORE_WARNING: // 32 //
            $typestr = 'E_CORE_WARNING'; break;
        case E_COMPILE_ERROR: // 64 //
            $typestr = 'E_COMPILE_ERROR'; break;
        case E_CORE_WARNING: // 128 //
            $typestr = 'E_COMPILE_WARNING'; break;
        case E_USER_ERROR: // 256 //
            $typestr = 'E_USER_ERROR'; break;
        case E_USER_WARNING: // 512 //
            $typestr = 'E_USER_WARNING'; break;
        case E_USER_NOTICE: // 1024 //
            $typestr = 'E_USER_NOTICE'; break;
        case E_STRICT: // 2048 //
            $typestr = 'E_STRICT'; break;
        case E_RECOVERABLE_ERROR: // 4096 //
            $typestr = 'E_RECOVERABLE_ERROR'; break;
        case E_DEPRECATED: // 8192 //
            $typestr = 'E_DEPRECATED'; break;
        case E_USER_DEPRECATED: // 16384 //
            $typestr = 'E_USER_DEPRECATED'; break;
    }
    
     $myFile = $errfile;
     $lines = file($myFile);
     $content = null;
     
     $x = 1;
     foreach($lines as $value)
     {
         if ($x == $errline)
         {
          $content = htmlspecialchars("Line " . $x . ": " . $value);
         }
         $x++;
     }
         
    $message = "<hr><div class='label label-danger'><b>$typestr: </b>$errstr<b> IN FILE: </b>$errfile</div><hr><pre>".$content."</pre>";
    if(LOG_ERRORS)
    $report = "[".date("Y-m-d h:m:s")."] [$typestr: $errstr] [IN FILE $errfile] [LINE $errline]\n";
    error_log($report, 3, "../app/logs/error.log");
        
    if(!($errno & ERROR_REPORTING))
        return;
    if(DISPLAY_ERRORS)
    printf('%s', $message);
    exit;
}