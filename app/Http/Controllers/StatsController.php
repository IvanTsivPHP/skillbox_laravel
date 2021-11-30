<?php

namespace App\Http\Controllers;

use App\Services\StatisticsService;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index(StatisticsService $statisticsService)
    {
        $stats = $statisticsService->run();

        return view('stats.index', compact('stats'));
    }
}

