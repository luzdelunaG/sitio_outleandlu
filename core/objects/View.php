<?php
namespace Core;
use Core\Config;
use Abs\View as AbsView;
use Intcs\View as IntView;
use \Twig_Autoloader;
use \Twig_Loader_Filesystem;
use \Twig_Environment;
use \Twig_Extension_Optimizer;
use \Twig_NodeVisitor_Optimizer;
use \Twig_Extension_Debug;
use \Twig_SimpleFunction;

class View extends AbsView implements IntView{
	protected $Data = array();
	var $Msg = array(), $Plugins = array("Javascript","Html", "Form"), $Tpl = "index";
	static protected $Instance;

    public static function Singleton(){
		if(self::$Instance==null){
			$c = __CLASS__;
			self::$Instance=new $c();
		}

		return self::$Instance;
	}

	public function Show($control,$archivo){
		$PathTemplate = TEMPLATE.Config::Reader("FPLANTILLA");
		$PathPages = PAG.strtolower($control);
		$PathScript = SCRIPT . strtolower($control) . DS . strtolower($archivo) . ".js";
		$cache = Config::Reader("CACHE") ? CACHE : false;

		$templates = array($PathTemplate);

		if(file_exists($PathPages)) $templates[] = $PathPages;

        Twig_Autoloader::register();
		$loader = new Twig_Loader_Filesystem($templates);
		$twig = new Twig_Environment($loader, array("cache" => $cache, "debug" => true, "autoescape"=>false));
		$optimizer = new Twig_Extension_Optimizer(Twig_NodeVisitor_Optimizer::OPTIMIZE_FOR);

		$twig->addExtension(new Twig_Extension_Debug());
		$twig->addExtension($optimizer);

		foreach($this->Plugins as $Plugins){
            $classPlugins = "Plugins\\".$Plugins;
			$twig->addGlobal($Plugins, new $classPlugins);
        }

		$function = new Twig_SimpleFunction('_t', function ($text, $data = "") {
			return  _t($text, $data);
		});

		$isarray = new Twig_SimpleFunction('_isarray', function ($data) {
			return  is_array($data);
		});

		$twig->addFunction($function);
		$twig->addFunction($isarray);

		$this->Data["body"] = "";
		if(file_exists($PathPages.DS.$archivo.".html")){
			$page = $twig->loadTemplate($archivo.".html");
			$this->Data["body"] = $page->render($this->Data);
		}

		if(file_exists($PathScript)){
            Config::Write('script', file_get_contents($PathScript), true);
		}

/*		preg_match_all("/<script[^>]* src='(.+?)' *><\/script>/si",$this->Data["body"],$js);
		$this->Data["body"] = preg_replace("#<script[^>]* src='(.+?)'></script>#is"," ",$this->Data["body"]);

		preg_match_all("/<script[^>]*>(.+?)<\/script>/si",$this->Data["body"],$script);
		$this->Data["body"] = preg_replace("#<script[^>]*>(.+?)</script>#is"," ",$this->Data["body"]);*/

		//Config::Write('script',join("\n",$script[1]),true);
		Config::Write('js',$js[1]);

		$this->Data["Msg"] = $this->Msg;
		$this->Data["Errors"] = Config::Reader("Errors");

		$template = $twig->loadTemplate($this->Tpl.'.tpl');

		return $template->render($this->Data);
	}

	public function setVar($vars){
		foreach($vars as $cve => $val){
			$this->Data[$cve]=$val;
		}
	}

	public function setTpl($file){
		$this->Tpl=$file;
	}
}
?>
