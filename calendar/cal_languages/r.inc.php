<?php
function translate($msgin){

    switch ($msgin) {
	case "About Calendarix": $new = "Про календарикс"; break ;		
	case "Add": $new = "Добавить"; break ;
	case "Add Category": $new = "Добавить категорию"; break;
	case "Add Event": $new = "Добавить Событие"; break;
	case "Add event": $new = "Добавить событие" ; break;
	case "Add new user": $new = "Добавить нового пользователя"; break;
	case "Adding category": $new = "Добавление категории"; break;
	case "Adding event": $new = "Добавление события" ; break ;
	case "Adding user": $new = "Добавление пользователя"; break ;
	case "Administration": $new = "Администрирование"; break;
	case "Administrator": $new = "Администратор"; break ;
	case "All categories": $new = "Все категории"; break ;		
	case "Approval needed for posting of events.": $new = "Для публикации события необходимо одобрение администратора календаря."; break;  
	case "Approvals": $new = "Одобрения"; break ;
	case "Approve": $new = "Одобрено"; break;
	case "Approving event": $new = "Одобренные события"; break;
	
	case "Back": $new = "Назад"; break;
	case "Both passwords entered do not match": $new = "Оба введенных пароля не совпадают"; break;	

	case "Calendar": $new = "Календарь"; break;
	case "Cancel": $new = "Сброс"; break ;
	case "Cannot delete current login user": $new = "Не могу удалить текущий пароль пользователя"; break ;   
	case "Cannot change current login user": $new = "Не могу изменить текущий пароль пользователя"; break;	
	case "Cannot have a category with blank name": $new = "Поле Категория не может быть пустым"; break ;
	case "Categories": $new = "Категории"; break;
	case "Category": $new = "Категория"; break;
	case "Change": $new = "Изменить"; break ;
	case "Change password/group": $new = "Изменить пароль/группу"; break; 		
	case "Choose Category": $new = "Выбрать категорию"; break;
	case "Close": $new = "Закрыть"; break;
	case "Confirm delete?": $new = "Подтверждаете удаление?" ; break ;		
	case "Confirm delete all historical events before": $new = "Подтверждаете удаление всех предыдущих событий"; break ;
	case "confirmed events for today": $new = "подтверждаете события на сегодня"; break ;
	case "Confirm password": $new = "Подтверждаете пароль"; break; 		
	case "Copy Event": $new = "Копировать Событие"; break ;				
	case "Current Week": $new = "Текущая неделя"; break;
	case "Current Month": $new = "Текущий месяц"; break;
	case "Current Year": $new = "Текущий год"; break;		

	case "Date": $new = "Дата"; break;
	case "Day": $new = "День"; break;
	case "Delete all historical events listed": $new = "Удалить все записанные в календарь исторические события"; break;
	case "Delete category": $new = "Удалить категорию"; break;
	case "Delete event": $new = "Удалить событие"; break;
	case "Delete user": $new = "Удалить пользователя"; break;
	case "Deleting category": $new = "Удаление категории"; break;
	case "Deleting event": $new = "Удаление события"; break ;
	case "Deleting user": $new = "Удаление пользователя"; break ;
	case "disabled": $new = "выведено из строя"; break;

	case "Edit category": $new = "Редактировать категорию"; break;
	case "Edit event": $new = "Редактировать событие"; break;
	case "Email": $new = "E-mail"; break;
	case "End Time": $new = "Время окончания"; break ;
	case "Event": $new = "Событие"; break ;
	case "Event Category": $new = "Категория События"; break;
	case "Event Description": $new = "Описание события"; break;
	case "Event repeated": $new = "Обновить событие"; break;  
	case "Event Title": $new = "Новое название"; break;
	case "events": $new = "события"; break;
	case "Events added will be posted immediately.": $new = "Добавленное событие будет опубликовано немедленно."; break ;
	case "events awaiting approval": $new = "события ожидающие одобрения"; break ;
	case "Events before": $new = "События перед"; break ;
	case "events for": $new = "события за"; break;
	case "Events for day": $new = "События за день"; break;
	case "events for whole calendar": $new = "события за весь календарь"; break;
	case "events for year": $new = "события за год"; break;
	case "Events from ": $new = "События от "; break;
	case "Events in category": $new = "События в категории"; break;

	case "From": $new = "От"; break ;

	case "Go to": $new = "Перейти к"; break;
	case "Go to day": $new = "Перейти к дню"; break;
	case "Go to week": $new = "Перейти к неделе"; break;

	case "Historical Items": $new = "Исторические события"; break;

	case "Login": $new = "Логин"; break;
	case "Login session time out in seconds": $new = "Сессия авторизации прекратиться через секунду"; break;
	case "Login session timeout": $new = "Сессия авторизации прекращена"; break ;
	case "Logout": $new = "Выход"; break;

	case "Menu": $new = "Меню"; break;
	case "Month": $new = "Месяц"; break;
	case "More info": $new = "Больше информации"; break;

	case "Next": $new = "Следующая"; break;				
	case "Next day": $new = "Следующий день"; break;
	case "Next week": $new = "Следующая неделя"; break;
	case "No categories yet": $new = "Пока нет категорий"; break;
	case "No events": $new = "Нет событий"; break;
	case "No Repeat": $new = "Нет обновлений"; break;
	case "No results": $new = "Нет результатов"; break;
	case "No, go back!": $new = "Нет, пройдите назад!"; break;
	case "noadminapprove": $new = "События, добавляемое администратором, не требует одобрения"; break ;
	case "noapprove": $new = "Добавление события пользователем, не требует одобрения админа"; break ;
	case "nocat": $new = "Выберите другую категорию !"; break;
	case "noday": $new = "Изберите другой день !"; break;
	case "nodescription": $new = "Впишите недостающее описание события !"; break;
	case "nomonth": $new = "Выберите другой месяц !"; break;
	case "nonapproved": $new = "События ожидающие одобрения : "; break;
	case "nononapproved": $new = "Нет событий, требущих одобрения"; break;
	case "notitle": $new = "Впишите название события !"; break;
	case "noyear": $new = "Выберите отсутствующий год !"; break;

	case "on": $new = "на"; break;
	case "Optional": $new = "Выборочно"; break;
	case "or month": $new = "или месяц"; break;
	case "or week": $new = "или неделю"; break;

	case "password": $new = "пароль"; break;
	case "Please choose the category you only want to view events for": $new = "Выберите категорию в которой вы хотите видеть событие"; break;  
	case "Popup Month": $new = "Месяц вверх"; break ;
	case "Previous": $new = "Предыдущая"; break;			
	case "Previous day": $new = "Предыдущий день"; break;
	case "Previous week": $new = "Предыдущая неделя"; break;

	case "Read more": $new = "Читать далее"; break;
	case "reallydelcat": $new = "Вы действительно хотите удалить категорию? Все события в категории будут также удалены!"; break;
	case "Repeat": $new = "Обновление"; break;
	case "results": $new = "результаты"; break;

	case "search": $new = "поиск"; break;
	case "Sort by": $new = "Сортировать по"; break ;
	case "Sort by date": $new = "Сортировать по дате"; break ;
	case "Sort by events": $new = "Сортировать по событиям"; break ;
	case "Start Time": $new = "Дата начала"; break ;

	case "thankyou": $new = "Спасибо за событие, оно будет опубликовано после проверки."; break;
	case "thankyoupost": $new = "Спасибо за ваше событие, которое вы послали."; break;
	case "till": $new = "до"; break;
	case "Time added or updated": $new = "Время добавления/обновления"; break ;
	case "timeout msg": $new = "Изменения, сделанные во время этой авторизации, станут эффективными при следующей авторизации" ; break ;
	case "times every": $new = "повторять каждый(е)"; break;	
	case "To": $new = "до"; break ;
	case "To delete category": $new = "Для удаления категории"; break ;
	case "Today": $new = "Сегодня"; break;
	case "Total": $new = "Всего"; break;
	case "Total number of events for the month": $new = "Всего событий за месяц"; break ;
	case "Total number of events for user": $new = "Всего количество событий для пользователя"; break ;		
	case "Total unapproved events for the month": $new = "Всего неодобренных событий за месяц" ; break;
	case "Two weeks": $new = "Две недели" ; break;	

	case "Update": $new = "Обновить"; break;
	case "Update Event": $new = "Обновить Событие"; break;
	case "Updating category": $new = "Обновить категорию"; break ;
	case "Updating event": $new = "Обновить событие"; break;
	case "Updating user": $new = "Обновить пользователя"; break;			
	case "Unapproved events": $new = "Неодобренные события"; break ;
	case "User": $new = "Пользователь"; break ;
	case "User Calendar": $new = "Календарь пользователя"; break ;
	case "User description": $new = "Описание пользователя"; break ;		
	case "User group": $new = "Группа пользователей"; break ;				
	case "User Management": $new = "Управление пользователями"; break;
	case "userdelok": $new = "Вы действительно хотите удалить этого пользователя ?"; break;
	case "username": $new = "ник"; break;
	case "Username entered already exists. Please use another username.": $new = "Введенный пользователь уже существует. Просим ввести другой ник."; break;
	case "users": $new = "пользователей"; break;

	case "View": $new = "Просмотр"; break;
	case "View categories in year": $new = "Просмотр категорий в году"; break ;
	case "View details or edit": $new = "Просмотреть детали или редактировать"; break ;
	case "View event": $new = "Просмотр события"; break;
	case "View events of user": $new = "Просмотр событий для пользователя"; break;
	case "View events under this category in year": $new = "Просмотр событий для этой категории в год"; break ;
	case "View historical events before": $new = "Просмотр исторических событий до"; break ;
	case "View month": $new = "Просмотр месяца"; break;
	case "View week": $new = "Просмотр недели"; break;

	case "Web Calendar Admin Login": $new = "Авторизация админа"; break ;
	case "Web Calendar User Login": $new = "Авторизация пользователя"; break ;
	case "week number": $new = "номер недели"; break;
	case "Week starts": $new = "Неделя стартует с"; break;
	case "wronglogin": $new = "Неверно введен логин"; break;

	case "Year": $new = "Год"; break;
	case "Yes, delete event !": $new = "Да, удалите события !"; break;
	case "Yes, delete it!": $new = "Да, удалите их!"; break;

	default: $new = "<b>".$msgin."</b> необходимо перевести !";    break;

    }
    return $new;
}
?>