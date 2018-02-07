var $form = $("#frmUsuarios"); 
  $form.jform({
    after:function(response){
      redireccion="admin/usuarios";
      App.Alert(response,redireccion);
    }
});


setTimeout(function(){
  var heig1= parseInt($("#mlateral").css("height"));
  var heig2= parseInt($("#panel2").css("height"));
  if (heig1 < heig2){
    heig3= heig2 - heig1;
    $("#soport").css("margin-top",  heig3 + "px");
    console.log(heig3);
  }
  else{
    heig3= heig1;
    $("#panel2").css("height",  heig3 + "px");
    $(".panel").css("margin-bottom",  0 + "px");
  }
},200);