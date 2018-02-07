<?php
namespace Control;
use Control\Lean;
use Core\Config;

class VideosControl extends Lean{

    function admin_index(){
        $this->Send("title", "Lista de Videos");
        $this->Send("subtitle", "/Videos");
    }

    function admin_nuevo(){
        $this->Send("title", "Nuevo video");
        $this->Send("subtitle", "/Videos");
    }

      function admin_editar($id,$nombre){
        $this->Send("title", "Editar video");
        $this->Send("subtitle", "/Videos");
        $this->Send("id",$id);
    }

     function api_getdata(){
      $Videos = $this->Videos->find("*",array('order'=>array("id_videos"=>"desc"),"limit"=>"0,2"));
      return $Videos;
    }

     function api_getdatalll(){
      $num = count($this->Videos->find("*"));
      $has= ceil(($num/4));
      $Video = $this->Videos->find("*", array("order" => array("id_videos" => "desc"), "limit" => "0,5"),true);

        $resultado=[];
        $resultado[0]=$has;
        $resultado[1]=$Video;
        return $resultado;
    }
    
    function api_getdatos($id = false){
        if(!$id){

                $Campos = $filtro= $filtro2 = array();
                //$filtro = isset($this->filtro)?$this->filtro:array();
                $field = isset($this->field)?$this->field:(isset($this->Post["fields"])?$this->Post["fields"]:"*");
                $table = isset($this->table)?$this->table:"find";
                $having = isset($this->having)?$this->having:false;

                $this->__fieldSearch($Campos, (isset($this->prefix)?$this->prefix:""));
                $this->__setFilter($filtro, (isset($this->prefix)?$this->prefix:""));

                if(isset($this->extend)){
                    $filtro =array_merge($filtro, $this->extend);
                    if(count($Campos)) $filtro["and"] = $Campos;
                }else if(count($Campos)) $filtro = array("or"=>$Campos);


                $WhereCount = array("conditions" => $filtro);
                $Where = array("order" => array($this->Post["sort"] => $this->Post["order"]), "limit" => $this->Post["offset"].", ".$this->Post["limit"], "conditions" => $filtro);

                if(isset($this->join))
                    $Where["join"] = $WhereCount["join"] = $this->join;
                if($having){
                    $Where["having"] = $having;

                }

                $datos = $this->{$this->Name}->{$table}((isset($this->fields)?$this->fields:$field), $Where, true);
                $max = $this->{$this->Name}->{$table}("count(*) as total", $WhereCount , false);
                $max = $max["total"];

                //echo $this->{$this->Name}->Log();

                return array("total"=>$max, "rows"=>$datos);
        }else{
            return $this->Videos->onlyByIdVideos($id);
        }
    }

    function api_guardar($id = false){
        if(count($this->Post)){
            if(!$id){
                $b= $this->Videos->query('select MAX(id_videos) AS id FROM videos');
                $b=$b[0]["id"]+1;
                $this->Post["orden"]=$b;
                $r = $this->Videos->save($this->Post);
            }
            else {
                $r = $this->Videos->modify($this->Post, ["id_videos"=>$id]);
            }
            if(isset($r["error"])) return ["error"=>_t("ERRGRAL")];
            else if(isset($r["warning"])) return $r;
            else return ["success"=>_t("DGUARDAR")];
        }
     }

    function api_eliminar($id){
        $resultado= $this->Videos->del(["id_videos"=>$id]);
           if(isset($resultado["error"])) return ["error"=>_t("ERRGRAL")];
           else if(isset($resultado["warning"])) return $resultado;
           else return ["success"=>_t("GRLDELETE")];
     }

    function api_ordena(){
        if($this->Post){
            $new = $this->Post["orden"];
            foreach ($new as $cv => &$value) {
                $cv = $cv+1;
                $result = $this->Videos->modify(array("orden"=>$cv),array("id_videos"=>$value));
            }
        }
    }
}
?>
