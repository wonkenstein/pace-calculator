<?php
include 'Form.php';
$ERRORS = array();
$form = new PaceCalculatorForm();

if (count($_GET)) {

  $keys = array(
    'calculator-type',
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



    $form_values = array(
        'time' => $time,
        'distance' => $distance,
        'pace' => $pace,
        'pace_type' => $pace_type,
    );
  }


}
