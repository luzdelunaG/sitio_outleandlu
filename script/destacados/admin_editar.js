var action = $("#frmDestacados").attr("action").split("/");
var id = action[action.length - 1 ];


App.connect("api/destacados/getdatos/"+id, false, function(response){
    if(response.img){
        $("#imgFoto").attr("src","fileimages/productos/"+response.img);
    }
	$("#nomprop_dest").val(response.nomprop_dest);
    $("#precio_dest").val(response.precio_dest);
	initinymce();
});


$("#frmDestacados").jform({after: function(response){
	App.Alert(response, "admin/destacados/index");
}});

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