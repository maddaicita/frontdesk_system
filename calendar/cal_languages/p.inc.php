<?php
function translate($msgin){
    switch ($msgin) {
	case "About Calendarix": $new = "Sobre Calendarix"; break ;		// translate? OK by Luciano
	case "Add": $new = "Adicionar"; break ;
	case "Add Category": $new = "Adicionar Categoria"; break;
	case "Add Event": $new = "Adicionar Evento"; break;
	case "Add event": $new = "Adicionar evento" ; break;
	case "Add new user": $new = "Adicionar novo usuário"; break;
	case "Adding category": $new = "Adicionando categoria"; break;
	case "Adding event": $new = "Adicionando evento" ; break ;
	case "Adding user": $new = "Adicionando usuário"; break ;
	case "Administration": $new = "Administração"; break;
	case "Administrator": $new = "Administrador"; break ;
	case "All categories": $new = "Todas as categorias"; break ;	
	case "Approval needed for posting of events.": $new = "Aprovação requerida para publicação de eventos."; break ;
	case "Approvals": $new = "Aprovações"; break ;
	case "Approve": $new = "Aprovar"; break;
	case "Approving event": $new = "Aprovando evento"; break;
	
	case "Back": $new = "Voltar"; break;
	case "Both passwords entered do not match": $new = "Ambas as senhas digitadas são inválidas"; break;	

	case "Calendar": $new = "Calendário"; break;
	case "Cancel": $new = "Cancelar"; break ;
	case "Cannot delete current login user": $new = "Não é possível deletar usuário em sessão"; break ;   
	case "Cannot change current login user": $new = "Não possível alterar usuário em sessão"; break;	
	case "Cannot have a category with blank name": $new = "Não existe categoria com nome em branco"; break ;
	case "Categories": $new = "Categorias"; break;
	case "Category": $new = "Categoria"; break;
	case "Change": $new = "Alterar"; break ;
	case "Change password/group": $new = "Alterar senha/grupo"; break; 		
	case "Choose Category": $new = "Escolha uma categoria"; break;
	case "Close": $new = "Fechar"; break;
	case "Coming Events": $new = "Próximos eventos"; break;			// 0.6.20050830 OK by Luciano
	case "Confirm delete?": $new = "Confirma exclusão?" ; break ;	
	case "Confirm delete all historical events before": $new = "Confirma deletação de itens históricos anteriores"; break ;
	case "confirmed events for today": $new = "eventos confirmados para hoje"; break ;
	case "Confirm password": $new = "Confirme a senha"; break; 
	case "Copy Event": $new = "Copiar evento"; break ;
	case "Current Week": $new = "Semana vigente"; break;
	case "Current Month": $new = "Mês vigente"; break;
        case "Current Year": $new = "Ano vigente"; break;

	case "Date": $new = "Data"; break;
	case "Day": $new = "Dia"; break;
	case "Delete all historical events listed": $new = "Deletar todos os eventos históricos listados"; break;
	case "Delete category": $new = "Deletar categoria"; break;
	case "Delete event": $new = "Deletar evento"; break;
	case "Delete user": $new = "Deletar usuário"; break;
	case "Deleting category": $new = "Deletando categoria"; break;
	case "Deleting event": $new = "Deletando evento"; break ;
	case "Deleting user": $new = "Deletando usuário"; break ;
	case "disabled": $new = "Esta seção está desabilitada"; break;

	case "Edit category": $new = "Editar categoria"; break;
	case "Edit event": $new = "Editar evento"; break;
	case "Edit information": $new = "Editar informação"; break;	// master translate? Ok by Luciano
	case "Email": $new = "Email"; break;
	case "End Time": $new = "Fim"; break ;
	case "Event": $new = "Evento"; break ;
	case "Event Category": $new = "Categoria do evento"; break;
	case "Event Description": $new = "Descrição do evento"; break;
	case "Event repeated": $new = "Evento repetido"; break;  //Ok by Luciano
	case "Event Title": $new = "Título do Evento"; break;
	case "events": $new = "eventos"; break;
	case "Events added will be posted immediately.": $new = "Os eventos adicionados serão postados imediatamente."; break ;
	case "events awaiting approval": $new = "eventos aguardando aprovação"; break ;
	case "Events before": $new = "Eventos anteriores"; break ;
	case "events for": $new = "Eventos para"; break;
	case "Events for day": $new = "Eventos para o dia"; break;
	case "events for whole calendar": $new = "eventos para o calendário inteiro"; break;
	case "events for year": $new = "eventos para o ano"; break;
	case "Events from ": $new = "Eventos de "; break;
	case "Events in category": $new = "Eventos na categoria"; break;

	case "From": $new = "De"; break ;
	case "Functions": $new = "Funções"; break ;	// master translate? Ok by Luciano

	case "Go to": $new = "Ir para"; break;
	case "Go to day": $new = "Ir para dia"; break;
	case "Go to week": $new = "Ir para semana"; break;

	case "Historical Items": $new = "Artigos históricos"; break;

	case "Login": $new = "Login"; break;
	case "Login session time out in seconds": $new = "Tempo de expiração de uma sessão em segundos"; break;
	case "Login session timeout": $new = "Sessão Expirada"; break ;
	case "Logout": $new = "Sair"; break;

	case "Menu": $new = "Menu"; break;
	case "Month": $new = "Mês"; break;
	case "More info": $new = "Mais informações"; break;

	case "Name": $new = "Nome"; break;			// master translate? Ok by Luciano
	case "Next": $new = "Próxima"; break;				
	case "Next day": $new = "Próximo dia"; break;
	case "Next week": $new = "Próxima semana"; break;
	case "No categories yet": $new = "Sem categorias disponíveis"; break;
	case "No events": $new = "Sem eventos"; break;
	case "No Repeat": $new = "Não repetir"; break;
	case "No results": $new = "Sem resultados"; break;
	case "No, go back!": $new = "Não, volte!"; break;
	case "No.": $new = "Não."; break;			// master translate? Ok by Luciano
	case "noadminapprove": $new = "Aprovação de eventos adicionada por administradores não é necessária"; break ;
	case "noapprove": $new = "Aprovação de eventos adicionados por usuários não necessita de administrador"; break ;
	case "nocat": $new = "Você precisa selecionar uma categoria !"; break;
	case "noday": $new = "Você precisa selecionar um dia !"; break;
	case "nodescription": $new = "Você precisa descrever o evento !"; break;
	case "nomonth": $new = "Você precisa selecionar um mês !"; break;
	case "nonapproved": $new = "Eventos necessitando de aprovação : "; break;
	case "nononapproved": $new = "Sem eventos a serem aprovados nesse momento"; break;
	case "notitle": $new = "Você precisa dar um título !"; break;
	case "noyear": $new = "Você precisa selecionar um ano !"; break;

	case "on": $new = "em"; break;
	case "Optional": $new = "Opcional"; break;
	case "or month": $new = "ou mês"; break;
	case "or week": $new = "ou semana"; break;

	case "password": $new = "senha"; break;
	case "Please choose the category you only want to view events for": $new = "Por favor escolha a categoria que você deseja ver os eventos somente"; break; 
	case "Popup Month": $new = "Abrir mês em janela separada"; break ;
	case "Previous": $new = "Anterior"; break;			
	case "Previous day": $new = "Dia anterior"; break;
	case "Previous week": $new = "Semana anterior"; break;

	case "Read more": $new = "Ler mais"; break;
	case "reallydelcat": $new = "Você tem certeza que deseja remover esta categoria? Todos os eventos relacionados com esta categoria serão permanentemente deletados!"; break;

	case "Repeat": $new = "Repetir"; break;
	case "results": $new = "resultado(s)"; break;
	case "Role": $new = "Papel"; break;		// master translate? OK??? by Luciano i don't know if this is the right tradution

	case "search": $new = "procurar"; break;
	case "Sort by": $new = "Ordener por"; break ;
	case "Sort by date": $new = "Ordenar por data"; break ;
	case "Sort by events": $new = "Ordenar por evento"; break ;
	case "Start Time": $new = "Hora Início"; break ;

	case "thankyou": $new = "Obrigado por adicionar um evento, ele aguardará por aprovação."; break;
	case "thankyoupost": $new = "Obrigado por adicionar um evento, ele será postado nesse momento."; break;
	case "till": $new = "até"; break;
	case "Time added or updated": $new = "Hora adicionada ou atualizada"; break ;
	case "timeout msg": $new = "Mudanças realizadas em sessões expiradas serão efetivadas somente na próxima sessão" ; break ;
	case "times every": $new = "vez(es) todo(a)"; break;
	case "To": $new = "Até às"; break ;
	case "To delete category": $new = "Para deletar categoria"; break ;
	case "Today": $new = "Hoje"; break;
	case "Total": $new = "Total"; break;
	case "Total number of events for the month": $new = "Total de eventos deste mês"; break ;
        case "Total number of events for user": $new = "Total de eventos deste usuário"; break ;
	case "Total unapproved events for the month": $new = "Total de eventos não aprovados neste mês" ; break;
        case "Two weeks": $new = "Duas semanas" ; break;

	case "Update": $new = "Atualizar"; break;
	case "Update Event": $new = "Atualizar evento"; break;
	case "Updating category": $new = "Atualizando categoria"; break ;
	case "Updating event": $new = "Atualizando evento"; break;
	case "Updating user": $new = "Atualizando usuário"; break;			
	case "Unapproved events": $new = "Eventos não aprovados"; break ;
	case "User": $new = "Usuário"; break ;
	case "User Calendar": $new = "Calendário dos usuários"; break ;
	case "User description": $new = "Descrição do usuário"; break ;	
	case "User group": $new = "Grupo do Usuário"; break ;				//Ok by Luciano
	case "User Management": $new = "Gerenciamento de usuários"; break;
	case "userdelok": $new = "Você tem certeza que deseja deletar este usuário ?"; break;
	case "username": $new = "Nome de usuário"; break;
	case "Username and passwords must be alpha-numeric and without spaces.": $new = "Usuário e senha devem ser caracteres alfanuméricos e sem espaços."; break; 	// version 0.4.20030731 Ok by Luciano
	case "Username entered already exists. Please use another username.": $new = "Nome de usuário já existente. Por favor use outro nome de usuário."; break;
	case "users": $new = "usuários"; break;

	case "View": $new = "Ver"; break;
	case "View categories in year": $new = "Ver categorias no ano"; break ;
	case "View details or edit": $new = "Ver detalhes ou editar"; break ;
	case "View event": $new = "Ver evento"; break;
	case "View events of user": $new = "Ver eventos do usuário"; break;
	case "View events under this category in year": $new = "Ver eventos desta categoria"; break ;
	case "View historical events before": $new = "Ver eventos históricos anteriores"; break ;
	case "View month": $new = "Ver mês"; break;
	case "View week": $new = "Ver semana"; break;

	case "Web Calendar Admin Login": $new = "Calendarix - Validação de administrador"; break ;
	case "Web Calendar User Login": $new = "Calendarix - Validação de Usuário"; break ;
	case "week number": $new = "número da semana"; break;
	case "Week starts": $new = "Início da semana"; break;
	case "wronglogin": $new = "Nome de usuário ou senha inválida"; break;

	case "Year": $new = "Ano"; break;
	case "Yes": $new = "Sim"; break;		// version 0.4.20030731 Ok by Luciano
	case "Yes, delete event !": $new = "Sim, deleta o evento !"; break;
	case "Yes, delete it!": $new = "Sim, deleta isso!"; break;

	default: $new = "<b>".$msgin."</b> precisa ser traduzido !";    break;

    }
    return $new;
}
?>
