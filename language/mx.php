<?php
/*
 * desp.php
 * LUIS FERNANDO JAIMES BENITEZ
 * lfjaimesb@gmail.com
 * lfjaimesb.com
 * Copyright 2015
 */

/************* Titulos de las paginas ******************/
function LangMx(){
	return array(
		"ERROR403" => "403 sin autorizacion",
		"ERROR404" => "404 Pagina no encontrada",
		"ERROR503" => "503 Pagina en construccion",
		"ERROR510" => "510 Error conexion",
		"ERRINDEX" => "Error desde Index Control",

		"BIENVENIDO" => "BIENVENIDO A ERPNET &raquo; %s",
		"BTNELIMINAR"=>"Va a eliminar \'%s\':<br><b>%s</b>",
		"BTNCERRAR"=>"Va a cerrar la tarea <b>%s</b>",
		"BTNCANCEL"=>"Va a cancelar la compra <b>%s</b>",
		"BTNDEVOVNT"=>"Confirma devolucion venta <b>%s</b>",
		"BTNCANCELVNT"=>"Va a cancelar la venta <b>%s</b>",
		"BTNREAL"=>"La tarea <b>%s</b> ¿Está realizada?",
		"BTNNOREAL"=>"La tarea <b>%s</b> ¿No está realizada?",
		"PAYPDO"=>"¿Esta seguro de Seleccionar como pagado? <b>%s</b>",
		"PAYVNT"=>"¿Esta seguro de Seleccionar como pagada la venta? <b>%s</b>",
		"SENDVNT"=>"¿Esta seguro de Seleccionar como enviada la venta?  <b>%s</b>",
		"SENDPDO"=>"¿Esta seguro de Seleccionar como enviado? <b>%s</b>",
		"FNPDO"=>"¿Marcar proceso de compra terminada? <b>%s</b>",
		"FNVNT"=>"¿Marcar proceso de venta terminada? <b>%s</b>",
		"NVOELEMET"=>"Nuevo %s",
		"EDITELEMET"=>"Editar %s: <strong>%s</strong>",
		"GRLDELETE"=>"Registro borrado exitosamente!",
		"DGUARDAR"=>"Los datos se han guardado correctamente",
		"ERRGRAL" => "Ups, ha ocurrido un error<br>Por favor intente nuevamente,<br>en caso de persistir el error contacte con su administrador de sistema",
		"VERDOC"=>"<a href='%s' target='_blank' style='color:#FFF;'><i class='glyphicon glyphicon-search' style='margin-right:5px;'></i>Ver %s</a>",
		"SEGTAREA"=>"Seguimiento a %s <b>%s</b>",
		"ASIGNAR"=>"Asignar tarea para el ticket <strong>%s</strong>",
		"ATHU"=>"Tarjeta de autorización",
		
		"INGRESAR" => "INGRESAR AL PANEL",
		"SALIR" => "Salir",
		"PASS" => "Contraseña",
		"ENTRAR" => "Entrar",
		"EMPRESA" => "Empresa",
		"EMPLEADOS" => "Empleados",
		"EMPLEADO" => "Empleado",
		"USUARIOS" => "Usuarios",
		"USUARIO" => "Usuario",
		"SERVICIOS" => "Servicios",
		"PRODUCTOS" => "Productos",
		"PRODUCTO" => "Producto",
		"PROVEEDORES" => "Proveedores",
		"CLIENTES" => "Clientes",
		"CLIENTE" => "Cliente",
		"TAREAS" => "Tareas",
		"VENTAS" => "Ventas",
		"SLINT" => "exp: 0-9",
		"MANTENIMIENTO" => "Mantenimiento",
		"TCOOR"=>"Coordinador (empleado)",
		"PROSPECTOS" => "Prospectos",
		"RECURSOS" => "Recursos",
		"DEMPRESA" => "Datos de la Empresa",
		"FRANQUICIAS" => "Franquicias",
		"DEFRANQ" => "Datos de la Franquicia",
		"ADDFRANC" => "Agregar Franquicia",
		"CRTFRANC" => "Franquicia",
		"PERFILES" => "Perfiles",
		"DEPARTAMENTOS"=>"Departamentos",
		"DEPARTAMENTO"=>"Departamento",
		"PROYECTOS"=>"Proyectos",
		"PROYECTO"=>"Proyecto",
		"SUCURSALES"=>"Sucursales",
		"SUCURSAL"=>"Sucursal",
		"PERFIL"=>"Perfil",
		"ID"=>"ID",
		"DSCPRO"=>"Descuento Producto",
		"TPOPC"=>"Tipo de Descuento",
		"DESCRIPCION"=>"Descripción",
		"EDITAR"=>"Editar",
		"ELIMINAR"=>"Eliminar",
		"NOMBRE"=>"Nombre",
		"NOMBRES"=>"Nombres",
		"NOMBRERAZON"=>"Nombre Completo o Razón social",
		"NOMCNT"=>"Nombre de Contacto",
		"ABREVIATURA"=>"Abreviatura",
		"LPRODUCTOS"=>"Lineas de productos",
		"MARCAS"=>"Marcas",
		"MARCA"=>"Marca",
		"TRANSFERIR"=>"Transferir",
		"TRANSFERENCIAS"=>"Transferencias",
		"MODELO"=>"Modelo",
		"EXISTENCIA"=>"Existencia",
		"PRECIO"=>"Precio",
		"PREUNI"=>"Precio unitario",
		"PREXUN"=>"Precio por Unidad",
		"LINEA"=>"Línea",
		"MASTER"=>"Cantidad Franquicia",
		"PMASTER"=>"Franquicias<br/>Permitidas",
		"UMASTER"=>"Franquicias<br/>Utilizadas",
		"RMASTER"=>"Franquicia<br/>Disponibles",
		"PSUC"=>"Sucursales<br/>Permitidas",
		"USUC"=>"Sucursales<br/>Utilizadas",
		"SUCCANT"=>"Cantidad Sucursales",
		"RSUCCANT"=>"Sucursales<br/>Disponibles",
		"PERTENECE"=>"Franquicia Padre",
		"LOGO"=>"Logotipo",
		"PROVEEDORES"=>"Proveedores",
		"PROVEEDOR"=>"Proveedor",
		"ORDENES"=>"Ordenes de compras",
		"ORDEN"=>"Ordenes de Compra",
		"DCOMP"=>"Detalles de Compra",
		"DVENT"=>"Detalles de Venta",
		"VENTAS"=>"Ventas",
		"CNLVENTA"=>"Devolver Venta",
		"PVENTA"=>"Marcar Pagado",
		"SVENTA"=>"Enviar Venta",
		"RVENTA"=>"Marcar Recibido",
		"EDITVENTA"=>"Editar Venta",
		"DVENTA"=>"Cancelar Venta",
		"OVENTAS"=>"Ordenes de venta",
		"OVENTA"=>"Orden de venta",
		"EDTCOMPRA"=>"Editar Compra",
		"PAYCOMPRA"=>"Pagar Compra",
		"SENDCOMPRA"=>"Enviar Compra",
		"DVCOMPRA"=>"Devolver compra",
		"CNLCOMPRA"=>"Cancelar Compra",
		"ENDCOMPRA"=>"Finalizar Compra",
		"VNTESPECIAL"=>"Venta especial",
		"STATUS"=>"Status",
		"FACTURACION"=>"Facturación",
		"DATAFAC"=>"Datos de Facturación",
		"FPAGOS"=>"Formas de Pago",
		"FPAGO"=>"Forma de Pago",
		"DOMICILIO"=>"Domicilio",
		"DENTREGA"=>"Domicilio de entrega",
		"DOMFAC"=>"Domicilio de Facturación",
		"IMP"=>"imprime",
		"UNIDADES"=>"Unidades",
		"COSTU"=>"Costo por Unidades",
		"GRPVENTAS"=>"Grupo de ventas",
		"NVENDEDOR"=>"Vendedor",		
		"PRESUPUESTO"=>"Presupuesto",
		"RSOCIAL"=>"Razón Social",
		"IVA"=>"IVA",
		"SUBTOTAL"=>"Subtotal",
		"TOTAL"=>"Total",
		"RFC"=>"R.F.C.",
		"SERIE"=>"Serie",
		"CALLE"=>"Calle",
		"COLONIA"=>"Colonia",
		"CP"=>"Código Postal",
		"ESTADO"=>"Estado",
		"EMAIL"=>"Correo Electrónico",
		"TELEFONO"=>"Teléfono",
		"MOVIL"=>"Teléfono celular",
		"CEL"=>"Celular",
		"NEXT"=>"Número Exterior",
		"NINT"=>"Número Interior",
		"CIUDAD"=>"Ciudad",
		"PUESTOS"=>"Puestos",
		"PUESTO"=>"Puesto",
		"CONTRASENA"=>"Contraseña",
		"CCONTRASENA"=>"Confirma contraseña",
		"CLAVE"=>"Clave",
		"ASUNTO"=>"Asunto",
		"PRIORIDAD"=>"Prioridad",
		"RESPONSABLE"=>"Responsable",
		"TAREA"=>"Tarea",
		"SUBTAREAS"=>"Subtareas",
		"SUBTAREA"=>"Subtarea",
		"OBJETIVO"=>"Objetivo",
		"PRS"=>"Prospectos",
		"FPRS"=>"Fases de Prospectos",
		"VIB"=>"viabilidad",
		"MTC"=>"Metricas",
		"OPT"=>"Oportunidades",
		"DTSGRAL"=>"Datos Generales",
		"CNTO"=>"Medio de Contacto",
		"PAIS"=>"Pais",
		"PAISSEST"=>"Locaciones",
		"SKYP"=>"Skype",
		"WEB"=>"Sitio Web",
		"BNC"=>"Banco",
		"GRD"=>"Guardar ",
		"CUENTA"=>"Cuenta",
		"CLABE"=>"Clabe",
		"MTO" =>"Monto",
		"MONEDA"=>"Moneda",
		"FICHATECNICA"=>"Ficha Técnica",
		"FICHA"=>"Ficha",
		"DICTAMEN"=>"Dictamen",
		"DIAGRAMA"=>"Diagrama o Foto",
		"VDESCUENTOS"=>"Descuento por volumen",
		"CANTIDAD"=>"Cantidad",
		"DESCUENTO"=>"Descuento",
		"PROMOVTS"=>"Promociones Ventas",
		"NPROMO"=>"Promoción",
		"NOMPROMO"=>"Nombre Promoción",
		"DESDECANT"=>"A partir de",
		"TCONTACTO"=>"Tipo Contacto",
		"TCLIENTE"=>"Tipo Cliente",
		"LADA"=>"Lada",
		"NDIGITOS"=>"%s Dígitos",
		"TICKETS"=>"Tickets",
		"TICKET"=>"Ticket",
		"PRIORIDADES"=>"Prioridades",
		"PRIORIDAD"=>"Prioridad",
		"EDOTAREAS"=>"Estado de tareas",
		"ASIGNADOA"=>"Asignado a",
		"INVOLUCRADOS"=>"Involucrados",
		"SUPERVISOR"=>"Supervisor",
		"SUPERVISORES"=>"Supervisores",
		"DETALLE"=>"Detalle",
		"COMENTARIO"=>"Comentario",

		"FECHA"=>"Fecha",
		"FECHF"=>"Fecha de Facturación",
		"FINICIO"=>"Fecha Inicio",
		"FLIMITE"=>"Fecha Límite",
		"FREGISTRO"=>"Fecha Registro",
		"FTERMINO"=>"Fecha Término",
		"FMANTTO"=>"Fecha Mantenimiento",
		
		"CARPETA"=>"Carpeta",
		"NDIRECTORIO"=>"Nuevo Directorio",
		"SARCHIVO"=>"Subir Archivos",
		"TAMANO"=>"Tamaño",
		"TIPO"=>"Tipo",
		"FUPLOADOK"=>"Carga exitosa",
		"FUPLOADERR"=>"Error al subir, ¡Intente de nuevo!",
		"SUCORIGEN"=>"Sucursal Origen",
		"SUCDESTINO"=>"Sucursal Destino",
		"ASIGSUCPRINCIPAL"=>"¿Confirma asignar la sucursal <strong>%s</strong> como principal?",
		"VERPRODUCTOSUC"=>"Productos por sucursal <strong>%s</strong>",
		"PAQUETES"=>"Paquetes",
		"PAQUETE"=>"Paquete",
		"DIAGNOSTICO"=>"Diagnóstico",
		"ORDMATTO"=>"Ordenes de Mantto",
		"TIPOMATTO"=>"Tipos Mantto",
		"CATEGORIA"=>"Categoría",
		"CATEGORIAS"=>"Categorías",
		"INICAMARA"=>"Iniciar camara",
		"DIRECCIONES"=>"Direcciones",
		"DIRECCION"=>"Dirección",
		"CONJUNTOS"=>"Conjuntos",
		"CONJUNTO"=>"Conjunto",
		"EDIFICIOS"=>"Edificios",
		"EDIFICIO"=>"Edificio",
		"PISOS"=>"Pisos",
		"PISO"=>"Piso",
		"AREAS"=>"Áreas",
		"AREA"=>"Área",
		"ZONA"=>"Zona",
		"ZONAS"=>"Zonas",
		"UBICACION"=>"Ubicación",
		"UBICACIONES"=>"Ubicaciones",
		"SISTEMA"=>"Sistema",
		"SISTEMAS"=>"Sistemas",
		"SUBSISTEMA"=>"Subsistema",
		"SUBSISTEMAS"=>"Subsistemas",
		"EQUIPO"=>"Equipo",
		"EQUIPOS"=>"Equipos",
		"TAG"=>"TAG",
		"ACTIVIDAD"=>"Actividad",
		"LISTACTREAL"=>"Lista de actividades a realizar",
		"FRECUENCIA"=>"Frecuencia",
		"FRECMANTTO"=>"Frecuencia del mantenimiento",
		"COMENTARIOS"=>"Comentarios",
		"FOTO"=>"Foto",
		"HORA"=>"Hora",
		"INFOEQUIPO"=>"Información equipo",
		"INFOTIPO"=>"Información tipo mantto",
		"TECNICOS"=>"Técnicos",
		"INFOCLIENTE"=>"Información cliente",
		"OBSERVACION"=>"Observación",
		"FORMATO"=>"Formato",
		"DIAS"=>"Días",
		"COORDINADOR"=>"Coordinador",

		/*************** NOTIFICACIONES ***************/
		"NOTIFICACIONES"=>"Notificaciones",
		"NOTY_VRTODAS"=>"Todas las notificaciones",
		"NOTY_CONFNOTIF"=>"Configurar notificaciones",
		"NOTY_ACTSOUND"=>"Activar sonido al recibir una notificación",
		"NOTY_ENVBIENVENIDA"=>"Enviar bienvenida al crear un usuario",
		"NOTY_RECPROD"=>"Al recibir mercancia (por compra o transferencia)",
		"NOTY_ENTPROD"=>"Al enviar mercancia (por venta o transferencia)",
		"NOTY_AGOTADO"=>"Producto agotado",
		"NOTY_PORAGOTAR"=>"Producto por agotarse <input type='text' name='npacantidad' value='%s' /><br><span style='color:#A52A2A;'><strong>Nota:</strong> Cantidad en existencia antes de agotarse, para multiples notificaciones separar por comas.</span>",
		"NOTY_NVATAREA"=>"Enviar a todos los involucrados al crear una nuava tarea",
		"NOTY_NVATICKET"=>"Enviar a todos los administradores al crear nuavo ticket",
		"NOTY_SEGUIMIENTO"=>"Enviar a todos los involucrados cuando se deja un mensaje en una tarea, subtarea o ticket",
		"NOTY_VENTAREA"=>"Enviar a todos los involucrados cuando la fecha límite ha vencido en tareas, subtareas",
		"NOTY_NVAMANTTO"=>"Enviar a todos los administradores al crear nuava orden de mantenimiento",
		"NOTY_ASIGTECNICO"=>"Enviar a todos los involucrados al asignar técnico(s) a una orden de mantenimiento",
		"NOTY_VENMANTTO"=>"Enviar a todos los involucrados cuando la fecha límite ha vencido de una orden de mantenimiento",
		
	);
}
?>