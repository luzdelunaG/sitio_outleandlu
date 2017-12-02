<?php
namespace Plugins;
use Core\Plugins;

class Table extends Plugins{
	function Tabla($control,$atributos, $campos=array(), $datos=array(), $acciones=array()){
		$ta = 0;
		$totales = array();
		$iconos = array("editar"=>"pencil", "baja"=>"cancel-circled", "eliminar"=>"trash", "ver"=>"search", "imprimir"=>"print", "pdf"=>"download", "cerrado"=>"lock", "abierto"=>"unlock", "calendario"=>"calendar-1", "adjuntos"=>"paperclip", "seguimiento"=>"comment-discussion", "asignar"=>"user-add", "pesos"=>"dollar",'billetera'=>'wallet-money', 'proveedor'=>'delivery-transport-2', "almacen"=>"down-circled", "principal"=>"hospital","equipo"=>"mouse");

		$table = "<table id='{$control}' {$atributos}>";
		$table .= "<thead> <tr>";
		$tr = "";

		if(isset($campos['totales'])){
			foreach($campos['totales'] as $cve => $tp){
				$$tp=0;
				$totales[] = $tp;
			}

			unset($campos['totales']);
		}

		foreach($campos as $cve => $Campo){
			if(is_array($Campo)) $table .= "<th style='text-align:".(isset($Campo[1]["align"])?$Campo[1]["align"]:"right").";'>{$Campo[0]}</th>";
			else $table .= "<th>{$Campo}</th>";
		}

		foreach($datos as $cve => $dato){
			$tr .= "<tr>";
			$td = "";

			foreach($campos as $cv => $Campo){
				if(is_array($Campo)){
					if(isset($Campo[1]["moneda"]))
						$td .= "<td style='text-align:".(isset($Campo[1]["align"])?$Campo[1]["align"]:"right").";'>".number_format($dato[$cv],$Campo[1]["moneda"])."</td>";
					else $td .= "<td>{$dato[$cv]}</td>";
				}else $td .= "<td>{$dato[$cv]}</td>";
			}

			foreach($totales as $cve => $total) $$total += $dato[$total];

			if(count($acciones)){
				$td.="<td style='text-align:right;' class='td-actions'>";

				foreach($acciones as $id => $Accion){
					$ta = count($Accion);

					foreach($Accion as $ct => $Liga){
						if(!is_array($Liga))
							$td.= $this->Link($Liga.$dato[$id],"",array("title"=>ucwords($ct)." ".$control, "data-accion"=>ucwords($ct)." {$control}", "class"=>"btn-mini btn-success icon-{$iconos[$ct]} ".ucwords($ct)));
						else{

							$tmpClass = ucwords($ct);
							if(!isset($Liga['parametros']['title'])) $Liga['parametros']['title'] = ucwords($ct)." ".$control;
							if(!isset($Liga['parametros']['data-accion'])) $Liga['parametros']['data-accion'] = ucwords($ct)." ".$control;

							if(isset($Liga['parametros']['class'])){
								$tmpClass = ucwords($Liga['parametros']['class']);
								unset($Liga['parametros']['class']);
							}

							$Liga['parametros']['class'] = "btn-mini btn-success icon-{$iconos[$ct]} ".$tmpClass;

							$bdr = true;

							if(isset($Liga[1][0]))
								$bdr = eval("return {$dato[$Liga[1][0]]} {$Liga[1][1]} {$Liga[1][2]};");

							if($bdr){
								if($ct != "sicono")
									$td.= $this->Link($Liga[0].$dato[$id],"",$Liga['parametros']);

								if(isset($Liga[1][3])) $tr="<tr {$Liga[1][3]}>";
							}
						}
					}
				}

				$td.="</td>";
			}

			$tr .= $td."</tr>";

		}

		if(count($acciones)){
			$ta = ($ta * 38) + 30;
			$table .= "<th class='td-actions' style='width:{$ta}px;'></th>";
		}

		$table .= "</tr></thead>";


		if(count($totales)){
			$table .= "<tfoot><tr>";


			$tc = count($campos) - count($totales);
			$table .= "<th colspan='{$tc}'><b>Totales</b></th>";

			foreach($totales as $cve => $total){
				if(is_array($campos[$total])){
					if(isset($campos[$total][1]["moneda"]))
						$table .= "<th style='text-align:right;'><b>".number_format($$total, $campos[$total][1]["moneda"])."</b></th>";
				}else $table .= "<th><b>".$$total."</b></th>";
			}

			if(count($acciones))
				$table .= "<th></th>";

			$table .= "</tr></tfoot>";
		}
		$table .= $tr;

		$table .= "</table>";
		return $table;
	}
};
