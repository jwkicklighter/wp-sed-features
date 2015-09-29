<?php

class SEDF_Chapter_Test extends WP_UnitTestCase {

	function test_sample() {
		// replace this with some actual testing code
		$this->assertTrue( true );
	}

	function test_class_exists() {
		$this->assertTrue( class_exists( 'SEDF_Chapter') );
	}

	function test_class_access() {
		$this->assertTrue( sed_features()->chapter instanceof SEDF_Chapter );
	}

  function test_cpt_exists() {
    $this->assertTrue( post_type_exists( 'sedf-chapter' ) );
  }
}
