var action = $("#frmProducto").attr("action").split("/");
var id = action[action.length - 1 ];

/*etiquetas =[];
App.connect("api/tags/getdata",false,function(response){
  $.each(response,function(index,etiqueta){
    etiquetas.push({id:etiqueta.id_tag,text:etiqueta.tag});
  });
  $("#tags").select2({data:etiquetas});
});*/

/*categorias =[];
App.connect("api/categoriasblog/getdata",false,function(response){
  $.each(response,function(index,categoria){
    categorias.push({id:categoria.id_categoria,text:categoria.categoria});
  });
  $("#id_categoria").select2({data:categorias});

});*/

App.connect("api/producto/getdatos/"+id, false, function(response){
    $("#nombre").val(response.nombre);
    $("#modelo").val(response.modelo);
    $("#id_tags").val(response.id_tags);
    $("#barras").val(response.barras);
    $("#url").val(response.url);
    $("#descripcion").val(response.descripcion);
    $("#cantidad").val(response.cantidad);
    $("#precio").val(response.precio);
    $("#garantia").val(response.garantia);
    if (response.file){
      $("#imgFotof").attr("src","fileimages/productos/"+response.file);
    }
    if(response.img){
      $("#imgFoto").attr("src","fileimages/productos/"+response.img);
    }
     if(response.imgd){
      $("#imgFoto2").attr("src","fileimages/productos/"+response.imgd);
    }
     if(response.imgt){
      $("#imgFoto3").attr("src","fileimages/productos/"+response.imgt);
    }
     if(response.imgc){
      $("#imgFoto4").attr("src","fileimages/productos/"+response.imgc);
    }
    $("#especifu").val(response.especifu);
    $("#especifd").val(response.especifd);
    $("#especift").val(response.especift);
    $("#especifc").val(response.especifc);
    $("#especifcin").val(response.especifcin);
    $("#valoru").val(response.valoru);
    $("#valord").val(response.valord);
    $("#valort").val(response.valort);
    $("#valorc").val(response.valorc);
    $("#valorcin").val(response.valorcin);
    $("#faqsu").val(response.faqsu);
    $("#faqsd").val(response.faqsd);
    $("#faqst").val(response.faqst);
    $("#faqsc").val(response.faqsc);
    $("#faqscin").val(response.faqscin);
    initinymce();
});

$("#imgFotof").click(function(){
   $('#file').click();
});

function archivof(evt) {
    var files = evt.target.files; // FileList object
    // Obtenemos la imagen del campo "file".
    for (var i = 0, f; f = files[i]; i++) {
    //Solo admitimos imágenes.
        if (!f.type.match('file.*')) {
          continue;
        }
        var reader = new FileReader();
        reader.onload = (function(theFile) {
            return function(e) {
                // Insertamos la imagen
                document.getElementById("listf").innerHTML = ['<img id="imgFoto" class="" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                $("#imgFotof").click(function(){
            $('#file').click();
        });
            };
        })(f);
        reader.readAsDataURL(f);
    }
}
document.getElementById('file').addEventListener('change', archivof, false);


$("#imgFoto").click(function(){
   $('#img').click();
});

function archivo(evt) {
    var files = evt.target.files; // FileList object
    // Obtenemos la imagen del campo "file".
    for (var i = 0, f; f = files[i]; i++) {
    //Solo admitimos imágenes.
        if (!f.type.match('image.*')) {
          continue;
        }
        var reader = new FileReader();
        reader.onload = (function(theFile) {
            return function(e) {
                // Insertamos la imagen
                document.getElementById("list").innerHTML = ['<img id="imgFoto" class="" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                $("#imgFoto").click(function(){
            $('#img').click();
        });
            };
        })(f);
        reader.readAsDataURL(f);
    }
}
document.getElementById('img').addEventListener('change', archivo, false);

$("#imgFoto2").click(function(){
   $('#imgd').click();
});

function archivo2(evt) {
    var files = evt.target.files; // FileList object
    // Obtenemos la imagen del campo "file".
    for (var i = 0, f; f = files[i]; i++) {
    //Solo admitimos imágenes.
        if (!f.type.match('image.*')) {
          continue;
        }
        var reader = new FileReader();
        reader.onload = (function(theFile) {
            return function(e) {
                // Insertamos la imagen
                document.getElementById("list2").innerHTML = ['<img id="imgFoto2" class="" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                $("#imgFoto2").click(function(){
            $('#imgd').click();
        });
            };
        })(f);
        reader.readAsDataURL(f);
    }
}
document.getElementById('imgd').addEventListener('change', archivo2, false);

$("#imgFoto3").click(function(){
   $('#imgt').click();
});

function archivo3(evt) {
    var files = evt.target.files; // FileList object
    // Obtenemos la imagen del campo "file".
    for (var i = 0, f; f = files[i]; i++) {
    //Solo admitimos imágenes.
        if (!f.type.match('image.*')) {
          continue;
        }
        var reader = new FileReader();
        reader.onload = (function(theFile) {
            return function(e) {
                // Insertamos la imagen
                document.getElementById("list2").innerHTML = ['<img id="imgFoto3" class="" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                $("#imgFoto3").click(function(){
            $('#imgt').click();
        });
            };
        })(f);
        reader.readAsDataURL(f);
    }
}
document.getElementById('imgt').addEventListener('change', archivo3, false);

$("#imgFoto4").click(function(){
   $('#imgt').click();
});

function archivo4(evt) {
    var files = evt.target.files; // FileList object
    // Obtenemos la imagen del campo "file".
    for (var i = 0, f; f = files[i]; i++) {
    //Solo admitimos imágenes.
        if (!f.type.match('image.*')) {
          continue;
        }
        var reader = new FileReader();
        reader.onload = (function(theFile) {
            return function(e) {
                // Insertamos la imagen
                document.getElementById("list4").innerHTML = ['<img id="imgFoto4" class="" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                $("#imgFoto4").click(function(){
            $('#imgc').click();
        });
            };
        })(f);
        reader.readAsDataURL(f);
    }
}
document.getElementById('imgc').addEventListener('change', archivo4, false);


$("#frmProducto").jform({after: function(response){
  App.Alert(response, "admin/producto");
}});