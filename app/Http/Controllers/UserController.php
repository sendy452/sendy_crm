<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('login');
    }  
       
 
    public function signin(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $data = User::where('email',$email)
            ->where('users.is_active', true)
            ->first();
        if($data){ 
            if(Hash::check($password, $data->password)){
                Auth::loginUsingId($data->id);
                Session::put('id',$data->id);
                Session::put('name',$data->name);
                Session::put('email',$data->email);
                Session::put('login',TRUE);
                return redirect('/');
            } else{
                return redirect('signin')->with('message','Email atau Password salah!');
            }
        }
        else{
            return redirect('signin')->with('message','Email tidak ditemukan!');
        }
    } 
 
    public function signout() {
        Session::flush();
        Auth::logout();

        return redirect('signin');
    }
}
