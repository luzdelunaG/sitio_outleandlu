function queryParams(params){
      params["fields"]  = "id_destacados,img";
      return params
    }
  
$(document).ready(function(){
  $('#destacados_table').arr("destacados","id_destacados","img");
  $("select").select2();
});

function actionFormatter(value, row, index) {
      datos = [];
       
      datos.push("<a class='btn-acciones' href='javascript:void(0);' title='Editar'>");
      datos.push("<i class='editar fa fa-pencil'></i>");
      datos.push("</a>");
      
      datos.push("<a class='btn-acciones' href='javascript:void(0);' title='Eliminar'>");
      datos.push("<i class='eliminar fa fa-trash'></i>");
      datos.push("</a>");

      datos.push("<a data-toggle='tooltip' title='Arrastrar'/>");
      datos.push("<i class='arrastrar fa fa-arrows handle'></i>");
      datos.push("</a>");

      return datos.join('');
}

    window.actionEvents = {
      'click .editar': function (e, value, row, index) {
        location.href="admin/destacados/editar/"+row.id_destacados;
      },
      'click .eliminar': function (e, value, row, index) {
        BootstrapDialog.confirm('¿Está seguro que quiere eliminar: "'+row.img+'"?<br></b>', function(result){
          if(result) {
            App.connect("api/destacados/eliminar/" +row.id_destacados,false,function(response){
              App.Alert(response);
              $('#destacados_table').bootstrapTable("refresh");
            });
          }
        });
      }
    };