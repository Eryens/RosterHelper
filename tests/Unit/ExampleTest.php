<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $data = [10, 20, 30];
        $result = array_sum($data);
        $this->assertEquals(60, $result);

        $this->assertTrue(true);
    }
}
