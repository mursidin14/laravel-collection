<?php

namespace Tests\Feature;

use App\Data\Person;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MappingTest extends TestCase
{
   public function testMap()
   {
    $collection = collect([1, 2, 3]);
    $result = $collection->map(function ($item) {
        return $item * 2;
    });
    $this->assertEquals([2, 4, 6], $result->all());
   }

   public function testMapInto()
   {
        $collection = collect(["Eko"]);
        $result = $collection->mapInto(Person::class);
        $this->assertEquals([ new Person("Eko")], $result->all());
   }

   public function testMapSpreat()
   {
        $collection = collect([['Arif', 'Rahman'], ['Reva', 'Amirullah']]);
        $result = $collection->mapSpread( function ($firstName, $lastName) {
            $fullName = $firstName . " " . $lastName;
            return new Person($fullName);
        });

        $this->assertEquals([
            new Person('Arif Rahman'),
            new Person('Reva Amirullah')
        ], $result->all());
   }

   public function testMapToGroup()
   {
        $collection = collect([
                [
                    'name' => 'Mursidin',
                    'departement' => 'IT'
                ],
                [
                    'name' => 'Adriawan',
                    'departement' => 'Agama'
                ],
                [
                    'name' => 'Abra',
                    'departement' => 'IT'
                ],
                [
                    'name' => 'fandi',
                    'departement' => 'Asrama'
                ]
            ]);
        $result = $collection->mapToGroups(function ($item) {
            return [$item['departement'] => $item['name']];
        });
        $this->assertEquals([
            'IT' => collect(['Mursidin', 'Abra']),
            'Agama' => collect(['Adriawan']),
            'Asrama' => collect(['fandi'])
        ], $result->all());

   }
}
