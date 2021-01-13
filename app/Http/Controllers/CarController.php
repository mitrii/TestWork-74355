<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Models\Car;
use App\Services\CarService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CarController extends Controller
{
    /**
     * @var CarService
     */
    private CarService $carService;

    public function __construct(CarService $carService)
    {
        $this->carService = $carService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->carService->getAll();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CarRequest $request
     * @return Response
     */
    public function store(CarRequest $request)
    {
        return $this->carService->saveData($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param Car $car
     */
    public function show(Car $car)
    {
        return $car;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CarRequest $request
     * @param Car $car
     * @return Response
     */
    public function update(CarRequest $request, Car $car)
    {
        return $this->carService->update($request->except(['id']), $car);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Car $car
     * @return Response
     */
    public function destroy(Car $car)
    {
        if ($this->carService->destroy($car)) {
            return response(null, 204);
        }

        return response(null, 400);
    }
}
