<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register()
    {
        $data['title'] = 'Register';
        return view('user/register', $data);
    }

    public function register_action(Request $request)
    {
        $request->validate([
            'name' => 'required' ,
            'username' => 'required|unique:tb_user' ,
            'email' => 'required', // Validasi untuk bidang "kelas"
            'password' => 'required' ,
            'password_confirmation' => 'required|same:password' ,
        ]);
       $user = new User([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->username),
        ]);
        
        $user->save();
        return redirect()->route('login')->with('success','Registration Succes.Please Login!');
    }

    public function login(Request $request)
    {
        $data['title'] = 'Login';    
        return view('user/login', $data);
    }
}
