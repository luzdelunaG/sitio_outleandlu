var action = $("#frmMobiliario").attr("action").split("/");
var id = action[action.length - 1 ];


App.connect("api/mobiliario/getdatos/"+id, false, function(response){
    $("#titulo_seo").val(response.titulo_seo);
    $("#description_seo").val(response.description_seo);
    $("#keywords_seo").val(response.keywords_seo);
    if(response.img){
      $("#imgFoto").attr("src","fileimages/mobiliaria/"+response.img);
    }
    $("#titulo_mob").val(response.titulo_mob);
    $("#subt_mob").val(response.subt_mob);
    $("#txt_mob").val(response.txt_mob);
    $("#subtd_mob").val(response.subtd_mob);
    $("#txtd_mob").val(response.txtd_mob);
    $("#cat_mob").val(response.cat_mob);
    $("#catd_mob").val(response.catd_mob);
    $("#catt_mob").val(response.catt_mob);
	initinymce();
});


$("#frmMobiliario").jform({after: function(response){
	App.Alert(response, "admin/mobiliario/index");
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
