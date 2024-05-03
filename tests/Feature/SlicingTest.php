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

}
