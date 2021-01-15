<?php require_once('Connections/security.php'); ?>
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
  $insertSQL = sprintf("INSERT INTO tbl_hours (users_id, shift_start, shift_end, loc_id, comments, hours) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['hidden_id'], "int"),
                       GetSQLValueString($_POST['hidden_start_date'] . " " . $_POST['hidden_start_time'] . ":00", "date"),
                       GetSQLValueString($_POST['hidden_end_date'] . " " . $_POST['hidden_end_time'] . ":00", "date"),
					   GetSQLValueString($_POST['hidden_loc'], "int"),
                       GetSQLValueString($_POST['txt_comments'], "text"),
                       GetSQLValueString(round(time_diff($_POST['hidden_end_date'] . " " . $_POST['hidden_end_time'] . ":00", $_POST['hidden_start_date'] . " " . $_POST['hidden_start_time'] . ":00")/3600,2), "int"));
  mysql_select_db($database_security, $security);
  $Result1 = mysql_query($insertSQL, $security) or die(mysql_error());

  $insertGoTo = "emp_hours_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_usuario = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_usuario = $_SESSION['MM_Username'];
}
mysql_select_db($database_security, $security);
$query_usuario = sprintf("SELECT users_id, last_name, first_name, email, cellphone FROM tbl_users WHERE username = %s", GetSQLValueString($colname_usuario, "text"));
$usuario = mysql_query($query_usuario, $security) or die(mysql_error());
$row_usuario = mysql_fetch_assoc($usuario);
$totalRows_usuario = mysql_num_rows($usuario);

$colname_location = "-1";
if (isset($_POST['select_location'])) {
  $colname_location = $_POST['select_location'];
}
mysql_select_db($database_security, $security);
$query_location = sprintf("SELECT * FROM locations WHERE loc_id = %s", GetSQLValueString($colname_location, "int"));
$location = mysql_query($query_location, $security) or die(mysql_error());
$row_location = mysql_fetch_assoc($location);
$totalRows_location = mysql_num_rows($location);
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
      <p class="Titles">Add hours confirmation</p>
      <p>You are going to add the following information to your records      </p>
      <p>&nbsp;</p>
      <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
        <table width="775" border="1" cellpadding="10">
          <tr>
            <td width="46" class="cabecera">Check in date:</td>
            <td width="244" class="caja_grande"><?php echo $_POST['txt_date_start']; ?></td>
            <td width="73" class="cabecera">Time:</td>
            <td width="312" class="caja_grande"><?php echo $_POST['txt_time_star_hour'] . ":" .$_POST['txt_time_star_min'] ; ?></td>
          </tr>
          <tr>
            <td class="cabecera">Check out date:</td>
            <td class="caja_grande"><?php if ($_POST['txt_date_end'] <> "") { echo $_POST['txt_date_start'];} else { echo $_POST['txt_date_start'];} ?></td>
            <td class="cabecera">Time:</td>
            <td class="caja_grande"><?php echo $_POST['txt_time_end_hour'] . ":" . $_POST['txt_time_end_min']; ?></td>
          </tr>
          <tr>
            <td height="80" class="cabecera">Total hours:</td>
            <td class="caja_grande"><?php
			
			if ($_POST['txt_date_end'] <> "") {$date_fin2 = $_POST['txt_date_end'];} else {$date_fin2=$_POST['txt_date_start'];}
			
			$calculated= round(time_diff($date_fin2 . " " . $_POST['txt_time_end_hour'] . ":" . $_POST['txt_time_end_min'], $_POST['txt_date_start'] . " " . $_POST['txt_time_star_hour'] . ":" .$_POST['txt_time_star_min'])/3600,2);
			
			if ($calculated < 0 or $calculated > 24) {echo "<font color=\"red\" >error, please recheck the dates and times!!</font>"; $desa=1;} else { echo $calculated . " Hours worked at<br>" .$row_location['location']; $desa=0;}
			
			?></td>
            <td class="cabecera">Comments:</td>
            <td><label>
              <textarea name="txt_comments" id="txt_comments" cols="30" rows="5"></textarea>
           </label></td>
          </tr>
        </table>
        <p>&nbsp;</p>
        <table width="409" border="0">
          <tr>
            <td align="center"><input name="hidden_id" type="hidden" id="hidden_id" value="<?php echo $_SESSION['id']; ?>" />
              <input type="hidden" name="hidden_start_date" id="hidden_start_date" value="<?php echo $_POST['txt_date_start']; ?>" />
            <input type="hidden" name="hidden_start_time" id="hidden_start_time" value="<?php echo $_POST['txt_time_star_hour'] . ":" .$_POST['txt_time_star_min'] ; ?>" />
            <input type="hidden" name="hidden_end_date" id="hidden_end_date" value="<?php echo $date_fin2; ?>" />
            <input type="hidden" name="hidden_end_time" id="hidden_end_time" value="<?php echo $_POST['txt_time_end_hour'] . ":" . $_POST['txt_time_end_min']; ?>" />
            <input type="hidden" name="hidden_loc" id="hidden_loc" value="<?php echo $row_location['loc_id']; ?>" />
            <label>
              <input name="button" type="submit" class="caja_grande" id="button" value="   Submit   " <?php 
			  if ($desa==1) {echo "disabled=\"disabled\"";} ?>/>
            </label></td>
          </tr>
        </table>
        <p>&nbsp;</p>
        <input type="hidden" name="MM_insert" value="form1" />
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
function time_diff($dt1,$dt2){
     $y1 = substr($dt1,0,4);
     $m1 = substr($dt1,5,2);
     $d1 = substr($dt1,8,2);
     $h1 = substr($dt1,11,2);
     $i1 = substr($dt1,14,2);
     $s1 = substr($dt1,17,2);    

     $y2 = substr($dt2,0,4);
     $m2 = substr($dt2,5,2);
     $d2 = substr($dt2,8,2);
     $h2 = substr($dt2,11,2);
     $i2 = substr($dt2,14,2);
     $s2 = substr($dt2,17,2);    

     $r1=date('U',mktime($h1,$i1,$s1,$m1,$d1,$y1));
     $r2=date('U',mktime($h2,$i2,$s2,$m2,$d2,$y2));
     return ($r1-$r2);

 }

mysql_free_result($usuario);

mysql_free_result($location);
?>
