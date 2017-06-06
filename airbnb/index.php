<?php


echo "Hello World";

$url="https://api.airbnb.com/v2/search_results?client_id=3092nxybyb0otqw18e8nh5nty&location=london&_limit=5";


//  Initiate curl
$ch = curl_init();
// Disable SSL verification
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
curl_setopt($ch, CURLOPT_URL,$url);
// Execute
$result=curl_exec($ch);
// Closing
curl_close($ch);

$result = json_decode($result, true);

// Will dump a beauty json :3
echo "<pre>";
print_r($result['search_results']);
echo "<pre>";

 ?>
