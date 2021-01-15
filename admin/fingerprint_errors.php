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
  $insertSQL = sprintf("INSERT INTO tbl_finger_fix (fix_time, reason_id, reason_text, sche_id, status_id, fix_date, fix_admin) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['select_hour'] . ":". $_POST['select_minute'], "text"),
                       GetSQLValueString($_POST['select_reason'], "int"),
                       GetSQLValueString($_POST['textarea'], "text"),
                       GetSQLValueString($_POST['hidden_sch'], "int"),
                       GetSQLValueString($_POST['hidden_status'], "int"),
                       GetSQLValueString($_POST['hidden_datefix'], "date"),
                       GetSQLValueString($_POST['hidden_admin'], "int"));

  mysql_select_db($database_security, $security);
  $Result1 = mysql_query($insertSQL, $security) or die(mysql_error());

  $insertGoTo = "record_ok.php";
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

$colname_id = "-1";
if (isset($_GET['id'])) {
  $colname_id = $_GET['id'];
}
mysql_select_db($database_security, $security);
$query_id = sprintf("SELECT users_id, id_finger, last_name, first_name FROM tbl_users WHERE users_id = %s", GetSQLValueString($colname_id, "int"));
$id = mysql_query($query_id, $security) or die(mysql_error());
$row_id = mysql_fetch_assoc($id);
$totalRows_id = mysql_num_rows($id);

$colname_fin = "-1";
if (isset($_GET['dat'])) {
  $colname_fin = $_GET['dat'];
}
mysql_select_db($database_security, $security);
$query_fin = sprintf("SELECT fin.id, loc.location, fin.id_emp, fin.date_finger, fin.date_import FROM tbl_fingerprint fin, locations loc, tbl_users us WHERE fin.id_emp = us.id_finger AND us.users_id =" . $_GET['id'] . " AND fin.id_loc = loc.loc_id AND SUBSTRING(fin.date_finger,1,10) = %s AND fin.status = 0 ORDER BY SUBSTRING(fin.date_finger,1,10) DESC", GetSQLValueString($colname_fin, "date"));
$fin = mysql_query($query_fin, $security) or die(mysql_error());
$row_fin = mysql_fetch_assoc($fin);
$totalRows_fin = mysql_num_rows($fin);

mysql_select_db($database_security, $security);
$query_sta_fix = "SELECT * FROM tbl_finger_fix_status ORDER BY sta_id ASC";
$sta_fix = mysql_query($query_sta_fix, $security) or die(mysql_error());
$row_sta_fix = mysql_fetch_assoc($sta_fix);
$totalRows_sta_fix = mysql_num_rows($sta_fix);

mysql_select_db($database_security, $security);
$query_sta_set = "SELECT * FROM tbl_settings WHERE id = 1";
$sta_set = mysql_query($query_sta_set, $security) or die(mysql_error());
$row_sta_set = mysql_fetch_assoc($sta_set);
$totalRows_sta_set = mysql_num_rows($sta_set);

mysql_select_db($database_security, $security);
$query_other = "SELECT fin.date_finger FROM tbl_fingerprint fin, tbl_users us WHERE fin.id_emp = us.id_finger AND fin.status = 0 AND us.users_id = " . $_GET['id'] . " AND SUBSTRING(fin.date_finger,1,10) > '" . $row_sta_set['date_start'] . "' AND SUBSTRING(fin.date_finger,1,10) < '" . $row_sta_set['date_end'] . "' ORDER BY fin.date_finger DESC";
$other = mysql_query($query_other, $security) or die(mysql_error());
$row_other = mysql_fetch_assoc($other);
$totalRows_other = mysql_num_rows($other);
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
      <p class="Titles">Schedule not matching records for <?php echo $row_id['first_name']; ?> <?php echo $row_id['last_name']; ?></p>
      <?php if ($totalRows_fin > 0) { // Show if recordset not empty ?>
  <table width="707" border="1">
    <tr class="cabecera">
      <td width="191">Fingerprint timestamp</td>
      <td width="201">Property</td>
      <td width="133">Date imported</td>
      <td width="154">Comments</td>
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_fin['date_finger']; ?></td>
        <td><?php echo $row_fin['location']; ?></td>
        <td><?php echo $row_fin['date_import']; ?></td>
        <td>&nbsp;</td>
      </tr>
      <?php } while ($row_fin = mysql_fetch_assoc($fin)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
<p><?php
		if ($_GET['tipo'] == "1") { 
			echo "Please fix the <b><font  color=\"red\">CHECK-IN</font></b> time. Select the reason and  if it's possible give a explanation.";
		} else {
			echo "Please fix the <b><font  color=\"red\">CHECK-OUT</font></b> time. Select the reason and if it's possible give a explanation.";
		}

?></p>
      <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
        <table width="400" border="1">
          <tr>
            <td width="91" class="cabecera">Time fix:</td>
            <td width="293"><label>
              <select name="select_hour" id="select_hour">
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
            <select name="select_minute" id="select_minute">
              <option value="00">00</option>
              <option value="30">30</option>
              <option value="59">59</option>
            </select>
            </label></td>
          </tr>
          <tr>
            <td class="cabecera">Reason:</td>
            <td><label>
              <select name="select_reason" id="select_reason">
                <?php
do {  
?>
                <option value="<?php echo $row_sta_fix['sta_id']?>"><?php echo $row_sta_fix['sta_label']?></option>
                <?php
} while ($row_sta_fix = mysql_fetch_assoc($sta_fix));
  $rows = mysql_num_rows($sta_fix);
  if($rows > 0) {
      mysql_data_seek($sta_fix, 0);
	  $row_sta_fix = mysql_fetch_assoc($sta_fix);
  }
?>
              </select>
            </label></td>
          </tr>
          <tr>
            <td class="cabecera">Notes:</td>
            <td><label>
              <textarea name="textarea" id="textarea" cols="45" rows="5"></textarea>
            </label></td>
          </tr>
          <tr>
            <td class="cabecera"><input name="hidden_sch" type="hidden" id="hidden_sch" value="<?php echo $_GET['sch']; ?>" />
            <input name="hidden_status" type="hidden" id="hidden_status" value="<?php echo $_GET['tipo']; ?>" />
            <input name="hidden_datefix" type="hidden" id="hidden_datefix" value="<?php echo date("Y-m-d G:i:s"); ?>" />
            <input name="hidden_admin" type="hidden" id="hidden_admin" value="<?php echo $row_user['users_id']; ?>" /></td>
            <td><label>
              <input type="submit" name="button" id="button" value="Submit" />
            </label></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1" />
      </form>
      <br />
      <?php if ($totalRows_other > 0) { // Show if recordset not empty ?>
  <table width="230" border="1">
    <tr class="cabecera">
      <td width="220" align="center">Date time at fingerprint</td>
    </tr>
    <?php do { ?>
      <tr>
        <td align="center"><?php echo $row_other['date_finger']; ?></td>
      </tr>
      <?php } while ($row_other = mysql_fetch_assoc($other)); ?>
  </table>
  <?php } // Show if recordset not empty ?>
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

mysql_free_result($id);

mysql_free_result($fin);

mysql_free_result($sta_fix);

mysql_free_result($other);
?>
