<?php
namespace Control;
use Control\Lean;
use Core\Config;

class ArticuloControl extends Lean{
	function index($id){
  
    }

    function api_getdatall(){
      $num = count($this->Articulo->find("*"));
      $has= ceil(($num/4));
      $Blogs = $this->Articulo->find("*", array("order" => array("id_articulo" => "desc"), "limit" => "0,5"),true);

        $resultado=[];
        $resultado[0]=$has;
        $resultado[1]=$Blogs;
        return $resultado;
    }


    function admin_nuevo(){
        $this->Send("title", "Nuevo Artículo");
        $this->Send("subtitle", "/Artículo");
    }

	function admin_index(){
        $this->Send("title", "Vista de Artículo");
        $this->Send("subtitle", "/Articulo");
    }

    function admin_editar($id){
        $this->Send("title", "Editar página Artículo");
        $this->Send("subtitle", "/Articulo");
        $this->Send("id",$id);
    }

     function api_getdata(){
      $Articulo = $this->Articulo->find("*");
      return $Articulo;
    }

    function api_getinfo($id){
      $Articulo = $this->Articulo->onlyByUrl($id);
      return $Articulo;
    }

     function api_getultimos(){
      $Articulo = $this->Articulo->find("*",array('order'=>array("id_articulo"=>"desc"),"limit"=>"0,3"));
      return $Articulo;
    }

    function api_recientes(){
      $Blog = $this->Articulo->find("*",array('order'=>array("id_articulo"=>"desc"),"limit"=>"0,3"));
      return $Blog;
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
            return $this->Articulo->onlyByIdArticulo($id);
        }
    }

    function api_guardar($id = false){
        if(count($this->Post)){
            $ruta = ROOT."fileimages".DS."articulo".DS;
            if(!$id){
                $b=$this->Articulo->query('select MAX(id_articulo) AS id FROM articulo');
                $b=$b[0]["id"]+1;
                $nombretmp=$_FILES['img']['tmp_name'];
                $newfilename = rand(5000, 15000);
                $rutacliente=$ruta.$_FILES['img']['name'];
                if((move_uploaded_file($nombretmp, $rutacliente))){
                    $this->Post["img"]=$_FILES['img']['name'];
                    $this->Post["orden"]=$b+1;
                    $r = $this->Articulo->save($this->Post);
                }
            }
            else {
                if ($_FILES) {
                    if(move_uploaded_file($_FILES['img']['tmp_name'], $ruta.$_FILES['img']['name'])){
                        $this->Post["img"]=$_FILES['img']['name'];
                    }
                }
                $r = $this->Articulo->modify($this->Post, ["id_articulo"=>$id]);
            }
            if(isset($r["error"])) return ["error"=>_t("ERRGRAL")];
            else if(isset($r["warning"])) return $r;
            else return ["success"=>_t("DGUARDAR")];
        }
     }

     function api_eliminar($id){
        $resultado= $this->Articulo->del(["id_articulo"=>$id]);
           if(isset($resultado["error"])) return ["error"=>_t("ERRGRAL")];
           else if(isset($resultado["warning"])) return $resultado;
           else return ["success"=>_t("GRLDELETE")];
     }

      function api_ordena(){
        if($this->Post){
            $new = $this->Post["orden"];
            foreach ($new as $cv => &$value) {
                $cv = $cv+1;
                $result = $this->Articulo->modify(array("orden"=>$cv),array("id_articulo"=>$value));
            }
        }
    }
    
}
?>

