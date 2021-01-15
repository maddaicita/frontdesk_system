<?php
function translate($msgin){
    switch ($msgin) {
	case "About Calendarix": $new = "Despre Calendarix"; break ;		
	case "Add": $new = "Adauga"; break ;
	case "Add Category": $new = "Adauga categorie"; break;
	case "Add Event": $new = "Adauga Eveniment"; break;
	case "Add event": $new = "Adauga eveniment" ; break;
	case "Add new user": $new = "Adauga utilizator nou"; break;
	case "Adding category": $new = "Adaugare categorie"; break;
	case "Adding event": $new = "Adaugare eveniment" ; break ;
	case "Adding user": $new = "Adaugare utilizator"; break ;
	case "Administration": $new = "Administrare"; break;
	case "Administrator": $new = "Administrator"; break ;
	case "All categories": $new = "Toate categoriile"; break ;		
	case "Approval needed for posting of events.": $new = "Este necesara aprobarea pentru a posta evenimente."; break;  
	case "Approvals": $new = "Aprobari"; break ;
	case "Approve": $new = "Aproba"; break;
	case "Approving event": $new = "Aprobare eveniment"; break;
	
	case "Back": $new = "Inapoi"; break;
	case "Both passwords entered do not match": $new = "Parolele introduse nu se potrivesc"; break;	

	case "Calendar": $new = "Calendar"; break;
	case "Cancel": $new = "Anuleaza"; break ;
	case "Cannot delete current login user": $new = "Utilizatorul curent nu poate fi sters"; break ;   
	case "Cannot change current login user": $new = "Datele utilizatorului curent nu pot fi schimbate"; break;	
	case "Cannot have a category with blank name": $new = "Nu puteti avea o categorie fara nume"; break ;
	case "Categories": $new = "Categorii"; break;
	case "Category": $new = "Categorie"; break;
	case "Change": $new = "Schimbae"; break ;
	case "Change password/group": $new = "Schimba parola/grup"; break; 	// master obsolete?	
	case "Choose Category": $new = "Alege Categoria"; break;
	case "Close": $new = "Close"; break;
	case "Coming Events": $new = "Evenimente Viitoare"; break;			// 0.6.20050830
	case "Confirm delete?": $new = "Confirmati stergerea?" ; break ;			
	case "Confirm delete all historical events before": $new = "Confirmati stergerea evenimentelor care au trecut ?"; break ;
	case "confirmed events for today": $new = "evenimente confirmate pentru astazi"; break ;
	case "Confirm password": $new = "Confirma parola"; break; 		
	case "Copy Event": $new = "Copiaza Eveniment"; break ;				
	case "Current Week": $new = "Saptamana Curenta"; break;
	case "Current Month": $new = "Luna Curenta"; break;
	case "Current Year": $new = "Anul Curent"; break;		

	case "Date": $new = "Data"; break;
	case "Day": $new = "Ziua"; break;
	case "Delete all historical events listed": $new = "Sterge toate avenimentele trecute listate"; break;
	case "Delete category": $new = "Sterge categoria"; break;
	case "Delete event": $new = "Sterge eveniment"; break;
	case "Delete user": $new = "Sterge utilizator"; break;
	case "Deleting category": $new = "Stergere categorie"; break;
	case "Deleting event": $new = "Stergere eveniment"; break ;
	case "Deleting user": $new = "Stergere utilizator"; break ;
	case "disabled": $new = "Aceasta sectiune este dezactivata"; break;

	case "Edit category": $new = "Modifica categoria"; break;
	case "Edit event": $new = "Modifica eveniment"; break;
	case "Edit information": $new = "Modifica informatia"; break;	// master translate?
	case "Email": $new = "E-mail"; break;
	case "End Time": $new = "Terminare"; break ;
	case "Event": $new = "Eveniment"; break ;
	case "Event Category": $new = "Categorie Eveniment"; break;
	case "Event Description": $new = "Descriere Eveniment"; break;
	case "Event repeated": $new = "Eveniment repetat"; break;  
	case "Event Title": $new = "Titlu eveniment"; break;
	case "events": $new = "evenimente"; break;
	case "Events added will be posted immediately.": $new = "Evenimentele adaugate vor fi postate imediat."; break ;
	case "events awaiting approval": $new = "evenimente care asteapta aprobarea"; break ;
	case "Events before": $new = "Evenimente anterioare"; break ;
	case "events for": $new = "evenimente pentru"; break;
	case "Events for day": $new = "Evenimente zilnice"; break;
	case "events for whole calendar": $new = "evenimente pentru intregul calendar"; break;
	case "events for year": $new = "evenimente anuale"; break;
	case "Events from ": $new = "Evenimente de la  "; break;
	case "Events in category": $new = "Evenimente in categoria"; break;

	case "From": $new = "De la"; break ;
	case "Functions": $new = "Functii"; break ;	// master translate?

	case "Go to": $new = "Mergi la"; break;
	case "Go to day": $new = "Mergi la ziua"; break;
	case "Go to week": $new = "Mergi la spatamana"; break;

	case "Historical Items": $new = "Evenimente trecute"; break;

	case "Login": $new = "Intrare"; break;
	case "Login session time out in seconds": $new = "Timpul de autentificare in secunde"; break;
	case "Login session timeout": $new = "Timp de autentificare expirat"; break ;
	case "Logout": $new = "Iesire"; break;

	case "Menu": $new = "Meniu"; break;
	case "Month": $new = "Luna"; break;
	case "More info": $new = "Mai multe informatii"; break;

	case "Name": $new = "Nume"; break;			// master translate?
	case "Next": $new = "Urmatorul"; break;				
	case "Next day": $new = "Ziua urmatoare"; break;
	case "Next week": $new = "Saptamana urmatoare"; break;
	case "No categories yet": $new = "Inca nu sunt categorii"; break;
	case "No events": $new = "Niciun eveniment"; break;
	case "No Repeat": $new = "Fara repetare"; break;
	case "No results": $new = "Niciun rezultat"; break;
	case "No, go back!": $new = "Nu, mergi inapoi"; break;
	case "No.": $new = "Nu."; break;			// master translate?
	case "noadminapprove": $new = "Evenimentele postate de catre administrator nu au nevoie de aprobare"; break ;
	case "noapprove": $new = "Approval of events added by users not needed by administrator"; break ;
	case "nocat": $new = "Trebuie sa selectezi o categorie !"; break;
	case "noday": $new = "Trebuie sa selectezi o zi !"; break;
	case "nodescription": $new = "Trebuie sa introduci o descriere pentru eveniment !"; break;
	case "nomonth": $new = "Trebuie sa selectezi o luna !"; break;
	case "nonapproved": $new = "Evenimente care necesita aprobare : "; break;
	case "nononapproved": $new = "Momentan nu sunt evenimente care necesita aprobare"; break;
	case "notitle": $new = "Trebuie sa introduceti un titlu pentru eveniment !"; break;
	case "noyear": $new = "Trebuie sa selectati un an !"; break;

	case "on": $new = "on"; break;
	case "Optional": $new = "Optional"; break;
	case "or month": $new = "sau luna"; break;
	case "or week": $new = "sau saptamana"; break;

	case "password": $new = "parola"; break;
	case "Please choose the category you only want to view events for": $new = "Alegeti categoria pentru care vreti sa vedeti evenimentele"; break;  
	case "Popup Month": $new = "Fereastra Luna"; break ;
	case "Previous": $new = "Anteriorul"; break;			
	case "Previous day": $new = "Ziua anterioara"; break;
	case "Previous week": $new = "Saptamana anterioara"; break;

	case "Read more": $new = "Citeste mai mult"; break;
	case "reallydelcat": $new = "Eti sigur ca vrei sa stergi aceasta categorie? Toate evenimentele din aceasta categorie vor fi sterse definitv!"; break;
	case "Repeat": $new = "Repetare"; break;
	case "results": $new = "rezultate"; break;
	case "Role": $new = "Rol"; break;			// master translate?

	case "search": $new = "cauta"; break;
	case "Select": $new = "Selecteaza"; break;		// 0.7.20060401
	case "Sort by": $new = "Sorteaza dupa"; break ;
	case "Sort by date": $new = "Sorteaza dupa data"; break ;
	case "Sort by events": $new = "Sorteaza dupa eveniment"; break ;
	case "Start Time": $new = "Ora Incepere"; break ;

	case "thankyou": $new = "Multumesc pentru ca ai postat un eveniment, va aparea dupa aprobarea administratorului"; break;
	case "thankyoupost": $new = "Multumesc pentru ca ai introdus un eveniment, a fost postat deja."; break;
	case "till": $new = "pana"; break;
	case "Time added or updated": $new = "Ora cand a fost adaugat sau actualizat"; break ;
	case "timeout msg": $new = "Schimbarile survenite in sesiune vor intra in functiune la urmatoarea autentificare" ; break ;
	case "times every": $new = "ori la fiecare"; break;	
	case "To": $new = "catre"; break ;
	case "To delete category": $new = "Pentru a sterge o categorie"; break ;
	case "Today": $new = "Astazi"; break;
	case "Total": $new = "Total"; break;
	case "Total number of events for the month": $new = "Total evenimente pe luna"; break ;
	case "Total number of events for user": $new = "Total evenimente per utilizator"; break ;		
	case "Total unapproved events for the month": $new = "Total evenimente neaprobate pe luna" ; break;
	case "Two weeks": $new = "Two weeks" ; break;	

	case "Update": $new = "Actualizeaza"; break;
	case "Update Event": $new = "Actualizeaza eveniment"; break;
	case "Updating category": $new = "Actualizare categorie"; break ;
	case "Updating event": $new = "Actualizare eveniment"; break;
	case "Updating user": $new = "Actualizare utilizator"; break;			
	case "Unapproved events": $new = "Evenimente neaprobate"; break ;
	case "User": $new = "Utilizator"; break ;
	case "User Calendar": $new = "Calendar utilizator"; break ;
	case "User description": $new = "Descriere utilizator"; break ;		
	case "User group": $new = "Grup utilizatori"; break ;				
	case "User Management": $new = "Gestionare utilizatori"; break;
	case "userdelok": $new = "Esti sigur ca vrei sa stergi acest utilizator ?"; break;
	case "username": $new = "nume"; break;
	case "Username and passwords must be alpha-numeric and without spaces.": $new = "Numele si parola trebuie sa fie caractere litere sau cifre, fara spatii intre ele."; break; 	// version 0.4.20030731
	case "Username entered already exists. Please use another username.": $new = "Nume deja existent. Introdu alt nume."; break;
	case "users": $new = "utilizatori"; break;

	case "View": $new = "Arata"; break;
	case "View categories in year": $new = "Arata cagoriile pe an"; break ;
	case "View details or edit": $new = "Arata detalii sau modifica"; break ;
	case "View event": $new = "Arata eveniment"; break;
	case "View events of user": $new = "Arata evenimentele utilizatorului"; break;
	case "View events under this category in year": $new = "Arata evenimentele din aceasta categorie in anul"; break ;
	case "View historical events before": $new = "Arata evenimentele trecute inainte de"; break ;
	case "View month": $new = "Arata luna"; break;
	case "View week": $new = "Arata saptamana"; break;

	case "Web Calendar Admin Login": $new = "Calendarix Admin Autentificare"; break ;
	case "Web Calendar User Login": $new = "Calendarix Utilizator Autentificare"; break ;
	case "week number": $new = "numarul saptamanii"; break;
	case "Week starts": $new = "saptamana incepe"; break;
	case "wronglogin": $new = "Nume sau parola incorecte"; break;

	case "Year": $new = "An"; break;
	case "Yes": $new = "Da"; break;		// version 0.4.20030731
	case "Yes, delete event !": $new = "Da, sterge evenimentul !"; break;
	case "Yes, delete it!": $new = "Da, sterge-l!"; break;

	default: $new = "<b>".$msgin."</b> needs to be translated !";    break;
    }
    return $new;
}
?>