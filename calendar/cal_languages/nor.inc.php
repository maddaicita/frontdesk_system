<?php
function translate($msgin){

    switch ($msgin) {
	case "About Calendarix": $new = "About Calendarix"; break ;		// translate?
	case "Add": $new = "Legg til"; break ;
	case "Add Category": $new = "Legg til kategori"; break;
	case "Add Event": $new = "Legg til aktivitet"; break;
	case "Add event": $new = "Legg til aktivitet" ; break;
	case "Add new user": $new = "Legg til ny bruker"; break;
	case "Adding category": $new = "Legger til kategori"; break;
	case "Adding event": $new = "Legger til aktivitet" ; break ;
	case "Adding user": $new = "Legger til bruker"; break ;
	case "Administration": $new = "Administrasjon"; break;
	case "Administrator": $new = "Administrator"; break ;
	case "All categories": $new = "All categories"; break ;		// translate?
	case "Approval needed for posting of events.": $new = "Det er n&oslash;dvendig med godkjennelse for innlegging av aktiviteter."; break;  // translate?
	case "Approvals": $new = "Godkjenninger"; break ;
	case "Approve": $new = "Godkjenne"; break;
	case "Approving event": $new = "Godkjenner aktivitet"; break;
	
	case "Back": $new = "Tilbake"; break;
	case "Both passwords entered do not match": $new = "Passordene som ble angitt stemte ikke overens"; break;	

	case "Calendar": $new = "Kalender"; break;
	case "Cancel": $new = "Avbryt"; break ;
	case "Cannot delete current login user": $new = "Kan ikke slette n&aring;v&aelig;rende innlogget bruker"; break ;   
	case "Cannot change current login user": $new = "Kan ikke endre n&aring;v&aelig;rende innlogget bruker"; break;	
	case "Cannot have a category with blank name": $new = "Kan ikke ha en kategori uten navn"; break ;
	case "Categories": $new = "Kategorier"; break;
	case "Category": $new = "Kategori"; break;
	case "Change": $new = "Endre"; break ;
	case "Change password/group": $new = "Endre passord/gruppe"; break; 		
	case "Choose Category": $new = "Velge kategori"; break;
	case "Close": $new = "Lukk"; break;
	case "Confirm delete?": $new = "Confirm delete?" ; break ;			// translate?
	case "Confirm delete all historical events before": $new = "Bekreft sletting av alle historiske aktiviteter f&oslash;r"; break ;
	case "confirmed events for today": $new = "godkjente aktiviteter for idag"; break ;
	case "Confirm password": $new = "Bekreft passord"; break; 		
	case "Copy Event": $new = "Kopiere aktivitet"; break ;				
	case "Current Week": $new = "Denne uken"; break;
	case "Current Month": $new = "Denne m&aring;neden"; break;
	case "Current Year": $new = "Dette &aring;ret"; break;		// translate?

	case "Date": $new = "Dato"; break;
	case "Day": $new = "Dag"; break;
	case "Delete all historical events listed": $new = "Slette alle historiske aktiviteter som er oppgitt"; break;
	case "Delete category": $new = "Slette kategori"; break;
	case "Delete event": $new = "Slette aktivitet"; break;
	case "Delete user": $new = "Slette bruker"; break;
	case "Deleting category": $new = "Sletter kategori"; break;
	case "Deleting event": $new = "Sletter aktivitet"; break ;
	case "Deleting user": $new = "Sletter bruker"; break ;
	case "disabled": $new = "Denne seksjonen er sl&aring;tt av"; break;

	case "Edit category": $new = "Redigere kategori"; break;
	case "Edit event": $new = "Redigere aktivitet"; break;
	case "Email": $new = "E-post"; break;
	case "End Time": $new = "Slutt-tidspunkt"; break ;
	case "Event": $new = "Aktivitet"; break ;
	case "Event Category": $new = "Aktivitetskategori"; break;
	case "Event Description": $new = "Aktivitetsbeskrivelse"; break;
	case "Event repeated": $new = "Gjentatt aktivitet"; break;  
	case "Event Title": $new = "Aktivitetstittel"; break;
	case "events": $new = "aktiviteter"; break;
	case "Events added will be posted immediately.": $new = "Aktiviteter som registreres vil bli lagt inn umiddelbart."; break ;
	case "events awaiting approval": $new = "aktiviteter som venter godkjennelse"; break ;
	case "Events before": $new = "Aktiviteter f&oslash;r"; break ;
	case "events for": $new = "aktiviteter for"; break;
	case "Events for day": $new = "Aktiviteter for dagen"; break;
	case "events for whole calendar": $new = "aktiviteter for hele kalenderen"; break;
	case "events for year": $new = "aktiviteter for &aring;ret"; break;
	case "Events from ": $new = "Aktiviteter fra "; break;
	case "Events in category": $new = "Aktiviteter i kategorien"; break;

	case "From": $new = "Fra"; break ;

	case "Go to": $new = "G&aring; til"; break;
	case "Go to day": $new = "G&aring; til flg. dag"; break;
	case "Go to week": $new = "G&aring; til uke"; break;

	case "Historical Items": $new = "Historiske enheter"; break;

	case "Login": $new = "Logg inn"; break;
	case "Login session time out in seconds": $new = "Innloggingssesjon avbrytes om noen sekunder"; break;
	case "Login session timeout": $new = "Innloggingssesjon avbrytes"; break ;
	case "Logout": $new = "Logg ut"; break;

	case "Menu": $new = "Meny"; break;
	case "Month": $new = "M&aring;ned"; break;
	case "More info": $new = "Mer info"; break;

	case "Next": $new = "Neste"; break;				
	case "Next day": $new = "Neste dag"; break;
	case "Next week": $new = "Neste uke"; break;
	case "No categories yet": $new = "Ingen kategorier enda"; break;
	case "No events": $new = "Ingen aktiviteter"; break;
	case "No Repeat": $new = "Ingen gjentagelse"; break;
	case "No results": $new = "Ingen resultater"; break;
	case "No, go back!": $new = "Nei, g&aring; tilbake!"; break;
	case "noadminapprove": $new = "Godkjennelse av aktiviteter lagt inn administratorer er ikke n&oslash;dvendig"; break ;
	case "noapprove": $new = "Godkjennelse av aktiviteter lagt inn av brukere er ikke n&oslash;dvendig"; break ;
	case "nocat": $new = "Du m&aring; velge en kategori !"; break;
	case "noday": $new = "Du m&aring; velge en dag !"; break;
	case "nodescription": $new = "Du m&aring; legge inn en aktivitetsbeskrivelse !"; break;
	case "nomonth": $new = "Du m&aring; velge en m&aring;ned !"; break;
	case "nonapproved": $new = "Aktiviteter som venter godkjennelse : "; break;
	case "nononapproved": $new = "Det er ingen aktiviteter som trenger godkjennelse n&aring;"; break;
	case "notitle": $new = "Du m&aring; legge inn en aktivitetstittel !"; break;
	case "noyear": $new = "Du m&aring; velge et &aring;r !"; break;

	case "on": $new = "on"; break;
	case "Optional": $new = "Valgfri"; break;
	case "or month": $new = "eller m&aring;ned"; break;
	case "or week": $new = "eller uke"; break;

	case "password": $new = "passord"; break;
	case "Please choose the category you only want to view events for": $new = "Please choose the category you only want to view events for"; break;  // translate?
	case "Popup Month": $new = "Popup m&aring;ned"; break ;
	case "Previous": $new = "Forrige"; break;			
	case "Previous day": $new = "Forrige dag"; break;
	case "Previous week": $new = "Forrige uke"; break;

	case "Read more": $new = "Les mer"; break;
	case "reallydelcat": $new = "Er du sikker p&aring; at du vil slette denne kategorien? Alle aktiviteter tilknyttet kategorien vil bli slettet!"; break;
	case "Repeat": $new = "Gjenta"; break;
	case "results": $new = "resultater"; break;

	case "search": $new = "s&oslash;k"; break;
	case "Sort by": $new = "Sorteres etter"; break ;
	case "Sort by date": $new = "Sorteres etter dato"; break ;
	case "Sort by events": $new = "Sorteres etter aktiviteter"; break ;
	case "Start Time": $new = "Start-tidspunkt"; break ;

	case "thankyou": $new = "Takk for at du la inn en aktivitet. Den vil bli synlig s&aring; snart den er godkjent."; break;
	case "thankyoupost": $new = "Takk for at du la inn en aktivitet. Den er lagt inn."; break;
	case "till": $new = "til"; break;
	case "Time added or updated": $new = "Tidspunkt lagt inn eller oppdatert"; break ;
	case "timeout msg": $new = "Endringer til sesjonslengde f&oslash;r avbrudd (timeout) vil gjelde fra og med neste innlogging" ; break ;
	case "times every": $new = "ganger hver"; break;	
	case "To": $new = "Til"; break ;
	case "To delete category": $new = "For &aring; slette kategori"; break ;
	case "Today": $new = "Idag"; break;
	case "Total": $new = "Totalt"; break;
	case "Total number of events for the month": $new = "Totalt antall aktiviteter for m&aring;neden"; break ;
	case "Total number of events for user": $new = "Total antall aktiviteter for bruker"; break ;		
	case "Total unapproved events for the month": $new = "Totalt antall ikke godkjente aktiviteter for m&aring;neden" ; break;
	case "Two weeks": $new = "To uker" ; break;	// translate?

	case "Update": $new = "Oppdatere"; break;
	case "Update Event": $new = "Oppdatere aktivitet"; break;
	case "Updating category": $new = "Oppdaterer kategori"; break ;
	case "Updating event": $new = "Oppdaterer aktivitet"; break;
	case "Updating user": $new = "Oppdaterer bruker"; break;			
	case "Unapproved events": $new = "Ikke godkjente aktiviteter"; break ;
	case "User": $new = "Bruker"; break ;
	case "User Calendar": $new = "Brukerkalender"; break ;
	case "User description": $new = "User description"; break ;		// translate?
	case "User group": $new = "Brukergruppe"; break ;				
	case "User Management": $new = "Brukeradministrasjon"; break;
	case "userdelok": $new = "Er du sikker p&aring; at du vil slette denne brukeren ?"; break;
	case "username": $new = "brukernavn"; break;
	case "Username entered already exists. Please use another username.": $new = "Brukernavnet finnes allerede. Vennligst velg annet brukernavn."; break;
	case "users": $new = "brukere"; break;

	case "View": $new = "Vis"; break;
	case "View categories in year": $new = "Vis kategorier for &aring;r"; break ;
	case "View details or edit": $new = "Vise detaljer eller redigere"; break ;
	case "View event": $new = "Vis aktivitet"; break;
	case "View events of user": $new = "Vis aktiviteter for bruker"; break;
	case "View events under this category in year": $new = "Vis aktiviteter under denne kategorien for &aring;r"; break ;
	case "View historical events before": $new = "Vis historiske aktiviteter f&oslash;r"; break ;
	case "View month": $new = "Vis m&aring;ned"; break;
	case "View week": $new = "Vis uke"; break;

	case "Web Calendar Admin Login": $new = "frisk.asker.no - Calendarix Admin Login"; break ;
	case "Web Calendar User Login": $new = "frisk.asker.no - Calendarix User Login"; break ;
	case "week number": $new = "uke nummer"; break;
	case "Week starts": $new = "Uken begynner"; break;
	case "wronglogin": $new = "Ugyldig brukernavn eller passord"; break;

	case "Year": $new = "&Aring;r"; break;
	case "Yes, delete event !": $new = "Ja, slett aktivitet !"; break;
	case "Yes, delete it!": $new = "Ja, slett den!"; break;

	default: $new = "<b>".$msgin."</b> m&aring; oversettes !";    break;

    }
    return $new;
}
?>