<?php

use App\WPNonces\WPNonces;

class Nonce_Tests extends WP_UnitTestCase {

	var $action = 'a-nonce-action';
	var $name   = 'a-nonce-request-name';
        
        /**
	 * Check correct URL with get_nonce_url()
	 **/
	function test_nonce_url() {
		$url = home_url();
		$nonce = new WPNonces();

		$generated_url = $nonce->get_nonce_url( $url );
		$expected_url = home_url() . '?_wpnonce=' . $nonce->create_nonce();

		$this->assertEquals( $generated_url, $expected_url );
	}
        
        
        /**
	 * Check get_field() returns the expected HTML string
	 **/
	function test_nonce_field() {
		$expected_html = wp_nonce_field( $this->action, $this->name, false, false );
		$nonce = new WPNonces();
		$html = $nonce->get_nonce_field( $this->action, $this->name, false, false );

		$this->assertEquals( $html, $expected_html );
	}
        
        
        /**
	 * Check if get_nonce() returns the expected nonce
	 **/
	public function test_create_nonce() {
		$nonce = new WPNonces();
		$get_nonce = $nonce->create_nonce( $this->action );
    	
		$expected_nonce = wp_create_nonce( $this->action );

		$this->assertEquals( $get_nonce, $expected_nonce );
	}
        
        
        /**
	 * Check if check_nonce_request() works
	 **/
	function test_php_request() {
		$nonce = new WPNonces();
		$get_nonce = $nonce->create_nonce();
		
		//No nonce send, did work.
		$worked = $nonce->check_nonce_request( $this->name, $this->action, function() {} );
		$this->assertTrue( $worked );

		$_REQUEST[ $this->name ] = $get_nonce;

		//Correct nonce send, did work.
		$worked = $nonce->check_nonce_request( $this->name, $this->action, function() {} );
		$this->assertTrue( $worked );

		$_REQUEST[ $this->name ] = $get_nonce . '-failed';

		//Wrong nonce send, failed.
		$failed = $nonce->check_nonce_request( $this->name, $this->action, function() {} );
		$this->assertFalse( $failed );

	}
        
        
        /**
	 * Check get_nonce_age()
	 **/
	public function test_verify_nonce_field() {
		$nonce = new WPNonces();
		$get_nonce = $nonce->create_nonce();

		$valid = $nonce->wp_verify_nonce_field( $get_nonce );
		$this->assertEquals( $valid, 1 );
	}
        
        
}