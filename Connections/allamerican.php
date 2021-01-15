<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_allamerican = "localhost";
$database_allamerican = "allameri_security";
$username_allamerican = "root";
$password_allamerican = "targus25";
$allamerican = mysql_pconnect($hostname_allamerican, $username_allamerican, $password_allamerican) or trigger_error(mysql_error(),E_USER_ERROR); 
?>