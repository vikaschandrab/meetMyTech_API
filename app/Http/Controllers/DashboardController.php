<?php

namespace App\Http\Controllers;

use App\Http\Requests\DashboardRequest;
use App\Services\DashboardService;
use App\Services\LoggingService;
use App\Traits\DashboardTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class DashboardController extends Controller
{
    use DashboardTrait;

    protected $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->middleware('auth');
        $this->dashboardService = $dashboardService;
    }

    /**
     * Display the dashboard page
     */
    public function index(DashboardRequest $request)
    {
        try {
            LoggingService::logDashboard('dashboard_view', 'User viewed dashboard page');

            // Get dashboard statistics
            $dashboardStats = $this->dashboardService->getDashboardStats();

            // Get additional data for charts
            $browserStats = $this->dashboardService->getBrowserStats();
            $worldMapData = $this->dashboardService->getWorldMapData();

            // Format the data for the view
            $data = [
                'stats' => $dashboardStats,
                'browserStats' => $browserStats,
                'worldMapData' => $worldMapData,
                'chartColors' => $this->getChartColors(),
                'user' => Auth::user()
            ];

            return view('Users.Pages.dashboard', $data);
        } catch (Exception $e) {
            LoggingService::logError($e, 'dashboard', [
                'action' => 'dashboard_load_failed'
            ]);
            return back()->with('error', 'Unable to load dashboard data. Please try again.');
        }
    }

    /**
     * Get dashboard data via AJAX
     */
    public function getData(DashboardRequest $request)
    {
        try {
            $filters = $this->validateDashboardFilters($request->all());

            $data = [
                'stats' => $this->dashboardService->getDashboardStats(),
                'browserStats' => $this->dashboardService->getBrowserStats(),
                'period' => $filters['period']
            ];

            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unable to fetch dashboard data.'
            ], 500);
        }
    }
}
