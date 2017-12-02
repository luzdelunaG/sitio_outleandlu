<?php
namespace Control;
use Core\Control;

class ErrorsControl extends Control{
	function notfound(){
		$this->Send("title", _t("ERROR404"));
	}

	function enconstruccion(){
		echo _t("ERROR503");
		$this->Send("title", _t("ERROR503"));
	}

	function errorhandler($error){
		$this->Send("title", _t("ERROR404"));
		$this->Send("Error", $error);
	}

	function sinpermiso(){
		$this->Send("titulo", _t("ERROR403"));
	}

	function sql(){
		$this->Send("titulo", _t("ERROR510"));
	}

}
?>
