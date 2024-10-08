<?php
$data = array(
    'type' => 'fetch-ads',
    'api_key' => 'selfieera-ads'
);
 //header("Content-Type: application/json; charset=UTF-8");
// Prepare new cURL resource
$ch = curl_init('http://ads.selfieera.com/ads-api/ads/');
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // allow redirects 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data); 
// Store curl result
$result = curl_exec($ch);
 
// Close cURL session handle
curl_close($ch);
echo $result;

?>