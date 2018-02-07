function queryParams(params){
  params["fields"]  = "id_contacto,titulo_seo";
  return params
}

$('#contacto_table').arr("contacto","id_contacto","titulo_seo");

function actionFormatter(value, row, index) {
      datos = [];

      datos.push("<a class='btn-acciones' href='javascript:void(0);' title='Editar'>");
      datos.push("<i class='editar fa fa-pencil'></i>");
      datos.push("</a>");

      datos.push("<a data-toggle='tooltip' title='Arrastrar'/>");
      datos.push("<i class='arrastrar fa fa-arrows handle'></i>");
      datos.push("</a>");

      return datos.join('');
    }

    window.actionEvents = {
      'click .editar': function (e, value, row, index) {
        location.href="admin/contacto/editar/"+row.id_contacto+"/"+row.titulo_seo;
      },
      'click .eliminar': function (e, value, row, index) {
        BootstrapDialog.confirm('¿Está seguro que quiere eliminar el evento: "'+row.titulo_seo+'"?<br></b>', function(result){
          if(result) {
            App.connect("api/contacto/eliminar/" +row.id_contacto,false,function(response){
              App.Alert(response);
              $('#contacto_table').bootstrapTable("refresh");
            });
          }
        });
      }
    };
