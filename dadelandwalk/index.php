<?php require_once('Connections/dplace.php'); ?>
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
  $MM_redirectLoginSuccess = "menu.php";
  $MM_redirectLoginFailed = "index.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_dplace, $dplace);
  
  $LoginRS__query=sprintf("SELECT username, password FROM tbl_users WHERE username=%s AND password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $dplace) or die(mysql_error());
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
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/templatebasic.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>All American Security Servies</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<link href="css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	background-image: url(images/bgnd.jpg);
	background-repeat: repeat-x;
}
-->
</style></head>

<body>
<br />
<table width="442" height="159" border="0" align="center">
  <tr>
    <td width="217" height="128" align="center"><img src="images/dplace_logo.JPG" width="183" height="111" /></td>
    <td width="217" align="center"><span class="titulo">Visitor control system <br />
All American Security Services</span></td>
  </tr>
</table>
<table width="673" border="0" align="center">
  <tr>
    <td width="362" align="center">&nbsp;</td>
  </tr>
</table>
<!-- InstanceBeginEditable name="central" -->
<table width="692" height="367" border="0" align="center">
  <tr>
    <td align="center" valign="top"><br />
      <br />
      <table width="438" border="1">
        <tr>
          <td width="377">If you are a tennant and you want to leave a message to the Front Desk/ Front gate, please click over the envelope icon</td>
          <td width="45"><a href="tennant_msg.php"><img src="images/msgs.jpg" width="45" height="49" border="0" /></a></td>
        </tr>
      </table>
      <br />
    <br />
<br />
<form id="form1" name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
      <table width="278" border="1">
        <tr>
          <td width="100" bgcolor="#333333" class="etiqueta">Username:</td>
          <td width="162" align="left"><label>
            <input type="text" name="textfield" id="textfield" />
          </label></td>
        </tr>
        <tr>
          <td bgcolor="#333333" class="etiqueta">Password:</td>
          <td align="left"><label>
            <input type="password" name="textfield2" id="textfield2" />
          </label></td>
        </tr>
        <tr>
          <td bgcolor="#333333" class="etiqueta">&nbsp;</td>
          <td><label>
            <input type="submit" name="button" id="button" value="Submit" />
          </label></td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
?>