<?php include('../Connections/security.php'); ?>
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

$MM_restrictGoTo = "index.php";
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO tbl_admins (first_name, middle_name, last_name, phone, email, address, city, `state`, username, password, user_admin) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['txt_first'], "text"),
                       GetSQLValueString($_POST['txt_middle'], "text"),
                       GetSQLValueString($_POST['txt_last'], "text"),
                       GetSQLValueString($_POST['txt_phone'], "text"),
                       GetSQLValueString($_POST['txt_email'], "text"),
                       GetSQLValueString($_POST['txt_address'], "text"),
                       GetSQLValueString($_POST['select_city'], "int"),
                       GetSQLValueString($_POST['select_state'], "text"),
                       GetSQLValueString($_POST['txt_username'], "text"),
                       GetSQLValueString($_POST['txt_pass1'], "text"),
                       GetSQLValueString($_POST['hidden_us'], "int"));

  mysql_select_db($database_security, $security);
  $Result1 = mysql_query($insertSQL, $security) or die(mysql_error());

  $insertGoTo = "admin_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_user = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_user = $_SESSION['MM_Username'];
}
mysql_select_db($database_security, $security);
$query_user = sprintf("SELECT users_id, last_name, first_name, user_admin FROM tbl_admins WHERE username = %s", GetSQLValueString($colname_user, "text"));
$user = mysql_query($query_user, $security) or die(mysql_error());
$row_user = mysql_fetch_assoc($user);
$totalRows_user = mysql_num_rows($user);

mysql_select_db($database_security, $security);
$query_cities = "SELECT * FROM tbl_cities ORDER BY city ASC";
$cities = mysql_query($query_cities, $security) or die(mysql_error());
$row_cities = mysql_fetch_assoc($cities);
$totalRows_cities = mysql_num_rows($cities);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/adminpages.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head><script type="text/javascript" src="stmenu.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Allamerican Security Services</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<link href="../css/styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="800" border="0" align="center">
  <tr>
    <td height="59" align="center"><script type="text/javascript" src="admin_menu.js"></script></td>
  </tr>
  <tr>
    <td height="568" align="center" valign="top"><!-- InstanceBeginEditable name="Content" -->
      <p class="Titles">Add administrator</p>
      <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
        <table width="400" border="1">
          <tr>
            <td width="122" class="cabecera">Last name:              </td>
            <td width="262" colspan="2"><label>
              <input name="txt_last" type="text" id="txt_last" />
            </label></td>
          </tr>
          <tr>
            <td class="cabecera">First name:</td>
            <td colspan="2"><label>
              <input name="txt_first" type="text" id="txt_first" />
            </label></td>
          </tr>
          <tr>
            <td class="cabecera">Middle name:</td>
            <td colspan="2"><label>
              <input name="txt_middle" type="text" id="txt_middle" />
            </label></td>
          </tr>
          <tr>
            <td class="cabecera">Phone number:</td>
            <td colspan="2"><label>
              <input name="txt_phone" type="text" id="txt_phone" />
            </label></td>
          </tr>
          <tr>
            <td class="cabecera">E-mail:</td>
            <td colspan="2"><label>
              <input name="txt_email" type="text" id="txt_email" size="40" maxlength="60" />
            </label></td>
          </tr>
          <tr>
            <td class="cabecera">Address:</td>
            <td colspan="2"><label>
              <input name="txt_address" type="text" id="txt_address" size="40" />
            </label></td>
          </tr>
          <tr>
            <td class="cabecera">City:</td>
            <td><label>
              <select name="select_city" id="select_city">
                <?php
do {  
?>
                <option value="<?php echo $row_cities['city_id']?>"><?php echo $row_cities['city']?></option>
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
            <td><label>
              <select name="select_state" id="select_state">
                <option value="FL">FL</option>
              </select>
            </label></td>
          </tr>
          <tr>
            <td class="cabecera">Username:</td>
            <td colspan="2"><label>
              <input name="txt_username" type="text" id="txt_username" size="30" />
            </label></td>
          </tr>
          <tr>
            <td class="cabecera">Password:</td>
            <td colspan="2"><label>
              <input name="txt_pass1" type="password" id="txt_pass1" size="30" />
            </label></td>
          </tr>
          <tr>
            <td class="cabecera"><input name="hidden_us" type="hidden" id="hidden_us" value="<?php echo $row_user['users_id']; ?>" /></td>
            <td colspan="2"><label>
              <input type="submit" name="button" id="button" value="Submit" />
            </label></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1" />
      </form>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
    <!-- InstanceEndEditable --></td>
  </tr>
</table>
<table width="300" border="0" align="right">
  <tr>
    <td align="right"><?php echo $row_user['first_name']; ?> <?php echo $row_user['last_name']; ?></td>
  </tr>
</table>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($user);

mysql_free_result($cities);
?>
