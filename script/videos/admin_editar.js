var action = $("#frmVideos").attr("action").split("/");
var id = action[action.length - 1 ];


App.connect("api/videos/getdatos/"+id, false, function(response){
    $("#titulo").val(response.titulo);
    $("#url").val(response.url);
	initinymce();
});


$("#frmVideos").jform({after: function(response){
	App.Alert(response, "admin/videos/index");
}});
