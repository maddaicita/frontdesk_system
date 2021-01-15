<?php require_once('../Connections/security.php'); ?>
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

$MM_restrictGoTo = "../mobile/login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
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
  $insertSQL = sprintf("INSERT INTO tbl_incident_report (report_date_set, report_date, report_date2, type_id, loc_id, location_ext, unit, con_id, users_id) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString(date('Y-m-d H:i:s'), "text"),
                       GetSQLValueString($_POST['txt_date'] . " " . $_POST['select_hour'] . ":" . $_POST['txt_minute'] . ":00", "text"),
                       GetSQLValueString($_POST['txt_date2'] . " " . $_POST['select_hour2'] . ":" . $_POST['txt_minute2'] . ":00", "text"),
                       GetSQLValueString($_POST['select_incident_type'], "int"),
                       GetSQLValueString($_POST['select_property'], "int"),
                       GetSQLValueString($_POST['txt_location'], "text"),
                       GetSQLValueString($_POST['txt_unit'], "text"),
                       GetSQLValueString($_POST['select'], "int"),
                       GetSQLValueString($_POST['hidden_user'], "int"));

  mysql_select_db($database_security, $security);
  $Result1 = mysql_query($insertSQL, $security) or die(mysql_error());

  $insertGoTo = "incident_report_2.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_usario = "-1";
if (isset($_COOKIE['username'])) {
  $colname_usario = $_COOKIE['username'];
}
mysql_select_db($database_security, $security);
$query_usario = sprintf("SELECT users_id, last_name, first_name FROM tbl_users WHERE username = %s", GetSQLValueString($colname_usario, "text"));
$usario = mysql_query($query_usario, $security) or die(mysql_error());
$row_usario = mysql_fetch_assoc($usario);
$totalRows_usario = mysql_num_rows($usario);

mysql_select_db($database_security, $security);
$query_proper = "SELECT * FROM locations ORDER BY location ASC";
$proper = mysql_query($query_proper, $security) or die(mysql_error());
$row_proper = mysql_fetch_assoc($proper);
$totalRows_proper = mysql_num_rows($proper);

mysql_select_db($database_security, $security);
$query_incident = "SELECT * FROM tbl_incident_type ORDER BY incident_text ASC";
$incident = mysql_query($query_incident, $security) or die(mysql_error());
$row_incident = mysql_fetch_assoc($incident);
$totalRows_incident = mysql_num_rows($incident);

mysql_select_db($database_security, $security);
$query_conditions = "SELECT * FROM tbl_conditions ORDER BY con_label ASC";
$conditions = mysql_query($query_conditions, $security) or die(mysql_error());
$row_conditions = mysql_fetch_assoc($conditions);
$totalRows_conditions = mysql_num_rows($conditions);
?>
<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class=""><!-- InstanceBegin template="/Templates/mobile.dwt.php" codeOutsideHTMLIsLocked="false" -->
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- InstanceBeginEditable name="doctitle" -->
<title>All American Security Services</title>
<!-- InstanceEndEditable -->
<link href="boilerplate.css" rel="stylesheet" type="text/css">
<link href="../mobile.css" rel="stylesheet" type="text/css">
<!-- 
To learn more about the conditional comments around the html tags at the top of the file:
paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/

Do the following if you're using your customized build of modernizr (http://www.modernizr.com/):
* insert the link to your js here
* remove the link below to the html5shiv
* add the "no-js" class to the html tags at the top
* you can also remove the link to respond.min.js if you included the MQ Polyfill in your modernizr build 
-->
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="respond.min.js"></script>
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
</head>
<body>
<div class="gridContainer clearfix"><br>
  <table width="238" border="0" align="center">
    <tr>
      <td width="232" align="center">You are logged as <?php echo $row_usario['first_name'] . " " . $row_usario['last_name']; ?></td>
    </tr>
  </table>
  <div id="LayoutDiv1">
    <table width="324" border="0" align="center">
      <tr>
        <td></td>
      </tr>
    </table>
    <!-- InstanceBeginEditable name="EditRegion1" -->
    <table width="237" border="0" align="center">
      <tr>
        <td width="231" align="center">Security incident report</td>
      </tr>
    </table>
    <br>
    <form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1">
      <table width="325" border="1" align="center">
        <tr>
          <td width="78">Incident type:</td>
          <td width="231"><label for="select_incident_type"></label>
            <select name="select_incident_type" id="select_incident_type">
              <?php
do {  
?>
              <option value="<?php echo $row_incident['incident_id']?>"><?php echo $row_incident['incident_text']?></option>
              <?php
} while ($row_incident = mysql_fetch_assoc($incident));
  $rows = mysql_num_rows($incident);
  if($rows > 0) {
      mysql_data_seek($incident, 0);
	  $row_incident = mysql_fetch_assoc($incident);
  }
?>
          </select></td>
        </tr>
        <tr>
          <td>Property:</td>
          <td><label for="select_property"></label>
            <select name="select_property" id="select_property">
              <?php
do {  
?>
              <option value="<?php echo $row_proper['loc_id']?>"><?php echo $row_proper['location']?></option>
              <?php
} while ($row_proper = mysql_fetch_assoc($proper));
  $rows = mysql_num_rows($proper);
  if($rows > 0) {
      mysql_data_seek($proper, 0);
	  $row_proper = mysql_fetch_assoc($proper);
  }
?>
          </select>            <label for="txt_location"></label></td>
        </tr>
        <tr>
          <td>Full address:</td>
          <td><input name="txt_location" type="text" id="txt_location" size="35"></td>
        </tr>
        <tr>
          <td>Room/Unit:</td>
          <td><label for="txt_unit"></label>
          <input name="txt_unit" type="text" id="txt_unit" size="10"></td>
        </tr>
        <tr>
          <td>Date and time incident</td>
          <td><label for="txt_date"></label>
          <input name="txt_date" type="text" id="txt_date" value="<?php echo date("m/d/Y"); ?>" size="12" maxlength="10"> <label for="txt_hour"></label>
          <label for="select_hour"></label>
          <select name="select_hour" id="select_hour">
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
          <label for="txt_minute"></label>
          <input name="txt_minute" type="text" id="txt_minute" value="00" size="4" maxlength="2"></td>
        </tr>
        <tr>
          <td>Up to:</td>
          <td><input name="txt_date2" type="text" id="txt_date2" value="<?php echo date("m/d/Y"); ?>" size="12" maxlength="10">
            <label for="txt_hour"></label>
            <label for="select_hour"></label>
            <select name="select_hour2" id="select_hour">
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
<label for="txt_minute"></label>
<input name="txt_minute2" type="text" id="txt_minute" value="00" size="4" maxlength="2"></td>
        </tr>
        <tr>
          <td>Ambient conditions:</td>
          <td valign="middle"><label for="select"></label>
            <select name="select" id="select">
              <?php
do {  
?>
              <option value="<?php echo $row_conditions['con_id']?>"><?php echo $row_conditions['con_label']?></option>
              <?php
} while ($row_conditions = mysql_fetch_assoc($conditions));
  $rows = mysql_num_rows($conditions);
  if($rows > 0) {
      mysql_data_seek($conditions, 0);
	  $row_conditions = mysql_fetch_assoc($conditions);
  }
?>
          </select></td>
        </tr>
        <tr>
          <td><input name="hidden_user" type="hidden" id="hidden_user" value="<?php echo $row_usario['users_id']; ?>"></td>
          <td><input type="submit" name="button" id="button" value="Submit"></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form1">
    </form>
    <!-- InstanceEndEditable -->
    <p>&nbsp;</p>
    <p></p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </div>
</div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($usario);

mysql_free_result($proper);

mysql_free_result($incident);

mysql_free_result($conditions);
?>
