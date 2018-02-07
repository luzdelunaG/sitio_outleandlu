var action = $("#frmVisuales").attr("action").split("/");
var id = action[action.length - 1 ];


App.connect("api/visuales/getdatos/"+id, false, function(response){
    $("#titulo_seo").val(response.titulo_seo);
    $("#description_seo").val(response.description_seo);
    $("#keywords_seo").val(response.keywords_seo);
    if(response.img){
      $("#imgFoto").attr("src","fileimages/visuales/"+response.img);
    }
    $("#titulo_vis").val(response.titulo_vis);
    $("#subt_vis").val(response.subt_vis);
    $("#txt_vis").val(response.txt_vis);
    $("#subtd_vis").val(response.subtd_vis);
    $("#txtd_vis").val(response.txtd_vis);
    $("#cat_vis").val(response.cat_vis);
    $("#catd_vis").val(response.catd_vis);
    $("#catt_vis").val(response.catt_vis);
	initinymce();
});


$("#frmVisuales").jform({after: function(response){
	App.Alert(response, "admin/visuales/index");
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
