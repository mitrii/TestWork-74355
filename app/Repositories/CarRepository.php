<?php

namespace App\Repositories;

use App\Models\Car;

class CarRepository
{
    /**
     * @var Car
     */
    protected Car $car;

    public function __construct(Car $car)
    {
        $this->car = $car;
    }

    public function save(array $data): Car
    {
        return $this->car->create($data);
    }

    /**
     * @return Car[]
     */
    public function getAll()
    {
        return $this->car->get();
    }

    public function get(Car $car)
    {
        return $this->car->findOrFail($car);
    }

    public function update(array $data, Car $car)
    {
        $car->fill($data);
        $car->save();

        return $car;
    }

    public function delete(Car $car)
    {
        return $car->delete();
    }

}
