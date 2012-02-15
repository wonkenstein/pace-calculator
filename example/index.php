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
        <fieldset id="type">
          <legend>Type of calculation</legend>

          <label for="calculator-type-pace">
            <input type="radio" id="calculator-type-pace" name="calculator-type" value="pace" />
            Pace
          </label>
          <label for="calculator-type-distance">
            <input type="radio" id="calculator-type-distance" name="calculator-type" value="distance" />
            Distance
          </label>
          <label for="calculator-type-time">
            <input type="radio" id="calculator-type-time" name="calculator-type" value="time" />
            Time
          </label>
        </fieldset>


        <fieldset id="time">
          <legend>Time</legend>
          <div class="form-element">
            <label for="hrs">Hours</label>
            <input type="number" min="0" id="hrs" name="hrs" value="" />
          </div>
          <div class="form-element">
            <label for="mins">Mins</label>
            <input type="number" min="0" max="60" id="mins" name="mins" value="" />
          </div>
          <div class="form-element">
            <label for="secs">Secs</label>
            <input type="number" min="0" max="60" id="secs" name="secs" value="" />
          </div>
        </fieldset>

        <fieldset id="distance">
          <legend>Distance</legend>
          <div class="form-element">
            <label for="length">Length</label>
            <input type="text" id="length" name="length" />
          </div>
          <div class="form-element">
            <label for="common-lengths">Common distances</label>
            <select id="common-lengths" name="common_length">
              <option value="marathon">Marathon</option>
              <option value="half-marathon">Half Marathon</option>
              <option value="1km">1km</option>
              <option value="5km">5km</option>
              <option value="10km">10km</option>
              <option value="1mile">1 mile</option>
              <option value="5miles">5 miles</option>
              <option value="10miles">10 miles</option>
            </select>
          </div>
        </fieldset>

        <fieldset id="pace">
          <legend>Pace</legend>
          <div class="form-element">
            <label for="pace-hrs">Hours</label>
            <input type="number" min="0" id="pace-hrs" name="pace_hrs" />
          </div>
          <div class="form-element">
            <label for="pace_mins">Mins</label>
            <input type="number" min="0" max="60" id="pace-mins" name="pace_mins" />
          </div>
          <div class="form-element">
            <label for="pace_secs">Secs</label>
            <input type="number" min="0" max="60" id="pace-secs" name="pace_secs" />
          </div>

          <fieldset id="pace-type">
            <legend>Pace Type</legend>

            <label for="pace-type-mile">
              <input type="radio" id="pace-type-mile" name="pace_type" value="mile" />
              min/mile
            </label>
            <label for="pace-type-km">
              <input type="radio" id="pace-type-km" name="pace_type" value="km" />
              min/km
            </label>
          </fieldset>
        </fieldset>

        <input type="submit" name="submit" value="Calculate" />


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