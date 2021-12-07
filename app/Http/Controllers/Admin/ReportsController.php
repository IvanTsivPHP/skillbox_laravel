<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\SendStatisticsReport;
use App\Models\User;
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

    public function make()
    {

        SendStatisticsReport::dispatch(User::where('id', Auth::id())->first()->email, $_GET);

        return redirect()->route('admin')->with(['message' => 'Запрос успешно отправлен']);
    }
}
