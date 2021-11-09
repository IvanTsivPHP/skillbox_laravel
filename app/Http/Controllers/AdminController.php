<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function feedback()
    {
        $feedback = Feedback::latest()->get();
        return view('admin.feedback', compact('feedback'));
    }
}
