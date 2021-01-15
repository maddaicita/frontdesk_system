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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tbl_users SET date_fired=%s, user_enabled=%s WHERE users_id=%s",
                       GetSQLValueString("", "text"),
                       GetSQLValueString($_POST['hidden_laidoff'], "int"),
                       GetSQLValueString($_POST['hidden_id'], "int"));

  mysql_select_db($database_security, $security);
  $Result1 = mysql_query($updateSQL, $security) or die(mysql_error());
  
  
  
   $insertSQL = sprintf("INSERT INTO tbl_hire_status (users_id, label_status, date_status, admin_id, comments) VALUES(%s,%s,%s,%s,%s)",
                       GetSQLValueString($_POST['hidden_id'], "text"),
					   GetSQLValueString($_POST['select_fired'], "text"),
					   GetSQLValueString(date('Y-m-d'), "date"),
					   GetSQLValueString($_POST['hidden_admin'], "int"),
                       GetSQLValueString($_POST['txt_comments'], "text"));

  mysql_select_db($database_security, $security);
  $Result2 = mysql_query($insertSQL, $security) or die(mysql_error());



  $updateGoTo = "employee_list.php";
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

$colname_layoff = "-1";
if (isset($_GET['users_id'])) {
  $colname_layoff = $_GET['users_id'];
}
mysql_select_db($database_security, $security);
$query_layoff = sprintf("SELECT users_id, last_name, first_name FROM tbl_users WHERE users_id = %s", GetSQLValueString($colname_layoff, "int"));
$layoff = mysql_query($query_layoff, $security) or die(mysql_error());
$row_layoff = mysql_fetch_assoc($layoff);
$totalRows_layoff = mysql_num_rows($layoff);
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
      <p>You are about to set to <span class="caja_grande"><?php echo $row_layoff['first_name']; ?> <?php echo $row_layoff['last_name']; ?> </span></p>
      <p>as a<span class="caja_grande"> RE - HIRED</span>. All the options will be avaliable after his record be updated.</p>
      <form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
      <p>Please select an option:</p>
      <p>
        <label for="select_fired"></label>
        <select name="select_fired" id="select_fired">
          <option value="WE CALL HIM">WE CALL HIM</option>
          <option value="HE ASK TO BE RE HIRE">HE ASK TO BE RE HIRE</option>
        </select>
       
        <br />
        <br />
        <label for="txt_comments"></label>
        Comments:
        <br />
        <textarea name="txt_comments" id="txt_comments" cols="45" rows="5"></textarea>
      </p>
      <p>&nbsp;</p>
      
       <input name="hidden_id" type="hidden" id="hidden_id" value="<?php echo $row_layoff['users_id']; ?>" />
        <input name="hidden_laidoff" type="hidden" id="hidden_laidoff" value="1" />
        <input name="hidden_date" type="hidden" id="hidden_date" value="<?php echo date("Y-m-d"); ?>" />
        <label>
          <input name="hidden_admin" type="hidden" id="hidden_admin" value="<?php echo $row_user['users_id']; ?>" />
          <input type="submit" name="button" id="button" value="Submit" />
        </label>
        <input type="hidden" name="MM_update" value="form1" />
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

mysql_free_result($layoff);
?>
