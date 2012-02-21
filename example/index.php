<?php include '_handler.php'; ?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Pace Calculator</title>
  <meta name="description" content="">

  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/main.css">

  <script src="js/libs/modernizr-2.5.2.min.js"></script>
</head>
<body>

  <div id="wrapper">
    <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

    <header>
      <h1>Pace Calculator</h1>
    </header>

    <div id="main" role="main">

      <form id="pace-calculator">
        <?php
        if (count($form->errors)) {
          echo '<ul class="message form-error"><li>' . implode('</li><li>', array_values($form->errors)) . '</li></ul>';
        }

        //print_r($form->errors);
        ?>

        <fieldset id="type" class="<?php echo $form->errorClass('calculator-type') ?>">
          <legend>Type of calculation</legend>

            <input type="radio" id="calculator-type-pace" name="calculator-type" value="pace" <?php echo $form->getValue('calculator-type', 'pace'); ?> />
          <label for="calculator-type-pace">
            Pace
          </label>
          <label for="calculator-type-distance">
            <input type="radio" id="calculator-type-distance" name="calculator-type" value="distance" <?php echo $form->getValue('calculator-type', 'distance'); ?> />
            Distance
          </label>
          <label for="calculator-type-time">
            <input type="radio" id="calculator-type-time" name="calculator-type" value="time" <?php echo $form->getValue('calculator-type', 'time'); ?> />
            Time
          </label>
        </fieldset>

        <fieldset id="distance-type">
            <legend>Measurement</legend>
            <label for="measurement">
              <input type="radio" id="measurement-imperial" name="measurement" value="imperial" <?php echo $form->getValue('measurement', 'imperial'); ?> />
              Imperial (miles, miles/min)
            </label>
            <label for="distance-type-km">
              <input type="radio" id="measurement-metric" name="measurement" value="metric" <?php echo $form->getValue('measurement', 'metric'); ?> />
              Metric (km, km/min)
            </label>
          </fieldset>


        <fieldset id="time" class="variables">
          <legend>Time</legend>
          <div class="form-element <?php echo $form->errorClass('hrs') ?>">
            <label for="hrs">Hours</label>
            <input type="number" min="0" id="hrs" name="hrs" <?php echo $form->getValue('hrs'); ?> />
          </div>
          <div class="form-element <?php echo $form->errorClass('mins') ?>">
            <label for="mins">Mins</label>
            <input type="number" min="0" max="60" id="mins" name="mins" <?php echo $form->getValue('mins'); ?> />
          </div>
          <div class="form-element <?php echo $form->errorClass('secs') ?>">
            <label for="secs">Secs</label>
            <input type="number" min="0" max="60" id="secs" name="secs" <?php echo $form->getValue('secs'); ?> />
          </div>
        </fieldset>

        <fieldset id="distance" class="variables">
          <legend>Distance</legend>
          <div class="form-element <?php echo $form->errorClass('length') ?>">
            <label for="length">Length</label>
            <input type="text" id="length" name="length" <?php echo $form->getValue('length'); ?> />
          </div>

          <div class="form-element">
            <label for="common-lengths">Common distances</label>
            <select id="common-lengths" name="common_length">
              <option value="marathon" <?php echo $form->getValue('common_length', 'marathon', TRUE); ?>>Marathon</option>
              <option value="half-marathon" <?php echo $form->getValue('common_length', 'half-marathon', TRUE); ?>>Half Marathon</option>
              <option value="1km" <?php echo $form->getValue('common_length', '1km', TRUE); ?>>1km</option>
              <option value="5km" <?php echo $form->getValue('common_length', '5km', TRUE); ?>>5km</option>
              <option value="10km" <?php echo $form->getValue('common_length', '10km', TRUE); ?>>10km</option>
              <option value="1mile" <?php echo $form->getValue('common_length', '1mile', TRUE); ?>>1 mile</option>
              <option value="5miles" <?php echo $form->getValue('common_length', '5miles', TRUE); ?>>5 miles</option>
              <option value="10miles" <?php echo $form->getValue('common_length', '10miles', TRUE); ?>>10 miles</option>
            </select>
          </div>
        </fieldset>

        <fieldset id="pace" class="variables">
          <legend>Pace</legend>
          <div class="form-element <?php echo $form->errorClass('pace_hrs') ?>">
            <label for="pace-hrs">Hours</label>
            <input type="number" min="0" id="pace-hrs" name="pace_hrs" <?php echo $form->getValue('pace_hrs'); ?> />
          </div>
          <div class="form-element <?php echo $form->errorClass('pace_mins') ?>">
            <label for="pace_mins">Mins</label>
            <input type="number" min="0" max="60" id="pace-mins" name="pace_mins" <?php echo $form->getValue('pace_mins'); ?> />
          </div>
          <div class="form-element <?php echo $form->errorClass('pace_secs') ?>">
            <label for="pace_secs">Secs</label>
            <input type="number" min="0" max="60" id="pace-secs" name="pace_secs" <?php echo $form->getValue('pace_secs'); ?> />
          </div>

        </fieldset>

        <div class="submit-button">
          <input type="submit" name="submit" value="Calculate" />
        </div>


      </form>


    <footer>
      FOOTER
    </footer>

    </div>


  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>

  <script src="js/plugins.js"></script>
  <script src="js/script.js"></script>

  </body>
</html>