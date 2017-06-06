<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <title>Rove Away - Prototype</title>

    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">

  </head>

  <body>


    <div class="container">

      <h1>Rove Away</h1>

      <button class="ui button right">
        <a href="index.php">Try again</a>
      </button>

    <?php
        include "skyscanner/config/config.php";
        include "weather/config.php";

        // 1. GET Form Values
          // 1.1 IATA - AIRPORT CODE
          $iata = (isset($_POST['iata']) && preg_match('/^[A-Z]{3}$/', $_POST['iata'])) ? $_POST['iata'].'-iata' : 'anywhere';

          // 1.2 DEPARTURE DATE
          if ( isset($_POST['dep_date']) ) {
            $dep_date = str_replace("/", "-", $_POST['dep_date']);
          } else {
            $dep_date = 'anytime';
          }

          // 1.3 RETURNING DATE
          if ( isset($_POST['ret_date']) ) {
            $ret_date = str_replace("/", "-", $_POST['ret_date']);
          } else {
            $ret_date = "";
          }

          // 1.4 NO OF PEOPLE
          if ( isset($_POST['ppl']) ) {
            $ppl = str_replace("/", "-", $_POST['ppl']);
          } else {
            $ppl = "1";
          }


        // 2. URL
        $sUri = "{$sk_browser_url}{$iata}/anywhere/{$dep_date}/{$ret_date}?apikey={$sk_api_key}";

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


        include "skyscanner/views/cached_flights.php";
    ?>

  </div>


    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="semantic/dist/semantic.min.js"></script>

  </body>

</html>
