<?php
use PHPUnit\Framework\TestCase;

class PluginTest extends TestCase {
    public function test_plugin_file_exists() {
        $this->assertFileExists(dirname(__DIR__) . '/stoneflow.php');
    }

    public function test_phpunit_runs() {
        $this->assertTrue(true);
    }
}
