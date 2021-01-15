<?php
function translate($msgin){

    switch ($msgin) {
	case "About Calendarix": $new = "About Calendarix"; break ;		
	case "Add": $new = "Uusi"; break ;
	case "Add Category": $new = "Lisää kategoria"; break;
	case "Add Event": $new = "Lisää tapahtuma"; break;
	case "Add event": $new = "Lisää tapahtuma" ; break;
	case "Add new user": $new = "Lisää käyttäjä"; break;
	case "Adding category": $new = "Lisätään kategoria"; break;
	case "Adding event": $new = "Lisätään tapahtuma" ; break ;
	case "Adding user": $new = "Lisätään käyttäjä"; break ;
	case "Administration": $new = "Hallinnointi"; break;
	case "Administrator": $new = "Valvoja"; break ;
	case "All categories": $new = "Kaikki kategoriat"; break ;
	case "Approval needed for posting of events.": $new = "Tapahtumien lisäämiseen tarvitaan hyväksyntä"; break;  
	case "Approvals": $new = "Hyväksynnät"; break ;
	case "Approve": $new = "Hyväksy"; break;
	case "Approving event": $new = "Hyväksytään tapahtuma"; break;

	case "Back": $new = "Takaisin"; break;
	case "Both passwords entered do not match": $new = "Kummatkaan salasanat eivät täsmänneet"; break;

	case "Calendar": $new = "Kalenteri"; break;
	case "Cancel": $new = "Keskeytä"; break ;
	case "Cannot delete current login user": $new = "Kirjautunutta käyttäjää ei voi poistaa"; break ;
	case "Cannot change current login user": $new = "Kirjautunutta käyttäjää ei voi muuttaa"; break;
	case "Cannot have a category with blank name": $new = "Kategoria ei voi olla tyhjä"; break ;
	case "Categories": $new = "Kategoriat"; break;
	case "Category": $new = "Kategoria"; break;
	case "Change": $new = "Muuta"; break ;
	case "Change password/group": $new = "Muuta salasana/ryhmä"; break;
	case "Choose Category": $new = "Valitse kategoria"; break;
	case "Close": $new = "Sulje"; break;
	case "Confirm delete?": $new = "Vahvista poistaminen" ; break ;
	case "Confirm delete all historical events before": $new = "Vahvista ensin poista tapahtumahistoria"; break ;
	case "confirmed events for today": $new = "vahvistetut tapahtumat tänään"; break ;
	case "Confirm password": $new = "Vahvista salasana"; break;
	case "Copy Event": $new = "Kopioi tapahtuma"; break ;
	case "Current Week": $new = "Kuluva viikko"; break;
	case "Current Month": $new = "Kuluva kuukausi"; break;
	case "Current Year": $new = "Kuluva vuosi"; break;		

	case "Date": $new = "Päiväys"; break;
	case "Day": $new = "Päivä"; break;
	case "Delete all historical events listed": $new = "Poista tapahtumien historiatiedot"; break;
	case "Delete category": $new = "Poista kategoria"; break;
	case "Delete event": $new = "Poista tapahtuma"; break;
	case "Delete user": $new = "Poista käyttäjä"; break;
	case "Deleting category": $new = "Kategoria poistetaan"; break;
	case "Deleting event": $new = "Tapahtuma poistetaan"; break ;
	case "Deleting user": $new = "Käyttäjä poistetaan"; break ;
	case "disabled": $new = "poistettu käytöstä"; break;

	case "Edit category": $new = "Muuta kategoriaa"; break;
	case "Edit event": $new = "Muuta tapahtumaa"; break;
	case "Email": $new = "Sähköposti"; break;
	case "End Time": $new = "Loppuaika"; break ;
	case "Event": $new = "Tapahtuma"; break ;
	case "Event Category": $new = "Tapahtumakategoria"; break;
	case "Event Description": $new = "Tapahtuman kuvaus"; break;
	case "Event repeated": $new = "Tapahtuma toistettu"; break;
	case "Event Title": $new = "Tapahtuman otsikko"; break;
	case "events": $new = "tapahtumaa"; break;
	case "Events added will be posted immediately.": $new = "Lisätyt tapahtumat lähetetään välittömästi"; break ;
	case "events awaiting approval": $new = "tapahtumat odottavat hyväksyntää"; break ;
	case "Events before": $new = "Tapahtumaa ennen"; break ;
	case "events for": $new = "tapahtumaa"; break;
	case "Events for day": $new = "Tapahtumaa päivälle"; break;
	case "events for whole calendar": $new = "tapahtumaa kalenterissa"; break;
	case "events for year": $new = "tapahtumaa vuodessa"; break;
	case "Events from ": $new = "Tapahtumaa lähtien"; break;
	case "Events in category": $new = "Tapahtumaa kategoriassa"; break;

	case "From": $new = "Mistä"; break ;

	case "Go to": $new = "Mene"; break;
	case "Go to day": $new = "Mene päivään"; break;
	case "Go to week": $new = "Mene viikkoon"; break;

	case "Historical Items": $new = "Tapahtumahistoria"; break;

	case "Login": $new = "Kirjaudu sisään"; break;
	case "Login session time out in seconds": $new = "Kirjautuminen lopetetaan"; break;
	case "Login session timeout": $new = "Kirjautuminen lopetettu"; break ;
	case "Logout": $new = "Kirjaudu ulos"; break;

	case "Menu": $new = "Menu"; break;
	case "Month": $new = "Kuukausi"; break;
	case "More info": $new = "Lisätietoja"; break;

	case "Next": $new = "Seuraava"; break;				
	case "Next day": $new = "Seuraava päivä"; break;
	case "Next week": $new = "Seuraava viikko"; break;
	case "No categories yet": $new = "Ei vielä kategorioita"; break;
	case "No events": $new = "Ei tapahtumia"; break;
	case "No Repeat": $new = "Ei toistoa"; break;
	case "No results": $new = "Ei tuloksia"; break;
	case "No, go back!": $new = "Ei, takaisin!"; break;
	case "noadminapprove": $new = "ei valvojan hyväksyntää"; break ;
	case "noapprove": $new = "ei hyväksyntää"; break ;
	case "nocat": $new = "ei kategoriaa"; break;
	case "noday": $new = "ei päivää"; break;
	case "nodescription": $new = "ei kuvausta"; break;
	case "nomonth": $new = "Ei kuukautta"; break;
	case "nonapproved": $new = "Ei yhtään hyväksytty"; break;
	case "nononapproved": $new = "Ei yhtään hyväksytty"; break;
	case "notitle": $new = "ei otsikkoa"; break;
	case "noyear": $new = "ei vuotta"; break;

	case "on": $new = "päiväys"; break;
	case "Optional": $new = "Vapaaehtoinen"; break;
	case "or month": $new = "tai kuukausi"; break;
	case "or week": $new = "tai viikko"; break;

	case "password": $new = "salasana"; break;
	case "Please choose the category you only want to view events for": $new = "Valitse kategoria, jonka tapahtumat haluat nähdä ainoastaan"; break; 
	case "Popup Month": $new = "Popup Kuukausi"; break ;
	case "Previous": $new = "Edellinen"; break;			
	case "Previous day": $new = "Edellinen päivä"; break;
	case "Previous week": $new = "Edellinen viikko"; break;

	case "Read more": $new = "Lisätietoja"; break;
	case "reallydelcat": $new = "Poistatko todella kategorian?"; break;
	case "Repeat": $new = "Toista"; break;
	case "results": $new = "tulokset"; break;

	case "search": $new = "etsi"; break;
	case "Sort by": $new = "Lajittele"; break ;
	case "Sort by date": $new = "Lajittele päivämäärällä"; break ;
	case "Sort by events": $new = "Lajittele tapahtumalla"; break ;
	case "Start Time": $new = "Aloitusaika"; break ;

	case "thankyou": $new = "Kiitos"; break;
	case "thankyoupost": $new = "Kiitos tallennuksesta"; break;
	case "till": $new = "asti"; break;
	case "Time added or updated": $new = "Aika lisätty tai muutettu"; break ;
	case "timeout msg": $new = "timeout ilmoitus" ; break ;
	case "times every": $new = "kertaa joka"; break;
	case "To": $new = "Saakka"; break ;
	case "To delete category": $new = "Kategorian poistamiseen"; break ;
	case "Today": $new = "Tänään"; break;
	case "Total": $new = "Yhteensä"; break;
	case "Total number of events for the month": $new = "Kuukauden tapahtumamäärä"; break ;
	case "Total number of events for user": $new = "Käyttäjän tapahtumamäärä"; break ;
	case "Total unapproved events for the month": $new = "Hyväksymättömien tapahtumien määrä kuukaudelle" ; break;
	case "Two weeks": $new = "Kaksi viikkoa" ; break;	

	case "Update": $new = "Päivitä"; break;
	case "Update Event": $new = "Päivitä tapahtuma"; break;
	case "Updating category": $new = "Kategoria päivitetään"; break ;
	case "Updating event": $new = "Tapahtuma päivitetään"; break;
	case "Updating user": $new = "Käyttäjä päivitetään"; break;
	case "Unapproved events": $new = "Hyväksymättömät tapahtumat"; break ;
	case "User": $new = "Käyttäjä"; break ;
	case "User Calendar": $new = "Käyttäjäkalenteri"; break ;
	case "User description": $new = "Käyttäjän kuvaus"; break ;
	case "User group": $new = "Käyttäjäryhmä"; break ;
	case "User Management": $new = "Käyttäjähallinta"; break;
	case "userdelok": $new = "haluatko poistaa käyttäjän?"; break;
	case "username": $new = "käyttäjänimi"; break;
	case "Username entered already exists. Please use another username.": $new = "Käyttäjä on jo olemassa, anna uusi nimi"; break;
	case "users": $new = "käyttäjät"; break;

	case "View": $new = "Näytä"; break;
	case "View categories in year": $new = "Näytä kategoriat vuodessa"; break ;
	case "View details or edit": $new = "Näytä tai muuta yksityiskohdat"; break ;
	case "View event": $new = "Näytä tapahtuma"; break;
	case "View events of user": $new = "Näytä käyttäjän tapahtumat"; break;
	case "View events under this category in year": $new = "Näytä tämän kategorian tapahtumat vuodessa"; break ;
	case "View historical events before": $new = "Näytä tapahtumahistoria ennen"; break ;
	case "View month": $new = "Näytä kuukausi"; break;
	case "View week": $new = "Näytä viikko"; break;

	case "Web Calendar Admin Login": $new = "Calendarix valvoja sisäänkirjautuminen"; break ;
	case "Web Calendar User Login": $new = "Calendarix käyttäjä sisäänkirjautuminen"; break ;
	case "week number": $new = "viikkonumero"; break;
	case "Week starts": $new = "viikko alkaa"; break;
	case "wronglogin": $new = "Virheellinen käyttäjä tai salasana"; break;

	case "Year": $new = "Vuosi"; break;
	case "Yes, delete event !": $new = "Kyllä, poista tapahtuma!"; break;
	case "Yes, delete it!": $new = "Kyllä, poista se!"; break;

	default: $new = "<b>".$zin."</b> behöver översättas!";    break;

    }
    return $new;
}
?>