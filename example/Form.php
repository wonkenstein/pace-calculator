<?php

class Form {

  public $values;
  public $errors;
  public $validation;

  /**
   *
   */
  function __construct() {
    $this->values = array();
    $this->errors = array();
    $this->validation = array();
  }

  /**
   *
   * @param unknown_type $keys
   * @param unknown_type $array
   */
  public function init($keys, $values) {
    foreach ($keys as $k) {
      if (!isset($values[$k])) {
        $this->values[$k] = '';
      }
      else {
        $this->values[$k] = $values[$k];
      }
    }
  }


  /**
   * Pretty awful looking function to get cvalues from form
   * @param unknown_type $key
   * @param unknown_type $values
   * @param unknown_type $is_checked_value
   * @param unknown_type $selected_type
   */
  function getValue($key, $check_value='', $select=FALSE) {
    $values = $this->values;
    //echo __METHOD__;
    //print_r($values);
    //echo __METHOD__, '::',  $check_value, '-', $values[$key], "\n";

    if (!isset($values[$key])) {
      return;
    }
    //echo __METHOD__, '::',  $check_value, '::', $values[$key];
    if ($check_value) {
      if (is_array($values[$key])) {
        if (in_array($check_value, $values[$key])) {
          if ($select) {
            return 'selected="selected"';
          }
          else {
            return 'checked="checked"';
          }
        }
      }
      else if ($check_value == $values[$key]) {

        if ($select) {
          return 'selected="selected"';
        }
        else {
          return 'checked="checked"';
        }
      }
    }
    else {
      return 'value="' . $values[$key] . '"';
    }
  }


  /**
   *
   * @param unknown_type $key
   * @param unknown_type $errors
   * @return string
   */
  function errorClass($key) {

    if (!empty($this->errors[$key])) {
      return 'form-error';
    }
  }


  /**
   *
   * @param unknown_type $validate
   * @param unknown_type $values
   * @return multitype:unknown
   */
  function validate() {

    foreach ($this->validation as $k => $v) {

      $methods = array($this,$v['validate_function']);
      $args = array($this->values[$k]);
      $ret = call_user_func_array($methods, $args);

      if (!$ret) {
        $this->errors[$k] = $v['error'];
      }
    }
    //print_r($this->errors);

    if (!count($this->errors)) {
      return TRUE;
    }
    return FALSE;
  }


  /**
   *
   * @param unknown_type $value
   */
  function checkInt($value){
    return is_numeric($value) && (round($value) == $value);
  }


  /**
   *
   * @param unknown_type $value
   */
  function checkNumeric($value){
    return is_numeric($value);
  }

  /**
   *
   * @param unknown_type $value
   */
  function checkNonEmpty($value){
    $value = (string)$value;
    return ($value != '');
  }

}


class PaceCalculatorForm extends Form {

  private $validate_config = array(
      'calculator-type' => array(
          'validate_function' => 'checkNonEmpty',
          'error' => 'Choose calculation type',
      ),
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

  function __construct() {
    parent::__construct();
  }

  function init($keys, $values) {
    parent::init($keys, $values);

    //print_r($this->values);
    // set the validation
    $calculator_type = $this->values['calculator-type'];
    $validation_fields = array('calculator-type');
    $extra_validation_fields = array();

    // different validation depending on choice of calculator
    // php bug so have to add '' as first array element when += array?
    if ($calculator_type == 'pace') {
      $validation_fields += array('', 'hrs', 'mins', 'secs', 'length');
    }
    else if ($calculator_type == 'distance') {
      $validation_fields += array('', 'hrs', 'mins', 'secs', 'pace_hrs', 'pace_mins', 'pace_secs');
    }
    else if ($calculator_type == 'time') {
      $validation_fields += array('', 'pace_hrs', 'pace_mins', 'pace_secs', 'length');
    }

//    if (count($extra_validation_fields)) {
      //$validation_fields = array_merge($validation_fields, $extra_validation_fields);
//    }

    foreach ($validation_fields as $i => $field) {
      $this->validation[$field] = $this->validate_config[$field];
    }

    //$validate = $validate_config;

  }
}


