var action = $("#frmMateriales").attr("action").split("/");
var id = action[action.length - 1 ];


App.connect("api/materiales/getdatos/"+id, false, function(response){
    $("#titulo_seo").val(response.titulo_seo);
    $("#description_seo").val(response.description_seo);
    $("#keywords_seo").val(response.keywords_seo);
    if(response.img){
      $("#imgFoto").attr("src","fileimages/materiales/"+response.img);
    }
    $("#titulo_mat").val(response.titulo_mat);
    $("#subt_mat").val(response.subt_mat);
    $("#txt_mat").val(response.txt_mat);
    $("#subtd_mat").val(response.subtd_mat);
    $("#txtd_mat").val(response.txtd_mat);
    $("#cat_mat").val(response.cat_mat);
    $("#catd_mat").val(response.catd_mat);
    $("#catt_mat").val(response.catt_mat);
	initinymce();
});


$("#frmMateriales").jform({after: function(response){
	App.Alert(response, "admin/materiales/index");
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
