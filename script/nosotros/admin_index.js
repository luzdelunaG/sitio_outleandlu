function queryParams(params){
  params["fields"]  = "id_nosotros,titulo_seo";
  return params
}

$('#nosotros_table').arr("nosotros","id_nosotros","titulo_seo");

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
        location.href="admin/nosotros/editar/"+row.id_nosotros+"/"+row.titulo_seo;
      },
      'click .eliminar': function (e, value, row, index) {
        BootstrapDialog.confirm('¿Está seguro que quiere eliminar: "'+row.titulo_seo+'"?<br></b>', function(result){
          if(result) {
            App.connect("api/nosotros/eliminar/" +row.id_nosotros,false,function(response){
              App.Alert(response);
              $('#nosotros_table').bootstrapTable("refresh");
            });
          }
        });
      }
    };