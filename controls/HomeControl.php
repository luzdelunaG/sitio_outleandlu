<?php
namespace Control;
use Control\Lean;
use Core\Config;

class HomeControl extends Lean{ //clase definida  primer parte de url /mifactura/nosotros 

    function index(){}

     function admin_index(){
        $this->Send("title", "Vista de Home");
        $this->Send("subtitle", "/Home");
    }

    function admin_editar($id,$nombre){
        $this->Send("title", "Editar página Home");
        $this->Send("subtitle", "/Home");
        $this->Send("id",$id);
    }

    function api_getdata(){
      $Home = $this->Home->find("*");
      return $Home;
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
            return $this->Home->onlyByIdHome($id);
        }
    }

    function api_guardar($id = false){
        if(count($this->Post)){
            $ruta = ROOT."fileimages".DS."home".DS;
            if(!$id){
                $b=$this->Home->query('select MAX(id_home) AS id FROM Home');
                $b=$b[0]["id"]+1;
                $nombretmp=$_FILES['img']['tmp_name'];
                $newfilename = rand(5000, 15000);
                $rutacliente=$ruta.$_FILES['img']['name'];
                $nombretmp1=$_FILES['imgd']['tmp_name'];
                $newfilename = rand(5000, 15000);
                $rutacliente1=$ruta.$_FILES['imgd']['name'];
                $nombretmp2=$_FILES['imgt']['tmp_name'];
                $newfilename = rand(5000, 15000);
                $rutacliente2=$ruta.$_FILES['imgt']['name'];
                if((move_uploaded_file($nombretmp, $rutacliente))&&(move_uploaded_file($nombretmp1, $rutacliente1))&&(move_uploaded_file($nombretmp2, $rutacliente2))){
                    $this->Post["img"]=$_FILES['img']['name'];
                    $this->Post["imgd"]=$_FILES['imgd']['name'];
                    $this->Post["imgt"]=$_FILES['imgt']['name'];
                    $this->Post["orden"]=$b+1;
                    $r = $this->Home->save($this->Post);
                }
            }
            else {
                if ($_FILES) {
                    if(move_uploaded_file($_FILES['img']['tmp_name'], $ruta.$_FILES['img']['name'])){
                        $this->Post["img"]=$_FILES['img']['name'];
                    }
                    if(move_uploaded_file($_FILES['imgd']['tmp_name'], $ruta.$_FILES['imgd']['name'])){
                        $this->Post["imgd"]=$_FILES['imgd']['name'];  
                    }
                    if(move_uploaded_file($_FILES['imgt']['tmp_name'], $ruta.$_FILES['imgt']['name'])){
                        $this->Post["imgt"]=$_FILES['imgt']['name'];  
                    }
                }
                $r = $this->Home->modify($this->Post, ["id_home"=>$id]);
            }
            if(isset($r["error"])) return ["error"=>_t("ERRGRAL")];
            else if(isset($r["warning"])) return $r;
            else return ["success"=>_t("DGUARDAR")];
        }
     }

      function api_ordena(){
        if($this->Post){
            $new = $this->Post["orden"];
            foreach ($new as $cv => &$value) {
                $cv = $cv+1;
                $result = $this->Home->modify(array("orden"=>$cv),array("id_home"=>$value));
            }
        }
    }
    
}
?>