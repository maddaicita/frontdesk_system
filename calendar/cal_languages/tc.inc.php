<?php
function translate($msgin){

    switch ($msgin) {
	case "About Calendarix": $new = "關於Calendarix行事曆"; break ;		
	case "Add": $new = "新增"; break ;
	case "Add Category": $new = "新增項目"; break;
	case "Add Event": $new = "新增事件"; break;
	case "Add event": $new = "新增事件" ; break;
	case "Add new user": $new = "新增用戶"; break;
	case "Adding category": $new = "新增項目中"; break;
	case "Adding event": $new = "新增事件中" ; break ;
	case "Adding user": $new = "新增用戶中"; break ;
	case "Address": $new = "地址"; break ;			// master translate?
	case "Administration": $new = "管理"; break;
	case "Administrator": $new = "管理員"; break ;
	case "All categories": $new = "所有項目"; break ;		
	case "Approval needed for posting of events.": $new = "審核新增事件。"; break;  
	case "Approvals": $new = "審核"; break ;
	case "Approve": $new = "審核"; break;
	case "Approving event": $new = "審核事件中"; break;
	
	case "Back": $new = "返回"; break;
	case "Both passwords entered do not match": $new = "輸入兩次密碼錯誤"; break;	

	case "Calendar": $new = "行事曆"; break;
	case "Cancel": $new = "取消"; break ;
	case "Cannot delete current login user": $new = "無法刪除現在登入的用戶"; break ;   
	case "Cannot change current login user": $new = "無法修改現在登入的用戶"; break;	
	case "Cannot have a category with blank name": $new = "項目名稱不能空白"; break ;
	case "Categories": $new = "項目"; break;
	case "Category": $new = "項目"; break;
	case "Change": $new = "修改"; break ;
	case "Change password": $new = "修改密碼"; break; 		// master translate?
	case "Change password/group": $new = "修改密碼/組"; break; 	// master obsolete?	
	case "Choose Category": $new = "選擇項目"; break;
	case "Close": $new = "關閉"; break;
	case "Confirm delete?": $new = "確定要刪除？" ; break ;			
	case "Confirm delete all historical events before": $new = "確定要刪除以前所有的事件？"; break ;
	case "confirmed events for today": $new = "確認今天的事件"; break ;
	case "Confirm password": $new = "確認密碼"; break; 		
	case "Copy Event": $new = "複製事件"; break ;				
	case "Current Week": $new = "本週"; break;
	case "Current Month": $new = "本月"; break;
	case "Current Year": $new = "今年"; break;		

	case "Date": $new = "日期"; break;
	case "Day": $new = "日"; break;
	case "Delete all historical events listed": $new = "刪除列出的以前所有事件"; break;
	case "Delete category": $new = "刪除項目"; break;
	case "Delete event": $new = "刪除事件"; break;
	case "Delete user": $new = "刪除用戶"; break;
	case "Deleting category": $new = "刪除項目中"; break;
	case "Deleting event": $new = "刪除事件中"; break ;
	case "Deleting user": $new = "刪除用戶中"; break ;
	case "disabled": $new = "此功能無效"; break;

	case "Edit category": $new = "編輯項目"; break;
	case "Edit event": $new = "編輯事件"; break;
	case "Edit information": $new = "編輯資訊"; break;	// master translate?
	case "Email": $new = "電子郵件"; break;
	case "End Time": $new = "結束時間"; break ;
	case "Event": $new = "事件"; break ;
	case "Event Category": $new = "事件項目"; break;
	case "Event Description": $new = "事件描述"; break;
	case "Event repeated": $new = "重複事件"; break;  
	case "Event Title": $new = "事件標題"; break;
	case "events": $new = "事件"; break;
	case "Events added will be posted immediately.": $new = "新增事件立刻生效。"; break ;
	case "events awaiting approval": $new = "待審核事件"; break ;
	case "Events before": $new = "以前的事件"; break ;
	case "events for": $new = "事件依據"; break;
	case "Events for day": $new = "每日事件"; break;
	case "events for whole calendar": $new = "所有行事曆事件"; break;
	case "events for year": $new = "全年事件"; break;
	case "Events from ": $new = "事件來自"; break;
	case "Events in category": $new = "項目中的事件"; break;

	case "From": $new = "從"; break ;
	case "Functions": $new = "功能"; break ;	// master translate?

	case "Go to": $new = "Go to"; break;
	case "Go to day": $new = "Go to day"; break;
	case "Go to week": $new = "Go to week"; break;

	case "Historical Items": $new = "歷史紀錄"; break;

	case "Login": $new = "登入"; break;
	case "Login session time out in seconds": $new = "登入時超過時間"; break;
	case "Login session timeout": $new = "登入暫停"; break ;
	case "Logout": $new = "登出"; break;

	case "Menu": $new = "列表"; break;
	case "Month": $new = "月"; break;
	case "More info": $new = "更多資訊"; break;

	case "Name": $new = "姓名"; break;			// master translate?
	case "Next": $new = "下一個"; break;				
	case "Next day": $new = "明天"; break;
	case "Next week": $new = "下星期"; break;
	case "No categories yet": $new = "還沒有項目"; break;
	case "No events": $new = "沒有事件"; break;
	case "No Repeat": $new = "不重複"; break;
	case "No results": $new = "沒有結果"; break;
	case "No, go back!": $new = "沒有，請回！"; break;
	case "No.": $new = "不。"; break;			// master translate?
	case "noadminapprove": $new = "管理員新增的事件不需要管理員審核"; break ;
	case "noapprove": $new = "用戶新增的事件不需要管理員審核"; break ;
	case "nocat": $new = "你必須選擇一個項目！"; break;
	case "noday": $new = "你必須選擇一個日期！"; break;
	case "nodescription": $new = "你必須描述事件！"; break;
	case "nomonth": $new = "你必須選擇一個月份！"; break;
	case "nonapproved": $new = "事件需要審核 : "; break;
	case "nononapproved": $new = "目前沒有事件需要審核"; break;
	case "notitle": $new = "你必須標明事件的主題！"; break;
	case "noyear": $new = "你必須選擇年份！"; break;

	case "on": $new = "在"; break;
	case "Optional": $new = "選填"; break;
	case "or month": $new = "或者月"; break;
	case "or week": $new = "或者星期"; break;

	case "password": $new = "密碼"; break;
	case "Please choose the category you only want to view events for": $new = "請選擇你想查看的項目"; break;  
	case "Popup Month": $new = "另開月曆視窗"; break ;
	case "Previous": $new = "前一個"; break;			
	case "Previous day": $new = "前一天"; break;
	case "Previous week": $new = "上星期"; break;

	case "Read more": $new = "詳細閱讀"; break;
	case "reallydelcat": $new = "你確定要移除這個項目？這個項目的所有事件將被刪除！"; break;
	case "Repeat": $new = "重複"; break;
	case "results": $new = "結果"; break;
	case "Role": $new = "角色"; break;			// master translate?

	case "search": $new = "搜尋"; break;
	case "Sort by": $new = "依順序"; break ;
	case "Sort by date": $new = "依日期排列 "; break ;
	case "Sort by events": $new = "依事件排列"; break ;
	case "Start Time": $new = "開始時間"; break ;

	case "thankyou": $new = "感謝您新增事件，將在審核後生效。"; break;
	case "thankyoupost": $new = "感謝您新增事件，已經新增生效。"; break;
	case "till": $new = "直到"; break;
	case "Time added or updated": $new = "新增或更改時間"; break ;
	case "timeout msg": $new = "更改已超過時間將於下次登入時生效" ; break ;
	case "times every": $new = "每次"; break;	
	case "To": $new = "到"; break ;
	case "To delete category": $new = "刪除項目"; break ;
	case "Today": $new = "今天"; break;
	case "Total": $new = "總計"; break;
	case "Total number of events for the month": $new = "總計本月事件"; break ;
	case "Total number of events for user": $new = "總計用戶事件"; break ;		
	case "Total unapproved events for the month": $new = "總計本月未審核事件" ; break;
	case "Two weeks": $new = "兩個星期" ; break;	

	case "Update": $new = "更新"; break;
	case "Update Event": $new = "更新事件"; break;
	case "Updating category": $new = "更新項目中"; break ;
	case "Updating event": $new = "更新事件中"; break;
	case "Updating user": $new = "更新用戶中"; break;			
	case "Unapproved events": $new = "未審核事件"; break ;
	case "User": $new = "用戶"; break ;
	case "User Calendar": $new = "用戶行事曆"; break ;
	case "User description": $new = "用戶描述"; break ;		
	case "User group": $new = "用戶群組"; break ;				
	case "User Management": $new = "用戶管理"; break;
	case "userdelok": $new = "你確定要刪除這個用戶？"; break;
	case "username": $new = "用戶名稱"; break;
	case "Username and passwords must be alpha-numeric and without spaces.": $new = "用戶名稱和密碼必須是英文字母或數字而且不能空白。"; break; 	// version 0.4.20030731
	case "Username entered already exists. Please use another username.": $new = "用戶名稱已存在，請使用另一個名稱。"; break;
	case "users": $new = "用戶"; break;

	case "View": $new = "查看"; break;
	case "View categories in year": $new = "以年查看項目"; break ;
	case "View details or edit": $new = "查看細節或編輯"; break ;
	case "View event": $new = "查看事件"; break;
	case "View events of user": $new = "查看用戶事件"; break;
	case "View events under this category in year": $new = "以年查看這個項目的事件"; break ;
	case "View historical events before": $new = "查看以前的事件"; break ;
	case "View month": $new = "月查看"; break;
	case "View week": $new = "週查看"; break;

	case "Web Calendar Admin Login": $new = "行事曆管理登入"; break ;
	case "Web Calendar User Login": $new = "行事曆用戶登入"; break ;
	case "week number": $new = "週數目"; break;
	case "Week starts": $new = "週開始"; break;
	case "wronglogin": $new = "用戶名稱及密碼錯誤"; break;

	case "Year": $new = "年"; break;
	case "Yes": $new = "是"; break;		// version 0.4.20030731
	case "Yes, delete event !": $new = "是，刪除事件！"; break;
	case "Yes, delete it!": $new = "是，刪除它！"; break;

	default: $new = "<b>".$msgin."</b> needs to be translated !";    break;

    }
    return $new;
}
?>