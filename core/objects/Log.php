<?php
namespace Core;

class Log{
	var $debug=array();
	private static $Instance=null;

    public static function Singleton(){
        if (self::$Instance==null) {
            $c = __CLASS__;
            self::$Instance = new $c;
        }

        return self::$Instance;
    }

	function Add($datos=array()){
		array_push($this->debug,$datos);
	}

	function Get(){
		return $this->debug;
	}

	function Show(){
		$incre=0;

		$log="<style>
			table {
				border-right:0;
				clear: both;
				color: #333;
				margin-bottom: 10px;
				width: 100%;
			}
			th {
				border:0;
				border-bottom:2px solid #555;
				text-align: left;
				padding:4px;
			}
			th a {
				display: block;
				padding: 2px 4px;
				text-decoration: none;
			}
			th a.asc:after {
				content: ' ⇣';
			}
			th a.desc:after {
				content: ' ⇡';
			}
			table tr td {
				padding: 6px;
				text-align: left;
				vertical-align: top;
				border-bottom:1px solid #ddd;
			}
			table tr:nth-child(even) {
				background: #f9f9f9;
			}
			td.actions {
				text-align: center;
				white-space: nowrap;
			}
			table td.actions a {
				margin: 0px 6px;
				padding:2px 5px;
			}

			.caption {
				color:#fff;
			}
			</style>";

		$log.="<table class='sql-log'>
			<caption>".count($this->debug)." Querys</caption>

			<tr>
				<th>Nr</th>
				<th>Sql</th>
				<th>Error</th>
				<th>Rows</th>
			</tr>";

		 foreach($this->debug as $key){
			$incre++;
			$log.= "
				<tr>
					<td>".$incre."</td>
					<td>".$key['query']."</td>
					<td>".(isset($key['error'][2])?$key['error'][2]:"")."</td>
					<td>".$key['count']."</td>
				</tr>";
		}
		$log.= "</table>";

		return $log;
	}
}
?>
