<?php
namespace Control;
use Control\Lean;
use Core\Config;

class IndexControl extends Lean{


 function api_sesion(){
    session_start();
    if(isset($_SESSION['usuario'])){
      $email=$_SESSION['usuario']['email'];
    }else{
      $email="no";
    }
    return $email;
 }

  

	function index(){
		$this->Send("title",_t("admiNet"));
    //echo("holi!!!!!!");
    //echo($this);
    //$secciones = $this->Secciones->find("*", false, false);
    //echo($secciones);
    //$this->Send("secciones", $secciones);

	}
	function politicas(){

		$this->Send("title",_t("admiNet",strtoupper(Config::Reader("Cliente"))));
	}
	function admin_index(){
      	$this->send("title","admiNet");

	}



	function gracias(){
      	$this->send("title","admiNet");

	}

      function admin_media(){
        $ruta = ROOT.DS."fileimages".DS."index".DS;
        $imgs = array();
        $handle = opendir($ruta);


        while($filename = readdir($handle)){
          if($filename != "." && $filename != "..")
            $imgs[] = URL."fileimages/index/". $filename;
        }
        closedir($handle);

        $this->Send("Imgs", $imgs);
        $this->Ajax();
    }

        function admin_upload(){
      $ruta = ROOT."fileimages".DS."index".DS;

      if(move_uploaded_file($_FILES["tinyImage"]["tmp_name"], $ruta.$_FILES["tinyImage"]["name"])){
        $this->Redirect("/admin/index/media");
      }else echo "Ha ocurrido un error vuelve a intentar";

      $this->Ajax();
    }


}
?>
