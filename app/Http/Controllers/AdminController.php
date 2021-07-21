<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function feedback()
    {
        $feedback = Feedback::latest()->get();
        return view('admin.feedback', compact('feedback'));
    }
}
