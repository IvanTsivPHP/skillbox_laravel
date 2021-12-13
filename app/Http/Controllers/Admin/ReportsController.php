<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StatRequest;
use App\Jobs\SendStatisticsReport;
use App\Models\User;
use Database\Factories\StatRequestFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','admin']);
    }

    public function index()
    {
        return view('admin.reports');
    }

    public function make(StatRequest $request)
    {
        $stats = $request->stats;
        $coll = StatRequestFactory::new($stats);
        SendStatisticsReport::dispatch(User::where('id', Auth::id())->first()->email, $coll->make());

        return redirect()->route('admin')->with(['message' => 'Запрос успешно отправлен']);
    }
}
