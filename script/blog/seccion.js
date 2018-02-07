var ruta = window.location["href"].split("/");
ruta= ruta[ruta.length-1];

App.connect("api/publicaciones/datosseccion/"+ruta,false,function(response4){
    $.each(response4[1],function(index,value4){
        var divA = $('<div class="col-md-3 publicacion"><div class="col-md-12 img"><a href="blog/articulo/'+value4.url+'"><img src="fileimages/publicaciones/'+value4.img+'"></a></div><div class="col-md-12 titulo"><a href="blog/articulo/'+value4.url+'">'+value4.titulo+'</a></div><div class="col-md-12 texto txt2">'+value4.previo+'</div></div>');
        $('.a-publicaciones .publicaciones').append(divA);
      })
        var divPaginador=$("<div class='col-md-12 area-paginador' style='text-align:center; margin-top:20px;margin-bottom: 27px;'></div>")
      var divPags = $("<div class='pags' style='z-index: 9992;''></div>")

    //Para el paginador//
    var ya="false";
    for (var x = 1; x <= response4[0]; x++){
      var activo="";
      if (ya=="false"){
        activo="activo";
        ya="true";
      }
      var pag2 = "pag"+activo;
      var pag = $("<a href='blog/seccion/"+x+"' class='"+pag2+"'>"+x+"</a>");
      divPags.append(pag);
    }
    setTimeout(function(){
     divPaginador.append(divPags);
     $(".a-publicaciones").append(divPaginador);
   },800);



});
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.8&appId=748605588633483";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

/*App.connect("app/publicaciones/getdatall",false,function(response4){
    $.each(response4,function(index,value4){
        var divA = $('<div class="col-md-6 publicacion"><div class="col-md-12 img"><a href="blog/articulo/'+value4.url+'"><img src="fileimages/publicaciones/'+value4.img+'"></a></div><div class="col-md-12 titulo"><a href="blog/articulo/'+value4.url+'">'+value4.titulo+'</a></div><div class="col-md-12 texto txt2">'+value4.previo+'</div></div>');
        $('.a-publicaciones .noticias').append(divA);
    })
});
*/
