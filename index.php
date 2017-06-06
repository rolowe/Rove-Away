<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <title>Rove Away - Prototype</title>

    <link rel="stylesheet" type="text/css" href="semantic/dist/semantic.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/lib/datepicker/default.css">
    <link rel="stylesheet" type="text/css" href="assets/css/lib/datepicker/default.date.css">

    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
  </head>

  <body>

    <div class="container">

      <?php include "weather/config.php"; ?>

      <h1>Rove Away</h1>

      <?php
          if (isset($_GET['search']))
          {
              include_once "skyscanner/functions/_search.php";
          }
          else
          {
              include_once "skyscanner/forms/_form.php";
          }
      ?>

    </div>


    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="semantic/dist/semantic.min.js"></script>

    <script src="assets/js/lib/picker.js"></script>
    <script src="assets/js/lib/picker.date.js"></script>
    <script src="assets/js/lib/picker.time.js"></script>

    <script src="assets/js/form_elements.js"></script>

  </body>

</html>
