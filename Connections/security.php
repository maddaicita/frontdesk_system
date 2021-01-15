<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_security = "localhost";
$database_security = "allameri_cynergi";
$username_security = "root";
$password_security = "targus25";
$security = mysql_pconnect($hostname_security, $username_security, $password_security) or trigger_error(mysql_error(),E_USER_ERROR); 
?>