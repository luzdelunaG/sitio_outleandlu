App.token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJodHRwOlwvXC9lbm93bG9jYWwuY29tXC8iLCJhdWQiOiJodHRwOlwvXC9lbm93bG9jYWwuY29tXC8iLCJpYXQiOjE0NjQyNjk4NDQsImV4cCI6MTc3NTMwOTg0NCwic3ViIjoidXN1YXJpbyIsImFkbWluIjpmYWxzZX0.Ynx4eXqAWwHGFO1cKLLwScI3VM5Fs2e_OODtzkvGjN_LUzYgTaR-sUSFopGWAMzmOJ0jLn_NtnxU80Q6qwnFRA";

$(document).ready(function(){
  $("#metatitle").html('Lean Outlet™ - Controles visuales, tableros de métricos y pizarrones personalizados');
  $("#metadescription").attr("content",'Nuestra oferta de controles visuales es integrada por tableros de métricos, pizarrones personalizados e identificadores de área que facilitan la lectura y comprensión de la información en la empresa.');
  $("#metakeywords").attr("content",'Lean Manufacturing; Manufactura Esbelta; Cultura Lean; Controles Visuales; Pizarroes; Tableros de Métricos; Identificadores de área; Manufactura; Maquiladora; Señalamientos');

  var bandera=false;

  App.connect("api/inicio/sesion/",false,function(response3){
    if(response3=="no"){
      $("#inises").html('<a id="iniciosesion" href="inicio_sesion" class="txtt"><i class="fa fa-user" aria-hidden="true"></i> Iniciar sesión</a>');
      $("#iniciosesion").html('<i class="fa fa-user" aria-hidden="true"></i> Iniciar Sesión');
      $("#iniciosesion").removeClass("cerrarsesion");
      bandera=false;
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
      bandera=true;
    }
    $("#email").val(''+response3+'');
  });

  App.connect("api/carrito/numproductos/",false,function(response2){
    if(response2!=0){
      $("#cantidad").html(response2[0].suma+' <i class="fa fa-shopping-basket" aria-hidden="true"></i>');
    }else{
      $("#cantidad").html(response2+' <i class="fa fa-shopping-basket" aria-hidden="true"></i>');
    }
  });

  App.connect("api/producto/cantproduccv/",false,function(response1){
    if(response1!=0){
      var verifica=response2[0].suma;
      if(verifica==null){
        $("#cantidad").html('0 <i class="fa fa-shopping-basket" aria-hidden="true"></i>');
      }else{
       $("#cantidad").html(response2[0].suma+' <i class="fa fa-shopping-basket" aria-hidden="true"></i>'); 
      }
    }else{
      $(".txtproduc").html(response1+' productos');
    }
  });

  App.connect("api/producto/prodcontv/",false,function(response){
    var precio=0;
    var preciod=0;
    var cont=1;
   $.each(response, function(index,value){
      if(bandera==false){
        if(value.cantidad!=0){
          preciod=value.precio;
          flag = value.descripcion.substring(0,60)+ "...";
          $('#contproductosv').append('<div class="col-md-4 col-xs-12 margproducto"><div class="col-md-6 col-xs-12 paddingres"><a href="visuales/producto/'+value.url+'"><img alt="Producto de Controles Visuales" class="muochod" src="fileimages/productos/'+value.img+'"></a></div><div class="col-md-5 col-xs-12 padding mgrtxtproduc"><p ><a href="visuales/producto/'+value.url+'" class="titprod">'+value.nombre+'</a></p><p class="modelprod">'+value.modelo+'</p><p class="margtxtdesc">'+flag+'</p></div><div class="col-md-12 col-xs-12 paddtagsha"><div class="col-md-10 col-xs-10 padding tagprodu"><i class="fa fa-tag" aria-hidden="true"></i>'+value.id_tags+'</div><div class="col-md-2 col-xs-2 padding text-right"><div class="sharethis-inline-share-buttons"></div></div></div><div class="col-md-12 col-xs-12 padding text-center txtprecioest">$'+preciod+'</div><div class="col-md-12 col-xs-12 padding margbtnadd"><a href="inicio_sesion"><button  data-toggle="modal" data-target="#myModal" type="" class="btnPComPro btncontt"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Agregar a compras</button></a></div></div>');
          cont=cont+1;
        }else{
          preciod=value.precio;
          flag = value.descripcion.substring(0,60)+ "...";
          $('#contproductosv').append('<div class="col-md-4 col-xs-12 margproducto"><div class="col-md-6 col-xs-12 paddingres"><a href="visuales/producto/'+value.url+'"><img alt="Producto de Controles Visuales" class="muochod" src="fileimages/productos/'+value.img+'"></a></div><div class="col-md-5 col-xs-12 padding mgrtxtproduc"><p ><a href="visuales/producto/'+value.url+'" class="titprod">'+value.nombre+'</a></p><p class="modelprod">'+value.modelo+'</p><p class="margtxtdesc">'+flag+'</p></div><div class="col-md-12 col-xs-12 paddtagsha"><div class="col-md-10 col-xs-10 padding tagprodu"><i class="fa fa-tag" aria-hidden="true"></i>'+value.id_tags+'</div><div class="col-md-2 col-xs-2 padding text-right"><div class="sharethis-inline-share-buttons"></div></div></div><div class="col-md-12 col-xs-12 padding text-center txtprecioest">$'+preciod+'</div><div class="col-md-12 col-xs-12 padding margbtnadd"><form id="frmProducto'+cont+'" action="http://www.bonzercreative.com/sitio_outlean/api/carrito/guardar/" method="post"><input name="id_prod" id="id_prod" type="hidden" value="'+value.id_producto+'"><input name="email" id="email" type="hidden"><input name="nom_prod" id="nom_prod" type="hidden" value="'+value.nombre+'"><input name="mod_prod" id="mod_prod" type="hidden" value="'+value.modelo+'"><input name="img_prod" id="img_prod" type="hidden" value="fileimages/productos/'+value.img+'"><input name="cant_prod" id="cant_prod" type="hidden" value="'+value.cantidad+'"><input name="precio_prod" id="precio_prod" type="hidden" value="'+value.precio+'"><div class="col-md-12 col-xs-12 text-center"><h2>Agotado</h2></div></div></div></div></div></form></div></div>');
        }
      }else{
        if(value.cantidad!=0){
          preciod=value.precio;
          flag = value.descripcion.substring(0,60)+ "...";
          $('#contproductosv').append('<div class="col-md-4 col-xs-12 margproducto"><div class="col-md-6 col-xs-12 paddingres"><a href="visuales/producto/'+value.url+'"><img alt="Producto de Controles Visuales" class="muochod" src="fileimages/productos/'+value.img+'"></a></div><div class="col-md-5 col-xs-12 padding mgrtxtproduc"><p ><a href="visuales/producto/'+value.url+'" class="titprod">'+value.nombre+'</a></p><p class="modelprod">'+value.modelo+'</p><p class="margtxtdesc">'+flag+'</p></div><div class="col-md-12 col-xs-12 paddtagsha"><div class="col-md-10 col-xs-10 padding tagprodu"><i class="fa fa-tag" aria-hidden="true"></i>'+value.id_tags+'</div><div class="col-md-2 col-xs-2 padding text-right"><div class="sharethis-inline-share-buttons"></div></div></div><div class="col-md-12 col-xs-12 padding text-center txtprecioest">$'+preciod+'</div><div class="col-md-12 col-xs-12 padding margbtnadd"><form id="frmProducto'+cont+'" action="http://www.bonzercreative.com/sitio_outlean/api/carrito/guardar/" method="post"><input name="id_prod" id="id_prod" type="hidden" value="'+value.id_producto+'"><input name="email" id="email" type="hidden"><input name="nom_prod" id="nom_prod" type="hidden" value="'+value.nombre+'"><input name="mod_prod" id="mod_prod" type="hidden" value="'+value.modelo+'"><input name="img_prod" id="img_prod" type="hidden" value="fileimages/productos/'+value.img+'"><input name="cant_prod" id="cant_prod" type="hidden" value="1"><input name="precio_prod" id="precio_prod" type="hidden" value="'+value.precio+'"><button  data-toggle="modal" data-target="#myModal" type="" class="btnPComPro btncontt"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Agregar a compras</button><div class="modal fade" id="myModal" role="dialog"><div class="modal-dialog"> <div class="modal-content"> <div class="modal-header"> <button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Lean Outlet</h4></div> <div class="modal-body"><p>Agregando al Carrito de Compras</p></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div></div></div></div></form></div></div>');
           var $form = $("#frmProducto"+cont); 
           $form.jform({
            after:function(response){
                //App.Alert(response,redireccion);
                window.location="controles_visuales";
              }
           });
          initinymce();
          cont=cont+1;
        }else{
          preciod=value.precio;
          flag = value.descripcion.substring(0,60)+ "...";
          $('#contproductosv').append('<div class="col-md-4 col-xs-12 margproducto"><div class="col-md-6 col-xs-12 paddingres"><a href="visuales/producto/'+value.url+'"><img alt="Producto de Controles Visuales" class="muochod" src="fileimages/productos/'+value.img+'"></a></div><div class="col-md-5 col-xs-12 padding mgrtxtproduc"><p ><a href="visuales/producto/'+value.url+'" class="titprod">'+value.nombre+'</a></p><p class="modelprod">'+value.modelo+'</p><p class="margtxtdesc">'+flag+'</p></div><div class="col-md-12 col-xs-12 paddtagsha"><div class="col-md-10 col-xs-10 padding tagprodu"><i class="fa fa-tag" aria-hidden="true"></i>'+value.id_tags+'</div><div class="col-md-2 col-xs-2 padding text-right"><div class="sharethis-inline-share-buttons"></div></div></div><div class="col-md-12 col-xs-12 padding text-center txtprecioest">$'+preciod+'</div><div class="col-md-12 col-xs-12 padding margbtnadd"><form id="frmProducto'+cont+'" action="http://www.bonzercreative.com/sitio_outlean/api/carrito/guardar/" method="post"><input name="id_prod" id="id_prod" type="hidden" value="'+value.id_producto+'"><input name="email" id="email" type="hidden"><input name="nom_prod" id="nom_prod" type="hidden" value="'+value.nombre+'"><input name="mod_prod" id="mod_prod" type="hidden" value="'+value.modelo+'"><input name="img_prod" id="img_prod" type="hidden" value="fileimages/productos/'+value.img+'"><input name="cant_prod" id="cant_prod" type="hidden" value="'+value.cantidad+'"><input name="precio_prod" id="precio_prod" type="hidden" value="'+value.precio+'"><div class="col-md-12 col-xs-12 text-center"><h2>Agotado</h2></div></div></div></div></div></form></div></div>');
        }
      }
    });
  });

});


(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.11';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

(function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();