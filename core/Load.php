<?php
define("DS",DIRECTORY_SEPARATOR);
define("SERVER",$_SERVER["SERVER_NAME"]);
define("URLSHORT",dirname($_SERVER["PHP_SELF"]));
define("ROOT",dirname(dirname(__FILE__)).DS);
define("CORE",ROOT."core".DS);
define("CACHE",ROOT."cache".DS);
define("OBJ",CORE."objects".DS);
define("CTRL",ROOT."controls".DS);
define("MODEL",ROOT."models".DS);
define("TEMPLATE",ROOT."templates".DS);
define("PAG",ROOT."views".DS);
define("PLUGINS",CORE."plugins".DS);
define("LIB",CORE."lib".DS);
define("TWIG",LIB."Twig".DS);
define("PLUG",ROOT."plugins".DS);
define("SCRIPT",ROOT."script".DS);
define("LANG",ROOT."language".DS);
define("SID",session_id());
define("INTCS",CORE."interfaces".DS);
define("ABS",CORE."abstracts".DS);

$path=explode("/",trim(URLSHORT,"/"));

if(isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"]=="on") $path = "https://".SERVER."/".$path[0];
else $path = "http://".SERVER."/".$path[0];

$path=trim($path,"/");
define("SITE",$path."/");
unset($path);

define("URLSITE",SITE.(isset($_GET["url"])?$_GET["url"]:""));
define("URLAPI",SITE."api/".(isset($_GET["url"])?$_GET["url"]:""));

require CORE."Lang.php";
require CORE."Autoload.php";
require OBJ."Excepcion.php";
require TWIG."Autoloader.php";
require ROOT."configuracion.php";

$Dispatcher = new \Core\Dispatcher();
$Dispatcher->procesar();
?>
