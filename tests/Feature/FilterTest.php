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

    // partition example
    public function testPartition()
    {
        $collection = collect([
            'Ajang' => 100,
            'Ari' => 80,
            'Toni' => 90
        ]);
        [$result1, $result2] = $collection->partition(function ($item, $key) {
            return $item >= 90;
        });

        $this->assertEquals(['Ajang' => 100, 'Toni' => 90], $result1->all());
        $this->assertEquals(['Ari' => 80], $result2->all());
    }

    public function testTesting()
    {
        $collection = collect(['toni', 'arif', 'halim']);
        self::assertTrue($collection->contains('toni'));
        self::assertTrue($collection->contains(function ($value, $key) {
            return $value == 'arif';
        }));
    }
}
