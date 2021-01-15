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
  $insertSQL = sprintf("INSERT INTO tbl_pending_task (task_datetime, loc_id, comments, admin_id, users_id, datetime_set) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['txt_date'], "date"),
                       GetSQLValueString($_POST['select_location'], "int"),
                       GetSQLValueString($_POST['txt_comments'], "text"),
                       GetSQLValueString($_POST['hidden_admin'], "int"),
                       GetSQLValueString($_POST['hidden_user'], "text"),
                       GetSQLValueString($_POST['hidden_set'] . " " . $_POST['select_hour'] . ":" . $_POST['select_min'] . ":00", "date"));

  mysql_select_db($database_security, $security);
  $Result1 = mysql_query($insertSQL, $security) or die(mysql_error());

  $insertGoTo = "menu.php";
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
$query_user = sprintf("SELECT users_id, last_name, first_name, user_admin FROM tbl_users WHERE username = %s", GetSQLValueString($colname_user, "text"));
$user = mysql_query($query_user, $security) or die(mysql_error());
$row_user = mysql_fetch_assoc($user);
$totalRows_user = mysql_num_rows($user);

mysql_select_db($database_security, $security);
$query_loc = "SELECT * FROM locations ORDER BY location ASC";
$loc = mysql_query($query_loc, $security) or die(mysql_error());
$row_loc = mysql_fetch_assoc($loc);
$totalRows_loc = mysql_num_rows($loc);

$colname_emp = "-1";
if (isset($_GET['id'])) {
  $colname_emp = $_GET['id'];
}
mysql_select_db($database_security, $security);
$query_emp = sprintf("SELECT users_id, last_name, middle_name, first_name, cellphone FROM tbl_users WHERE users_id = %s", GetSQLValueString($colname_emp, "int"));
$emp = mysql_query($query_emp, $security) or die(mysql_error());
$row_emp = mysql_fetch_assoc($emp);
$totalRows_emp = mysql_num_rows($emp);
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
<link href="css/styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="800" border="0" align="center">
  <tr>
    <td height="59" align="center"><script type="text/javascript" src="admin_menu.js"></script></td>
  </tr>
  <tr>
    <td height="568" align="center" valign="top"><!-- InstanceBeginEditable name="Content" -->
      <p class="Titles">Task scheduler</p><?php
    require "calendar/class.datepicker.php";
    $db=new datepicker();
    $db->firstDayOfWeek = 1;
    $db->dateFormat = "Y-m-d";
?><form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
        <table width="440" border="1">
          <tr>
            <td width="97" class="cabecera">Employee:
            <input name="hidden_user" type="hidden" id="hidden_user" value="<?php echo $row_emp['users_id']; ?>" /></td>
            <td width="327"><label for="txt"><?php echo $row_emp['first_name']; ?> <?php echo $row_emp['last_name']; ?></label></td>
          </tr>
          <tr>
            <td class="cabecera">Date/Time:</td>
            <td class="caja_grande">
              <input name="txt_date" type="text" class="caja_grande" id="txt_date" size="15" maxlength="10" onclick="<?=$db->show("txt_date")?>" /> 
            : 
            <select name="select_hour" class="caja_grande" id="select_hour">
              <option value="00">00</option>
              <option value="01">01</option>
              <option value="02">02</option>
              <option value="03">03</option>
              <option value="04">04</option>
              <option value="05">05</option>
              <option value="06">06</option>
              <option value="07">07</option>
              <option value="08">08</option>
              <option value="09">09</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="14">14</option>
              <option value="15">15</option>
              <option value="16">16</option>
              <option value="17">17</option>
              <option value="18">18</option>
              <option value="19">19</option>
              <option value="20">20</option>
              <option value="21">21</option>
              <option value="22">22</option>
              <option value="23">23</option>
            </select> 
            : 
            <select name="select_min" class="caja_grande" id="select_min">
              <option value="00">00</option>
              <option value="15">15</option>
              <option value="30">30</option>
              <option value="45">45</option>
            </select>
            </td>
          </tr>
          <tr>
            <td class="cabecera">Location:</td>
            <td><label for="select_location"></label>
              <select name="select_location" class="caja_grande" id="select_location">
                <?php
do {  
?>
                <option value="<?php echo $row_loc['loc_id']?>"<?php if (!(strcmp($row_loc['loc_id'], 4))) {echo "selected=\"selected\"";} ?>><?php echo $row_loc['location']?></option>
                <?php
} while ($row_loc = mysql_fetch_assoc($loc));
  $rows = mysql_num_rows($loc);
  if($rows > 0) {
      mysql_data_seek($loc, 0);
	  $row_loc = mysql_fetch_assoc($loc);
  }
?>
            </select></td>
          </tr>
          <tr>
            <td class="cabecera">Comments:</td>
            <td><label for="txt_comments"></label>
            <textarea name="txt_comments" id="txt_comments" cols="45" rows="5"></textarea></td>
          </tr>
          <tr>
            <td class="cabecera"><input name="hidden_admin" type="hidden" id="hidden_admin" value="<?php echo $row_user['users_id']; ?>" />
            <input name="hidden_set" type="hidden" id="hidden_set" value="<?php echo date("Y-m-d H:i:s"); ?>" /></td>
            <td><input type="submit" name="button" id="button" value="Submit" /></td>
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

mysql_free_result($loc);

mysql_free_result($emp);
?>
