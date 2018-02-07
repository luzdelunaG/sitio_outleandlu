App.token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJodHRwOlwvXC9lbm93bG9jYWwuY29tXC8iLCJhdWQiOiJodHRwOlwvXC9lbm93bG9jYWwuY29tXC8iLCJpYXQiOjE0NjQyNjk4NDQsImV4cCI6MTc3NTMwOTg0NCwic3ViIjoidXN1YXJpbyIsImFkbWluIjpmYWxzZX0.Ynx4eXqAWwHGFO1cKLLwScI3VM5Fs2e_OODtzkvGjN_LUzYgTaR-sUSFopGWAMzmOJ0jLn_NtnxU80Q6qwnFRA";

$(document).ready(function(){
  $("#metatitle").html('Lean Outlet™');
  $("#metadescription").attr("content",'Información de interés sobre la cultura de manufactura esbelta.');
  $("#metakeywords").attr("content",'Manufactura esbelta; lean manufacturing; noticias; novedades');
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
  
  var ruta = window.location["href"].split("/");
  ruta=ruta[ruta.length-1];
  App.connect("api/articulo/getinfo/"+ruta,false,function(response8){
  console.log(response8);
    $(".titarti").html(response8.titulo);
    $(".subtitarti").html(response8.id_tags);
    $(".fecharti").html(response8.fecha);
    $(".txtarti").html(response8.contenido);  
    if(response8.urlv==""){
      $(".anchovideoarti").css("height","0px");
    }else{
      $(".anchovideoarti").attr("src",response8.urlv);
    }
    $(".txtartid").html(response8.contenidod);
  });

   App.connect("api/videos/getdata/",false,function(response1){
    $.each(response1, function(index,value){
      $('#uavideos').append('<div class="col-md-10 txttre txttred2">'+value.titulo+'</div><div class="col-md-12 text-center"><iframe class="anchovideoblogart" src="'+value.url+'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>');
    });
   });

   App.connect("api/articulo/getultimos/",false,function(response2){
    $.each(response2, function(index,value){
      $('#uaarticulos').append(' <div class="col-md-12 margincat1"><div class="col-md-7 padding"><p><a class="txtdie" href="blog/articulo/'+value.url+'">'+value.titulo+'</a></p><p class="txtdies">'+value.id_tags+'</p><p class="txtdiesio">'+value.fecha+'</p></div><div class="col-md-5 padding"><img alt="Artículo de Lean Outlet™" src="fileimages/articulo/'+value.img+'" class="artwidth"></div></div>');
    });
   });
   
});





(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.11';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


(function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();

