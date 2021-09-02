<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    //
    public function show()
    {
        return view('auth.login');
    }

     /**
     * Write code on Method
     * 
     * @return response()
     */
    public function handle(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        // $credentials = $request->only('email', 'password');
        // Auth::attempt($credentials)
        if (Auth::check()) {
                return redirect()->intended('blogShow')
                ->withSuccess('You have Successfully logged in'); // member dashboard path   
        }
        return redirect("login")->withSuccess('Sorry! You have entered invalid credentials');
         
        
    }
}
