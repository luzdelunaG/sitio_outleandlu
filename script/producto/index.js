App.token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJodHRwOlwvXC9lbm93bG9jYWwuY29tXC8iLCJhdWQiOiJodHRwOlwvXC9lbm93bG9jYWwuY29tXC8iLCJpYXQiOjE0NjQyNjk4NDQsImV4cCI6MTc3NTMwOTg0NCwic3ViIjoidXN1YXJpbyIsImFkbWluIjpmYWxzZX0.Ynx4eXqAWwHGFO1cKLLwScI3VM5Fs2e_OODtzkvGjN_LUzYgTaR-sUSFopGWAMzmOJ0jLn_NtnxU80Q6qwnFRA";

$(document).ready(function(){
  $("#metatitle").html('Lean Outlet™');
  $("#metadescription").attr("content",'Consulte nuestro catálogo de productos especializados en manufactura esbelta o pónganse en contacto con nosotros.');
  $("#metakeywords").attr("content",'Lean Manufacturing; Manufactura Esbelta; Cultura Lean; Controles Visuales; Pizarroes; Tableros de Métricos; Identificadores de área; Manufactura; Maquiladora; Señalamientos');

  App.connect("api/producto/getdata2/",false,function(response){
    $('.titproduc').html(response[0].nombre);
    $('.titmodproduc').html(response[0].modelo);
    $('#tags').html(response[0].id_tags);
    $('.txtproduct').html(response[0].descripcion);
    $('.precioproduct').html('$'+response[0].precio);
    $('.aniosgaranti').html(response[0].garantia);
    $('.stockproduct').html(response[0].cantidad+" en stock");
    $('#principal').attr('src','fileimages/productos/'+response[0].img);
    $('#p1').attr('src','fileimages/productos/'+response[0].img);
    $('#p2').attr('src','fileimages/productos/'+response[0].imgd);
    $('#p3').attr('src','fileimages/productos/'+response[0].imgt);
    $('#p4').attr('src','fileimages/productos/'+response[0].imgc);
    $('#p11').attr('src','fileimages/productos/'+response[0].img);
    $('#p22').attr('src','fileimages/productos/'+response[0].imgd);
    $('#p33').attr('src','fileimages/productos/'+response[0].imgt);
    $('#p44').attr('src','fileimages/productos/'+response[0].imgc);
    $('#evf1').html(response[0].especifu);
    $('#evf2').html(response[0].especifd);
    $('#evf3').html(response[0].especift);
    $('#evf4').html(response[0].especifc);
    $('#evf5').html(response[0].especifcin);
  });
  $("#valor").click(function() {
        $("#valor").css("background-color","#ABB2B9");
        $("#espe").css("background-color","#D2D4D3");
        $("#faqs").css("background-color","#D2D4D3");
        App.connect("api/producto/getdata2/",false,function(response1){
        $('#evf1').html(response1[0].valoru);
        $('#evf2').html(response1[0].valord);
        $('#evf3').html(response1[0].valort);
        $('#evf4').html(response1[0].valorc);
        $('#evf5').html(response1[0].valorcin);
        });
  });
       
  $("#espe").click(function() {
        $("#valor").css("background-color","#D2D4D3");
        $("#espe").css("background-color","#ABB2B9");
        $("#faqs").css("background-color","#D2D4D3");
        App.connect("api/producto/getdata2/",false,function(response2){
        $('#evf1').html(response2[0].especifu);
        $('#evf2').html(response2[0].especifd);
        $('#evf3').html(response2[0].especift);
        $('#evf4').html(response2[0].especifc);
        $('#evf5').html(response2[0].especifcin);
        });
    });
  $( "#faqs" ).click(function() {
        $("#valor").css("background-color","#D2D4D3");
        $("#faqs").css("background-color","#ABB2B9");
        $("#espe").css("background-color","#D2D4D3");
        App.connect("api/producto/getdata2/",false,function(response3){
        $('#evf1').html(response3[0].faqsu);
        $('#evf2').html(response3[0].faqsd);
        $('#evf3').html(response3[0].faqst);
        $('#evf4').html(response3[0].faqsc);
        $('#evf5').html(response3[0].faqscin);
        });
    });
   $("#p11").click(function() {
      App.connect("api/producto/getdata2/",false,function(response){
        $('#principal').attr('src','fileimages/productos/'+response[0].img);
      });  
   });
   $("#p22").click(function() {
      App.connect("api/producto/getdata2/",false,function(response){
        $('#principal').attr('src','fileimages/productos/'+response[0].imgd);
      });   
   });
   $("#p33").click(function() {
      App.connect("api/producto/getdata2/",false,function(response){
        $('#principal').attr('src','fileimages/productos/'+response[0].imgt);
      });  
   });
   $("#p44").click(function() {
      App.connect("api/producto/getdata2/",false,function(response){
        $('#principal').attr('src','fileimages/productos/'+response[0].imgc);
      });  
   });
    $("#p1").click(function() {
      App.connect("api/producto/getdata2/",false,function(response){
        $('#principal').attr('src','fileimages/productos/'+response[0].img);
      });  
   });
   $("#p2").click(function() {
      App.connect("api/producto/getdata2/",false,function(response){
        $('#principal').attr('src','fileimages/productos/'+response[0].imgd);
      });   
   });
   $("#p3").click(function() {
      App.connect("api/producto/getdata2/",false,function(response){
        $('#principal').attr('src','fileimages/productos/'+response[0].imgt);
      });  
   });
   $("#p4").click(function() {
      App.connect("api/producto/getdata2/",false,function(response){
        $('#principal').attr('src','fileimages/productos/'+response[0].imgc);
      });  
   });
   
});



(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.11';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


(function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();

