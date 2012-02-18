<?php

class Form {

  public $values;
  public $errors;


  /**
   *
   */
  function __construct() {
    $this->values = array();
    $this->errors = array();
  }


  /**
   *
   * @param unknown_type $keys
   * @param unknown_type $array
   */
  public function presetArray($keys, &$array) {
    foreach ($keys as $k) {
      if (!isset($array[$k])) {
        $array[$k] = '';
      }
    }
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
  function getValue($key, $values, $check_value='', $select=FALSE) {
    if (!isset($values[$key])) {
      return;
    }

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
  function validate($validate) {
    $error = array();

    foreach ($validate as $k => $v) {

      $methods = array($this,$v['validate_function']);
      $args = array($this->values[$k]);
      $ret = call_user_func_array($methods, $args);

      if (!$ret) {
        $this->errors[$k] = $v['error'];
      }
    }
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

}


