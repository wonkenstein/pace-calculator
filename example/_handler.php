<?php
include 'Form.php';
include '../PaceCalculator.php';
$form = new PaceCalculatorForm();



if (!count($_GET)) {
  // set defaults
  $form->values['calculator-type'] = 'pace';
  $form->values['measurement'] = 'metric';

}
else{

  echo '<!-- ' . print_r($_GET, 1). ' -->';

  $keys = array(
    'calculator-type',
    'measurement',
    'hrs', 'mins', 'secs',
    'length', 'common_length', 'distance_type',
    'pace_hrs', 'pace_mins', 'pace_secs', 'pace_type',
  );

  $form->init($keys, $_GET);

  if ($valid = $form->validate()) {
    $time = $form->values['hrs'] . '.' . $form->values['mins'] . '.' . $form->values['secs'];
    $distance = ($form->values['length']) ? $form->values['length'] : $form->values['common_length'];
    $pace = $form->values['pace_hrs'] . '.' . $form->values['pace_mins'] . '.' . $form->values['pace_secs'];
    $pace_type = $form->values['pace_type'];

    $values = array(
        'time' => $time,
        'distance' => $distance * 1000,
        'pace' => $pace,
        'pace_type' => $pace_type,
    );

    // should push all this into PaceCalculatorForm?
    // so $form->calculate();
    $calc = new PaceCalculator();

    if ($form->values['calculator-type'] == 'pace') {
      $pace = $calc->calculatePace($values['distance'], $values['time']);
    }
    else if ($pace_type == 'distance') {

    }
    else if ($pace_type == 'time') {

    }
  }
}

