function queryParams(params){
  params["fields"]  = "id_inicio,nombre,apellido,tel,email";
  return params
}

$('#inicio_table').arr("inicio","id_inicio","nombre","apellido","tel","email");

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

    
