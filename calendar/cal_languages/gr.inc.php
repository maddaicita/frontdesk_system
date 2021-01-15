<?php
function translate($msgin){
    switch ($msgin) {
	case "About Calendarix": $new = " Σχετικά με το Calendarix"; break ;		
	case "Add": $new = " Προσθέστε "; break ;
	case "Add Category": $new = " Προσθέστε Κατηγορία "; break;
	case "Add Event": $new = " Προσθέστε γεγονός "; break;
	case "Add event": $new = " Προσθέστε γεγονός " ; break;
	case "Add new user": $new = " Προσθέστε vέο χρήστη "; break;
	case "Adding category": $new = " Προσθήκη κατηγορίας "; break;
	case "Adding event": $new = " Προσθήκη γεγονότος " ; break ;
	case "Adding user": $new = " Προσθήκη χρήστη "; break ;
	case "Address": $new = " Διεύθυνση "; break ;			// master translate?
	case "Administration": $new = " Διοίκηση "; break;
	case "Administrator": $new = "Administrator"; break ;
	case "All categories": $new = " Όλες οι κατηγορίες "; break ;		
	case "Approval needed for posting of events.": $new = " Απαιτείται έγκριση για την αποστολή των γεγονότων."; break;  
	case "Approvals": $new = " Εγκρίσεις "; break ;
	case "Approve": $new = " Εγκρίνετε "; break;
	case "Approving event": $new = " Έγκριση γεγονότος "; break;
	
	case "Back": $new = "Πίσω"; break;
	case "Both passwords entered do not match": $new = " Οι κωδικοί που πληκτρολογούνται δεν ταιριάζουν "; break;	

	case "Calendar": $new = " Ημερολόγιο "; break;
	case "Cancel": $new = " ’κυρο "; break ;
	case "Cannot delete current login user": $new = " Δεν μπορείτε να διαγράψετε τον τρέχοντα χρήστη όσο είναι συνδεδεμένος "; break ;   
	case "Cannot change current login user": $new = " Δεν μπορείτε να αλλάξετε τον τρέχοντα χρήστη όσο είναι συνδεδεμένος "; break;	
	case "Cannot have a category with blank name": $new = " Δεν μπορείτε να έχετε μια κατηγορία με κενό όνομα "; break ;
	case "Categories": $new = " Κατηγορίες "; break;
	case "Category": $new = " Κατηγορία "; break;
	case "Change": $new = " Αλλαγή "; break ;
	case "Change password": $new = " Αλλαγή κωδικού πρόσβασης "; break; 		// master translate?
	case "Change password/group": $new = " Αλλαγή κωδικού πρόσβασης/ομάδας "; break; 	// master obsolete?	
	case "Choose Category": $new = " Επιλέξτε κατηγορία "; break;
	case "Close": $new = " Κλείστε "; break;
	case "Confirm delete?": $new = " Επιβεβαιώστε τη διαγραφή?" ; break ;			
	case "Confirm delete all historical events before": $new = " Επιβεβαιώστε τη διαγραφή από όλα τα ιστορικά γεγονότα πριν από "; break ;
	case "confirmed events for today": $new = " επιβεβαιωμένα γεγονότα για σήμερα "; break ;
	case "Confirm password": $new = " Επιβεβαιώστε τον κωδικό πρόσβασης "; break; 		
	case "Copy Event": $new = " Αντιγράψτε το γεγονός "; break ;				
	case "Current Week": $new = " Τρέχουσα εβδομάδα "; break;
	case "Current Month": $new = " Τρέχων μήνας "; break;
	case "Current Year": $new = " Τρέχον έτος "; break;		

	case "Date": $new = " Ημερομηνία "; break;
	case "Day": $new = " Ημέρα "; break;
	case "Delete all historical events listed": $new = " Διαγράψτε όλα τα ιστορικά γεγονότα που απαριθμούνται "; break;
	case "Delete category": $new = " Διαγράψτε την κατηγορία "; break;
	case "Delete event": $new = " Διαγράψτε το γεγονός "; break;
	case "Delete user": $new = " Διαγράψτε το χρήστη "; break;
	case "Deleting category": $new = " Διαγραφή της κατηγορίας "; break;
	case "Deleting event": $new = " Διαγραφή του γεγονότος "; break ;
	case "Deleting user": $new = " Διαγραφή του χρήστη "; break ;
	case "disabled": $new = " Αυτό το τμήμα έχει τεθεί εκτός λειτουργίας "; break;

	case "Edit category": $new = " Αλλαγή της κατηγορίας "; break;
	case "Edit event": $new = " Αλλαγή του γεγονότος "; break;
	case "Edit information": $new = " Αλλαγή των πληροφορίων "; break;	// master translate?
	case "Email": $new = "Email"; break;
	case "End Time": $new = " Χρόνος τέλους "; break ;
	case "Event": $new = " Γεγονός "; break ;
	case "Event Category": $new = " Κατηγορία γεγονότος "; break;
	case "Event Description": $new = " Περιγραφή γεγονότος "; break;
	case "Event repeated": $new = " Επαναλαμβανόμενο γεγονός "; break;  
	case "Event Title": $new = " Τίτλος γεγονότος "; break;
	case "events": $new = " γεγονότα "; break;
	case "Events added will be posted immediately.": $new = " Τα γεγονότα που προστέθηκαν θα ταχυδρομηθούν αμέσως."; break ;
	case "events awaiting approval": $new = " γεγονότα που αναμένουν έγκριση "; break ;
	case "Events before": $new = " Γεγονότα πριν από"; break ;
	case "events for": $new = " γεγονότα για "; break;
	case "Events for day": $new = " Γεγονότα για την ημέρα "; break;
	case "events for whole calendar": $new = " γεγονότα για ολόκληρο το ημερολόγιο "; break;
	case "events for year": $new = " γεγονότα για το έτος "; break;
	case "Events from ": $new = " Γεγονότα από "; break;
	case "Events in category": $new = " Γεγονότα στην κατηγορία "; break;

	case "From": $new = " Από "; break ;
	case "Functions": $new = " Λειτουργίες "; break ;	// master translate?

	case "Go to": $new = " Πηγαίνετε "; break;
	case "Go to day": $new = " Πηγαίνετε στην ημέρα "; break;
	case "Go to week": $new = " Πηγαίνετε στην εβδομάδα "; break;

	case "Historical Items": $new = " Ιστορικά στοιχεία "; break;

	case "Login": $new = " Σύνδεση "; break;
	case "Login session time out in seconds": $new = "Login session time out in seconds"; break;
	case "Login session timeout": $new = " Διάλειμμα συνόδου σύνδεσης "; break ;
	case "Logout": $new = " Αποσύνδεση "; break;

	case "Menu": $new = " Μενού "; break;
	case "Month": $new = " Μήνας "; break;
	case "More info": $new = " Περισσότερες πληροφορίες "; break;

	case "Name": $new = " Όνομα "; break;			// master translate?
	case "Next": $new = " Έπειτα "; break;				
	case "Next day": $new = " Επόμενη ημέρα "; break;
	case "Next week": $new = " Επόμενη εβδομάδα "; break;
	case "No categories yet": $new = " Καμία κατηγορία ακόμα "; break;
	case "No events": $new = " Κανένα γεγονός "; break;
	case "No Repeat": $new = " Καμία επανάληψη "; break;
	case "No results": $new = " Κανένα αποτέλεσμα "; break;
	case "No, go back!": $new = "Όχι, επιστρέψτε!"; break;
	case "No.": $new = " Όχι."; break;			// master translate?
	case "noadminapprove": $new = " Έγκριση των γεγονότων που προστίθενται απο τους διοικητές δεν απαιτούνται από από το διοικητή "; break ;
	case "noapprove": $new = " Έγκριση των γεγονότων που προστίθενται από τους χρήστες δεν απαιτούνται από από το διοικητή "; break ;
	case "nocat": $new = " Πρέπει να επιλέξετε μια κατηγορία!"; break;
	case "noday": $new = " Πρέπει να επιλέξετε μια ημέρα!"; break;
	case "nodescription": $new = " Πρέπει να δώσετε μια περιγραφή γεγονότος!"; break;
	case "nomonth": $new = " Πρέπει να επιλέξετε έναν μήνα!"; break;
	case "nonapproved": $new = " Γεγονότα που απαιτούν την έγκριση: "; break;
	case "nononapproved": $new = " Δεν υπάρχει κανένα γεγονός που χρειάζεται την έγκριση αυτή τη στιγμή "; break;
	case "notitle": $new = " Πρέπει να δώσετε έναν τίτλο γεγονότος!"; break;
	case "noyear": $new = " Πρέπει να επιλέξετε ένα έτος!"; break;

	case "on": $new = "on"; break;
	case "Optional": $new = " Προαιρετικός "; break;
	case "or month": $new = " ή μήνας "; break;
	case "or week": $new = " ή εβδομάδα "; break;

	case "password": $new = " κωδικός πρόσβασης "; break;
	case "Please choose the category you only want to view events for": $new = " Παρακαλώ επιλέξτε την κατηγορία που θέλετε μόνο να δείτε τα γεγονότα για "; break;  
	case "Popup Month": $new = " Υπερεμφανιζόμενος μήνας "; break ;
	case "Previous": $new = " Προηγούμενος "; break;			
	case "Previous day": $new = " Προηγούμενη ημέρα "; break;
	case "Previous week": $new = " Προηγούμενη εβδομάδα "; break;

	case "Read more": $new = " Διαβάστε περισσότερων "; break;
	case "reallydelcat": $new = " Είστε βέβαιοι σε σας θέλετε αφαιρείτε αυτήν την κατηγορία; Όλα τα γεγονότα που συνδέονται με αυτήν την κατηγορία θα διαγραφούν μόνιμα! "; break;
	case "Repeat": $new = " Επαναλάβετε "; break;
	case "results": $new = " αποτελέσματα "; break;
	case "Role": $new = " Ρόλος "; break;			// master translate?

	case "search": $new = " αναζήτηση "; break;
	case "Sort by": $new = " Ταξινόμηση κατά"; break ;
	case "Sort by date": $new = " Ταξινόμηση κατά ημερομηνία "; break ;
	case "Sort by events": $new = " Ταξινόμηση κατά γεγονότα "; break ;
	case "Start Time": $new = " Χρόνος έναρξης "; break ;

	case "thankyou": $new = " Σας ευχαριστώ για την είσοδο του γεγονότος, θα εμφανιστεί μετά από την έγκριση."; break;
	case "thankyoupost": $new = " Σας ευχαριστώ για την είσοδο ενός γεγονότος, έχει ταχυδρομηθεί."; break;
	case "till": $new = " μέχρι "; break;
	case "Time added or updated": $new = " Χρόνος προσθεσης ή ενημερωσης "; break ;
	case "timeout msg": $new = " Οι αλλαγές στο διάλειμμα συνόδου θα είναι μόνο αποτελεσματικές στην επόμενη σύνδεση " ; break ;
	case "times every": $new = " φορές κάθε "; break;	
	case "To": $new = "Πρός"; break ;
	case "To delete category": $new = " Για να διαγράψει την κατηγορία "; break ;
	case "Today": $new = " Σήμερα "; break;
	case "Total": $new = " Σύνολο "; break;
	case "Total number of events for the month": $new = " Συνολικός αριθμός γεγονότων για το μήνα "; break ;
	case "Total number of events for user": $new = " Συνολικός αριθμός γεγονότων για το χρήστη "; break ;		
	case "Total unapproved events for the month": $new = " Συνολικά γεγονότα για έγκριση για το μήνα " ; break;
	case "Two weeks": $new = " Δύο εβδομάδες " ; break;	

	case "Update": $new = " Αναπροσαρμογή "; break;
	case "Update Event": $new = "Ανανέωση γεγονότος "; break;
	case "Updating category": $new = " Ανανέωση κατηγορίας "; break ;
	case "Updating event": $new = " Ανανέωση γεγονότος "; break;
	case "Updating user": $new = " Ανανέωση χρήστη "; break;			
	case "Unapproved events": $new = " Γεγονότα προς εγκριση "; break ;
	case "User": $new = " Χρήστης "; break ;
	case "User Calendar": $new = " Ημερολόγιο χρηστών "; break ;
	case "User description": $new = " Περιγραφή χρηστών "; break ;		
	case "User group": $new = " Ομάδα χρηστών "; break ;				
	case "User Management": $new = " Διαχείριση χρηστών "; break;
	case "userdelok": $new = " Είστε βέβαιοι να διαγράψετε αυτόν τον χρήστη?"; break;
	case "username": $new = " όνομα χρήστη "; break;
	case "Username and passwords must be alpha-numeric and without spaces.": $new = " Το όνομα χρήστη και οι κωδικοί πρόσβασης πρέπει να είναι αλφανουμερικοί και χωρίς διαστήματα."; break; 	// version 0.4.20030731
	case "Username entered already exists. Please use another username.": $new = " Το όνομα χρήστη που εισήχθη υπάρχει ήδη. Παρακαλώ χρησιμοποιήστε ένα άλλο όνομα χρήστη."; break;
	case "users": $new = " χρήστες "; break;

	case "View": $new = "Προβολή"; break;
	case "View categories in year": $new = " Προβολή κατηγοριών στο έτος "; break ;
	case "View details or edit": $new = " Προβολή λεπτομέρειων ή αλλαγή "; break ;
	case "View event": $new = " Προβολή γεγονότος"; break;
	case "View events of user": $new = " Προβολή γεγονότων του χρήστη "; break;
	case "View events under this category in year": $new = " Προβολή γεγονότων κάτω από αυτήν την κατηγορία στο έτος "; break ;
	case "View historical events before": $new = " Προβολή ιστορικών γεγονότων πριν "; break ;
	case "View month": $new = " Προβολή μήνα "; break;
	case "View week": $new = " Προβολή εβδομάδας "; break;

	case "Web Calendar Admin Login": $new = "Calendarix Σύνδεση Admin "; break ;
	case "Web Calendar User Login": $new = "Calendarix Σύνδεση χρηστών "; break ;
	case "week number": $new = " αριθμός εβδομάδας "; break;
	case "Week starts": $new = " Ενάρξεις εβδομάδας "; break;
	case "wronglogin": $new = " Λανθασμένο όνομα χρήστη ή κωδικός πρόσβασης "; break;

	case "Year": $new = " Έτος "; break;
	case "Yes": $new = " Ναι "; break;		// version 0.4.20030731
	case "Yes, delete event !": $new = " Ναι, διαγράψτε το γεγονός!"; break;
	case "Yes, delete it!": $new = " Ναι, να το διαγράψετε!"; break;

	default: $new = "<b>".$msgin."</b> πρέπει να μεταφραστεί!";    break;
    }
    return $new;
}
?>
