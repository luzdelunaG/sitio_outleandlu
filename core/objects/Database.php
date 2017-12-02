<?php
namespace Core;
use Core\Config;
use Abs\Database as AbsDataBase;
use Core\Log as Log;
use \PDO;
use \PDOException;

class Database extends AbsDataBase{
    private $Log;
    private $Arguments = [];
    private $Config = [];
    var $token;

	function __construct(){
        $this->Log = new Log();
        $this->token = Config::Reader("UserToken");

        $driver = array("mysql"=>"mysql:dbname=%s;host=%s", "oracle"=>"oci:dbname=%s;host=%s;port=1521", "pgsql"=>"pgsql:dbname=%s host=%s");

        $this->Config = [
            "drive" => sprintf($driver[Config::Reader("BD_DRIVE")], Config::Reader("BD_NAME"), Config::Reader("BD_HOST")),
            "user" => Config::Reader("BD_USER"),
            "pass" => base64_decode(Config::Reader("BD_PASS"))
        ];
	}

	protected function GetData($Table, $Fields='*', $Arguments=null, $Index=true){
		$this->Arguments = array();

		$query = "select %s from %s %s %s %s %s %s %s";
		$group = $order = $having = $where = $limit = $join = '';

		if(isset($Arguments["join"])){
			$chr=97;
			$aliasTable = isset($Arguments["alias"])?$Arguments["alias"]:chr($chr);
			$Table .= " ".$aliasTable;

			foreach($Arguments["join"] as $Join){
				$chr++;
				$type = "inner";
				$alias = chr($chr);
				$table = $Join;

				if(is_array($Join)){
					$table = $Join["table"];
					$alias = isset($Join["alias"])?$Join["alias"]:$alias;
					$type = isset($Join["type"])?$Join["type"]:$type;
				}

				$id = "id_".substr($table,0,-1);
				$conditions = isset($Join["conditions"])?$Join["conditions"]:"{$alias}.{$id} = {$aliasTable}.{$id}";

				$join .= " {$type} join {$table} {$alias} on $conditions";
			}
		}

		foreach($Arguments["conditions"] as $cve => $Condition){
			if(stristr($cve,  " in")){
				if(!is_array($Condition)) $tmp = explode(",", $Condition);
				else $tmp = $Condition;

				$temp = array_fill(0, count($tmp), "?");
				$where .= ($where?($cve=="or"?" or ":" and "):"")." ";
				$where .= $cve ." (".join (", ", $temp).") ";
				$this->Arguments = array_merge($this->Arguments, $tmp);
			}else if(is_array($Condition)){
				foreach ($Condition as $key => $value){
					if(is_array($value)){
						$where .= ($where?($cve=="or"?" or ":" and "):"")." ( ";

						$tmpWhere = array();
						foreach ($value as $cv => $val) {
							if(stristr($cv, "like")){
								$tmpWhere[] = $cv ." ? ";
								$this->Arguments[] = $val;

							}else if(stristr($cv, " in")){
								if(!is_array($val)) $tmp = explode(",", $val);
								else $tmp = $val;

								$temp = array_fill(0, count($tmp), "?");
								$tmpWhere[] = $cv ." (".join (", ", $temp).") ";
								$this->Arguments = array_merge($this->Arguments, $tmp);

							}else{
								$tmpWhere[] = $cv ."=? ";
								$this->Arguments[] = $val;
							}
						}

						$where .= join(" ".($key?$key:$cve)." ", $tmpWhere );

						$where .= " ) ";
					}else{


						if($key == "type"){
							if(strlen($where) > 0) $where .=  " {$value} ";
						}else{
							if(stristr($key, "like")){
								$where .= $key ." ? ";
								$this->Arguments[] = $value;

							}else if(stristr($key, " in")){
								if(!is_array($value)) $tmp = explode(",", $value);
								else $tmp = $value;

								$temp = array_fill(0, count($tmp), "?");
								$where .= $key ." (".join (", ", $temp).") ";
								$this->Arguments = array_merge($this->Arguments, $tmp);

							}else{
								$where .= $key ."=? ";
								$this->Arguments[] = $value;

							}
						}
					}
				}
			}else{
				$where .= (strlen($where) > 0?" and ":"");

				if(stristr($cve, "like")){
					$where .= $cve ." ? ";
					$this->Arguments[] = $Condition;
				}else if(stristr($cve,  " in")){
					$tmp = explode(",", $Condition);
					$temp = array_fill(0, count($tmp), "?");
					$where .= $cve ." ('".join ("', '", $temp)."') ";
					$this->Arguments = array_merge($this->Arguments, $tmp);
				}else{
					$where .= $cve ."=? ";
					$this->Arguments[] = $Condition;
				}
			}
		}

		if(strlen($where)>0) $where = "where {$where}";

		foreach($Arguments["order"] as $key => $value){
			$order .= "{$key} {$value}, ";
		}

		if(strlen($order)>0) $order = "order by ".trim(trim($order), ",");

		if(count($Arguments["group"]))
			$group = "group by ".join("," , $Arguments["group"]);


		if(count($Arguments["having"]))
			$group = "having ".join(" AND " , $Arguments["having"]);


		if(isset($Arguments["limit"]))
			$limit = " limit ". $Arguments["limit"];

		$query = sprintf($query, $Fields, $Table, $join, $where, $group, $having, $order, $limit);
		return $this->Execute($query, false, $Index);
	}

	protected function Desc($table, $option = []){
		$where = array();
		$where[] = "TABLE_SCHEMA = '". Config::Reader("BD_NAME")."'";
		$where[] = "TABLE_NAME = '{$table}'";

		foreach ($option as $key => $value)
			$where[] = "{$key} = '{$value}'";

		$query ="select COLUMN_NAME, DATA_TYPE, CHARACTER_MAXIMUM_LENGTH, COLUMN_KEY from information_schema.COLUMNS
		where ".join(" AND ", $where);

		return $this->Execute($query);
	}

	protected function Insert($Table, $Data=array()){
		$fields=array();
		$vals=array();
		$multiple = false;

		foreach($Data as $cve => $val){
			if(is_array($val)){
				$mvals = array();
				foreach($val as $cv => $v){
					if($cve == 0) $fields[]= $cv;

					$mvals[]="?";
					$this->Arguments[] = $v;
				}

				$vals[] = "(".join(", ", $mvals).")";
				$multiple = true;
			}else{
				$fields[]= $cve;
				$vals[]="?";
				$this->Arguments[] = $val;
			}
		}

		$query="insert into {$Table} (".join(",",$fields).") values".($multiple?join(", ",$vals):"(".join(",",$vals).")");

		return $this->Execute($query,true, true);
	}

	protected function Update($Table, $Data=array(), $Arguments=array()){
		$fields = $opcion = $vals = array();

		foreach($Data as $cve => $val){
			$fields[] = $cve." = ? ";
			$this->Arguments[] = $val;
		}

		foreach($Arguments as $cve => $val){
			$opcion[] = $cve . " = ? ";
			$this->Arguments[] = $val;
		}

		$query="UPDATE {$Table} SET ".join(", ",$fields)." where ".join(" and ", $opcion);

		return $this->Execute($query, false, true);
	}

	protected function Delete($Table,$Arguments=array()){
		$opcion=array();

		foreach($Arguments as $cve => $val){
			$opcion[] = $cve. " = ? ";
			$this->Arguments[] = $val;
		}

		$query="delete from {$Table} where ".join(" and ", $opcion);
		return $this->Execute($query, false, true);
	}

	protected function Execute($Query, $Index=false, $All=true){
		try{
			$PDO = new PDO($this->Config["drive"], $this->Config["user"], $this->Config["pass"], array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_TIMEOUT=>3, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

			$smt = $PDO->prepare($Query,array(PDO::ATTR_CURSOR => PDO::CURSOR_SCROLL));

			if(count($this->Arguments)) $smt->execute($this->Arguments);
			else $smt->execute();

			$this->Arguments = [];
			$data = $smt->fetchAll(PDO::FETCH_ASSOC);
			$error = $smt->errorInfo();
			$smt=null;

			$count = count($data);
			$this->Log->Add(array("query"=>$Query,"error"=>$error,"count"=>$count));

			if($error[1] != null)
				return ["error" => "({$error[1]}): {$error[2]}"];
			else{
        		if($Index){
					$last =$this->Execute("SELECT LAST_INSERT_ID() as lastId", false, false);
                    return $last["lastId"];
				}else{
					if($count==1 && !$All) return $data[0];
					else return $data;
				}
			}
		}catch (PDOException $e) {
			return ["error" => $e->getMessage()];
		}
	}

	public function Log(){
		return $this->Log->Show();
	}
}
?>
