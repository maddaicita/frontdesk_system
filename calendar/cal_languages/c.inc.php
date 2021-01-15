<?php
function translate($msgin){

    switch ($msgin) {
	case "About Calendarix": $new = "关于Calendarix About Calendarix"; break ;		
	case "Add": $new = "添加 Add"; break ;
	case "Add Category": $new = "添加类别 Add Category"; break;
	case "Add Event": $new = "添加活动 Add Event"; break;
	case "Add event": $new = "添加活动 Add event" ; break;
	case "Add new user": $new = "添加新用户 Add new user"; break;
	case "Adding category": $new = "正在添加类别 Adding category"; break;
	case "Adding event": $new = "正在添加活动 Adding event" ; break ;
	case "Adding user": $new = "正在添加用户 Adding user"; break ;
	case "Address": $new = "地点 Address"; break ;			// master translate?
	case "Administration": $new = "管理 Administration"; break;
	case "Administrator": $new = "管理员 Administrator"; break ;
	case "All categories": $new = "所有类别 All categories"; break ;		
	case "Approval needed for posting of events.": $new = "添加活动需要审核。 Approval needed for posting of events."; break;  
	case "Approvals": $new = "审核 Approvals"; break ;
	case "Approve": $new = "审核 Approve"; break;
	case "Approving event": $new = "正在审核活动 Approving event"; break;
	
	case "Back": $new = "退回 Back"; break;
	case "Both passwords entered do not match": $new = "两次输入的密码不匹配 Both passwords entered do not match"; break;	

	case "Calendar": $new = "日程表 Calendar"; break;
	case "Cancel": $new = "取消 Cancel"; break ;
	case "Cannot delete current login user": $new = "无法删除当前已登入用户 Cannot delete current login user"; break ;   
	case "Cannot change current login user": $new = "无法修改当前已登入用户 Cannot change current login user"; break;	
	case "Cannot have a category with blank name": $new = "类别名不能为空 Cannot have a category with blank name"; break ;
	case "Categories": $new = "类别 Categories"; break;
	case "Category": $new = "类别 Category"; break;
	case "Change": $new = "修改 Change"; break ;
	case "Change password": $new = "修改密码 Change password"; break; 		// master translate?
	case "Change password/group": $new = "修改密码/组 Change password/group"; break; 	// master obsolete?	
	case "Choose Category": $new = "选择类别 Choose Category"; break;
	case "Close": $new = "关闭 Close"; break;
	case "Confirm delete?": $new = "确实要删除？ Confirm delete?" ; break ;			
	case "Confirm delete all historical events before": $new = "确定将以前的活动全部删除 Confirm delete all historical events before"; break ;
	case "confirmed events for today": $new = "今天的活动已证实 confirmed events for today"; break ;
	case "Confirm password": $new = "确认口令 Confirm password"; break; 		
	case "Copy Event": $new = "复制活动 Copy Event"; break ;				
	case "Current Week": $new = "本周 Current Week"; break;
	case "Current Month": $new = "当月 Current Month"; break;
	case "Current Year": $new = "今年 Current Year"; break;		

	case "Date": $new = "日期 Date"; break;
	case "Day": $new = "日 Day"; break;
	case "Delete all historical events listed": $new = "将下列所有以往的活动删除 Delete all historical events listed"; break;
	case "Delete category": $new = "删除类别 Delete category"; break;
	case "Delete event": $new = "删除活动 Delete event"; break;
	case "Delete user": $new = "删除用户 Delete user"; break;
	case "Deleting category": $new = "正在删除类别 Deleting category"; break;
	case "Deleting event": $new = "正在删除活动 Deleting event"; break ;
	case "Deleting user": $new = "正在删除用户 Deleting user"; break ;
	case "disabled": $new = "此功能不可用 This section has been disabled"; break;

	case "Edit category": $new = "编辑类别 Edit category"; break;
	case "Edit event": $new = "编辑活动 Edit event"; break;
	case "Edit information": $new = "编辑信息 Edit information"; break;	// master translate?
	case "Email": $new = "电邮 Email"; break;
	case "End Time": $new = "结束时间 End Time"; break ;
	case "Event": $new = "活动 Event"; break ;
	case "Event Category": $new = "活动类别 Event Category"; break;
	case "Event Description": $new = "活动描述 Event Description"; break;
	case "Event repeated": $new = "重复的活动 Event repeated"; break;  
	case "Event Title": $new = "活动标题 Event Title"; break;
	case "events": $new = "活动 events"; break;
	case "Events added will be posted immediately.": $new = "新加活动将立刻生效。 Events added will be posted immediately."; break ;
	case "events awaiting approval": $new = "活动等待审核中 events awaiting approval"; break ;
	case "Events before": $new = "以前的活动 Events before"; break ;
	case "events for": $new = "events for"; break;
	case "Events for day": $new = "Events for day"; break;
	case "events for whole calendar": $new = "events for whole calendar"; break;
	case "events for year": $new = "events for year"; break;
	case "Events from ": $new = "Events from "; break;
	case "Events in category": $new = "Events in category"; break;

	case "From": $new = "自从 From"; break ;
	case "Functions": $new = "功能 Functions"; break ;	// master translate?

	case "Go to": $new = "Go to"; break;
	case "Go to day": $new = "Go to day"; break;
	case "Go to week": $new = "Go to week"; break;

	case "Historical Items": $new = "历史记录 Historical Items"; break;

	case "Login": $new = "登录 Login"; break;
	case "Login session time out in seconds": $new = "登录操作即将超时 Login session time out in seconds"; break;
	case "Login session timeout": $new = "登陆操作超时 Login session timeout"; break ;
	case "Logout": $new = "注销Logout"; break;

	case "Menu": $new = "菜单 Menu"; break;
	case "Month": $new = "月 Month"; break;
	case "More info": $new = "更多信息 More info"; break;

	case "Name": $new = "名字 Name"; break;			// master translate?
	case "Next": $new = "下一个 Next"; break;				
	case "Next day": $new = "明天 Next day"; break;
	case "Next week": $new = "下星期 Next week"; break;
	case "No categories yet": $new = "还没有类别 No categories yet"; break;
	case "No events": $new = "没有活动 No events"; break;
	case "No Repeat": $new = "不重复 No Repeat"; break;
	case "No results": $new = "没有结果 No results"; break;
	case "No, go back!": $new = "没有，请回！ No, go back!"; break;
	case "No.": $new = "不。 No."; break;			// master translate?
	case "noadminapprove": $new = "管理员添加的活动无须由管理员审核 Approval of events added by administrators not needed by administrator"; break ;
	case "noapprove": $new = "用户添加的活动无须管理员审核 Approval of events added by users not needed by administrator"; break ;
	case "nocat": $new = "你必须指定某个类别！ You must select a category !"; break;
	case "noday": $new = "你必须指定某日！ You must select a day !"; break;
	case "nodescription": $new = "你必须对活动进行描述！ You must give an event description !"; break;
	case "nomonth": $new = "你必须指定某月！ You must select a month !"; break;
	case "nonapproved": $new = "活动需要审核： Events requiring approval : "; break;
	case "nononapproved": $new = "当前没有活动需要审核 There are no events needing approval at this time"; break;
	case "notitle": $new = "你必须标明活动的主题！ You must give an event title !"; break;
	case "noyear": $new = "你必须指定某年！ You must select a year !"; break;

	case "on": $new = "在 on"; break;
	case "Optional": $new = "操作 Optional"; break;
	case "or month": $new = "或者月 or month"; break;
	case "or week": $new = "或者星期 or week"; break;

	case "password": $new = "密码 password"; break;
	case "Please choose the category you only want to view events for": $new = "请选择你想查看的活动类别 Please choose the category you only want to view events for"; break;  
	case "Popup Month": $new = "弹出月历 Popup Month"; break ;
	case "Previous": $new = "前一个 Previous"; break;			
	case "Previous day": $new = "前一天 Previous day"; break;
	case "Previous week": $new = "下个星期 Previous week"; break;

	case "Read more": $new = "详细阅读 Read more"; break;
	case "reallydelcat": $new = "您确实要删除这个类别？此类别下的所有活动都将删除！ Are you sure to you want remove this category? All events associated with this category will be permanently deleted!"; break;
	case "Repeat": $new = "重复 Repeat"; break;
	case "results": $new = "结果 results"; break;
	case "Role": $new = "角色 Role"; break;			// master translate?

	case "search": $new = "搜索 search"; break;
	case "Sort by": $new = "按下列顺序Sort by"; break ;
	case "Sort by date": $new = "按日期排列 Sort by date"; break ;
	case "Sort by events": $new = "按活动名排列 Sort by events"; break ;
	case "Start Time": $new = "开始时间 Start Time"; break ;

	case "thankyou": $new = "感谢您添加了活动，它将在审核后生效。 Thank you for entering an event, it will appear after approval."; break;
	case "thankyoupost": $new = "感谢您添加了活动，它已生效。 Thank you for entering an event, it has been posted."; break;
	case "till": $new = "直到 till"; break;
	case "Time added or updated": $new = "增加或更新时间 Time added or updated"; break ;
	case "timeout msg": $new = "超时的修改操作将在下次登录时生效 Changes in session timeout will only be effective on next login" ; break ;
	case "times every": $new = "每次 times every"; break;	
	case "To": $new = "去 To"; break ;
	case "To delete category": $new = "删除类别 To delete category"; break ;
	case "Today": $new = "今天 Today"; break;
	case "Total": $new = "总共 Total"; break;
	case "Total number of events for the month": $new = "这月活动的总数 Total number of events for the month"; break ;
	case "Total number of events for user": $new = "此用户的活动总数 Total number of events for user"; break ;		
	case "Total unapproved events for the month": $new = "这月未审核的活动总数 Total unapproved events for the month" ; break;
	case "Two weeks": $new = "两个星期 Two weeks" ; break;	

	case "Update": $new = "更新 Update"; break;
	case "Update Event": $new = "更新活动 Update Event"; break;
	case "Updating category": $new = "正在更新类别 Updating category"; break ;
	case "Updating event": $new = "正在更新活动 Updating event"; break;
	case "Updating user": $new = "正在更新用户 Updating user"; break;			
	case "Unapproved events": $new = "未审核的活动 Unapproved events"; break ;
	case "User": $new = "用户 User"; break ;
	case "User Calendar": $new = "用户日程表 User Calendar"; break ;
	case "User description": $new = "用户描述 User description"; break ;		
	case "User group": $new = "用户组 User group"; break ;				
	case "User Management": $new = "用户管理 User Management"; break;
	case "userdelok": $new = "确实要删除此用户 Are you sure to delete this user ?"; break;
	case "username": $new = "用户名 username"; break;
	case "Username and passwords must be alpha-numeric and without spaces.": $new = "用户名和密码必须是字母或数字且不能留空。 Username and passwords must be alpha-numeric and without spaces."; break; 	// version 0.4.20030731
	case "Username entered already exists. Please use another username.": $new = "用户名已存在。请再起一个用户名。 Username entered already exists. Please use another username."; break;
	case "users": $new = "用户 users"; break;

	case "View": $new = "查看 View"; break;
	case "View categories in year": $new = "以年查看类别 View categories in year"; break ;
	case "View details or edit": $new = "查看详细内容或编辑 View details or edit"; break ;
	case "View event": $new = "查看活动 View event"; break;
	case "View events of user": $new = "查看用户的活动 View events of user"; break;
	case "View events under this category in year": $new = "以年的查看此类别下的活动 View events under this category in year"; break ;
	case "View historical events before": $new = "查看以往的活动 View historical events before"; break ;
	case "View month": $new = "月查看 View month"; break;
	case "View week": $new = "周查看 View week"; break;

	case "Web Calendar Admin Login": $new = "日程表管理登录 Calendarix Admin Login"; break ;
	case "Web Calendar User Login": $new = "日程表用户登录 Calendarix User Login"; break ;
	case "week number": $new = "周数 week number"; break;
	case "Week starts": $new = "周开始 Week starts"; break;
	case "wronglogin": $new = "用户名或密码不对 Incorrect username or password"; break;

	case "Year": $new = "年 Year"; break;
	case "Yes": $new = "是 Yes"; break;		// version 0.4.20030731
	case "Yes, delete event !": $new = "是，删除活动！ Yes, delete event !"; break;
	case "Yes, delete it!": $new = "是，删除它！ Yes, delete it!"; break;

	default: $new = "<b>".$msgin."</b> needs to be translated !";    break;

    }
    return $new;
}
?>