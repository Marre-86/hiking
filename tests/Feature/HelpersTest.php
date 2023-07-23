<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HelpersTest extends TestCase
{
    public function testGetDefaultName()
    {
        $this->assertEquals('Night activity', getDefaultName('2023-07-24 03:00:00'));
        $this->assertEquals('Morning activity', getDefaultName('2023-07-24 08:00:00'));
        $this->assertEquals('Afternoon activity', getDefaultName('2023-07-24 15:00:00'));
        $this->assertEquals('Evening activity', getDefaultName('2023-07-24 19:00:00'));
        $this->assertEquals('Night activity', getDefaultName('2023-07-24 23:00:00'));
    }
}
