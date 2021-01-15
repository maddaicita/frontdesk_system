<?php
function translate($msgin){  
//	case "language": $new = "newlanguage"; break ;		// added 05.03.2006 JOA Total records parsed                                       //  event ==> activiteit

    switch ($msgin) {

    case "1st": $new = "1ste"; break ;      // added 05.03.2006 JOA       
    case "2nd": $new = "2de"; break ;       // added 05.03.2006 JOA       
    case "3rd": $new = "3de"; break ;       // added 05.03.2006 JOA       
    case "4th": $new = "4de"; break ;       // added 05.03.2006 JOA       
    case "minutes": $new = "minuten"; break ;       // added 25.02.2007 JOA  
    case "day": $new = "dag"; break ;       // added 25.02.2007 JOA  
    case "days": $new = "dagen"; break ;       // added 25.02.2007 JOA  
    case "hour": $new = "uur"; break ;       // added 25.02.2007 JOA  
    case "hours": $new = "uren"; break ;       // added 25.02.2007 JOA  

    case "About Calendarix": $new = "Over Calendarix"; break ;      // changed 05.03.2006 JOA
    case "Account": $new = "Account"; break ;       // added 05.03.2006 JOA    
    case "Activate": $new = "Activeer"; break ;     // added 05.03.2006 JOA     
    case "Add": $new = "Toevoegen"; break ;
    case "Add Category": $new = "Categorie toevoegen"; break;
    case "Add Event": $new = "Activiteit toevoegen"; break;
    case "Add event": $new = "Activiteit toevoegen" ; break;
    case "Add new user": $new = "Nieuwe gebruiker toevoegen"; break;
    case "Adding category": $new = "Categorie: toevoeging in verwerking"; break;
    case "Adding event": $new = "Activiteit: toevoeging in verwerking" ; break ;
    case "Adding user": $new = "Gebruiker: toevoeging in verwerking"; break ;
    case "Address": $new = "Adres"; break ;     // added 05.03.2006 JOA     
    case "Administration": $new = "Administratie"; break;
    case "Administrator": $new = "Hoofdgebruiker"; break ;
    case "All categories": $new = "Alle categorieën"; break ;       // changed 05.03.2006 JOA
    case "Allowed Views in User Calendar": $new = "Toegelaten Zichten"; break ;     // added 05.03.2006 JOA        
    case "Allowed search in User Calendar": $new = "Toegelaten Zoekactie"; break ;      // added 05.03.2006 JOA           
    case "Apply": $new = "Toepassen"; break ;       // added 05.03.2006 JOA      
    case "Approval needed for posting of events.": $new = "Toelating vereist om activiteiten toe te voegen."; break ;
    case "Approvals": $new = "Toelatingen"; break ;
    case "Approve": $new = "Geef toestemming"; break;
    case "Approving event": $new = "Goedkeuring Activiteit"; break;
    case "Assign Categories": $new = "Categorie toekennen"; break ;      // added 25.02.2007 JOA
    case "Assign": $new = "Categorie toekennen"; break ;      // added 25.02.2007 JOA
    case "Assign selected categories?": $new = "Geselecteerde categories toekennen?"; break ;      // added 25.02.2007 JOA
    case "Assign to all users": $new = "Toekennen aan alle gebruikers"; break ;      // added 25.02.2007 JOA
		
    case "Back": $new = "Terug"; break;
    case "Both passwords entered do not match": $new = "Beide ingegeven wachtwoorden stemmen niet overéén"; break;	//new translation 08/03/2007 Terwolde    

    case "Calendar": $new = "Kalender"; break;
    case "Calendar Access": $new = "Kalender Toegang"; break ;      // added 05.03.2006 JOA      
    case "Calendar Name": $new = "Kalender Naam"; break ;       // added 05.03.2006 JOA                  
    case "Calendarix theme": $new = "Kalender thema"; break ;    //new translation 08/03/2007 Terwolde
    case "Cancel": $new = "Annuleer"; break ;
    case "Cannot delete current login user": $new = "Kan login van huidige gebruiker niet verwijderen"; break ;   
    case "Cannot change current login user": $new = "Kan login van huidige gebruiker niet wijzigen"; break; 
    case "Cannot have a category with blank name": $new = "Categorie mag niet blanco zijn"; break ;
    case "Categories": $new = "Categorie"; break;
    case "Category": $new = "Categorie"; break;
    case "Category color": $new = "Categorie kleur"; break ;        // added 05.03.2006 JOA       
    case "Change": $new = "Wijzig"; break ;
    case "Change password": $new = "Wijzig wachtwoord"; break ;   //new translation 08/03/2007 Terwolde     
    case "Change password/group": $new = "Wijzig wachtwoord/groep"; break;   //new translation 08/03/2007 Terwolde        
    case "Choose Category": $new = "Kies Categorie"; break;
    case "Click to select the color": $new = "Klik op een kleur om te selecteren"; break ;      // added 05.03.2006 JOA                          
    case "Close": $new = "Sluit"; break;
    case "Color": $new = "Kleur"; break ;       // added 05.03.2006 JOA      
    case "Color Picker": $new = "Kleurkiezer"; break ;      // added 05.03.2006 JOA                         
    case "Coming Events": $new = "Komende activiteiten"; break ;        // added 05.03.2006 JOA      
    case "Company Name": $new = "Naam Organisatie"; break ;     // added 05.03.2006 JOA                 
    case "Confirm delete?": $new = "Bevestig verwijderen?" ; break ;
    case "Confirm delete all historical events before": $new = "Bevestig wissen van alle vervallen activiteiten"; break ;
    case "confirmed events for today": $new = "Bevestigde activiteiten voor vandaag"; break ;
    case "Confirm password": $new = "Bevestig wachtwoord"; break;      	//new translation 08/03/2007 Terwolde         
    case "Copy Event": $new = "Kopieer activiteit"; break ;
    case "Create theme": $new = "Aanmaken uitzicht"; break ;        // added 05.03.2006 JOA    
    case "Currency": $new = "Valuta"; break ;       // added 05.03.2006 JOA                        
    case "Current Color": $new = "Huidige kleur"; break ;       // added 05.03.2006 JOA                           
    case "Current Week": $new = "Huidige week"; break;
    case "Current Month": $new = "Huidige maand"; break;
    case "Current Set": $new = "Huidige instelling"; break ;        // added 05.03.2006 JOA                           
    case "Current Year": $new = "Huidig jaar"; break;

    case "Date": $new = "Datum"; break;
    case "Date/Time Configuration": $new = "Datum/Tijd instellingen"; break ;       // added 05.03.2006 JOA            
    case "Day/Week/Listing View": $new = "Zicht Dag/Week/Lijsten"; break ;      // added 05.03.2006 JOA                               
    case "Day": $new = "Dag"; break;
    case "Deactivate": $new = "Inactiveer"; break ;     // added 05.03.2006 JOA     
    case "Default": $new = "Standaard"; break ;     // added 05.03.2006 JOA      
    case "Default Category": $new = "Basiscategorie"; break ;       // added 05.03.2006 JOA      
    case "Delete": $new = "Verwijder"; break;       // added 05.03.2006 JOA
    case "Delete all historical events listed": $new = "Verwijder alle weergegeven en verlopen activiteiten"; break;
    case "Delete category": $new = "Verwijder categorie"; break;
    case "Delete event": $new = "Verwijder activiteit"; break;
    case "Delete user": $new = "Verwijder gebruiker"; break;
    case "Deleting category": $new = "Categorie aan het verwijderen"; break;
    case "Deleting event": $new = "Activiteit aan het verwijderen"; break ;
    case "Deleting user": $new = "Gebruiker aan het verwijderen"; break ;
    case "deluserevok": $new = "Verwijder gebruiker"; break ;       // added 05.03.2006 JOA     
    case "Description": $new = "Omschrijving"; break ;      // added 05.03.2006 JOA    
    case "Details": $new = "Details"; break ;       // added 05.03.2006 JOA         
    case "disabled": $new = "Dit onderdeel is niet toegankelijk"; break;
    case "Display Settings": $new = "Scherm instellingen"; break ;      // added 05.03.2006 JOA   
    case "Display Areas": $new = "Tonen Schermdelen"; break ;       // added 05.03.2006 JOA             

    case "Edit": $new = "Wijzig"; break;        // added 05.03.2006 JOA
    case "Edit category": $new = "Wijzig categorie"; break;
    case "Edit event": $new = "Wijzig activiteit"; break;
    case "Edit information": $new = "Wijzig informatie"; break ;        // added 05.03.2006 JOA    
    case "Edit Holidays": $new = "Wijzig feestdagen"; break ;       // added 05.03.2006 JOA     
    case "Email": $new = "Email"; break;
    case "End Time": $new = "Eindtijd"; break ;
    case "Activiteit": $new = "Activiteit"; break ;
    case "Event": $new = "Activiteit"; break;  // added 05.03.2006 JOA 
    case "Event Borders": $new = "Randen Activiteit"; break ;       // added 05.03.2006 JOA                                  
    case "Event Category": $new = "Activiteit categorie"; break;
    case "Event Description": $new = "Activiteit omschrijving"; break;
    case "Event Display": $new = "Bekijk Activiteit"; break ;        //new translation 08/03/2007 Terwolde
    case "Event repeated": $new = "Herhaalde Activiteit"; break;  
    case "Event Title": $new = "Titel van de activiteit"; break;
    case "events": $new = "activiteit"; break;
    case "Events added will be posted immediately.": $new = "Toegevoegde activiteiten worden onmiddelijk weergegeven."; break ;
    case "events awaiting approval": $new = "Activiteiten die nog dienen goedgekeurd te worden"; break ;
    case "Events before": $new = "Verlopen activiteiten"; break ;
    case "events for": $new = "Activiteiten voor"; break;
    case "Events for day": $new = "Activiteiten voor dag"; break;
    case "events for whole calendar": $new = "Activiteiten voor de gehele kalender"; break;
    case "events for year": $new = "Activiteiten voor jaar"; break;
    case "Events from ": $new = "Activiteiten vanaf "; break;
    case "Events in category": $new = "Activiteiten per categorie"; break;
    case "event entry starts here": $new = "Start activiteit"; break ;      // added 05.03.2006 JOA       
    case "every": $new = "iedere"; break ;      // added 05.03.2006 JOA      
    case "Every year": $new = "Ieder jaar"; break ;     // added 05.03.2006 JOA      
    case "Everyone": $new = "Iedereen"; break ;     // added 05.03.2006 JOA      
    case "Export": $new = "Exporteer"; break ;      // added 05.03.2006 JOA    
    case "Export Page Events": $new = "Exporteer pagina"; break ;       // added 05.03.2006 JOA    
    case "Export Style Sheet": $new = "Exporteer Stijlpagina"; break ;      // added 05.03.2006 JOA                                    

    case "Fee": $new = "Bijdrage"; break ;      // changed 05.03.2006 JOA
    case "Font": $new = "Font"; break ;     // added 05.03.2006 JOA                            
    case "Font Family": $new = "Font Familie"; break ;      // added 05.03.2006 JOA                            
    case "Font Size": $new = "Font Grootte"; break ;        // added 05.03.2006 JOA                            
    case "Font Style": $new = "Font Stijl"; break ;     // added 05.03.2006 JOA                            
    case "Font Weight": $new = "Font Gewicht"; break ;      // added 05.03.2006 JOA                            
    case "Footer Text": $new = "Voettekst"; break ;     // added 05.03.2006 JOA                       
    case "Form Objects": $new = "Formuliervelden"; break ;      // added 05.03.2006 JOA                         
    case "From": $new = "Van"; break ;
    case "Functions": $new = "Functies"; break ;        // added 05.03.2006 JOA 

    case "General Settings": $new = "Algemene Instellingen"; break ;        // added 05.03.2006 JOA     
    case "Go to": $new = "Ga naar"; break;
    case "Go to day": $new = "Ga naar dag"; break;
    case "Go to week": $new = "Ga naar week"; break;
    case "Group": $new = "Groep"; break ;       // added 05.03.2006 JOA      

    case "Highlight Colors": $new = "Oplichtende kleuren"; break ;      // added 05.03.2006 JOA                                   
    case "Historical Items": $new = "Verlopen items"; break;
    case "Holidays": $new = "Feestdagen"; break ;       // added 05.03.2006 JOA    
    case "Holiday Text": $new = "Tekst Feestdagen"; break ;     // added 05.03.2006 JOA                     

    case "Include Files": $new = "Include Bestanden"; break ;       // added 05.03.2006 JOA                
    
    case "last": $new = "laatste"; break ;      // added 05.03.2006 JOA       
    case "leave blank if default font color is used": $new = "laat blank indien standaard kleur"; break ;       // added 05.03.2006 JOA       
    case "Legend": $new = " Legende "; break ;      // added 05.03.2006 JOA  
    case "List All": $new = "Toon alle categorieën"; break ;        // added 05.03.2006 JOA    
    case "Listing Blocks": $new = "Tekst Lijsten"; break ;      // added 05.03.2006 JOA   
    case "Location": $new = "Plaats"; break ;      // added 25.02.2007 JOA
    case "Login": $new = "Login"; break;
    case "Login session time out in seconds": $new = "Aantal seconden, waarna de gebruiker uitgelogd wordt"; break;
    case "Login session timeout": $new = "Login sessie verlopen"; break ;//new translation 08/03/2007 Terwolde
    case "Logout": $new = "Uitloggen"; break;//new translation 08/03/2007 Terwolde

    case "Mail Configuration": $new = "Mail Instellingen"; break ;      // added 05.03.2006 JOA               
    case "Menu": $new = "Menu"; break;
    case "Menus and Titles": $new = "Bekijk Menus en Titels"; break ;        //new translation 08/03/2007 Terwolde
    case "Mini-Calendar": $new = "Mini-Kalender"; break ;       // added 05.03.2006 JOA              
    case "Month": $new = "Maand"; break;
    case "Month View": $new = "Bekijk Maandkalender"; break ;        //new translation 08/03/2007 Terwolde
    case "Month View Text": $new = "Tekst Maandkalender"; break ;       // added 05.03.2006 JOA                   
    case "More info": $new = "Meer info"; break;

    case "Name": $new = "Naam"; break ;     // added 05.03.2006 JOA 
    case "Next": $new = "Volgende"; break;              
    case "Next day": $new = "Volgende dag"; break;
    case "Next week": $new = "Volgende week"; break;
    case "No": $new = "Nee"; break ;        // added 05.03.2006 JOA 
    case "No.": $new = "Nr."; break ;       // added 05.03.2006 JOA 
    case "No categories yet": $new = "Geen categorie op dit moment"; break;
    case "No Default": $new = "Geen categorie"; break ;     // added 05.03.2006 JOA 
    case "No events": $new = "Geen activiteiten"; break;
    case "No fees": $new = "Geen bijdragen"; break ;        // added 05.03.2006 JOA        
    case "No Repeat": $new = "Geen herhaling"; break;
    case "No results": $new = "Geen resultaten"; break;
    case "No, go back!": $new = "Nee, ga terug!"; break;//new translation 08/03/2007 Terwolde
    case "No Reminder": $new = "Geen herinnering"; break ;       // added 25.02.2007 JOA  
    case "noadminapprove": $new = "Goedkeuring activiteiten niet vereist voor de hoofdgebruiker zelf"; break ;
    case "noapprove": $new = "Goedkeuring van activiteiten, door gebruikers toegevoegd, niet vereist voor hoofdgebruiker"; break ;
    case "nocat": $new = "Gelieve een categorie te selecteren !"; break;
    case "noday": $new = "Gelieve een dag te selecteren !"; break;
    case "nodescription": $new = "Gelieve een omschrijving voor de activiteit in te geven!"; break;
    case "nofee": $new = "Bijdrage ongeldig"; break ;       // added 05.03.2006 JOA                                    
    case "nomonth": $new = "Gelieve een maand te selecteren !"; break;
    case "nonapproved": $new = "Activiteiten die een goedkeuring vereisen : "; break;
    case "nononapproved": $new = "Op dit ogenblik zijn er geen activiteiten die een goedkeuring vereisen "; break;
    case "notitle": $new = "Gelieve een titel voor deze activiteit op te geven !"; break;
    case "Notify": $new = "Informeer"; break ;      // added 05.03.2006 JOA       
    case "noyear": $new = "Gelieve een jaartal op te geven !"; break;

    case "on": $new = "aan"; break;  
    case "Once on": $new = "Eenmaal op"; break ;        // added 05.03.2006 JOA      
    case "Optional": $new = "Nie verplicht"; break;	//new translation 08/03/2007 Terwolde
    case "Options": $new = "Optie"; break ;     // added 05.03.2006 JOA       
    case "or month": $new = "of maand"; break;
    case "or week": $new = "of week"; break;
    case "Other Text": $new = "Andere Tekst"; break ;       // added 05.03.2006 JOA                            

    case "Page Body": $new = "Zicht Pagina Midden"; break ;     // added 05.03.2006 JOA                              
    case "password": $new = "wachtwoord"; break;      //new translation 08/03/2007 Terwolde
    case "Please choose the category you only want to view events for": $new = "Kies de categorie waarvoor je de activiteiten wil zien"; break;  // changed 05.03.2006 JOA
    case "Please enter email address, separated by commas, for people to be notified of the event": $new = "Geef voor elke persoon, die je op de hoogte wil brengen, het emailadres gescheiden door een komma. Selecteer een tijdstip en klik op Planning"; break ;       // added 25.02.2007 JOA 
    case "Popup Month": $new = "Popup Maand"; break ;
    case "Popup Settings": $new = "Popup Instellingen"; break ;     // added 05.03.2006 JOA         
    case "Popup Window Text": $new = "Tekst Popup Window"; break ;      // added 05.03.2006 JOA                    
    case "Previous": $new = "Vorige"; break;            
    case "Previous day": $new = "Vorige dag"; break;
    case "Previous week": $new = "Vorige week"; break;
    case "Print": $new = "Afdrukken"; break ;       // added 05.03.2006 JOA  
    case "Print Preview": $new = "Afdrukvoorbeeld"; break ;     // added 05.03.2006 JOA  
    case "Private": $new = "Privaat"; break ;       // added 05.03.2006 JOA      

    case "Read more": $new = "Meer info"; break;
    case "reallydelcat": $new = "Bent u zeker dat u deze categorie wenst te verwijderen? Alle activiteiten gekoppeld aan deze categorie zullen definitief verwijderd worden !"; break;
    case "records with fees": $new = "activiteiten met bijdragen"; break ;      // added 05.03.2006 JOA                                     
    case "Refresh": $new = "Vernieuw scherm"; break ;       // added 05.03.2006 JOA                
    case "Reminder": $new = "Herinnering"; break ;       // added 25.02.2007 JOA  
    case "Repeat": $new = "Herhaal"; break;
    case "repeat every year on": $new = "herhaal elk jaar op"; break ;      // added 05.03.2006 JOA       
    case "results": $new = "resultaten"; break;
    case "Role": $new = "Rol"; break ;      // added 05.03.2006 JOA 
    case "Row Listings": $new = "Zicht Lijsten"; break ;        // added 05.03.2006 JOA                                

    case "Scope": $new = "Aard"; break ;        // added 05.03.2006 JOA      
    case "search": $new = "zoek"; break;
    case "Select": $new = "Selecteer"; break ;      // added 05.03.2006 JOA       
    case "Select location": $new = "Selecteer plaats"; break ;		// added 25.02.2007 JOA
    case "Select users": $new = "Selecteer gebruikers"; break ;     // added 05.03.2006 JOA       
    case "Select All": $new = "Selecteer Alles"; break ;      // added 25.02.2007 JOA
    case "Settings": $new = "Instellingen"; break ;     // added 05.03.2006 JOA  
    case "Schedule": $new = "Planning"; break ;     // added 25.02.2007 JOA
    case "Sort by": $new = "Sorteer op"; break ;
    case "Sort by date": $new = "Sorteer op datum"; break ;
    case "Sort by activiteiten": $new = "Sorteer op activiteiten"; break ;
    case "Start Time": $new = "Begin uur"; break ;
    case "Sum": $new = "Bereken totaal"; break ;        // added 05.03.2006 JOA        

    case "Text Align": $new = "Tekst Uitlijnen"; break ;        // added 05.03.2006 JOA                            
    case "Text Decoration": $new = "Tekst Decoratie"; break ;       // added 05.03.2006 JOA                            
    case "Text Settings": $new = "Tekst instellingen"; break ;      // added 05.03.2006 JOA     
    case "thankyou": $new = "Dank u voor het toevoegen van deze activiteit, ze zal toegevoegd worden na goedkeuring."; break;
    case "thankyoupost": $new = "Dank u voor het toevoegen van een activiteit, ze is toegevoegd in de agenda."; break;
    case "This will disable current theme for configuration. Proceed?": $new = "Alle huidige instellingen worden te niet gedaan. Verder gaan?"; break ;     // added 05.03.2006 JOA    
    case "till": $new = "tot"; break;
    case "Time added or updated": $new = "Tijd toegevoegd of aangepast"; break ;
    case "timeout msg": $new = "Aanpassingen gedurende de timeout-sessie worden pas effectief na de volgende login" ; break ;
    case "times every": $new = "tijden allemaal"; break;    
    case "Title": $new = "Titel"; break ;       // added 05.03.2006 JOA        
    case "To": $new = "Tot"; break ;  // changed 05.03.2006 JOA
    case "To delete category": $new = "Om een categorie te verwijderen"; break ;
    case "Today": $new = "Vandaag"; break;
    case "Total": $new = "Totaal"; break;
    case "Total fee": $new = "Totaal aan bijdragen"; break ;        // added 05.03.2006 JOA                                      
    case "Total number of events for the month": $new = "Totaal aantal activiteiten voor de maand"; break ;
    case "Total number of events for user": $new = "Totaal aantal activiteiten door deze gebruiker ingevoerd"; break ;
    case "Total records parsed": $new = "Totaal aantal activiteiten"; break ;       // added 05.03.2006 JOA                                      
    case "Total unapproved events for the month": $new = "Totaal aantal niet goedgekeurde activiteiten voor de maand" ; break;
    case "Two weeks": $new = "Twee wekelijks"; break;

    case "under category": $new = "onder categorie"; break ;        // added 05.03.2006 JOA        
    case "Unselect All": $new = "Deselecteer Alles"; break ;      // added 25.02.2007 JOA
    case "Update": $new = "Wijzigingen toepassen"; break;
    case "Update Event": $new = "Aanpassing activiteit"; break;
    case "Update All Repeated Events": $new = "Pas alle herhalingen aan"; break;  // added 25.02.2007 JOA
    case "Updating": $new = "Aanpassing"; break ;   // added 05.03.2006 JOA
    case "Updating category": $new = "Aanpassing  categorie"; break ;
    case "Updating event": $new = "Aanpassing activiteit"; break;
    case "Updating user": $new = "Aanpassing gebruiker"; break;         
    case "Unapproved events": $new = "Niet goedgekeurde activiteiten"; break ;
    case "User": $new = "Gebruiker"; break ;
    case "User Calendar": $new = "Gebruiker kalender"; break ;
    case "User description": $new = "Gebruiker beschrijving"; break ;       // changed 05.03.2006 JOA
    case "User Management": $new = "Gebruikersbeheer"; break;
    case "User group": $new = "Gebruikersgroep"; break ;                
    case "userdelok": $new = "Bent u zeker dat u deze gebruiker wenst te verwijderen ?"; break;
    case "username": $new = "Gebruikersnaam"; break;
    case "Username entered already exists. Please use another username.": $new = "Ingevoerde gebruikersnaam bestaat reeds. Gelieve een andere gebruikersnaam te kiezen."; break;
    case "users": $new = "gebruikers"; break;
    case "User does not exist but events belonging to user exists": $new = "Gebruiker bestaat niet maar wel activiteiten van hem/haar"; break ;     // added 05.03.2006 JOA          

    case "Value": $new = "Waarde"; break ;      // added 05.03.2006 JOA       
    case "Variable": $new = "Variabele"; break ;        // added 05.03.2006 JOA      
    case "View": $new = "Bekijk"; break;
    case "View categories in year": $new = "Bekijk de categorien van het jaar"; break ;
    case "View details or edit": $new = "Bekijk details of wijzig"; break ;
    case "View event": $new = "Bekijk activiteit"; break;
    case "View events of user": $new = "Bekijk de ingevoerde activiteiten van deze gebruiker"; break;
    case "View events under this category in year": $new = "Bekijk activiteiten in deze categorie voor het jaar"; break ;
    case "View historical events before": $new = "Bekijk verlopen activiteiten voor"; break ;
    case "View month": $new = "Bekijk maand"; break;
    case "View week": $new = "Bekijk week"; break;

    case "Web Calendar Admin Login": $new = "Login Hoofdgebruiker"; break ;
    case "Web Calendar User Login": $new = "Login Gebruiker"; break ;
    case "Website": $new = "Website"; break ;       // added 05.03.2006 JOA     
    case "week number": $new = "week nummer"; break;
    case "Week starts": $new = "Week begint op"; break;  // changed 05.03.2006 JOA
    case "wronglogin": $new = "Foutieve gebruikersnaam of foutief wachtwoord"; break;      //new translation 08/03/2007 Terwolde

    case "Year": $new = "Jaar"; break;
    case "Yes": $new = " [ Ja ] "; break ;      // added 05.03.2006 JOA     
    case "Yes, delete event !": $new = "Ja, verwijder activiteit !"; break;
    case "Yes, delete it!": $new = "Ja, verwijder het!"; break;

    default: $new = "<b>".$msgin."</b> needs to be translated !";    break;

    }
    return $new;
}
?>
