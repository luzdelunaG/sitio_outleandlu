<?php
namespace Control;
use Control\Lean;
use Core\Config;

class SliderhomeControl extends Lean{

    function admin_index(){
        $this->Send("title", "Lista de elementos del Slider del Home");
        $this->Send("subtitle", "/Sliderhome");
    }

    function admin_nuevo(){
        $this->Send("title", "Nuevo elemento");
        $this->Send("subtitle", "/Sliderhome");
    }

      function admin_editar($id,$nombre){
        $this->Send("title", "Editar elemento");
        $this->Send("subtitle", "/Sliderhome");
        $this->Send("id",$id);
    }
     function api_getdata(){
      $Sliderhome = $this->Sliderhome->find("*",array('order'=>array("id_sliderhome"=>"desc"),"limit"=>"0,3"));
      return $Sliderhome;
    }
    function app_getdata2(){
     $Sliderhome = $this->Sliderhome->Sliderhome2("*", false, false);
     return $Sliderhome;
   }
    function app_nomcategoria($id){
      $Sliderhome = $this->Sliderhome->onlyByIdCategoria($id);
      return $Sliderhome;
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
            return $this->Sliderhome->onlyByIdSliderhome($id);
        }
    }

    function api_guardar($id = false){
        if(count($this->Post)){
            $ruta = ROOT."fileimages".DS."home".DS;
            if(!$id){

                $b= $this->Sliderhome->query('select MAX(id_sliderhome) AS id FROM sliderhome');
                $b=$b[0]["id"]+1;

                if(move_uploaded_file($_FILES['imgsl']['tmp_name'], $ruta.$_FILES['imgsl']['name']))
                {
                    $this->Post["orden"]=$b;
                    $this->Post["imgsl"]=$_FILES['imgsl']['name'];
                }
                $r = $this->Sliderhome->save($this->Post);
            }
            else {
                if ($_FILES) {
                        if(move_uploaded_file($_FILES['imgsl']['tmp_name'], $ruta.$_FILES['imgsl']['name']))
                    {
                        $this->Post["imgsl"]=$_FILES['imgsl']['name'];
                    }
                }
                $r = $this->Sliderhome->modify($this->Post, ["id_sliderhome"=>$id]);
            }
            if(isset($r["error"])) return ["error"=>_t("ERRGRAL")];
            else if(isset($r["warning"])) return $r;
            else return ["success"=>_t("DGUARDAR")];
        }
     }

    function api_eliminar($id){
        $resultado= $this->Sliderhome->del(["id_sliderhome"=>$id]);
           if(isset($resultado["error"])) return ["error"=>_t("ERRGRAL")];
           else if(isset($resultado["warning"])) return $resultado;
           else return ["success"=>_t("GRLDELETE")];
     }

    function api_ordena(){
        if($this->Post){
            $new = $this->Post["orden"];
            foreach ($new as $cv => &$value) {
                $cv = $cv+1;
                $result = $this->Sliderhome->modify(array("orden"=>$cv),array("id_sliderhome"=>$value));
            }
        }
    }
}
?>
