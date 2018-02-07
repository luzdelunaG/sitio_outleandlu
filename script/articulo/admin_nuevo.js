var $form = $("#frmArticulo");

  $form.jform({
    after:function(response){
      redireccion="admin/articulo/index";
      App.Alert(response,redireccion);
    }
});

/*categorias =[];
App.connect("api/categoriasblog/getdata",false,function(response){
  $.each(response,function(index,categoria){
    categorias.push({id:categoria.id_categoria,text:categoria.categoria});
  });
  $("#id_categoria").select2({data:categorias});

});*/

initinymce();


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