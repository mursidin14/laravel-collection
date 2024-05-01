<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GroupingTest extends TestCase
{
    public function testGrouping()
    {
        $collection = collect([
                [
                    'name' => 'ari',
                    'departement' => 'IT'
                ],
                [
                    'name' => 'doni',
                    'departement' => 'HR'
                ],
                [
                    'name' => 'boy',
                    'departement' => 'IT'
                ]
            ]);
        $result = $collection->groupBy('departement');
        $this->assertEquals([
            'IT' => collect([
                    [
                        'name' => 'ari',
                        'departement' => 'IT'
                    ],
                    [
                        'name' => 'boy',
                        'departement' => 'IT'
                    ]
                ]),
             'HR' => collect([
                    [
                        'name' => 'doni',
                        'departement' => 'HR'
                    ]
                 ])
                ], $result->all());

        $this->assertEquals([
           'IT' => collect([
                    [
                        'name' => 'ari',
                        'departement' => 'IT'
                    ],
                    [
                        'name' => 'boy',
                        'departement' => 'IT'
                    ]
                ]),
            'HR' => collect([
                    [
                        'name' => 'doni',
                        'departement' => 'HR'
                    ]
                ])
            ], $collection->groupBy(function($value, $key) {
                return $value['departement'];
            })->all());
    }
}
