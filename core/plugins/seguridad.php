<?php
namespace Plugins;
use Core\Plugins;

class Seguridad extends Plugins{
	function __construct(){}

	public static function datos(){
		self::__xss();
		self::__tags();
		return $_POST;
	}

	private static function __xss(){
		foreach ($_POST as $cve => $valor) {
			if (preg_match("/]*(script|object|iframe|applet|window|document|cookie|meta|style|alert|form|php|img).*\"?[^>]*>/i", $valor))
				unset($_POST[$cve]);
		}
	}

	private static function __tags(){
		foreach ($_POST as &$valor) {
			if(!is_array($valor)){
				$valor = strip_tags($valor);
				$valor = stripslashes($valor);
			}else{
				foreach ($valor as &$value) {
					$value = strip_tags($value);
					$value = stripslashes($value);
				}
			}
		}
	}
}
?>
