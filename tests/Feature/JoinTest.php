<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JoinTest extends TestCase
{
    public function testJoin()
    {
        $collection = collect(['Moch', 'Reva', 'Amirullah']);

        $this->assertEquals('Moch-Reva-Amirullah', $collection->join("-"));
        $this->assertEquals('Moch-Reva_Amirullah', $collection->join('-', '_'));
        $this->assertEquals('Moch Reva and Amirullah', $collection->join(' ', ' and '));
    }
}
