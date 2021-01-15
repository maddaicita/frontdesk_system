<?php require_once('../Connections/dplace.php'); ?>
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

$MM_restrictGoTo = "../index.php";
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

$colname_incident = "-1";
if (isset($_GET['id'])) {
  $colname_incident = $_GET['id'];
}
mysql_select_db($database_dplace, $dplace);
$query_incident = sprintf("SELECT * FROM tbl_incident WHERE incident_id = %s", GetSQLValueString($colname_incident, "int"));
$incident = mysql_query($query_incident, $dplace) or die(mysql_error());
$row_incident = mysql_fetch_assoc($incident);
$totalRows_incident = mysql_num_rows($incident);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/employees.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>All American Security Services</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<style type="text/css">
<!--
body {
	background-image: url(../images/bgnd2.jpg);
	background-repeat: repeat-x;
}
-->
</style><script type="text/javascript" src="../Templates/stmenu.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="627" height="132" border="0" align="center">
  <tr>
    <td width="232" height="128" align="center"><img src="../images/dplace_logo.JPG" alt="" width="175" height="87" /></td>
    <td width="385" align="center"><span class="titulo">Visitor control system <br />
      All American Security Services</span></td>
  </tr>
</table>
<table width="673" border="0" align="center">
  <tr>
    <td width="362" align="center"><span> &nbsp;
      <script type="text/javascript" src="../Templates/menu.js"></script>
    </span></td>
  </tr>
</table>
<!-- InstanceBeginEditable name="central" -->
<table width="816" height="367" border="0" align="center">
  <tr>
    <td align="center" valign="top"><table width="400" border="0">
      <tr>
        <td align="center" class="titulo">Incident details</td>
      </tr>
    </table>
      <br />
      <table width="580" border="1" cellpadding="3" cellspacing="3">
        <tr>
          <td class="etiqueta">Incident Number:</td>
          <td><?php echo $row_incident['incident_number']; ?></td>
        </tr>
        <tr>
          <td width="188" class="etiqueta">Type:</td>
          <td width="365"><?php echo $row_incident['type']; ?></td>
        </tr>
        <tr>
          <td class="etiqueta">Location:</td>
          <td><?php echo $row_incident['location']; ?></td>
        </tr>
        <tr>
          <td class="etiqueta">Incident start:</td>
          <td><?php echo $row_incident['date_start']; ?> - <?php echo $row_incident['time_start']; ?></td>
        </tr>
        <tr>
          <td class="etiqueta"><blockquote>
            End:
          </blockquote></td>
          <td><?php echo $row_incident['date_end']; ?> - <?php echo $row_incident['time_end']; ?></td>
        </tr>
        <tr>
          <td class="etiqueta">Complainant's </td>
          <td><?php echo $row_incident['complainant']; ?></td>
        </tr>
        <tr>
          <td class="etiqueta"><blockquote>
            Last name:
          </blockquote></td>
          <td><?php echo $row_incident['last_name']; ?></td>
        </tr>
        <tr>
          <td class="etiqueta"><blockquote>
            First name:
          </blockquote></td>
          <td><?php echo $row_incident['first_name']; ?></td>
        </tr>
        <tr>
          <td class="etiqueta"><blockquote>
            Address:
          </blockquote></td>
          <td><?php echo $row_incident['address']; ?></td>
        </tr>
        <tr>
          <td class="etiqueta"><blockquote>
            City:
          </blockquote></td>
          <td><?php echo $row_incident['city']; ?></td>
        </tr>
        <tr>
          <td class="etiqueta"><blockquote>
            State:
          </blockquote></td>
          <td><?php echo $row_incident['state']; ?></td>
        </tr>
        <tr>
          <td class="etiqueta"><blockquote>
            Zip:
          </blockquote></td>
          <td><?php echo $row_incident['zip']; ?></td>
        </tr>
        <tr>
          <td class="etiqueta"><blockquote>
            Phone:
          </blockquote></td>
          <td><?php echo $row_incident['phone1']; ?></td>
        </tr>
        <tr>
          <td class="etiqueta"><blockquote>
            Sec. Phone:
          </blockquote></td>
          <td><?php echo $row_incident['phone2']; ?></td>
        </tr>
        <tr>
          <td class="etiqueta"><blockquote>
            Dep./Company:
          </blockquote></td>
          <td><?php echo $row_incident['company']; ?></td>
        </tr>
        <tr>
          <td class="etiqueta">Complainant's </td>
          <td><?php echo $row_incident['complainant2']; ?></td>
        </tr>
        <tr>
          <td class="etiqueta"><blockquote>
            Last name:
          </blockquote></td>
          <td><?php echo $row_incident['last_name2']; ?></td>
        </tr>
        <tr>
          <td class="etiqueta"><blockquote>
            First name:
          </blockquote></td>
          <td><?php echo $row_incident['first_name2']; ?></td>
        </tr>
        <tr>
          <td class="etiqueta"><blockquote>
            Address:
          </blockquote></td>
          <td><?php echo $row_incident['address2']; ?></td>
        </tr>
        <tr>
          <td class="etiqueta"><blockquote>
            City:
          </blockquote></td>
          <td><?php echo $row_incident['city2']; ?></td>
        </tr>
        <tr>
          <td class="etiqueta"><blockquote>
            State:
          </blockquote></td>
          <td><?php echo $row_incident['state2']; ?></td>
        </tr>
        <tr>
          <td class="etiqueta"><blockquote>
            Zip:
          </blockquote></td>
          <td><?php echo $row_incident['zip2']; ?></td>
        </tr>
        <tr>
          <td class="etiqueta"><blockquote>
            Phone:
          </blockquote></td>
          <td><?php echo $row_incident['phone12']; ?></td>
        </tr>
        <tr>
          <td class="etiqueta"><blockquote>
            Sec. Phone:
          </blockquote></td>
          <td><?php echo $row_incident['phone22']; ?></td>
        </tr>
        <tr>
          <td class="etiqueta"><blockquote>
            <p>Dep./Company:</p>
          </blockquote></td>
          <td><?php echo $row_incident['company2']; ?></td>
        </tr>
        <tr class="etiqueta">
          <td colspan="2">&nbsp;</td>
        </tr>
        <tr class="etiqueta">
          <td colspan="2" class="cabecera">Description of the Incident:</td>
        </tr>
        <tr>
          <td colspan="2"><?php echo $row_incident['description']; ?></td>
        </tr>
        <tr>
          <td class="etiqueta">Police incident No.</td>
          <td><?php echo $row_incident['police_num']; ?></td>
        </tr>
        <tr>
          <td class="etiqueta">Police Officer Name:</td>
          <td><?php echo $row_incident['police_name']; ?></td>
        </tr>
        <tr>
          <td class="etiqueta">Police I.D.:</td>
          <td><?php echo $row_incident['police_id']; ?></td>
        </tr>
        <tr>
          <td class="etiqueta">Rescue Called:</td>
          <td><?php echo $row_incident['rescue']; ?></td>
        </tr>
        <tr>
          <td class="etiqueta">Lt. In Charge Name:</td>
          <td><?php echo $row_incident['lt_name']; ?></td>
        </tr>
        <tr>
          <td class="etiqueta">Alarm No.</td>
          <td><?php echo $row_incident['alarm_no']; ?></td>
        </tr>
        <tr>
          <td class="etiqueta">Completed by:</td>
          <td><?php echo $row_incident['completed_by']; ?></td>
        </tr>
    </table>
    <br />
    <table width="300" border="0">
      <tr>
        <td align="center"><a href="ema_send.php?id=<?php echo $row_incident['incident_id']; ?>"><img src="../images/email.png" width="60" height="60" border="0" /></a></td>
        <td align="center"><img src="../images/pencil.png" width="40" height="40" /></td>
      </tr>
    </table></td>
  </tr>
</table>
<br /><!-- InstanceEndEditable -->
<table width="200" border="0" align="right">
  <tr>
    <td>User: <?php echo $row_usuario['names']; ?></td>
  </tr>
</table>

</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($usuario);

mysql_free_result($incident);
?>
