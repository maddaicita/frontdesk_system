<?php
function translate($msgin){
    switch ($msgin) {
	case "About Calendarix": $new = "Calendarixról"; break ;		
	case "Add": $new = "Hozzáad"; break ;
	case "Add Category": $new = "KAtegóriát hozzáad"; break;
	case "Add Event": $new = "Eseményt hozzáad"; break;
	case "Add event": $new = "Eseményt hozzáad" ; break;
	case "Add new user": $new = "Új felhasználót hozzáad"; break;
	case "Adding category": $new = "Kategória hozzáadás"; break;
	case "Adding event": $new = "Esemény hozzáadás" ; break ;
	case "Adding user": $new = "Felhasználó hozzáadás"; break ;
	case "Administration": $new = "Adminisztráció"; break;
	case "Administrator": $new = "Rendszergazda"; break ;
	case "All categories": $new = "Összes kategória"; break ;		
	case "Approval needed for posting of events.": $new = "Engedélyezés szüséges az események rögzítéséhez"; break;  
	case "Approvals": $new = "Engedélyek"; break ;
	case "Approve": $new = "Engedélyez"; break;
	case "Approving event": $new = "Esemény engedélyezés"; break;
	
	case "Back": $new = "Vissza"; break;
	case "Both passwords entered do not match": $new = "Jelszavak nem egyeznek"; break;	

	case "Calendar": $new = "Határidõnapló"; break;
	case "Cancel": $new = "Mégse"; break ;
	case "Cannot delete current login user": $new = "A bejelentkezett felhasználó nem törölhetõ"; break ;   
	case "Cannot change current login user": $new = "A bejelentkezett felhasználó nem váltható"; break;	
	case "Cannot have a category with blank name": $new = "Kategória neve nem lehet üres"; break ;
	case "Categories": $new = "Kategóriák"; break;
	case "Category": $new = "Kategória"; break;
	case "Change": $new = "Változtat"; break ;
	case "Change password/group": $new = "Jelszó/csoport változtatás"; break; 	// master obsolete?	
	case "Choose Category": $new = "Válasszon Kategoria"; break;
	case "Close": $new = "Bezár"; break;
	case "Coming Events": $new = "Hátralévõ események"; break;			// 0.6.20050830
	case "Confirm delete?": $new = "Biztosan törli?" ; break ;			
	case "Confirm delete all historical events before": $new = "Biztosan törli a régi eseményeket"; break ;
	case "confirmed events for today": $new = "Mai napon látott események"; break ;
	case "Confirm password": $new = "Jelszó megerõsítése"; break; 		
	case "Copy Event": $new = "Esemémy másolása"; break ;				
	case "Current Week": $new = "Folyó Hét"; break;
	case "Current Month": $new = "Folyó Hó"; break;
	case "Current Year": $new = "Folyó év"; break;		

	case "Date": $new = "Dátum"; break;
	case "Day": $new = "nap"; break;
	case "Delete all historical events listed": $new = "A kilistázott események törlése"; break;
	case "Delete category": $new = "Kategória törlése"; break;
	case "Delete event": $new = "Esemény törlése"; break;
	case "Delete user": $new = "Felhasználó törlése"; break;
	case "Deleting category": $new = "Kategória törlés"; break;
	case "Deleting event": $new = "Esemény törlés"; break ;
	case "Deleting user": $new = "Felhasználó törlés"; break ;
	case "disabled": $new = "Ez a rész nincs aktiválva"; break;

	case "Edit category": $new = "Kategoria módosítás"; break;
	case "Edit event": $new = "Esemány módósítás"; break;
	case "Edit information": $new = "INformáció módosítás"; break;	// master translate?
	case "Email": $new = "Email"; break;
	case "End Time": $new = "Vége"; break ;
	case "Event": $new = "Esemény"; break ;
	case "Event Category": $new = "Esemény kategória"; break;
	case "Event Description": $new = "Esemény leírás"; break;
	case "Event repeated": $new = "Esemény megismételve"; break;  
	case "Event Title": $new = "Esemény neve"; break;
	case "events": $new = "esemény"; break;
	case "Events added will be posted immediately.": $new = "Hozzáadott esemény azonnal rögzítésre kerül"; break ;
	case "events awaiting approval": $new = "esemény elfogadásra vár"; break ;
	case "Events before": $new = "Esemény elõtt"; break ;
	case "events for": $new = "Esemény"; break;
	case "Events for day": $new = "Esemény mára"; break;
	case "events for whole calendar": $new = "Határidõnapló Összes eseménye"; break;
	case "events for year": $new = "események erre az évre"; break;
	case "Events from ": $new = "Események:   "; break;
	case "Events in category": $new = "Events in category"; break;

	case "From": $new = "idõponttól"; break ;
	case "Functions": $new = "Funkciók"; break ;	// master translate?

	case "Go to": $new = "Ugrás"; break;
	case "Go to day": $new = "Adott napra váltás"; break;
	case "Go to week": $new = "Hétre ugrás"; break;

	case "Historical Items": $new = "Régi események"; break;

	case "Login": $new = "Bejelentkezés"; break;
	case "Login session time out in seconds": $new = "Bejelentkezés másodperceken belül elévül"; break;
	case "Login session timeout": $new = "Újra be kell jelentkezni"; break ;
	case "Logout": $new = "Kijelentkezés"; break;

	case "Menu": $new = "Menü"; break;
	case "Month": $new = "Hónap"; break;
	case "More info": $new = "Részletesen"; break;

	case "Name": $new = "Név"; break;			// master translate?
	case "Next": $new = "Következõ"; break;				
	case "Next day": $new = "Köv. nap"; break;
	case "Next week": $new = "Köv. hét"; break;
	case "No categories yet": $new = "Még nincs kategória"; break;
	case "No events": $new = "Nincs esemény"; break;
	case "No Repeat": $new = "Nincs ismétlés"; break;
	case "No results": $new = "Nincs találat"; break;
	case "No, go back!": $new = "Nem, lépj vissza!"; break;
	case "No.": $new = "Nem."; break;			// master translate?
	case "noadminapprove": $new = "Rendszergazda által hozzáadott események autómatikusan rögzítésre kerülnek"; break ;
	case "noapprove": $new = "Felhasználó által hozzáadott események autómatikusan rögzítésre kerülnek"; break ;
	case "nocat": $new = "Válasszon kategóriát !"; break;
	case "noday": $new = "Válasszon napot !"; break;
	case "nodescription": $new = "Esemény leirást ki kell tölteni !"; break;
	case "nomonth": $new = "Válasszon hónapot !"; break;
	case "nonapproved": $new = "Elfogadásra váró események : "; break;
	case "nononapproved": $new = "Nincs elfogadásra váró esemény"; break;
	case "notitle": $new = "Esemény nevét meg kell adja !"; break;
	case "noyear": $new = "Válasszon évet !"; break;

	case "on": $new = "on"; break;
	case "Optional": $new = "nem kötelezõ"; break;
	case "or month": $new = "vagy hónapra"; break;
	case "or week": $new = "vagy hétre"; break;

	case "password": $new = "jelszó"; break;
	case "Please choose the category you only want to view events for": $new = "Válasszon kategóriát az ahhoz tartozó események megtekintéséhez"; break;  
	case "Popup Month": $new = "Hónap Popup"; break ;
	case "Previous": $new = "Elõzõ"; break;			
	case "Previous day": $new = "Elõzõ nap"; break;
	case "Previous week": $new = "Elõzõ hét"; break;

	case "Read more": $new = "Részletesebben"; break;
	case "reallydelcat": $new = "A kategórai törlésével az ahhoz tartozó összes eseményt is törli !"; break;
	case "Repeat": $new = "Ismétlés"; break;
	case "results": $new = "Találat"; break;
	case "Role": $new = "Szerep"; break;			// master translate?

	case "search": $new = "Keres"; break;
	case "Select": $new = "Választ"; break;		// 0.7.20060401
	case "Sort by": $new = "Osztályozas"; break ;
	case "Sort by date": $new = "Osztályozás dátum alapján"; break ;
	case "Sort by events": $new = "Osztályozás Esemény alapján"; break ;
	case "Start Time": $new = "Kezdõdik"; break ;

	case "thankyou": $new = "Köszönjük az esemény bevitelét, engedélyezés után rögzítésre kerül."; break;
	case "thankyoupost": $new = "Köszönjük az esemény bevitelét, azonnal rögzítésre került"; break;
	case "till": $new = " - "; break;
	case "Time added or updated": $new = "Idõ hozzáadva vagy frissítve"; break ;
	case "timeout msg": $new = "A kijelentkeztetési idõ csak újboli bejelentkezéskor módosul" ; break ;
	case "times every": $new = "szor"; break;	
	case "To": $new = "To"; break ;
	case "To delete category": $new = "Kategória törlése"; break ;
	case "Today": $new = "Ma"; break;
	case "Total": $new = "Összes"; break;
	case "Total number of events for the month": $new = "Események száma ebben a hónapban"; break ;
	case "Total number of events for user": $new = "Felhasználó összes eseménye"; break ;		
	case "Total unapproved events for the month": $new = "Elfogadásra váró esemény ebben a hónapban" ; break;
	case "Two weeks": $new = "Két hét" ; break;	

	case "Update": $new = "Frissít"; break;
	case "Update Event": $new = "Eseményt frissít"; break;
	case "Updating category": $new = "Kategóriát frissít"; break ;
	case "Updating event": $new = "Esemény frissítés"; break;
	case "Updating user": $new = "Felhasználó frissítés"; break;			
	case "Unapproved events": $new = "elfogadásra váró események"; break ;
	case "User": $new = "Felhasználó"; break ;
	case "User Calendar": $new = "Felhasználói Határidõnapló"; break ;
	case "User description": $new = "Felhasználó leírása"; break ;		
	case "User group": $new = "Felhasználó csoport"; break ;				
	case "User Management": $new = "Felhasználók Hozzáadása, módosítása"; break;
	case "userdelok": $new = "Biztosan törli a felhasználót ?"; break;
	case "username": $new = "felhasználói név"; break;
	case "Username and passwords must be alpha-numeric and without spaces.": $new = "Név és jelszó csak számokból és betûkbõl állhatnak."; break; 	// version 0.4.20030731
	case "Username entered already exists. Please use another username.": $new = "Felhasználói név már létezik, Válasszon másikat."; break;
	case "users": $new = "Felhasználók"; break;

	case "View": $new = "Nézet"; break;
	case "View categories in year": $new = "Kategóriák megtekintése"; break ;
	case "View details or edit": $new = "Részletek megtekintése és változtatása"; break ;
	case "View event": $new = "Események megtekintése"; break;
	case "View events of user": $new = "Felhasználó eseményeinek megtekintése"; break;
	case "View events under this category in year": $new = "A kategória összes eseménye ebben az évben"; break ;
	case "View historical events before": $new = "Régi események megnézése dátum elõtt"; break ;
	case "View month": $new = "Hónap megtekintése"; break;
	case "View week": $new = "Hét megtekintése"; break;

	case "Web Calendar Admin Login": $new = "Calendarix Admin Login"; break ;
	case "Web Calendar User Login": $new = "Calendarix felhasználói belépés"; break ;
	case "week number": $new = "hanyadik hét"; break;
	case "Week starts": $new = "hét kezdõdik"; break;
	case "wronglogin": $new = "Hibás név vagy jelszó"; break;

	case "Year": $new = "Év"; break;
	case "Yes": $new = "Igen"; break;		// version 0.4.20030731
	case "Yes, delete event !": $new = "Eseményt tényleg törölni akarom !"; break;
	case "Yes, delete it!": $new = "Igen, töröld!"; break;

	default: $new = "<b>".$msgin."</b>Még le kell forítani !";    break;
    }
    return $new;
}
?>