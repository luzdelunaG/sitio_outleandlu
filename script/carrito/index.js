App.token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJodHRwOlwvXC9lbm93bG9jYWwuY29tXC8iLCJhdWQiOiJodHRwOlwvXC9lbm93bG9jYWwuY29tXC8iLCJpYXQiOjE0NjQyNjk4NDQsImV4cCI6MTc3NTMwOTg0NCwic3ViIjoidXN1YXJpbyIsImFkbWluIjpmYWxzZX0.Ynx4eXqAWwHGFO1cKLLwScI3VM5Fs2e_OODtzkvGjN_LUzYgTaR-sUSFopGWAMzmOJ0jLn_NtnxU80Q6qwnFRA";

$(document).ready(function(){
	var id="";
	$("#metatitle").html('Lean Outlet™ - Soluciones especializadas en Manufactura Esbelta y Cultura Lean');
	$("#metadescription").attr("content","Somos una empresa especializada en proveer soluciones para la manufactura esbelta, tales como: mobiliario ergonómico, controles visuales y entrenamientos en lean manufacturing tales como Lego Serious Play.");
	$("#metakeywords").attr("content","Mobilario ergonómico; Controles visuales; Entrenamiento y Capacitación; Manufactura Esbelta; Lean Manufacturing; Lean Training; Lean Culture; Cultura Lean; Lego Serious Play, VSM, Kaizen, Maquiladora, Manufacturera");

	App.connect("api/carrito/sesion/",false,function(response3){
    if(response3=="no"){
      $("#inises").html('<a id="iniciosesion" href="inicio_sesion" class="txtt"><i class="fa fa-user" aria-hidden="true"></i> Iniciar sesión</a>');
      $("#iniciosesion").html('<i class="fa fa-user" aria-hidden="true"></i> Iniciar Sesión');
      $("#iniciosesion").removeClass("cerrarsesion");
      $("#btnpago").css("display","none");
    }else{
      $("#inises").html('<form id="frmIniciose" action="http://www.bonzercreative.com/sitio_outlean/api/inicio/cerrarsesion/" method="post"><button id="iniciosesion" type="submit" class="btncerrarsesion txtt"><i class="fa fa-user" aria-hidden="true"></i> Cerrar Sesión</button></form>');
       var $form = $("#frmIniciose"); 
          $form.jform({
           after:function(response){
              window.location="inicio_sesion";
           }
        });
      $("#iniciosesion").html('<i class="fa fa-user" aria-hidden="true"></i> Cerrar Sesión');
      $("#iniciosesion").addClass("cerrarsesion");
    }
    id=response3;
  	});
  
  App.connect("api/carrito/numproductos/",false,function(response2){
    if(response2!=0){
      var verifica=response2[0].suma;
      if(verifica==null){
        $("#cantidad").html('0 <i class="fa fa-shopping-basket" aria-hidden="true"></i>');
      }else{
       $("#cantidad").html(response2[0].suma+' <i class="fa fa-shopping-basket" aria-hidden="true"></i>'); 
      }
    }else{
      $("#cantidad").html(response2+' <i class="fa fa-shopping-basket" aria-hidden="true"></i>');
    }
  });

  App.connect("api/carrito/verificad/",false,function(response5){
   console.log(response5);
  });

  App.connect("api/carrito/verifica/",false,function(response5){
   if(response5==false){
   	console.log(response5);
   }else{
   	console.log(response5);
   	window.location.reload();
   }
  });
	
  	App.connect("api/carrito/getdata/",false,function(response4){
  		if(response4!=""){
	  		var cont=1;
	  		var precio=0;
	  		var cantidad=0;
	  		var total=0;
	  		var totalPago=0;
	  		var tot=0;
	  		$.each(response4, function(index,value){
	  		  precio=value.precio_prod;
	  		  cantidad=value.cant_prod;
	  		  total=precio*cantidad;
	  		  totalPago=totalPago+total;
	  		  //total=total.toFixed(2);
		      $('#carritousuario').append('<div class="col-md-12"><hr style="background:#000;"><div class="col-md-6 text-center">Producto en el Carrito</div><div class="col-md-6 text-center">Precio - Cantidad</div><div class="col-md-6 col-xs-12 margproducto"><div class="col-md-5 col-xs-12"><a href="producto"><img alt="Producto de Materiales para Entrenamiento Lean" class="muochod" src="'+value.img_prod+'"></a></div><div class="col-md-6 col-xs-12 padding mgrtxtproduc"><p><a href="producto" class="titprod">'+value.nom_prod+'</a></p><p class="modelprod">'+value.mod_prod+'</p></div></div> <div class="col-md-6 margtopcar"><div class="col-md-12 col-xs-12 padding text-center txtprecioest">$'+total+'</div><div class="form-group col-xs-12 col-xs-offset-0 col-md-12 col-md-offset-0"><div class="col-xs-12 col-md-12 text-center">Cantidad:</div><div class="col-md-12 col-xs-12 text-center">'+value.cant_prod+'</div><div class="col-md-12 col-xs-12 text-center"><div class="col-md-6 col-xs-6 itema text-right"><form id="frmAgregar'+cont+'" action="http://www.bonzercreative.com/sitio_outlean/api/carrito/agregar/" method="post"><input type="hidden" id="id_carrito" name="id_carrito" value="'+value.id_carrito+'"><button type="submit" class="btn btn--ys btn--xldd"><i class="fa fa-shopping-basket" aria-hidden="true"></i> +1</button></form></div><div class="col-md-6 col-xs-6 itemb text-left"><form id="frmQuitar'+cont+'" action="http://www.bonzercreative.com/sitio_outlean/api/carrito/quitar/" method="post"><input type="hidden" id="id_carrito" name="id_carrito" value="'+value.id_carrito+'"><button type="submit" class="btn btn--ys btn--xldd"><i class="fa fa-shopping-basket" aria-hidden="true"></i> -1</button></form></div></div><div class="col-md-12 col-xs-12 text-center" style="margin-top:2rem;"><form id="frmCarritoe'+value.id_carrito+'" action="http://www.bonzercreative.com/sitio_outlean/api/carrito/eliminar/" method="post" ><input type="hidden" name="id_carrito" id="id_carrito" value="'+value.id_carrito+'"><button type="submit" class="btn btn--ys btn--xl"> Eliminar del Carrito </button></form></div></div>');
		    	var $form = $("#frmCarritoe"+value.id_carrito); 
				  $form.jform({
				    after:function(response){
				      window.location="carrito";
				    }
				});
				initinymce();
				var $formd = $("#frmAgregar"+cont); 
				  $formd.jform({
				    after:function(response){
				     App.Alert(response, "carrito");
				    }
				});
				initinymce();
				 var $formt = $("#frmQuitar"+cont); 
				  $formt.jform({
				    after:function(response){
				      App.Alert(response, "carrito");
				    }
				});
				initinymce();
				$("#frmPaypal").append('<input type="hidden" name="item_name_'+cont+'" value="'+value.nom_prod+'"><input type="hidden" name="amount_'+cont+'" value="'+value.precio_prod+'"><input type="hidden" name="quantity_'+cont+'" value="'+value.cant_prod+'">');
				cont=cont+1;	
		    });
			$('#totalpago').html('Total: $'+totalPago.toFixed(2));
			tot=totalPago*10/100;
			$('#envio').val(tot.toFixed(2));
		}else{
			$('#carritousuario').append('<div class="col-md-12 col-xs-12"><div class="col-md-12 col-xs-12 text-center" style="margin-top:7rem;margin-bottom:7rem;font-size:2.3rem;">No hay items en el Carrito</div></div>');
			$("#btnpago").css("display","none");
		}
  	});
});