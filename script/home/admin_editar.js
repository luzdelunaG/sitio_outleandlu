var action = $("#frmHome").attr("action").split("/");
var id = action[action.length - 1 ];


App.connect("api/home/getdatos/"+id, false, function(response){
    $("#titulo_seo").val(response.titulo_seo);
    $("#desciption_seo").val(response.desciption_seo);
    $("#keywords_seo").val(response.keywords_seo);
    if(response.img){
      $("#imgFoto").attr("src","fileimages/home/"+response.img);
    }
	$("#titu_home").val(response.titu_home);
    if(response.imgd){
      $("#imgFoto1").attr("src","fileimages/home/"+response.imgd);
    }
    $("#titd_home").val(response.titd_home);
    if(response.imgd){
      $("#imgFoto1").attr("src","fileimages/home/"+response.imgd);
    }
    $("#titd_home").val(response.titd_home);
    if(response.imgt){
      $("#imgFoto2").attr("src","fileimages/home/"+response.imgt);
    }
    $("#titt_home").val(response.titt_home);
    $("#urlv").val(response.urlv);
	initinymce();
});


$("#frmHome").jform({after: function(response){
	App.Alert(response, "admin/home/index");
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

function archivo1(evt) {
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
                document.getElementById("list1").innerHTML = ['<img id="imgFoto1" class="" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                $("#imgFoto1").click(function(){
            $('#imgd').click();
        });
            };
        })(f);
        reader.readAsDataURL(f);
    }
}

document.getElementById('imgd').addEventListener('change', archivo1, false);

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
            $('#imgt').click();
        });
            };
        })(f);
        reader.readAsDataURL(f);
    }
}

document.getElementById('imgt').addEventListener('change', archivo2, false);