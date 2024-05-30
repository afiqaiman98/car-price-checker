<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function getMakes(Request $request)
    {
        $query = Car::query();

        if ($request->has('price_min') && $request->has('price_max')) {
            $query->whereBetween('price', [$request->price_min, $request->price_max]);
        }

        $makes = $query->select('make')->distinct()->get();
        return response()->json($makes);
    }

    public function getYears(Request $request)
    {
        $query = Car::where('make', $request->make);

        if ($request->has('price_min') && $request->has('price_max')) {
            $query->whereBetween('price', [$request->price_min, $request->price_max]);
        }

        $years = $query->select('year')->distinct()->get();
        return response()->json($years);
    }

    public function getModels(Request $request)
    {
        $query = Car::where('make', $request->make)->where('year', $request->year);

        if ($request->has('price_min') && $request->has('price_max')) {
            $query->whereBetween('price', [$request->price_min, $request->price_max]);
        }

        $models = $query->select('model')->distinct()->get();
        return response()->json($models);
    }

    public function getVariants(Request $request)
    {
        $query = Car::where('make', $request->make)
            ->where('year', $request->year)
            ->where('model', $request->model);

        if ($request->has('price_min') && $request->has('price_max')) {
            $query->whereBetween('price', [$request->price_min, $request->price_max]);
        }

        $variants = $query->select('variant')->distinct()->get();
        return response()->json($variants);
    }

    public function getPrice(Request $request)
    {
        $car = Car::where('make', $request->make)
            ->where('year', $request->year)
            ->where('model', $request->model)
            ->where('variant', $request->variant)
            ->first();

        return response()->json(['price' => $car->price]);
    }

    //extra page
    public function filterByPrice(Request $request)
    {
        $price_min = $request->price_min;
        $price_max = $request->price_max;

        $cars = Car::whereBetween('price', [$price_min, $price_max])->get();
        return response()->json($cars);
    }
}
