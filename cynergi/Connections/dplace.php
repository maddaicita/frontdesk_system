<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_dplace = "localhost";
$database_dplace = "allameri_cynergi";
$username_dplace = "root";
$password_dplace = "targus25";
$dplace = mysql_pconnect($hostname_dplace, $username_dplace, $password_dplace) or trigger_error(mysql_error(),E_USER_ERROR); 
?>