<?php require_once('../../Connections/security.php'); ?>
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

mysql_select_db($database_security, $security);
$query_loc = "SELECT * FROM locations ORDER BY location ASC";
$loc = mysql_query($query_loc, $security) or die(mysql_error());
$row_loc = mysql_fetch_assoc($loc);
$totalRows_loc = mysql_num_rows($loc);
  

//connect to the database 
$connect = mysql_connect("localhost","root","targus25"); 
mysql_select_db("allameri",$connect); //select the table 
// 

if ($_FILES[csv][size] > 0) { 

    //get the csv file 
    $file = $_FILES[csv][tmp_name]; 
    $handle = fopen($file,"r"); 
     
    //loop through the csv file and insert into database 
    do { 
        if ($data[0]) { 
            mysql_query("INSERT INTO tbl_fingerprint (id_loc, names, id_emp, date_finger) VALUES 
                ( 
                    '".addslashes($data[0]). "', 
                    '".addslashes($data[1])."', 
					'".addslashes($data[2])."',
                    '".addslashes($data[3])."' 
                ) 
            ");
        } 
    } while ($data = fgetcsv($handle,1000,",","'")); 
    // 

    //redirect 
    header('Location: import.php?success=1'); die; 

} 

?> 
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
<title>Import from fingerprint devices - All American</title> 
<link href="../../css/styles.css" rel="stylesheet" type="text/css" />
</head> 

<body> 

<p>
  <?php if (!empty($_GET[success])) { echo "<b>Your file has been imported.</b><br><br>"; } //generic success notice ?>
<span class="Titles"> Import data from Fingerprint devices. </span></p>
<table width="400" border="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <table width="524" border="1" align="center">
  <tr>
    <td width="256">Please select the location:</td>
    <td width="256"><label>
      <select name="select_location" id="select_location">
        <?php
do {  
?>
        <option value="<?php echo $row_loc['loc_id']?>"><?php echo $row_loc['location']?></option>
        <?php
} while ($row_loc = mysql_fetch_assoc($loc));
  $rows = mysql_num_rows($loc);
  if($rows > 0) {
      mysql_data_seek($loc, 0);
	  $row_loc = mysql_fetch_assoc($loc);
  }
?>
      </select>
    </label></td>
  </tr>
  <tr>
    <td>Choose your file: </td>
    <td><input name="csv" type="file" id="csv" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="Submit" value="Submit" /></td>
  </tr>
</table>

  <br />
</form> 

</body> 
</html>
<?php
mysql_free_result($loc);
?>
