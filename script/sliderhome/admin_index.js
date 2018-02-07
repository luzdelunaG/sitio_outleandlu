function queryParams(params){
  params["fields"]  = "id_sliderhome,txtslider_home";
  return params
}
    
$('#sliderhome_table').arr("sliderhome","id_sliderhome","txtslider_home");

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
        location.href="admin/sliderhome/editar/"+row.id_sliderhome;
      },
      'click .eliminar': function (e, value, row, index) {
        BootstrapDialog.confirm('¿Está seguro que quiere eliminar el elemento: "'+row.txtslider_home+'"?<br></b>', function(result){
          if(result) {
            App.connect("api/sliderhome/eliminar/" +row.id_sliderhome,false,function(response){
              App.Alert(response);
              $('#sliderhome_table').bootstrapTable("refresh");
            });
          }
        });
      }
    };