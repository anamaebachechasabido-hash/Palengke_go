<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WeatherService;

class DashboardController extends Controller
{
    /**
     * Entry point after login. Redirects the user to the dashboard that
     * matches their assigned role.
     */
    public function index(Request $request)
    {
        return redirect()->route($request->user()->dashboardRoute());
    }

    public function admin(Request $request)
    {
        $weatherService = new WeatherService();
        $weather = $weatherService->fetch();

        return view('dashboards.admin', [
            'user' => $request->user(),
            'weather' => $weather,
        ]);
    }

    public function vendor(Request $request)
    {
        return view('dashboards.vendor', ['user' => $request->user()]);
    }

    public function customer(Request $request)
    {
        return view('dashboards.customer', ['user' => $request->user()]);
    }

    public function delivery(Request $request)
    {
        return view('dashboards.delivery', ['user' => $request->user()]);
    }
}
