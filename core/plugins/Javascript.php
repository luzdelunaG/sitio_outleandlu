<?php
namespace Plugins;
use Core\Plugins;
use Core\Config;

class Javascript extends Plugins{
	function Js($files){
		if(!is_array($files)) $files = array($files);

		foreach($files as $file)
			echo sprintf($this->tags["javascript"],"templates/".Config::Reader("FPLANTILLA")."/js/".$file);

		echo $this->MostrarScript();
	}

	function Script($file){
		if(file_exists(SCRIPT.$file.".js")){
			$script = file_get_contents(SCRIPT.$file.".js");

			echo "<script type='text/javascript'>".$script."</script>";
		}
	}

	function MostrarScript(){
		$html = "";

		if(Config::Reader('js')){
			foreach(Config::Reader('js') as $js)
				$html .= "<script src='{$js}'></script>";
		}

		if(Config::Reader('script'))
			$html .= "<script type='text/javascript'>".Config::Reader('script')."</script>";

		return $html;
	}
}
?>
