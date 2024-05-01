<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FlateningTest extends TestCase
{
    public function testCollapse()
    {
        $collection = collect([
            [1, 2, 3],
            [4, 5, 6],
            ['Anton', 'Mursidin']
        ]);
        $result = $collection->collapse();

        $this->assertEquals([1, 2, 3, 4, 5, 6, 'Anton', 'Mursidin'], $result->all());
    }

    public function testFlatMap()
    {
        $collection = collect([
                [
                    'name' => 'Mursidin',
                    'hobbies' => ['Gaming', 'Coding']
                ],
                [
                    'name' => 'Reva',
                    'hobbies' => ['Coding', 'Reading book']
                ]
            ]);
        $result = $collection->flatMap(function ($item) {
            return [$item['name']];
        });

        $this->assertEquals(['Mursidin', 'Reva'], $result->all());
    }
}
