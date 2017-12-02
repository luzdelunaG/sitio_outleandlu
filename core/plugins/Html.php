<?php
namespace Plugins;
use Core\Plugins;
use Core\Config;

class Html extends Plugins{
	function Meta($meta, $content=null){
		if($meta=="utf8"){
			echo sprintf($this->tags["meta"], "http-equiv", "X-UA-Compatible","IE=edge");
			echo sprintf($this->tags["meta"], "http-equiv","Content-Type","text/html; charset=utf-8");
			echo sprintf($this->tags["meta"], "name", "viewport","width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no");
			echo sprintf($this->tags["meta"], "name", "apple-mobile-web-app-capable","yes");
			echo sprintf($this->tags["meta"], "name", "generator","LFramePHP 3.0 - Lfjaimesb");

			if(Config::Reader("SEO")){
				echo sprintf($this->tags["meta"], "name","keywords",Config::Reader("SEO_KEYWORD"));
				echo sprintf($this->tags["meta"],"name","description",Config::Reader("SEO_DESCRIPTION"));
			}
		}else
			echo sprintf($this->tags["meta"],"name",$meta, $content);

		echo "<base href='".URL."' />";
	}

	function LinkCss($files){
		if(!is_array($files)) $files = array($files);

		foreach($files as $file){
			$type="text/css";
			$rel="stylesheet";

			if($file != "favicon")
				$file = "templates/".Config::Reader("FPLANTILLA")."/css/".$file.".css";
			else if($file=="favicon"){
				$file="templates/".Config::Reader("FPLANTILLA")."/".$file.(($type=="png")?".png":".ico");
				$type=($type=="png")?"image/png":"image/icon";

				echo sprintf("<link  href='%s' rel='%s' type='%s' sizes='%s'/>",$file,"icon",$type, "16x16");
				$rel="shortcut icon";
			}

			echo sprintf("<link href='%s' rel='%s' type='%s' hreflang='%s' media='all' crossorigin='%s' />",$file,$rel,$type,'es', 'annonymous');
		}
	}

	function Link($url, $title, $arguments=array()){
        $bdrAdmin = Config::Reader('bdrAdmin');

		if(isset($arguments["action"])){
			if(!isset($arguments["print"]) || $arguments["print"])
				echo URL.$url;
			else return URL.$url;
		}else{
			$elements=array();

			if(!isset($arguments['prefix']) || $arguments['prefix'])
				$url = URL.($bdrAdmin?$bdrAdmin."/":"").$url;

			unset($arguments['prefix']);

			foreach($arguments as $cve => $valor){
				$elements[]=$cve."='".$valor."'";
			}

			echo "<a href='".str_replace("'","\"",$url)."' ".join(" ",$elements).">".$title."</a>";
		}
	}

	function Img($file, $option=array()){
        $bdrAdmin = Config::Reader('bdrAdmin');
		$back = $link = $only = false;
		$return = "%s";

		if(isset($option['background'])){
			$back=true;
			unset($option['background']);
		}

		if(isset($option["action"])){
			$only = true;
			unset($option["action"]);
		}

		if(isset($option['link'])){
			$link = URL.($bdrAdmin?$bdrAdmin."/":"").$option['link'];

			$param=array();

			if(is_array($option['link'])){
				$link = "";
				if(!isset($option['link']['prefix']) || $option['link']['prefix'])
					$link = URL . ($bdrAdmin?$bdrAdmin."/":"");

				$link .=  $option['link']['url'];
				unset($option['link']['url'], $option['link']['prefix']);

				foreach($option['link'] as $cve => $val) $param[] = $cve ."='".$val."'";
			}

			unset($option['link']);

			$return = sprintf($return, "<a href='{$link}' ".join(" ",$param).">%s</a>");
		}

		if(!isset($option['alt']))
			$option['alt'] = $file;

		$parametros=array();
		foreach($option as $cve => $valor)
			$parametros[]=$cve ."='".$valor."'";

		$ruta = $file;

		foreach(Config::Reader("IMG") as $valor){
			if(file_exists("templates/".Config::Reader("FPLANTILLA")."/".$valor."/".$file)){
				$ruta="templates/".Config::Reader("FPLANTILLA")."/".$valor."/".$file;
				break;
			}else if(file_exists(ROOT.$valor."/".$file)){
				$ruta=URL.$valor."/".$file;
				break;
			}
		}

		if(!$back){
			$img = "<img src='".$ruta."' ".join(" ",$parametros)." />";
			$return = sprintf($return, $img);

			if($only) return $return;
			else echo $return;
		}else echo $ruta;
	}
}
?>
