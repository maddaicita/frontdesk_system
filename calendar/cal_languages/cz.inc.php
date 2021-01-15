<?php
function translate($msgin){
    switch ($msgin) {
	case "About Calendarix": $new = "O Calendarix"; break ;		
	case "Add": $new = "Pøidat"; break ;
	case "Add Category": $new = "Pøidat kategorii"; break;
	case "Add Event": $new = "Pøidat Událost"; break;
	case "Add event": $new = "Pøidat událost" ; break;
	case "Add new user": $new = "Pøidat uživatele"; break;
	case "Adding category": $new = "Pøidávám kategorii"; break;
	case "Adding event": $new = "Pøidávám událost" ; break ;
	case "Adding user": $new = "Pøidávám uživatele"; break ;
	case "Administration": $new = "Administrace"; break;
	case "Administrator": $new = "Administrator"; break ;
	case "All categories": $new = "Všechny kategorie"; break ;		
	case "Approval needed for posting of events.": $new = "Pro zapsání události je nutné schválení."; break;  
	case "Approvals": $new = "Approvals"; break ;
	case "Approve": $new = "Schválit"; break;
	case "Approving event": $new = "Schvaluji událost"; break;
	
	case "Back": $new = "Zpìt"; break;
	case "Both passwords entered do not match": $new = "Obe zadaná hesla nesouhlasí"; break;	

	case "Calendar": $new = "Kalendáø"; break;
	case "Cancel": $new = "Zrušit"; break ;
	case "Cannot delete current login user": $new = "Nelze smazat uživatele"; break ;   
	case "Cannot change current login user": $new = "Nelze zmìnit uživatele"; break;	
	case "Cannot have a category with blank name": $new = "Nelze vytvoøit kategorii bez jména"; break ;
	case "Categories": $new = "Kategorie"; break;
	case "Category": $new = "Kategorie"; break;
	case "Change": $new = "Zmìnit"; break ;
	case "Change password/group": $new = "Zmìnit heslo/skupinu"; break; 	// master obsolete?	
	case "Choose Category": $new = "Zvolte kategorii"; break;
	case "Close": $new = "Zavøít"; break;
	case "Coming Events": $new = "Nadcházející události"; break;			// 0.6.20050830
	case "Confirm delete?": $new = "Potvrdit smazání?" ; break ;			
	case "Confirm delete all historical events before": $new = "Potvrïte smazání všech pøedešlých událostí"; break ;
	case "confirmed events for today": $new = "dnešní události"; break ;
	case "Confirm password": $new = "Potvrïte heslo"; break; 		
	case "Copy Event": $new = "Kopírovat událost"; break ;				
	case "Current Week": $new = "Tento týden"; break;
	case "Current Month": $new = "Tento mìsíc"; break;
	case "Current Year": $new = "Tento rok"; break;		

	case "Date": $new = "Datum"; break;
	case "Day": $new = "Den"; break;
	case "Delete all historical events listed": $new = "Smazat všechny staré události"; break;
	case "Delete category": $new = "Smazat kategorii"; break;
	case "Delete event": $new = "Smazat událost"; break;
	case "Delete user": $new = "Smazat uživatele"; break;
	case "Deleting category": $new = "Mažu kategorii"; break;
	case "Deleting event": $new = "Mažu událost"; break ;
	case "Deleting user": $new = "Mažu uživatele"; break ;
	case "disabled": $new = "Tato sekce není pøístupná"; break;

	case "Edit category": $new = "Upravit kategorii"; break;
	case "Edit event": $new = "Upravit událost"; break;
	case "Edit information": $new = "Upravit informace"; break;	// master translate?
	case "Email": $new = "Email"; break;
	case "End Time": $new = "Èas ukoncení"; break ;
	case "Event": $new = "Událost"; break ;
	case "Event Category": $new = "Kategorie události"; break;
	case "Event Description": $new = "Popis události"; break;
	case "Event repeated": $new = "Opakovaná událost"; break;  
	case "Event Title": $new = "Název události"; break;
	case "events": $new = "události"; break;
	case "Events added will be posted immediately.": $new = "Pøidané události budou uloženy."; break ;
	case "events awaiting approval": $new = "události èekající na schválení"; break ;
	case "Events before": $new = "Pøedchozí události"; break ;
	case "events for": $new = "události na"; break;
	case "Events for day": $new = "Události na den"; break;
	case "events for whole calendar": $new = "události na celý kalendáø"; break;
	case "events for year": $new = "události na rok"; break;
	case "Events from ": $new = "Události od "; break;
	case "Events in category": $new = "Události v kategorii"; break;

	case "From": $new = "Od"; break ;
	case "Functions": $new = "Funkce"; break ;	// master translate?

	case "Go to": $new = "Pøejít na"; break;
	case "Go to day": $new = "Pøejít na den"; break;
	case "Go to week": $new = "Pøejít na týden"; break;

	case "Historical Items": $new = "Staré položky"; break;

	case "Login": $new = "Login"; break;
	case "Login session time out in seconds": $new = "Login session time out in seconds"; break;
	case "Login session timeout": $new = "Login session timeout"; break ;
	case "Logout": $new = "Odhlásit se"; break;

	case "Menu": $new = "Menu"; break;
	case "Month": $new = "Mìsíc"; break;
	case "More info": $new = "Další info"; break;

	case "Name": $new = "Jméno"; break;			// master translate?
	case "Next": $new = "Další"; break;				
	case "Next day": $new = "Další den"; break;
	case "Next week": $new = "Další týden"; break;
	case "No categories yet": $new = "Zatím žádné kategorie"; break;
	case "No events": $new = "Žádné události"; break;
	case "No Repeat": $new = "Žádné opakování"; break;
	case "No results": $new = "Žádné výsledky"; break;
	case "No, go back!": $new = "Ne, vra se zpìt!"; break;
	case "No.": $new = "Ne."; break;			// master translate?
	case "noadminapprove": $new = "Approval of events added by administrators not needed by administrator"; break ;
	case "noapprove": $new = "Approval of events added by users not needed by administrator"; break ;
	case "nocat": $new = "Musíte zvolit kategorii !"; break;
	case "noday": $new = "Musíte zvolit den !"; break;
	case "nodescription": $new = "Chybí popis události !"; break;
	case "nomonth": $new = "Musíte zvolit mìsíc !"; break;
	case "nonapproved": $new = "Events requiring approval : "; break;
	case "nononapproved": $new = "Žádné události neèekají na schválení"; break;
	case "notitle": $new = "Chybí název události !"; break;
	case "noyear": $new = "Musíte zvolit rok !"; break;

	case "on": $new = "na"; break;
	case "Optional": $new = "Volitelné"; break;
	case "or month": $new = "nebo mìsíc"; break;
	case "or week": $new = "nebo týden"; break;

	case "password": $new = "heslo"; break;
	case "Please choose the category you only want to view events for": $new = "Prosím zvolte kategorii prohlížených událostí"; break;  
	case "Please choose the RSS channel you want to view": $new = "Prosím zvolte RSS požadovaný kanál"; break;
	case "Popup Month": $new = "Rychlý mìsíèní náhled"; break ;
	case "Previous": $new = "Pøedchozí"; break;			
	case "Previous day": $new = "Pøedchozí den"; break;
	case "Previous week": $new = "Pøedchozí týden"; break;

	case "Read more": $new = "Read more"; break;
	case "reallydelcat": $new = "Chcete opravdu odstranit tuto kategorii? Všechny události v této kategorii budou smazány!"; break;
	case "Repeat": $new = "Opakovat"; break;
	case "results": $new = "výsledky"; break;
	case "Role": $new = "Role"; break;			// master translate?

	case "search": $new = "vyhledat"; break;
	case "Select": $new = "Vybrat"; break;		// 0.7.20060401
	case "Sort by": $new = "Tøídit dle"; break ;
	case "Sort by date": $new = "Tøídit dle data"; break ;
	case "Sort by events": $new = "Tøídit dle události"; break ;
	case "Start Time": $new = "Zaèátek"; break ;

	case "thankyou": $new = "Dìkujeme za vložení události. Bude zobrazena po schválení."; break;
	case "thankyoupost": $new = "Dìkujeme za vložení události."; break;
	case "till": $new = "do"; break;
	case "Time added or updated": $new = "Èas pøidán nebo upraven"; break ;
	case "timeout msg": $new = "Zmìny se projeví až po dalším pøihlášení" ; break ;
	case "times every": $new = "krát každý"; break;	
	case "To": $new = "To"; break ;
	case "To delete category": $new = "Smazat kategorii"; break ;
	case "Today": $new = "Dnes"; break;
	case "Total": $new = "Celkem"; break;
	case "Total number of events for the month": $new = "Celkový poèet událostí za mìsíc"; break ;
	case "Total number of events for user": $new = "Celkový poèet událostí od uživatele"; break ;		
	case "Total unapproved events for the month": $new = "Celkový poèet neschválených událostí za mìsíc" ; break;
	case "Two weeks": $new = "Dva týdny" ; break;	

	case "Update": $new = "Upravit"; break;
	case "Update Event": $new = "Upravit událost"; break;
	case "Updating category": $new = "Upravuji kategorii"; break ;
	case "Updating event": $new = "Upravuji událost"; break;
	case "Updating user": $new = "Upravuji uživatele"; break;			
	case "Unapproved events": $new = "Neschválené události"; break ;
	case "User": $new = "Uživatel"; break ;
	case "User Calendar": $new = "Kalendáø uživatele"; break ;
	case "User description": $new = "Popis uživatele"; break ;		
	case "User group": $new = "Skupina uživatelù"; break ;				
	case "User Management": $new = "User Management"; break;
	case "userdelok": $new = "Chcete opravdu smazat tohoto uživatele ?"; break;
	case "username": $new = "uživatelské jméno"; break;
	case "Username and passwords must be alpha-numeric and without spaces.": $new = "Uživatelské jméno a heslo musí být alpha-numerické a bez mezer."; break; 	// version 0.4.20030731
	case "Username entered already exists. Please use another username.": $new = "Uživatelské jméno již existuje. Prosím zvolte jiné."; break;
	case "users": $new = "uživatelé"; break;

	case "View": $new = "Zobrazit"; break;
	case "View categories in year": $new = "Zobrazit kategorie v roce"; break ;
	case "View details or edit": $new = "Zobrazit detaily nebo upravit"; break ;
	case "View event": $new = "Zobrazit událost"; break;
	case "View events of user": $new = "Zobrazit události uživatele"; break;
	case "View events under this category in year": $new = "Zobrazit události v této kategorii v roce"; break ;
	case "View historical events before": $new = "Náhled starých událostí pøed"; break ;
	case "View month": $new = "Zobrazit mìsíc"; break;
	case "View week": $new = "Zobrazit týden"; break;

	case "Web Calendar Admin Login": $new = "Admin Login"; break ;
	case "Web Calendar User Login": $new = "Pøihlášení uživatele"; break ;
	case "week number": $new = "èíslo týdne"; break;
	case "Week starts": $new = "týden zaèíná"; break;
	case "wronglogin": $new = "Nesprávné jméno nebo heslo"; break;

	case "Year": $new = "Rok"; break;
	case "Yes": $new = "Ano"; break;		// version 0.4.20030731
	case "Yes, delete event !": $new = "Ano, smazat událost !"; break;
	case "Yes, delete it!": $new = "Ano, smazat!"; break;

	default: $new = "<b>".$msgin."</b> needs to be translated !";    break;
    }
    return $new;
}
?>