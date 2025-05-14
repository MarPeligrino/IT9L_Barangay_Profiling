<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Resident;
use App\Models\Address;
use App\Models\BarangayEmployee;
use App\Models\Business;
<<<<<<< HEAD
use App\Models\FamilyRole;
use App\Models\BarangayPosition;
use App\Models\BusinessType;
use App\Models\BusinessPermit;
use App\Models\PermitTransaction;
=======
use App\Models\BusinessType;
use App\Models\BusinessPermit;
use App\Models\PermitTransaction;
use App\Models\FamilyRole;
use App\Models\BarangayPosition;
>>>>>>> fix-auth
use App\Models\RecentActivity;

class DashboardController extends Controller
{
    public function index()
    {
        // Monthly trends
        $residentTrends = Resident::selectRaw("DATE_FORMAT(created_at, '%b %Y') as month, COUNT(*) as count")
            ->groupBy('month')
            ->orderByRaw("MIN(created_at)")
            ->get();

        $permitTrends = BusinessPermit::selectRaw("DATE_FORMAT(created_at, '%b %Y') as month, COUNT(*) as count")
            ->groupBy('month')
            ->orderByRaw("MIN(created_at)")
            ->get();

        return view('dashboard', [
            'residentsCount'      => Resident::count(),
            'addressCount'        => Address::count(),
            'employeeCount'       => BarangayEmployee::count(),
            'businessCount'       => Business::count(),
            'roleCount'           => FamilyRole::count(),
            'positionCount'       => BarangayPosition::count(),
            'businessTypeCount'   => BusinessType::count(),
            'permitCount'         => BusinessPermit::count(),
            'transactionCount'    => PermitTransaction::count(),
            'recentActivities'    => RecentActivity::latest()->take(5)->get(),
            'residentTrends'      => $residentTrends,
            'permitTrends'        => $permitTrends,
        ]);
    }
}
