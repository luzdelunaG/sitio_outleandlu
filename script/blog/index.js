App.token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJodHRwOlwvXC9lbm93bG9jYWwuY29tXC8iLCJhdWQiOiJodHRwOlwvXC9lbm93bG9jYWwuY29tXC8iLCJpYXQiOjE0NjQyNjk4NDQsImV4cCI6MTc3NTMwOTg0NCwic3ViIjoidXN1YXJpbyIsImFkbWluIjpmYWxzZX0.Ynx4eXqAWwHGFO1cKLLwScI3VM5Fs2e_OODtzkvGjN_LUzYgTaR-sUSFopGWAMzmOJ0jLn_NtnxU80Q6qwnFRA";

$(document).ready(function(){
  $("#metatitle").html('Lean Outlet™');
  $("#metadescription").attr("content",'Consulte nuestro blog para mantenerse actualizado sobre las últimas novedades en manufactura esbelta (lean manufacturing).');
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
  
  App.connect("api/articulo/recientes/",false,function(response){
  	var divA="";
  	$.each(response, function(index,value){
			$('#last-new').append('<div class="col-md-12 col-xs-12 margbotblog padding"><a href="blog/articulo/'+value.url+'#blog-banda" class="titlebloghiper"><img alt="Articulo de Lean Outlet™" class="hidden-md hidden-lg imgmu11" src="fileimages/blog/'+value.img+'"><h2 class="titleblog">'+value.titulo+'</h2></a><div class="subblog">'+value.id_tags+'</div><div class="fechblog">'+value.fecha+'</div></div>');
	    /*$('.margbotblogimg').append('<img alt="Articulo de Lean Outlet™" src="fileimages/blog/'+value.img+'" class="imgmu11">');*/
    });
  });

   App.connect("api/articulo/getdatall",false,function(response4){
    console.log(response4);
      $.each(response4[1],function(index,value4){
          var divA = $('<div class="col-md-12 col-xs-12 margbotblog article-blog padding"><a href="blog/articulo/'+value4.url+'#blog-banda" class="titlebloghiper"><img alt="Articulo de Lean Outlet™" class="hidden-md hidden-lg imgmu11" src="fileimages/blog/'+value4.img+'"><h2 class="titleblog">'+value4.titulo+'</h2></a><div class="subblog">'+value4.id_tags+'</div><div class="fechblog">'+value4.fecha+'</div></div>');
          $('#bloglist').append(divA);
          $('.margbotblogimg').append('<img alt="Articulo de Lean Outlet™" src="fileimages/blog/'+value4.img+'" class="imgmu11">');
        });
        $('#blog-paginator').append(
          '<ul class="pagination"><li class="pag_prev"><a class="pagflech" href="blog#blog-paginator" aria-label="Previous"><i class="fa fa-caret-left"  aria-hidden="true"></i>'+
          '</a></li><li class="pagflech pag_next"><a class="pagflech" href="blog#blog-paginator" aria-label="Next"><i class="fa fa-caret-right" aria-hidden="true"></i></a></li></ul>'
        );
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
        var pag = $("<a href='blog/"+x+"' class='"+pag2+"'>"+x+"</a>");
        divPags.append(pag);
      }
      setTimeout(function(){
       showpaginator();
     },800);
  });

function showpaginator(){
  pageSize = 4;
    pagesCount = $(".article-blog").length;
    var currentPage = 1;

    /////////// PREPARE NAV ///////////////
    var nav = '';
    var totalPages = Math.ceil(pagesCount / pageSize);
    for (var s=0; s<totalPages; s++){
        nav += '<li class="numeros"><a href="blog#blog-paginator">'+(s+1)+'</a></li>';
    }
    $(".pag_prev").after(nav);
    $(".numeros").first().addClass("active");
    //////////////////////////////////////

    showPage = function() {
        $(".article-blog").hide().each(function(n) {
            if (n >= pageSize * (currentPage - 1) && n < pageSize * currentPage)
                $(this).show();
        });
    }
    showPage();


    $(".pagination li.numeros").click(function() {
        $(".pagination li").removeClass("active");
        $(this).addClass("active");
        currentPage = parseInt($(this).text());
        showPage();
    });

    $(".pagination li.pag_prev").click(function() {
        if($(this).next().is('.active')) return;
        $('.numeros.active').removeClass('active').prev().addClass('active');
        currentPage = currentPage > 1 ? (currentPage-1) : 1;
        showPage();
    });

    $(".pagination li.pag_next").click(function() {
        if($(this).prev().is('.active')) return;
        $('.numeros.active').removeClass('active').next().addClass('active');
        currentPage = currentPage < totalPages ? (currentPage+1) : totalPages;
        showPage();
    });
}


App.connect("api/videos/getdatalll",false,function(response4){
    console.log(response4);
      $.each(response4[1],function(index,value4){
          var divA = $('<div class="col-md-6 article-video"><div class="col-md-12 padding"><iframe class="anchovideoblog" src="'+value4.url+'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe><h2 class="titvideblog">+'+value4.titulo+'+</h2></div></div>');
          $('#videos').append(divA);
        });
        $('#blog-paginatorvideo').append(
          '<ul class="pagination"><li class="pag_prevv"><a class="pagflech" href="blog#blog-paginatorvideo" aria-label="Previous"><i class="fa fa-caret-left"  aria-hidden="true"></i>'+
          '</a></li><li class="pagflech pag_nextv"><a class="pagflech" href="blog#blog-paginatorvideo" aria-label="Next"><i class="fa fa-caret-right" aria-hidden="true"></i></a></li></ul>'
        );
        var divPaginador=$("<div class='col-md-12 area-paginador' style='text-align:center; margin-top:20px;margin-bottom: 27px;'></div>")
        var divPags = $("<div class='pags' style='z-index: 9992;color:#000;''></div>")

      //Para el paginador//
      var ya="false";
      for (var x = 1; x <= response4[0]; x++){
        var activo="";
        if (ya=="false"){
          activo="activo";
          ya="true";
        }
        var pag2 = "pag"+activo;
        var pag = $("<a href='blog/"+x+"' class='"+pag2+"'>"+x+"</a>");
        divPags.append(pag);
      }
      setTimeout(function(){
       showpaginator1();
     },800);
  });

  function showpaginator1(){
    pageSize = 4;
      pagesCount = $(".article-video").length;
      var currentPage = 1;

      /////////// PREPARE NAV ///////////////
      var nav = '';
      var totalPages = Math.ceil(pagesCount / pageSize);
      for (var s=0; s<totalPages; s++){
          nav += '<li class="numerosv"><a href="blog#blog-paginatorvideo">'+(s+1)+'</a></li>';
      }
      $(".pag_prevv").after(nav);
      $(".numerosv").first().addClass("active");
      //////////////////////////////////////

      showPage = function() {
          $(".article-video").hide().each(function(n) {
              if (n >= pageSize * (currentPage - 1) && n < pageSize * currentPage)
                  $(this).show();
          });
      }
      showPage();


      $(".pagination li.numerosv").click(function() {
          $(".pagination li").removeClass("active");
          $(this).addClass("active");
          currentPage = parseInt($(this).text());
          showPage();
      });

      $(".pagination li.pag_prevv").click(function() {
          if($(this).next().is('.active')) return;
          $('.numeros.active').removeClass('active').prev().addClass('active');
          currentPage = currentPage > 1 ? (currentPage-1) : 1;
          showPage();
      });

      $(".pagination li.pag_nextv").click(function() {
          if($(this).prev().is('.active')) return;
          $('.numerosv.active').removeClass('active').next().addClass('active');
          currentPage = currentPage < totalPages ? (currentPage+1) : totalPages;
          showPage();
      });
  }

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
      alert(entre);
    }else{
      $(".anchovideoarti").attr("src",response8.urlv);
    }
    
    $(".txtartid").html(response8.contenidod);
  });
});



/*function setLast(response) {
  $.each(response, function(index,value){
    flag = value.titulo.substring(0,50)+ "...";
    $(".last-news").append(
      '<a href="blog/articulo/'+value.url+'#blog-banda"><div class="col-md-4"><img src="fileimages/publicaciones/'+value.img+'" class="img-blog-prev"></div><div class="col-md-8 blog-text-prev">'+flag+'</div><div class="col-md-12" style="height:15px"></div></a>'
    )
  });
}
$(document).ready(function(){
	alert("emtro");
		
		$.each(response, function(index,value){
			$("#last-new").append(
				'<div class="col-md-12 col-xs-12 margbotblog padding"><a href="articulo/'+value.url+'" class="titlebloghiper">
					<img alt="Articulo de Lean Outlet™" class="hidden-md hidden-lg imgmu11" src="fileimages/blog/'+value.img+'">
					<h2 class="titleblog">'+value.titulo+'</h2></a>
					<div class="subblog">'+value.id_tags+'</div>
					<div class="fechblog">'+value.fechblog+'</div>
				</div>'
			);
		});
	});
});

*/



(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.11';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));