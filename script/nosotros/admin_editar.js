var action = $("#frmNosotros").attr("action").split("/");
var id = action[action.length - 1 ];


App.connect("api/nosotros/getdatos/"+id, false, function(response){
    $("#titulo_seo").val(response.titulo_seo);
    $("#description_seo").val(response.description_seo);
    $("#keywords_seo").val(response.keywords_seo);
    if(response.img){
      $("#imgFoto").attr("src","fileimages/nosotros/"+response.img);
    }
    $("#titulo_nos").val(response.titulo_nos);
    $("#sub_nos").val(response.sub_nos);
    $("#txtu_nos").val(response.txtu_nos);
    $("#urlv").val(response.urlv);
    $("#txtd_nos").val(response.txtd_nos);
    if(response.imgcu){
      $("#imgFoto1").attr("src","fileimages/nosotros/"+response.imgcu);
    }
    if(response.imgcd){
      $("#imgFoto2").attr("src","fileimages/nosotros/"+response.imgcd);
    }
    if(response.imgct){
      $("#imgFoto3").attr("src","fileimages/nosotros/"+response.imgct);
    }
    $("#titulo_nue").val(response.titulo_nue);
    $("#txtu_nue").val(response.txtu_nue);
    $("#txtd_nue").val(response.txtd_nue);
    $("#txtt_nue").val(response.txtt_nue);
    $("#titulo_comp").val(response.titulo_comp);
    $("#txtu_comp").val(response.txtu_comp);
    $("#txtd_comp").val(response.txtd_comp);
    $("#txtt_comp").val(response.txtt_comp);
    $("#tit_opc").val(response.tit_opc);
    $("#frase_opc").val(response.frase_opc);
    $("#txtu_opc").val(response.txtu_opc);
    $("#frasd_opc").val(response.frasd_opc);
    $("#txtd_opc").val(response.txtd_opc);
	initinymce();
});


$("#frmNosotros").jform({after: function(response){
	App.Alert(response, "admin/nosotros/index");
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
            $('#imgcu').click();
        });
            };
        })(f);
        reader.readAsDataURL(f);
    }
}

document.getElementById('imgcu').addEventListener('change', archivo1, false);

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
            $('#imgcd').click();
        });
            };
        })(f);
        reader.readAsDataURL(f);
    }
}

document.getElementById('imgt').addEventListener('change', archivo2, false);

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
            $('#imgct').click();
        });
            };
        })(f);
        reader.readAsDataURL(f);
    }
}

document.getElementById('imgct').addEventListener('change', archivo3, false);
