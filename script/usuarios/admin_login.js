$(document).ready(function(){
	$("#login").jform({
		after:function(response){

			$localStore.set("menuEurogruas",response.menu);
			$localStore.set("tokenEurogruas",response.token);
			//$localStore.set("permisosEnow",response.permisos);

			location.href=App.referer;			

		}

});

});