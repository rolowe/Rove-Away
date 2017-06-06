<?php
    include "../config/config.php";

    // 1. GET Form Values
    $iata = (isset($_POST['iata']) && preg_match('/^[A-Z]{3}$/', $_POST['iata'])) ? $_POST['iata'].'-iata' : 'anywhere';
    $dep_date = (isset($_POST['date']) && preg_match('/^\d{4}\-\d{2}\-\d{2}$/', $_POST['date'])) ? $_POST['date'] : 'anytime';

    // 2. URL
    $sUri = "{$sk_browser_url}{$iata}/anywhere/{$dep_date}?apikey={$sk_api_key}";
 
    // 3. Query
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $sUri);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);
    $json = curl_exec($ch);
    curl_close($ch);

    // 4. attempt to parse
    if (($oResult = json_decode($json)) === null)
    {
        trigger_error("Something went wrong. Sorry.");
        exit(500);
    }

    // 5. Cache Carriers
    $aoCarrier = [];
    foreach ($oResult->Carriers AS $oCarrier)
    {
        $aoCarrier[$oCarrier->CarrierId] = $oCarrier;
    }

    // 6. Cache Places
    $aoPlace = [];
    foreach ($oResult->Places AS $oPlace)
    {
        $aoPlace[$oPlace->PlaceId] = $oPlace;
    }

    // 7. Results
    $sDest = str_replace('-iata', '', $iata);
    if (count($oResult->Quotes) > 0)
    {
        $sDest = $aoPlace[$oResult->Quotes[0]->OutboundLeg->OriginId]->Name;
    }

    // 8. sort on ascending price
    usort($oResult->Quotes, function($oA, $oB)
    {
        return ($oB->MinPrice === $oA->MinPrice) ? 0 : ($oB->MinPrice < $oA->MinPrice ? 1 : -1);
    });

    //print_r($oResult);


    include "../views/cached_flights.php";
?>
