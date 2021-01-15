<?php require_once('Connections/dplace.php'); ?>
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

$colname_id = "-1";
if (isset($_GET['id'])) {
  $colname_id = $_GET['id'];
}
mysql_select_db($database_dplace, $dplace);
$query_id = sprintf("SELECT * FROM tbl_tennants WHERE id_tennant = %s", GetSQLValueString($colname_id, "int"));
$id = mysql_query($query_id, $dplace) or die(mysql_error());
$row_id = mysql_fetch_assoc($id);
$totalRows_id = mysql_num_rows($id);

$colname_visitors = "-1";
if (isset($_GET['id'])) {
  $colname_visitors = $_GET['id'];
}
mysql_select_db($database_dplace, $dplace);
$query_visitors = sprintf("SELECT * FROM tbl_visitors WHERE id_tennat = %s ORDER BY `names` ASC", GetSQLValueString($colname_visitors, "int"));
$visitors = mysql_query($query_visitors, $dplace) or die(mysql_error());
$row_visitors = mysql_fetch_assoc($visitors);
$totalRows_visitors = mysql_num_rows($visitors);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="templatephp.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>Cynergi's Visitors Control System</title>
<script>
// (C) 2001 www.CodeLifter.com
// http://www.codelifter.com
// Free for all users, but leave in this header
var theURL = 'http://localhost/dial.php?phone=<?php echo $row_id['phones']; ?>';
var width  = 400;
var height = 200;
function popWindow() {
newWindow = window.open(theURL,'newWindow','toolbar=no,menubar=no,resizable=no,scrollbars=no,status=no,location=no,width='+width+',height='+height);
}
</script>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<style type="text/css">
<!--
body {
	background-image: url(images/bgnd2.jpg);
	background-repeat: repeat-x;
}
-->
</style><script type="text/javascript" src="stmenu.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table width="627" height="132" border="0" align="center">
  <tr>
    <td width="232" height="128" align="center"><img src="images/dplace_logo.JPG" alt="" width="175" height="87" /></td>
    <td width="385" align="center"><span class="titulo">Visitor control system <br />
      All American Security Services</span></td>
  </tr>
</table>
<table width="673" border="0" align="center">
  <tr>
    <td width="362" align="center"><span> &nbsp;
      <script type="text/javascript" src="menu.js"></script>
    </span></td>
  </tr>
</table>
<!-- InstanceBeginEditable name="central" --><br />
<table width="279" border="0" align="center">
  <tr>
   <td align="center" class="titulo">Tennant details</td>
  </tr>
</table>
<table width="816" height="367" border="0" align="center">
  <tr>
    <td align="center" valign="top"><table width="643" border="1">
      <tr>
          <td width="117" align="left" class="etiqueta">Names:</td>
          <td colspan="5" align="left" class="linea"><?php echo $row_id['names']; ?></td>
        </tr>
        <tr>
          <td align="left" class="etiqueta">Address</td>
          <td colspan="5" align="left" class="linea"><?php echo $row_id['bldg']; ?> <?php echo $row_id['address']; ?> Apt# <?php echo $row_id['apt']; ?></td>
        </tr>
        <tr>
          <td height="29" align="left" class="etiqueta">Phone numbers:</td>
          <td colspan="5" align="left" class="linea"><?php
		 echo $row_id['phones'];
		 
//		  $phone0= $row_id['phones'];
//		  $phone0 = preg_replace("/[^0-9]/","", $phone0);	  
//		   $phone_l = strlen($phone0);
//	   if ($phone_l == 10) { $phone = substr($phone0,0,10); echo $phone; }
//		   if ($phone_l == 20) {
//			   $phone1 = substr($phone0,0,10);  
//			   $phone2 = substr($phone0,10,20);
//			   echo $phone1 . "<br>" . $phone2;
//			   echo "20";
//			   }
//		if ($phone_l == 30) {
//			  $phone = substr($phone0,0,10);
//			  $phone2 = substr($phone0,10,10);
//			  $phone3 = substr($phone0,20,10);
//			  echo $phone . "<br>" . $phone2 . "<br>" . $phone3;
	//		  }
//		   if ($phone_l == 40) {
	//		  $phone = substr($phone0,0,10);
//			  $phone2 = substr($phone0,10,10);
//			  $phone3 = substr($phone0,20,10);
//			  $phone4 = substr($phone0,30,10);
//			  echo $phone . "<br>" . $phone2 . "<br>" . $phone3 . "<br>" . $phone4;
//			  //if ($phone == "") {echo $phone0;}
//			  }
		  ?></td>
        </tr>
       <tr>
         <td height="33" align="left" class="etiqueta">Vehicle Make</td>
          <td colspan="2" align="left" class="caja_search"><?php echo $row_id['make1']; ?></td>
          <td align="left" class="etiqueta">Vehicle Make2</td>
          <td colspan="2" align="left" class="caja_search"><?php echo $row_id['make2']; ?></td>
        </tr>
        <tr>
          <td height="33" align="left" class="etiqueta">Model</td>
          <td colspan="2" align="left" class="caja_search"><?php echo $row_id['model1']; ?></td>
          <td align="left" class="etiqueta">Model2</td>
          <td colspan="2" align="left" class="caja_search"><?php echo $row_id['model2']; ?></td>
        </tr>
        <tr>
          <td height="33" align="left" class="etiqueta">License Plate</td>
          <td colspan="2" align="left" class="caja_search"><?php echo $row_id['tag1']; ?></td>
          <td width="123" align="left" class="etiqueta">License Plate 2</td>
          <td colspan="2" align="left" class="caja_search"><?php echo $row_id['tag2']; ?></td>
        </tr>
        <tr>
          <td height="53" align="left" valign="top" class="etiqueta">Comments:</td>
          <td colspan="5" align="left" valign="top"><?php echo $row_id['comments']; ?></td>
        </tr>
        <tr>
          <td height="53" align="left" valign="top" class="etiqueta">Actions:</td>
          <td width="105" align="center"><a href="javascript:popWindow()"><img src="images/phono.png" alt="Call tennant" width="60" height="44" border="0" align="Dial tenant's phone number" title="Dial tenant's phone number" /></a></td>
          <td width="87" align="center"><a href="package_reg.php?id=<?php echo $row_id['id_tennant']; ?>"><img src="images/packages.jpg" alt="Register package" width="60" height="60" border="0" align="Register postal package" title="Register postal package" /></a></td>
          <td align="center"><a href="package_list_ten.php?ten=<?php echo $row_id['id_tennant']; ?>"><img src="images/packages_del.jpg" alt="Packages list" width="60" height="60" border="0"title="Packages list" /></a></td>
        <td width="99" align="center"><?php if ($row_id['email'] == "") {} else { echo "<a href=\"mailto:" . $row_id['email'] . "\">";
		  }
		  ?>
          <img src="images/email.png" <?php if ($row_id['email'] == "") { echo " alt=\"No email has been registered\" title=\"No email has been registered\" ";} ?> width="60" height="60" border="0" title="Email Tenant" alt="Email Tenant"  />
          <?php if ($row_id['email'] == "") {} else { echo "</a>";
		  }
	  ?></td>
        <td width="72" align="center"><a href="visitor_add.php?id=<?php echo $row_id['id_tennant']; ?>"><img src="images/visitor.png" alt="Register a new visitor" width="60" height="55" border="0" align="Add permanent visitor" title="Add permanent visitor" /></a></td>
        </tr>
     </table>
      <br />
     <table width="400" border="0">
        <?php if ($totalRows_visitors == 0) { // Show if recordset empty ?>
          <tr>
            <td align="center">No visitor has been registered yet.</td>
          </tr>
          <?php } // Show if recordset empty ?>
      </table>
      <?php if ($totalRows_visitors > 0) { // Show if recordset not empty ?>
        <table width="631" border="1">
          <tr class="etiqueta">
            <td width="154">Visitor names:</td>
            <td width="128">Make:</td>
            <td width="125">Model:</td>
            <td width="116">Autorized?</td>
            <td width="74">Add visit:</td>
          </tr>
          <?php do { ?>
            <tr>
              <td><?php echo $row_visitors['names']; ?></td>
              <td><?php echo $row_visitors['make']; ?></td>
              <td><?php echo $row_visitors['model']; ?></td>
              <td><?php echo $row_visitors['autorized']; ?></td>
              <td align="center"><a href="visitor_visit.php?id=<?php echo $row_visitors['id_visitor']; ?>"><img src="images/pencil.png" width="40" height="40" border="0" /></a></td>
            </tr>
            <?php } while ($row_visitors = mysql_fetch_assoc($visitors)); ?>
        </table>
        <?php } // Show if recordset not empty ?>
<br />
      <table width="200" border="0" align="center">
        <tr>
          <td align="center"><a href="search_tennant.php"><img src="images/back.png" width="60" height="60" border="0" /></a></td>
        </tr>
      </table>
    <p>&nbsp;</p></td>
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
mysql_free_result($id);
mysql_free_result($visitors);
?>