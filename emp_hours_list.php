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

$maxRows_hours = 30;
$pageNum_hours = 0;
if (isset($_GET['pageNum_hours'])) {
  $pageNum_hours = $_GET['pageNum_hours'];
}
$startRow_hours = $pageNum_hours * $maxRows_hours;

$colname_hours = "-1";
if (isset($_SESSION['id'])) {
  $colname_hours = $_SESSION['id'];
}
mysql_select_db($database_security, $security);
$query_hours = sprintf("SELECT hor.*, loc.location  FROM tbl_hours hor, locations loc WHERE hor.users_id = %s AND hor.loc_id= loc.loc_id ORDER BY hor.shift_start DESC", GetSQLValueString($colname_hours, "int"));
$query_limit_hours = sprintf("%s LIMIT %d, %d", $query_hours, $startRow_hours, $maxRows_hours);
$hours = mysql_query($query_limit_hours, $security) or die(mysql_error());
$row_hours = mysql_fetch_assoc($hours);

if (isset($_GET['totalRows_hours'])) {
  $totalRows_hours = $_GET['totalRows_hours'];
} else {
  $all_hours = mysql_query($query_hours);
  $totalRows_hours = mysql_num_rows($all_hours);
}
$totalPages_hours = ceil($totalRows_hours/$maxRows_hours)-1;

$colname_usuario = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_usuario = $_SESSION['MM_Username'];
}
mysql_select_db($database_security, $security);
$query_usuario = sprintf("SELECT users_id, last_name, first_name, email, cellphone FROM tbl_users WHERE username = %s", GetSQLValueString($colname_usuario, "text"));
$usuario = mysql_query($query_usuario, $security) or die(mysql_error());
$row_usuario = mysql_fetch_assoc($usuario);
$totalRows_usuario = mysql_num_rows($usuario);
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
      <p class="Titles">Worked hour list</p>
      <p><a href="emp_add_hours.php">Add hours</a><br />
        <br />
      Last 4 weeks hours list</p>
      <?php if ($totalRows_hours == 0) { // Show if recordset empty ?>
  <p>There are no records in your profile. Please give us a call if you consider this is an error.</p>
  <?php } // Show if recordset empty ?>
      <?php if ($totalRows_hours > 0) { // Show if recordset not empty ?>
        <table width="746" border="1">
          <tr class="cabecera">
            <td width="207">Start date/time</td>
            <td width="196">End date/time</td>
            <td width="145" align="center">Location</td>
            <td width="95" align="center">Total hours</td>
            <td width="69">Comment</td>
          </tr>
          <?php do { ?>
            <tr <?php
			if (idate('W',strtotime($row_hours['shift_start']))%2==0){
			 echo "bgcolor=\"#99FFCC\"";
				}else{
		     echo "bgcolor=\"#FFCCCC\"";
			}
			
			?>>
              <td><?php echo date("D j \of M Y G:i", strtotime($row_hours['shift_start'])); ?></td>
              <td><?php echo  date("D j \of M Y G:i", strtotime($row_hours['shift_end'])); ?></td>
              <td align="center"><?php echo $row_hours['location']; ?></td>
              <td align="center"><?php echo round((time_diff($row_hours['shift_end'],$row_hours['shift_start']))/3600,2); ?></td>
              <td align="center"><?php if ($row_hours['comments'] <> "")  { echo "<img src=\"images/detalle.png\" width=\"16\" height=\"16\" border=\"0\" TITLE=\"" . $row_hours['comments'] . "\" />" ;} ?></td>
            </tr>
            <?php } while ($row_hours = mysql_fetch_assoc($hours)); ?>
        </table>
        <p>&nbsp;</p>
        <?php } // Show if recordset not empty ?>
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

mysql_free_result($hours);

mysql_free_result($usuario);
?>
