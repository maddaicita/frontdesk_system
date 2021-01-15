<?php require_once('../../Connections/dplace.php'); ?>
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

$colname_incident = "-1";
if (isset($_GET['id'])) {
  $colname_incident = $_GET['id'];
}
mysql_select_db($database_dplace, $dplace);
$query_incident = sprintf("SELECT * FROM tbl_incident WHERE incident_id = %s", GetSQLValueString($colname_incident, "int"));
$incident = mysql_query($query_incident, $dplace) or die(mysql_error());
$row_incident = mysql_fetch_assoc($incident);
$totalRows_incident = mysql_num_rows($incident);


//--------------------------Set these paramaters--------------------------

// Subject of email sent to you.
$subject = 'Cynergi\'s Incident Report'; 

// Your email address. This is where the form information will be sent. 
//$emailadd = 'allamerican3043@bellsouth.net, support@websoftec.net'; 
$emailadd = 'support@websoftec.net'; 

// Where to redirect after form is processed. 
$url = "incident_log.php"; 
echo "<p>Recording the incident on to the database and sending the email to the office, please wait few seconds..........";
$cabeceras = "From: cynergi@allamericanfl.com\r\nContent-type: text/html\r\n";

// Makes all fields required. If set to '1' no field can not be empty. If set to '0' any or all fields can be empty.
$req = '0'; 

// --------------------------Editar para cabiar presentacion--------------------------
$text = "<html xmlns=\"http://www.w3.org/1999/xhtml\">
<p><span class=\"TITULO\"><b>Cynergi's Security Incident Report.</b></span><br />
  <br />
</p>
<table width=\"600\" border=1 cellspacing=\"3\" cellpadding=\"3\">
  <tr>
    <td width=\"200\" class=\"ETIQUETAS\">Incident No.: </td>
    <td >" . $row_incident['incident_number'] . "</td>
  </tr>
  <tr>
    <td class=\"ETIQUETAS\">Incident Type:</td>
    <td>" . $row_incident['type'] . "</td>
  </tr>
  <tr>
    <td class=\"ETIQUETAS\">Location:</td>
    <td>" . $row_incident['location'] . "</td>
  </tr>
  <tr>
    <td class=\"ETIQUETAS\">Date/Time incident started:</td>
    <td>" . $row_incident['date_start'] . " " . $row_incident['time_start'] . "</td>
  </tr>
  <tr>
    <td class=\"ETIQUETAS\">Date/Time Incident ended:</td>
    <td>" . $row_incident['date_end'] . " " . $row_incident['time_end'] . "</td>
  </tr>
    <tr>
    <td class=\"ETIQUETAS\">Complainant:</td>
    <td>" . $row_incident['complainant'] . "</td>
  </tr>
    <tr>
    <td class=\"ETIQUETAS\">Last name:</td>
    <td>" . $row_incident['last_name'] . "</td>
  </tr>
  <tr>
    <td class=\"ETIQUETAS\">Fist name:</td>
    <td>" . $row_incident['first_name'] . "</td>
  </tr>
  <tr>
    <td class=\"ETIQUETAS\">Address:</td>
    <td>" . $row_incident['address'] . "</td>
  </tr>
    <tr>
    <td class=\"ETIQUETAS\">City:</td>
    <td>" . $row_incident['city'] . "</td>
  </tr>
    <tr>
    <td class=\"ETIQUETAS\">State:</td>
    <td>" . $row_incident['state'] . "</td>
  </tr>
    <tr>
    <td class=\"ETIQUETAS\">Zip:</td>
    <td>" . $row_incident['zip'] . "</td>
  </tr>
      <tr>
    <td class=\"ETIQUETAS\">Phone:</td>
    <td>" . $row_incident['phone1'] . "</td>
  </tr>
      <tr>
    <td class=\"ETIQUETAS\">Phone2:</td>
    <td>" . $row_incident['phone2'] . "</td>
  </tr>
      <tr>
    <td class=\"ETIQUETAS\">Company:</td>
    <td>" . $row_incident['company'] . "</td>
  </tr>";
  
  if ($row_incident['complainant2'] <> "noselected") { 
  
  $text = $text . "<tr>
    <td class=\"ETIQUETAS\">Complainant2:</td>
    <td>" . $row_incident['complainant2'] . "</td>
  </tr>
    <tr>
    <td class=\"ETIQUETAS\">Last name:</td>
    <td>" . $row_incident['last_name2'] . "</td>
  </tr>
  <tr>
    <td class=\"ETIQUETAS\">Fist name:</td>
    <td>" . $row_incident['first_name2'] . "</td>
  </tr>
  <tr>
    <td class=\"ETIQUETAS\">Address:</td>
    <td>" . $row_incident['address2'] . "</td>
  </tr>
    <tr>
    <td class=\"ETIQUETAS\">City:</td>
    <td>" . $row_incident['city2'] . "</td>
  </tr>
    <tr>
    <td class=\"ETIQUETAS\">State:</td>
    <td>" . $row_incident['state2'] . "</td>
  </tr>
    <tr>
    <td class=\"ETIQUETAS\">Zip:</td>
    <td>" . $row_incident['zip2'] . "</td>
  </tr>
      <tr>
    <td class=\"ETIQUETAS\">Phone:</td>
    <td>" . $row_incident['phone12'] . "</td>
  </tr>
      <tr>
    <td class=\"ETIQUETAS\">Phone2:</td>
    <td>" . $row_incident['phone22'] . "</td>
  </tr>
  <tr>
    <td class=\"ETIQUETAS\">Company:</td>
    <td>" . $row_incident['company2'] . "</td>
  </tr>";
  
  }
  
 $text = $text ." <tr>
    <td class=\"ETIQUETAS\">Incident description:</td>
    <td >". $row_incident['description'] . "</td>
  </tr>
    <tr>
    <td class=\"ETIQUETAS\">Police Incident No:</td>
    <td>" . $row_incident['police_num'] . "</td>
  </tr>
    <tr>
    <td class=\"ETIQUETAS\">Police Officer's name:</td>
    <td>" . $row_incident['police_name'] . "</td>
  </tr>
   </tr>
    <tr>
    <td class=\"ETIQUETAS\">Police Officer's ID No.:</td>
    <td>" . $row_incident['police_id'] . "</td>
  </tr>
    </tr>
    <tr>
    <td class=\"ETIQUETAS\">Called rescue?:</td>
    <td>" . $row_incident['rescue'] . "</td>
  </tr>
    </tr>
    <tr>
    <td class=\"ETIQUETAS\">LT Police names:</td>
    <td>" . $row_incident['lt_name'] . "</td>
  </tr>
  </tr>
    <tr>
    <td class=\"ETIQUETAS\">Alarm No.:</td>
    <td>" . $row_incident['alarm_no'] . "</td>
  </tr>
  <tr>
    <td class=\"ETIQUETAS\">Completed by:</td>
    <td>" . $row_incident['completed_by'] . "</td>
  </tr>
    

</table>
<p>
<p>";
 

mail($emailadd, $subject, $text, $cabeceras);
echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL='.$url.'">';


mysql_free_result($incident);
?>
