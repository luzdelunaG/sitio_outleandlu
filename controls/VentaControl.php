<?php
namespace Control;
use Control\Lean;
use Core\Config;

class VentaControl extends Lean{ //clase definida  primer parte de url /mifactura/nosotros 

    function index(){}

    function admin_index(){
        $this->Send("title", "Reporte de Ventas");
        $this->Send("subtitle", "/Venta");
    }

    function api_slider(){
        $id=$this->Venta->query('SELECT id_prod FROM venta where cant_prod >= 2');
        $tope=$this->Venta->query('SELECT count(id_prod) as tope FROM venta where cant_prod >= 2');
        $tope=$tope[0]["tope"];
        for($i=0;$i<$tope;$i++){
          $producto.=$this->Venta->query('SELECT img,nombre,precio,url FROM producto where id_producto='.$id[$i]["id_prod"]);
        }
        return $producto["img"];
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
            return $this->Home->onlyByIdVenta($id);
        }
    }

}