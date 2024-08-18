<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;
use App\Models\User;

class KaryawanController extends Controller
{    
    public function index()
    {
        $karyawan = User::select(
            'users.*',
            'roles.name as role_name'
        )
        ->leftJoin('roles', 'roles.id', 'users.role_id')
        ->orderBy('name','asc')
        ->get();

        $roles = Role::get();

        return view('karyawan/list-karyawan', ['karyawan' => $karyawan, 'roles' => $roles]);
    }

    public function addKaryawan(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'email' => 'email|unique:users,email',
        ],[
            'email.unique' => 'Email telah didaftarkan sebelumnya.',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors($errors);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => $request->role_id,
        ]);
        
        return redirect()->back()->with("message", "Data berhasil ditambahkan!");
    }    

    public function deleteKaryawan($idkaryawan)
    {
        $karyawan = User::find($idkaryawan);

        $karyawan->update([
            'is_active' => false
        ]);

        return redirect()->back()->with("message", "Data berhasil deaktif!");
    }

    public function approveKaryawan($idkaryawan)
    {
        $karyawan = User::find($idkaryawan);

        $karyawan->update([
            'is_active' => true
        ]);

        return redirect()->back()->with("message", "Data berhasil aktif!");
    }

    public function ubahKaryawan(Request $request)
    {
        $karyawan = User::orderBy('name','asc')->get();
        $bio = "";

        if ($request != "") {

            $bio = User::where('id', $request->idkaryawan)->get();
            $roles = Role::get();
        }
        
        return view('karyawan/ubah-karyawan', ['karyawan' => $karyawan, 'bio' => $bio, 'roles' => $roles]);
    }

    public function changeKaryawan(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'email' => 'unique:users,email,'.$request->id.',id',
        ],[
            'email.unique' => 'Email telah didaftarkan akun lain.',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect('/ubah-karyawan')->withErrors($errors);
        }
        
        $karyawan = User::find($request->id);

        $karyawan->update([
            'email' => $request->email,
            'nama' => $request->nama,
            'role_id' => $request->role_id,
        ]);

        if ($request->password != null) {
            $karyawan->update([
                'password' => $request->password,
            ]);
        }

        return redirect()->back()->with("message", "Data berhasil diupdate!");
    }
}
