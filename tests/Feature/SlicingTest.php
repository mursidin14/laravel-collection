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

}
