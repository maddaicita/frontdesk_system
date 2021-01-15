<?php require_once('Connections/security.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['textfield'])) {
  $loginUsername=$_POST['textfield'];
  $password=md5($_POST['textfield2']);
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "emp_home.php";
  $MM_redirectLoginFailed = "emp_login.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_security, $security);
  
  $LoginRS__query=sprintf("SELECT cellphone, ssn FROM tbl_users WHERE cellphone=%s AND ssn=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
  $LoginRS = mysql_query($LoginRS__query, $security) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="600" height="628" border="0" align="center">
  <tr>
    <td height="279" align="center"><img src="admin/logo.jpg" width="202" height="250" /></td>
  </tr>
  <tr>
    <td height="343"><form id="form1" name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
      <table width="400" border="1" align="center">
        <tr>
          <td width="159" class="cabecera">Phone number:</td>
          <td width="225"><label>
            <input name="textfield" type="text" id="textfield" size="15" maxlength="10" />
          </label></td>
        </tr>
        <tr>
          <td class="cabecera">Last four digits SSN#</td>
          <td><label>
            <input name="textfield2" type="password" id="textfield2" size="10" maxlength="4" />
          </label></td>
        </tr>
        <tr>
          <td class="cabecera">&nbsp;</td>
          <td><label>
            <input type="submit" name="button" id="button" value="Submit" />
          </label></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
</body>
</html>