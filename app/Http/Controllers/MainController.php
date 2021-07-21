<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class MainController extends Controller
{
   public function about()
   {
       return view('about');
   }

   public function contacts()
   {
       return view('contacts');
   }

   public function sendFeedback(Request $request)
   {
       $this->validate($request, [
           'email' => 'required|email',
           'message' => 'required|max:225'
       ]);

       $feedback = new Feedback();

       $feedback->email = $request['email'];
       $feedback->message = $request['message'];

       $feedback->save();

       return redirect('/');
   }
}
