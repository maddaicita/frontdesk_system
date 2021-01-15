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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE tbl_users SET email=%s, address=%s, city=%s, zipcode=%s, cellphone=%s, homephone=%s, last_update=%s, user_admin=%s WHERE users_id=%s",
                       GetSQLValueString($_POST['txt_email'], "text"),
                       GetSQLValueString($_POST['txt_address'], "text"),
                       GetSQLValueString($_POST['select_city'], "int"),
                       GetSQLValueString($_POST['txt_zipcode'], "text"),
                       GetSQLValueString($_POST['txt_cellphone'], "text"),
                       GetSQLValueString($_POST['txt_homephone'], "text"),
                       GetSQLValueString($_POST['hidden_admin'], "date"),
                       GetSQLValueString($_POST['hidden_admin'], "int"),
                       GetSQLValueString($_POST['hidden_id'], "int"));

  mysql_select_db($database_security, $security);
  $Result1 = mysql_query($updateSQL, $security) or die(mysql_error());

  $updateGoTo = "main.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_usario = "-1";
if (isset($_COOKIE['username'])) {
  $colname_usario = $_COOKIE['username'];
}
mysql_select_db($database_security, $security);
$query_usario = sprintf("SELECT users_id, last_name, first_name, email, address, city, `state`, zipcode, cellphone, homephone, license_class, license_number, license_status, exp_license FROM tbl_users WHERE username = %s", GetSQLValueString($colname_usario, "text"));
$usario = mysql_query($query_usario, $security) or die(mysql_error());
$row_usario = mysql_fetch_assoc($usario);
$totalRows_usario = mysql_num_rows($usario);

mysql_select_db($database_security, $security);
$query_cities = "SELECT * FROM tbl_cities ORDER BY city ASC";
$cities = mysql_query($query_cities, $security) or die(mysql_error());
$row_cities = mysql_fetch_assoc($cities);
$totalRows_cities = mysql_num_rows($cities);
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
    <table width="220" border="0" align="center">
      <tr>
        <td width="214" align="center">Please keep your records updated</td>
      </tr>
    </table>
    <br>
    <form name="form1" method="POST" action="<?php echo $editFormAction; ?>">
      <table width="357" border="1" align="center">
        <tr>
          <td width="105">Names:
          <input name="hidden_id" type="hidden" id="hidden_id" value="<?php echo $row_usario['users_id']; ?>"></td>
          <td width="236"><label for="txt_address"><?php echo $row_usario['last_name']; ?>, <?php echo $row_usario['first_name']; ?> </label></td>
        </tr>
        <tr>
          <td>Address:</td>
          <td><label for="textfield2"></label>
          <input name="txt_address" type="text" id="textfield2" value="<?php echo $row_usario['address']; ?>" size="40"></td>
        </tr>
        <tr>
          <td>CIty:</td>
          <td><label for="select_city"></label>
            <select name="select_city" id="select_city">
              <?php
do {  
?>
              <option value="<?php echo $row_cities['city_id']?>"<?php if (!(strcmp($row_cities['city_id'], $row_usario['city']))) {echo "selected=\"selected\"";} ?>><?php echo $row_cities['city']?></option>
              <?php
} while ($row_cities = mysql_fetch_assoc($cities));
  $rows = mysql_num_rows($cities);
  if($rows > 0) {
      mysql_data_seek($cities, 0);
	  $row_cities = mysql_fetch_assoc($cities);
  }
?>
          </select></td>
        </tr>
        <tr>
          <td>State:</td>
          <td><label for="select_state"></label>
            <select name="select_state" id="select_state">
              <option value="FL">FL</option>
          </select></td>
        </tr>
        <tr>
          <td>Zip code:</td>
          <td><label for="textfield3"></label>
          <input name="txt_zipcode" type="text" id="textfield3" value="<?php echo $row_usario['zipcode']; ?>" size="9" maxlength="5"></td>
        </tr>
        <tr>
          <td>Cellphone number:</td>
          <td><label for="txt_cellphone"></label>
          <input name="txt_cellphone" type="text" id="txt_cellphone" value="<?php echo $row_usario['cellphone']; ?>"></td>
        </tr>
        <tr>
          <td>Secondary phone:</td>
          <td><label for="txt_homephone"></label>
          <input name="txt_homephone" type="text" id="txt_homephone" value="<?php echo $row_usario['homephone']; ?>"></td>
        </tr>
        <tr>
          <td>E-mail:</td>
          <td><label for="txt_email"></label>
          <input name="txt_email" type="text" id="txt_email" value="<?php echo $row_usario['email']; ?>"></td>
        </tr>
        <tr>
          <td><input name="hidden_admin" type="hidden" id="hidden_admin" value="999"></td>
          <td><input type="submit" name="button" id="button" value="Submit"></td>
        </tr>
      </table>
      <input type="hidden" name="MM_update" value="form1">
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

mysql_free_result($cities);
?>
