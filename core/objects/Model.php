<?php
namespace Core;
use Core\Database;
use Intcs\Model as IntModel;
use Core\Config;

class Model extends Database implements IntModel{
    private $tableOver = false;
    private $antVal = [];
    private $desc = [];
    public $belongTo =[];
    public $One = [];
    public $Many = [];
    public $soon = [];
	public function __call($name, $arguments){
        $array = preg_split('/([A-Z][^A-Z]*)/', $name, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
		$array = array_map(strtolower, $array);

		$table = $array[0];

		if($table == "save"){
            $this->tableOver = $array[1];
            return $this->save($arguments[0]);
		}else if($table == "modify"){
            $this->tableOver = $array[1];
            return $this->modify($arguments[0], $arguments[1]);
		}else if($table == "del"){
            $this->tableOver = $array[1];
            return $this->del($arguments[0]);
		}else if($table == "get"){
			return $this->Desc($array[1]);
		}else{
			if(count($array) > 1){
				unset($array[0], $array[1]);

				$conditions = array();
				$field = array();
				$type = "and";

				foreach ($array as $value){
					if(stristr("and, or", $value)){
						$conditions[] = array("type"=>$type, join("_",$field) => $arguments[count($conditions)]);
						$field = array();
						$type = $value;
					}else $field[] = $value;
				}

				$conditions[] = array("type"=>$type, join("_",$field) => $arguments[count($conditions)]);
			}

            if($table == "find") return $this->find('all', ["conditions"=>$conditions]);
			else if($table == "only") return $this->find('all', ["conditions"=>$conditions], false);
			else{
				if(count($conditions)){
					return $this->GetData($table, "*", ["conditions"=>$conditions]);
				}else{
					return $this->GetData($table, $arguments[0], isset($arguments[1])?$arguments[1]:null, isset($arguments[2])?$arguments[2]:true);
				}
			}
		}
	}

	public function find($fields = 'all', $options = [], $index = true){
        $fields = $fields=="all"?"*":$fields;
        $table = $this->tableOver?$this->tableOver:strtolower($this->name);
		return $this->GetData($table, $fields, $options, $index);
	}

	public function query($query,$indice=true,$recuperar=false){
		return $this->Execute($query,$recuperar,$indice);
	}

	public function save($data){
		$validate = $this->BeforeSave($data);

		if($validate === true){
            $table = $this->tableOver?$this->tableOver:strtolower($this->name);
            $id = $this->Insert($table, $data);

            if(!isset($id["error"])) $this->AfterSave($data, $id);
            return $id;
		}else return $validate;
	}

	public function modify($data, $options = []){
		$validate = $this->BeforeModify($data, $options);

		if($validate === true){
            $table = $this->tableOver?$this->tableOver:strtolower($this->name);
            $response = $this->Update($table, $data, $options);

            if(!isset($response["error"])) $this->AfterModify($data, $options);
            return $response;
		}else return $validate;
	}

	public function del($options = []){
        $validate = $this->BeforeDelete($options);

        if($validate === true){
            $table = $this->tableOver?$this->tableOver:strtolower($this->name);
            $response = $this->Delete($table, $options);

            if(!isset($response["error"])) $this->AfterDelete($options);
            return $response;
        }else return $validate;
	}

	public function getcolumn($table, $option = []){
		return $this->Desc(strtolower($table), $option);
	}

	private function BeforeSave(&$data){
        $validate = $this->ValidateData($data);
        return $validate;
    }

    private function BeforeModify(&$data, $options){
        $validate = $this->ValidateData($data);

        if($validate === true && Config::Reader("LOGREG")){
            $table = $this->tableOver?$this->tableOver:strtolower($this->name);
            $key = array_keys($data);
            $this->desc = $this->Desc($table, ["COLUMN_KEY"=>"pri"]);
            $key[] = $this->desc[0]["COLUMN_NAME"];
            $this->antVal = $this->find(join(",",$key), ["conditions"=>$options]);
        }

        return $validate;
    }

    private function BeforeDelete(&$data){
        $validate = $this->ValidateData($data);

        if($validate === true){
            $validate = [];
            //var_dump($data);
            //  var_dump($this->soon);
            $select="";
            $inicio=0;
            foreach ($this->soon as $hijo => $value) {
            if($inicio==0){
                $select=$select."select '".$hijo."' as entidad, count(*) as total from ".$hijo." ";
                $inicio=$inicio+1;
            }else{
                $select=$select." union select '".$hijo."' as entidad, count(*) as total from ".$hijo." ";
                $inicio=$inicio+1;
            }
            foreach ($value as   $foregink) {
                $cont=0;
                foreach ($foregink as   $campo) {

                 $result=  $this->find($campo, ["conditions"=>$data],false);
                 if(count($result)){
                    if($cont==0)
                         $select=$select." where ";
                     else
                         $select=$select." and ";
                    $select=$select." ".$campo." = ".$result[$campo];
                    $cont=$cont+1;
                 }
                }
            }
            }
            $hijos= $this->query($select,false);
            $leyenda="EL registro no se puede eliminar, primero elimine los registros relacionados en ";
            $entidad="";
            $c=0;
            $seguir=0;

            foreach ($hijos as $hij ) {
                foreach ($hij as $h => $val ) {
                    if($h=="entidad"){
                        $entidad=$val;
                    }else{

                        if(intval($val)>0){
                            $seguir=1;
                            if($c>0){
                                $leyenda=$leyenda." y ";
                            }
                            $c=$c+1;
                            $leyenda=$leyenda.$entidad;
                        }
                    }

                }
            }

            if(!$seguir && Config::Reader("LOGREG")){
                $validate=true;
                $table = $this->tableOver?$this->tableOver:strtolower($this->name);
                $this->antVal = $this->find("*", ["conditions"=>$data]);
            }else{
                $validate["warning"]=$leyenda;
            }

       }

       return $validate;
    }

    private function AfterSave(&$data, &$id){
        if(Config::Reader("LOGREG")){
            $table = $this->tableOver?$this->tableOver:strtolower($this->name);

            $this->Insert("bitacoras", ["id"=>id, "fecha"=>date("Y-m-d H:i:s"), "id_usuario"=>1, "tabla"=>$table, "accion"=>"creado", "nuevo"=>json_encode($data)]);
        }

        $this->tableOver = false;
        $this->antVal = false;
    }

    private function AfterModify(&$data, &$options){
        if(Config::Reader("LOGREG")){
            $table = $this->tableOver?$this->tableOver:strtolower($this->name);

            $ids = $this->find($this->desc[0]["COLUMN_NAME"] . " as id", ["conditions"=>$options]);

            foreach ($ids as &$id) {
                $id["fecha"] = date("Y-m-d H:i:s");
                $id["id_usuario"] = 1;
                $id["tabla"] = $table;
                $id["accion"] = "modificado";

                $tmpAnt = [];

                foreach($this->antVal as $val){
                    if($val[$this->desc[0]["COLUMN_NAME"]] == $id["id"]){
                        unset($val[$this->desc[0]["COLUMN_NAME"]]);
                        $tmpAnt = $val;
                    }
                }

                $id["anterior"] = json_encode($tmpAnt);
                $id["nuevo"] = json_encode($data);
            }

            $this->Insert("bitacoras", $ids);
        }

        $this->tableOver = false;
        $this->antVal = false;
    }

    private function AfterDelete(&$options){
        if(Config::Reader("LOGREG")){
            $table = $this->tableOver?$this->tableOver:strtolower($this->name);

            $ids = $this->find($this->desc[0]["COLUMN_NAME"] . " as id", ["conditions"=>$options]);

            foreach ($ids as &$id) {
                $id["fecha"] = date("Y-m-d H:i:s");
                $id["id_usuario"] = 1;
                $id["tabla"] = $table;
                $id["accion"] = "eliminado";

                $tmpAnt = [];

                foreach($this->antVal as $val){
                    if($val[$this->desc[0]["COLUMN_NAME"]] == $id["id"]){
                        unset($val[$this->desc[0]["COLUMN_NAME"]]);
                        $tmpAnt = $val;
                    }
                }

                $id["anterior"] = json_encode($tmpAnt);
                $id["nuevo"] = json_encode($data);
            }

            $this->Insert("bitacoras", $ids);
        }

        $this->tableOver = false;
        $this->antVal = false;
    }



    private function ValidateData(){
        $msg = [];

		if(isset($this->validate)){
			foreach($this->validate as $field => $validate){
				switch ($validate["type"]) {
					case 'float':
						$temp =  filter_var($data[$field], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

						if(!filter_var($temp, FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION))
						    $msg[] = _t("FIELDFLOAT", $field);

						break;
					case 'int':
						$temp =  filter_var($data[$field], FILTER_SANITIZE_NUMBER_INT);

						if(!filter_var($temp, FILTER_VALIDATE_INT))
						    $msg[] = _t("FIELDINT", $field);

						break;
					case 'email':
						$temp =  filter_var($data[$field], FILTER_SANITIZE_EMAIL);

						if(!filter_var($temp, FILTER_VALIDATE_EMAIL))
						    $msg[] = _t("FIELDEMAIL", $field);

						break;
					case 'url':
						$temp =  filter_var($data[$field], FILTER_SANITIZE_URL);

						if(!filter_var($temp, FILTER_VALIDATE_URL))
						    $msg[] = _t("FIELDURL", $field);

						break;
					case 'html':
						$temp =  filter_var($data[$field], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
						break;
					default:
						$temp =  filter_var($data[$field], FILTER_SANITIZE_STRING, FILTER_FLAG_ENCODE_AMP);
						break;
				}

				$data[$field] = $temp;

			}
		}

		return count($msg)?$msg:true;
	}
}
?>
