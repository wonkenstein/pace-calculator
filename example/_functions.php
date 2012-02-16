<?php
/**
 *
 * @param unknown_type $value
 */
function check_int($value){
  return is_numeric($value) && (round($value) == $value);
}


/**
 *
 * @param unknown_type $value
 */
function check_numeric($value){
  return is_numeric($value);
}


/**
 *
 * @param unknown_type $validate
 * @param unknown_type $values
 * @return multitype:unknown
 */
function validate_form($validate, $values) {
  $error = array();

  foreach ($validate as $k => $v) {
    echo $v['validate_function'], ' ', $values[$k] , '<br />';
    $ret = call_user_func($v['validate_function'], $values[$k]);


    if (!$ret) {
      $error[$k] = $v['error'];
    }
  }

  return $error;
}


/**
 * Pretty awful looking function to get cvalues from form
 * @param unknown_type $key
 * @param unknown_type $values
 * @param unknown_type $is_checked_value
 * @param unknown_type $selected_type
 */
function form_get_value($key, $values, $check_value='', $select=FALSE) {
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


function form_error_class($key, $errors) {
  //print_r($errors);
  if (!empty($errors[$key])) {
    return 'form-error';
  }
}