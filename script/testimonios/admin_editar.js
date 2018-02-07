var action = $("#frmTestimonios").attr("action").split("/");
var id = action[action.length - 1 ];


App.connect("api/testimonios/getdatos/"+id, false, function(response){
    if(response.img){
        $("#imgFoto").attr("src","fileimages/casos/"+response.img);
    }
	$("#txt_testimonios").val(response.txt_testimonios);
    $("#nom_testimonios").val(response.nom_testimonios);
    $("#empre_testimonios").val(response.empre_testimonios);
	initinymce();
});


$("#frmTestimonios").jform({after: function(response){
	App.Alert(response, "admin/testimonios/index");
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