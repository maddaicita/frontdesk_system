<?php
function translate($msgin){

    switch ($msgin) {
	case "About Calendarix": $new = "About Calendarix"; break ;		// translate?
	case "Add": $new = "Ekle"; break ;
	case "Add Category": $new = "Kategori Ekle"; break;
	case "Add Event": $new = "Konu Ekle"; break;
	case "Add event": $new = "Konu ekle" ; break;
	case "Add new user": $new = "Yeni Kullanýcý Ekle"; break;
	case "Adding category": $new = "Kategori ekleme"; break;
	case "Adding event": $new = "Konu ekleme" ; break ;
	case "Adding user": $new = "Kullanýcý ekleme"; break ;
	case "Administration": $new = "Yönetim"; break;
	case "Administrator": $new = "Yönetici"; break ;
	case "All categories": $new = "All categories"; break ;		// translate?
	case "Approval needed for posting of events.": $new = "Postalanan Konularýn onaylanmasý gerekli."; break;  
	case "Approvals": $new = "Onaylar"; break ;
	case "Approve": $new = "Onay"; break;
	case "Approving event": $new = "Onaylanan Konu"; break;
	
	case "Back": $new = "Geri"; break;
	case "Both passwords entered do not match": $new = "Girilen parolalar uyumsuz"; break;	

	case "Calendar": $new = "Takvim"; break;
	case "Cancel": $new = "Ýptal"; break ;
	case "Cannot delete current login user": $new = "Þu an aktif olan kullanýcý silinemez"; break ;   
	case "Cannot change current login user": $new = "Þu an aktif olan kullanýcý deðiþtirilemez"; break;	
	case "Cannot have a category with blank name": $new = "Kategori ismi boþ olamaz"; break ;
	case "Categories": $new = "Kategoriler"; break;
	case "Category": $new = "Kategori"; break;
	case "Change": $new = "Deðiþtir"; break ;
	case "Change password/group": $new = "Parola/Grup deðiþtir"; break; 		
	case "Choose Category": $new = "Kategori seçin..."; break;
	case "Close": $new = "Kapat"; break;
	case "Confirm delete?": $new = "Confirm delete?" ; break ;			// translate?
	case "Confirm delete all historical events before": $new = "Bu tarihten önceki konularýn silinmesini onaylayýnýz"; break ;
	case "confirmed events for today": $new = "Bugün için teyit edilmiþ Konular"; break ;
	case "Confirm password": $new = "Parola teyidi"; break; 		
	case "Copy Event": $new = "Konu Kopyala"; break ;				
	case "Current Week": $new = "Bu Hafta"; break;
	case "Current Month": $new = "Bu Ay"; break;
	case "Current Year": $new = "Bu Sene"; break;		

	case "Date": $new = "Tarih"; break;
	case "Day": $new = "Gün"; break;
	case "Delete all historical events listed": $new = "Listelenen bütün geçmiþ konularý sil"; break;
	case "Delete category": $new = "Kategori Sil"; break;
	case "Delete event": $new = "Konu silinsin mi"; break;
	case "Delete user": $new = "Kullanýcý Sil"; break;
	case "Deleting category": $new = "Kategori Silme"; break;
	case "Deleting event": $new = "Konu Silme"; break ;
	case "Deleting user": $new = "Kullanýcý Silme"; break ;
	case "disabled": $new = "Bu bölüm devre dýþý"; break;

	case "Edit category": $new = "Kategori Düzenle"; break;
	case "Edit event": $new = "Konu Düzenle"; break;
	case "Email": $new = "Email"; break;
	case "End Time": $new = "Bitiþ Zamaný"; break ;
	case "Event": $new = "Konu"; break ;
	case "Event Category": $new = "Konu Kategorisi"; break;
	case "Event Description": $new = "Konu Tanýmý"; break;
	case "Event repeated": $new = "Tekrarlanan Konular"; break;  
	case "Event Title": $new = "Konu Baþlýðý"; break;
	case "events": $new = "Konu"; break;
	case "Events added will be posted immediately.": $new = "Eklenen konular hemen postalanacaktýr"; break ;
	case "events awaiting approval": $new = "Onay bekleyen konular"; break ;
	case "Events before": $new = "Bu tarihten önceki konular"; break ;
	case "events for": $new = "konu"; break;
	case "Events for day": $new = "Bugünkü konular"; break;
	case "events for whole calendar": $new = "konu bütün takvim için"; break;
	case "events for year": $new = "konu yýl"; break;
	case "Events from ": $new = "Konular "; break;
	case "Events in category": $new = "Kategori içindeki konular"; break;

	case "From": $new = "Baþlangýç"; break ;

	case "Go to": $new = "Git"; break;
	case "Go to day": $new = "Güne"; break;
	case "Go to week": $new = "Haftaya"; break;

	case "Historical Items": $new = "Geçmiþ Öðeler"; break;

	case "Login": $new = "Giriþ"; break;
	case "Login session time out in seconds": $new = "Saniye olarak oturum sona erme süresi"; break;
	case "Login session timeout": $new = "Oturum sona erme süresi"; break ;
	case "Logout": $new = "Çýkýþ"; break;

	case "Menu": $new = "Menu"; break;
	case "Month": $new = "Ay"; break;
	case "More info": $new = "Daha Fazla Bilgi:"; break;

	case "Next": $new = "Sonraki"; break;				
	case "Next day": $new = "Sonraki Gün"; break;
	case "Next week": $new = "Sonraki Hafta"; break;
	case "No categories yet": $new = "Kategori yok"; break;
	case "No events": $new = "Konu yok"; break;
	case "No Repeat": $new = "Tekrar yok"; break;
	case "No results": $new = "Sonuç yok"; break;
	case "No, go back!": $new = "Hayýr, vazgeçtim!"; break;
	case "noadminapprove": $new = "Yöneticiler tarafýndan eklenen konularýn yönetici tarafýndan onaylanmasý gerekli deðildir"; break ;
	case "noapprove": $new = "Kullanýcý tarafýndan eklenen konularýn yönetici tarafýndan onaylanmasý gerekli deðildir"; break ;
	case "nocat": $new = "Bir kategori seçmelisiniz !"; break;
	case "noday": $new = "Bir gün seçmelisiniz !"; break;
	case "nodescription": $new = "Konuyu tanýmlamalýsýnýz !"; break;
	case "nomonth": $new = "Bir ay seçmelisiniz !"; break;
	case "nonapproved": $new = "Onay gerektiren konular : "; break;
	case "nononapproved": $new = "Onaylanmasý gereken herhangi bir konu bulunmamaktadýr"; break;
	case "notitle": $new = "Bir konu baþlýðý girmelisiniz !"; break;
	case "noyear": $new = "Bir yýl seçmelisiniz !"; break;

	case "on": $new = ""; break;
	case "Optional": $new = "Opsiyonel"; break;
	case "or month": $new = "yada aya git"; break;
	case "or week": $new = "veya haftaya git"; break;

	case "password": $new = "parola"; break;
	case "Please choose the category you only want to view events for": $new = "Please choose the category you only want to view events for"; break;  // translate?
	case "Popup Month": $new = "Ay"; break ;
	case "Previous": $new = "Önceki"; break;			
	case "Previous day": $new = "Önceki Gün"; break;
	case "Previous week": $new = "Önceki Hafta"; break;

	case "Read more": $new = "Detay..."; break;
	case "reallydelcat": $new = "Bu kategoriyi kaldýrmak istediðinizden emin misiniz? Bu kategoriye baðlý bütün konular geri dönüþü olmaksýzýn silinecekler!"; break;
	case "Repeat": $new = "Tekrar et"; break;
	case "results": $new = "sonuçlar"; break;

	case "search": $new = "ara"; break;
	case "Sort by": $new = "Sýrala"; break ;
	case "Sort by date": $new = "Tarihe göre sýrala"; break ;
	case "Sort by events": $new = "Konuya göre sýrala"; break ;
	case "Start Time": $new = "Baþlangýç Zamaný"; break ;

	case "thankyou": $new = "Konu giriþi yaptýðýnýz için teþekkür ederiz, onaydan sonra listelenecektir."; break;
	case "thankyoupost": $new = "Konu giriþi yaptýðýnýz için teþekkür ederiz, postalandý."; break;
	case "till": $new = "-"; break;
	case "Time added or updated": $new = "Eklenme veya deðiþtirilme zamaný"; break ;
	case "timeout msg": $new = "Oturum süresindeki deðiþiklikler bir sonraki giriþinizde etkili olacaktýr" ; break ;
	case "times every": $new = "kez her"; break;	
	case "To": $new = "Bitiþ"; break ;
	case "To delete category": $new = "Silinecek kategori"; break ;
	case "Today": $new = "Bugün"; break;
	case "Total": $new = "Toplam"; break;
	case "Total number of events for the month": $new = "Bu ayki toplam konu"; break ;
	case "Total number of events for user": $new = "Kullanýcýnýn toplam konularý"; break ;		
	case "Total unapproved events for the month": $new = "Bu ayki toplam onaylanmamýþ konular" ; break;
	case "Two weeks": $new = "Onbeþ Gün" ; break;	// translate?

	case "Update": $new = "Güncelle"; break;
	case "Update Event": $new = "Konuyu güncelle"; break;
	case "Updating category": $new = "Kategori güncelleme"; break ;
	case "Updating event": $new = "Konu güncelleme"; break;
	case "Updating user": $new = "Kullanýcý güncelleme"; break;			
	case "Unapproved events": $new = "Onaylanmamýþ konular"; break ;
	case "User": $new = "Kullanýcý"; break ;
	case "User Calendar": $new = "Kullanýcý Takvimi"; break ;
	case "User description": $new = "User description"; break ;		// translate?
	case "User group": $new = "Kullanýcý grubu"; break ;				
	case "User Management": $new = "Kullanýcý Yönetimi"; break;
	case "userdelok": $new = "Bu kullanýcýyý silmek istediðinize emin misiniz ?"; break;
	case "username": $new = "kullanýcý adý"; break;
	case "Username entered already exists. Please use another username.": $new = "Kullanýcý adý daha önceden girilmiþ. Lütfen baþka bir kullanýcý adý girin."; break;
	case "users": $new = "kullanýcýlar"; break;

	case "View": $new = "Göster"; break;
	case "View categories in year": $new = "Yýla ait kategorileri göster"; break ;
	case "View details or edit": $new = "Detaylarý gör veya düzenle"; break ;
	case "View event": $new = "Konuyu göster"; break;
	case "View events of user": $new = "Bu kullanýcýnýn konularýný göster"; break;
	case "View events under this category in year": $new = "Bu kategorideki ve yýla ait konularý göster"; break ;
	case "View historical events before": $new = "Bu tarihten önceki geçmiþ konularý göster"; break ;
	case "View month": $new = "Ayý gör"; break;
	case "View week": $new = "Haftayý gör"; break;

	case "Web Calendar Admin Login": $new = "Ajanda yönetici giriþi"; break ;
	case "Web Calendar User Login": $new = "Ajanda kullanýcý giriþi"; break ;
	case "week number": $new = "hafta sayýsý"; break;
	case "Week starts": $new = "Hafta baþlangýcý"; break;
	case "wronglogin": $new = "Yanlýþ kullanýcý adý veya parola"; break;

	case "Year": $new = "Yýl"; break;
	case "Yes, delete event !": $new = "Evet, konuyu sil !"; break;
	case "Yes, delete it!": $new = "Evet, sil!"; break;

	default: $new = "<b>".$msgin."</b> tercüme edilmeli !";    break;

    }
    return $new;
}
?>