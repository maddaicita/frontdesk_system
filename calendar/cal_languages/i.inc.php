<?php 
#i.inc.php ver20030818
function translate($msgin){

    switch ($msgin) {
    case "About Calendarix": $new = "Informazioni su Calendarix"; break ;
    case "Add": $new = "Aggiungi"; break ;
    case "Add Category": $new = "Aggiungi Categoria"; break;
    case "Add Event": $new = "Aggiungi Evento"; break;
    case "Add event": $new = "Aggiungi evento" ; break;
    case "Add new user": $new = "Aggiungi nuovo utente"; break;
    case "Adding category": $new = "Aggiunta categoria"; break;
    case "Adding event": $new = "Aggiunta evento" ; break ;
    case "Adding user": $new = "Aggiunta utente"; break ;
    case "Address": $new = "Indirizzo"; break ;
    case "Administration": $new = "Amministrazione"; break;
    case "Administrator": $new = "Amministratore"; break ;
    case "All categories": $new = "Tutte le categorie"; break ;       
    case "Approval needed for posting of events.": $new = "Approvazione richiesta per l'aggiunta di eventi."; break ;
    case "Approvals": $new = "Approvazioni"; break ;
    case "Approve": $new = "Approvato"; break;
    case "Approving event": $new = "Approvazione eventi"; break;
    
    case "Back": $new = "Indietro"; break;
    case "Both passwords entered do not match": $new = "Le password inserite non corrispondono"; break;

    case "Calendar": $new = "Calendario"; break;
    case "Cancel": $new = "Cancella"; break ;
    case "Cannot delete current login user": $new = "Non si può cancellare l'utente corrente"; break ;   
    case "Cannot change current login user": $new = "Non si può modificare l'utente corrente"; break;
    case "Cannot have a category with blank name": $new = "E' necessario inserire un nome per la categoria"; break ;
    case "Categories": $new = "Categorie"; break;
    case "Category": $new = "Categoria"; break;
    case "Change": $new = "Cambia"; break ;
    case "Change password": $new = "Cambia password"; break;
    case "Change password/group": $new = "Cambia password/gruppo"; break; 
    case "Choose Category": $new = "Scegli la Categoria"; break;
    case "Close": $new = "Chiudi"; break;
    case "Confirm delete?": $new = "Confermi la cancellazione?" ; break ;            
    case "Confirm delete all historical events before": $new = "Conferma la cancellazione di tutti gli eventi precedenti"; break ;
    case "confirmed events for today": $new = "Eventi confemati per oggi"; break ;
    case "Confirm password": $new = "Conferma password"; break;         
    case "Copy Event": $new = "Copia evento"; break ;                
    case "Current Week": $new = "Settimana Corrente"; break;
    case "Current Month": $new = "Mese Corrente"; break;
    case "Current Year": $new = "Anno corrente"; break;         

    case "Date": $new = "Data"; break;
    case "Day": $new = "Giorno"; break;
    case "Delete all historical events listed": $new = "Cancella tutti gli eventi visualizzati"; break;
    case "Delete category": $new = "Cancella Categoria"; break;
    case "Delete event": $new = "Cancella evento"; break;
    case "Delete user": $new = "Rimouvi utente"; break;
    case "Deleting category": $new = "Eliminazione categoria"; break;
    case "Deleting event": $new = "Eliminazione evento"; break ;
    case "Deleting user": $new = "Eliminazione utente"; break ;
    case "disabled": $new = "Questa sezione è stata disabilitata"; break;

    case "Edit category": $new = "Modifica Categoria"; break;
    case "Edit event": $new = "Modifica Evento"; break;
    case "Edit information": $new = "Modifica informazione"; break;
    case "Email": $new = "Email"; break;
    case "End Time": $new = "Fino a"; break ;
    case "Event": $new = "Evento"; break ;
    case "Event Category": $new = "Categoria di eventi"; break;
    case "Event Description": $new = "Descrizione dell'evento"; break;
    case "Event repeated": $new = "Evento ripetuto"; break;   
    case "Event Title": $new = "Titolo dell'evento"; break;
    case "events": $new = "eventi"; break;
    case "Events added will be posted immediately.": $new = "Gli eventi saranno aggiunti immediatamente."; break ;
    case "events awaiting approval": $new = "Eventi in attesa di approvazione"; break ;
    case "Events before": $new = "Eventi precedenti"; break ;
    case "events for": $new = "eventi del"; break;
    case "Events for day": $new = "Eventi del giorno"; break;
    case "events for whole calendar": $new = "eventi dell'intero calendario"; break;
    case "events for year": $new = "eventi dell'anno"; break;
    case "Events from ": $new = "Eventi dal "; break;
    case "Events in category": $new = "Eventi nella categoria"; break;

    case "From": $new = "Da"; break ;
    case "Functions": $new = "Funzioni"; break ;

    case "Go to": $new = "Vai a"; break;
    case "Go to day": $new = "Vai al giorno"; break;
    case "Go to week": $new = "Vai alla settimana"; break;

    case "Historical Items": $new = "Archivio Elementi"; break;

    case "Login": $new = "Login"; break;
    case "Login session time out in seconds": $new = "Timeout della sessione in secondi"; break;
    case "Login session timeout": $new = "Timeout della sessione"; break ;
    case "Logout": $new = "Logout"; break;

    case "Menu": $new = "Menu"; break;
    case "Month": $new = "Mese"; break;
    case "More info": $new = "Maggiori informazioni"; break;

    case "Name": $new = "Nome"; break;
    case "Next": $new = "Prossimo"; break;
    case "Next day": $new = "Giorno seguente"; break;
    case "Next week": $new = "Settimana successiva"; break;
    case "No categories yet": $new = "Nessuna categoria presente"; break;
    case "No events": $new = "Nessun evento"; break;
    case "No Repeat": $new = "Nessuna Ripetizione"; break;
    case "No results": $new = "Nessun risultato"; break;
    case "No, go back!": $new = "No, torna indietro!"; break;
    case "No.": $new = "No."; break;
    case "noadminapprove": $new = "L'approvazione di eventi aggiunti dagli amministratori non è necessaria"; break ;
    case "noapprove": $new = "L'approvazione di eventi aggiunti dagli utenti non è necessaria"; break ;
    case "nocat": $new = "Devi selezionare una categoria !"; break;
    case "noday": $new = "Devi scegliere il giorno !"; break;
    case "nodescription": $new = "La descrizione dell'evento è obbligatoria!"; break;
    case "nomonth": $new = "Devi scegliere il mese !"; break;
    case "nonapproved": $new = "Eventi che richiedono l'approvazione : "; break;
    case "nononapproved": $new = "Al momento non ci sono eventi da approvare"; break;
    case "notitle": $new = "L'evento deve avere un titolo !"; break;
    case "noyear": $new = "Devi scegliere l'anno!"; break;

    case "on": $new = "su"; break;
    case "Optional": $new = "Opzionale"; break;
    case "or month": $new = "o il mese"; break;
    case "or week": $new = "o la settimana"; break;

    case "password": $new = "password"; break;
    case "Please choose the category you only want to view events for": $new = "Seleziona la categoria di cui vuoi vedere gli eventi"; break; 
    case "Popup Month": $new = "Popup Mese"; break ;
    case "Previous": $new = "Precedente"; break;
    case "Previous day": $new = "Giorno precedente"; break;
    case "Previous week": $new = "Settimana precedente"; break;

    case "Read more": $new = "Maggiori informazioni"; break;
    case "reallydelcat": $new = "Sei sicuro di volere rimuovere questa categoria? Tutti gli eventi associati verranno cancellati definitivamente!"; break;
    case "Repeat": $new = "Ripeti"; break;
    case "results": $new = "risultati"; break;
    case "Role": $new = "Ruolo"; break;

    case "search": $new = "Ricerca"; break;
    case "Sort by": $new = "Ordina per"; break ;
    case "Sort by date": $new = "Ordina per data"; break ;
    case "Sort by events": $new = "Ordina per evento"; break ;
    case "Start Time": $new = "Inizio"; break ;

    case "thankyou": $new = "Grazie per avere inserito un evento, apparirà in seguito all'approvazione."; break;
    case "thankyoupost": $new = "Grazie per avere inserito un evento, è già stato aggiunto."; break;
    case "till": $new = "fino al"; break;
    case "Time added or updated": $new = "Momento dell'aggiunta o aggiornamento"; break ;
    case "timeout msg": $new = "I cambiamenti del timeout della sessione saranno effettivi al prossimo login." ; break ;
    case "times every": $new = "volte ogni"; break;
    case "To": $new = "A"; break ;
    case "To delete category": $new = "Per cancellare una categoria"; break ;
    case "Today": $new = "Oggi"; break;
    case "Total": $new = "Totale"; break;
    case "Total number of events for the month": $new = "Numero totale di eventi del mese"; break ;
    case "Total number of events for user": $new = "Numero totale di eventi dell'utente"; break ;         
    case "Total unapproved events for the month": $new = "Numero totale di eventi del mese approvati " ; break;
    case "Two weeks": $new = "Due settimane" ; break;     

    case "Update": $new = "Aggiorna"; break;
    case "Update Event": $new = "Aggiorna evento"; break;
    case "Updating user": $new = "Aggiornamento Utente"; break;
    case "Updating category": $new = "Aggiornamento categoria"; break ;
    case "Updating event": $new = "Aggiornamento evento"; break;
    case "Unapproved events": $new = "Eventi non approvati"; break ;
    case "User": $new = "Utente"; break ;
    case "User Calendar": $new = "Calendario utente"; break ;
    case "User description": $new = "Descrizione dell'utente"; break ;
    case "User group": $new = "Gruppo utenti"; break ;
    case "User Management": $new = "Gestione utenti"; break;
    case "userdelok": $new = "Sei sicuro di volere eliminare questo utente?"; break;
    case "username": $new = "username"; break;
    case "Username and passwords must be alpha-numeric and without spaces.": $new = "Username e passwords devono contenere solo carateeri alfa-numerici e niente spazi."; break;
    case "Username entered already exists. Please use another username.": $new = "Nome utente già utilizzato. Inserirne un'altro."; break;
    case "users": $new = "Utenti"; break;

    case "View": $new = "Visualizza"; break;
    case "View categories in year": $new = "Visualizza categorie nell'anno"; break ;
    case "View details or edit": $new = "Visualizza dettagli o modifica"; break ;
    case "View event": $new = "Visualizza evento"; break;
    case "View events of user": $new = "Visualizza gli eventi dell'utente"; break;        
    case "View events under this category in year": $new = "Visualizza eventi in questa categoria quest'anno"; break ;
    case "View historical events before": $new = "Visualizza l'archivio degli eventi precedenti"; break ;
    case "View month": $new = "Visualizza mese"; break;
    case "View week": $new = "Visualizza settimana"; break;

    case "Web Calendar Admin Login": $new = "Calendarix Login Amministratore"; break ;
    case "Web Calendar User Login": $new = "Calendarix Login Utente"; break ;
    case "week number": $new = "settimana numero"; break;
    case "Week starts": $new = "La settimana inizia "; break;
    case "wronglogin": $new = "username or password non corretti"; break;

    case "Year": $new = "Anno"; break;
    case "Yes": $new = "Sì"; break;	
    case "Yes, delete event !": $new = "Sì, cancella l'evento !"; break;
    case "Yes, delete it!": $new = "Sì, cancella !"; break;

    default: $new = "<b>".$msgin."</b>necessita di traduzione !";    break;

    }
    return $new;
}
?>
