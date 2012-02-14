<?php

class PaceCalculator {
  const IMPERIAL = 1;
  const METRIC = 2;
  const MILE = 1609.344; // meters
  const KM = 1000; // meters
  const SECS_IN_MIN = 60; // secs
  const SECS_IN_HOUR = 3600; // 60 * 60
  const SECS_IN_DAY = 86400; // 60 * 60 * 24

  // property declaration
  public $pace = 0;
  public $distance = 0;
  public $time = 0;

  /**
   *
   * @param unknown_type $distance
   * @param unknown_type $pace
   */
  public function getTime($distance, $pace, $type=self::METRIC) {

    $this->distance = $distance;
    $this->pace = self::paceToMetresPerSeconds($pace, $type);

    if ($type == self::IMPERIAL) {
      $this->distance = self::milesToMetres($this->distance);
    }

    $this->time = $this->distance / $this->pace;

    return self::formatTime($this->time);
  }


  /**
   *
   * @param unknown_type $pace
   * @param unknown_type $time
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
   *
   * @param unknown_type $distance
   * @param unknown_type $time
   */
  public function getPace($distance, $time, $precision) {
    $this->distance = $distance;
    $this->time = self::timeToSeconds($time);

    $this->pace = $this->distance / $this->time;
    return round($this->pace, 2);
  }


  /**
   * Assume in format of hh.mm.ss or hh:mm:ss
   * @param unknown_type $time
   */
  public function timeToSeconds($time) {
    $time = array_reverse(explode('.', $time));

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
   * Format of min/km
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
   *
   * @param unknown_type $miles
   */
  public function milesToMetres($miles) {
    $metres = $miles * self::MILE;
    return $metres;
  }


  /**
   *
   * @param unknown_type $seconds
   */
  public function formatTime($seconds) {

    $format = 'U';
    $seconds = round($seconds,0);
    $date1 = DateTime::createFromFormat($format, 0);
    $date2 = DateTime::createFromFormat($format, $seconds);

    $interval = $date2->diff($date1);

    if ($seconds > self::SECS_IN_HOUR) {
      $time = $interval->format('%h.%i.%s');
    }
    else {
      $time = $interval->format('%i.%s');
    }

    return $time;
  }


  private function roundValue($value, $precision) {
    return round($value, $precision);
  }
}