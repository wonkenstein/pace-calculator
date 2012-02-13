<?php
require_once('../../simpletest/autorun.php');
require_once('../PaceCalculator.php');


class TestOfPaceCalculator extends UnitTestCase {

  function testOne() {
    $paceCalculator = new PaceCalculator();
    $this->assertTrue(TRUE);
    //$this->assertTrue(FALSE);
    //$this->assertFalse(TRUE);
    $this->assertFalse(FALSE);

  }


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


  function xtestConvertPace() {
    $paceCalculator = new PaceCalculator();
    $distance;
    $testcases = array(
      // mins, pace, distance
      array(25, 5, 5), // 25mins, 5min/km, 5k
      array(45, 4.15, 10.59), // 25mins, 8min/mile, 5.03k
      array(47.30, 4.45, 10), // 45mins, 8min/mile, 9.03k
    );

    foreach ($testcases as $case) {
      $distance = $paceCalculator->getDistance($case[0], $case[1]);
      $this->assertEqual($case[2], $distance);
    }
  }

  /**
   *
   */
  function testPaceToMetresPerSeconds() {
    $paceCalculator = new PaceCalculator();

    $testcases = array(
      array('5.00', 3.333), // 5.00 mins/km
      array('4.00', 4.167), // 4 mins/km
      array('4.30', 3.704), // 4.30 /km
      array('3.54', 4.274), // 3.54 / km
    );

    foreach ($testcases as $case) {
      $pace = $paceCalculator->paceToMetresPerSeconds($case[0]);
      $this->assertEqual($case[1], $pace);
    }
  }

  /**
   *
   */
  function testMilePaceToMetresPerSeconds() {
    $paceCalculator = new PaceCalculator();

    $testcases = array(
        array('8.00', 3.353), // 5.00 mins/km
        array('7.45', 3.461), // 4 mins/km
        array('7.0', 3.832), // 4.30 /km
        array('6.54', 3.887), // 3.54 / km
    );

    foreach ($testcases as $case) {
      $pace = $paceCalculator->milePaceToMetresPerSeconds($case[0]);
      $this->assertEqual($case[1], $pace);
    }
  }


  function xtestGetDistance() {
    $paceCalculator = new PaceCalculator();
    $distance;
    $testcases = array(
      // mins, pace, distance
      array('0.25', '5', 5), // 25mins, 5min/km, 5k
      array('45.0', '4.15', 10.59), // 25mins, 8min/mile, 5.03k
      array('47.30', '4.45', 10), // 45mins, 8min/mile, 9.03k
    );

    foreach ($testcases as $case) {
      $distance = $paceCalculator->getDistance($case[0], $case[1]);
      $this->assertEqual($case[2], $distance);
    }

  }
}
