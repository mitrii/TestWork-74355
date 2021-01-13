<?php

namespace Tests\Feature;

use App\Models\Car;
use Database\Factories\CarFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CarsTest extends TestCase
{

    use RefreshDatabase;
    use WithFaker;


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index()
    {
        $this->refreshDatabase();

        Car::factory(10)->create();

        $response = $this->get('/api/car');

        $response
            ->assertStatus(200)
            ->assertJsonCount(10);

    }

    public function test_store()
    {
        $response = $this->postJson('/api/car', Car::factory()->definition());


        $response
            ->assertStatus(201)
            ->assertJsonStructure([
                    'id',
                    'manufacturer',
                    'model',
                    'color',
                    'seatsCount',
            ]);
    }

    public function test_store_validation()
    {
        $response = $this->postJson('/api/car', [
            'manufacturer' => null,
            'model' => null,
            'color' => null,
            'seatsCount' => $this->faker->asciify()
        ]);

        $response->assertStatus(422);
    }

    public function test_show()
    {
        $car = Car::factory()->createOne();

        $response = $this->getJson('/api/car/' . $car->getAttribute('id'));

        $response
            ->assertStatus(200)
            ->assertSimilarJson( $car->attributesToArray());
    }

    public function test_update()
    {
        $car = Car::factory()->createOne();
        $newDefinition = Car::factory()->definition();

        $response = $this->patchJson('/api/car/' . $car->getAttribute('id'), $newDefinition);

        $response
            ->assertStatus(200)
            ->assertJsonFragment($newDefinition);
    }

    public function test_destroy()
    {
        $car = Car::factory()->createOne();
        $response = $this->deleteJson('/api/car/' . $car->getAttribute('id'));

        $response->assertStatus(204);
    }
}
