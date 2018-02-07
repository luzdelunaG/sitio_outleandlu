<?php
namespace Control;
use Control\Lean;
use Core\Config;

class ProductoControl extends Lean{
	function index($id){
        
    }

    function api_getinfo($id){
      $Mobiliario = $this->Producto->onlyByUrl($id);
      return $Mobiliario;
    }

    function api_getinfod($id){
      $Visuales = $this->Producto->onlyByIdCategoria($id);
      return $Visuales;
    }

    function api_getinfot($id){
      $Materiales = $this->Producto->onlyByUrl($id);
      return $Materiales;
    }

    function api_prodmobid(){
        $producto=$this->Producto->query('SELECT * FROM producto WHERE categoria="Mobiliario Lean" LIMIT 0,3');
        return $producto;
    }

    function api_prodmobi(){
        $producto=$this->Producto->query('SELECT * FROM producto WHERE categoria="Mobiliario Lean"');
        return $producto;
    }

    function api_cantproduc(){
        $cantidad = $this->Producto->query('SELECT count(id_producto) as total FROM producto WHERE categoria="Mobiliario Lean"');
        return $cantidad;
    }

    function api_prodcontvd(){
        $producto=$this->Producto->query('SELECT * FROM producto WHERE categoria="Controles Visuales" LIMIT 0,3');
        return $producto;
    }


    function api_prodcontv(){
        $producto=$this->Producto->query('SELECT * FROM producto WHERE categoria="Controles Visuales"');
        return $producto;
    }

    function api_cantproduccv(){
        $cantidad = $this->Producto->query('SELECT count(id_producto) as total FROM producto WHERE categoria="Controles Visuales"');
        return $cantidad;
    }

    function api_prodentrena(){
        $producto=$this->Producto->query('SELECT * FROM producto WHERE categoria="Entrenamiento Lean"');
        return $producto;
    }

    function api_prodentrenad(){
        $producto=$this->Producto->query('SELECT * FROM producto WHERE categoria="Entrenamiento Lean" LIMIT 0,3');
        return $producto;
    }

    function api_cantproduent(){
        $cantidad = $this->Producto->query('SELECT count(id_producto) as total FROM producto WHERE categoria="Entrenamiento Lean"');
        return $cantidad;
    }
     
	function admin_index(){
        $this->Send("title", "Lista de Productos");
        $this->Send("subtitle", "/Producto");
    }

    function admin_nuevo(){
        $this->Send("title", "Nuevo Producto");
        $this->Send("subtitle", "/Producto");
    }

    function admin_editar($id){
        $this->Send("title", "Editar Producto");
        $this->Send("subtitle", "/Producto");
        $this->Send("id",$id);
    }
    
    function api_getdata(){
      $Producto = $this->Producto->find("*",array('order'=>array("id_producto"=>"desc"),"limit"=>"0,3"));
      return $Producto;
    }

    function api_getinfourl($id){
      $Producto = $this->Producto->query('SELECT * FROM producto WHERE url="'.$id.'"');
      return $Producto;
    }

    function api_getdata2(){
      $Producto = $this->Producto->find("*");
      return $Producto;
    }

    function app_getdata2(){
     $Producto = $this->Producto->Producto2("*", false, false);
     return $Producto;
    }

    function app_nomcategoria($id){
      $Producto = $this->Producto->onlyByIdCategoria($id);
      return $Producto;
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
            return $this->Producto->onlyByIdProducto($id);
        }
    }

     function api_guardar($id = false){
        if(count($this->Post)){
            $ruta = ROOT."fileimages".DS."productos".DS;
            if(!$id){
                $b=$this->Producto->query('select MAX(id_producto) AS id FROM producto');
                $b=$b[0]["id"]+1;
                $nombretmpf=$_FILES['file']['tmp_name'];
                $newfilename = rand(5000, 15000);
                $rutaclientef=$ruta.$_FILES['file']['name'];
                $nombretmp=$_FILES['img']['tmp_name'];
                //$newfilename = rand(5000, 15000);
                $rutacliente=$ruta.$_FILES['img']['name'];
                $nombretmp1=$_FILES['imgd']['tmp_name'];
                //$newfilename = rand(5000, 15000);
                $rutacliente1=$ruta.$_FILES['imgd']['name'];
                $nombretmp2=$_FILES['imgt']['tmp_name'];
                //$newfilename = rand(5000, 15000);
                $rutacliente2=$ruta.$_FILES['imgt']['name'];
                $nombretmp3=$_FILES['imgc']['tmp_name'];
                //$newfilename = rand(5000, 15000);
                $rutacliente3=$ruta.$_FILES['imgc']['name'];
                if((move_uploaded_file($nombretmpf, $rutaclientef))&&(move_uploaded_file($nombretmp, $rutacliente))&&(move_uploaded_file($nombretmp1, $rutacliente1))&&(move_uploaded_file($nombretmp2, $rutacliente2))&&(move_uploaded_file($nombretmp3, $rutacliente3))){
                    $this->Post["file"]=$_FILES['file']['name'];
                    $this->Post["img"]=$_FILES['img']['name'];
                    $this->Post["imgd"]=$_FILES['imgd']['name'];
                    $this->Post["imgt"]=$_FILES['imgt']['name'];
                    $this->Post["imgc"]=$_FILES['imgc']['name'];
                    $this->Post["orden"]=$b+1;
                    $r = $this->Producto->save($this->Post);
                }
            }
            else {
                if ($_FILES) {
                    if(move_uploaded_file($_FILES['file']['tmp_name'], $ruta.$_FILES['file']['name'])){
                        $this->Post["file"]=$_FILES['file']['name'];
                    }
                    if(move_uploaded_file($_FILES['img']['tmp_name'], $ruta.$_FILES['img']['name'])){
                        $this->Post["img"]=$_FILES['img']['name'];
                    }
                    if(move_uploaded_file($_FILES['imgd']['tmp_name'], $ruta.$_FILES['imgd']['name'])){
                        $this->Post["imgd"]=$_FILES['imgd']['name'];  
                    }
                    if(move_uploaded_file($_FILES['imgt']['tmp_name'], $ruta.$_FILES['imgt']['name'])){
                        $this->Post["imgt"]=$_FILES['imgt']['name'];  
                    }
                    if(move_uploaded_file($_FILES['imgc']['tmp_name'], $ruta.$_FILES['imgc']['name'])){
                        $this->Post["imgc"]=$_FILES['imgc']['name'];  
                    }
                }
                $r = $this->Producto->modify($this->Post, ["id_producto"=>$id]);
            }
            if(isset($r["error"])) return ["error"=>_t("ERRGRAL")];
            else if(isset($r["warning"])) return $r;
            else return ["success"=>_t("DGUARDAR")];
        }
     }

    function api_eliminar($id){
        $resultado= $this->Producto->del(["id_producto"=>$id]);
           if(isset($resultado["error"])) return ["error"=>_t("ERRGRAL")];
           else if(isset($resultado["warning"])) return $resultado;
           else return ["success"=>_t("GRLDELETE")];
     }

    function api_ordena(){
        if($this->Post){
            $new = $this->Post["orden"];
            foreach ($new as $cv => &$value) {
                $cv = $cv+1;
                $result = $this->Producto->modify(array("orden"=>$cv),array("id_producto"=>$value));
            }
        }
    }
}
?>
