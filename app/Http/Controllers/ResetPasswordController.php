<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function showResetForm()
    {
        return view('reset');

    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:user_info,email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        try {
            // Find the user by email
            $user = DB::table('user_info')->where('email', $request->email)->first();
    
            if ($user) {
                // Update the user's password
                DB::table('user_info')
                    ->where('email', $request->email)
                    ->update([
                        'password' => Hash::make($request->password),
                        'updated_at' => now(),
                    ]);
    
                return redirect()->route('login')->with('success', 'Password has been updated successfully.');
            } else {
                return redirect()->back()->with('error', 'User with the specified email does not exist.');
            }
        } catch (\Exception $e) {
            // Handle any errors that occur during the process
            return redirect()->back()->with('error', 'An error occurred while updating the password.');
        }    

    
    
    }
}