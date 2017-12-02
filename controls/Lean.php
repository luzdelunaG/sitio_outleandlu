<?php
namespace Control;
use Core\Control;
use Core\Config;

class Lean extends Control{
    function Before($funcion){
        $this->Send("ERP_CLIENTE", Config::Reader("Cliente"));
		$this->Send("CLIENTE_LOGO", "logo_".Config::Reader("Cliente").".png");

        return true;
    }

    protected function __setFilter(&$filtro, $prefix = ""){
        if(isset($this->Post["filter"])){
            $tmpFiltro = $filtro;
            $filtro = array();

            foreach($this->Post["filter"] as $Filter => $Val){
                if(isset($Val["_values"])) $filtro[$prefix.$Filter." in"] = $Val["_values"];
                if(isset($Val["eq"])) $filtro[$prefix.$Filter] = $Val["eq"];

                if(isset($Val["lte"]) && isset($Val["gte"]) && $Val["lte"] < $Val["gte"]){
                    $tmp = array();
                    $tmp["or"][$prefix.$Filter." <"] = $Val["lte"]-1;
                    $tmp["or"][$prefix.$Filter." >"] = $Val["gte"]+1;

                    $filtro["or"] = $tmp;
                }else{
                    if(isset($Val["lte"])) $filtro[$prefix.$Filter." <"] = $Val["lte"]-1;
                    if(isset($Val["gte"])) $filtro[$prefix.$Filter." >"] = $Val["gte"]+1;
                }
            }

            $filtro = array_merge($filtro, $tmpFiltro);
        }
    }

    protected function __fieldSearch(&$Campos){
        if(isset($this->Post["search"]) && strlen($this->Post["search"]) > 0){
            $Fields = explode(",", $this->Post["fields"]);

            foreach($Fields as $Field)
                $Campos["or"][$Field." like"] = "%".$this->Post["search"]."%";
        }
    }

    function create_url_new($titulo){
               $conservar = '0-9a-z_'; // juego de caracteres a conservar
               $url=$titulo;
               $url=str_replace(" ","-",$url);
               $regex = sprintf('~[^%s]++~i', $conservar); // case insensitive
               $url= strtolower($url);
               $url = preg_replace($regex, '', $url);
               return $url;
    }

}
?>
