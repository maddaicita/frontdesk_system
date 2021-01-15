<?php
function translate($msgin){

    switch ($msgin) {
	case "About Calendarix": $new = "A propòsit de Calendrix"; break ;		// translate?
	case "Add": $new = "Afegir"; break ;
	case "Add Category": $new = "Afegir Categoria"; break;
	case "Add Event": $new = "Afegir Esdeveniment"; break;
	case "Add event": $new = "Afegir Esdeveniment" ; break;
	case "Add new user": $new = "Afegir usuari nou"; break;
	case "Adding category": $new = "Afegint la Categoria nova"; break;
	case "Adding event": $new = "Afegint l'esdeveniment nou" ; break ;
	case "Adding user": $new = "Afegint usuari"; break ;
	case "Administration": $new = "Administració"; break;
	case "Administrator": $new = "Administrador"; break ;
	case "All categories": $new = "Totes les categories"; break ;
	case "Approval needed for posting of events.": $new = "Es necessita aprovació per afegir esdeveniments."; break ;
	case "Approvals": $new = "Aprovacions"; break ;
	case "Approve": $new = "Aprovar-se"; break;
	case "Approving event": $new = "Aprovant l'esdeveniment"; break;

	case "Back": $new = "Arrere"; break;
	case "Both passwords entered do not match": $new = "Les dos contrasenyes introduïdes no concorden"; break;

	case "Calendar": $new = "Calendari"; break;
	case "Cancel": $new = "Cancel·lar"; break ;
	case "Cannot delete current login user": $new = "No es pot esborrar este usuari"; break ;
	case "Cannot change current login user": $new = "No es pot modificar este usuari"; break;
	case "Cannot have a category with blank name": $new = "No es pot tindre una categoria sense nom"; break ;
	case "Categories": $new = "Categories"; break;
	case "Category": $new = "Categoria"; break;
	case "Change": $new = "Modificar"; break ;
	case "Change password/group": $new = "Canviar contrasenya/grup"; break;
	case "Choose Category": $new = "Tria Categoria"; break;
	case "Close": $new = "Cerrar"; break;
	case "Confirm delete?": $new = "Confirmes esborrar?" ; break ;	
	case "Confirm delete all historical events before": $new = "Confirmar abans d'esborrar tots els esdeveniments històrics"; break ;
	case "confirmed events for today": $new = "esdeveniments confirmats per a hui"; break ;
	case "Confirm password": $new = "Confirmar contrasenya"; break;
	case "Copy Event": $new = "Copiar Esdeveniment"; break ;
	case "Current Week": $new = "Esta Setmana"; break;
	case "Current Month": $new = "Este Mes"; break;
	case "Current Year": $new = "Enguany"; break;

	case "Date": $new = "Data"; break;
	case "Day": $new = "Dia"; break;
	case "Delete all historical events listed": $new = "Esborrar tots els esdeveniments històrics llistats"; break;
	case "Delete category": $new = "Esborrar categoria"; break;
	case "Delete event": $new = "Esborrar esdeveniment"; break;
	case "Delete user": $new = "Esborrar esdeveniment"; break;
	case "Deleting category": $new = "Esborrant categoria"; break;
	case "Deleting event": $new = "Esborrant esdeveniment"; break ;
	case "Deleting user": $new = "Esborrant usuari"; break ;
	case "disabled": $new = "Esta secció ha sigut desactivada"; break;

	case "Edit category": $new = "Editar categoria"; break;
	case "Edit event": $new = "Editar esdeveniment"; break;
	case "Email": $new = "Email"; break;
	case "End Time": $new = "Hora fi"; break ;
	case "Event": $new = "Esdeveniment"; break ;
	case "Event Category": $new = "Categoria de l'esdeveniment"; break;
	case "Event Description": $new = "Descripció de l'esdeveniment"; break;
	case "Event Title": $new = "Títol de l'esdeveniment"; break;
	case "events": $new = "esdeveniment"; break;
	case "Events added will be posted immediately.": $new = "Els esdeveniments afegits seran publicats immediatament."; break ;
	case "events awaiting approval": $new = "esdeveniment esperant aprovació"; break ;
	case "Events before": $new = "Esdeveniments anteriors"; break ;
	case "events for": $new = "Esdeveniments per a"; break;
	case "Events for day": $new = "Esdeveniments per dia"; break;
	case "events for whole calendar": $new = "Esdeveniments per a Calendari sancer"; break;
	case "events for year": $new = "Esdeveniments per any"; break;
	case "Events from ": $new = "Esdeveniments de "; break;
	case "Events in category": $new = "Esdeveniments en categoria"; break;

	case "From": $new = "De"; break ;

	case "Go to": $new = "Anar a"; break;
	case "Go to day": $new = "Anar a dia"; break;
	case "Go to week": $new = "Anar a setmana"; break;

	case "Historical Items": $new = "Articles històrics"; break;

	case "Login": $new = "Entrar"; break;
	case "Login session time out in seconds": $new = "Temps de caducitat de la sessió de login en segons"; break;
	case "Login session timeout": $new = "Sessió login fora de temps"; break ;
	case "Logout": $new = "eixir"; break;

	case "Menu": $new = "Menu"; break;
	case "Month": $new = "Mes"; break;
	case "More info": $new = "Més informació"; break;

	case "Next": $new = "Següent"; break;				
	case "Next day": $new = "Dia següent"; break;
	case "Next week": $new = "Setmana següent"; break;
	case "No categories yet": $new = "Sense categories encara"; break;
	case "No events": $new = "Sense Esdeveniments"; break;
	case "No Repeat": $new = "No Repetir"; break;
	case "No results": $new = "Sense resultats"; break;
	case "No, go back!": $new = "No, tornar arrere!"; break;
	case "noadminapprove": $new = "Aprovació dels Esdeveniments afegits per administradors no és necessària"; break ;
	case "noapprove": $new = "L'aprovación dels administradors dels Esdeveniments afegits per usuaris no és necessària"; break ;
	case "nocat": $new = "Has de seleccionar una categoria!"; break;
	case "noday": $new = "Has de seleccionar un dia!"; break;
	case "nodescription": $new = "Has de donar una descripció de l'Esdeveniments!"; break;
	case "nomonth": $new = "Has de seleccionar un mes!"; break;
	case "nonapproved": $new = "Esdeveniments que requerixen aprovació : "; break;
	case "nononapproved": $new = "No hi ha Esdeveniments que necessiten aprovació"; break;
	case "notitle": $new = "Has de posar-li un títol a l'esdeveniment"; break;
	case "noyear": $new = "Has de seleccionar un any!"; break;

	case "on": $new = "el"; break;
	case "Optional": $new = "Opcional"; break;
	case "or month": $new = "o mes"; break;
	case "or week": $new = "o setmana"; break;

	case "password": $new = "contrasenya"; break;
	case "Please choose the category you only want to view events for": $new = "Tria la categoria d'Esdeveniments que vols vore"; break;
	case "Popup Month": $new = "Obrir mes en una finestra xicoteta"; break ;
	case "Previous": $new = "Anterior"; break;			
	case "Previous day": $new = "Dia anterior"; break;
	case "Previous week": $new = "Setmana anterior"; break;

	case "Read more": $new = "llegir més"; break;
	case "reallydelcat": $new = "Estàs segur de que vols esborrar esta categoria? Tots els esdeveniments associats amb esta categoria seran esborrats permanentment!"; break;

	case "Repeat": $new = "Repetir"; break;
	case "results": $new = "resultats"; break;

	case "search": $new = "buscar"; break;
	case "Sort by": $new = "Ordenar per"; break ;
	case "Sort by date": $new = "Ordenar per data"; break ;
	case "Sort by events": $new = "Ordenar per Esdeveniment"; break ;
	case "Start Time": $new = "Hora d'inici"; break ;

	case "thankyou": $new = "Gràcies per afegir l'esdeveniment, apareixerà després de la seua aprovació."; break;
	case "thankyoupost": $new = "Gràcies per introduir un esdeveniment, ha sigut afegit."; break;
	case "till": $new = "fins"; break;
	case "Time added or updated": $new = "Hora afegida o actualitzada"; break ;
	case "timeout msg": $new = "Els canvis en una sessió caducada només tindran efecte en el pròxim login" ; break ;
	case "times every": $new = "vegades cada"; break;
	case "To": $new = "A"; break ;
	case "To delete category": $new = "Per esborrar categoria"; break ;
	case "Today": $new = "Hui"; break;
	case "Total": $new = "Total"; break;
	case "Total number of events for the month": $new = "Número total d'Esdeveniments en el mes"; break ;
	case "Total unapproved events for the month": $new = "Esdeveniments sense aprovar del mes" ; break;
	case "Two weeks": $new = "Dos setmanes" ; break;

	case "Update": $new = "Actualitzar"; break;
	case "Update Event": $new = "Actualitzar Esdeveniment"; break;
	case "Updating category": $new = "Actualitzant categoria"; break ;
	case "Updating event": $new = "Actualitzant esdeveniment"; break;
	case "Updating user": $new = "Actualitzant usuari"; break;
	case "Unapproved events": $new = "Esdeveniments sense aprovar"; break ;
	case "User": $new = "Usuari"; break ;
	case "User Calendar": $new = "Calendari d'Usuari"; break ;
	case "User description": $new = "Descripció d'usuari"; break ;	
	case "User Management": $new = "Administració d'Usuari"; break;
	case "User group": $new = "Grup d'usuaris"; break ;
	case "userdelok": $new = "Estàs segur de que vols esborrar este usuari?"; break;
	case "username": $new = "Nickname"; break;
	case "Username entered already exists. Please use another username.": $new = "Nom d'usuario ja existix, per favor usa un altre nom."; break;
	case "users": $new = "usuaris"; break;

	case "View": $new = "Vore"; break;
	case "View categories in year": $new = "Vore categories en any"; break ;
	case "View details or edit": $new = "Vore detalls o editar"; break ;
	case "View event": $new = "Ver evento"; break;
	case "View events under this category in year": $new = "Vore Esdeveniments baix esta categoria en any"; break ;
	case "View historical events before": $new = "Vore Esdeveniments històrics abans"; break ;
	case "View month": $new = "Vore mes"; break;
	case "View week": $new = "Vore setmana"; break;

	case "Web Calendar Admin Login": $new = "CalendariFlors Login d'Administrador"; break ;
	case "Web Calendar User Login": $new = "CalendariFlors Login d'Usuari"; break ;
	case "week number": $new = "setmana número"; break;
	case "Week starts": $new = "Setmana comença"; break;
	case "wronglogin": $new = "Nom d'usuari o contrasenya incorrectes!"; break;

	case "Year": $new = "Año"; break;
	case "Yes, delete event !": $new = "Sí, esborrar esdeveniment!"; break;
	case "Yes, delete it!": $new = "Sí, esborra'l!"; break;

	default: $new = "<b>".$msgin."</b> necessita ser traduït!";    break;

    }
    return $new;
}
?>