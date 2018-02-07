App.token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJodHRwOlwvXC9lbm93bG9jYWwuY29tXC8iLCJhdWQiOiJodHRwOlwvXC9lbm93bG9jYWwuY29tXC8iLCJpYXQiOjE0NjQyNjk4NDQsImV4cCI6MTc3NTMwOTg0NCwic3ViIjoidXN1YXJpbyIsImFkbWluIjpmYWxzZX0.Ynx4eXqAWwHGFO1cKLLwScI3VM5Fs2e_OODtzkvGjN_LUzYgTaR-sUSFopGWAMzmOJ0jLn_NtnxU80Q6qwnFRA";

$(document).ready(function(){
  $("#metatitle").html('Lean Outlet™');
  $("#metadescription").attr("content",'Consulte nuestro catálogo de productos especializados en manufactura esbelta o pónganse en contacto con nosotros.');
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
  App.connect("api/producto/getinfourl/"+ruta,false,function(response){
    $('#id_prod').val(response[0].id_producto);
    $('.titproduc').html(response[0].nombre);
    $('#nom_prod').val(response[0].nombre);
    $('.titmodproduc').html(response[0].modelo);
    $('#mod_prod').val(response[0].modelo);
    $('#tags').html(response[0].id_tags);
    $('.txtproduct').html(response[0].descripcion);
    $('#fichatec').attr('href','fileimages/productos/'+response[0].file);
    $('.precioproduct').html('$'+response[0].precio);
    $('.aniosgaranti').html(response[0].garantia);
    $('.stockproduct').html(response[0].cantidad+" en stock");
    $('#principal').attr('src','fileimages/productos/'+response[0].img);
    $('#img_prod').val('fileimages/productos/'+response[0].img);
    $('#precio_prod').val(response[0].precio);
    $('#p1').attr('src','fileimages/productos/'+response[0].img);
    $('#p2').attr('src','fileimages/productos/'+response[0].imgd);
    $('#p3').attr('src','fileimages/productos/'+response[0].imgt);
    $('#p4').attr('src','fileimages/productos/'+response[0].imgc);
    $('#p11').attr('src','fileimages/productos/'+response[0].img);
    $('#p22').attr('src','fileimages/productos/'+response[0].imgd);
    $('#p33').attr('src','fileimages/productos/'+response[0].imgt);
    $('#p44').attr('src','fileimages/productos/'+response[0].imgc);
    $('#evf1').html(response[0].especifu);
    $('#evf2').html(response[0].especifd);
    $('#evf3').html(response[0].especift);
    $('#evf4').html(response[0].especifc);
    $('#evf5').html(response[0].especifcin);
  });
  $("#valor").click(function() {
        $("#valor").css("background-color","#ABB2B9");
        $("#espe").css("background-color","#D2D4D3");
        $("#faqs").css("background-color","#D2D4D3");
        App.connect("api/producto/getinfourl/"+ruta,false,function(response1){
        $('#evf1').html(response1[0].valoru);
        $('#evf2').html(response1[0].valord);
        $('#evf3').html(response1[0].valort);
        $('#evf4').html(response1[0].valorc);
        $('#evf5').html(response1[0].valorcin);
        });
  });
       
  $("#espe").click(function() {
        $("#valor").css("background-color","#D2D4D3");
        $("#espe").css("background-color","#ABB2B9");
        $("#faqs").css("background-color","#D2D4D3");
        App.connect("api/producto/getinfourl/"+ruta,false,function(response2){
        $('#evf1').html(response2[0].especifu);
        $('#evf2').html(response2[0].especifd);
        $('#evf3').html(response2[0].especift);
        $('#evf4').html(response2[0].especifc);
        $('#evf5').html(response2[0].especifcin);
        });
    });
  $( "#faqs" ).click(function() {
        $("#valor").css("background-color","#D2D4D3");
        $("#faqs").css("background-color","#ABB2B9");
        $("#espe").css("background-color","#D2D4D3");
        App.connect("api/producto/getinfourl/"+ruta,false,function(response3){
        $('#evf1').html(response3[0].faqsu);
        $('#evf2').html(response3[0].faqsd);
        $('#evf3').html(response3[0].faqst);
        $('#evf4').html(response3[0].faqsc);
        $('#evf5').html(response3[0].faqscin);
        });
    });
   $("#p11").click(function() {
      App.connect("api/producto/getinfourl/"+ruta,false,function(response){
        $('#principal').attr('src','fileimages/productos/'+response[0].img);
      });  
   });
   $("#p22").click(function() {
      App.connect("api/producto/getinfourl/"+ruta,false,function(response){
        $('#principal').attr('src','fileimages/productos/'+response[0].imgd);
      });   
   });
   $("#p33").click(function() {
      App.connect("api/producto/getinfourl/"+ruta,false,function(response){
        $('#principal').attr('src','fileimages/productos/'+response[0].imgt);
      });  
   });
   $("#p44").click(function() {
      App.connect("api/producto/getinfourl/"+ruta,false,function(response){
        $('#principal').attr('src','fileimages/productos/'+response[0].imgc);
      });  
   });
    $("#p1").click(function() {
      App.connect("api/producto/getinfourl/"+ruta,false,function(response){
        $('#principal').attr('src','fileimages/productos/'+response[0].img);
      });  
   });
   $("#p2").click(function() {
      App.connect("api/producto/getinfourl/"+ruta,false,function(response){
        $('#principal').attr('src','fileimages/productos/'+response[0].imgd);
      });   
   });
   $("#p3").click(function() {
      App.connect("api/producto/getinfourl/"+ruta,false,function(response){
        $('#principal').attr('src','fileimages/productos/'+response[0].imgt);
      });  
   });
   $("#p4").click(function() {
      App.connect("api/producto/getinfourl/"+ruta,false,function(response){
        $('#principal').attr('src','fileimages/productos/'+response[0].imgc);
      });  
   });

   App.connect("api/producto/prodcontvd/",false,function(response4){
          $.each(response4, function(index,value){
            $('#productosrel').append('<div class="col-md-4 col-xs-12 padding margboxprodcreld"><div class="col-md-7 col-xs-12 padding margproducrel"><img class="tamimgsim" src="fileimages/productos/'+value.img+'"></div><div class="col-md-4 col-xs-12 margproducrel"><a class="titproducrel" href="visuales/producto/'+value.url+'"><p class="titproducrel">'+value.nombre+'</p></a><p class="titmodproducrel">'+value.modelo+'</p><p class="tagproducrel"><i class="fa fa-tag" aria-hidden="true"></i> '+value.id_tags+'</p></div></div>');  
          });
    });

   App.connect("api/producto/getinfourl/"+ruta,false,function(response){
          if(response[0].cantidad=='0'){
              $('#btnComprar').append('<div class="col-md-12 col-xs-12 text-center"><h2>Agotado</h2></div>'); 
          }else{
          if(bandera==true){
            $('#btnComprar').append('<form id="frmProducto" action="http://www.bonzercreative.com/sitio_outlean/api/carrito/guardar/" method="post"><input name="id_prod" id="id_prod" type="hidden" value="'+response[0].id_producto+'"><input name="email" id="email" type="hidden"><input name="nom_prod" id="nom_prod" type="hidden" value="'+response[0].nombre+'"><input name="mod_prod" id="mod_prod" type="hidden" value="'+response[0].modelo+'"><input name="img_prod" id="img_prod" type="hidden" value="fileimages/productos/'+response[0].img+'"><input name="cant_prod" id="cant_prod" type="hidden" value="1"><input name="precio_prod" id="precio_prod" type="hidden" value="'+response[0].precio+'"><button  data-toggle="modal" data-target="#myModal" type="" class="btnPComPro btncontt"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Agregar a compras</button></form>');  
            var $form = $("#frmProducto"); 
            $form.jform({
             after:function(response){
                window.location="controles_visuales";
             }
            });
            initinymce();
          }else{
            $('#btnComprar').append('<a href="inicio_sesion"><button  data-toggle="modal" data-target="#myModal" type="" class="btnPComPro btncontt"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Agregar a compras</button></a>');
          }
      }
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

