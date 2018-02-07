var action = $("#frmContacto").attr("action").split("/");
var id = action[action.length - 1 ];


App.connect("api/contacto/getdatos/"+id, false, function(response){
  $("#titulo_seo").val(response.titulo_seo);
  $("#description_seo").val(response.description_seo);
  $("#keywords_seo").val(response.keywords_seo);
    if(response.imgcont){
      $("#imgFotoP").attr("src","fileimages/contacto/"+response.imgcont);
    }
	$("#titcont_contacto").val(response.titcont_contacto);
    $("#txtcont_contacto").val(response.txtcont_contacto);
    $("#fracont_contacto").val(response.fracont_contacto);
	initinymce();
});


$("#frmContacto").jform({after: function(response){
	App.Alert(response, "admin/contacto/index");
}});

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
                document.getElementById("list").innerHTML = ['<img id="imgFotoP" class="" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                $("#imgFotoP").click(function(){
            $('#imgcont').click();
        });
            };
        })(f);
        reader.readAsDataURL(f);
    }
}

document.getElementById('imgcont').addEventListener('change', archivo, false);
