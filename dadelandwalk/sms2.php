<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"http://textbelt.com/text");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,"number=3054015393&message=test&from=luis leon");
curl_exec ($ch);
curl_close ($ch); 
?>