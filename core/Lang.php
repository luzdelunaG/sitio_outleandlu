<?php
use Core\Config;

function _t($text, $data = ""){
    $system["ERRLANG"] = "Error (404): Idioma <em><strong>%s</strong></em> no encontrado";
    $system["ERRCRL"] = "Error (404): Control <em><strong>%s</strong></em> no encontrado";
    $system["ERRMODEL"] = "Error (404): Modelo <em><strong>%s</strong></em> no encontrado";
    $system["ERRTPL"] = "Error (404): Plantilla <em><strong>%s</strong></em> no encontrada";

    $system["FIELDFLOAT"] = "El Campo <em><strong>%s</strong></em> no tiene formato flotante";
    $system["FIELDINT"] = "El Campo <em><strong>%s</strong></em> no tiene formato entero";
    $system["FIELDEMAIL"] = "El Campo <em><strong>%s</strong></em> no es un email valido";
    $system["FIELDURL"] = "El Campo <em><strong>%s</strong></em> no es una url valida";
    $system["FIELDHTML"] = "El Campo <em><strong>%s</strong></em> no contiene un formato de html valido";
    $system["FIELDSTRING"] = "El Campo <em><strong>%s</strong></em> contiene cadena no valida";
    $system["SNTOKEN"] = "Falta <em><strong>token</strong></em>";
    $system["ERRORTOKEN"] = "El <em><strong>token</strong></em> no es correcto";


    $lang = Config::Reader("IDIOMA");

    if(Config::Reader("LANG"))
        include_once(LANG. $lang .".php");

    $lang = "Lang".ucwords($lang);
	$lang = call_user_func($lang);

	$text = strtoupper($text);
	$text = $lang[$text]?$lang[$text]:$system[$text];

	if(is_array($data)) return vsprintf($text, $data);
	else return sprintf($text, $data);
}

?>
