<?php
use PHPUnit\Framework\TestCase;

class PluginTest extends TestCase {
    public function test_plugin_file_exists() {
        $this->assertFileExists(dirname(__DIR__) . '/stoneflow.php');
    }

    public function test_phpunit_runs() {
        $this->assertTrue(true);
    }

    public function test_functions_loaded() {
        $expected = [
            'stoneflow_display_admin_message',
            'stoneflow_set_flash_message',
            'stoneflow_display_flash_message',
            'stoneflow_save_admin_note',
            'stoneflow_get_admin_notes',
            'stoneflow_display_client_dashboard',
            'stoneflow_admin_dashboard',
            'stoneflow_get_client_profile',
            'stoneflow_update_client_profile',
        ];

        foreach ( $expected as $fn ) {
            $this->assertTrue( function_exists( $fn ), "Function {$fn} should be defined" );
        }
    }
}
