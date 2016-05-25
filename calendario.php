<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>Calendario</title>
<link rel="stylesheet"
	href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.7.1/fullcalendar.min.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"
	type="text/javascript"></script>
<link rel="stylesheet" href="jquery-ui.min.css">
<link rel="stylesheet" href="jquery.simplecolorpicker.css">
<link rel="stylesheet"
	href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script
	src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"
	type="text/javascript"></script>
<script src="external/jquery/jquery.js" type="text/javascript"></script>
<script src="jquery.simplecolorpicker.js" type="text/javascript"></script>
<script src="jquery-ui.min.js" type="text/javascript"></script>

<script
	src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"
	type="text/javascript">
	
</script>
</head>
<!-- We will attach the calendar to this element -->

<script
	src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.7.1/fullcalendar.min.js"
	type="text/javascript"></script>
<script src='es.js' type="text/javascript"></script>

<script type="text/javascript">
	$(function() {
		$("button").button().click(function(event) {
			event.preventDefault();
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(
			function() {
				var date = new Date();
				var d = date.getDate();
				var m = date.getMonth();
				var y = date.getFullYear();
				//config de notificaciones
				toastr.options = {
					"closeButton" : false,
					"debug" : false,
					"newestOnTop" : false,
					"progressBar" : false,
					"positionClass" : "toast-bottom-full-width",
					"preventDuplicates" : true,
					"onclick" : null,
					"showDuration" : "300",
					"hideDuration" : "1000",
					"timeOut" : "5000",
					"extendedTimeOut" : "1000",
					"showEasing" : "swing",
					"hideEasing" : "linear",
					"showMethod" : "fadeIn",
					"hideMethod" : "fadeOut"
				};
				//cuenta atras eventos
				$.ajax({
				url: "http://localhost/ingsoftware/id.php",
				type:'GET',
				success : function(json){
					obj2=JSON.parse(json);
					closerDate=obj2[0].start;
					closerTitle=obj2[0].title;
					startmom = moment();
					endmom = moment(closerDate);
					totalTime = startmom.to(endmom);
					$("#time").text("Evento "+closerTitle+" "+totalTime);
				}
				
					
					
				});
				
				
				//codigo calendario y opciones generales
				calendar = $('#calendar').fullCalendar(
						{
							eventLimit : true,
							views : {
								month : {
									eventLimit : 4
								}
							},

							eventStartEditable : true,
							header : {
								left : 'prev,next today',
								center : 'title',
								right : 'month,agendaWeek,agendaDay'
							},

							events : "http://localhost/ingsoftware/events.php",

							// render
							eventRender : function(event, element, view) {
								eventColor: event.color;
								allDayDefault: true;
							},
							selectable : true,
							selectHelper : true,
							//acciones al hacer click en un dia
							dayClick : function(date, jsEvent, view) {
								start = date.format();
								end = date.add("days", 1).format();
								$("#eventContent").dialog({
									modal : true
								});
								$("#eventInfo").html;
								// acciones al hacer click en aceptar
								$("#acept").unbind("click").click(
										function() {
											$("#eventContent").dialog('close');
											title = $("#title").val();
											description = $("#description").val();
											color = $("#colors").val();
											guarda = 1;
											if ((guarda == 1) && (title != "")) {
												guarda = 0;
												$.ajax({
													url : 'http://localhost/ingsoftware/add_events.php',
													data : 'title=' + title + '&start=' + start + '&end='
															+ end + '&color=' + color + '&description='
															+ description,
													type : "POST",
													success : function(json) {

														toastr.success('Evento Agregado con exito!');
														$("#title").val("");
														$("#description").val("");
														obj = JSON.parse(json);
														id=obj[0].id;
														
														calendar.fullCalendar('renderEvent', {
															id:id,
															title : title,
															start : start,
															end : end,
															description : description,
															color : color
														}, false // que se pegue el evento o no
														);
													}

												});

												calendar.fullCalendar('unselect');
												//calendar.fullcalendar({events: "events.php", }); sin uso
											}
										});
							},
							// acciones al actualizar event dop se encarga de ello

							eventStartEditable : true,
							eventDrop : function(event, delta) {
								start = event.start.format();
								end = event.end.format();
								$.ajax({
									url : 'http://localhost/ingsoftware/update_events.php',
									data : 'title=' + event.title + '&start=' + start + '&end='
											+ end + '&id=' + event.id,
									type : "POST",
									success : function(json) {
										toastr.info('Evento actualizado con exito!');
									}
								});
							},
							//acciones al hacer click en un evento
							eventClick : function(event, jsEvent, view) {
								alert(event.id);
								$("#delete span").text("Eliminar: " + event.title);
								$("#selectContent").dialog({
									modal : true
								});
								$("#selectInfo").html;
								//aciones al hacer click en borrar
								$("#delete").unbind("click").click(function() {
									$("#selectContent").dialog('close');
									$.ajax({
										url : 'http://localhost/ingsoftware/delete_events.php',
										data : '&id=' + event.id,
										type : "POST",
										success : function(json) {
											calendar.fullCalendar('refetchEvents');
											toastr.success('Evento Eliminado con exito!');

										}

									});

								});
								//boton descripcion y acciones
								$("#descriptionInfo").unbind("click").click(function() {
									$("#displayInfo").text(event.description);
									$("#selectContent").dialog('close');
									$("#desInfo").dialog({
										modal : true
									});

								});
							}

						});
				//scrip para la seleccion de colores, define el tipo 
				$('select[name="colorpicker-picker-longlist"]').simplecolorpicker({
					picker : true
				});
			});
</script>

<style type="text/css">
body {
	margin-top: 40px;
	text-align: center;
	font-size: 14px;
	font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
}

#calendar {
	width: 500px;
	margin: 0 auto;
}

#time {
	background-color: red;
	color: white;
	text-align: center;
	padding: 5px;
	width: 500px;
	margin: 0 auto;
}
</style>
<head></head>
<body>
	<!-- podemos ver el counter #time y el calendario en sus div -->
	<div id='time'></div>
	<br>
	<div id='calendar'></div>
	<!-- aqui se encuentra el primer dialogo donde se agregan las cosas y se selecciona el color...todos se encuentran escondidos -->
	<div id="eventContent" title="Crear Evento" style="display: none">
		<fieldset>
			<div id="eventInfo">
				<label>Evento:</label> <label> <input type="text"
					name="title" id="title" />
				</label> <label> Información:</label> <label> <textarea
						name="description" id="description" rows="4" cols="20"></textarea>
					<br>
				</label> <label> Color Evento:</label> <label> <select
					name="colorpicker-picker-longlist" id="colors">
						<option value="#4986e7">#4986e7</option>
						<option value="#ac725e">#ac725e</option>
						<option value="#d06b64">#d06b64</option>
						<option value="#f83a22">#f83a22</option>
						<option value="#fa573c">#fa573c</option>
						<option value="#ff7537">#ff7537</option>
						<option value="#ffad46">#ffad46</option>
						<option value="#42d692">#42d692</option>
						<option value="#16a765">#16a765</option>
						<option value="#7bd148">#7bd148</option>
						<option value="#b3dc6c">#b3dc6c</option>
						<option value="#fbe983">#fbe983</option>
						<option value="#fad165">#fad165</option>
						<option value="#92e1c0">#92e1c0</option>
						<option value="#9fe1e7">#9fe1e7</option>
						<option value="#9fc6e7">#9fc6e7</option>
						<option value="#9a9cff">#9a9cff</option>
						<option value="#b99aff">#b99aff</option>
						<option value="#c2c2c2">#c2c2c2</option>
						<option value="#cabdbf">#cabdbf</option>
						<option value="#cca6ac">#cca6ac</option>
						<option value="#f691b2">#f691b2</option>
						<option value="#cd74e6">#cd74e6</option>
						<option value="#a47ae2">#a47ae2</option>
				</select>
				</label> <label>
					<button type="button" id="acept">Aceptar</button>
				</label>
			</div>
		</fieldset>
	</div>
	<!-- segundo div con dialogo este contiene los botones eliminar y informacion  -->
	<div id="selectContent" title="¿Qué deseas hacer?"
		style="display: none">
		<div id="selectInfo">
			<label>
				<button type="button" id="descriptionInfo">Información</button>
			</label> <label>
				<button type="button" id="delete"></button>
			</label>
		</div>
	</div>
	<!--  otro dialogo que muestra la informacion agregada -->
	<div id="desInfo" title="Información" style="display: none">
		<p id="displayInfo"></p>
	</div>
</body>
</html>