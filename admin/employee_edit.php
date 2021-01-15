<?php require_once('../Connections/security.php'); ?>
<?php 
include('seg.php');
?>
<?php
$fecha_actual=date("Y-m-d");
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
$vartr=0;
$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	
	if(isset($_POST['chk_training']) && $_POST['chk_training'] == '1') { $vartr=1;} else { $vartr=0; }	
	
	//format ssn number
$ssn_number= str_replace("-","",$_POST['txt_ssn']);
$ssn_number = preg_replace('/^([\d]{3})([\d]{2})([\d]{4})/', '\1-\2-\3', $ssn_number);

	
  $updateSQL = sprintf("UPDATE tbl_users SET last_name=%s, middle_name=%s, first_name=%s, email=%s, ssn=%s, ssn2=%s, address=%s, city=%s, `state`=%s, zipcode=%s, cellphone=%s, homephone=%s, `position`=%s, pay_rate=%s, loc_id=%s, license_class=%s, license_status=%s, license_number=%s, license_training=%s, exp_license=%s, id_finger=%s, user_admin=%s, last_update=%s WHERE users_id=%s",
                       GetSQLValueString(strtoupper($_POST['txt_last']), "text"),
                       GetSQLValueString(strtoupper($_POST['txt_middle']), "text"),
                       GetSQLValueString(strtoupper($_POST['txt_first']), "text"),
                       GetSQLValueString($_POST['txt_email'], "text"),
					   GetSQLValueString(md5(substr($ssn_number,-4, 4)), "text"),
                       GetSQLValueString(enc($ssn_number), "text"),
                       GetSQLValueString($_POST['txt_address'], "text"),
                       GetSQLValueString($_POST['select_city'], "text"),
                       GetSQLValueString($_POST['select_state'], "text"),
                       GetSQLValueString($_POST['txt_zip'], "text"),
                       GetSQLValueString($_POST['txt_cellphone'], "text"),
                       GetSQLValueString($_POST['txt_homephone'], "text"),
                       GetSQLValueString($_POST['select_position'], "int"),
					   GetSQLValueString($_POST['rate'], "text"),
                       GetSQLValueString($_POST['select_location'], "int"),
                       GetSQLValueString($_POST['select_class'], "text"),
					   GetSQLValueString($_POST['select'], "text"),
                       GetSQLValueString($_POST['txt_license'], "text"),
					   GetSQLValueString($vartr, "int"),
                       GetSQLValueString($_POST['txt_expiration'], "text"),
					   GetSQLValueString($_POST['txt_finger'], "int"),
                       GetSQLValueString($_POST['hidden_user'], "int"),
					   GetSQLValueString(date("Y-m-d G:i:s"), "text"),
                       GetSQLValueString($_POST['hidden_id'], "int"));

  mysql_select_db($database_security, $security);
  $Result1 = mysql_query($updateSQL, $security) or die(mysql_error());
  //$updateGoTo = "employee_list.php";
   $updateGoTo = "";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
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
$query_position = "SELECT * FROM positions ORDER BY `position` ASC";
$position = mysql_query($query_position, $security) or die(mysql_error());
$row_position = mysql_fetch_assoc($position);
$totalRows_position = mysql_num_rows($position);

mysql_select_db($database_security, $security);
$query_location = "SELECT * FROM locations ORDER BY location ASC";
$location = mysql_query($query_location, $security) or die(mysql_error());
$row_location = mysql_fetch_assoc($location);
$totalRows_location = mysql_num_rows($location);

mysql_select_db($database_security, $security);
$query_cities = "SELECT * FROM tbl_cities ORDER BY city ASC";
$cities = mysql_query($query_cities, $security) or die(mysql_error());
$row_cities = mysql_fetch_assoc($cities);
$totalRows_cities = mysql_num_rows($cities);

$colname_per = "-1";
if (isset($_GET['id'])) {
  $colname_per = $_GET['id'];
}
mysql_select_db($database_security, $security);
$query_per = sprintf("SELECT * FROM tbl_users WHERE users_id = %s", GetSQLValueString($colname_per, "int"));
$per = mysql_query($query_per, $security) or die(mysql_error());
$row_per = mysql_fetch_assoc($per);
$totalRows_per = mysql_num_rows($per);

mysql_select_db($database_security, $security);
$query_lic_sta = "SELECT * FROM tbl_license_status ORDER BY label ASC";
$lic_sta = mysql_query($query_lic_sta, $security) or die(mysql_error());
$row_lic_sta = mysql_fetch_assoc($lic_sta);
$totalRows_lic_sta = mysql_num_rows($lic_sta);
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
<table width="900" border="0" align="center">
  <tr>
    <td height="59" align="center"><script type="text/javascript" src="admin_menu.js"></script></td>
  </tr>
  <tr>
    <td height="568" align="center" valign="top"><!-- InstanceBeginEditable name="Content" --> <style type="text/css">
        input:focus {
            background-color: #FF6;
        }
    </style>
<span class="Titles">Edit Employee</span><br />
      <br /><?php
    require "calendar/class.datepicker.php";
    $db=new datepicker();
    $db->firstDayOfWeek = 1;
    $db->dateFormat = "Y-m-d";
?>
      <form action="<?php echo $editFormAction; ?>" id="form1" name="form1" method="POST">
        <table width="900" border="1">
          <tr>
            <td width="85" align="left" class="cabecera">Last name:
            <input name="hidden_id" type="hidden" id="hidden_id" value="<?php echo $row_per['users_id']; ?>" /></td>
            <td width="201" align="left"><label>
              <input name="txt_last" type="text" class="caja_grande" id="txt_last" value="<?php echo $row_per['last_name']; ?>" size="20" maxlength="15" />
            </label></td>
            <td width="86" align="left" class="cabecera"><span class="cabecera">First name:</span></td>
            <td colspan="2" align="left"><input name="txt_first" type="text" class="caja_grande" id="txt_first" value="<?php echo $row_per['first_name']; ?>" size="20" maxlength="15" /></td>
            <td width="99" align="left" class="cabecera"><span class="cabecera">Middle:</span></td>
            <td colspan="2" align="left"><input name="txt_middle" type="text" class="caja_grande" id="txt_middle" value="<?php echo $row_per['middle_name']; ?>" size="10" maxlength="15" /></td>
          </tr>
          <tr>
            <td align="left" class="cabecera">E-mail:</td>
            <td colspan="4" align="left"><input name="txt_email" type="email" class="caja_grande_low" id="txt_email" value="<?php echo $row_per['email']; ?>" size="35" maxlength="40" placeholder="me@email.com" /></td>
            <td align="left" class="cabecera"><span class="cabecera">SSN#</span></td>
            <td colspan="2" align="left"><input name="txt_ssn" type="text" class="caja_grande" id="txt_ssn" value="<?php 
			if (strlen($row_per['ssn2'])>0) {
	   			echo substr(des($row_per['ssn2']),0,11);
	  			} else {echo $row_per['ssn'];}
			?>" maxlength="11" placeholder="xxx-xx-xxxx" /></td>
          </tr>
          <tr>
            <td align="left" class="cabecera">Address:</td>
            <td colspan="7" align="left"><input name="txt_address" type="text" class="caja_grande" id="txt_address" value="<?php echo $row_per['address']; ?>" size="50" maxlength="100" /> </td>
          </tr>
          <tr>
            <td align="left" class="cabecera">City:</td>
            <td align="left"><select name="select_city" class="caja_grande" id="select_city">
              <?php
do {  
?>
              <option value="<?php echo $row_cities['city_id']?>"<?php if (!(strcmp($row_cities['city_id'], $row_per['city']))) {echo "selected=\"selected\"";} ?>><?php echo $row_cities['city']?></option>
              <?php
} while ($row_cities = mysql_fetch_assoc($cities));
  $rows = mysql_num_rows($cities);
  if($rows > 0) {
      mysql_data_seek($cities, 0);
	  $row_cities = mysql_fetch_assoc($cities);
  }
?>
            </select></td>
            <td align="left" class="cabecera"><span class="cabecera">State:</span></td>
            <td colspan="2" align="left"><select name="select_state" class="caja_grande" id="select_state">
              <option value="FL">FLorida</option>
            </select></td>
            <td align="left" class="cabecera"><span class="cabecera">Zip code:</span></td>
            <td colspan="2" align="left"><input name="txt_zip" type="text" class="caja_grande" id="txt_zip" value="<?php echo $row_per['zipcode']; ?>" size="8" maxlength="5" /></td>
          </tr>
          <tr>
            <td align="left" class="cabecera">Cell Phone</td>
            <td colspan="4" align="left"><input name="txt_cellphone" type="tel" class="caja_grande" id="txt_cellphone" value="<?php echo $row_per['cellphone']; ?>" size="15" maxlength="10" placeholder="xxx-xxx-xxxx" /></td>
            <td align="left" class="cabecera"><span class="cabecera">Home Phone</span></td>
            <td colspan="2" align="left"><input name="txt_homephone" type="tel" class="caja_grande" id="txt_homephone" value="<?php echo $row_per['homephone']; ?>" size="15" maxlength="10" placeholder="xxx-xxx-xxxx" /></td>
          </tr>
          <tr>
            <td align="left" class="cabecera">Working place</td>
            <td colspan="2" align="left"><select name="select_location" class="caja_grande" id="select_location">
              <?php
do {  
?>
              <option value="<?php echo $row_location['loc_id']?>"<?php if (!(strcmp($row_location['loc_id'], $row_per['loc_id']))) {echo "selected=\"selected\"";} ?>><?php echo $row_location['location']?></option>
              <?php
} while ($row_location = mysql_fetch_assoc($location));
  $rows = mysql_num_rows($location);
  if($rows > 0) {
      mysql_data_seek($location, 0);
	  $row_location = mysql_fetch_assoc($location);
  }
?>
            </select></td>
            <td width="50" align="left">Pay rate:</td>
            <td width="115" align="left"><label>
              <input name="rate" type="text" class="caja_grande" id="rate" value="<?php echo $row_per['pay_rate']; ?>" size="6" maxlength="5" />
            </label></td>
            <td align="left" class="cabecera"><span class="cabecera">Position:</span></td>
            <td colspan="2" align="left"><select name="select_position" class="caja_grande" id="select_position">
              <?php
do {  
?>
              <option value="<?php echo $row_position['position_id']?>"<?php if (!(strcmp($row_position['position_id'], $row_per['position']))) {echo "selected=\"selected\"";} ?>><?php echo $row_position['position']?></option>
              <?php
} while ($row_position = mysql_fetch_assoc($position));
  $rows = mysql_num_rows($position);
  if($rows > 0) {
      mysql_data_seek($position, 0);
	  $row_position = mysql_fetch_assoc($position);
  }
?>
            </select></td>
          </tr>
          <tr>
            <td align="left" class="cabecera">License Class</td>
            <td align="left"><select name="select_class" class="caja_grande" id="select_class">
              <option value="D" <?php if (!(strcmp("D", $row_per['license_class']))) {echo "selected=\"selected\"";} ?>>D</option>
            </select>
            <input name="txt_license" type="text" class="caja_grande" id="txt_license" value="<?php echo $row_per['license_number']; ?>" size="12" maxlength="10" /></td>
            <td align="left" class="cabecera">Lic status:</td>
            <td colspan="2" align="left"><label for="select"></label>
              <select name="select" class="caja_grande" id="select">
                <?php
do {  
?>
                <option value="<?php echo $row_lic_sta['id']?>"<?php if (!(strcmp($row_lic_sta['id'], $row_per['license_status']))) {echo "selected=\"selected\"";} ?>><?php echo $row_lic_sta['label']?></option>
                <?php
} while ($row_lic_sta = mysql_fetch_assoc($lic_sta));
  $rows = mysql_num_rows($lic_sta);
  if($rows > 0) {
      mysql_data_seek($lic_sta, 0);
	  $row_lic_sta = mysql_fetch_assoc($lic_sta);
  }
?>
            </select></td>
            <td align="left" class="cabecera">:Expiration date:</td>
            <td colspan="2" align="left"><label>
              <input name="txt_expiration" type="text" class="caja_grande" id="txt_expiration" onclick="<?=$db->show("txt_expiration")?>" value="<?php echo $row_per['exp_license']; ?>" size="12" maxlength="10" />
            </label></td>
          </tr>
          <tr>
            <td align="left" class="cabecera">License Training</td>
            <td align="left" class="caja_grande_low"><label>
              <input name="chk_training" type="checkbox" id="chk_training" value="1" <?php if (!(strcmp($row_per['license_training'],1))) {echo "checked=\"checked\"";} ?> />
            Yes or excempt</label></td>
            <td align="left"><span class="cabecera">Date hired</span></td>
            <td colspan="2" align="left"><span class="caja_grande"><?php echo $row_per['date_hired']; ?></span></td>
            <td align="left">Fingerprint ID</td>
            <td width="110" align="left"><label>
              <input name="txt_finger" type="text" class="caja_grande" id="txt_finger" value="<?php echo $row_per['id_finger']; ?>" size="6" maxlength="6" />
            </label></td>
            <td width="102" align="left"><input type="hidden" name="hidden_user" id="hidden_user" value="<?php echo $row_user['users_id']; ?>" />
            <input type="submit" name="button" id="button" value="Submit" /></td>
          </tr>
        </table>
        <input type="hidden" name="MM_update" value="form1" />
      </form>
      <p><?php
	  echo $row_per['ssn2'] . "<br>";
	   echo $row_per['ssn'] . "<br>";
	  if (strlen($row_per['ssn2'])>0) {
	   echo des($row_per['ssn2']);
	  }
	  
	  
	  
	  
	  ?></p><script type="text/javascript" language="JavaScript">
 document.forms['form1'].elements['txt_last'].focus();
 </script>
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

mysql_free_result($position);

mysql_free_result($location);

mysql_free_result($cities);

mysql_free_result($per);

mysql_free_result($lic_sta);
?>
