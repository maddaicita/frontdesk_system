<?php
function translate($msgin){
    switch ($msgin) {
	case "About Calendarix": $new = "Tentang Agenda"; break ;		
	case "Add": $new = "Tambah"; break ;
	case "Add Category": $new = "Tambah Kategori"; break;
	case "Add Event": $new = "Tambah Kegiatan"; break;
	case "Add event": $new = "Tambah kegiatan" ; break;
	case "Add new user": $new = "Tambah user baru"; break;
	case "Adding category": $new = "Menambahkan kategori"; break;
	case "Adding event": $new = "Menambahkan kegiatan" ; break ;
	case "Adding user": $new = "Menambahkan user"; break ;
	case "Address": $new = "Alamat"; break ;			// master translate?
	case "Administration": $new = "Administrasi"; break;
	case "Administrator": $new = "Administrator"; break ;
	case "All categories": $new = "Seluruh kategori"; break ;		
	case "Approval needed for posting of events.": $new = "Posting kegiatan membutuhkan persetujuan"; break;  
	case "Approvals": $new = "Persetujuan"; break ;
	case "Approve": $new = "Setujui"; break;
	case "Approving event": $new = "Menyetujui kegiatan"; break;
	
	case "Back": $new = "Kembali"; break;
	case "Both passwords entered do not match": $new = "Password yang anda masukkan belum sama"; break;	

	case "Calendar": $new = "Kalender"; break;
	case "Cancel": $new = "Batal"; break ;
	case "Cannot delete current login user": $new = "Tidak dapat menghapus user yang sedang online"; break ;   
	case "Cannot change current login user": $new = "Tidak dapat mengubah user yang sedang online"; break;	
	case "Cannot have a category with blank name": $new = "Tidak dapat membuat kategory tanpa nama"; break ;
	case "Categories": $new = "Kategori"; break;
	case "Category": $new = "Kategori"; break;
	case "Change": $new = "Ubah"; break ;
	case "Change password": $new = "Ubah password"; break; 		// master translate?
	case "Change password/group": $new = "Ubah password/Group"; break; 	// master obsolete?	
	case "Choose Category": $new = "Pilih Kategori"; break;
	case "Close": $new = "Tutup"; break;
	case "Confirm delete?": $new = "Hapus?" ; break ;			
	case "Confirm delete all historical events before": $new = "Hapus kegiatan yang sudah lewat?"; break ;
	case "confirmed events for today": $new = "konfirmasi kegiatan hari ini"; break ;
	case "Confirm password": $new = "Konfirmasi password"; break; 		
	case "Copy Event": $new = "Gandakan kegiatan"; break ;				
	case "Current Week": $new = "Minggu Ini"; break;
	case "Current Month": $new = "Bulan Ini"; break;
	case "Current Year": $new = "Tahun Ini"; break;		

	case "Date": $new = "Tanggal"; break;
	case "Day": $new = "Hari"; break;
	case "Delete all historical events listed": $new = "Hapus kegiatan yang sudah lewat"; break;
	case "Delete category": $new = "Hapus kategori"; break;
	case "Delete event": $new = "Hapus kegiatan"; break;
	case "Delete user": $new = "Hapus user"; break;
	case "Deleting category": $new = "Hapus kategori"; break;
	case "Deleting event": $new = "Menghapus kegiatan"; break ;
	case "Deleting user": $new = "Menghapus user"; break ;
	case "disabled": $new = "Bagian ini dinonaktifkan"; break;

	case "Edit category": $new = "Edit kategori"; break;
	case "Edit event": $new = "Edit kegiatan"; break;
	case "Edit information": $new = "Edit informasi"; break;	// master translate?
	case "Email": $new = "Email"; break;
	case "End Time": $new = "Berakhir"; break ;
	case "Event": $new = "Kegiatan"; break ;
	case "Event Category": $new = "Kategori Kegiatan"; break;
	case "Event Description": $new = "Deskripsi Kegiatan"; break;
	case "Event repeated": $new = "Pengulangan kegiatan"; break;  
	case "Event Title": $new = "Judul Kegiatan"; break;
	case "events": $new = "kegiatan"; break;
	case "Events added will be posted immediately.": $new = "Kegiatan yang diajukan segera dikirim."; break ;
	case "events awaiting approval": $new = "kegiatan menunggu persetujuan"; break ;
	case "Events before": $new = "Kegiatan sebelum"; break ;
	case "events for": $new = "kegiatan untuk"; break;
	case "Events for day": $new = "Kegiatan untuk hari"; break;
	case "events for whole calendar": $new = "Seluruh kegiatan pada kalender ini"; break;
	case "events for year": $new = "kegiatan dalam satu tahun"; break;
	case "Events from ": $new = "Kegiatan dari "; break;
	case "Events in category": $new = "Kegiatan dalam kategori"; break;

	case "From": $new = "Dari"; break ;
	case "Functions": $new = "Fungsi-fungsi"; break ;	// master translate?

	case "Go to": $new = "Lihat"; break;
	case "Go to day": $new = "Lihat tanggal"; break;
	case "Go to week": $new = "lihat minggu"; break;

	case "Historical Items": $new = "Histori agenda"; break;

	case "Login": $new = "Login"; break;
	case "Login session time out in seconds": $new = "Session login time out dalam detik"; break;
	case "Login session timeout": $new = "Session login telah time out"; break ;
	case "Logout": $new = "Logout"; break;

	case "Menu": $new = "Menu"; break;
	case "Month": $new = "Bulan"; break;
	case "More info": $new = "Info selanjutnya"; break;

	case "Name": $new = "Nama"; break;			// master translate?
	case "Next": $new = "Selanjutnya"; break;				
	case "Next day": $new = "Hari selanjutnya"; break;
	case "Next week": $new = "Minggu Selanjutnya"; break;
	case "No categories yet": $new = "Belum ada kategori"; break;
	case "No events": $new = "Tidak ada kegiatan"; break;
	case "No Repeat": $new = "Tidak ada pengulangan"; break;
	case "No results": $new = "Tidak ada hasil"; break;
	case "No, go back!": $new = "Tidak, kembali!"; break;
	case "No.": $new = "Tidak."; break;			// master translate?
	case "noadminapprove": $new = "Persetujuan tidak diperlukan oleh administrator"; break ;
	case "noapprove": $new = "Persetujuan tambahan kegiatan tidak perlu disetujui administrator"; break ;
	case "nocat": $new = "Anda harus memilih kategori!"; break;
	case "noday": $new = "Anda harus memilih hari !"; break;
	case "nodescription": $new = "Anda harus melengkapi deskripsi kegiatan !"; break;
	case "nomonth": $new = "Anda harus memilih bulan !"; break;
	case "nonapproved": $new = "Kegiatan-kegiatan yang membutuhkan persetujuan : "; break;
	case "nononapproved": $new = "Saat ini tidak ada kegiatan yang membutuhkan persetujuan."; break;
	case "notitle": $new = "Anda harus melengkapi dengan judul!"; break;
	case "noyear": $new = "Anda harus memilih tahun !"; break;

	case "on": $new = "hidup"; break;
	case "Optional": $new = "Opsional"; break;
	case "or month": $new = "atau bulan"; break;
	case "or week": $new = "atau minggu"; break;

	case "password": $new = "password"; break;
	case "Please choose the category you only want to view events for": $new = "Silakan pilih kategori yg hanya untuk dilihat kegiatannya "; break;  
	case "Popup Month": $new = "Popup Bulan"; break ;
	case "Previous": $new = "Sebelumnya"; break;			
	case "Previous day": $new = "Hari sebelumnya"; break;
	case "Previous week": $new = "Minggu Sebelum"; break;

	case "Read more": $new = "Selengkapnya..."; break;
	case "reallydelcat": $new = "Yakinkah anda untuk menghapus kategori ini? Segala kegiatan yang berhubungan dengan kategori ini akan dimusnahkan!"; break;
	case "Repeat": $new = "Ulang"; break;
	case "results": $new = "hasil"; break;
	case "Role": $new = "Peran"; break;			// master translate?

	case "search": $new = "Cari"; break;
	case "Sort by": $new = "Urutkan berdasar"; break ;
	case "Sort by date": $new = "Urutan berdasar tanggal"; break ;
	case "Sort by events": $new = "Urutan berdasar kegiatan"; break ;
	case "Start Time": $new = "Waktu mulai"; break ;

	case "thankyou": $new = "Terima kasih atas ajuan kegiatan anda. Kegiatan akan ditampilkan setelah persetujuan"; break;
	case "thankyoupost": $new = "Terima kasih atas kegiatan yang anda isikan. Kegiatan sudah dikirim."; break;
	case "till": $new = "sampai"; break;
	case "Time added or updated": $new = "Waktu sudah ditambahkan atau perbarui"; break ;
	case "timeout msg": $new = "Perubahan time out sesi hanya berlaku pada login berikutnya" ; break ;
	case "times every": $new = "kali setiap"; break;	
	case "To": $new = "Sampai"; break ;
	case "To delete category": $new = "Untuk menghapus kategori"; break ;
	case "Today": $new = "Hari ini"; break;
	case "Total": $new = "Total"; break;
	case "Total number of events for the month": $new = "Jumlah kegiatan untuk bulan ini"; break ;
	case "Total number of events for user": $new = "Jumlah kegiatan untuk user "; break ;		
	case "Total unapproved events for the month": $new = "Total kegiatan yang tidak disetujui bulan ini" ; break;
	case "Two weeks": $new = "Dua minggu" ; break;	

	case "Update": $new = "Update"; break;
	case "Update Event": $new = "Update Kegiatan"; break;
	case "Updating category": $new = "Update kategori"; break ;
	case "Updating event": $new = "Update kegiatan"; break;
	case "Updating user": $new = "Update user"; break;			
	case "Unapproved events": $new = "Kegiatan-kegiatan yang tidak disetujui"; break ;
	case "User": $new = "User"; break ;
	case "User Calendar": $new = "Kalender User"; break ;
	case "User description": $new = "Deskripsi User"; break ;		
	case "User group": $new = "Grup user"; break ;				
	case "User Management": $new = "Manajemen User"; break;
	case "userdelok": $new = "Yakinkah anda akan menghapus user ini ?"; break;
	case "username": $new = "username"; break;
	case "Username and passwords must be alpha-numeric and without spaces.": $new = "Username dan password harus alpha-numerik tanpa spasi"; break; 	// version 0.4.20030731
	case "Username entered already exists. Please use another username.": $new = "Username yang diisikan sudah ada, silakan gunakan nama lain."; break;
	case "users": $new = "user"; break;

	case "View": $new = "Lihat"; break;
	case "View categories in year": $new = "Lihat kategori pada tahun"; break ;
	case "View details or edit": $new = "Lihat detail atau edit"; break ;
	case "View event": $new = "Lihat kegiatan"; break;
	case "View events of user": $new = "Lihat kegiatan dari user"; break;
	case "View events under this category in year": $new = "Lihat kegiatan dalam kategori ini pada tahun"; break ;
	case "View historical events before": $new = "Lihat kegiatan-kegiatan yang sudah lewat"; break ;
	case "View month": $new = "Lihat bulan"; break;
	case "View week": $new = "Lihat minggu"; break;

	case "Web Calendar Admin Login": $new = "Halaman Login Administrator"; break ;
	case "Web Calendar User Login": $new = "Halaman Login untuk User"; break ;
	case "week number": $new = "minggu ke"; break;
	case "Week starts": $new = "Minggu mulai"; break;
	case "wronglogin": $new = "Username atau password salah"; break;

	case "Year": $new = "Tahun"; break;
	case "Yes": $new = "Iya"; break;		// version 0.4.20030731
	case "Yes, delete event !": $new = "Iya, hapus kegiatan !"; break;
	case "Yes, delete it!": $new = "Iya, hapus saja!"; break;

	default: $new = "<b>".$msgin."</b> masih perlu diterjemahkan !";    break;
    }
    return $new;
}
?>