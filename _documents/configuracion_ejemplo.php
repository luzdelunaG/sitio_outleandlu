<?php
use Core\Config;
Config::Write("CACHE",false);
/*

Config::Write("CACHE",false);



Config::Write("CACHE",false);
Config::Write("BD_HOST","sesmarkclientes.com");
Config::Write("BD_NAME","sesmarkc_enow");
Config::Write("BD_USER","sesmarkc_test");
Config::Write("BD_PASS","a3g9S1JPU2ctRm5P");
Config::Write("BD_DRIVE","mysql");
Config::Write("BDCONECT", array("BD"));


Config::Write("BD_HOST","192.168.0.31");
Config::Write("BD_NAME","mifactura");
Config::Write("BD_USER","desarrollo");
Config::Write("BD_PASS","UmQ0emZZMktGbjNNUGUyWg==");
Config::Write("BD_DRIVE","mysql");
Config::Write("BDCONECT", array("BD"));

Config::Write("BD_HOST","localhost");
Config::Write("BD_NAME","mifactura");
Config::Write("BD_USER","root");
Config::Write("BD_PASS","YTA1MDIyNjZh");
Config::Write("BD_DRIVE","mysql");
Config::Write("BDCONECT", array("BD"));

*/


Config::Write("BD_HOST","localhost");
Config::Write("BD_NAME","esperanz_fundacion");
Config::Write("BD_USER","root");
Config::Write("BD_PASS","");

Config::Write("BD_DRIVE","mysql");
Config::Write("BDCONECT", array("BD"));


Config::Write('control',"indexControl");
Config::Write('function',"index");
Config::Write('parametros','');

Config::Write("FPLANTILLA","fundacion");
Config::Write("Admin","admin");
Config::Path("avisodeprivacidad", ["control"=>"index","funcion"=>"politicas"]);
Config::Path("aviso-de-privacidad", array("control" => "politicas", "function" => "index"));
Config::Path("voluntarios", array("control" => "involucrate", "function" => "index"));
Config::Path("terminos-y-condiciones", array("control" => "politicas", "function" => "terminos"));
Config::write("SEO",true);
/*****  Selección de Idiomas *****/
Config::Write("LANG",true);
Config::Write("LANGUAGES",["mx"=>"Español", "en"=>"Ingles"]);
Config::Write("LANGDEFAULT","mx");


Config::Write("IMG",["images", "fileimages"]);
Config::Write("SESSION","MIFACTURA");

Config::Write("Formatos",["image/png", "image/pjpeg", "image/jpg", "image/jpeg", "image/gif"]);
Config::Write("SizeImage",["Logo"=>2]);
Config::Write("DimImage",["Logo"=>array(250,250)]);

Config::Write("SALT", "8925931cEeC6c5f7be9C4");
Config::Write("LOGREG", true);
Config::Write("LOGAPI", ["control"=>"usuarios", "funcion"=>"validar"]);



?>
