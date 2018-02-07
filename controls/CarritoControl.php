<?php
namespace Control;
use Control\Lean;
use Core\Config;

class CarritoControl extends Lean{
		function index(){}

        function gracias(){}

		function api_sesion(){
		    session_start();
		    if(isset($_SESSION['usuario'])){
		      $email=$_SESSION['usuario']['email'];
		    }else{
		      $email="no";
		    }
		    return $email;
 		}

    function api_verifica(){
       //session_start();
       //$email=$_SESSION['usuario']['email'];
       //$consulta=$this->Carrito->query('SELECT count(cant_prod) cantidad FROM carrito where email="'.$email.'"');
       $consulta=$this->Carrito->query('SELECT count(cant_prod) cantidad FROM carrito');
       $consulta=$consulta[0]["cantidad"];
       $entre=false;
       //$verifica=$this->Carrito->query('SELECT producto.cantidad as cantidad, producto.id_producto as id FROM producto join carrito on producto.id_producto=carrito.id_prod where email="'.$email.'"');
       $verifica=$this->Carrito->query('SELECT producto.cantidad as cantidad, producto.id_producto as id FROM producto join carrito on producto.id_producto=carrito.id_prod');
       for($i=0; $i < $consulta ; $i++) {
               if($verifica[$i]["cantidad"]==0){
                  $elimina=$this->Carrito->query('DELETE FROM carrito WHERE id_prod='.$verifica[$i]["id"]);
                  $entre=true;
               }
               
        }
      return $entre;
    }

    function api_verificad(){
      if($_POST){
        // Obtenemos los datos en formato variable1=valor1&variable2=valor2&...
        $raw_post_data = file_get_contents('php://input');

        // Los separamos en un array
        $raw_post_array = explode('&',$raw_post_data);

        // Separamos cada uno en un array de variable y valor
        $myPost = array();
        foreach($raw_post_array as $keyval){
            $keyval = explode("=",$keyval);
            if(count($keyval) == 2)
                $myPost[$keyval[0]] = urldecode($keyval[1]);
        }

        // Nuestro string debe comenzar con cmd=_notify-validate
        $req = 'cmd=_notify-validate';
        if(function_exists('get_magic_quotes_gpc')){
            $get_magic_quotes_exists = true;
        }
        foreach($myPost as $key => $value){
            // Cada valor se trata con urlencode para poder pasarlo por GET
            if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
                $value = urlencode(stripslashes($value));
            } else {
                $value = urlencode($value);
            }

            //Añadimos cada variable y cada valor
            $req .= "&$key=$value";
        }

        $ch = curl_init('https://www.sandbox.paypal.com/cgi-bin/webscr');   // Esta URL debe variar dependiendo si usamos SandBox o no. Si lo usamos, se queda así.
        //$ch = curl_init('https://www.paypal.com/cgi-bin/webscr');         // Si no usamos SandBox, debemos usar esta otra linea en su lugar.
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

        if( !($res = curl_exec($ch)) ) {
            // Ooops, error. Deberiamos guardarlo en algún log o base de datos para examinarlo después.
            curl_close($ch);
            exit;
        }
        curl_close($ch);

        if (strcmp ($res, "VERIFIED") == 0) {

                $payment_status = $_POST['payment_status'];
                if(($payment_status == 'Completed')){
                 $carrito=$this->Carrito->query('SELECT * FROM carrito WHERE email="'.$email.'"');
                 $cantidad=$this->Carrito->query('SELECT count(id_carrito) as cantidad FROM carrito WHERE email="'.$email.'"');
                 $cantidad=$cantidad[0]["cantidad"]; 
                 for($i=0; $i < $cantidad ; $i++) {
                     $b=$this->Carrito->query('select MAX(id_venta) AS id FROM venta');
                     $b=$b[$i]["id"]+1;
                     $orden=$b+1;

                     $c=$this->Carrito->query('select MAX(id_pay) AS id FROM pay');
                     $c=$c[$i]["id"]+1;
                     $ordend=$c+1;

                     $total=$carrito[$i]["cant_prod"]*$carrito[$i]["precio_prod"];
                     $restar=$this->Carrito->query('SELECT cantidad FROM producto where id_producto='.$carrito[$i]["id_prod"]);
                     $restar=$restar[$i]["cantidad"];
                     $restar=$restar-$carrito[$i]["cant_prod"];
                     $quitar=$this->Carrito->query('UPDATE producto SET cantidad='.$restar.' WHERE id_producto='.$carrito[$i]["id_prod"]);
                     $registro=$this->Carrito->query('INSERT INTO venta(id_venta,id_prod,email,nom_prod,mod_prod,img_prod,cant_prod,precio_prod,total,fecha,orden)VALUES('.$b.','.$carrito[$i]["id_prod"].',"'.$carrito[$i]["email"].'","'.$carrito[$i]["nom_prod"].'","'.$carrito[$i]["mod_prod"].'","'.$carrito[$i]["img_prod"].'",'.$carrito[$i]["cant_prod"].','.$carrito[$i]["precio_prod"].','.$total.',curdate(),'.$orden.')');
                     $registrod=$this->Carrito->query('INSERT INTO pay(id_pay,id_venta,estatus,orden)VALUES('.$c.','.$b.',1,'.$ordend.')');
                     $borrar=$this->Carrito->query('DELETE FROM carrito WHERE id_carrito='.$carrito[$i]["id_carrito"].' and email="'.$email.'"');
               }
               return ["success"=>"Limpiando Carrito"];
                }
            } else if (strcmp ($res, "INVALID") == 0) {
                return ["error"=>"no se a realizado compra"];
                // El estado que devuelve es INVALIDO, la información no ha sido enviada por PayPal. Deberías guardarla en un log para comprobarlo después
            }
        } else {    // Si no hay datos $_POST
             return ["success"=>"no hay datos"];
        }
    }

    function api_verificartres(){
        session_start();
        $email=$_SESSION['usuario']['email'];
        $raw_post_data = file_get_contents('php://input');
        $raw_post_array = explode('&', $raw_post_data);
        $myPost = array();
        foreach ($raw_post_array as $keyval) {
          $keyval = explode ('=', $keyval);
          if (count($keyval) == 2)
             $myPost[$keyval[0]] = urldecode($keyval[1]);
        }
         
        // leer el mensaje enviado IPN de PayPal y el prefijo 'cmd=_notify-validate'
        $req = 'cmd=_notify-validate';
        if(function_exists('get_magic_quotes_gpc')) {
           $get_magic_quotes_exists = true;
        } 
        foreach ($myPost as $key => $value) {        
           if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
                $value = urlencode(stripslashes($value)); 
           } else {
                $value = urlencode($value);
           }
           $req .= "&$key=$value";
        }
         
         
        /*Paso 2: Enviar datos POST IPN formateados a PayPal para validar
        |para entornos en produccion https://www.paypal.com/cgi-bin/webscr
        */
        $ch = curl_init('https://www.sandbox.paypal.com/cgi-bin/webscr');
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
         
        /* En entornos wamp o similares que no vienen incluidas con certificados de autorizacion
        |por favor descargue 'cacert.pem' de "http://curl.haxx.se/docs/caextract.html" y ajuste
        |La ruta del directorio del certificado como se muestra a continuacion:
        |curl_setopt($ch, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
        */
         
        if( !($res = curl_exec($ch)) ) {
            //error_log("Got " . curl_error($ch) . " when processing IPN data");
            curl_close($ch);
            exit;
        }
        curl_close($ch);
         
        // PASO 3: Inspeccionar el resultado de la validacion IPN y actuar en consecuencia
         
        if (strcmp ($res, "VERIFIED") == 0) {
         
             /* Se verifica El IPN
             |Comprobar si el payment_status es Completado
             |Comprobar que txn_id no ha sido procesado previamente
             |Comprobar que receiver_email es su correo electronico de PayPal principal
             |Comprobar que payment_amount / payment_currency son correctas
             |Procesar el pedido, todo esta bien
             |de momento podemos guardar los datos via post en un archivo
             |por si queremos verlos
             */
            
            $fp = fopen("ipnPaypal.txt","wb");
         if( $fp == false ){
         
         }else{
             fwrite($fp, var_export($_POST, true));
             fclose($fp);
         }
         
            // assign posted variables to local variables
            $item_name = $_POST['item_name'];
            $item_number = $_POST['item_number'];
            $payment_status = $_POST['payment_status'];
            $payment_amount = $_POST['mc_gross'];
            $payment_currency = $_POST['mc_currency'];
            $txn_id = $_POST['txn_id'];
            $receiver_email = $_POST['receiver_email'];
            $payer_email = $_POST['payer_email'];
         
            /* si el pago ha sido completado correctamente y el email que ha recibido el 
            |pago ha sido el que nosotros hemos puesto
            |Esto es ficticio pero es una validacion correcta para procesar pagos con IPN
            */
         
            if(($payment_status == 'Completed')){
             $carrito=$this->Carrito->query('SELECT * FROM carrito WHERE email="'.$email.'"');
             $cantidad=$this->Carrito->query('SELECT count(id_carrito) as cantidad FROM carrito WHERE email="'.$email.'"');

             $cantidad=$cantidad[0]["cantidad"]; 
             for($i=0; $i < $cantidad ; $i++) {
                 $b=$this->Carrito->query('select MAX(id_venta) AS id FROM venta');
                 $b=$b[$i]["id"]+1;
                 $orden=$b+1;
                 $total=$carrito[$i]["cant_prod"]*$carrito[$i]["precio_prod"];
                 $restar=$this->Carrito->query('SELECT cantidad FROM producto where id_producto='.$carrito[$i]["id_prod"]);
                 $restar=$restar[$i]["cantidad"];
                 $restar=$restar-$carrito[$i]["cant_prod"];
                 $quitar=$this->Carrito->query('UPDATE producto SET cantidad='.$restar.' WHERE id_producto='.$carrito[$i]["id_prod"]);
                 $registro=$this->Carrito->query('INSERT INTO venta(id_venta,id_prod,email,nom_prod,mod_prod,img_prod,cant_prod,precio_prod,total,fecha,orden)VALUES('.$b.','.$carrito[$i]["id_prod"].',"'.$carrito[$i]["email"].'","'.$carrito[$i]["nom_prod"].'","'.$carrito[$i]["mod_prod"].'","'.$carrito[$i]["img_prod"].'",'.$carrito[$i]["cant_prod"].','.$carrito[$i]["precio_prod"].','.$total.',curdate(),'.$orden.')');
                 $borrar=$this->Carrito->query('DELETE FROM carrito WHERE id_carrito='.$carrito[$i]["id_carrito"].' and email="'.$email.'"');
           }
           return ["success"=>"Limpiando Carrito"];
            }
        } else if (strcmp ($res, "INVALID") == 0) {
            // IPN invalid, log for manual investigation
            return "The response from IPN was: <b>" .$res ."</b>";
        }
    }

        function api_venta(){
           session_start();
           $email=$_SESSION['usuario']['email'];
           $carrito=$this->Carrito->query('SELECT * FROM carrito WHERE email="'.$email.'"');
           $cantidad=$this->Carrito->query('SELECT count(id_carrito) as cantidad FROM carrito WHERE email="'.$email.'"');

           $cantidad=$cantidad[0]["cantidad"]; 
           for($i=0; $i < $cantidad ; $i++) {
               $b=$this->Carrito->query('select MAX(id_venta) AS id FROM venta');
               $b=$b[$i]["id"]+1;
               $orden=$b+1;
               $total=$carrito[$i]["cant_prod"]*$carrito[$i]["precio_prod"];
               $restar=$this->Carrito->query('SELECT cantidad FROM producto where id_producto='.$carrito[$i]["id_prod"]);
               $restar=$restar[$i]["cantidad"];
               $restar=$restar-$carrito[$i]["cant_prod"];
               $quitar=$this->Carrito->query('UPDATE producto SET cantidad='.$restar.' WHERE id_producto='.$carrito[$i]["id_prod"]);
               $registro=$this->Carrito->query('INSERT INTO venta(id_venta,id_prod,email,nom_prod,mod_prod,img_prod,cant_prod,precio_prod,total,fecha,orden)VALUES('.$b.','.$carrito[$i]["id_prod"].',"'.$carrito[$i]["email"].'","'.$carrito[$i]["nom_prod"].'","'.$carrito[$i]["mod_prod"].'","'.$carrito[$i]["img_prod"].'",'.$carrito[$i]["cant_prod"].','.$carrito[$i]["precio_prod"].','.$total.',curdate(),'.$orden.')');
               $borrar=$this->Carrito->query('DELETE FROM carrito WHERE id_carrito='.$carrito[$i]["id_carrito"].' and email="'.$email.'"');
           }
           return ["success"=>"Limpiando Carrito"];
        }

 		function api_agregar(){
            session_start();
            $email=$_SESSION['usuario']['email'];
            $totalP=$this->Carrito->query('SELECT producto.cantidad as cantidad from producto join carrito on producto.id_producto=carrito.id_prod WHERE carrito.email="'.$email.'"');
            $totalP=$totalP[0]["cantidad"];
            $cantidad=$this->Carrito->query('SELECT cant_prod FROM carrito WHERE id_carrito='.$this->Post['id_carrito']);
            $cantidad=$cantidad[0]["cant_prod"]+1;
            if($cantidad<=$totalP){
                $resultado=$this->Carrito->query('UPDATE carrito SET cant_prod='.$cantidad.' WHERE id_carrito='.$this->Post['id_carrito']);
                return ["success"=>"Agregando Item"];
            }else{
                return ["error"=>"No hay más items en existencia"];
            }
		}

        function api_quitar(){
            $cantidad=$this->Carrito->query('SELECT cant_prod FROM carrito WHERE id_carrito='.$this->Post['id_carrito']);
            $cantidad=$cantidad[0]["cant_prod"]-1;
            if($cantidad==0){
               $cantidad=1;
               $resultado=$this->Carrito->query('UPDATE carrito SET cant_prod='.$cantidad.' WHERE id_carrito='.$this->Post['id_carrito']); 
               return ["error"=>"Si no desea el producto, Elimine del Carrito."];
            }else{
               $resultado=$this->Carrito->query('UPDATE carrito SET cant_prod='.$cantidad.' WHERE id_carrito='.$this->Post['id_carrito']); 
               return ["success"=>"Quitando item del Carrito"];
            }
            
        }

 		function api_numproductos(){
            session_start();
            if(isset($_SESSION['usuario'])){
    			$email=$_SESSION['usuario']['email'];
                if($email=="no"){
                 $r=0;
                }else{
                  $r=$this->Carrito->query('SELECT SUM(cant_prod) as suma From carrito where email="'.$email.'"');  
                }
            }else{
                $r=0;
            }
			return $r;
		}

        function api_getdata(){
            session_start();
            $email=$_SESSION['usuario']['email'];
            return $this->Carrito->query('SELECT * FROM carrito WHERE email="'.$email.'"');
        }

		function api_cantidad(){
 			session_start();
			$email=$_SESSION['usuario']['email'];
			return $this->Carrito->query('SELECT producto.cantidad as cantidad from producto join carrito on producto.id_producto=carrito.id_prod WHERE carrito.email="'.$email.'"');
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
	            return $this->Carrito->onlyByEmail($id);
	        }
    	}

    	function api_eliminar(){
           session_start();
           $email=$_SESSION['usuario']['email'];
    	     $id=$this->Post['id_carrito'];
           $resultado= $this->Carrito->query('DELETE FROM carrito WHERE id_carrito='.$id.' and email="'.$email.'"');
           if(isset($resultado["error"])) return ["error"=>_t("ERRGRAL")];
           else if(isset($resultado["warning"])) return $resultado;
           else return ["success"=>_t("GRLDELETE")];
     	}

		function api_guardar($id = false){
            session_start();
            $email=$_SESSION['usuario']['email'];
            $verificar=$this->Carrito->query('SELECT id_carrito FROM carrito WHERE id_prod='.$this->Post['id_prod'].' and email="'.$email.'"');
            $verificar=$verificar[0]["id_carrito"];
            if($verificar==""){
                $b=$this->Carrito->query('select MAX(id_carrito) AS id FROM carrito');
                $b=$b[0]["id"]+1;
                $this->Post["email"]=$email;
                $this->Post["orden"]=$b+1;
                $r = $this->Carrito->save($this->Post);
            }else{
                $b=$this->Carrito->query('SELECT cant_prod FROM carrito WHERE id_carrito='.$verificar.' and email="'.$email.'"');
                $cantidad=$b[0]["cant_prod"]+1;
                $r=$this->Carrito->query('UPDATE carrito SET cant_prod='.$cantidad.' WHERE id_carrito='.$verificar.' and email="'.$email.'"');
            }
            if(isset($r["error"])) return ["error"=>_t("ERRGRAL")];
            else if(isset($r["warning"])) return $r;
            else return ["success"=>"Agregando item al Carrito"];
        }
     
}
?>
