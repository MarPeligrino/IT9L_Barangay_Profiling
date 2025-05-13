use Illuminate\Support\Facades\DB;

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
