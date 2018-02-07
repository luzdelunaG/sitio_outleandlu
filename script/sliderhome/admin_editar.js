var action = $("#frmSliderhome").attr("action").split("/");
var id = action[action.length - 1 ];


App.connect("api/sliderhome/getdatos/"+id, false, function(response){
	if (response.imgsl){
      $("#imgFotoSl").attr("src","fileimages/home/"+response.imgsl);
    }
    $("#txtslider_home").val(response.txtslider_home);
	initinymce();
});


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


$("#frmSliderhome").jform({after: function(response){
	App.Alert(response, "admin/sliderhome/index");
}});

