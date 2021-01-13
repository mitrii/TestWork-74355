<?php

namespace App\Services;

use App\Models\Car;
use App\Repositories\CarRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class CarService
{
    /**
     * @var CarRepository
     */
    private CarRepository $repository;

    public function __construct(CarRepository $repository)
    {
        $this->repository = $repository;
    }

    public function saveData(array $data): Car
    {
        $validator = Validator::make($data, [
            'manufacturer' => 'required',
            'model' => 'required',
            'seatsCount' => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        return $this->repository->save($data);
    }

    /**
     * @return Car[]
     */
    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function update(array $data, Car $car)
    {
        return $this->repository->update($data, $car);
    }

    public function destroy(Car $car)
    {
        return $this->repository->delete($car);
    }

}
