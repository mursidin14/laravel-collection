<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FilterTest extends TestCase
{
    public function testFilter()
    {
        $collection = collect([
            'Eko' => 100,
            'Toni' => 90,
            'Ari' => 80
        ]);
        $result = $collection->filter(function ($item, $key) {
            return $item >= 90;
        });
        $this->assertEquals([
            'Eko' => 100,
            'Toni' => 90
        ], $result->all());
    }
}
