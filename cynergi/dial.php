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





$device = "COM5"; 



$phone = $_REQUEST['phone'];

$phone = preg_replace("/[^0-9]/","", $phone); 



exec("mode $device BAUD=9600 PARITY=n DATA=8 STOP=1 xon=off octs=off rts=on"); 



$comport = fopen($device, "r+b");



if ($comport === false) {     

	die ("Failed opening com port"); 

} else {

	echo "Com Port Open"; 

}  



stream_set_blocking($comport, 0);



$atcmd = "ATDT" . $phone . "\r"; // dial fake number 



if (fwrite($comport, $atcmd ) === false) {

	die ("Failed writing to com port");  

} else {

	//echo "Wrote $atcmd to com port"; 

	echo "";

}  

sleep(10);

// added fix to make program work, was closing port too soon for it to dial  

fclose($comport); 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<script>

var gWindowCloseWait = 5;

window.setTimeout("window.close()",gWindowCloseWait*1000);

</script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Untitled Document</title>

<link href="css/style.css" rel="stylesheet" type="text/css" />

</head>



<body>

<p>&nbsp;</p>

<table width="357" border="1" align="center">

  <tr>

    <td align="center" class="highlight_important">Pick up the phone headset, please! After this windows will close automatically.</td>

  </tr>

</table>

</body>

</html>



