<?php
function translate($msgin){

    switch ($msgin) {
	case "About Calendarix": $new = "About Calendarix"; break ;		// translate?
	case "Add": $new = "Añadir"; break ;
	case "Add Category": $new = "Añadir Categoría"; break;
	case "Add Event": $new = "Añadir Evento"; break;
	case "Add event": $new = "Añadir Evento" ; break;
	case "Add new user": $new = "Añadir nuevo usuario"; break;
	case "Adding category": $new = "Añadiendo una categoría"; break;
	case "Adding event": $new = "Añadiendo evento" ; break ;
	case "Adding user": $new = "Añadiendo usuario"; break ;
	case "Administration": $new = "Administración"; break;
	case "Administrator": $new = "Administrador"; break ;
	case "All categories": $new = "Todas las categorías"; break ;
	case "Approval needed for posting of events.": $new = "Se necesita aprobación para añadir eventos."; break ;
	case "Approvals": $new = "Aprobaciones"; break ;
	case "Approve": $new = "Aprobarse"; break;
	case "Approving event": $new = "Aprobando evento"; break;

	case "Back": $new = "Atrás"; break;
	case "Both passwords entered do not match": $new = "Ambas contraseñas introducidas no concuerdan"; break;

	case "Calendar": $new = "Calendario"; break;
	case "Cancel": $new = "Cancelar"; break ;
	case "Cannot delete current login user": $new = "No se puede borrar este usuario"; break ;
	case "Cannot change current login user": $new = "No se puede modificar este usuario"; break;
	case "Cannot have a category with blank name": $new = "No se puede tener una categoría sin nombre"; break ;
	case "Categories": $new = "Categorías"; break;
	case "Category": $new = "Categoría"; break;
	case "Change": $new = "Modificar"; break ;
	case "Change password/group": $new = "Cambiar contraseña/grupo"; break;
	case "Choose Category": $new = "Elige Categoría"; break;
	case "Close": $new = "Cerrar"; break;
	case "Confirm delete?": $new = "Confirmar borrar?" ; break ;	
	case "Confirm delete all historical events before": $new = "Confirmar antes de borrar todos los eventos históricos"; break ;
	case "confirmed events for today": $new = "eventos confirmados para hoy"; break ;
	case "Confirm password": $new = "Confirmar contraseña"; break;
	case "Copy Event": $new = "Copiar Evento"; break ;
	case "Current Week": $new = "Esta Semana"; break;
	case "Current Month": $new = "Este Mes"; break;
	case "Current Year": $new = "Este año"; break;

	case "Date": $new = "Fecha"; break;
	case "Day": $new = "Día"; break;
	case "Delete all historical events listed": $new = "Borrar todos los eventos históricos listados"; break;
	case "Delete category": $new = "Borrar categoría"; break;
	case "Delete event": $new = "Borrar evento"; break;
	case "Delete user": $new = "Borrar usuario"; break;
	case "Deleting category": $new = "Borrando categoría"; break;
	case "Deleting event": $new = "Borrando evento"; break ;
	case "Deleting user": $new = "Borrando usuario"; break ;
	case "disabled": $new = "Esta sección a sido desactivada"; break;

	case "Edit category": $new = "Editar categoría"; break;
	case "Edit event": $new = "Editar evento"; break;
	case "Email": $new = "Email"; break;
	case "End Time": $new = "Hora fin"; break ;
	case "Event": $new = "Evento"; break ;
	case "Event Category": $new = "Categoría del evento"; break;
	case "Event Description": $new = "Descripción del evento"; break;
	case "Event Title": $new = "Título del evento"; break;
	case "events": $new = "eventos"; break;
	case "Events added will be posted immediately.": $new = "Los eventos añadidos serán puestos inmediatamente."; break ;
	case "events awaiting approval": $new = "eventos esperando aprobación"; break ;
	case "Events before": $new = "Eventos anteriores"; break ;
	case "events for": $new = "eventos para"; break;
	case "Events for day": $new = "Eventos por día"; break;
	case "events for whole calendar": $new = "Eventos para calendario entero"; break;
	case "events for year": $new = "Eventos por año"; break;
	case "Events from ": $new = "Eventos de "; break;
	case "Events in category": $new = "Eventos en categoría"; break;

	case "From": $new = "De"; break ;

	case "Go to": $new = "Ir a"; break;
	case "Go to day": $new = "Ir a día"; break;
	case "Go to week": $new = "Ir a semana"; break;

	case "Historical Items": $new = "Artículos históricos"; break;

	case "Login": $new = "Login"; break;
	case "Login session time out in seconds": $new = "Tiempo de caducidad de la sesión de login en segundos"; break;
	case "Login session timeout": $new = "Sesión login fuera de tiempo"; break ;
	case "Logout": $new = "Logout"; break;

	case "Menu": $new = "Menu"; break;
	case "Month": $new = "Mes"; break;
	case "More info": $new = "Más información"; break;

	case "Next": $new = "Siguiente"; break;				
	case "Next day": $new = "Día siguiente"; break;
	case "Next week": $new = "Semana siguiente"; break;
	case "No categories yet": $new = "Sin categorías todavía"; break;
	case "No events": $new = "Sin Eventos"; break;
	case "No Repeat": $new = "No Repetir"; break;
	case "No results": $new = "Sin resultados"; break;
	case "No, go back!": $new = "No, volver atrás!"; break;
	case "noadminapprove": $new = "Aprobación de los eventos añadidos por administradores no es necesaria"; break ;
	case "noapprove": $new = "La aprobación de los administradores de los eventos añadidos por usuarios no es necesaria"; break ;
	case "nocat": $new = "Debes seleccionar una categoría!"; break;
	case "noday": $new = "Debes seleccionar un día!"; break;
	case "nodescription": $new = "Debes dar una descripción del evento!"; break;
	case "nomonth": $new = "Debes seleccionar un mes!"; break;
	case "nonapproved": $new = "Eventos que requieren aprobación : "; break;
	case "nononapproved": $new = "No hay eventos que necesiten aprobación"; break;
	case "notitle": $new = "Debes dar un título al evento!"; break;
	case "noyear": $new = "Debes seleccionar un año!"; break;

	case "on": $new = "el"; break;
	case "Optional": $new = "Opcional"; break;
	case "or month": $new = "o mes"; break;
	case "or week": $new = "o semana"; break;

	case "password": $new = "contraseña"; break;
	case "Please choose the category you only want to view events for": $new = "Elige una categoría de eventos que quieres ver"; break;
	case "Popup Month": $new = "Abrir mes en una ventana pequeña"; break ;
	case "Previous": $new = "Anterior"; break;			
	case "Previous day": $new = "Día anterior"; break;
	case "Previous week": $new = "Semana anterior"; break;

	case "Read more": $new = "Leer más"; break;
	case "reallydelcat": $new = "Estás seguro de que quieres borrar esta categoría? Todos los eventos asociados con esta categoría serán borrados permanentemente!"; break;

	case "Repeat": $new = "Repetir"; break;
	case "results": $new = "resultados"; break;

	case "search": $new = "buscar"; break;
	case "Sort by": $new = "Ordenar por"; break ;
	case "Sort by date": $new = "Ordenar por fecha"; break ;
	case "Sort by events": $new = "Ordenar por evento"; break ;
	case "Start Time": $new = "Hora de inicio"; break ;

	case "thankyou": $new = "Gracias por añadir el evento, aparecerá después de su aprobación."; break;
	case "thankyoupost": $new = "Gracias por introducir un evento, ha sido añadido."; break;
	case "till": $new = "hasta"; break;
	case "Time added or updated": $new = "Hora añadida o actualizada"; break ;
	case "timeout msg": $new = "Los cambios en una sesión caducada sólo tendrán efecto en el próximo login" ; break ;
	case "times every": $new = "veces cada"; break;
	case "To": $new = "A"; break ;
	case "To delete category": $new = "Para borrar categoría"; break ;
	case "Today": $new = "Hoy"; break;
	case "Total": $new = "Total"; break;
	case "Total number of events for the month": $new = "Número total de eventos en el mes"; break ;
	case "Total unapproved events for the month": $new = "Eventos sin aprovar del mes" ; break;
	case "Two weeks": $new = "Dos semanas" ; break;

	case "Update": $new = "Actualizar"; break;
	case "Update Event": $new = "Actualizar evento"; break;
	case "Updating category": $new = "Actualizando categoría"; break ;
	case "Updating event": $new = "Actualizando evento"; break;
	case "Updating user": $new = "Actualizando usuario"; break;
	case "Unapproved events": $new = "Eventos sin aprobar"; break ;
	case "User": $new = "Usuario"; break ;
	case "User Calendar": $new = "Calendario de Usuario"; break ;
	case "User description": $new = "Descripción de usuario"; break ;	
	case "User Management": $new = "Administración de Usuario"; break;
	case "User group": $new = "User group"; break ;
	case "userdelok": $new = "Estás seguro que quieres borrar este usuario?"; break;
	case "username": $new = "Nickname"; break;
	case "Username entered already exists. Please use another username.": $new = "Nombre de usuario ya existe, por favor usa otro nombre."; break;
	case "users": $new = "usuarios"; break;

	case "View": $new = "Ver"; break;
	case "View categories in year": $new = "Ver categorías en año"; break ;
	case "View details or edit": $new = "Ver detalles o editar"; break ;
	case "View event": $new = "Ver evento"; break;
	case "View events under this category in year": $new = "Ver eventos bajo esta categoría en año"; break ;
	case "View historical events before": $new = "Ver eventos históricos antes"; break ;
	case "View month": $new = "Ver mes"; break;
	case "View week": $new = "Ver semana"; break;

	case "Web Calendar Admin Login": $new = "Calendarix Login de Administrador"; break ;
	case "Web Calendar User Login": $new = "Calendarix Login de Usuario"; break ;
	case "week number": $new = "semana número"; break;
	case "Week starts": $new = "Semana empieza"; break;
	case "wronglogin": $new = "Username o contraseña incorrectos!"; break;

	case "Year": $new = "Año"; break;
	case "Yes, delete event !": $new = "Sí, borrar evento!"; break;
	case "Yes, delete it!": $new = "Sí, bórralo!"; break;

	default: $new = "<b>".$msgin."</b> necesita ser traducido!";    break;

    }
    return $new;
}
?>