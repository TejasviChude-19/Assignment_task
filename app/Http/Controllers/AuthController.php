<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; 
use Carbon\Carbon;

class AuthController extends Controller
{
   // Show the login form
   public function loginIndex()
   {
       return view('login');
   }

   // Show the registration form
   public function registerIndex()
   {
       return view('register');
   }

   protected function authenticated(Request $request, $user)
   {
       // Redirect based on user role
       if ($user->roles === 'administrator') {
           return redirect()->route('admin.users.index'); // Redirect to Manage Users page
       } else {
           return redirect()->route('welcome.page'); // Redirect to the welcome page for other roles
       }
    }
   // Handle login request
   public function login(Request $request)
   {
       // Validate the request data
       $this->validate($request, [
            
           'name' => 'required|string',
           'password' => 'required|min:8',
       ]);

  
       

       // Fetch user from the database
       $user = DB::table('user_info')->where('name', $request->name)->first();
       
    if ($user) {

            $lockedUntil = $user->locked_until ? Carbon::parse($user->locked_until) : null;
            // Check if the account is locked
            if ($user->locked_until && now()->lt($user->locked_until)) {
                $lockoutTime = $lockedUntil->diffForHumans();
                $request->session()->flash('error', "Account is locked. Please try again after {$lockoutTime}.");
               // dd($lockoutTime);
                return redirect()->back()->withInput();
            }
    
        // Verify password
        if (Hash::check($request->password, $user->password)) {

            DB::table('user_info')->where('id', $user->id)->update([
                'failed_attempts' => 0,
                'locked_until' => null,
            ]);

            // Start a session for the user
            $request->session()->put('user_id', $user->id);

          

            if ($user->roles == 'administrator') {
                return redirect()->route('admin.users.index'); 
            } else {
                return redirect()->route('welcomepage'); 
            }

            
        } else {
            // Increment failed attempts
            $failedAttempts = $user->failed_attempts + 1;
            $lockoutTime = 05; 
            $maxAttempts = 3; 

            //dd($failedAttempts);
            if ($failedAttempts >= $maxAttempts) {
                // Lock the account
                DB::table('user_info')->where('id', $user->id)->update([
                    'failed_attempts' => $failedAttempts,
                    'locked_until' => now()->addMinutes($lockoutTime),
                ]);

               // dd();
                $request->session()->flash('error', "Account locked due to multiple failed login attempts. Please try again after {$lockoutTime} minutes.");
            } else {
                // Update the failed attempts count
                DB::table('user_info')->where('id', $user->id)->update([
                    'failed_attempts' => $failedAttempts,
                ]);

                $request->session()->flash('error', 'Invalid password.');
            }
        }
    } else {
        // User not found
        $request->session()->flash('error', 'Invalid email or username.');
    }

    // Redirect back with input and error message
    return redirect()->back()->withInput();
}

   // Handle logout request
   public function logout(Request $request)
   {
       // End the user session
       $request->session()->forget('user_id');
       toastr()->success('Logout successful!');
       return redirect('login');
   }
}