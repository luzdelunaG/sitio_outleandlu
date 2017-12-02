<?php
namespace Core;
use Core\Config;
use Lib\Jwt\JWT;
use \UnexpectedValueException;
use Control;

class Dispatcher{
    var $api = false;

	public function __construct(){
		$this->getUrl();
	}

	function procesar(){
        $c = "Control\\". Config::Reader("control");

		if(class_exists($c, true)){
            if($this->api) $this->vapi();

			$funcion = Config::Reader("function");
			$control = new $c();
            $HtmlResponse = $control->Run($funcion,explode("/", Config::Reader("parametros")));

            if($this->api){
                header('Content-type: application/json');
                echo json_encode($HtmlResponse);
            }else if(is_array($HtmlResponse) && isset($HtmlResponse["error"])) print $HtmlResponse["error"];
            else print $HtmlResponse;
		}else{
            header('HTTP/1.0 406 Not Acceptable');
			echo json_encode(["error"=>"Recurso no disponible"]);
		}
	}

    private function vapi(){
        try {
            $LOGAPI = Config::Reader("LOGAPI");

            if(ucwords($LOGAPI["control"])."Control" != Config::Reader("control") && "api_".strtolower($LOGAPI["funcion"]) != Config::Reader("function")){

                $secretKey = base64_decode(Config::Reader("SALT"));
                $header = apache_request_headers();
                $Bearer = "";

                if(isset($header["Authorization"])) $Bearer = $header["Authorization"];
                else $Bearer = $_SERVER["REDIRECT_HTTP_AUTHORIZATION"];

                $Bearer =  trim(str_replace("Bearer","",$Bearer));
                $jwt = JWT::decode($Bearer, $secretKey,array('HS512'));
                Config::Write("UserToken", $jwt);
            }
        } catch (UnexpectedValueException $e) {
            die("Acceso restringido: ".$e->getMessage());
        }
    }

	private function getUrl(){
		$url = isset($_GET["url"])?$_GET["url"]:"";
		unset($_GET["url"]);

		$defineUrl="";
		Config::Write("bdrAdmin",false);

		$ui=explode("/",$url,2);
        if($ui[0] == "api"){
            $this->api = true;
    		$nurl=SITE."api";
    		$defineUrl=$nurl."/";
    		$url=isset($ui[1])?$ui[1]:"";

    		Config::Write("bdrAdmin","api");
        }else if(Config::Verify("Page")){
			foreach(Config::Reader("Page") as $cve =>$valor){
				if($ui[0]==strtolower($cve) || stristr(SERVIDOR, $cve)){
					Config::Write("FPLANTILLA",$valor);

					if($ui[0]==strtolower($cve)){
						$nurl=SITE.strtolower($cve);
						$defineUrl=$nurl."/";
						$url=isset($ui[1])?$ui[1]:"";
					}
					Config::Write("bdrAdmin",strtolower($cve));
					break;
				}
			}
		}

		if(Config::Reader("LANG")){
			Config::Write("IDIOMA",Config::Reader("LANGDEFAULT"));

			$uidioma=explode("/",$url,2);
			foreach(Config::Reader("LANGUAGES") as $cve =>$valor){
				if($uidioma[0]==strtolower($cve)){
					Config::Write("IDIOMA",$cve);
					if($defineUrl=="") $nurl=SITE.strtolower($cve);
					else $nurl=strtolower($cve);
					$defineUrl.=$nurl."/";
					$url=isset($uidioma[1])?$uidioma[1]:"";
					break;
				}
			}
		}

		if(Config::Verify("Admin")){
			$ui=explode("/",$url,2);
			if(strtolower($ui[0])==strtolower(Config::Reader("Admin"))){
				$url=isset($ui[1])?$ui[1]:"";
				$defineUrl.=$ui[0]."/";
				Config::Write("FPLANTILLA","admin");
				Config::Write("bdrAdmin","admin");
			}
		}

		define("URL",SITE);

		Config::Write("GetUrl",$url);

		if($url=="") $url="/";
		$url=trim(urldecode($url));
		$u=explode("/",$url,2);

		if(count(Config::Reader("Ruta"))){
			foreach(Config::Reader("Ruta") as $cve => $valor){
				$express=false;
				$c=explode("/",$cve,2);
				if(isset($c[1]) && $c[1]=="*"){
					$cve=$c[0]."/(.+)";
					$express=true;
				}

				if($express){
					if(preg_match("#".$cve."#is",$url)){
						$url=implode("/",$valor) ."/". $u[1];
						break;
					}
				}else if(isset($u[1]) && $u[1]!=""){
					$u2=explode("/",$u[1],2);
					if(strtolower($cve)==trim(strtolower($u[0]."/".$u2[0]),"/\\")){
						$url=implode("/",$valor) ."/". (isset($u2[1])?$u2[1]:"");
						break;
					}
				}else if($cve==$url){
					$url=implode("/",$valor);
					break;
				}
			}
		}

		$url=explode("/",trim($url,"/"),3);
		if(count($url)>0){
			$url[0] = str_replace(" ","",ucwords($url[0]));
			Config::Write("control",($url[0]!=""?$url[0]:"Index")."Control");

			if(Config::Reader("bdrAdmin"))
				Config::Write("function",Config::Reader("bdrAdmin")."_".(isset($url[1])?$url[1]:"index"));
			else
				Config::Write("function",isset($url[1])?str_replace(" ","",$url[1]):"index");

			Config::Write("parametros",isset($url[2])?$url[2]:"");
		}
	}
}
?>
