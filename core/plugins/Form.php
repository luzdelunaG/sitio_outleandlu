<?php
namespace Plugins;
use Core\Plugins;
use Core\Config;

class Form extends Plugins{
	var $subAct = false, $legAct = false, $html = array();
	var $type, $id, $label, $value;

	function Create($Action=null, $Name=null, $Method='post', $Other=array()){
		$this->subAct = $this->legAct = false;
		$this->html = array();

        $bdrAdmin = Config::Reader('bdrAdmin');
		if(!$Name) $Name = $this->NameForm;

		if(is_array($Action)) $Action = strtolower($Action['control']."/".$Action['function']."/");
		else if($Action) $Action = strtolower(substr(Config::Reader('control'),0,-7))."/".$Action;

		if($Action) $Action = URL."api/".$Action;
		else $Action = URLAPI;

		$form = sprintf($this->tags["form"], $Name, $Action,$Method,join(" ",$this->__getParam($Other)));

		return $form;
	}

	function Input($Name, $Option=array()){
		$this->__getData($Option, $Name);
		if($this->label != "") $input = $this->Label();
		return $input. sprintf($this->tags["input"], $this->type, $Name, $this->id, $this->value, join(" ", $this->__getParam($Option)));
	}

	function Textarea($Name, $Option=array()){
		$this->__getData($Option, $Name);
		if($this->label != "")  $text = $this->Label();
		return $text . sprintf($this->tags["textarea"],$Name, $this->id, join(" ",$this->__getParam($Option)), $this->value);
	}

	function Label(){
		$text = $this->label;
		$tmp = array();

		if(is_array($this->label)){
			$text = $this->label["text"];
			unset($this->label['text']);

			$tmp = $this->__getParam($this->label);
		}

		return  sprintf($this->tags["label"], $this->id, join(" ",$tmp), $text);
	}

	function Select($Name, $Option=array(), $Options=array(), $selected = false){
		$op=array();
		$this->__getData($Option, $Name);
		if($this->label != "")  $select = $this->Label();

		if(!is_array($selected) && $selected != false) $selected = array(0=>$selected);

		foreach($Options as $cve => $va){
			if(is_array($va)){
				$op[]="<optgroup label='{$cve}'>";

				foreach($va as $c => $v)
					$op[]="<option value='".$c."' ".(in_array($c, $selected)?"selected='selected'":"").">".$v."</option>";

				$op[]="</optgroup>";
			}else
				$op[]="<option value='".$cve."' ".(in_array($cve, $selected)?"selected='selected'":"").">".$va."</option>";
		}

		return $select . sprintf($this->tags["select"], $Name, $this->id, join(" ",$this->__getParam($Option)),join(" ",$op));
	}

	function Legend($Text = false){
		$this->legAct = true;
		return "<fieldset>".($Text?"<legend>".$Text."</legend>":"");
	}

	function Submit($Name, $Option=array()){
		$this->subAct=true;
		$this->type = isset($Option['type'])?$Option['type']:"submit";

		if(!isset($Option['value'])) $Option['value'] = $Name;
		if(isset($Option["src"])) $this->type = "image";

		unset($Option['type']);

		return sprintf($this->tags["submit"], $this->type, join(" ",$this->__getParam($Option)));
	}

	function End($Name="", $Option=array()){
		$html = "";
		if($Name!="")
			$html .= (!$this->subAct?$this->submit($Name, $Option):"") . ($this->legAct?"</fieldset>":"") . "</form>";
		else
			$html .= ($this->legAct?"</fieldset>":"") . "</form>";


		return $html;
	}

	private function __getParam(&$Options = array()){
		$param = array();

		foreach($Options as $cve => $valor)
			$param[]=$cve."='".$valor."'";

		return $param;
	}

	private function __getData(&$Option = array(), &$Name){
		$this->type=isset($Option['type'])?$Option['type']:"text";
		$this->id=isset($Option['id'])?$Option['id']:$Name;
		$this->label=isset($Option['label'])?$Option['label']:"";
		$this->value=isset($Option['value'])?$Option['value']:"";

		unset($Option['id'], $Option['type'], $Option['label'], $Option['value']);
	}
}
?>
