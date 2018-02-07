initinymce();

var $form = $("#frmVideos");
  $form.jform({
    after:function(response){
      redireccion="admin/videos/index";
      App.Alert(response,redireccion);
    }
});
