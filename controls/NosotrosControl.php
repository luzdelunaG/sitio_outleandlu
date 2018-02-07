<?php
namespace Control;
use Control\Lean;
use Core\Config;

class NosotrosControl extends Lean{
	function index(){}

    function api_sesion(){
        session_start();
        if(isset($_SESSION['usuario'])){
          $email=$_SESSION['usuario']['email'];
        }else{
          $email="no";
        }
        return $email;
    }

    function api_cerrarsesion(){
        session_destroy();
    }


  	function admin_index(){
        $this->Send("title", "Vista de Nosotros");
        $this->Send("subtitle", "/Nosotros");
    }

    function admin_editar($id,$nombre){
        $this->Send("title", "Editar página Nosotros");
        $this->Send("subtitle", "/Nosotros");
        $this->Send("id",$id);
    }

     function api_getdata(){
      $Nosotros = $this->Nosotros->find("*");
      return $Nosotros;
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
            return $this->Nosotros->onlyByIdNosotros($id);
        }
    }

    function api_guardar($id = false){
        if(count($this->Post)){
            $ruta = ROOT."fileimages".DS."nosotros".DS;
            if(!$id){
                $b=$this->Nosotros->query('select MAX(id_nosotros) AS id FROM nosotros');
                $b=$b[0]["id"]+1;
                $nombretmp=$_FILES['img']['tmp_name'];
                $newfilename = rand(5000, 15000);
                $rutacliente=$ruta.$_FILES['img']['name'];
                $nombretmp1=$_FILES['imgcu']['tmp_name'];
                $newfilename1= rand(5000, 15000);
                $rutacliente1=$ruta.$_FILES['imgcu']['name'];
                $nombretmp2=$_FILES['imgcd']['tmp_name'];
                $newfilename2= rand(5000, 15000);
                $rutacliente2=$ruta.$_FILES['imgcd']['name'];
                $nombretmp3=$_FILES['imgcd']['tmp_name'];
                $newfilename3=rand(5000, 15000);
                $rutacliente3=$ruta.$_FILES['imgct']['name'];
                $nombretmp3=$_FILES['imgct']['tmp_name'];
                if((move_uploaded_file($nombretmp, $rutacliente))&&(move_uploaded_file($nombretmp1, $rutacliente1))&&(move_uploaded_file($nombretmp2, $rutacliente2))&&(move_uploaded_file($nombretmp3, $rutacliente3))){
                    $this->Post["img"]=$_FILES['img']['name'];
                    $this->Post["imgcu"]=$_FILES['imgcu']['name'];
                    $this->Post["imgcd"]=$_FILES['imgcd']['name'];
                    $this->Post["imgct"]=$_FILES['imgct']['name'];
                    $this->Post["orden"]=$b+1;
                    $r = $this->Nosotros->save($this->Post);
                }
            }
            else {
                if ($_FILES) {
                    if(move_uploaded_file($_FILES['img']['tmp_name'], $ruta.$_FILES['img']['name'])){
                        $this->Post["img"]=$_FILES['img']['name'];
                    }
                    if(move_uploaded_file($_FILES['imgcu']['tmp_name'], $ruta.$_FILES['imgcu']['name'])){
                        $this->Post["imgcu"]=$_FILES['imgcu']['name'];
                    }
                    if(move_uploaded_file($_FILES['imgcd']['tmp_name'], $ruta.$_FILES['imgcd']['name'])){
                        $this->Post["imgcd"]=$_FILES['imgcd']['name'];
                    }
                    if(move_uploaded_file($_FILES['imgct']['tmp_name'], $ruta.$_FILES['imgct']['name'])){
                        $this->Post["imgct"]=$_FILES['imgct']['name'];
                    }
                }
                $r = $this->Nosotros->modify($this->Post, ["id_nosotros"=>$id]);
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
                $result = $this->Nosotros->modify(array("orden"=>$cv),array("id_nosotros"=>$value));
            }
        }
    }

}
?>
