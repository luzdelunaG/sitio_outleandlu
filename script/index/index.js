App.token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJodHRwOlwvXC9lbm93bG9jYWwuY29tXC8iLCJhdWQiOiJodHRwOlwvXC9lbm93bG9jYWwuY29tXC8iLCJpYXQiOjE0NjQyNjk4NDQsImV4cCI6MTc3NTMwOTg0NCwic3ViIjoidXN1YXJpbyIsImFkbWluIjpmYWxzZX0.Ynx4eXqAWwHGFO1cKLLwScI3VM5Fs2e_OODtzkvGjN_LUzYgTaR-sUSFopGWAMzmOJ0jLn_NtnxU80Q6qwnFRA";

$(document).ready(function(){
  $("#metatitle").html('Lean Outlet™ - Soluciones especializadas en Manufactura Esbelta y Cultura Lean');
  $("#metadescription").attr("content","Somos una empresa especializada en proveer soluciones para la manufactura esbelta, tales como: mobiliario ergonómico, controles visuales y entrenamientos en lean manufacturing tales como Lego Serious Play.");
  $("#metakeywords").attr("content","Mobilario ergonómico; Controles visuales; Entrenamiento y Capacitación; Manufactura Esbelta; Lean Manufacturing; Lean Training; Lean Culture; Cultura Lean; Lego Serious Play, VSM, Kaizen, Maquiladora, Manufacturera");

  App.connect("api/inicio/sesion/",false,function(response3){
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

   App.connect("api/testimonios/getdata/",false,function(response4){
     var band=false;
     $.each(response4, function(index,value){
      if(band==false){
        $('#testimonios').append('<div class="item active"><img class="profile-circle" alt="Caso de éxito" src="fileimages/testimonios/'+value.img+'"><blockquote>'+value.txt_testimonios+'</blockquote><p class="txtdiesnu">'+value.nom_testimonios+'</p><p class="txtveint">'+value.empre_testimonios+'</p></div>');
        band=true;
      }else{
        $('#testimonios').append('<div class="item"><img class="profile-circle" alt="Caso de éxito" src="fileimages/testimonios/'+value.img+'"><blockquote>'+value.txt_testimonios+'</blockquote><p class="txtdiesnu">'+value.nom_testimonios+'</p><p class="txtveint">'+value.empre_testimonios+'</p></div>');
      }
    });
   });

   App.connect("api/videos/getdata/",false,function(response1){
    $.each(response1, function(index,value){
      $('#uvideos').append('<div class="col-md-12 txttredd">'+value.titulo+'</div><div class="col-md-12 text-center"><iframe class="anchovideo" src="'+value.url+'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>');
    });
   });

   App.connect("api/articulo/getultimos/",false,function(response2){
    $.each(response2, function(index,value){
      $('#uarticulos').append('<div class="col-md-12 margincat margleftbloghome"><div class="col-md-8 padding"><p><a class="txtdie" href="blog/articulo/'+value.url+'">'+value.titulo+'</a></p><p class="txtdies">'+value.id_tags+'</p><p class="txtdiesio">'+value.fecha+'</p></div><div class="col-md-4 padding imgart1"><img alt="Artículo de Lean Outlet™" src="fileimages/articulo/'+value.img+'" class="artwidth"></div></div>');
    });
   });

   
});