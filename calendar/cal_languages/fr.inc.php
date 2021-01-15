<?php
function translate($msgin){

    switch ($msgin) {
	case "About Calendarix": $new = "À propos Calendarix"; break ;        
	case "Add": $new = "Ajouter"; break ;
	case "Add Category": $new = "Ajouter une catégorie"; break;
	case "Add Event": $new = "Ajouter un événement"; break;
	case "Add event": $new = "Ajouter un événement" ; break;
	case "Add new user": $new = "Ajouter un nouvel utilisateur"; break;
	case "Adding category": $new = "Catégorie ajoutée"; break;
	case "Adding event": $new = "Evénement ajouté" ; break ;
	case "Adding user": $new = "Utilisateur ajouté"; break ;
	case "Administration": $new = "Administration"; break;
	case "Administrator": $new = "Administrateur"; break ;
	case "All categories": $new = "Toutes catégories"; break ;       
	case "Approval needed for posting of events.": $new = "L'approbation est nécessaire pour poster un événement."; break;  
	case "Approvals": $new = "Approbations"; break ;
	case "Approve": $new = "Approuvé"; break;
	case "Approving event": $new = "Evénement approuvé"; break;
	
	case "Back": $new = "Retour"; break;
	case "Both passwords entered do not match": $new = "Les mots de passe ne correspondent pas"; break;	

	case "Calendar": $new = "Calendrier"; break;
	case "Cancel": $new = "Annuler"; break ;
	case "Cannot delete current login user": $new = "L'utilisateur en cours ne peux être supprimé"; break ;   
	case "Cannot change current login user": $new = "L'utilisateur en cours ne peut être changé"; break;	
	case "Cannot have a category with blank name": $new = "Une catégorie ne peut pas être nulle"; break ;
	case "Categories": $new = "Catégories"; break;
	case "Category": $new = "Catégorie"; break;
	case "Change": $new = "Changer"; break ;
	case "Change password/group": $new = "Changer de mot de passe/groupe"; break; 		
	case "Choose Category": $new = "Choisir une Catégorie"; break;
	case "Close": $new = "Fermer"; break;
	case "Confirm delete?": $new = "confirmez l'effacement" ; break ;           
	case "Confirm delete all historical events before": $new = "Confirmer la suppression de l'historique de tous les événements"; break ;
	case "confirmed events for today": $new = "Evénements confirmés pour aujourd'hui"; break ;
	case "Confirm password": $new = "Confirmez le mot de passe"; break; 		
	case "Copy Event": $new = "Copie de l'événement"; break ;				
	case "Current Week": $new = "Semaine en cours"; break;
	case "Current Month": $new = "Mois en cours"; break;
	case "Current Year": $new = "Année en cours"; break;		

	case "Date": $new = "Date"; break;
	case "Day": $new = "Jour"; break;
	case "Delete all historical events listed": $new = "Effacer tous les événements listés"; break;
	case "Delete category": $new = "Supprimer la catégorie"; break;
	case "Delete event": $new = "Supprimer l'événement"; break;
	case "Delete user": $new = "Supprimer l'utilisateur"; break;
	case "Deleting category": $new = "La catégorie est supprimée"; break;
	case "Deleting event": $new = "L'événement est supprimé"; break ;
	case "Deleting user": $new = "L'utilisateur est supprimé"; break ;
	case "disabled": $new = "Cette section est inaccessible"; break;

	case "Edit category": $new = "Editer une catégorie"; break;
	case "Edit event": $new = "Editer l'événement"; break;
	case "Email": $new = "Email"; break;
	case "End Time": $new = "Heure de fin"; break ;
	case "Event": $new = "Evénément"; break ;
	case "Event Category": $new = "Catégorie évenementielle"; break;
	case "Event Description": $new = "Description de l'événement"; break;
	case "Event repeated": $new = "Périodicité de l'événement"; break;  
	case "Event Title": $new = "Titre de l'événement"; break;
	case "events": $new = "événements"; break;
	case "Events added will be posted immediately.": $new = "Les événements ajoutés seront intégrés immédiatement."; break ;
	case "events awaiting approval": $new = "événements attendent l'approbation"; break ;
	case "Events before": $new = "Evénements avant le"; break ;
	case "events for": $new = "événéments pour"; break;
	case "Events for day": $new = "Evénements pour la journée"; break;
	case "events for whole calendar": $new = "événements du calendrier"; break;
	case "events for year": $new = "événements pour l'année"; break;
	case "Events from ": $new = "Evénéments du "; break;
	case "Events in category": $new = "Evénéments dans la catégorie"; break;

	case "From": $new = "de"; break ;

	case "Go to": $new = "Aller à"; break; //don't appear in admin mode
	case "Go to day": $new = "Aller au jour"; break;
	case "Go to week": $new = "Aller à la semaine"; break;
	
	case "Historical Items": $new = "Historique"; break;

	case "Login": $new = "Connexion"; break;
	case "Login session time out in seconds": $new = "Durée d'activité de la connexion en secondes"; break;
	case "Login session timeout": $new = "Durée d'activité de la session"; break ;
	case "Logout": $new = "Déconnexion"; break;

	case "Menu": $new = "Menu"; break;
	case "Month": $new = "Mois"; break;
	case "More info": $new = "Plus d'infos"; break;

	case "Next": $new = "Suivante"; break;				
	case "Next day": $new = "Jour suivant"; break;
	case "Next week": $new = "Semaine suivante"; break;
	case "No categories yet": $new = "Pas encore de catégorie"; break;
	case "No events": $new = "Pas d'événements"; break;
	case "No Repeat": $new = "Pas de périodicité"; break;
	case "No results": $new = "Pas de résultats"; break;
	case "No, go back!": $new = "Non, Revenez en arrière !"; break;
	case "noadminapprove": $new = "Approbation des événements ajoutés par les administrateurs sans besoin d'un administrateur"; break ; // don't really understand the meaning
	case "noapprove": $new = "Approbation des événements ajoutés par des utilisateurs sans besoin d'un administrateur"; break ; //idem
	case "nocat": $new = "Vous devez sélectionner une catégorie !"; break;
	case "noday": $new = "Vous devez sélectionner un jour !"; break;
	case "nodescription": $new = "Vous devez donner une description de l'événement !"; break;
	case "nomonth": $new = "Vous devez sélectionner un mois !"; break;
	case "nonapproved": $new = "Evénements qui requièrent une approbation "; break;
	case "nononapproved": $new = "Il n'y a pas d'événements à approuver pour l'instant"; break;
	case "notitle": $new = "Vous devez donner un titre à l'événement !"; break;
	case "noyear": $new = "Vous devez sélectionner une année !"; break;

	case "on": $new = "on"; break;
	case "Optional": $new = "Option"; break;
	case "or month": $new = "ou mois"; break;
	case "or week": $new = "ou semaine"; break;

	case "password": $new = "Mot de passe"; break;
	case "Please choose the category you only want to view events for": $new = "choisissez une catégorie"; break;  
	case "Popup Month": $new = "Fenêtre Popup du mois"; break ;
	case "Previous": $new = "Précédent"; break;			
	case "Previous day": $new = "Jour précédent"; break;
	case "Previous week": $new = "Semaine précédente"; break;

	case "Read more": $new = "Lire plus"; break;
	case "reallydelcat": $new = "Etes vous sûr de vouloir enlever cette catégorie ? Tous les événements associés à cette catégorie seront définitivement effacés !"; break;
	case "Repeat": $new = "Périodicité"; break;
	case "results": $new = "résultats"; break;

	case "search": $new = "chercher"; break;
	case "Sort by": $new = "Trier par"; break ;
	case "Sort by date": $new = "Trier par date"; break ;
	case "Sort by events": $new = "Trier par événements"; break ;
	case "Start Time": $new = "Heure de début"; break ;
	
	case "thankyou": $new = "Merci d'avoir ajouté un événement, il apparaîtra après approbation."; break;
	case "thankyoupost": $new = "Merci d'avoir entré un événement, il a bien été envoyé."; break;
	case "till": $new = "jusqu'au"; break;
	case "Time added or updated": $new = "Heure ajoutée ou mise à jour"; break ;
	case "timeout msg": $new = "Les changements ne seront visibles qu'à la prochaine connexion" ; break ;
	case "times every": $new = "fois"; break;	
	case "To": $new = "A"; break ;
	case "To delete category": $new = "Pour supprimer une catégorie"; break ;
	case "Today": $new = "Aujourd'hui"; break;
	case "Total": $new = "Total"; break;
	case "Total number of events for the month": $new = "Nombre total d'événements pour le mois"; break ;
	case "Total number of events for user": $new = "Nombre total d'événements pour l'utilisateur"; break ;		
	case "Total unapproved events for the month": $new = "Total des événements non approuvés pour le mois" ; break;
	case "Two weeks": $new = "Deux semaines" ; break;    

	case "Update": $new = "Mise à jour"; break;
	case "Update Event": $new = "Mise à jour d'un événement"; break;
	case "Updating category": $new = "Catégorie mise à jour"; break ;
	case "Updating event": $new = "L'événement a été mis à jour"; break;
	case "Updating user": $new = "L'utilisateur à été mis à jour"; break;			
	case "Unapproved events": $new = "Evénéments non approuvés"; break ;
	case "User": $new = "Utilisateur"; break ;
	case "User Calendar": $new = "Utilisateur du calendrier"; break ;
	case "User description": $new = "Profile de l'utilisateur"; break ;        
	case "User Management": $new = "Gestion des utilisateurs"; break;
	case "User group": $new = "Group de l'utilisateur"; break ;
	case "userdelok": $new = "Etes-vous sûr de vouloir supprimer l'utilisateur ?"; break;
	case "username": $new = "Nom d'utilisateur"; break;
	case "Username entered already exists. Please use another username.": $new = "Le nom d'utilisateur choisi existe déjà. Choisissez-en un autre"; break;
	case "users": $new = "utilisateurs"; break;

	case "View": $new = "Voir"; break;
	case "View categories in year": $new = "Voir les catégories de l'année"; break ;
	case "View details or edit": $new = "Voir les détails ou les éditer"; break ;
	case "View event": $new = "Voir l'événement"; break;
	case "View events of user": $new = "Voir les événements de cet utilisateur"; break;
	case "View events under this category in year": $new = "Voir les événements de cette catégorie dans l'année"; break ;
	case "View historical events before": $new = "Voir l'historique des événements"; break ;
	case "View month": $new = "Voir mois"; break;
	case "View week": $new = "Voir semaine"; break;

	case "Web Calendar Admin Login": $new = "Calendarix Connexion de l'administrateur"; break ;
	case "Web Calendar User Login": $new = "Calendarix Connexion de l'utilisateur"; break ;
	case "week number": $new = "Numéros de la semaine"; break;
	case "Week starts": $new = "La semaine commence le "; break;
	case "wronglogin": $new = "Nom d'utilisateur ou mot de passe incorrects"; break;

	case "Year": $new = "Année"; break;
	case "Yes, delete event !": $new = "Oui, suppression de l'événement !"; break;
	case "Yes, delete it!": $new = "Oui, le supprimer!"; break;

	default: $new = "<b>".$msgin."</b> needs to be translated !";    break;

    }
    return $new;
}
?>