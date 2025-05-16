<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function admin_create()
    {
        return view('admin.login');
    }
    public function mahasiswa_create()
    {
        return view('mahasiswa.login');
    }
    public function dosen_create()
    {
        return view('dosen.login');
    }


    public function store()
    {
        $attributes = request()->validate([
            'username'=>'required',
            'password'=>'required' 
        ]);

        if(Auth::attempt($attributes))
        {
            session()->regenerate();
            return redirect('home')->with(['success'=>'You are logged in.']);
        }
        else{

            return back()->withErrors(['username'=>'username or password invalid.']);
        }
    }


    function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ], [
            'username.required' => 'Username can not be empty',
            'password.required' => 'Password can not be empty',
        ]);
    
        // Ambil user berdasarkan username
        $user = DB::table('user')->where('username', $request->username)->first();
    
        if ($user && $user->password === $request->password) { // Cek tanpa hash
            Auth::loginUsingId($user->id_user);
    
            // Redirect berdasarkan level
            switch ($user->level) {
                case 'admin':
                    return redirect('/admin/dashboard');
                case 'mahasiswa':
                    return redirect('/mahasiswa/dashboard');
                case 'dosen':
                    return redirect('/dosen/dashboard');
                case 'guest':
                    return redirect('/guest/home');
                default:
                    return redirect('/home');
            }
        } else {
            return redirect()->back()->withErrors(['username' => 'Username or password incorrect']);
        }
    }
    

    
    public function destroy()
    {

        Auth::logout();

        return redirect('/')->with(['success'=>'You\'ve been logged out.']);
    }
}