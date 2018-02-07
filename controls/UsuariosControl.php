<?php
namespace Control;
use Control\Lean;
use Core\Config;
use Lib\Jwt\JWT;
use Lib\Jwt\ExpiredException;
use \PHPMailer;

class UsuariosControl extends Lean{
	function index(){}

	function admin_index(){
        $this->Send("title", "Lista de Usuarios");
        $this->Send("subtitle", "/Usuarios");
    }

    function admin_nuevo(){
        $this->Send("title", "Nuevo usuario");
        $this->Send("subtitle", "/Usuarios");
    }

      function admin_editar($id,$nombre){
        $this->Send("title", "Editar Usuario: ".$nombre);
        $this->Send("subtitle", "/Usuario");
        $this->Send("id",$id);
    }

    function admin_login(){
        $this->Send("referer", $_SERVER['HTTP_REFERER']);
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
            return $this->Usuarios->onlyByIdUsuario($id);
        }
    }


    function api_guardar($id = false){
        if(count($this->Post)){
            if(!$id) {
            	$this->Post["contrasena"]=password_hash($this->Post["contrasena"],PASSWORD_BCRYPT,['cost'=>12]);
                $a=count($this->Usuarios->find());
                $this->Post["orden"]=$a+1;  	
                $r = $this->Usuarios->save($this->Post);
            }
            else {
                $this->Post["contrasena"]=password_hash($this->Post["contrasena"],PASSWORD_BCRYPT,['cost'=>12]);    
                $r = $this->Usuarios->modify($this->Post, ["id_usuario"=>$id]);
            }
            if(isset($r["error"])) return ["error"=>_t("ERRGRAL")];
            else if(isset($r["warning"])) return $r;
            else return ["success"=>_t("DGUARDAR")];
        }
     }


  	function getdata(){
		$this->extend = array("lbaja"=>0,"id_usuario>"=>2);
		parent::getdata();

		$this->Ajax();
	}

	function api_validar(){
		if(ctype_alnum($this->Post["usuario"])){
            $usuario = $this->Usuarios->onlyByUsuario($this->Post["usuario"]);
            	
            if(!empty($usuario)){
            	  if (password_verify($this->Post["password"], $usuario["contrasena"])) {
                    
                    unset($usuario["contrasena"]);

                    $secretKey = base64_decode(Config::Reader("SALT"));

                    $data = [
                        'iss'  => SITE,
                        'aud'  => SITE,
                        'iat'  => time(),
                        'exp'  => time() +  (60 * 60 * 24 * 7),
                        'sub' => 'usuario',
                        'admin' => true,
                        'data' => $usuario
                    ];

                    $jwt = JWT::encode($data, $secretKey,'HS512');
                    $menu=$usuario["admin"];                   
                    return ['token' =>$jwt, "menu"=>$menu,"success"=>"Autentificación valida"];
                }else return ["error"=>"La contraseña o usuario incorrecto"];
            }else return ["error"=>"El usuario no existe"];
        }
	}

	private function __permisos(&$usuario, &$menus, &$permisos){
		$menus = $this->Usuarios->Permisos(
            "c.id_control, c.menu, c.control, c.icono",
            [
                "join"=>[
                    ["table"=>"funciones", "conditions"=>"b.id_funcion=a.id_funcion"],
                    ["table"=>"controles","conditions"=>"c.id_control = b.id_control"]
                ],
                "conditions"=>["isnull(c.menu)"=>false, "a.id_perfil"=>$usuario['id_perfil']],
                "group"=>["c.id_control"],
                "order"=>["c.orden"=>"asc"]
            ], true
        );

		foreach($menus as $cve => &$menu){
			$tmps = $this->Usuarios->Permisos(
                "a.id_funcion",
                [
                    "join"=>[
                        ["table"=>"funciones", "conditions"=>"b.id_funcion=a.id_funcion"],
                        ["table"=>"controles","conditions"=>"c.id_control = b.id_control"]
                    ],
                    "conditions"=>["isnull(b.menu)"=>false, "a.id_perfil"=>$usuario['id_perfil'], "b.id_control"=>$menu['id_control']],
                    "group"=>["b.id_funcion"],
                    "order"=>["b.orden"=>"asc"]
                ]
            );

            foreach($tmps as $tmp) $permisos[$tmp["id_funcion"]] = 1;
		}
	}


      function api_ordena(){
        if($this->Post){
            $new = $this->Post["orden"];
            foreach ($new as $cv => &$value) {
                $cv = $cv+1;
                $result = $this->Usuarios->modify(array("orden"=>$cv),array("id_usuario"=>$value));
            }
        }
    }

    function api_eliminar($id){
        $resultado= $this->Usuarios->del(["id_usuario"=>$id]);
           if(isset($resultado["error"])) return ["error"=>_t("ERRGRAL")];
           else if(isset($resultado["warning"])) return $resultado;
           else return ["success"=>_t("GRLDELETE")];
        
     }

	
}
?>
