<?php
class NonceCapabilityTest extends WP_UnitTestCase {

	public function setUp(): void {
		parent::setUp();
		$this->admin_id = self::factory()->user->create( [ 'role' => 'administrator' ] );
	}

	/** Client submission should pass for admin with good nonce */
	public function test_admin_with_good_nonce_passes() {
		wp_set_current_user( $this->admin_id );
                $nonce = wp_create_nonce( 'stoneflow_add_client' );
                $this->assertNotFalse( wp_verify_nonce( $nonce, 'stoneflow_add_client' ) );
	}

	/** Missing nonce must fail */
	public function test_missing_nonce_fails() {
		wp_set_current_user( $this->admin_id );
		$this->assertFalse( wp_verify_nonce( '', 'stoneflow_add_client' ) );
	}

	/** Non-admin should not have permission */
	public function test_non_admin_blocked() {
		$user_id = self::factory()->user->create(); // subscriber
		wp_set_current_user( $user_id );
		$this->assertFalse( current_user_can( 'manage_options' ) );
	}
}
