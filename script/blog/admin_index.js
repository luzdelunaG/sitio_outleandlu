function queryParams(params){
  params["fields"]  = "id_blog,titulo_seo";
  return params
}

$('#blog_table').arr("blog","id_blog","blog_seo");

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
        location.href="admin/blog/editar/"+row.id_blog+"/"+row.titulo_seo;
      },
      'click .eliminar': function (e, value, row, index) {
        BootstrapDialog.confirm('¿Está seguro que quiere eliminar el evento: "'+row.titulo_seo+'"?<br></b>', function(result){
          if(result) {
            App.connect("api/blog/eliminar/" +row.id_blog,false,function(response){
              App.Alert(response);
              $('#blog_table').bootstrapTable("refresh");
            });
          }
        });
      }
    };
