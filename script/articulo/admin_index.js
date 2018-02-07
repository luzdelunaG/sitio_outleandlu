function queryParams(params){
      params["fields"]  = "id_articulo,titulo";
      return params
    }
  
$(document).ready(function(){
  $('#articulo_table').arr("articulo","id_articulo","titulo");
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
        location.href="admin/articulo/editar/"+row.id_articulo;
      },
      'click .eliminar': function (e, value, row, index) {
        BootstrapDialog.confirm('¿Está seguro que quiere eliminar el blog: "'+row.titulo+'"?<br></b>', function(result){
          if(result) {
            App.connect("api/articulo/eliminar/" +row.id_articulo,false,function(response){
              App.Alert(response);
              $('#articulo_table').bootstrapTable("refresh");
            });
          }
        });
      }
    };