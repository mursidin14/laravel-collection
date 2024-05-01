<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ZipTest extends TestCase
{
    public function testZip()
    {
        $collection1 = collect([1, 2, 3]);
        $collection2 = collect([4, 5, 6]);
        $result = $collection1->zip($collection2);

        $this->assertEquals([
            collect([1, 4]),
            collect([2, 5]),
            collect([3, 6])
        ], $result->all());
    }

    public function testZipConcet()
    {
        $collection1 = collect(['Mursidin']);
        $collection2 = collect(['Reva']);
        $result = $collection1->concat($collection2);

        $this->assertEquals(['Mursidin', 'Reva'], $result->all());
    }

    public function testCombine()
    {
        $collection1 = collect(['Indomie']);
        $collection2 = collect(['Indomilk']);
        $result = $collection1->combine($collection2);

        $this->assertEquals([
            'Indomie' => 'Indomilk',
        ], $result->all());
    }
}
