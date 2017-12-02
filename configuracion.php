<?php
use Core\Config;
Config::Write("CACHE",false);

Config::Write("BD_HOST","localhost");
Config::Write("BD_NAME","");
Config::Write("BD_USER","root");
Config::Write("BD_PASS",base64_encode(""));
Config::Write("BD_DRIVE","mysql");
Config::Write("BDCONECT", array("BD"));

Config::Write('control',"indexControl");
Config::Write('function',"index");
Config::Write('parametros','');

Config::Write("FPLANTILLA","lean");
Config::Write("Admin","admin");
Config::write("SEO",true);
/*****  Selección de Idiomas *****/
Config::Write("LANG",true);
Config::Write("LANGUAGES",["mx"=>"Español", "en"=>"Ingles"]);
Config::Write("LANGDEFAULT","mx");


Config::Write("IMG",["images", "fileimages"]);
Config::Write("SESSION","FUNDACION");

Config::Write("Formatos",["image/png", "image/pjpeg", "image/jpg", "image/jpeg", "image/gif"]);
Config::Write("SizeImage",["Logo"=>2]);
Config::Write("DimImage",["Logo"=>array(250,250)]);

Config::Write("SALT", "8925931cEeC6c5f7be9C4");
Config::Write("LOGREG", true);
Config::Write("LOGAPI", ["control"=>"usuarios", "funcion"=>"validar"]);



?>
