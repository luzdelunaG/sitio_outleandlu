<?php
namespace Control;
use Control\Lean;
use Core\Config;

class RegistroControl extends Lean{

	function index(){}

	function api_ver(){
		return $this->Post["email"];
	}

	function api_guardar($id = false){
			 
					if(!$id){
						$b=$this->Registro->query('select MAX(id_registro) AS id FROM registro');
						$b=$b[0]["id"]+1;
						$this->Post["orden"]=$b+1;
						$r = $this->Registro->save($this->Post);
					 }
					 else {
						$r = $this->Registro->modify($this->Post, ["id_registro"=>$id]);
					 }
					 if(isset($r["error"])) return ["error"=>_t("ERRGRAL")];
					 else if(isset($r["warning"])) return $r;
					 else return ["success"=>_t("DGUARDAR")];
			 
	}

	function api_ordena(){
 			if($this->Post){
 					$new = $this->Post["orden"];
 					foreach ($new as $cv => &$value) {
 							$cv = $cv+1;
 							$result = $this->Registro->modify(array("orden"=>$cv),array("id_registro"=>$value));
 					}
 			}
 	}
}
?>
