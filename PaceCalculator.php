<?php

class PaceCalculator {

  const IMPERIAL = 1;
  const METRIC = 2;
  const MILE = 1609.344; // meters
  const KM = 1000; // meters
  const SECS_IN_MIN = 60; // secs
  const SECS_IN_HOUR = 3600; // 60 * 60
  const SECS_IN_DAY = 86400; // 60 * 60 * 24
  const TIME_DELIMITER = '.';

  // property declaration
  public $pace = 0;
  public $distance = 0;
  public $time = 0;
  public $units = '';


  /**
   * Should only set 2 of 3
   * If metric:
   *   pace should be min/km
   *   distance should be km
   *   time should be hh:mm:ss
   * If imperial
   *   pace should be min/mile
   *   distance should be miles
   *   time should be hh:mm:ss
   */
  public function __construct($values=array(), $units=self::METRIC) {

    $this->units = $units;

    if (isset($values['time'])) {
      $this->time = self::timeToSeconds($values['time']);
    }
    if (isset($values['pace'])) {
      $this->pace = self::paceToMetresPerSeconds($values['pace']);
    }
    if (isset($values['distance'])) {
      $this->distance = self::distanceToMetres($values['distance']);
    }

    //print_r($this);
  }

  /**
   *
   */
  public function calculate() {

    if ($this->distance && $this->time && !$this->pace) {
      self::calculatePace();
    }
    else if ($this->time && $this->pace && !$this->distance) {
      self::calculateDistance();
    }
    else if ($this->pace && $this->distance && !$this->time) {
      self::calculateTime();
    }
    else {
      // no calculation!
      return false;
    }
  }


  private function calculateTime() {
    $this->time = $this->distance / $this->pace;
  }

  /**
   *
   * @param $distance metres or miles
   * @param $pace min/km or min/mile
   */
  public function getTime() {
    return self::formatTime($this->time);
  }


  /**
   *
   * @param $pace min/km or min/mile
   * @param $time hh.mm.ss
   */
  private function calculateDistance() {
    $this->distance = $this->pace * $this->time;
  }

  public function getDistance($precision=4) {
    if ($this->units == self::IMPERIAL) {
      $this->distance /= self::MILE;
    }
    else {
      $this->distance /= self::KM;
    }

    return self::roundValue($this->distance, $precision);
  }


  /**
   * returns min/km or min/mile
   * @param $distance metres or miles
   * @param $time hh.mm.ss
   */
  private function calculatePace() {
    $this->pace = $this->distance / $this->time;
  }


  /**
   * Pace is in metres/sec
   * Should be returned as km/min or miles/min as it makes more sense to people
   * @param unknown_type $precision
   */
  public function getPace($precision=0) {

    $pace = $this->pace * self::SECS_IN_MIN; // metres/min

    if ($this->units == self::IMPERIAL) {
      $pace /= self::MILE; // mile / min
    }
    else {
      $pace /= self::KM; // km / min
    }

    $pace = 1/$pace; // invert to get min/km or min/mile

    // return in mm.ss / km  or mm.ss/mile
    $secs = $pace * self::SECS_IN_MIN;
    return self::formatTime($secs);
  }


  /**
   *
   * @param unknown_type $distance
   */
  private function distanceToMetres($distance) {
    if ($this->units == self::IMPERIAL) {
      $distance *= self::MILE;
    }
    else {
      $distance *= self::KM;
    }
    return $distance;
  }


  /**
   * Assume in standard format
   * @param $time hh.mm.ss
   */
  private function timeToSeconds($time) {
    $time = array_reverse(explode(self::TIME_DELIMITER, $time));

    $secs = 0;
    foreach ($time as $i => $unit) {
      $unit = intval($unit);
      if ($i==0) {
        $secs += $unit;
      }
      else if ($i==1) {
        $secs += ($unit * self::SECS_IN_MIN);
      }
      else if ($i==2) {
        $secs += ($unit * self::SECS_IN_HOUR);
      }
      else if ($i==3) {
        $secs += ($unit * self::SECS_IN_DAY);
      }
    }

    return $secs;
  }


  /**
   *
   * @param $pace min/km or min/mile
   */
  private function paceToMetresPerSeconds($pace) {
    //
    $unit_distance = ($this->units == self::IMPERIAL) ? self::MILE : self::KM;

    $pace = self::timeToSeconds($pace); // secs/km or secs/mile
    $pace = $pace / $unit_distance;  // secs/metres
    $pace = (1/$pace); // metres/sec

    return $pace;
  }


  /**
   * Convert time to human readable format
   * @param $seconds
   */
  private function formatTime($seconds) {
//echo $seconds, '<br />';
    $seconds = round($seconds); // round to nearest second
    $hours = floor($seconds / self::SECS_IN_HOUR);

    $mins = floor(($seconds - ($hours * self::SECS_IN_HOUR)) / self::SECS_IN_MIN);

    // round rather than floor to get nearest round number
    $secs = floor($seconds - ($hours * 3600) - ($mins * self::SECS_IN_MIN));

    if ($hours) {
      $time = sprintf('%d.%02d.%02d', $hours, $mins, $secs);
    }
    else {
      $time = sprintf('%02d.%02d', $mins, $secs);
    }

    return $time;
  }


  /**
   * @param $value value to round
   * @param $precision number of decimal places
   */
  private function roundValue($value, $precision) {
    return round($value, $precision);
  }


  public function metresToMiles($distance) {
    return $distance / self::MILE;
  }

  public function milesToMetres($distance) {
    return $distance * self::MILE;
  }

}