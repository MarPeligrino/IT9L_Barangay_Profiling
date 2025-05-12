<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\Address;
use App\Models\BarangayEmployee;
use App\Models\Business;

class DashboardController extends Controller
{


    public function index()
    {
        return view('dashboard', [
            'residentsCount' => Resident::count(),
            'addressCount' => Address::count(),
            'employeeCount' => BarangayEmployee::count(),
            'businessCount' => Business::count(),
        ]);
    }

}
