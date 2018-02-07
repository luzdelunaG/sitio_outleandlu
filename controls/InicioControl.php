<?php
namespace Control;
use Control\Lean;
use Core\Config;

class InicioControl extends Lean{
	function index(){}

	function recuperar(){}

	function api_sesion(){
		session_start();
	    if(isset($_SESSION['usuario'])){
	      $email=$_SESSION['usuario']['email'];
	    }else{
	      $email="no";
	    }
	    return $email;
 	}

 	 function admin_index(){
        $this->Send("title", "Vista de Usuarios");
        $this->Send("subtitle", "/Registrados");
    }

 	function api_cerrarsesion(){
 		session_start();
	    session_destroy();
	    session_unset();
	    return ["success"=>"Cerrando Sesión"];
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
            return $this->Inicio->onlyByIdInicio($id);
        }
    }


	function registro(){

	}

	function api_validar(){
		$creada=false;
		$usuario=$this->Post['email'];
		$contrasena=$this->Post['password'];
		$verificare=$this->Inicio->query('SELECT * FROM inicio WHERE email="'.$usuario.'"');
		if($verificare[0]["email"]==$usuario){
			if($verificare[0]["contrasena"]==$contrasena){
				session_destroy();
				session_unset();
				session_start();
				$_SESSION['usuario']=$this->Inicio->onlyByEmail($usuario);
				$creada=true;
				if($creada==true) return ["success"=>"Autentificación valida"];
			}else return ["error"=>"Error en el Password"];
        }else return ["error"=>"La contraseña o usuario incorrecto"];    
	}

	function api_guardar($id = false){
			 require_once PLUG."PHPMailer.php";
			 if(count($this->Post)){
			 		$email=$this->Inicio->query('SELECT email FROM inicio where email="'.$this->Post['email'].'"');
			 		if($email[0]["email"]==""){
						if(!$id){
							$enviar=$this->Post['email'];
							$b=$this->Inicio->query('select MAX(id_inicio) AS id FROM inicio');
							$b=$b[0]["id"]+1;
							$this->Post["orden"]=$b+1;
							$r = $this->Inicio->save($this->Post);
							$body = file_get_contents(ROOT."tplmail".DS."registro.html");
							$body = str_replace("===NOMBRE===",$this->Post["nombre"],$body);
							$mail=new \PHPMailer();
			  				$mail->SetLanguage("es","");
			  				$mail->Subject = "Lean Outlet™ | Confirmación de Registro";
			  				$mail->MsgHTML($body);
			          		$mail->AddAddress($enviar,"Registro");
							//$mail->AddAddress("yaz@bonzercreative.com","Yazmine Sanchez");
			  				$mail->Send();
						 }
						 else {
							$r = $this->Inicio->modify($this->Post, ["id_inicio"=>$id]);
						 }
					 }
					 if(isset($r["error"])) return ["error"=>"Error en el Registro"];
					 else if(isset($r["warning"])) return $r;
					 else return ["success"=>"¡Gracias por su Registro!, se ha enviado un correo a su bandeja de entrada."];
			 }
	}

	function api_recuperar($id = false){
			 		require_once PLUG."PHPMailer.php";
			 		$email=$this->Inicio->query('SELECT email FROM inicio where email="'.$this->Post['email'].'"');
			 		if($email[0]["email"]!=""){
							$enviar=$this->Post['email'];
							$b=$this->Inicio->query('SELECT contrasena FROM inicio where email="'.$this->Post['email'].'"');
							$b=$b[0]["contrasena"];
							$body = file_get_contents(ROOT."tplmail".DS."recupera.html");
							$body = str_replace("===CONTRASENA===",$b,$body);
							$mail=new \PHPMailer();
			  				$mail->SetLanguage("es","");
			  				$mail->Subject = "Lean Outlet™ | Recuperación de Cuenta";
			  				$mail->MsgHTML($body);
			          		$mail->AddAddress($enviar,"Usuario");
							//$mail->AddAddress("yaz@bonzercreative.com","Yazmine Sanchez");
			  				$mail->Send();
			  				return ["success"=>"Le hemos enviado su contraseña a su correo electrónico."];
					 }else{
					 		return ["error"=>"Error, el correo no existe."];
					 }
					
	}

	function api_ordena(){
 			if($this->Post){
 					$new = $this->Post["orden"];
 					foreach ($new as $cv => &$value) {
 							$cv = $cv+1;
 							$result = $this->Inicio->modify(array("orden"=>$cv),array("id_inicio"=>$value));
 					}
 			}
 	}

}
?>