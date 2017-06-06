<?php

  function getWeather($location) {

    $key = "99b3f785e9e9424ab3c212028172702";

    $location_single = explode(' ',trim($location));

    $url = "http://api.apixu.com/v1/current.json?key=$key&q=$location_single[0]&=";

    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

    $json_output=curl_exec($ch);
    $weather = json_decode($json_output);

    if ( isset($weather->error->code) ) {
      $error = $weather->error->code;
    } else {
      $error = "";
    }

    if ($error) {
      echo "<p><em>Not available</em></p>";
    } else {
  ?>

    <?php
    //  echo "<pre>";
    //  print_r($weather);
    //  echo "</pre>";
    ?>

      <?php if ( isset($weather->current->condition) ) { ?>
        <img src="<?php echo $weather->current->condition->icon; ?>" title="<?php echo $weather->current->condition->title; ?>" width="40" style="float:left;" />

        <span style="display:block;padding-top:10px;"><?php echo $weather->current->temp_c; ?> &#8451;</span>
      <?php } else { ?>
        <p><em>Not available</em></p>
      <?php } ?>

<?php  }
  }  ?>
