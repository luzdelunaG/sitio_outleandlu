function queryParams(params){
  params["fields"]  = "id_videos,titulo";
  return params
}

$('#videos_table').arr("videos","id_videos","titulo");

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
        location.href="admin/videos/editar/"+row.id_videos+"/"+row.titulo;
      },
      'click .eliminar': function (e, value, row, index) {
        BootstrapDialog.confirm('¿Está seguro que quiere eliminar: "'+row.titulo+'"?<br></b>', function(result){
          if(result) {
            App.connect("api/videos/eliminar/" +row.id_visuales,false,function(response){
              App.Alert(response);
              $('#videos_table').bootstrapTable("refresh");
            });
          }
        });
      }
    };
