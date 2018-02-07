var action = $("#frmArticulo").attr("action").split("/");
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

App.connect("api/articulo/getdatos/"+id, false, function(response){
    $("#titulo").val(response.titulo);
    $("#id_tags").val(response.id_tags);
    $("#fecha").val(response.fecha);
    $("#contenido").val(response.contenido);
    $("#urlv").val(response.urlv);
    $("#contenidod").val(response.contenidod);
    if (response.img){
      $("#imgFoto").attr("src","fileimages/articulo/"+response.img);
    }
    $("#url").val(response.url);
    initinymce();
});



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


$("#frmArticulo").jform({after: function(response){
  App.Alert(response, "admin/articulo");
}});