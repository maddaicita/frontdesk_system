<?php require_once('../Connections/dplace.php'); ?>
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
	
  //$logoutGoTo = "emp_login.php";
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

$colname_usuario = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_usuario = $_SESSION['MM_Username'];
}
mysql_select_db($database_dplace, $dplace);
$query_usuario = sprintf("SELECT * FROM tbl_users WHERE username = %s", GetSQLValueString($colname_usuario, "text"));
$usuario = mysql_query($query_usuario, $dplace) or die(mysql_error());
$row_usuario = mysql_fetch_assoc($usuario);
$totalRows_usuario = mysql_num_rows($usuario);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/templatephp.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>All American Security Services</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable --><script type="text/javascript" src="stmenu.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<br />
<table width="600" border="0" align="center">
  <tr>
    <td align="center"><script type="text/javascript" src="menu.js"></script></td>
  </tr>
</table>
<table width="600" border="0" align="center">
  <tr>
    <td height="466" align="center" valign="top"><!-- InstanceBeginEditable name="content" --><br />
      <table width="400" border="0">
        <tr>
          <td align="center" class="titulo">Security  Incident report</td>
        </tr>
      </table>
      <br />
      <br />
      <form action="ema_send.php" method="POST" enctype="multipart/form-data" name="form1" target="_self" id="form1">
        <table width="547" border="1">
          <tr>
            <td class="etiqueta">Incident Number:</td>
            <td><label>
              <input name="txt_incident_number" type="text" id="txt_incident_number" maxlength="20" />
            * Police case #, etc</label></td>
          </tr>
          <tr>
            <td width="170" class="etiqueta">Type:</td>
            <td width="343"><label>
              <select name="select_incident" id="select_incident">
                <option value="Unselected" selected="selected">Please select</option>
                <option value="Burglary">Burglary</option>
                <option value="Car accident">Car accident</option>
                <option value="Car broken">Car broken</option>
                <option value="Camera system">Camera system</option>
                <option value="Property vandalism">Property vandalism</option>
                <option value="Fire">Fire</option>
                <option value="Slip and fail">Slip and fail</option>
                <option value="Other">Other</option>
              </select>
            </label></td>
          </tr>
          <tr>
            <td class="etiqueta">Location:</td>
            <td><label>
              <select name="select_loc" id="select_loc">
                <option value="Lobby">Lobby</option>
                <option value="Parking building">Parking building</option>
                <option value="Pool">Pool</option>
                <option value="Other">Other</option>
              </select>
            </label></td>
          </tr>
          <tr>
            <td class="etiqueta">Incident start:</td>
            <td><label>
              <input name="txt_date_in" type="text" id="txt_date_in" size="10" maxlength="10" value="<?php echo date("Y-m-d"); ?>" />
              <select name="select_hour_in" id="select_hour_in">
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
                <option value="12" selected="selected">12</option>
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
            <input name="txt_min_in" type="text" id="txt_min_in" value="00" size="5" maxlength="2" />
            YYYY/mm/dd</label></td>
          </tr>
          <tr>
            <td class="etiqueta"><blockquote>
              <p>End:</p>
            </blockquote></td>
            <td><input name="txt_date_out" type="text" id="txt_date_out" value="<?php echo date("Y-m-d"); ?>" size="10" maxlength="10" />
              <select name="select_hour_out" id="select_hour_out">
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
                <option value="12" selected="selected">12</option>
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
<input name="txt_min_out" type="text" id="textfield4" value="00" size="5" maxlength="2" />
YYYY/mm/dd</td>
          </tr>
          <tr>
            <td class="etiqueta">Complainant's </td>
            <td><label>
              <select name="select_complainant" id="select_complainant">
<option value="noselected" selected="selected">Please select</option>
<option value="Subject">Subject</option>
<option value="Guest">Guest</option>
<option value="Visitor">Visitor</option>
<option value="Employee">Employee</option>
              </select>
            </label></td>
          </tr>
          <tr>
            <td class="etiqueta"><blockquote>
              <p>Last name:</p>
            </blockquote></td>
            <td><label>
              <input name="txt_last" type="text" id="txt_last" size="45" maxlength="40" />
            </label></td>
          </tr>
          <tr>
            <td class="etiqueta"><blockquote>
              <p>First name:</p>
            </blockquote></td>
            <td><input name="txt_first" type="text" id="textfield6" size="45" maxlength="40" /></td>
          </tr>
          <tr>
            <td class="etiqueta"><blockquote>
              <p>Address:</p>
            </blockquote></td>
            <td><input name="txt_address" type="text" id="textfield7" size="45" maxlength="40" /></td>
          </tr>
          <tr>
            <td class="etiqueta"><blockquote>
              <p>City:</p>
            </blockquote></td>
            <td><input name="txt_city" type="text" id="textfield8" size="35" maxlength="40" /></td>
          </tr>
          <tr>
            <td class="etiqueta"><blockquote>
              <p>State:</p>
            </blockquote></td>
            <td><input name="txt_state" type="text" id="textfield9" size="35" maxlength="40" /></td>
          </tr>
          <tr>
            <td class="etiqueta"><blockquote>
              <p>Zip:</p>
            </blockquote></td>
            <td><input name="txt_zip" type="text" id="textfield10" size="30" maxlength="40" /></td>
          </tr>
          <tr>
            <td class="etiqueta"><blockquote>
              <p>Phone:</p>
            </blockquote></td>
            <td><input name="txt_phone" type="text" id="textfield11" size="20" maxlength="12" /></td>
          </tr>
          <tr>
            <td class="etiqueta"><blockquote>
              <p>Sec. Phone:</p>
            </blockquote></td>
            <td><input name="txt_phone2" type="text" id="textfield12" size="20" maxlength="12" /></td>
          </tr>
          <tr>
            <td class="etiqueta"><blockquote>
              <p>Dep./Company:</p>
            </blockquote></td>
            <td><input name="txt_dep_company" type="text" id="textfield13" size="30" maxlength="40" /></td>
          </tr>
          <tr>
            <td class="etiqueta">Complainant's </td>
            <td><label>
              <select name="select_complainant2" id="select_complainant4">
<option value="noselected" selected="selected">Please select</option>
<option value="Subject">Subject</option>
<option value="Guest">Guest</option>
<option value="Visitor">Visitor</option>
<option value="Employee">Employee</option>
              </select>
            </label></td>
          </tr>
          <tr>
            <td class="etiqueta"><blockquote>
              <p>Last name:</p>
            </blockquote></td>
            <td><label>
              <input name="txt_last_2" type="text" id="txt_last_2" size="45" maxlength="40" />
            </label></td>
          </tr>
          <tr>
            <td class="etiqueta"><blockquote>
              <p>First name:</p>
            </blockquote></td>
            <td><input name="txt_first_2" type="text" id="textfield30" size="45" maxlength="40" /></td>
          </tr>
          <tr>
            <td class="etiqueta"><blockquote>
              <p>Address:</p>
            </blockquote></td>
            <td><input name="txt_address_2" type="text" id="textfield29" size="45" maxlength="40" /></td>
          </tr>
          <tr>
            <td class="etiqueta"><blockquote>
              <p>City:</p>
            </blockquote></td>
            <td><input name="txt_city_2" type="text" id="textfield28" size="35" maxlength="40" /></td>
          </tr>
          <tr>
            <td class="etiqueta"><blockquote>
              <p>State:</p>
            </blockquote></td>
            <td><input name="txt_state_2" type="text" id="textfield27" size="35" maxlength="40" /></td>
          </tr>
          <tr>
            <td class="etiqueta"><blockquote>
              <p>Zip:</p>
            </blockquote></td>
            <td><input name="txt_zip_2" type="text" id="textfield26" size="30" maxlength="40" /></td>
          </tr>
          <tr>
            <td class="etiqueta"><blockquote>
              <p>Phone:</p>
            </blockquote></td>
            <td><input name="txt_phone_2" type="text" id="textfield25" size="20" maxlength="12" /></td>
          </tr>
          <tr>
            <td class="etiqueta"><blockquote>
              <p>Sec. Phone:</p>
            </blockquote></td>
            <td><input name="txt_phone2_2" type="text" id="textfield24" size="20" maxlength="12" /></td>
          </tr>
          <tr>
            <td class="etiqueta"><blockquote>
              <p>Dep./Company:</p>
            </blockquote></td>
            <td><input name="txt_dep_company_2" type="text" id="textfield23" size="30" maxlength="40" /></td>
          </tr>
          <tr class="etiqueta">
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr class="etiqueta">
            <td colspan="2" class="cabecera">Description of the Incident:</td>
          </tr>
          <tr class="etiqueta">
            <td colspan="2"><label>
              <textarea name="txt_description" id="txt_description" cols="80" rows="10"></textarea>
            </label></td>
          </tr>
          <tr>
            <td class="etiqueta">Police incident No.</td>
            <td><input name="txt_police_incident_no" type="text" id="txt_police_incident_no" size="30" maxlength="40" /></td>
          </tr>
          <tr>
            <td class="etiqueta">Police Officer Name:</td>
            <td><input name="txt_police_name" type="text" id="txt_police_name" size="30" maxlength="40" /></td>
          </tr>
          <tr>
            <td class="etiqueta">Police I.D.:</td>
            <td><input name="txt_police_id" type="text" id="txt_police_id" size="30" maxlength="40" /></td>
          </tr>
          <tr>
            <td class="etiqueta">Rescue Called:</td>
            <td><label>
              <select name="select_rescue" id="select_rescue">
                <option value="Yes">Yes</option>
                <option value="No" selected="selected">No</option>
              </select>
            </label></td>
          </tr>
          <tr>
            <td class="etiqueta">Lt. In Charge Name:</td>
            <td><input name="txt_lt_name" type="text" id="textfield5" size="30" maxlength="40" /></td>
          </tr>
          <tr>
            <td class="etiqueta">Alarm No.</td>
            <td><input name="txt_alarm_no" type="text" id="textfield14" size="30" maxlength="40" /></td>
          </tr>
          <tr>
            <td class="etiqueta">Completed by:</td>
            <td><input name="txt_completed" type="text" id="textfield15" size="45" maxlength="40" /></td>
          </tr>
          <tr>
            <td class="etiqueta"><input type="hidden" name="hidden_user" id="hidden_user" value="<?php echo $row_usuario['id_user']; ?>" /></td>
            <td><label>
              <input name="button" type="submit" class="caja_grande" id="button" value="     Submit     " />
            </label></td>
          </tr>
        </table>
        <table width="400" border="0">
          <tr>
            <td><p>&nbsp;</p></td>
          </tr>
        </table>
      </form>
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
mysql_free_result($usuario);
?>
