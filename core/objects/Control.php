<?php
namespace Core;
use Core\Config;
use Abs\Control as AbsControl;
use Intcs\Control as IntControl;
use Core\View;

class Control extends AbsControl implements IntControl{
	function __construct(){
        $this->Name = $this;

        if(Config::Reader("bdrAdmin") == "api"){
    		$model = "Model\\".$this;

    		if(class_exists($model, true)){
    			$this->{$this->Name} = new $model;
    		}else Config::Errors(sprintf(ERRMODEL, $this->Name));
        }

        $this->View = View::Singleton();
	}

	function Run($function, $parameters=array()){
        $this->Post = $_POST;
		$this->Get = $_GET;

		unset($_POST, $_GET);

        $bdr = true;
        $bdrAdmin = Config::Reader("bdrAdmin");
        $AntesDe = ($bdrAdmin?$bdrAdmin."_":"")."Before";
		$DepuesDe = ($bdrAdmin?$bdrAdmin."admin_":"")."After";

		if(is_callable(array($this, $AntesDe)))
			$bdr =  call_user_func_array(array($this, $AntesDe), ["function"=>$function, "parameters"=>$parameters]);

        if($bdr && is_callable(array($this, $function))) $api = call_user_func_array(array($this, $function),$parameters);
        else return ["error" => "Error al recuperar datos del metodo {$function}"];

        if(is_callable(array($this, $DepuesDe)))
            call_user_func_array(array($this,$DepuesDe), $parameters);

        if($bdrAdmin != "api"){
    		$this->View->Plugins = array_merge($this->View->Plugins, $this->Plugins);
    	    //$this->Send("LOGDB", $this->{$this->Name}->Log());
            $this->Send("Control", $this->Name);
            $this->Send("Function", $function);
    		return $this->View->show($this->Name, $function);
        }else return $api;
	}

	function Redirect($path=false, $prefix=true){
		header('HTTP/1.0 401 Unauthorized');

		if(!$path) header("Location: ".$_SERVER['HTTP_REFERER']);
		else if(!is_array($path)){
			if(!$prefix)header("Location: ".$path);
            else header("Location: ".URL.($bdrAdmin?$bdrAdmin."/":"").$path);
		}else header("Location: ".URL.($bdrAdmin?$bdrAdmin."/":"").$path["control"]."/".$path["function"]);

		die();
	}

	function Send($cve,$data){
        if($this->View)
		      $this->View->setVar(array($cve=>$data));
	}

	function Msg($msg){
        if($this->View)
		      $this->View->Msg[] = $msg;
	}

	function SendIndex($array){
        if($this->View)
		      $this->View->setVar($array);
	}

	function Tpl($file){
        if($this->View)
		      $this->View->setTpl($file);
	}
}
?>
