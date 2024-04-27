<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CollectionTest extends TestCase
{
    public function testCollection()
    {
        $collection = collect([1, 2, 3]);
        $this->assertEqualsCanonicalizing([1, 2, 3], $collection->all());
    }

    public function testForeach()
    {
        $collection = collect([1, 2, 3, 4, 5, 6]);
        foreach($collection as $key => $value) {
            self::assertEquals($key + 1, $value);
        }
    }
}
