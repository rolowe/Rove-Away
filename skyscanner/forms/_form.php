

<form action="results" method="POST" id="cache_flights">

  <div class="quarter">

    <select id="iata" name="iata" class="ui search dropdown">
      <option value="">Select Airport</option>
      <option value="LHR">London Heathrow</option>
      <option value="LGW">London Gatwick</option>
      <option value="MAN">Manchester</option>
      <option value="STN">London Stansted</option>
      <option value="LTN">London Luton</option>
      <option value="EDI">Edinburgh</option>
      <option value="BHX">Birmingham</option>
      <option value="GLA">Glasgow</option>
      <option value="BRS">Bristol</option>
      <option value="LPL">Liverpool John Lennon</option>
      <option value="NCL">Newcastle</option>
      <option value="BFS">Belfast</option>
      <option value="EMA">East Midlands</option>
      <option value="ABZ">Aberdeen</option>
      <option value="LCY">London City</option>
      <option value="LBA">Leeds Bradford</option>
      <option value="BHD">Belfast City George Best</option>
      <option value="SOU">Southampton</option>
      <option value="JER">Jersey</option>
      <option value="PIK">Glasgow</option>
      <option value="CWL">Cardiff</option>
      <option value="BOH">Bournemouth</option>
    </select>

  </div>
  <div class="quarter">

    <input type="date" id="dep_date" name="dep_date" class="datepicker fieldset__input  picker__input" placeholder="Leaving?">
    <br />
    <small style="padding-left:15px;">(or leave blank for any date)</small>

  </div>
  <div class="quarter">

    <input type="date" id="ret_date" name="ret_date" class="datepicker fieldset__input  picker__input" placeholder="Coming home?">
    <br />
    <small style="padding-left:15px;">(or leave blank to not specify)</small>

  </div>
  <div class="quarter">

    <select id="ppl" name="ppl" class="ui search dropdown">
      <option value="">How many?</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      <option value="9">9</option>
      <option value="10">10</option>
      <option value="11">11</option>
      <option value="12">12</option>
    </select>

  </div>

  <button type="submit" class="ui primary button">Rove!</button>

</form>
