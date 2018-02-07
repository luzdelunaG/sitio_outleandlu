<?php
use Core\Config;
Config::Write("CACHE",false);

Config::Write("BD_HOST","localhost");
//Config::Write("BD_NAME","bonzercr_leanoutlet");
Config::Write("BD_NAME","leanoutlet");
Config::Write("BD_USER","root");
Config::Write("BD_PASS","");
//Config::Write("BD_USER","bonzercr_lean");
//Config::Write("BD_PASS",base64_encode("369CacNjV#+!"));
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
Config::Write("SESSION","LEAN");

Config::Write("Formatos",["image/png", "image/pjpeg", "image/jpg", "image/jpeg", "image/gif"]);
Config::Write("SizeImage",["Logo"=>2]);
Config::Write("DimImage",["Logo"=>array(250,250)]);

Config::Write("SALT", "8925931cEeC6c5f7be9C4");
Config::Write("LOGREG", true);
Config::Write("LOGAPI", ["control"=>"usuarios", "funcion"=>"validar"]);

Config::Path("home",array("control"=>"index","funcion"=>"index"));
Config::Path("mobiliario_lean",array("control"=>"mobiliario/index","funcion"=>"mobiliario/index"));
Config::Path("controles_visuales",array("control"=>"visuales/index","funcion"=>"visuales/index"));
Config::Path("entrenamiento_lean",array("control"=>"materiales/index","funcion"=>"materiales/index"));
Config::Path("entrenamiento_lean/producto/",array("control"=>"materiales/producto","funcion"=>"materiales/producto"));
Config::Path("controles_visuales/producto/",array("control"=>"visuales/producto","funcion"=>"visuales/producto"));
Config::Path("mobiliario_lean/producto/",array("control"=>"mobiliario/producto","funcion"=>"mobiliario/producto"));
Config::Path("aviso_de_privacidad",array("control"=>"aviso/index","funcion"=>"aviso/index"));
Config::Path("blog",array("control"=>"blog/index","funcion"=>"blog/index"));
Config::Path("inicio_sesion",array("control"=>"inicio/index","funcion"=>"inicio/index"));
Config::Path("carrito",array("control"=>"carrito/index","funcion"=>"carrito/index"));

//Config::Path("articulo/".$id,array("control"=>"articulo/index/".$id,"funcion"=>"articulo/index/".$id));
//Config::Path("articulo/que-es-lean-manufacturing",array("control"=>"articulo/index","funcion"=>"articulo/index"));
//Config::Path("articulo/la-manufactura-esbelta-en-el-sector-maquilador",array("control"=>"articulo/index","funcion"=>"articulo/index"));
?>
