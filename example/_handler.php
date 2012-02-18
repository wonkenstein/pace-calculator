<?php
include 'Form.php';
$ERRORS = array();
$form = new Form();

if (count($_GET)) {

  $keys = array(
    'hrs', 'mins', 'secs',
    'length', 'common_length',
    'pace_hrs', 'pace_mins', 'pace_secs',
    'pace_type',
  );

  $form->init($keys, $_GET);

  // do some data checking
  // check numeric values are numeric
  // do conversions before firing off to the pace calculator
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


  $validate_config = array(
    'hrs' => array(
      'validate_function' => 'checkInt',
      'error' => 'Time hrs must be a round number',
    ),
    'mins' => array(
      'validate_function' => 'checkInt',
      'error' => 'Time mins must be a round number',
    ),
    'secs' => array(
      'validate_function' => 'checkInt',
      'error' => 'Time seconds must be a round number',
    ),
    'length' => array(
      'validate_function' => 'checkNumeric',
      'error' => 'Length must be numeric',
    ),
    'pace_hrs' => array(
      'validate_function' => 'checkInt',
      'error' => 'Pace hrs must be a round number',
    ),
    'pace_mins' => array(
      'validate_function' => 'checkInt',
      'error' => 'Pace mins must be a round number',
    ),
    'pace_secs' => array(
      'validate_function' => 'checkInt',
      'error' => 'Pace secs must be a round number',
    ),
  );


  if ($pace_type == 'pace') {
    // different validators
    //$validate = a;
  }
  else if ($pace_type == 'distance') {

  }
  else if ($pace_type == 'time') {

  }

  $validate = $validate_config;


  $form->validate($validate);
  //$ERRORS = validate_form($validate, $_GET);
  //print_r($ERRORS);
}
