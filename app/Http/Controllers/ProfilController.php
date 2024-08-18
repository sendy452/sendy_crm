<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = User::leftJoin('roles', 'roles.id', 'users.role_id')
        ->select('users.*', 'roles.name as role_name')
        ->where('users.id',Session::get('id'))
        ->get();

        return view('profil', ['profil' => $profil]);
    } 

    public function profileChange(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'email' => 'email|unique:users,email,'.Session::get('id').',id',
        ],[
            'email.unique' => 'Email telah didaftarkan akun lain.',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors($errors);
        }
        
        $user = User::find(Session::get('id'));

        $user->update([
            'email' => $request->email,
            'name' => $request->name,
        ]);

        return redirect()->back()->with("message", "Data berhasil diupdate!");
    }

    public function passChange(Request $request)
    {
        $request->validate([
            'password' => 'string',
            'newpassword' => 'string'
        ]);

        $user = User::find(Session::get('id'));

        if (Hash::check($request->password, $user->password)) {
            $user->update([
                "password" => Hash::make($request->newpassword),
            ]);

            return redirect()->back()->with(["message" => "Password berhasil diupdate!"]);
        }else{
            return redirect()->back()->with(["message-danger" => "Password lama tidak sesuai!"]);
        }
    }
}
