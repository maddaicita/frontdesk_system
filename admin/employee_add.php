<?php require_once('../Connections/security.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

//format ssn number
$ssn_number= str_replace("-","",$_POST['txt_ssn']);
$ssn_number = preg_replace('/^([\d]{3})([\d]{2})([\d]{4})/', '\1-\2-\3', $ssn_number);

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	if(isset($_POST['chk_training']) && $_POST['chk_training'] == '1') { $vartr=1;} else { $vartr=0; }
  $insertSQL = sprintf("INSERT INTO tbl_users (id_finger, last_name, middle_name, first_name, email, ssn, address, city, `state`, zipcode, cellphone, homephone, `position`, loc_id, license_class, license_status, license_number, license_training, exp_license, date_hired, last_update, user_admin) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['txt_finger'], "int"),
					   GetSQLValueString(strtoupper($_POST['txt_last']), "text"),
                       GetSQLValueString(strtoupper($_POST['txt_middle']), "text"),
                       GetSQLValueString(strtoupper($_POST['txt_first']), "text"),
                       GetSQLValueString($_POST['txt_email'], "text"),
                       GetSQLValueString($ssn_number, "text"),
                       GetSQLValueString(strtoupper($_POST['txt_address']), "text"),
                       GetSQLValueString($_POST['select_city'], "text"),
                       GetSQLValueString($_POST['select_state'], "text"),
                       GetSQLValueString($_POST['txt_zip'], "text"),
                       GetSQLValueString($_POST['txt_cellphone'], "text"),
                       GetSQLValueString($_POST['txt_homephone'], "text"),
                       GetSQLValueString($_POST['select_position'], "int"),
                       GetSQLValueString($_POST['select_location'], "int"),
                       GetSQLValueString($_POST['select_class'], "text"),
					   GetSQLValueString($_POST['select_licsta'], "text"),
                       GetSQLValueString($_POST['txt_license'], "text"),
					   GetSQLValueString($vartr, "int"),
					   GetSQLValueString($_POST['txt_expiration'], "text"),
                       GetSQLValueString($_POST['txt_hired'], "text"),
					   GetSQLValueString(date("Y-m-d G:i:s"), "text"),
                       GetSQLValueString($_POST['hidden_user'], "int"));

  mysql_select_db($database_security, $security);
  $Result1 = mysql_query($insertSQL, $security) or die(mysql_error());

  $insertGoTo = "employee_list.php";
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

mysql_select_db($database_security, $security);
$query_licsta = "SELECT * FROM tbl_license_status ORDER BY label ASC";
$licsta = mysql_query($query_licsta, $security) or die(mysql_error());
$row_licsta = mysql_fetch_assoc($licsta);
$totalRows_licsta = mysql_num_rows($licsta);
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
    <td height="568" align="center" valign="top"><!-- InstanceBeginEditable name="Content" --> <style type="text/css">
        input:focus {
            background-color: #FF6;
        }
    </style>
<span class="Titles">Add Employee</span><br />
      <br /><?php
    require "calendar/class.datepicker.php";
    $db=new datepicker();
    $db->firstDayOfWeek = 1;
    $db->dateFormat = "Y-m-d";
?>
      <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
        <table width="789" border="1">
          <tr>
            <td width="69" align="left" class="cabecera">Last name:</td>
            <td width="180" align="left"><label>
              <input name="txt_last" type="text" class="caja_grande" id="txt_last" size="20" maxlength="15" />
            </label></td>
            <td width="58" align="left" class="cabecera"><span class="cabecera">First name:</span></td>
            <td width="133" align="left"><input name="txt_first" type="text" class="caja_grande" id="txt_first" size="20" maxlength="15" /></td>
            <td width="87" align="left" class="cabecera">Middle:</td>
            <td colspan="2" align="left"><input name="txt_middle" type="text" class="caja_grande" id="txt_middle" size="10" maxlength="15" /></td>
          </tr>
          <tr>
            <td align="left" class="cabecera">E-mail:</td>
            <td colspan="3" align="left"><input name="txt_email" type="email" placeholder="me@email.com" class="caja_grande_low" id="txt_email" size="35" maxlength="40" /></td>
            <td align="left" class="cabecera"><span class="cabecera">SSN#</span></td>
            <td colspan="2" align="left"><input name="txt_ssn" type="text" class="caja_grande" id="txt_ssn" maxlength="11" placeholder="xxx-xx-xxxx" /></td>
          </tr>
          <tr>
            <td align="left" class="cabecera">Address:</td>
            <td colspan="6" align="left"><input name="txt_address" type="text" class="caja_grande" id="txt_address" size="70" maxlength="100" /></td>
          </tr>
          <tr>
            <td align="left" class="cabecera">City:</td>
            <td align="left"><select name="select_city" class="caja_grande" id="select_city">
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
            </select></td>
            <td align="left" class="cabecera"><span class="cabecera">State:</span></td>
            <td align="left"><select name="select_state" class="caja_grande" id="select_state">
              <option value="FL">FLorida</option>
            </select></td>
            <td align="left" class="cabecera"><span class="cabecera">Zip code:</span></td>
            <td colspan="2" align="left"><input name="txt_zip" type="text" class="caja_grande" id="txt_zip" size="8" maxlength="5" /></td>
          </tr>
          <tr>
            <td align="left" class="cabecera">Cell Phone</td>
            <td colspan="3" align="left"><input name="txt_cellphone" type="tel" class="caja_grande" id="txt_cellphone" size="15" maxlength="10" placeholder="xxx-xxx-xxxx" /></td>
            <td align="left" class="cabecera"><span class="cabecera">Home Phone</span></td>
            <td colspan="2" align="left"><input name="txt_homephone" type="tel" class="caja_grande" id="txt_homephone" size="15" maxlength="10" placeholder="xxx-xxx-xxxx" /></td>
          </tr>
          <tr>
            <td align="left" class="cabecera">Working place</td>
            <td colspan="3" align="left"><select name="select_location" class="caja_grande" id="select_location">
              <?php
do {  
?>
              <option value="<?php echo $row_location['loc_id']?>"><?php echo $row_location['location']?></option>
              <?php
} while ($row_location = mysql_fetch_assoc($location));
  $rows = mysql_num_rows($location);
  if($rows > 0) {
      mysql_data_seek($location, 0);
	  $row_location = mysql_fetch_assoc($location);
  }
?>
            </select></td>
            <td align="left" class="cabecera"><span class="cabecera">Position:</span></td>
            <td colspan="2" align="left"><select name="select_position" class="caja_grande" id="select_position">
              <?php
do {  
?>
              <option value="<?php echo $row_position['position_id']?>"><?php echo $row_position['position']?></option>
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
              <option value="D">D</option>
            </select> 
            <input name="txt_license" type="text" class="caja_grande" id="txt_license" size="12" maxlength="10" /></td>
            <td align="left" class="cabecera">Lic Status</td>
            <td align="left"><label for="select_licsta"></label>
              <select name="select_licsta" class="caja_grande" id="select_licsta">
                <?php
do {  
?>
                <option value="<?php echo $row_licsta['id']?>"><?php echo $row_licsta['label']?></option>
                <?php
} while ($row_licsta = mysql_fetch_assoc($licsta));
  $rows = mysql_num_rows($licsta);
  if($rows > 0) {
      mysql_data_seek($licsta, 0);
	  $row_licsta = mysql_fetch_assoc($licsta);
  }
?>
            </select></td>
            <td align="left" class="cabecera">:Expiration date:</td>
            <td colspan="2" align="left"><label>
              <input name="txt_expiration" type="text" class="caja_grande" id="txt_expiration" size="12" maxlength="10" onclick="<?=$db->show("txt_expiration")?>" />
            </label></td>
          </tr>
          <tr>
            <td align="left" class="cabecera">License training</td>
            <td align="left"><label>
              <input name="chk_training" type="checkbox" id="chk_training" value="1" />
            Yes or excempt</label></td>
            <td align="left" class="cabecera">Date hired</td>
            <td align="left"><input name="txt_hired" value="<?php echo $fecha_actual; ?>" type="text" class="caja_grande" id="txt_hired" size="12" maxlength="10" onclick="<?=$db->show("txt_hired")?>" /></td>
            <td align="left">Fingerprint ID</td>
            <td width="103" align="left"><label>
              <input name="txt_finger" type="text" class="caja_grande" id="txt_finger" size="6" maxlength="6" />
            </label></td>
            <td width="113" align="left"><input type="hidden" name="hidden_user" id="hidden_user" value="<?php echo $row_user['users_id']; ?>" />
            <input type="submit" name="button" id="button" value="Submit" /></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1" />
      </form>
      <p>Please remember to file photocopies of the follow documents:<br />
        - Social Security ID card.<br />
        - Identification (Residence, Drivers License, City photo ID)<br />
        - D license
      (NON expired)<br />
      - W- 4 form<br />
      -Employment package.
      </p>
      <script type="text/javascript" language="JavaScript">
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

mysql_free_result($licsta);
?>
