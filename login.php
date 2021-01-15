<?php require_once('Connections/security.php'); ?>
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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['txt_username'])) {
  $loginUsername=$_POST['txt_username'];
  $password=md5($_POST['txt_password']);
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "emp_home.php";
  $MM_redirectLoginFailed = "login.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_security, $security);
  
  $LoginRS__query=sprintf("SELECT username, cellphone, password FROM tbl_users WHERE username=%s AND password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $security) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<title>All American security Services</title>
<table width="600" border="0" align="center">
  <tr>
    <td height="498" align="center" valign="top"><p>&nbsp;</p>
    <p><span class="Titles">All American Security Services</span></p>
    <p>&nbsp;</p>
    <table width="400" border="0">
      <tr>
        <td align="center"><img src="web/logo.jpg" width="202" height="250" /></td>
      </tr>
    </table>
    <p>&nbsp;</p>
    <form id="form1" name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
    <table width="400" border="1">
        <tr>
          <td class="cabecera">Username:</td>
          <td><label>
            <input type="text" name="txt_username" id="txt_username" />
          </label></td>
        </tr>
        <tr>
          <td class="cabecera">Password:</td>
          <td><label>
            <input type="password" name="txt_password" id="txt_password" />
          </label></td>
        </tr>
        <tr>
          <td class="cabecera">&nbsp;</td>
          <td><label>
            <input type="submit" name="button" id="button" value="Submit" />
          </label></td>
        </tr>
      </table>
    </form>
<p>&nbsp;</p>
<p>If you have not created an username and password with us yet,  please follow <a href="create.php">this link</a>.</p>
<p>If you have lost your username or password please link here.</p></td>
  </tr>
</table> 
