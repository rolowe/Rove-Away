
<h2>
  Travelling from <?=$sDest;?> to anywhere, leaving <?=date('M jS, Y', strtotime($dep_date)); ?>
  <?php if ($ret_date != "") { ?>
    , returning <?=date('M jS, Y', strtotime($ret_date)); ?>
  <?php } ?>
</h2>

<table class="ui celled striped table">
  <thead>
    <tr>
      <th>Destination</th>
      <th>Departing</th>
      <?php if ($ret_date != "") { ?>
        <th>Returning</th>
      <?php } ?>
      <th>Weather</th>
      <th>Price from <i>(per person)</i></th>
      <th>Carrier</th>
      <th></th>
    </tr>
  </thead>
  <tbody>

    <?php foreach ($oResult->Quotes AS $oQuote): ?>

      <tr>
        <td class="collapsing">
          <small><?=$sDest; ?> to</small><br>
          <?=$aoPlace[$oQuote->OutboundLeg->DestinationId]->Name; ?>
        </td>
        <td>
          <?=date('M jS, Y', strtotime($oQuote->OutboundLeg->DepartureDate)); ?>
        </td>
        <?php if ($ret_date != "") { ?>
          <td>
            <?=date('M jS, Y', strtotime($oQuote->InboundLeg->DepartureDate)); ?>
          </td>
        <?php } ?>
        <td>
          <?php getWeather( $aoPlace[$oQuote->OutboundLeg->DestinationId]->Name ); ?>
        </td>
        <td>
          £<?=$oQuote->MinPrice;?>
        </td>
        <td class="collapsing">
          <?php foreach ($oQuote->OutboundLeg->CarrierIds AS $iCarrier): ?>
              <?=$aoCarrier[$iCarrier]->Name; ?><br>
          <?php endforeach; ?>
        </td>
        <td>
          <a href="skyscanner/functions/_start-live-session.php?originplace=<?= $iata; ?>&destinationplace=<?= $aoPlace[$oQuote->OutboundLeg->DestinationId]->IataCode; ?>&outbounddate=<?= $dep_date; ?>">More info</a>
        </td>
      </tr>
    <?php endforeach; ?>

  </tbody>
</table>
