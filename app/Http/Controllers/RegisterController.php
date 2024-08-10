<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    
    public function register(Request $request)
    {
        // Validate the request data
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:user_info,name',
          'email' => 'required|email|max:255|unique:user_info,email',
            'password' => 'required|string|min:8',
            'role'=> 'required'
        ]);
 
        
        DB::beginTransaction();

        try {
            // Insert new user into the database
            $userId = DB::table('user_info')->insertGetId([
                'name' => $request->name,
                'email' => $request->email,
                'roles'=>$request->role,
                'password' => Hash::make($request->password),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            
            $request->session()->put('user_id', $userId);

            
            DB::commit();

           
            $request->session()->flash('success', 'Registration successful!');
            return redirect('/');

        } catch (\Exception $ex) {
           
            DB::rollBack();

            
            \Log::error('Registration Error: '.$ex->getMessage());

            
            $request->session()->flash('error', 'An error occurred. Please try again.');
            return redirect()->back()->withInput();
        }
   
 
        // Start a session for the new user
        $request->session()->put('user_id', $userId);
 
        // toastr()->success('Registration successful!');
        return redirect('/');
    }
}
