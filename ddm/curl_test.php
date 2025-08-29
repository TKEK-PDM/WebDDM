<?php
$url = "http://example.com/";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo "cURL Error: " . curl_error($ch);
} else {
    echo "HTTP Response OK: " . strlen($response) . " bytes received.";
}

curl_close($ch);
?>