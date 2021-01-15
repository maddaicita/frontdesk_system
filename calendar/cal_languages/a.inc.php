<?php
# Users have to change alignment to right, and in header file replace <html> with <html dir=rtl> so it would look right
function translate($msgin){

    switch ($msgin) {
	case "About Calendarix": $new = "About Calendarix"; break ;
	case "Add": $new = "ÅÖÇİå"; break ;
	case "Add Category": $new = "ÃÖİ ÊÕäíİ"; break;
	case "Add Event": $new = "ÃÖİ ÍÏË"; break;
	case "Add event": $new = "ÃÖİ ÍÏË" ; break;
	case "Add new user": $new = "ÅÖÇİÉ ãÓÊÎÏã ÌÏíÏ"; break;
	case "Adding category": $new = "ÅÖÇİÉ ÊÕäíİ"; break;
	case "Adding event": $new = "ÅÖÇİÉ ÍÏË" ; break ;
	case "Adding user": $new = "ÅÖÇİÉ ãÓÊÎÏã"; break ;
	case "Administration": $new = "ÇáÅÏÇÑå"; break;
	case "Administrator": $new = "ÇáãÏíÑ"; break ;
	case "All categories": $new = "ßá ÇáÊÕäíİÇÊ"; break ;		
	case "Approval needed for posting of events.": $new = "áÇÈÏ ãä ÇáãæÇİŞÉ Úáì ßá ÇáÃÍÏÇË ÇáãÖÇİå."; break;  
	case "Approvals": $new = "ÇáãæÇİŞå"; break ;
	case "Approve": $new = "ŞÈæá"; break;
	case "Approving event": $new = "ŞÈæá ÍÏË"; break;
	
	case "Back": $new = "ÚæÏå"; break;
	case "Both passwords entered do not match": $new = "ßáãÇÊ ÇáÓÑ ÛíÑ ãÊØÇÈŞå"; break;	

	case "Calendar": $new = "ÇáÊŞæíã"; break;
	case "Cancel": $new = "ÅáÛÇÁ"; break ;
	case "Cannot delete current login user": $new = "áÇíãßä ÍĞİ ÇáãÓÊÎÏã ÇáÍÇáí"; break ;   
	case "Cannot change current login user": $new = "áÇíãßä ÊÛííÑ ßáãÉ ÇáÓÑ ááãÓÊÎÏã ÇáÍÇáí"; break;	
	case "Cannot have a category with blank name": $new = "áÇíãßä ŞÈæá ÊÕäíİ ÈÏæä ÅÓã"; break ;
	case "Categories": $new = "ÇáÊÕäíİÇÊ"; break;
	case "Category": $new = "ÇáÊÕäíİ"; break;
	case "Change": $new = "ÊÛííÑ"; break ;
	case "Change password/group": $new = "ÊÛííÑ ßáãÉ ÇáÓÑ/ ÇáãÌãæÚÇÊ"; break; 		
	case "Choose Category": $new = "ÅÎÊÑ ÊÕäíİ"; break;
	case "Close": $new = "ÅÛáÇŞ ÇáäÇİĞå"; break;
	case "Confirm delete?": $new = "ÊÃßíÏ ÇáÍĞİ?" ; break ;			
	case "Confirm delete all historical events before": $new = "ÊÃßíÏ ÍĞİ ÌãíÚ ÇáÃÍÏÇË ŞÈá"; break ;
	case "confirmed events for today": $new = "ÃÍÏÇË Çáíæã"; break ;
	case "Confirm password": $new = "ÊÃßíÏ ßáãÉ ÇáÓÑ"; break; 		
	case "Copy Event": $new = "äÓÎ ÇáÍÏË"; break ;				
	case "Current Week": $new = "ÇáÃÓÈæÚ ÇáÍÇáí"; break;
	case "Current Month": $new = "ÇáÔåÑ ÇáÌÇÑí"; break;
	case "Current Year": $new = "ÇáÓäÉ ÇáÍÇáíå"; break;		

	case "Date": $new = "ÇáÊÇÑíÎ"; break;
	case "Day": $new = "Çáíæã"; break;
	case "Delete all historical events listed": $new = "ÍĞİ ÌãíÚ ÇáÃÍÏÇË ÇáÊÇÑíÎíÉ ÇáãÏÑÌå"; break;
	case "Delete category": $new = "ÍĞİ ÇáÊÕäíİ"; break;
	case "Delete event": $new = "ÍĞİ ÇáÍÏË"; break;
	case "Delete user": $new = "ÍĞİ ÇáãÓÊÎÏã"; break;
	case "Deleting category": $new = "ÍĞİ ÇáÊÕäíİ"; break;
	case "Deleting event": $new = "ÍĞİ ÇáÍÏË"; break ;
	case "Deleting user": $new = "ÍĞİ ãÓÊÎÏã"; break ;
	case "disabled": $new = "Êã æŞİ ÇáÚãá ÈåĞÇ ÇáŞÓã"; break;

	case "Edit category": $new = "ÊÚÏíá ÇáÊÕäíİ"; break;
	case "Edit event": $new = "ÊÚÏíá ÇáÍÏË"; break;
	case "Email": $new = "ÇáÈÑíÏ ÇáÅáßÊÑæäí"; break;
	case "End Time": $new = "ÊÚÏíá ÇáæŞÊ"; break ;
	case "Event": $new = "ÇáÍÏË"; break ;
	case "Event Category": $new = "ÊÕäíİ ÇáÍÏË"; break;
	case "Event Description": $new = "æÕİ ÇáÍÏË"; break;
	case "Event repeated": $new = "ÊßÑÇÑ ÇáÍÏË"; break;  
	case "Event Title": $new = "ÚäæÇä ÇáÍÏË"; break;
	case "events": $new = "ÇáÃÍÏÇË"; break;
	case "Events added will be posted immediately.": $new = "ÇáÃÍÏÇË ÇáãÖÇİå ÓíÊã äÔÑåÇ ãÈÇÔÑÉ."; break ;
	case "events awaiting approval": $new = "ÃÍÏÇË ÈÅäÊÙÇÑ ÇáãæÇİŞå"; break ;
	case "Events before": $new = "ÃÍÏÇË ŞÈá"; break ;
	case "events for": $new = "ÃÍÏÇË ÎÇÕÉ È"; break;
	case "Events for day": $new = "ÃÍÏÇË íæã"; break;
	case "events for whole calendar": $new = "ßá ÃÍÏÇË ÇáÊŞæíã"; break;
	case "events for year": $new = "ÃÍÏÇË ÇáÓäå"; break;
	case "Events from ": $new = "ÃÍÏÇË ãä "; break;
	case "Events in category": $new = "ÃÍÏÇË ÇáÊÕäíİ"; break;

	case "From": $new = "ãä"; break ;

	case "Go to": $new = "ÅĞåÈ Åáì"; break;
	case "Go to day": $new = "ÅĞåÈ Åáì íæã"; break;
	case "Go to week": $new = "ÅĞåÈ Åáì ÇáÇÓÈæÚ"; break;

	case "Historical Items": $new = "ÃÍÏÇË ÓÇÈŞå"; break;

	case "Login": $new = "ÇáÏÎæá"; break;
	case "Login session time out in seconds": $new = "ãÏÉ ÕáÇÍíÉ ÇáÏÎæá ÈÇáËæÇäí"; break;
	case "Login session timeout": $new = "ÅäÊåÊ ÕáÇÍíÉ ÇáÏÎæá"; break ;
	case "Logout": $new = "ÎÑæÌ"; break;

	case "Menu": $new = "ÇáŞÇÆãå"; break;
	case "Month": $new = "ÇáÔåÑ"; break;
	case "More info": $new = "ÇáãÒíÏ"; break;

	case "Next": $new = "ÇáÊÇáí"; break;				
	case "Next day": $new = "Çáíæã ÇáÊÇáí"; break;
	case "Next week": $new = "ÇáÃÓÈæÚ ÇáÊÇáí"; break;
	case "No categories yet": $new = "áÇÊæÌÏ ÊÕäíİÇÊ"; break;
	case "No events": $new = "áÇÊæÌÏ ÃÍÏÇË"; break;
	case "No Repeat": $new = "áÇíæÌÏ ÊßÑÇÑ"; break;
	case "No results": $new = "áÇÊæÌÏ äÊÇÆÌ"; break;
	case "No, go back!": $new = "ÛíÑ ãÊæİÑ, ÚæÏå!"; break;
	case "noadminapprove": $new = "ÇáÃÍÏÇË ÇáãÖÇİÉ ãä ŞÈá ÇáãÏíÑ áÇÊÍÊÇÌ Åáì ãæÇİŞå"; break ;
	case "noapprove": $new = "ÇáÃÍÏÇË ÇáãÖÇİÉ ãä ÇáãÓÊÎÏãíä áÇÊÍÊÇÌ Åáì ãæÇİŞå"; break ;
	case "nocat": $new = "íÌÈ Ãä ÊÎÊÇÑ ÊÕäíİÇ !"; break;
	case "noday": $new = "íÌÈ Ãä ÊÎÊÇÑ Çáíæã !"; break;
	case "nodescription": $new = "íÌÈ æÕİ ÇáÍÏË !"; break;
	case "nomonth": $new = "íÌÈ Ãä ÊÎÊÇÑ ÇáÔåÑ !"; break;
	case "nonapproved": $new = "ÇáÃÍÏÇË ÇáÊí ÊÍÊÇÌ Åáì ãæÇİŞå : "; break;
	case "nononapproved": $new = "áÇÊæÌÏ ÃÍÏÇË ÊÊØáÈ ÇáãæÇİŞÉ ÍÇáíÇ"; break;
	case "notitle": $new = "íÌÈ ÅÚØÇÁ ÚäæÇä ááÍÏË !"; break;
	case "noyear": $new = "íÌÈ Ãä ÊÎÊÇÑ ÇáÓäå !"; break;

	case "on": $new = "İí"; break;
	case "Optional": $new = "ÅÎÊíÇÑí"; break;
	case "or month": $new = "Ãæ ÔåÑ"; break;
	case "or week": $new = "Ãæ ÇáÇÓÈæÚ"; break;

	case "password": $new = "ßáãÉ ÇáÓÑ"; break;
	case "Please choose the category you only want to view events for": $new = "ÇáÑÌÇÁ ÅÎÊíÇÑ ÇáÊÕäíİ ÇáĞí ÊÑÛÈ ãÔÇåÏÉ ÃÍÏÇËå"; break;  
	case "Popup Month": $new = "ÇáÔåÑ ÇáäÇİÑ"; break ;
	case "Previous": $new = "ÇáÓÇÈŞ"; break;			
	case "Previous day": $new = "Çáíæã ÇáÓÇÈŞ"; break;
	case "Previous week": $new = "ÇáÃÓÈæÚ ÇáãÇÖí"; break;

	case "Read more": $new = "ÇáãÒíÏ"; break;
	case "reallydelcat": $new = "åá ÃäÊ ãÊÃßÏ ãä ÑÛÈÊß ÈÍĞİ ÇáÊÕäíİ¿ ßá ÇáÃÍÏÇË ÇáãÑÊÈØÉ ÈåĞÇ ÇáÊÕäíİ ÓíÊã ÍĞİåÇ äåÇÆíÇ äÊíÌÉ áĞáß!"; break;
	case "Repeat": $new = "ÊßÑÇÑ"; break;
	case "results": $new = "äÊÇÆÌ"; break;

	case "search": $new = "ÈÍË"; break;
	case "Sort by": $new = "ÊÑÊíÈ ÍÓÈ"; break ;
	case "Sort by date": $new = "ÊÑÊíÈ ÍÓÈ ÇáÊÇÑíÎ"; break ;
	case "Sort by events": $new = "ÊÑÊíÈ ÍÓÈ ÇáÃÍÏÇË"; break ;
	case "Start Time": $new = "æŞÊ ÇáÈÏÇíå"; break ;

	case "thankyou": $new = "ÔßÑÇ áÃÖÇİÊß áåĞÇ ÇáÍÏË, ÓíÊã äÔÑå ÈÚÏ ÇáãæÇİŞÉ Úáíå."; break;
	case "thankyoupost": $new = "ÔßÑÇ áÅÖÇİÊß áåĞÇ ÇáÍÏË, áŞÏ Êã äÔÑå."; break;
	case "till": $new = "ÍÊì"; break;
	case "Time added or updated": $new = "æŞÊ ÇáÅÖÇİÉ æÇáÊÍÏíË"; break ;
	case "timeout msg": $new = "áä íÊã ÇáÚãá ÈåĞÇ ÇáÊÚÏíá Åáì İí ÇáÏÎæá ÇáÊÇáí" ; break ;
	case "times every": $new = "ãÑå ßá"; break;	
	case "To": $new = "ÍÊì"; break ;
	case "To delete category": $new = "áÍĞİ ÊÕäíİ"; break ;
	case "Today": $new = "Çáíæã"; break;
	case "Total": $new = "ãÌãæÚ"; break;
	case "Total number of events for the month": $new = "ãÌãæÚ ÃÍÏÇË åĞÇ ÇáÔåÑ"; break ;
	case "Total number of events for user": $new = "ãÌãæÚ ÃÍÏÇË åĞÇ ÇáãÓÊÎÏã"; break ;		
	case "Total unapproved events for the month": $new = "ÇáÃÍÏÇË ÇáÊí ÊäÊÙÑ ÇáãæÇİŞÉ áåĞÇ ÇáÔåÑ" ; break;
	case "Two weeks": $new = "ÇÓÈæÚíä" ; break;	

	case "Update": $new = "ÊÍÏíË"; break;
	case "Update Event": $new = "ÊÍÏíË ÍÏË"; break;
	case "Updating category": $new = "ÊÍÏíË ÊÕäíİ"; break ;
	case "Updating event": $new = "ÊÍÏíË ÇáÍÏË"; break;
	case "Updating user": $new = "ÊÍÏíË ÇáãÓÊÎÏã"; break;			
	case "Unapproved events": $new = "ÍÏË áã ÊÊã ÇáãæÇİŞÉ Úáíå"; break ;
	case "User": $new = "ÇáãÓÊÎÏã"; break ;
	case "User Calendar": $new = "ÊŞæíã ÇáãÓÊÎÏã"; break ;
	case "User description": $new = "æÕİ ÇáãÓÊÎÏã"; break ;		
	case "User group": $new = "ãÌãæÚÇÊ ÇáãÓÊÎÏãíä"; break ;				
	case "User Management": $new = "ÅÏÇÑÉ ÇáãÓÊÎÏãíä"; break;
	case "userdelok": $new = "åá ÃäÊ ãÊÃßÏ ãäÍĞİ ÇáãÓÊÎÏã ?"; break;
	case "username": $new = "ÅÓã ÇáãÓÊÎÏã"; break;
	case "Username entered already exists. Please use another username.": $new = "ÅÓã ÇáãÓÊÎÏã ãÓÌá ÓÇÈŞÇ¡ ÇáÑÌÇÁ ÅÓÊÎÏÇã ÅÓã ÂÎÑ."; break;
	case "users": $new = "ãÓÊÎÏã"; break;

	case "View": $new = "ÚÑÖ"; break;
	case "View categories in year": $new = "ãÔÇåÏÉ ÇáÊÕäíİÇÊ áÓäÉ"; break ;
	case "View details or edit": $new = "ãÔÇåÏæ æÊÚÏíá ÇáÊİÇÕíá"; break ;
	case "View event": $new = "ÚÑÖ ÇáÍÏË"; break;
	case "View events of user": $new = "ÚÑÖ ÃÍÏÇË ÇáãÓÊÎÏã"; break;
	case "View events under this category in year": $new = "ÚÑÖ ÇáÃÍÏÇË áåĞÇ ÇáÊÕäíİ áÓäÉ"; break ;
	case "View historical events before": $new = "ÚÑÖ ÇáÃÍÏÇË ÇáÓÇÈŞÉ á"; break ;
	case "View month": $new = "ÚÑÖ ÔåÑ"; break;
	case "View week": $new = "ÚÑÖ ÃÓÈæÚ"; break;

	case "Web Calendar Admin Login": $new = "ÊÓÌíá ÏÎæá ÇáãÏíÑ"; break ;
	case "Web Calendar User Login": $new = "ÊÓÌíá ÇáÏÎæá"; break ;
	case "week number": $new = "ÑŞã ÇáÃÓÈæÚ"; break;
	case "Week starts": $new = "ÈÏÇíÉ ÇáÃÓÈæÚ"; break;
	case "wronglogin": $new = "ÅÓã Ãæ ßáãÉ ÓÑ ÎÇØÆå"; break;

	case "Year": $new = "ÇáÓäå"; break;
	case "Yes, delete event !": $new = "ãÊÃßÏ, ÅÍĞİ ÇáÍÏË !"; break;
	case "Yes, delete it!": $new = "ãÊÃßÏ, ÅÒÇáå!"; break;

	default: $new = "<b>".$msgin."</b> needs to be translated !";    break;

    }
    return $new;
}
?>