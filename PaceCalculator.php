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


  /**
   *
   * @param $distance metres or miles
   * @param $pace min/km or min/mile
   */
  public function getTime($distance, $pace, $type=self::METRIC) {

    $this->distance = $distance;
    $this->pace = self::paceToMetresPerSeconds($pace, $type);

    if ($type == self::IMPERIAL) {
      $this->distance *= self::MILE; // convert miles to metres
    }

    $this->time = $this->distance / $this->pace;

    return self::formatTime($this->time);
  }


  /**
   *
   * @param $pace min/km or min/mile
   * @param $time hh.mm.ss
   */
  public function getDistance($pace, $time, $type=self::METRIC, $precision=0) {

    $this->time = self::timeToSeconds($time);
    $this->pace = self::paceToMetresPerSeconds($pace, $type);

    // get the distance
    $this->distance = $this->pace * $this->time;

    if ($type == self::IMPERIAL) {
      // convert back to miles
      $precision = 4; //default precision
      $this->distance = $this->distance / self::MILE;
    }
    return self::roundValue($this->distance, $precision);
  }


  /**
   * returns min/km or min/mile
   * @param $distance metres or miles
   * @param $time hh.mm.ss
   */
  public function getPace($distance, $time, $type=self::METRIC, $precision=2) {
    $this->distance = $distance;
    if ($type == self::IMPERIAL) {
      $this->distance *= self::MILE;
    }
    $this->time = self::timeToSeconds($time);

    $this->pace = $this->distance / $this->time; // metres/sec
    $this->pace *= self::SECS_IN_MIN; // metres/min

    if ($type == self::IMPERIAL) {
      $this->pace = $this->pace / self::MILE; // mile / min
    }
    else {
      $this->pace = $this->pace / self::KM; // km / min
    }


    $this->pace = 1 / $this->pace; // min/km, min/mile

    // convert to seconds
    $seconds = $this->pace * self::SECS_IN_MIN;

    return self::formatTime($seconds);
  }


  /**
   * Assume in standard format
   * @param $time hh.mm.ss
   */
  public function timeToSeconds($time) {
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
   * Format of min/km input
   * Convert to m/s
   * @param unknown_type $pace
   */
  public function paceToMetresPerSeconds($pace, $type=self::METRIC, $precision=0) {
    //
    $unit_distance = ($type == self::IMPERIAL) ? self::MILE : self::KM;

    $pace = self::timeToSeconds($pace);
    $pace = $pace / $unit_distance;
    $pace = (1/$pace);

    if ($precision) {
      $pace = round($pace, $precision);
    }

    return $pace;
  }


  /**
   * Convert time to human readable format
   * @param $seconds
   */
  public function formatTime($seconds) {

    $hours = floor($seconds / self::SECS_IN_HOUR);
    $mins = floor(($seconds - ($hours * self::SECS_IN_HOUR)) / self::SECS_IN_MIN);

    // round rather than floor to get nearest round number
    $secs = round($seconds - ($hours * 3600) - ($mins * self::SECS_IN_MIN), 0);

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