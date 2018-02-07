
  function queryParams(params){
      params["fields"]  = "id_usuario,nombre,usuario";
      return params
    }
    
   $(document).ready(function(){
    $('#usuarios_table').arr("usuarios","id_usuario","nombre");
  });


    function actionFormatter(value, row, index) {
      datos = [];
       
      datos.push("<a class='editar btn-acciones' href='javascript:void(0);' title='Editar'>");
      datos.push("<i class='editar fa fa-pencil'></i>");
      datos.push("</a>");
      
      datos.push("<a class='eliminar btn-acciones' href='javascript:void(0);' title='Eliminar'>");
      datos.push("<i class='eliminar fa fa-trash'></i>");
      datos.push("</a>");

      datos.push("<a data-toggle='tooltip' title='Arrastrar'/>");
      datos.push("<i class='arrastrar fa fa-arrows handle'></i>");
      datos.push("</a>");

      return datos.join('');
    }

    window.actionEvents = {
      'click .editar': function (e, value, row, index) {
        location.href="admin/usuarios/editar/"+row.id_usuario;
      },
      'click .eliminar': function (e, value, row, index) {
        BootstrapDialog.confirm('¿Está seguro que quiere eliminar el usuario: "'+row.nombre+'"?<br></b>', function(result){
          if(result) {
            App.connect("api/usuarios/eliminar/" +row.id_usuario,false,function(response){
              App.Alert(response);
              $('#usuarios_table').bootstrapTable("refresh");
            });
          }
        });
      }
    };