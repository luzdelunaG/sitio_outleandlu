App.token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJodHRwOlwvXC9lbm93bG9jYWwuY29tXC8iLCJhdWQiOiJodHRwOlwvXC9lbm93bG9jYWwuY29tXC8iLCJpYXQiOjE0NjQyNjk4NDQsImV4cCI6MTc3NTMwOTg0NCwic3ViIjoidXN1YXJpbyIsImFkbWluIjpmYWxzZX0.Ynx4eXqAWwHGFO1cKLLwScI3VM5Fs2e_OODtzkvGjN_LUzYgTaR-sUSFopGWAMzmOJ0jLn_NtnxU80Q6qwnFRA";

var $form = $("#frmProducto");

  $form.jform({
    after:function(response){
      redireccion="admin/producto/index";
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
                document.getElementById("list3").innerHTML = ['<img id="imgFoto3" class="" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
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