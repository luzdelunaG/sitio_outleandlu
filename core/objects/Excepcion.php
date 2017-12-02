<?php
use Core\Config;

function myErrorHandler($errno, $errstr, $errfile, $errline){
	$tmp = $temp = "";

	if(strstr($errstr,"ARRAY")){
		$errstr = str_replace("ARRAY:","",$errstr);
		$temp = unserialize($errstr);
		$errstr = $temp['Error'];
	}

	switch ($errno) {
    case E_USER_ERROR:
        if ($errstr == "(SQL)"){
            $tmp .= "<b>SQL Error</b> [$errno] " . SQLMESSAGE . "<br />";
            $tmp .= "Query : " . SQLQUERY . "<br />";
            $tmp .= "On line " . SQLERRORLINE . " in file " . SQLERRORFILE . " <br />";
            $tmp .= ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />";
        } else {
            $tmp .= "<b>ERROR [$errno]:</b> {$errstr}<br />";
            $tmp .= "<b>SUGERENCIA:</b> {$temp['Sug']}<br />";

            if(isset($temp['Code'])){
				$tmp .= "<b>CODIGO SUGERIDO:</b><br />";
				$tmp .= "<div class='custom-text'>".highlight_string($temp['Code'],true)."</div><br />";
			}

            $tmp .= "<b>DETALLES:</b> <br/>";
            $tmp .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Archivo: <code style='color:#0000FF;'>$errfile</code><br />";
            $tmp .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Linea: <code style='color:#0000FF;'>$errline</code><br />";
            $tmp .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PHP: <code style='color:#0000FF;'>" . PHP_VERSION . "</code><br />";
            $tmp .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SO: <code style='color:#0000FF;'>" . PHP_OS . "</code><br />";
            $tmp .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Navegador: <code style='color:#0000FF;'>".strtoupper(Config::Leer("Navegador")->Name)." (".Config::Leer("Navegador")->Version.")</code>";
        }

    case E_USER_WARNING:
    case E_USER_NOTICE:
    }

    Config::Reader('control','erroresControl');
    Config::Reader('funcion','errorhandler');
    Config::Reader('parametros',base64_encode($tmp));

    return true;
}

set_error_handler("myErrorHandler");
?>
