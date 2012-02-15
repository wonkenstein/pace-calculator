<?php
require_once('../../simpletest/autorun.php');
require_once('../PaceCalculator.php');

class TestOfPaceCalculator extends UnitTestCase {

  /**
   *
   */
  function testOne() {
    $paceCalculator = new PaceCalculator();
    $this->assertTrue(TRUE);
    //$this->assertTrue(FALSE);
    //$this->assertFalse(TRUE);
    $this->assertFalse(FALSE);

  }


  /**
   *
   */
  function testTimeToSeconds() {
    $paceCalculator = new PaceCalculator();

    $testcases = array(
      // time, seconds
      array('1.24', 84), // 84 secs
      array('45.24', 2724), // 84 secs
      array('05.24', 324), // 84 secs
      array('05.04', 304), // 84 secs
      array('0.05.04', 304), // 1hr, 3 mins,
      array('0.27', 27), // 27 secs
      array('0.09', 9), // 9 secs
      array('0.0.09', 9), // 9 secs
      array('1.03.34', 3814), // 1hr, 3 mins,
      array('1.3.34', 3814), // 1hr, 3 mins,

    );

    foreach ($testcases as $case) {
      $seconds = $paceCalculator->timeToSeconds($case[0]);
      $this->assertEqual($case[1], $seconds);
    }
  }


  /**
   *
   */
  function testPaceToMetresPerSeconds() {
    $paceCalculator = new PaceCalculator();

    $testcases = array(
      array('5.00', 3.333, PaceCalculator::METRIC), // 5.00 mins/km
      array('4.00', 4.167, PaceCalculator::METRIC), // 4 mins/km
      array('4.30', 3.704, PaceCalculator::METRIC), // 4.30 /km
      array('3.54', 4.274, PaceCalculator::METRIC), // 3.54 / km

      array('8.00', 3.353, PaceCalculator::IMPERIAL), // 5.00 mins/km
      array('7.45', 3.461, PaceCalculator::IMPERIAL), // 4 mins/km
      array('7.0', 3.832, PaceCalculator::IMPERIAL), // 4.30 /km
      array('6.54', 3.887, PaceCalculator::IMPERIAL), // 3.54 / km
    );

    $precision = 3;
    foreach ($testcases as $case) {
      $pace = $paceCalculator->paceToMetresPerSeconds($case[0], $case[2], $precision);
      $this->assertEqual($case[1], $pace);
    }
  }


  /**
   *
   */
  function testGetDistance() {
    $paceCalculator = new PaceCalculator();

    $testcases = array(
      // mins, pace, distance
      array('5.0', '0.25.0', 5000, PaceCalculator::METRIC), // 5min/km, 25mins 5k
      array('4.15', '45.0', 10588, PaceCalculator::METRIC), //
      array('4.45', '47.30', 10000, PaceCalculator::METRIC), // 45mins, 8min/mile, 9.03k
      array('8.0', '45.30', 5.6875, PaceCalculator::IMPERIAL), // 45mins, 8min/mile, 9.03k
    );

    foreach ($testcases as $case) {
      $distance = $paceCalculator->getDistance($case[0], $case[1], $case[3]);
      $this->assertEqual($case[2], $distance);
    }
  }


  /**
   *
   */
  function testGetTime() {
    $paceCalculator = new PaceCalculator();

    $testcases = array(
    // mins, pace, distance
        array('10000', '4.45', '47.30', PaceCalculator::METRIC), // 5min/km, 25mins 5k
        array('21097.5', '5.0', '1.45.29', PaceCalculator::METRIC), //
        array('5000', '4.11', '20.55', PaceCalculator::METRIC), // 45mins, 8min/mile, 9.03k
        array('13.109375', '8.0', '1.44.53', PaceCalculator::IMPERIAL), // 45mins, 8min/mile, 9.03k
        array('10', '7.33', '1.15.30', PaceCalculator::IMPERIAL), // 45mins, 8min/mile, 9.03k
    );

    foreach ($testcases as $case) {
      $time = $paceCalculator->getTime($case[0], $case[1], $case[3]);
      $this->assertEqual($case[2], $time);
    }
  }


  /**
   *
   */
  function testGetPace() {
    $paceCalculator = new PaceCalculator();

    $testcases = array(
    // mins, pace, distance
        array('10000', '45.00', '4.30', PaceCalculator::METRIC), // 5min/km, 25mins 5k
        array('5000', '22.25', '4.29', PaceCalculator::METRIC), //
        array('10000', '42.37', '4.16', PaceCalculator::METRIC), //
        array('13.109375', '1.42.21', '7.48', PaceCalculator::IMPERIAL), //
        array('10', '1.15.21', '7.32', PaceCalculator::IMPERIAL), //
    );

    foreach ($testcases as $case) {
      $time = $paceCalculator->getPace($case[0], $case[1], $case[3]);
      $this->assertEqual($case[2], $time);
    }
  }
}
