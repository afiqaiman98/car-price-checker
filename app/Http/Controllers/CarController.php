<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function index()
    {
        return view('car.index');
    }

    public function price()
    {
        return view('car.price-filter');
    }
}
