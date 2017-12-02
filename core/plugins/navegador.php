<?php
namespace Plugins;
use Core\Plugins;


class Navegador extends Plugins{
    private $props = array("Version" => "0.0.0", "Name" => "unknown", "Agent" => "unknown", "AllowsHeaderRedirect" => true);

    public function __construct(){
        $browsers = array("firefox", "msie", "opera", "chrome", "safari", "mozilla", "seamonkey",    "konqueror", "netscape", "gecko", "navigator", "mosaic", "lynx", "amaya", "omniweb", "avant", "camino", "flock", "aol");

        $this->Agent = strtolower(isset($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:"");

        foreach($browsers as $browser){
            if (preg_match("#($browser)[/ ]?([0-9.]*)#", $this->Agent, $match)){
                $this->Name = $match[1] ;
                $this->Version = $match[2] ;
                break ;
            }
        }

        $this->AllowsHeaderRedirect = !($this->Name == "msie" && $this->Version < 7) ;
    }

    public function __get($name){
        if (!array_key_exists($name, $this->props)){
            die("No such property or function {$name}");
        }

        return $this->props[$name] ;
    }
}
?>
