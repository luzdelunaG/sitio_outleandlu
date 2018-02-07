App.token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJodHRwOlwvXC9lbm93bG9jYWwuY29tXC8iLCJhdWQiOiJodHRwOlwvXC9lbm93bG9jYWwuY29tXC8iLCJpYXQiOjE0NjQyNjk4NDQsImV4cCI6MTc3NTMwOTg0NCwic3ViIjoidXN1YXJpbyIsImFkbWluIjpmYWxzZX0.Ynx4eXqAWwHGFO1cKLLwScI3VM5Fs2e_OODtzkvGjN_LUzYgTaR-sUSFopGWAMzmOJ0jLn_NtnxU80Q6qwnFRA";

$(document).ready(function(){
	$("#metatitle").html('Lean Outlet™ - Soluciones especializadas en Manufactura Esbelta y Cultura Lean');
	$("#metadescription").attr("content","Somos una empresa especializada en proveer soluciones para la manufactura esbelta, tales como: mobiliario ergonómico, controles visuales y entrenamientos en lean manufacturing tales como Lego Serious Play.");
	$("#metakeywords").attr("content","Mobilario ergonómico; Controles visuales; Entrenamiento y Capacitación; Manufactura Esbelta; Lean Manufacturing; Lean Training; Lean Culture; Cultura Lean; Lego Serious Play, VSM, Kaizen, Maquiladora, Manufacturera");

	App.connect("api/carrito/sesion/",false,function(response3){
    if(response3=="no"){
      $("#inises").html('<a id="iniciosesion" href="inicio_sesion" class="txtt"><i class="fa fa-user" aria-hidden="true"></i> Iniciar sesión</a>');
      $("#iniciosesion").html('<i class="fa fa-user" aria-hidden="true"></i> Iniciar Sesión');
      $("#iniciosesion").removeClass("cerrarsesion");
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

	App.connect("api/carrito/venta/",false,function(response){
     	console.log(response);
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
});	