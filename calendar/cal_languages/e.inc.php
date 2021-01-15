<?php
function translate($msgin){
    switch ($msgin) {
	case "About Calendarix": $new = "About Calendarix"; break ;		
	case "Add": $new = "Add"; break ;
	case "Add Category": $new = "Add Category"; break;
	case "Add Event": $new = "Add Event"; break;
	case "Add event": $new = "Add event" ; break;
	case "Add new user": $new = "Add new user"; break;
	case "Adding category": $new = "Adding category"; break;
	case "Adding event": $new = "Adding event" ; break ;
	case "Adding user": $new = "Adding user"; break ;
	case "Administration": $new = "Administration"; break;
	case "Administrator": $new = "Administrator"; break ;
	case "All categories": $new = "All categories"; break ;		
	case "Approval needed for posting of events.": $new = "Approval needed for posting of events."; break;  
	case "Approvals": $new = "Approvals"; break ;
	case "Approve": $new = "Approve"; break;
	case "Approving event": $new = "Approving event"; break;
	
	case "Back": $new = "Back"; break;
	case "Both passwords entered do not match": $new = "Both passwords entered do not match"; break;	

	case "Calendar": $new = "Calendar"; break;
	case "Cancel": $new = "Cancel"; break ;
	case "Cannot delete current login user": $new = "Cannot delete current login user"; break ;   
	case "Cannot change current login user": $new = "Cannot change current login user"; break;	
	case "Cannot have a category with blank name": $new = "Cannot have a category with blank name"; break ;
	case "Categories": $new = "Categories"; break;
	case "Category": $new = "Category"; break;
	case "Change": $new = "Change"; break ;
	case "Change password/group": $new = "Change password/group"; break; 	// master obsolete?	
	case "Choose Category": $new = "Choose Category"; break;
	case "Close": $new = "Close"; break;
	case "Coming Events": $new = "Coming Events"; break;			// 0.6.20050830
	case "Confirm delete?": $new = "Confirm delete?" ; break ;			
	case "Confirm delete all historical events before": $new = "Confirm delete all historical events before"; break ;
	case "confirmed events for today": $new = "confirmed events for today"; break ;
	case "Confirm password": $new = "Confirm password"; break; 		
	case "Copy Event": $new = "Copy Event"; break ;				
	case "Current Week": $new = "Current Week"; break;
	case "Current Month": $new = "Current Month"; break;
	case "Current Year": $new = "Current Year"; break;		

	case "Date": $new = "Date"; break;
	case "Day": $new = "Day"; break;
	case "Delete all historical events listed": $new = "Delete all historical events listed"; break;
	case "Delete category": $new = "Delete category"; break;
	case "Delete event": $new = "Delete event"; break;
	case "Delete user": $new = "Delete user"; break;
	case "Deleting category": $new = "Deleting category"; break;
	case "Deleting event": $new = "Deleting event"; break ;
	case "Deleting user": $new = "Deleting user"; break ;
	case "disabled": $new = "This section has been disabled"; break;

	case "Edit category": $new = "Edit category"; break;
	case "Edit event": $new = "Edit event"; break;
	case "Edit information": $new = "Edit information"; break;	// master translate?
	case "Email": $new = "Email"; break;
	case "End Time": $new = "End Time"; break ;
	case "Event": $new = "Event"; break ;
	case "Event Category": $new = "Event Category"; break;
	case "Event Description": $new = "Event Description"; break;
	case "Event repeated": $new = "Event repeated"; break;  
	case "Event Title": $new = "Event Title"; break;
	case "events": $new = "events"; break;
	case "Events added will be posted immediately.": $new = "Events added will be posted immediately."; break ;
	case "events awaiting approval": $new = "events awaiting approval"; break ;
	case "Events before": $new = "Events before"; break ;
	case "events for": $new = "events for"; break;
	case "Events for day": $new = "Events for day"; break;
	case "events for whole calendar": $new = "events for whole calendar"; break;
	case "events for year": $new = "events for year"; break;
	case "Events from ": $new = "Events from "; break;
	case "Events in category": $new = "Events in category"; break;

	case "From": $new = "From"; break ;
	case "Functions": $new = "Functions"; break ;	// master translate?

	case "Go to": $new = "Go to"; break;
	case "Go to day": $new = "Go to day"; break;
	case "Go to week": $new = "Go to week"; break;

	case "Historical Items": $new = "Historical Items"; break;

	case "Login": $new = "Login"; break;
	case "Login session time out in seconds": $new = "Login session time out in seconds"; break;
	case "Login session timeout": $new = "Login session timeout"; break ;
	case "Logout": $new = "Logout"; break;

	case "Menu": $new = "Menu"; break;
	case "Month": $new = "Month"; break;
	case "More info": $new = "More info"; break;

	case "Name": $new = "Name"; break;			// master translate?
	case "Next": $new = "Next"; break;				
	case "Next day": $new = "Next day"; break;
	case "Next week": $new = "Next week"; break;
	case "No categories yet": $new = "No categories yet"; break;
	case "No events": $new = "No events"; break;
	case "No Repeat": $new = "No Repeat"; break;
	case "No results": $new = "No results"; break;
	case "No, go back!": $new = "No, go back!"; break;
	case "No.": $new = "No."; break;			// master translate?
	case "noadminapprove": $new = "Approval of events added by administrators not needed by administrator"; break ;
	case "noapprove": $new = "Approval of events added by users not needed by administrator"; break ;
	case "nocat": $new = "You must select a category !"; break;
	case "noday": $new = "You must select a day !"; break;
	case "nodescription": $new = "You must give an event description !"; break;
	case "nomonth": $new = "You must select a month !"; break;
	case "nonapproved": $new = "Events requiring approval : "; break;
	case "nononapproved": $new = "There are no events needing approval at this time"; break;
	case "notitle": $new = "You must give an event title !"; break;
	case "noyear": $new = "You must select a year !"; break;

	case "on": $new = "on"; break;
	case "Optional": $new = "Optional"; break;
	case "or month": $new = "or month"; break;
	case "or week": $new = "or week"; break;

	case "password": $new = "password"; break;
	case "Please choose the category you only want to view events for": $new = "Please choose the category you only want to view events for"; break;  
	case "Please choose the RSS channel you want to view": $new = "Please choose the RSS channel you want to view"; break;
	case "Popup Month": $new = "Popup Month"; break ;
	case "Previous": $new = "Previous"; break;			
	case "Previous day": $new = "Previous day"; break;
	case "Previous week": $new = "Previous week"; break;

	case "Read more": $new = "Read more"; break;
	case "reallydelcat": $new = "Are you sure to you want remove this category? All events associated with this category will be permanently deleted!"; break;
	case "Repeat": $new = "Repeat"; break;
	case "results": $new = "results"; break;
	case "Role": $new = "Role"; break;			// master translate?

	case "search": $new = "search"; break;
	case "Select": $new = "Select"; break;		// 0.7.20060401
	case "Sort by": $new = "Sort by"; break ;
	case "Sort by date": $new = "Sort by date"; break ;
	case "Sort by events": $new = "Sort by events"; break ;
	case "Start Time": $new = "Start Time"; break ;

	case "thankyou": $new = "Thank you for entering an event, it will appear after approval."; break;
	case "thankyoupost": $new = "Thank you for entering an event, it has been posted."; break;
	case "till": $new = "till"; break;
	case "Time added or updated": $new = "Time added or updated"; break ;
	case "timeout msg": $new = "Changes in session timeout will only be effective on next login" ; break ;
	case "times every": $new = "times every"; break;	
	case "To": $new = "To"; break ;
	case "To delete category": $new = "To delete category"; break ;
	case "Today": $new = "Today"; break;
	case "Total": $new = "Total"; break;
	case "Total number of events for the month": $new = "Total number of events for the month"; break ;
	case "Total number of events for user": $new = "Total number of events for user"; break ;		
	case "Total unapproved events for the month": $new = "Total unapproved events for the month" ; break;
	case "Two weeks": $new = "Two weeks" ; break;	

	case "Update": $new = "Update"; break;
	case "Update Event": $new = "Update Event"; break;
	case "Updating category": $new = "Updating category"; break ;
	case "Updating event": $new = "Updating event"; break;
	case "Updating user": $new = "Updating user"; break;			
	case "Unapproved events": $new = "Unapproved events"; break ;
	case "User": $new = "User"; break ;
	case "User Calendar": $new = "User Calendar"; break ;
	case "User description": $new = "User description"; break ;		
	case "User group": $new = "User group"; break ;				
	case "User Management": $new = "User Management"; break;
	case "userdelok": $new = "Are you sure to delete this user ?"; break;
	case "username": $new = "username"; break;
	case "Username and passwords must be alpha-numeric and without spaces.": $new = "Username and passwords must be alpha-numeric and without spaces."; break; 	// version 0.4.20030731
	case "Username entered already exists. Please use another username.": $new = "Username entered already exists. Please use another username."; break;
	case "users": $new = "users"; break;

	case "View": $new = "View"; break;
	case "View categories in year": $new = "View categories in year"; break ;
	case "View details or edit": $new = "View details or edit"; break ;
	case "View event": $new = "View event"; break;
	case "View events of user": $new = "View events of user"; break;
	case "View events under this category in year": $new = "View events under this category in year"; break ;
	case "View historical events before": $new = "View historical events before"; break ;
	case "View month": $new = "View month"; break;
	case "View week": $new = "View week"; break;

	case "Web Calendar Admin Login": $new = "Calendarix Admin Login"; break ;
	case "Web Calendar User Login": $new = "Calendarix User Login"; break ;
	case "week number": $new = "week number"; break;
	case "Week starts": $new = "Week starts"; break;
	case "wronglogin": $new = "Incorrect username or password"; break;

	case "Year": $new = "Year"; break;
	case "Yes": $new = "Yes"; break;		// version 0.4.20030731
	case "Yes, delete event !": $new = "Yes, delete event !"; break;
	case "Yes, delete it!": $new = "Yes, delete it!"; break;

	default: $new = "<b>".$msgin."</b> needs to be translated !";    break;
    }
    return $new;
}
?>