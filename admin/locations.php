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
	
	//Look for max ID location to record the default shift with the same ID form locations
	
	mysql_select_db($database_security, $security);
	$query_maximo = "SELECT MAX(shift_id) as maxida FROM locations_shifts";
	$maximo = mysql_query($query_maximo, $security) or die(mysql_error());
	$row_maximo = mysql_fetch_assoc($maximo);
	$totalRows_maximo = mysql_num_rows($maximo);
	
	//look for the next id for the locations
	
	mysql_select_db($database_security, $security);
	$query_maximo2 = "SELECT MAX(loc_id) as maxid FROM locations";
	$maximo2 = mysql_query($query_maximo2, $security) or die(mysql_error());
	$row_maximo2 = mysql_fetch_assoc($maximo2);
	$totalRows_maximo2 = mysql_num_rows($maximo2);
	
//Record the new location	
  $insertSQL = sprintf("INSERT INTO locations (location, d_shift, address) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['txt_location'], "text"),
					   GetSQLValueString($row_maximo['maxida'] + 1, "int"),
                       GetSQLValueString($_POST['txt_address'], "text"));

  mysql_select_db($database_security, $security);
  $Result1 = mysql_query($insertSQL, $security) or die(mysql_error());
  
  // create the new default shift
  
    $insertSQL2 = sprintf("INSERT INTO locations_shifts (overnight, loc_id, users_id, active) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString("0", "text"),
					   GetSQLValueString($row_maximo2['maxid'] + 1, "int"),
					   GetSQLValueString("1", "text"),
                       GetSQLValueString("1", "text"));

  mysql_select_db($database_security, $security);
  $Result2 = mysql_query($insertSQL2, $security) or die(mysql_error());
  
  
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
$query_locations = "SELECT * FROM locations ORDER BY location ASC";
$locations = mysql_query($query_locations, $security) or die(mysql_error());
$row_locations = mysql_fetch_assoc($locations);
$totalRows_locations = mysql_num_rows($locations);
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
      <p class="Titles">Working Locations</p>
      <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
        <table width="388" border="1">
          <tr>
            <td class="cabecera">Location</td>
            <td><label>
              <input name="txt_location" type="text" id="txt_location" size="40" maxlength="60" />
            </label></td>
          </tr>
          <tr>
            <td class="cabecera"><span class="cabecera">Address</span></td>
            <td><input name="txt_address" type="text" id="txt_address" size="40" maxlength="80" /></td>
          </tr>
          <tr>
            <td width="96" class="cabecera">&nbsp;</td>
            <td width="276"><label>
              <input type="submit" name="button" id="button" value="Submit" />
            </label></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1" />
      </form>
      <br />
      <table width="710" border="1">
        <tr class="cabecera">
          <td width="227">Location name</td>
          <td width="303">Address</td>
          <td width="60" align="center">Schedule</td>
          <td width="53" align="center">Shifts</td>
          <td width="33" align="center">Edit</td>
        </tr>
        <?php do { ?>
          <tr>
            <td><span class="lineas"><?php echo $row_locations['location']; ?></span></td>
            <td class="lineas"><?php echo $row_locations['address']; ?></td>
            <td align="center" class="lineas"><a href="schedule.php?loc=<?php echo $row_locations['loc_id']; ?>"><img src="../images/calendar.jpg" width="35" height="35" border="0" /></a></td>
            <td align="center"><a href="shift_templates.php?loc=<?php echo $row_locations['loc_id']; ?>"><img src="../images/detalle.png" alt="Locations detail" width="16" height="16" border="0" /></a></td>
            <td align="center"><img src="../images/editi.png" alt="Edit location" width="16" height="16" border="0" /></td>
          </tr>
          <?php } while ($row_locations = mysql_fetch_assoc($locations)); ?>
      </table>
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

mysql_free_result($locations);
?>
