<?php
function translate($msgin){

    switch ($msgin) {

	case "1st": $new = "1."; break ;		
	case "2nd": $new = "2."; break ;		
	case "3rd": $new = "3."; break ;		
	case "4th": $new = "4."; break ;		

	case "About Calendarix": $new = "Info zu Calendarix"; break ;		
	case "Account": $new = "Benutzerkonto" ; break;	
	case "Add": $new = "Eintragen"; break ;
	case "Add Category": $new = "Neue Kategorie aufnehmen"; break;
	case "Add Event": $new = "Neuen Termin eintragen"; break;
	case "Add event": $new = "Termin eintragen" ; break;
	case "Add Holidays": $new = "Feiertag(e) eintragen" ; break;	
	case "Add new user": $new = "Neuen Benutzer aufnehmen"; break;
	case "Adding": $new = "Aufnehmen"; break;  
	case "Adding category": $new = "Neue Kategorie aufnehmen"; break;
	case "Adding event": $new = "Neuen Termin eintragen" ; break ;
	case "Adding user": $new = "Neuen Benutzer aufnehmen"; break ;
	case "Address": $new = "Addressd"; break ;			
	case "Administration": $new = "Verwaltung"; break;
	case "Administrator": $new = "Administrator"; break ;
	case "All categories": $new = "Alle Kategorien"; break ;		
	case "Allowed search in User Calendar": $new = "Erlaubte Suche im Kalender"; break ; 
	case "Allowed Views in User Calendar": $new = "Erlaubte Ansicht im Kalender"; break ;	
	case "all repeated": $new = "Alle Wiederholungen"; break;	// 1.2.20030831
	case "and": $new = "und"; break ;	
	case "Approval needed for posting of events.": $new = "Bestätigung für Eintrag von Termin nötig!"; break;  
	case "Approvals": $new = "Bestätigungen"; break ;
	case "Approve": $new = "Bestätigen"; break;
	case "Approving event": $new = "Termin bestätigen"; break;
	case "Apply": $new = "Übernehmen"; break;
	
	case "Back": $new = "zurück"; break;
	case "between": $new = "zwischen"; break;				
	case "Both passwords entered do not match": $new = "Passworte unterschiedlich!"; break;	

	case "Calendar": $new = "Kalender"; break;
	case "Calendar Access": $new = "Kalenderzugriff"; break;		
	case "Calendar Name": $new = "Kalendername"; break;		
	case "Cancel": $new = "Abbrechen"; break ;
	case "Cannot delete current login user": $new = "Kann angemeldeten Benutzer nicht löschen!"; break ;   
	case "Cannot change current login user": $new = "Kann angemeldeten Benutzer nicht ändern!"; break;	
	case "Cannot have a category with blank name": $new = "Kategoriename darf nicht leer sein!"; break ;
	case "Categories": $new = "Kategorien"; break;
	case "Category": $new = "Kategorie"; break;
	case "Category color": $new = "Farbe"; break;		// 1.3.20040131
	case "Change": $new = "Ändern"; break ;
	case "Change password": $new = "Passwort ändern"; break; 		
	case "Change password/group": $new = "Passwort/Gruppe ändern"; break; 		
	case "Choose Category": $new = "Kategorie auswählen"; break;
	case "Click to select the color": $new = "Klicken um Farbe zu definieren" ; break ;	
	case "Close": $new = "Schliessen"; break;
	case "Color": $new = "Farbe" ; break ;			// 1.3.20040131
	case "Color Picker": $new = "Farbauswahl" ; break ;			
	case "Company Name": $new = "Firmenname" ; break ;			
	case "Confirm delete?": $new = "Löschen bestätigen?" ; break ;			
	case "Confirm delete all historical events before": $new = "Bestätigung zum Löschen aller Termine vor"; break ;
	case "confirmed events for today": $new = "Bestätigte Termine für heute"; break ;
	case "Confirm password": $new = "Passwort bestätigen"; break; 		
	case "Copy Event": $new = "Termin kopieren"; break ;				
	case "Currency": $new = "Währung" ; break ;			// 1.1.20030531
	case "Current Color": $new = "Aktuelle Farbe" ; break ;			
	case "Current Week": $new = "Diese Woche"; break;
	case "Current Month": $new = "Dieser Monat"; break;
	case "Current Year": $new = "Dieses Jahr"; break;
	case "Current Set": $new = "Derzeitige Einstellungen"; break;		

	case "Date/Time Configuration": $new = "Datum/Zeit Konfiguration"; break;		
	case "Date": $new = "Datum"; break;
	case "Day": $new = "Tag"; break;
	case "Day/Week/Listing View": $new = "Tag/Woche/Listen-Ansicht"; break;		
	case "Default": $new = "Standard"; break;			// 1.3.20040615
	case "Delete": $new = "Löschen"; break;		
	case "Delete all historical events listed": $new = "Alle vergangenen Termine löschen"; break;
	case "Delete category": $new = "Kategorie löschen"; break;
	case "Delete event": $new = "Termin löschen"; break;
	case "Delete user": $new = "Benutzer löschen"; break;
	case "Deleting": $new = "Löschvorgang"; break;  
	case "Deleting category": $new = "Kategorie löschen"; break;
	case "Deleting event": $new = "Termin löschen"; break ;
	case "Deleting events of user": $new = "Termine löschen von"; break ;	
	case "Deleting user": $new = "Benutzer löschen"; break ;
	case "deluserevok": $new = "Alle Termine löschen von?"; break ;		
	case "Description": $new = "Beschreibung"; break;		
	case "Details": $new = "Details"; break;				
	case "disabled": $new = "Dieser Bereich wurde deaktiviert"; break;
	case "Display Areas": $new = "Bereiche anzeigen"; break;				
	case "Display Settings": $new = "Anzeige"; break;
	case "Deactivate": $new = "Deaktivieren"; break;		

	case "Edit": $new = "Bearbeiten"; break;		
	case "Edit category": $new = "Kategorie bearbeiten"; break;
	case "Edit event": $new = "Termin bearbeiten"; break;
	case "Edit Holidays": $new = "Feiertage bearbeiten" ; break;	
	case "Edit information": $new = "Information bearbeiten"; break;	
	case "Email": $new = "Email"; break;
	case "End Time": $new = "Ende"; break ;
	case "Event": $new = "Termin"; break ;
	case "Event Category": $new = "Termin-Kategorie"; break;
	case "event entry starts here": $new = "Hier beginnt die Eintragung des Termins"; break;	
	case "Event Description": $new = "Beschreibung des Termins"; break;
	case "Event Display": $new = "Anzeige des Termins"; break;		
	case "Event repeated": $new = "wiederholtes Termin"; break;  
	case "Event Title": $new = "Überschrift des Termins"; break;
	case "events": $new = "Termine"; break;
	case "Events added will be posted immediately.": $new = "Eingetragene Termine werden sofort gespeichert."; break ;
	case "events awaiting approval": $new = "Termine, die noch bestätigt werden müssen"; break ;
	case "Events before": $new = "Termine vor"; break ;
	case "events for": $new = "Termine für"; break;
	case "Events for day": $new = "Termine am"; break;
	case "events for whole calendar": $new = "Termine für den ganzen Kalender"; break;
	case "events for year": $new = "Termine im Jahr"; break;
	case "Events from ": $new = "Termine von "; break;
	case "Events in category": $new = "Termine der Kategorie"; break;
	case "every": $new = "jede(n)"; break ;		
	case "Every year": $new = "Jedes Jahr"; break ;		
	case "Everyone": $new = "Jeder"; break;	// 1.3.20040615
	case "Export Style Sheet": $new = "Export Style Sheet"; break;
	case "Event Borders": $new = "Rahmen - Termine"; break;
    case "Export": $new = "Export"; break;

	case "Fee": $new = "Gebühr"; break;			// 1.1.20030531
	case "Fee is not enabled": $new = "Gebühr ist deaktiviert"; break;	// 1.1.20030531
	case "Footer Text": $new = "Fußzeile"; break;			
	case "From": $new = "Von"; break ;
	case "from": $new = "von"; break ;		
	case "Functions": $new = "Funktionen"; break ;
	case "Font": $new = "Schriftfarbe"; break ;
	case "Font Family": $new = "Schriftart"; break ;
	case "Font Size": $new = "Schriftgrad"; break ;
	case "Font Style": $new = "Schriftstyle"; break ;
	case "Font Weight": $new = "Schriftschnitt"; break ;
	case "Form Objects": $new = "Eingabefelder"; break ;
	
	case "Text Align": $new = "Textausrichtung"; break ;
	case "Text Decoration": $new = "Text Decoration	"; break ;	

	case "General Settings": $new = "Allgemein"; break ;	
	case "Go to": $new = "Gehe zu"; break;
	case "Go to day": $new = "Gehe zu Tag"; break;
	case "Go to week": $new = "Gehe zu Woche"; break;
	case "Group": $new = "Gruppe"; break;	// 1.3.20040615

	case "Highlight Colors": $new = "Farbe zum Hervorheben"; break;  
	case "Historical Items": $new = "Vergangene Termine"; break;
	case "Holidays": $new = "Feiertage"; break;	
	case "Holiday Text": $new = "Feiertage Text"; break;		

	case "invaliddates": $new = "Bitte echte Daten eingeben!"; break;  // 1.2.20030831	
    case "Include Files": $new = "enthaltene Dateien"; break ;	
	 
	case "last": $new = "lezte"; break ;		
	case "leave blank if default font color is used": $new = "Leer lassen, wenn Standardfarbe verwendet werden soll!"; break;		// 1.3.20040131
	case "Legend": $new = "Legende"; break;		// 1.3.20040131
	case "Login": $new = "Login"; break;
	case "Login session time out in seconds": $new = "Login session time out in seconds"; break;
	case "Login session timeout": $new = "Loginzeit abgelaufen"; break ;
	case "Logout": $new = "Logout"; break;
	case "Listing Blocks": $new = "Aufzählungsbereich"; break;

	case "Mail Configuration": $new = "Mail Konfiguration"; break;	
	case "Menu": $new = "Menü"; break;
	case "Menus and Titles": $new = "Menüs und Überschriften"; break;		
	case "Mini-Calendar": $new = "Mini-Kalender"; break;		// 1.3.20040131
	case "Month": $new = "Monat"; break ;		
	case "Month View": $new = "Monatsansicht"; break ;		
	case "Month View Text": $new = "Text für Monatsansicht"; break;	
	case "More info": $new = "Mehr Informationen"; break;

	case "Name": $new = "Name"; break;			
	case "Next": $new = "Nächste"; break;				
	case "Next day": $new = "Nächster Tag"; break;
	case "Next week": $new = "Nächste Woche"; break;
	case "No": $new = "Nein"; break;	
	case "No categories yet": $new = "Noch keine Kategorien definiert"; break;
	case "No events": $new = "Keine Termine"; break;
	case "No fees": $new = "Keine Gebühren"; break;	// 1.1.20030531
	case "No Repeat": $new = "Keine Wiederholungen"; break;
	case "No results": $new = "Keine Ergebnisse"; break;
	case "Notify": $new = "Benachrichtigen"; break;	
	case "No, go back!": $new = "Nein, bitte zurück!"; break;
	case "No.": $new = "Nr."; break;			
	case "noadminapprove": $new = "Bestätigung für Termine nicht nötig"; break ;
	case "noapprove": $new = "Bestätigung für Termine nicht nötig"; break ;
	case "nocat": $new = "Bitte eine Kategorie auswählen!"; break;
	case "noday": $new = "Bitte ein Datum angeben!"; break;
	case "nodescription": $new = "Bitte Beschreibung eingeben!"; break;
	case "nofee": $new = "Bitte gültigen Betrag für eine Gebühr angeben!"; break;	// 1.1.20030531
	case "nomonth": $new = "Bitte Monat angeben!"; break;
	case "noweek": $new = "Bitte Monat angeben!"; break;	
	case "nonapproved": $new = "Termine, die bestätigt werden müssen: "; break;
	case "nononapproved": $new = "Momentan müssen keine Termine bestätigt werden"; break;
	case "notitle": $new = "Bitte Überschrift eingeben!"; break;
	case "noyear": $new = "Bitte Jahr angeben!"; break;

	case "on": $new = "an"; break;
	case "Once on": $new = "Sobald angegeben"; break;			
	case "only this": $new = "nur dies(e/er)"; break;	// 1.2.20030831
	case "Options": $new = "Optionen"; break;			
	case "Optional": $new = "Optional"; break;
	case "or": $new = "oder"; break;	
	case "or month": $new = "oder Monat"; break;
	case "or week": $new = "oder Woche"; break;
	case "Other Text": $new = "Anderer Text"; break;			

	case "Page Body": $new = "Seiteninhalt"; break ; 	
	case "password": $new = "Passwort"; break;
	case "Please choose the category you only want to view events for": $new = "Bitte Kategorie zur Anzeige ihrer Ereignisse auswählen"; break;  
	case "Personal": $new = "Persönlich"; break;		// 1.3.20040615
	case "Popup Month": $new = "Popup Monat"; break ;
	case "Popup Settings": $new = "Popup Einstellungen"; break ; 	
	case "Popup Window Text": $new = "Popup Window Text"; break ;
	case "Previous": $new = "Letzte(r)"; break;			
	case "Previous day": $new = "Letzter Tag"; break;
	case "Previous week": $new = "Letzte Woche"; break;
	case "Print": $new = "Drucken"; break;			// 1.3.20040131
	case "Print Preview": $new = "Druckvorschau"; break;	// 1.3.20040131
	case "Private": $new = "Privat"; break;			// 1.3.20040615

	case "Read more": $new = "Weitere Informationen"; break;
	case "reallydelcat": $new = "Wollen Sie die Kategorie wirklich löschen? Alle Termine in dieser Kategorie werden endgültig gelöscht!"; break;
	case "records with fees": $new = "Termine mit Gebühren"; break;	// 1.1.20030531
	case "Refresh": $new = "Standard wiederherstellen"; break;
	case "Repeat": $new = "Wiederholen"; break;
	case "Repeat every year": $new = "Jedes Jahr wiederholen"; break;  
	case "repeat every year on": $new = "Jedes Jahr wiederholen am"; break;  
	case "results": $new = "Ergebnisse"; break;
	case "Role": $new = "Rolle"; break;			
	case "Row Listings": $new = "Liste"; break;			

	case "Scope": $new = "Übersicht"; break;	// 1.3.20040615
	case "search": $new = "suchen"; break;
	case "Search Page Text": $new = "Text auf Seite suchen"; break;			
	case "Select": $new = "Auswahl"; break;			
	case "Select All": $new = "Alle auswählen"; break;			
	case "Select users": $new = "Benutzer auswählen"; break;			
	case "Sort by": $new = "Sortieren nach"; break ;
	case "Sort by date": $new = "Nach Datum sortieren"; break ;
	case "Sort by events": $new = "Nach Terminen sortieren"; break ;
	case "Start Time": $new = "Anfangszeit"; break ;
	case "style sheets will override these settings": $new = "Style Sheets haben Vorrang!"; break ; 
	case "Sum": $new = "Summe"; break ;			// 1.1.20030531
    case "Settings": $new = "Einstellungen"; break;

	case "thankyou": $new = "Danke! Der Termin wird nach der Bestätigung eingetragen"; break;
	case "thankyoupost": $new = "Danke! Der Termin wurde eingetragen."; break;
	case "till": $new = "bis"; break;
	case "Time added or updated": $new = "Zeit wurde eingetragen"; break ;
	case "timeout msg": $new = "Änderungen werden erst nach Wiederaufruf wirksam" ; break ;
	case "times every": $new = "mal jede(s/n)"; break;	
	case "times": $new = "mal"; break;	
	case "Title": $new = "Überschrift"; break;	
	case "To": $new = "Bis"; break ;
	case "To delete category": $new = "Zum Löschen einer Kategorie"; break ;
	case "Today": $new = "Heute"; break;
	case "Total": $new = "Gesamt"; break;
	case "Total fee": $new = "Gesamtgebühren"; break;		// 1.1.20030531
	case "Total number of events for the month": $new = "Anzahl Termine im Monat"; break ;
	case "Total number of events for user": $new = "Anzahl Termine für Benutzer"; break ;		
	case "Total records parsed": $new = "Anzahl der gelesenen Termine"; break;		// 1.1.20030531
	case "Total unapproved events for the month": $new = "Anzahl unbestätigter Termine im Monat" ; break;
	case "Two weeks": $new = "Zwei Wochen" ; break;	

	case "Text Settings": $new = "Text"; break;	
	case "thankyou": $new = "Danke! Der Termin wird nach der Bestätigung eingetragen"; break;
	case "thankyoupost": $new = "Danke! Der Termin wurde eingetragen."; break;
	case "till": $new = "bis"; break;
	case "Time added or updated": $new = "Zeit wurde eingetragen"; break ;
	case "timeout msg": $new = "Änderungen werden erst nach Wiederaufruf wirksam" ; break ;
	case "times every": $new = "mal jede(s/n)"; break;	
	case "times": $new = "mal"; break;	
	case "Title": $new = "Überschrift"; break;	
	case "To": $new = "Bis"; break ;
	case "To delete category": $new = "Zum Löschen einer Kategorie"; break ;
	case "Today": $new = "Heute"; break;
	case "Total": $new = "Gesamt"; break;
	case "Total fee": $new = "Gesamtgebühren"; break;		// 1.1.20030531
	case "Total number of events for the month": $new = "Anzahl Termine im Monat"; break ;
	case "Total number of events for user": $new = "Anzahl Termine für Benutzer"; break ;		
	case "Total records parsed": $new = "Anzahl der gelesenen Termine"; break;		// 1.1.20030531
	case "Total unapproved events for the month": $new = "Anzahl unbestätigter Termine im Monat" ; break;
	case "Two weeks": $new = "Zwei Wochen" ; break;	

	case "Unknown": $new = "Unbekannt"; break;		
	case "Update": $new = "Aktualisierung"; break;
	case "Update Event": $new = "Termin aktualisieren"; break;  
	case "Update All Repeated Events": $new = "Wiederholte Termine aktualisieren"; break;  // 1.2.20030831
	case "Updating": $new = "Aktualisierung"; break;		
	case "Updating category": $new = "Aktualisierung der Kategorie"; break ;
	case "Updating event": $new = "Aktualisierung des Termins"; break;
	case "Updating user": $new = "Aktualisierung des Benutzers"; break;			
	case "Unapproved events": $new = "Unbestätigte Termine"; break ;
	case "Unselect All": $new = "Auswahl für ALLE aufheben"; break;			
	case "User": $new = "Benutzer"; break ;
	case "User Calendar": $new = "Kalender"; break ;
	case "User description": $new = "Benutzerbeschreibung"; break ;		
	case "User does not exist but events belonging to user exists": $new = "Benutzer existiert nicht, aber Termine von ihm"; break; 	
	case "User group": $new = "Benutzergruppe"; break ;				
	case "User List": $new = "Benutzerliste"; break;		
	case "User Management": $new = "Verwaltung der Benutzerdaten"; break;
	case "userdelok": $new = "Sind Sie sicher, dass Sie diesen Benutzer löschen wollen?"; break;
	case "username": $new = "Benutzername"; break;
	case "Username entered already exists. Please use another username.": $new = "Benutzername schon vergeben. Bitte geben Sie einen anderen Benutzernamen ein!"; break;
	case "users": $new = "Benutzer"; break;
	case "Using Stylesheet": $new = "Benutzen eines Stylesheets"; break;
	case "under category": $new = "Unterkategorie von"; break;
	  

	case "Value": $new = "Wert"; break ;				
	case "Variable": $new = "Variable"; break ;				
	case "View": $new = "Anzeige"; break;
	case "View categories in year": $new = "Zeige Kategorien im Jahr an"; break ;
	case "View details or edit": $new = "Details anzeigen oder bearbeiten"; break ;
	case "View event": $new = "Termin anzeigen"; break;
	case "View events of user": $new = "Termine des Benutzers anzeigen"; break;
	case "View events under this category in year": $new = "Termine dieser Kategorie fürs Jahr anzeigen"; break ;
	case "View historical events before": $new = "Frühere Termine anzeigen"; break ;
	case "View month": $new = "Monat anzeigen"; break;
	case "View week": $new = "Woche anzeigen"; break;

	case "Web Calendar Admin Login": $new = "Calendarix Admin Login"; break ;
	case "Web Calendar User Login": $new = "Calendarix Benutzer Login"; break ;
	case "Website": $new = "Website"; break ;				
	case "Week": $new = "Woche"; break ;				
	case "week": $new = "Woche"; break ;				
	case "week number": $new = "KW"; break;
	case "week on": $new = "Woche am"; break ;				
	case "Week starts": $new = "Wochenbeginn"; break;
	case "wronglogin": $new = "Benutzername oder Passwort falsch"; break;

	case "Year": $new = "Jahr"; break;
	case "Yes": $new = "Ja"; break;	
	case "Yes, delete event !": $new = "Ja, Ereignis löschen!"; break;
	case "Yes, delete it!": $new = "Ja, löschen!"; break;

	default: $new = "<b>".$msgin."</b> muss noch übersetzt werden!";    break;

    }
    return $new;
}
?>