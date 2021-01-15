<?php
function translate($msgin){

    switch ($msgin) {
	case "About Calendarix": $new = "About Calendarix"; break ;		// translate?
	case "Add": $new = "Gehitu"; break ;
	case "Add Category": $new = "Maila gehitu"; break;
	case "Add Event": $new = "Gertaera Gehitu"; break;
	case "Add event": $new = "Gertaera gehitu" ; break;
	case "Add new user": $new = "Erabiltzaile berria gehitu"; break;
	case "Adding category": $new = "Kategoria gehitzen"; break;
	case "Adding event": $new = "Gertaera gehitzen" ; break ;
	case "Adding user": $new = "Erabiltzailea gehitzen"; break ;
	case "Administration": $new = "Administrazioa"; break;
	case "Administrator": $new = "Administratzaile"; break ;
	case "All categories": $new = "Kategoria guztiak"; break ;		// translate?
	case "Approval needed for posting of events.": $new = "Gertaeren administraziorako baieztapen onarpena"; break ;
	case "Approvals": $new = "Onartutak"; break ;
	case "Approve": $new = "Ontzat eman"; break;
	case "Approving event": $new = "Gertaera onartzen"; break;
	
	case "Back": $new = "Itzuli"; break;
	case "Both passwords entered do not match": $new = "Pasahitzak ez dira berdinak"; break;	

	case "Calendar": $new = "Egutegia"; break;
	case "Cancel": $new = "Ezeztatu"; break ;
	case "Cannot delete current login user": $new = "Ezin da ezabatu erabiltzailea"; break ;   
	case "Cannot change current login user": $new = "Ezin da erabiltzailea aldatu"; break;	
	case "Cannot have a category with blank name": $new = "Ez da existitzen izendaturik gabeko maila"; break ;
	case "Categories": $new = "Mailak"; break;
	case "Category": $new = "Maila"; break;
	case "Change": $new = "Aldatu"; break ;
	case "Change password/group": $new = "Pasahitza aldatu/taldea"; break; 		
	case "Choose Category": $new = "Maila bat aukeratu"; break;
	case "Close": $new = "Itxi"; break;
	case "Confirm delete?": $new = "Ezabatu onartu?" ; break ;			// translate?
	case "Confirm delete all historical events before": $new = "Historiko gertaerak ezabatu onartu?"; break ;
	case "confirmed events for today": $new = "Gaurko baieztatutako gertaerak"; break ;
	case "Confirm password": $new = "Pasahitza onartu"; break; 
	case "Copy Event": $new = "Gertaera kopiatu"; break ;
	case "Current Week": $new = "Hurrengo astea"; break;
	case "Current Month": $new = "Hurrengo hilabetea"; break;
        case "Current Year": $new = "Aurten"; break;

	case "Date": $new = "Data"; break;
	case "Day": $new = "Eguna"; break;
	case "Delete all historical events listed": $new = "Gertaerak ezabatu"; break;
	case "Delete category": $new = "Maila ezabatu"; break;
	case "Delete event": $new = "Gertaera ezabatu"; break;
	case "Delete user": $new = "Erabiltzaile ezabatu"; break;
	case "Deleting category": $new = "Maila ezabatzen"; break;
	case "Deleting event": $new = "Gertera ezabatzen"; break ;
	case "Deleting user": $new = "Erabiltzaile ezabatzen"; break ;
	case "disabled": $new = "Ez dabil"; break;

	case "Edit category": $new = "Maila argitaratu"; break;
	case "Edit event": $new = "Gertera argitaratu"; break;
	case "Email": $new = "E-posta"; break;
	case "End Time": $new = "Amaiera"; break ;
	case "Event": $new = "Gertaera"; break ;
	case "Event Category": $new = "Gertaeraren maila"; break;
	case "Event Description": $new = "Gertaeraren deskribapena "; break;
	case "Event Title": $new = "Gertaeraren Izenburua"; break;
	case "events": $new = "gertaerak"; break;
	case "Events added will be posted immediately.": $new = "Gertaerak laister bidaliko dira ."; break ;
	case "events awaiting approval": $new = "gertaerak baieztapena itxaroten"; break ;
	case "Events before": $new = "Aurreko gertaerak"; break ;
	case "events for": $new = "Gertaerak..."; break;
	case "Events for day": $new = "Gaurko gertaerak"; break;
	case "events for whole calendar": $new = "egutegiko gertera guztiak"; break;
	case "events for year": $new = "Urteko gerterak"; break;
	case "Events from ": $new = "Gertaerak ... "; break;
	case "Events in category": $new = "Mailako gertaerak"; break;

	case "From": $new = "Data honetatik"; break ;

	case "Go to": $new = "honetara joan"; break;
	case "Go to day": $new = "Data honetara joan"; break;
	case "Go to week": $new = "Astea honetara joan"; break;

	case "Historical Items": $new = "Artxibo historikoa"; break;

	case "Login": $new = "Izena eman"; break;
	case "Login session time out in seconds": $new = "Saio amaiera segunduetan"; break;
	case "Login session timeout": $new = "Saio Epea"; break ;
	case "Logout": $new = "Irten"; break;

	case "Menu": $new = "Menu"; break;
	case "Month": $new = "Hilabetea"; break;
	case "More info": $new = "Informazio gehiago"; break;

	case "Next": $new = "Hurrengoa"; break;				
	case "Next day": $new = "Hurrengo eguna"; break;
	case "Next week": $new = "Hurrengo astea"; break;
	case "No categories yet": $new = "Mailarik gabe"; break;
	case "No events": $new = "Gertaerak gabe"; break;
	case "No Repeat": $new = "Ez errepikatu"; break;
	case "No results": $new = "Emaitzak gabe"; break;
	case "No, go back!": $new = "Ez, buelta eman!"; break;
	case "noadminapprove": $new = "Aprovação de eventos adicionada por administradores não é necessária"; break ;
	case "noapprove": $new = "Aprovação de eventos adicionados por usuários não necessita de administrador"; break ;
	case "nocat": $new = "Maila aukeratu behar duzu"; break;
	case "noday": $new = "Eguna aukeratu behar duzu !"; break;
	case "nodescription": $new = "Deskribapena aukeratu behar duzu !"; break;
	case "nomonth": $new = "Hilabete bat aukeratu behar duzu !"; break;
	case "nonapproved": $new = "Geraerak baieztapena zaintzen : "; break;
	case "nononapproved": $new = "GFertaerak gabe momentu hontan"; break;
	case "notitle": $new = "Titulua eman behar duzu !"; break;
	case "noyear": $new = "Urte bat aukeratu behar duzu !"; break;

	case "on": $new = "ean"; break;
	case "Optional": $new = "hautazkoa"; break;
	case "or month": $new = "edo hilabetea"; break;
	case "or week": $new = "edo astea"; break;

	case "password": $new = "pasa hitza"; break;
	case "Please choose the category you only want to view events for": $new = "Mesedez aukerartu zein mailako gertaerak nahi duzu ikusten"; break;  // translate?
	case "Popup Month": $new = "Hilabete ireki pop-up batean"; break ;
	case "Previous": $new = "Lehenago"; break;			
	case "Previous day": $new = "Lehenengo eguna"; break;
	case "Previous week": $new = "Lehenego astea"; break;

	case "Read more": $new = "Irakurri gehiago"; break;
	case "reallydelcat": $new = "Zihur zaude maila hau ezabatu nahi duzu? Gertaera guztiak ezabatuko dira"; break;

	case "Repeat": $new = "Errepikatu"; break;
	case "results": $new = "emaitzak"; break;

	case "search": $new = "bilatu"; break;
	case "Sort by": $new = " Zerez Ordeantu"; break ;
	case "Sort by date": $new = "Data ordenatu"; break ;
	case "Sort by events": $new = "Gertaerak ordenatu"; break ;
	case "Start Time": $new = "Hasiera ordua"; break ;

	case "thankyou": $new = "Eskerrik asko."; break;
	case "thankyoupost": $new = "Eskerrik asko gertaera bat bidaltzeko,..."; break;
	case "till": $new = "-tik"; break;
	case "Time added or updated": $new = "Ordua gaurkotu izan da"; break ;
	case "timeout msg": $new = "Hurrengo saioan ikusiko duzu aldaketak" ; break ;
	case "times every": $new = "aldiz"; break;
	case "To": $new = "-ra"; break ;
	case "To delete category": $new = "Kategoria bat ezabatzeko"; break ;
	case "Today": $new = "Gaur"; break;
	case "Total": $new = "Guztira"; break;
	case "Total number of events for the month": $new = "Gertaerak hilabete honetan"; break ;
        case "Total number of events for user": $new = "Erabiltzaileko gertaerak"; break ;
	case "Total unapproved events for the month": $new = "Hilabete hontan baieztatu gertaerak" ; break;
        case "Two weeks": $new = "Bi asteak" ; break;

	case "Update": $new = "Berritu"; break;
	case "Update Event": $new = "Gertera berritu"; break;
	case "Updating category": $new = "Maila berritu"; break ;
	case "Updating event": $new = "Gertera berritzen"; break;
	case "Updating user": $new = "Erabiltzaile barritzen"; break;			
	case "Unapproved events": $new = "Gertaerak onartu gabe"; break ;
	case "User": $new = "Erabiltzailea"; break ;
	case "User Calendar": $new = "Erabiltzailearen egutegia"; break ;
	case "User description": $new = "User description"; break ;		// translate?
	case "User Management": $new = "Erabiltzailearen kudeaketa"; break;
	case "User group": $new = "User group"; break ;		
	case "userdelok": $new = "Você tem certeza que deseja deletar este usuário ?"; break;
	case "username": $new = "Erabiltzaileraen izena"; break;
	case "Username entered already exists. Please use another username.": $new = "Erabiltzailearen izena erregistratuta dago, mezedez aukeratu beste bat."; break;
	case "users": $new = "erabiltzaileak"; break;

	case "View": $new = "Ikusi"; break;
	case "View categories in year": $new = "Urteko mailak ikusi"; break ;
	case "View details or edit": $new = "Xehetasunak ikusi edo aldatu"; break ;
	case "View event": $new = "Gertaera ikusi"; break;
	case "View events under this category in year": $new = "Aurtengo Mailako gertaerak ikusi"; break ;
	case "View historical events before": $new = "Lehenego gertaerak ikusi"; break ;
	case "View month": $new = "Hilabete ikusi"; break;
	case "View week": $new = "Astea ikusi"; break;

	case "Web Calendar Admin Login": $new = "Administratzaile baliozkotu"; break ;
	case "Web Calendar User Login": $new = "Erabiltzaile baliozkotu"; break ;
	case "week number": $new = "asteko zenbakia"; break;
	case "Week starts": $new = "astea asten da..."; break;
	case "wronglogin": $new = "Izena eta pasa-hitza txarto daude"; break;

	case "Year": $new = "Urtea"; break;
	case "Yes, delete event !": $new = "Bai, gertaera ezabatu !"; break;
	case "Yes, delete it!": $new = "Bai, ezabatu!"; break;
	case "Fee" : $new = "Prezioa"; break;
    case "Print" : $new = "Imprimatu"; break;

	default: $new = "<b>".$msgin."</b> ";    break;

    }
    return $new;
}
?>