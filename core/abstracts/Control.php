<?php
namespace Abs;

abstract class Control{
	var $Name, $Model, $View, $Lang, $User, $Function;
	var $Plugins=array(), $Session=array(), $Post = array(), $Get = array();
	abstract protected function Send($cve, $dato);
	abstract protected function Msg($msg);
	abstract protected function SendIndex($array);
	abstract protected function Tpl($file);
	abstract public function Redirect($path=false, $prefix=false);

	public function Run($function, $parameters=array()){
		$this->Send("title",$this->Name);

		$this->_Function = $function;
		$this->Post = $_POST;
		$this->Get = $_GET;

		unset($_POST, $_GET);
	}

	public function Ajax(){
		$this->Send("Ajax",true);

        $this->Tpl("ajax");
	}

	function __toString(){
		return str_replace(["Control", "\\"], "", get_class($this));
	}
}
?>
