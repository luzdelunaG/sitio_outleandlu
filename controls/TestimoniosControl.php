<?php
namespace Control;
use Control\Lean;
use Core\Config;

class TestimoniosControl extends Lean{

    function admin_index(){
        $this->Send("title", "Lista de Casos de Éxito");
        $this->Send("subtitle", "/Testimonials");
    }

    function admin_nuevo(){
        $this->Send("title", "Nuevo Caso de Éxito");
        $this->Send("subtitle", "/Testimonials");
    }

    function admin_editar($id){
        $this->Send("title", "Editar");
        $this->Send("subtitle", "/Testimonials");
        $this->Send("id",$id);
    }
    
     function api_getdata(){
      $Testimonios = $this->Testimonios->find("*",array('order'=>array("id_testimonios"=>"desc"),"limit"=>"0,4"));
      return $Testimonios;
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
            return $this->Testimonios->onlyByIdTestimonios($id);
        }
    }

   function api_guardar($id = false){
        if(count($this->Post)){
            $ruta = ROOT."fileimages".DS."testimonios".DS;
            if(!$id){
                $b=$this->Testimonios->query('select MAX(id_testimonios) AS id FROM testimonios');
                $b=$b[0]["id"]+1;
                $nombretmp=$_FILES['img']['tmp_name'];
                $newfilename = rand(5000, 15000);
                $rutacliente=$ruta.$_FILES['img']['name'];
                if((move_uploaded_file($nombretmp, $rutacliente))){
                    $this->Post["img"]=$_FILES['img']['name'];
                    $this->Post["orden"]=$b+1;
                    $r = $this->Testimonios->save($this->Post);
                }
            }
            else{
                if ($_FILES) {
                    if(move_uploaded_file($_FILES['img']['tmp_name'], $ruta.$_FILES['img']['name'])){
                         $this->Post["img"]=$_FILES['img']['name'];
                    }
                $r = $this->Testimonios->modify($this->Post, ["id_testimonios"=>$id]);
                }
            }
            if(isset($r["error"])) return ["error"=>_t("ERRGRAL")];
            else if(isset($r["warning"])) return $r;
            else return ["success"=>_t("DGUARDAR")];
        }
    }

     function api_eliminar($id){
        $resultado= $this->Testimonios->del(["id_testimonios"=>$id]);
           if(isset($resultado["error"])) return ["error"=>_t("ERRGRAL")];
           else if(isset($resultado["warning"])) return $resultado;
           else return ["success"=>_t("GRLDELETE")];
    }

    function api_ordena(){
        if($this->Post){
            $new = $this->Post["orden"];
            foreach ($new as $cv => &$value) {
                $cv = $cv+1;
                $result = $this->Testimonios->modify(array("orden"=>$cv),array("id_testimonios"=>$value));
            }
        }
    }
}
?>