App.token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJodHRwOlwvXC9lbm93bG9jYWwuY29tXC8iLCJhdWQiOiJodHRwOlwvXC9lbm93bG9jYWwuY29tXC8iLCJpYXQiOjE0NjQyNjk4NDQsImV4cCI6MTc3NTMwOTg0NCwic3ViIjoidXN1YXJpbyIsImFkbWluIjpmYWxzZX0.Ynx4eXqAWwHGFO1cKLLwScI3VM5Fs2e_OODtzkvGjN_LUzYgTaR-sUSFopGWAMzmOJ0jLn_NtnxU80Q6qwnFRA";

$(document).ready(function(){
  $("#metatitle").html('Lean Outlet™');
  $("#metadescription").attr("content",'Información de interés sobre la cultura de manufactura esbelta.');
  $("#metakeywords").attr("content",'Manufactura esbelta; lean manufacturing; noticias; novedades');
  var ruta = window.location["href"].split("/");
  ruta=ruta[ruta.length-1];
  App.connect("api/articulo/getinfo/"+ruta,false,function(response8){
  console.log(response8);
    $(".titarti").html(response8.titulo);
    $(".subtitarti").html(response8.id_tags);
    $(".fecharti").html(response8.fecha);
    $(".txtarti").html(response8.contenido);
    $(".anchovideoarti").attr("src",response8.urlv);
    $(".txtartid").html(response8.contenidod);
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

