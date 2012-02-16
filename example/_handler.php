<?php
include '_functions.php';

// do some data checking
// check numeric values are numeric
// do conversions before firing off to the pace calculator
$time = $_GET['hrs'] . '.' . $_GET['mins'] . '.' . $_GET['secs'];
$distance = ($_GET['length']) ? $_GET['length'] : $_GET['common_length'];
$pace = $_GET['pace_hrs'] . '.' . $_GET['pace_mins'] . '.' . $_GET['pace_secs'];
$pace_type = $_GET['pace_type'];

$form_values = array(
  'time' => $time,
  'distance' => $distance,
  'pace' => $pace,
  'pace_type' => $pace_type,
);


$validate = array(
  'hrs' => array(
    'validate_function' => 'check_int',
    'error' => 'Time hrs must be a round number',
  ),
  'mins' => array(
    'validate_function' => 'check_int',
    'error' => 'Time mins must be a round number',
  ),
  'secs' => array(
    'validate_function' => 'check_int',
    'error' => 'Time seconds must be a round number',
  ),
  'length' => array(
    'validate_function' => 'check_numeric',
    'error' => 'Length must be numeric',
  ),
  'pace_hrs' => array(
    'validate_function' => 'check_int',
    'error' => 'Pace hrs must be a round number',
  ),
  'pace_mins' => array(
    'validate_function' => 'check_int',
    'error' => 'Pace mins must be a round number',
  ),
  'pace_secs' => array(
    'validate_function' => 'check_int',
    'error' => 'Pace secs must be a round number',
  ),
);

$ERRORS = validate_form($validate, $_GET);
print_r($ERRORS);

