<?php
namespace Control;
use Control\Lean;
use Core\Config;

class VisualesControl extends Lean{ //clase definida  primer parte de url /mifactura/nosotros
      function index(){}

      function producto($id){}

      function admin_index(){
     			$this->Send("title", "Vista de Controles Visuales");
     			$this->Send("subtitle", "/Visuales");
     	}

     	function admin_editar($id,$nombre){
     			$this->Send("title", "Editar página Controles Visuales");
     			$this->Send("subtitle", "/Visuales");
     			$this->Send("id",$id);
     	}

     	 function api_getdata(){
     		$Visuales = $this->Visuales->find("*");
     		return $Visuales;
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
     					return $this->Visuales->onlyByIdVisuales($id);
     			}
     	}

     	function api_guardar($id = false){
     			if(count($this->Post)){
     					$ruta = ROOT."fileimages".DS."visuales".DS;
     					if(!$id){
     							$b=$this->Visuales->query('select MAX(id_visuales) AS id FROM visuales');
     							$b=$b[0]["id"]+1;
     							$nombretmp=$_FILES['img']['tmp_name'];
     							$newfilename = rand(5000, 15000);
     							$rutacliente=$ruta.$_FILES['img']['name'];
     							if((move_uploaded_file($nombretmp, $rutacliente))){
     									$this->Post["img"]=$_FILES['img']['name'];
     									$this->Post["orden"]=$b+1;
     									$r = $this->Visuales->save($this->Post);
     							}
     					}
     					else {
     							if ($_FILES) {
     									if(move_uploaded_file($_FILES['img']['tmp_name'], $ruta.$_FILES['img']['name'])){
     											$this->Post["img"]=$_FILES['img']['name'];
     									}
     							}
     							$r = $this->Visuales->modify($this->Post, ["id_visuales"=>$id]);
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
     							$result = $this->Visuales->modify(array("orden"=>$cv),array("id_visuales"=>$value));
     					}
     			}
     	}

  }
?>
