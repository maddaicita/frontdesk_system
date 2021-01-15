<?php require_once('Connections/security.php'); ?>
<?php
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  $_SESSION['MM_Username'] = NULL;
  $_SESSION['MM_UserGroup'] = NULL;
  $_SESSION['PrevUrl'] = NULL;
  unset($_SESSION['MM_Username']);
  unset($_SESSION['MM_UserGroup']);
  unset($_SESSION['PrevUrl']);
	
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($QUERY_STRING) && strlen($QUERY_STRING) > 0) 
  $MM_referrer .= "?" . $QUERY_STRING;
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<?php if (!function_exists("GetSQLValueString")) {
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tbl_users SET email=%s, address=%s, city=%s, `state`=%s, zipcode=%s, cellphone=%s, homephone=%s WHERE users_id=%s",
                       GetSQLValueString($_POST['txt_email'], "text"),
                       GetSQLValueString($_POST['txt_address'], "text"),
                       GetSQLValueString($_POST['select_city'], "text"),
                       GetSQLValueString($_POST['select_state'], "text"),
                       GetSQLValueString($_POST['txt_zipcode'], "text"),
                       GetSQLValueString(str_replace("\|-| \(\)", "", $_POST['txt_phone']), "text"),
                       GetSQLValueString($_POST['txt_homephone'], "text"),
                       GetSQLValueString($_POST['hidden_id'], "int"));

  mysql_select_db($database_security, $security);
  $Result1 = mysql_query($updateSQL, $security) or die(mysql_error());
}

$colname_usuario2 = "-1";
if (isset($_SESSION['id'])) {
  $colname_usuario2 = $_SESSION['id'];
}
mysql_select_db($database_security, $security);
$query_usuario2 = sprintf("SELECT * FROM tbl_users WHERE users_id = %s", GetSQLValueString($colname_usuario2, "int"));
$usuario2 = mysql_query($query_usuario2, $security) or die(mysql_error());
$row_usuario2 = mysql_fetch_assoc($usuario2);
$totalRows_usuario2 = mysql_num_rows($usuario2);

mysql_select_db($database_security, $security);
$query_cities = "SELECT * FROM tbl_cities ORDER BY city ASC";
$cities = mysql_query($query_cities, $security) or die(mysql_error());
$row_cities = mysql_fetch_assoc($cities);
$totalRows_cities = mysql_num_rows($cities);

$colname_usuario = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_usuario = $_SESSION['MM_Username'];
}
mysql_select_db($database_security, $security);
$query_usuario = sprintf("SELECT users_id, last_name, first_name, email, cellphone FROM tbl_users WHERE username = %s", GetSQLValueString($colname_usuario, "text"));
$usuario = mysql_query($query_usuario, $security) or die(mysql_error());
$row_usuario = mysql_fetch_assoc($usuario);
$totalRows_usuario = mysql_num_rows($usuario);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/employees.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>All American Security Services</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable --><script type="text/javascript" src="stmenu.js"></script>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<br />
<table width="600" border="0" align="center">
  <tr>
    <td align="center"><script type="text/javascript" src="employees.js"></script></td>
  </tr>
</table>
<table width="600" border="0" align="center">
  <tr>
    <td height="466" align="center" valign="top"><!-- InstanceBeginEditable name="content" -->
      <p><br />
        <span class="Titles">Profile of <?php echo $row_usuario2['first_name']; ?> <?php echo $row_usuario2['last_name']; ?></span></p>
      <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
        <table width="483" border="1">
          <tr>
            <td width="57" align="left" class="cabecera">Address:</td>
            <td colspan="5" align="left"><label>
              <input name="txt_address" type="text" id="txt_address" value="<?php echo $row_usuario2['address']; ?>" size="45" maxlength="100" />
            </label></td>
          </tr>
          <tr>
            <td align="left" class="cabecera">City:</td>
            <td width="126" align="left"><label>
              <select name="select_city" id="select_city">
                <?php
do {  
?>
                <option value="<?php echo $row_cities['city_id']?>"<?php if (!(strcmp($row_cities['city_id'], $row_usuario2['city']))) {echo "selected=\"selected\"";} ?>><?php echo $row_cities['city']?></option>
                <?php
} while ($row_cities = mysql_fetch_assoc($cities));
  $rows = mysql_num_rows($cities);
  if($rows > 0) {
      mysql_data_seek($cities, 0);
	  $row_cities = mysql_fetch_assoc($cities);
  }
?>
              </select>
            </label></td>
            <td width="38" align="left" class="cabecera">State:</td>
            <td width="51" align="left"><label>
              <select name="select_state" id="select_state">
                <option value="FL" <?php if (!(strcmp("FL", $row_usuario2['state']))) {echo "selected=\"selected\"";} ?>>FL</option>
              </select>
            </label></td>
            <td width="95" align="left" class="cabecera">Zipcode:</td>
            <td width="76" align="left"><label>
              <input name="txt_zipcode" type="text" id="txt_zipcode" value="<?php echo $row_usuario2['zipcode']; ?>" size="8" maxlength="5" />
            </label></td>
          </tr>
          <tr>
            <td align="left" class="cabecera">E-mail:</td>
            <td colspan="5" align="left"><label>
              <input name="txt_email" type="text" id="txt_email" value="<?php echo $row_usuario2['email']; ?>" size="40" maxlength="40" />
            </label></td>
          </tr>
          <tr>
            <td align="left" class="cabecera">Phone:</td>
            <td colspan="2" align="left"><label>
              <input name="txt_phone" type="text" id="txt_phone" value="<?php echo formatPhone($row_usuario2['cellphone']); ?>" />
            </label></td>
            <td colspan="2" align="left" class="cabecera">Home phone:</td>
            <td align="left"><label>
              <input name="txt_homephone" type="text" id="txt_homephone" value="<?php echo $row_usuario2['homephone']; ?>" />
            </label></td>
          </tr>
          <tr>
            <td align="left" class="cabecera">License#</td>
            <td colspan="3" align="left"><?php echo $row_usuario2['license_class']; ?><?php echo $row_usuario2['license_number']; ?></td>
            <td align="left" class="cabecera">Exp date:</td>
            <td align="left"><?php echo $row_usuario2['exp_license']; ?></td>
          </tr>
          <tr>
            <td align="left" class="cabecera"><input name="hidden_id" type="hidden" id="hidden_id" value="<?php echo $row_usuario2['users_id']; ?>" /></td>
            <td colspan="5" align="left"><label>
              <input type="submit" name="button" id="button" value="    Update   " />
            </label></td>
          </tr>
        </table>
        <br />
        <br />
        If you wish to update your license permit, please bring us a copy to process it, thanks.
        <input type="hidden" name="MM_update" value="form1" />
      </form>
      <p>&nbsp;</p>
    <!-- InstanceEndEditable --></td>
  </tr>
</table>
<br />
<table width="600" border="0" align="right">
  <tr>
    <td align="right"><p>You are logged as <strong><?php echo $row_usuario['first_name']; ?></strong> <strong><?php echo $row_usuario['last_name']; ?><br />
      <a href="<?php echo $logoutAction ?>">Log out</a></strong></p></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
/**
* Converts phone numbers to the formatting standard
*
* @param   String   $num   A unformatted phone number
* @return  String   Returns the formatted phone number
*/
function formatPhone($num)
{
$num = preg_replace('/[^0-9]/', '', $num);
 
$len = strlen($num);
if($len == 7)
$num = preg_replace('/([0-9]{3})([0-9]{4})/', '$1-$2', $num);
elseif($len == 10)
$num = preg_replace('/([0-9]{3})([0-9]{3})([0-9]{4})/', '($1) $2-$3', $num);
 
return $num;
}
 
// echo formatPhone('1 208 - 386 2934');
// will print: (208) 386-2934 </code>

function formatSSN($ssn)
    {
        if (eregi("^(\d{3})\-?(\d{2})\-?(\d{4})$", $ssn))
        { 
            return eregi_replace("^(\d{3})\-?(\d{2})\-?(\d{4})$", "$1-$2-$3", $ssn);
			}
       else
       {    
           return eregi_replace("^(\d{3})\-?(\d{2})\-?(\d{4})$", "$1-$2-$3", $ssn);
        }
   }

mysql_free_result($usuario);
mysql_free_result($usuario2);
mysql_free_result($cities);
?>
