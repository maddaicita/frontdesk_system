<?php
function translate($msgin){

    switch ($msgin) {
	case "About Calendarix": $new = "About Calendarix"; break ;		// translate?
	case "Add": $new = "Dodaj"; break ;
	case "Add Category": $new = "Dodaj kategorijo"; break;
	case "Add Event": $new = "Dodaj Dogodek"; break;
	case "Add event": $new = "Dodaj dogodek" ; break;
	case "Add new user": $new = "Dodaj novega uporabnika"; break;
	case "Adding category": $new = "Dodajanje kategorije"; break;
	case "Adding event": $new = "Dodajanje dogodka" ; break ;
	case "Adding user": $new = "Dodajanje uporabnika"; break ;
	case "Administration": $new = "Administracija"; break;
	case "Administrator": $new = "Administrator"; break ;
	case "All categories": $new = "All categories"; break ;		// translate?
	case "Approval needed for posting of events.": $new = "Potrebno je odobrenje za pošiljanje dogodka."; break;  
	case "Approvals": $new = "Odobrenja"; break ;
	case "Approve": $new = "Odobreno"; break;
	case "Approving event": $new = "Odobren dogodek"; break;
	
	case "Back": $new = "Nazaj"; break;
	case "Both passwords entered do not match": $new = "Obe vpisani gesli se ne ujemata"; break;	

	case "Calendar": $new = "Kolendar"; break;
	case "Cancel": $new = "Preklièi"; break ;
	case "Cannot delete current login user": $new = "Ne morem brisati trenutnega uporabnika"; break ;   
	case "Cannot change current login user": $new = "Ne morem spremeniti trenutnega uporabnika"; break;	
	case "Cannot have a category with blank name": $new = "Kategorija mora biti vpisana"; break ;
	case "Categories": $new = "Kategorije"; break;
	case "Category": $new = "Kategorija"; break;
	case "Change": $new = "Spremeni"; break ;
	case "Change password/group": $new = "Spremeni geslo/skupino"; break; 		
	case "Choose Category": $new = "Izberi kategorijo"; break;
	case "Close": $new = "Zapri"; break;
	case "Confirm delete?": $new = "Confirm delete?" ; break ;			// translate?
	case "Confirm delete all historical events before": $new = "Potrjujem brisanje vseh starih dogodkov"; break ;
	case "confirmed events for today": $new = "potrjeni dogodki za danes"; break ;
	case "Confirm password": $new = "Potrdi geslo"; break; 		
	case "Copy Event": $new = "Kopiraj dogodek"; break ;				
	case "Current Week": $new = "Trenutni teden"; break;
	case "Current Month": $new = "Trenutni mesec"; break;
	case "Current Year": $new = "Trenutno leto"; break;		// translate?

	case "Date": $new = "Datum"; break;
	case "Day": $new = "Dan"; break;
	case "Delete all historical events listed": $new = "Brisanje vseh stari dogodkov na spisku"; break;
	case "Delete category": $new = "Briši kategorijo"; break;
	case "Delete event": $new = "Briši dogodek"; break;
	case "Delete user": $new = "Briši uporabnika"; break;
	case "Deleting category": $new = "Briši kategorijo"; break;
	case "Deleting event": $new = "Briši dogodek"; break ;
	case "Deleting user": $new = "Brisanje uporabnika"; break ;
	case "disabled": $new = "Ta del je izklopljen"; break;

	case "Edit category": $new = "Uredi kategorijo"; break;
	case "Edit event": $new = "Uredi dogodek"; break;
	case "Email": $new = "E-mail"; break;
	case "End Time": $new = "Konèni èas"; break ;
	case "Event": $new = "Dogodek"; break ;
	case "Event Category": $new = "Kategorija dogodkov"; break;
	case "Event Description": $new = "Opis dogodka"; break;
	case "Event repeated": $new = "Dogodek ponovljen"; break;  
	case "Event Title": $new = "Naslov dogodka"; break;
	case "events": $new = "dogodki"; break;
	case "Events added will be posted immediately.": $new = "Dodani dogodki bodo poslani takoj."; break ;
	case "events awaiting approval": $new = "odobrenje prièakovanih dogodkov"; break ;
	case "Events before": $new = "Dogodki pred"; break ;
	case "events for": $new = "dogodki za"; break;
	case "Events for day": $new = "Dogodki za dan"; break;
	case "events for whole calendar": $new = "dogodki za ves kolendar"; break;
	case "events for year": $new = "dogodki za celo leto"; break;
	case "Events from ": $new = "Dogodki iz "; break;
	case "Events in category": $new = "Dogodki v kategoriji"; break;

	case "From": $new = "Od"; break ;

	case "Go to": $new = "Pojdi na"; break;
	case "Go to day": $new = "Pojdi na dan"; break;
	case "Go to week": $new = "Pojdi na teden"; break;

	case "Historical Items": $new = "Zgodovina"; break;

	case "Login": $new = "Prijava"; break;
	case "Login session time out in seconds": $new = "Prekinitev prijave v sekundah"; break;
	case "Login session timeout": $new = "Prijava prekinjena"; break ;
	case "Logout": $new = "Odjava"; break;

	case "Menu": $new = "Menu"; break;
	case "Month": $new = "Mesec"; break;
	case "More info": $new = "Veè informacij"; break;

	case "Next": $new = "Naslednji"; break;				
	case "Next day": $new = "Naslednji dan"; break;
	case "Next week": $new = "Naslednji teden"; break;
	case "No categories yet": $new = "ni še kategorij"; break;
	case "No events": $new = "Ni dogodkov"; break;
	case "No Repeat": $new = "Ni ponovitev"; break;
	case "No results": $new = "Ni rezultatov"; break;
	case "No, go back!": $new = "Ne, pojdi nazaj!"; break;
	case "noadminapprove": $new = "Odobrene dogodke lahko dodajo administratorji, ni potrebno admin"; break ;
	case "noapprove": $new = "Odobrene dogodke lahko doda uporabnik, ni potrebno admin"; break ;
	case "nocat": $new = "Izbrati morate kategorijo !"; break;
	case "noday": $new = "Izbrati morate dan !"; break;
	case "nodescription": $new = "Vpisati morate opis dogodka !"; break;
	case "nomonth": $new = "Izbrati morate mesec !"; break;
	case "nonapproved": $new = "Dogodki zahtevajo odobritev : "; break;
	case "nononapproved": $new = "Ni dogodkov, za katere je potrebna odobritev"; break;
	case "notitle": $new = "Vpisati morate naslov dogodka !"; break;
	case "noyear": $new = "Izbrati morate leto !"; break;

	case "on": $new = "na"; break;
	case "Optional": $new = "Opcija"; break;
	case "or month": $new = "ali mesec"; break;
	case "or week": $new = "ali teden"; break;

	case "password": $new = "geslo"; break;
	case "Please choose the category you only want to view events for": $new = "Please choose the category you only want to view events for"; break;  // translate?
	case "Popup Month": $new = "Odpri mesec v novem oknu"; break ;
	case "Previous": $new = "Prejšnji"; break;			
	case "Previous day": $new = "Prejšnji dan"; break;
	case "Previous week": $new = "Prejšnji teden"; break;

	case "Read more": $new = "Preberi v novem oknu"; break;
	case "reallydelcat": $new = "Ali res želite odstraniti kategorijo? Vsi dogodki v kategoriji bodo trajno izbrisani!"; break;
	case "Repeat": $new = "Ponovi"; break;
	case "results": $new = "rezultati"; break;

	case "search": $new = "iskanje"; break;
	case "Sort by": $new = "Uredi po"; break ;
	case "Sort by date": $new = "Uredi po datumu"; break ;
	case "Sort by events": $new = "Uredi po dogodkih"; break ;
	case "Start Time": $new = "Zaèetni datum"; break ;

	case "thankyou": $new = "Hvala za vpis dogodka, objavljen bo po odobritvi."; break;
	case "thankyoupost": $new = "Hvala za vpis dogodka, je že poslan."; break;
	case "till": $new = "do"; break;
	case "Time added or updated": $new = "Èas dodan/posodobljen"; break ;
	case "timeout msg": $new = "Changes in session timeout will only be effective on next login" ; break ;
	case "times every": $new = "krat vsak-o"; break;	
	case "To": $new = "do"; break ;
	case "To delete category": $new = "Za brisanje kategorije"; break ;
	case "Today": $new = "Danes"; break;
	case "Total": $new = "Skupno"; break;
	case "Total number of events for the month": $new = "Skupno število dogodkov za mesec"; break ;
	case "Total number of events for user": $new = "Skupno število dogodkov za uporabnika"; break ;		
	case "Total unapproved events for the month": $new = "Skupno število neodobrenih dogodkov" ; break;
	case "Two weeks": $new = "Dva tedna" ; break;	// translate?

	case "Update": $new = "Posodobi"; break;
	case "Update Event": $new = "Posodobi dogodek"; break;
	case "Updating category": $new = "Posodabljanje kategorije"; break ;
	case "Updating event": $new = "Posodabljanje dogodka"; break;
	case "Updating user": $new = "Posodabljanje uporabnika"; break;			
	case "Unapproved events": $new = "Neodobreni dogodki"; break ;
	case "User": $new = "Uporabnik"; break ;
	case "User Calendar": $new = "Kolendar uporabnika"; break ;
	case "User description": $new = "User description"; break ;		// translate?
	case "User group": $new = "Skupina uporabnika"; break ;				
	case "User Management": $new = "Uporabnikovo upravljanje"; break;
	case "userdelok": $new = "Ali res želite izbrisati tega uporabnika ?"; break;
	case "username": $new = "uporabniško ime"; break;
	case "Username entered already exists. Please use another username.": $new = "Vpisan uporabnik že obstaja. Prosim uporabite drugo uporabniško ime."; break;
	case "users": $new = "uporabniki"; break;

	case "View": $new = "Pogled"; break;
	case "View categories in year": $new = "Pogled kategorij v letu"; break ;
	case "View details or edit": $new = "Poglej podrobnosti/uredi"; break ;
	case "View event": $new = "Poglej dogodek"; break;
	case "View events of user": $new = "Poglej dogodke uporabnikov"; break;
	case "View events under this category in year": $new = "Poglej dogodke pod to kategorijo v letu"; break ;
	case "View historical events before": $new = "Poglej zgodovino dogodkov pred"; break ;
	case "View month": $new = "Poglej mesec"; break;
	case "View week": $new = "Poglej teden"; break;

	case "Web Calendar Admin Login": $new = "Admin prijava"; break ;
	case "Web Calendar User Login": $new = "Prijava uporabnika"; break ;
	case "week number": $new = "številka tedna"; break;
	case "Week starts": $new = "Teden zaène"; break;
	case "wronglogin": $new = "Nepravilno uporabniško ime ali geslo"; break;

	case "Year": $new = "Leto"; break;
	case "Yes, delete event !": $new = "Da, briši dogodek !"; break;
	case "Yes, delete it!": $new = "Da, briši!"; break;

	default: $new = "<b>".$msgin."</b> needs to be translated !";    break;

    }
    return $new;
}
?>