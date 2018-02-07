$("#imgFotoSl").click(function(){
   $('#imgsl').click();
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
                document.getElementById("list").innerHTML = ['<img id="imgFotoSl" class="" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                $("#imgFotoSl").click(function(){
            $('#imgsl').click();
            });
        };
        })(f);
        reader.readAsDataURL(f);
    }
}             
document.getElementById('imgsl').addEventListener('change', archivo, false);


initinymce();

var $form = $("#frmSliderhome"); 
  $form.jform({
    after:function(response){
      redireccion="admin/sliderhome/index";
      App.Alert(response,redireccion);
    }
});
