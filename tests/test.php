<?php
require_once('../../simpletest/autorun.php');
require_once('../PaceCalculator.php');

class TestOfPaceCalculator extends UnitTestCase {

  /**
   *
   */
  function testOne() {
    //$paceCalculator = new PaceCalculator();
    $this->assertTrue(TRUE);
    //$this->assertTrue(FALSE);
    //$this->assertFalse(TRUE);
    $this->assertFalse(FALSE);
  }


  /**
   *
   */
  function testCalculateDistance() {
    $distance_tests = array(
      array('5.0', '0.25.0', 5, PaceCalculator::METRIC), // 5min/km, 25mins 5k
      array('4.15', '45.0', 10.5882, PaceCalculator::METRIC), //
      array('4.45', '47.30', 10.0000, PaceCalculator::METRIC), // 45mins, 8min/mile, 9.03k
      array('8.0', '45.30', 5.6875, PaceCalculator::IMPERIAL), // 45mins, 8min/mile, 9.03k
      array('5.14', '31.26', 6.01, PaceCalculator::METRIC, 2), //
      array('8.25', '31.26', 3.73, PaceCalculator::IMPERIAL, 2), //
      array('4.54', '31.41', 6.47, PaceCalculator::METRIC, 2), //
      array('4.55', '1.44.58', 21.35, PaceCalculator::METRIC, 2), //
      array('7.54', '1.44.53', 13.28, PaceCalculator::IMPERIAL, 2), //
    );

    foreach ($distance_tests as $test) {
      $values = array(
        'pace' => $test[0],
        'time' => $test[1],
      );

      $paceCalculator = new PaceCalculator($values, $test[3]);
      $paceCalculator->calculate();

      if (isset($test[4])) {
        $this->assertEqual($test[2], $paceCalculator->getDistance($test[4]));
      }
      else {
        $this->assertEqual($test[2], $paceCalculator->getDistance());
      }
    }
  }


  /**
   *
   */
  function testCalculatePace() {
    $tests = array(
      array('5', '0.25.0', '5.0', PaceCalculator::METRIC), // 5min/km, 25mins 5k
      array('10.5882', '45.0', '4.15', PaceCalculator::METRIC), //
      array('10', '47.30', '4.45', PaceCalculator::METRIC), // 45mins, 8min/mile, 9.03k
      array('5.6875', '45.30', '8.0', PaceCalculator::IMPERIAL), // 45mins, 8min/mile, 9.03k
      array('6.01', '31.26', '5.14', PaceCalculator::METRIC, 2), //
      array('3.734', '31.26', '8.25', PaceCalculator::IMPERIAL, 2), //
      array('6.47', '31.41', '4.54', PaceCalculator::METRIC, 2), //
      array('21.35', '1.44.58', '4.55', PaceCalculator::METRIC, 2), //
      array('13.28', '1.44.53', '7.54', PaceCalculator::IMPERIAL, 2), //

    );

    foreach ($tests as $test) {
      $values = array(
        'distance' => $test[0],
        'time' => $test[1],
      );

      $paceCalculator = new PaceCalculator($values, $test[3]);
      $paceCalculator->calculate();

      if (isset($test[4])) {
        $this->assertEqual($test[2], $paceCalculator->getPace($test[4]));
      }
      else {
        $this->assertEqual($test[2], $paceCalculator->getPace());
      }
    }
  }


  /**
   *
   */
  function testCalculateTime() {
    $tests = array(
        array('5', '5.0', '25.0', PaceCalculator::METRIC), // 5min/km, 25mins 5k
        array('10.5882', '4.15', '45.0', PaceCalculator::METRIC), //
        array('10', '4.45', '47.30', PaceCalculator::METRIC), // 45mins, 8min/mile, 9.03k
        array('5.6875', '8.0','45.30', PaceCalculator::IMPERIAL), // 45mins, 8min/mile, 9.03k
        array('6.005', '5.14', '31.26', PaceCalculator::METRIC, 2), //
        array('3.734', '8.25', '31.26', PaceCalculator::IMPERIAL, 2), //
        array('6.465', '4.54', '31.41', PaceCalculator::METRIC, 2), //
        array('21.35', '4.55', '1.44.58', PaceCalculator::METRIC, 2), //
        array('13.277', '7.54', '1.44.53', PaceCalculator::IMPERIAL, 2), //
    );

    foreach ($tests as $test) {
      $values = array(
          'distance' => $test[0],
          'pace' => $test[1],
      );

      $paceCalculator = new PaceCalculator($values, $test[3]);
      $paceCalculator->calculate();


      $this->assertEqual($test[2], $paceCalculator->getTime());

    }
  }

}
