<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function welcome()
    {
     

    $userId = session('user_id');

    // Fetch user data from the database
    $user = DB::table('user_info')->where('id', $userId)->first();

    // Check if user data is found
    if (!$user) {
        // Handle the case where the user is not found (optional)
        return redirect('login')->with('error', 'User not found.');
    }

    // Pass the user data to the view
    return view('welcome', ['user' => $user]);
}


}