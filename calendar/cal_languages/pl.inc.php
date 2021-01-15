<?php
function translate($msgin){

    switch ($msgin) {
	case "About Calendarix": $new = "About Calendarix"; break ;		
	case "Add": $new = "Dodaj"; break ;
	case "Add Category": $new = "Dodaj Kategoriê"; break;
	case "Add Event": $new = "Dodaj Zdarzenie"; break;
	case "Add event": $new = "Dodaj zdarzenie" ; break;
	case "Add new user": $new = "Dodaj noewgo u¿ytkownika"; break;
	case "Adding category": $new = "Dodawanie Kategorii"; break;
	case "Adding event": $new = "Dodawanie zdarzenia" ; break ;
	case "Adding user": $new = "Dodawanie u¿ytkownika"; break ;
	case "Address": $new = "Adres"; break ;			// master translate?
	case "Administration": $new = "Administracja"; break;
	case "Administrator": $new = "Administrator"; break ;
	case "All categories": $new = "Wszystkie kategorie"; break ;		
	case "Approval needed for posting of events.": $new = "Konieczne jest zezwolenie do wysy³ania zdarzeñ."; break;  
	case "Approvals": $new = "Zezwolenia"; break ;
	case "Approve": $new = "Zezwól"; break;
	case "Approving event": $new = "Zgoda na zdarzenie"; break;
	
	case "Back": $new = "Wstecz"; break;
	case "Both passwords entered do not match": $new = "Wpisane has³a nie s¹ identyczne"; break;	

	case "Calendar": $new = "Kalendarz"; break;
	case "Cancel": $new = "Anuluj"; break ;
	case "Cannot delete current login user": $new = "Nie mo¿na skasowaæ zalogowanego u¿ytkownika"; break ;   
	case "Cannot change current login user": $new = "Nie mo¿na skasowaæ zalogowanego u¿ytkownika"; break;	
	case "Cannot have a category with blank name": $new = "Nie mo¿e byæ Kategorii z pust¹ nazw¹"; break ;
	case "Categories": $new = "Kategorie"; break;
	case "Category": $new = "Kategoria"; break;
	case "Change": $new = "Zmieñ"; break ;
	case "Change password": $new = "Zmieñ has³o"; break; 		// master translate?
	case "Change password/group": $new = "Zmieñ has³o/grupê"; break; 	// master obsolete?	
	case "Choose Category": $new = "Wybierz kategoriê"; break;
	case "Close": $new = "Zamknij"; break;
	case "Confirm delete?": $new = "Potwierdz usuniêcie?" ; break ;			
	case "Confirm delete all historical events before": $new = "Potwierdz skasowanie wszystkich starych zdarzeñ"; break ;
	case "confirmed events for today": $new = "potwierdzone zdarzenia na dzisiaj"; break ;
	case "Confirm password": $new = "Potwierdz has³o"; break; 		
	case "Copy Event": $new = "Kopiuj Zdarzenie"; break ;				
	case "Current Week": $new = "Bie¿¹cy Tydzieñ"; break;
	case "Current Month": $new = "Bie¿¹cy Miesi¹c"; break;
	case "Current Year": $new = "Bie¿¹cy Rok"; break;		

	case "Date": $new = "Data"; break;
	case "Day": $new = "Dzieñ"; break;
	case "Delete all historical events listed": $new = "Kasuj wszystkie stare wyœwietlone zdarzenia"; break;
	case "Delete category": $new = "Kasuj Kategoriê"; break;
	case "Delete event": $new = "Kasuj zdarzenie"; break;
	case "Delete user": $new = "Kasuj u¿ytkownika"; break;
	case "Deleting category": $new = "Kasowanie kategorii"; break;
	case "Deleting event": $new = "Kasowanie zdarzenia"; break ;
	case "Deleting user": $new = "Kasowanie u¿ytkownika"; break ;
	case "disabled": $new = "Ta sekcja jest wy³¹czona"; break;

	case "Edit category": $new = "Edytuj kategoriê"; break;
	case "Edit event": $new = "Edytuj zdarzenie"; break;
	case "Edit information": $new = "Edytuj informacjê"; break;	// master translate?
	case "Email": $new = "Email"; break;
	case "End Time": $new = "Zakoñczenie"; break ;
	case "Event": $new = "Zdarzenie"; break ;
	case "Event Category": $new = "Kategoria Zdarzenia"; break;
	case "Event Description": $new = "Opis Zdarzenia"; break;
	case "Event repeated": $new = "Powtórzenie zdarzenia"; break;  
	case "Event Title": $new = "Nazwa Zdarzenia"; break;
	case "events": $new = "zdarzenia"; break;
	case "Events added will be posted immediately.": $new = "Dodane zdarzenia bêd¹ wyœwietlone natychmiast."; break ;
	case "events awaiting approval": $new = "zdarzenia oczekuj¹ce na zatwierdzenie"; break ;
	case "Events before": $new = "Poprzednie zdarzenia"; break ;
	case "events for": $new = "zdarzenia dla"; break;
	case "Events for day": $new = "Zdarzenia na dzieñ"; break;
	case "events for whole calendar": $new = "zdarzenia dla ca³ego kalendarza"; break;
	case "events for year": $new = "zdarzena dla roku"; break;
	case "Events from ": $new = "Zdarzenia od "; break;
	case "Events in category": $new = "Zdarzenia w kategorii"; break;

	case "From": $new = "Od"; break ;
	case "Functions": $new = "Funkcje"; break ;	// master translate?

	case "Go to": $new = "IdŸ do"; break;
	case "Go to day": $new = "IdŸ do dnia"; break;
	case "Go to week": $new = "IdŸ do tygodnia"; break;

	case "Historical Items": $new = "Historyczne zdarzenia"; break;

	case "Login": $new = "Zaloguj siê"; break;
	case "Login session time out in seconds": $new = "Zakoñczenie sesji logowania w sekundach"; break;
	case "Login session timeout": $new = "Zakoñczenie sesji logowania"; break ;
	case "Logout": $new = "Wyloguj siê"; break;

	case "Menu": $new = "Menu"; break;
	case "Month": $new = "Miesi¹c"; break;
	case "More info": $new = "Wiêcej informacji"; break;

	case "Name": $new = "Imiê"; break;			// master translate?
	case "Next": $new = "Nastêpny"; break;				
	case "Next day": $new = "Nastêpny dzieñ"; break;
	case "Next week": $new = "Nastêpny tydzieñ"; break;
	case "No categories yet": $new = "Nie ma ¿adnych kategorii"; break;
	case "No events": $new = "Brak zdarzeñ"; break;
	case "No Repeat": $new = "Brak powtórzeñ"; break;
	case "No results": $new = "Brak rezultatów"; break;
	case "No, go back!": $new = "Nie, cofnij siê!"; break;
	case "No.": $new = "Nie."; break;			// master translate?
	case "noadminapprove": $new = "Zdarzenia dodane przez administratorów nie wymagaj¹ce zatwierdzenia"; break ;
	case "noapprove": $new = "Zdarzenia dodane przez u¿ytkowników nie wymagaj¹ce zatwierdzenia"; break ;
	case "nocat": $new = "Musisz wybraæ kategoriê !"; break;
	case "noday": $new = "Musisz wybraæ dzieñ !"; break;
	case "nodescription": $new = "Musisz dodaæ opis zdarzenia !"; break;
	case "nomonth": $new = "Musisz wybraæ miesi¹c !"; break;
	case "nonapproved": $new = "Zdarzenia oczekuj¹ce na zatwierdzenie : "; break;
	case "nononapproved": $new = "Brak zdarzeñ oczekuj¹cych na zatwierdzenie w tej chwili"; break;
	case "notitle": $new = "Musisz podaæ nazwê zdarzenia !"; break;
	case "noyear": $new = "Musisz wybraæ rok !"; break;

	case "on": $new = "w"; break;
	case "Optional": $new = "Opcjonalne"; break;
	case "or month": $new = "lub miesi¹c"; break;
	case "or week": $new = "lub tydzieñ"; break;

	case "password": $new = "has³o"; break;
	case "Please choose the category you only want to view events for": $new = "Proszê wybraæ kategoriê w której chcesz zobaczyæ zdarzenia"; break;  
	case "Popup Month": $new = "Poka¿ miesi¹c"; break ;
	case "Previous": $new = "Poprzedni"; break;			
	case "Previous day": $new = "Poprzedni dzieñ"; break;
	case "Previous week": $new = "Poprzedni tydzieñ"; break;

	case "Read more": $new = "Zobacz szczegó³y"; break;
	case "reallydelcat": $new = "Czy na pewno chcesz skasowaæ kategoriê? Wszystkie zdarzenia zwi¹zane z t¹ kategori¹ zostan¹ nieodwracalnie skasowane!"; break;
	case "Repeat": $new = "Powtórz"; break;
	case "results": $new = "rezultaty"; break;
	case "Role": $new = "Rola"; break;			// master translate?

	case "search": $new = "szukaj"; break;
	case "Sort by": $new = "Sortuj"; break ;
	case "Sort by date": $new = "Sortuj wed³ug daty"; break ;
	case "Sort by events": $new = "Sortuj wed³ug zdarzeñ"; break ;
	case "Start Time": $new = "Czas rozpoczêcia"; break ;

	case "thankyou": $new = "Dziêkujemy za dodanie zdarzenia. Pojawi siê ono po zatwierdzeniu"; break;
	case "thankyoupost": $new = "Dziêkujemy za dodanie zdarzenia, zosta³o ono opublikowane."; break;
	case "till": $new = "till"; break;
	case "Time added or updated": $new = "Czas dodania lub aktualizacji"; break ;
	case "timeout msg": $new = "Zmiany w czasie zakoñczenia sesji zostan¹ uwzglêdnione przy nastêpnym logowaniu" ; break ;
	case "times every": $new = "razy, co"; break;	
	case "To": $new = "Do"; break ;
	case "To delete category": $new = "Aby skasowaæ kategoriê"; break ;
	case "Today": $new = "Dzisiaj"; break;
	case "Total": $new = "Razem"; break;
	case "Total number of events for the month": $new = "Ca³kowita liczba zdarzeñ w tym miesi¹cu"; break ;
	case "Total number of events for user": $new = "Ca³kowita liczba zdarzeñ dla u¿ytkownika"; break ;		
	case "Total unapproved events for the month": $new = "Ca³kowita liczba niezatwierdzonych zdarzeñ w tym miesi¹cu" ; break;
	case "Two weeks": $new = "Dwa tygodnie" ; break;	

	case "Update": $new = "Aktualizuj"; break;
	case "Update Event": $new = "Aktualizuj Zdarzenie"; break;
	case "Updating category": $new = "Aktualizacja Kategorii"; break ;
	case "Updating event": $new = "Aktualizacja zdarzenia"; break;
	case "Updating user": $new = "Aktualizacja u¿ytkownika"; break;			
	case "Unapproved events": $new = "Niezatwierdzone zdarzenia"; break ;
	case "User": $new = "U¿ytkownik"; break ;
	case "User Calendar": $new = "Kalendarz U¿ytkownika"; break ;
	case "User description": $new = "Opis U¿ytkownika"; break ;		
	case "User group": $new = "Grupa U¿ytkownika"; break ;				
	case "User Management": $new = "Zarz¹dzanie U¿ytkownikami"; break;
	case "userdelok": $new = "Czy na pewno chcesz skasowaæ tego U¿ytkownika ?"; break;
	case "username": $new = "Nazwa u¿ytkownika"; break;
	case "Username and passwords must be alpha-numeric and without spaces.": $new = "Nazwa U¿ytkownika i has³o musz¹ byæ alfanumeryczne i bez spacji."; break; 	// version 0.4.20030731
	case "Username entered already exists. Please use another username.": $new = "Wprowadzona nazwa U¿ytkowanika ju¿ istnieje. Proszê wybraæ inn¹ nazwê."; break;
	case "users": $new = "u¿ytkownicy"; break;

	case "View": $new = "Widok"; break;
	case "View categories in year": $new = "Zobacz kategorie w roku"; break ;
	case "View details or edit": $new = "Zobacz lub edytuj szczegó³y"; break ;
	case "View event": $new = "Zobacz zdarzenie"; break;
	case "View events of user": $new = "Zobacz zdarzenia u¿ytkownika"; break;
	case "View events under this category in year": $new = "Zobacz zdarzenia w tej kategorii w ci¹gu roku"; break ;
	case "View historical events before": $new = "Zobacz stare zdarzenia przed"; break ;
	case "View month": $new = "Zobacz miesi¹c"; break;
	case "View week": $new = "Zobacz tydzieñ"; break;

	case "Web Calendar Admin Login": $new = "Logowanie administracyjne Calendarix"; break ;
	case "Web Calendar User Login": $new = "Logowanie U¿ytkownika Calendarix"; break ;
	case "week number": $new = "numer tygodnia"; break;
	case "Week starts": $new = "Pocz¹tek tygodnia"; break;
	case "wronglogin": $new = "Nieprawid³owa nazwa u¿ytkownika lub has³o"; break;

	case "Year": $new = "Rok"; break;
	case "Yes": $new = "Tak"; break;		// version 0.4.20030731
	case "Yes, delete event !": $new = "Tak, skasyj to zdarzenie !"; break;
	case "Yes, delete it!": $new = "Tak, skasuj to!"; break;

	default: $new = "<b>".$msgin."</b> musi byæ pzet³umaczone !";    break;

    }
    return $new;
}
?>