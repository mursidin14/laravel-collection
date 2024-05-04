<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SlicingTest extends TestCase
{
    public function testSlice()
    {
        $collection = collect([1, 2, 3, 4, 5]);
        $result = $collection->slice(2);

        $this->assertEqualsCanonicalizing([3, 4, 5], $result->all());

        $result2 = $collection->slice(3, 2);
        $this->assertEqualsCanonicalizing([4, 5], $result2->all());
    }

    public function testTake()
    {
        $collection = collect([1, 2, 3, 4, 5]);
        $result = $collection->take(4);
        $this->assertEqualsCanonicalizing([1, 2, 3, 4], $result->all());

        $result = $collection->takeUntil(function($value, $key) {
            return $value == 2;
        });
        $this->assertEqualsCanonicalizing([1], $result->all());

        $result = $collection->takeWhile(function($value, $key) {
            return $value < 4;
        });
        $this->assertEqualsCanonicalizing([1, 2, 3], $result->all());

    }

    public function testSkip()
    {
        $collection = collect([1, 2, 3, 4, 5]);
        $result = $collection->skip(3);
        $this->assertEqualsCanonicalizing([4, 5], $result->all());

        $result = $collection->skipUntil(function($value, $key) {
            return $value == 2;
        });
        $this->assertEqualsCanonicalizing([2, 3, 4, 5], $result->all());

        $result = $collection->skipWhile(function($value, $key) {
            return $value < 4;
        });
        $this->assertEqualsCanonicalizing([4, 5], $result->all());

    }

    public function testChunk()
    {
        $collection = collect([1, 2, 3, 4, 5, 6]);
        $result = $collection->chunk(3);

        $this->assertEqualsCanonicalizing([1, 2, 3], $result->all()[0]->all());
        $this->assertEqualsCanonicalizing([4, 5, 6], $result->all()[1]->all());

    }

    public function testFirst()
    {
        $collection = collect([1, 2, 3, 4, 5]);
        $result = $collection->first();
        $this->assertEquals(1, $result);

        $result = $collection->first(function($value, $key) {
            return $value > 4;
        });
        $this->assertEquals(5, $result);
    }

    public function testLast()
    {
        $collection = collect([1, 2, 3, 4, 5]);
        $result = $collection->last();
        $this->assertEquals(5, $result);

        $result = $collection->last(function($value, $key) {
            return $value > 3;
        });
        $this->assertEquals(5, $result);
    }

}
