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
  public function getTime($distance, $pace) {
    $this->distance = $distance;
    $this->pace = $pace;

    $this->time = $this->distance / $this->pace;
    return round($this->time, 2);
  }


  /**
   *
   * @param unknown_type $pace
   * @param unknown_type $time
   */
  public function getDistance($pace, $time, $precision=0) {
    $this->pace = self::paceToMetresPerSeconds($pace);
    $this->time = self::timeToSeconds($time);

    $this->distance = $this->pace * $this->time;
    return self::roundValue($this->distance, $precision);
  }


  /**
   *
   * @param unknown_type $distance
   * @param unknown_type $time
   */
  public function getPace($distance, $time) {
    $this->distance = $distance;
    $this->time = $time;

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
  public function paceToMetresPerSeconds($pace, $precision=0) {
    //
    $pace = self::timeToSeconds($pace);
    $pace = $pace / 1000;
    $pace = (1/$pace);

    if ($precision) {
      $pace = round($pace, $precision);
    }

    return $pace;
  }


  /**
   * Format of min/mile
   * Convert to m/s
   * @param unknown_type $pace
   */
  public function milePaceToMetresPerSeconds($pace, $precision=0) {
    //
    $pace = self::timeToSeconds($pace);
    $pace = $pace / self::MILE;
    $pace = (1/$pace);
    if ($precision) {
      $pace = round($pace, $precision);
    }
    return $pace;
  }


  /**
   * pace expected to be in format mm.ss/km
   * Convert to metres/sec
   * @param unknown_type $pace
   */
  public function convertPace($pace, $type=METRIC) {
    if ($type == METRIC) {
      // pace = mins/km

    }

  }


  function roundValue($value, $precision) {
    return round($value, $precision);
  }
}