<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;

class RoleController extends Controller
{    
    public function index()
    {
        $role = Role::orderBy('name','asc')
        ->get();

        return view('role/list-role', ['role' => $role]);
    }

    public function addRole(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'string|unique:roles,name',
        ],[
            'name.unique' => 'Role telah didaftarkan sebelumnya.',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors($errors);
        }

        Role::create([
            'name' => $request->name,
        ]);
        
        return redirect()->back()->with("message", "Data berhasil ditambahkan!");
    }

    public function deleteRole($idrole)
    {
        Role::destroy($idrole);

        return redirect()->back()->with("message", "Data berhasil deaktif!");
    }

    public function ubahRole(Request $request)
    {
        $role = Role::orderBy('name','asc')->get();
        $bio = "";

        if ($request != "") {

            $bio = Role::where('id', $request->idrole)->get();
        }
        
        return view('role/ubah-role', ['role' => $role, 'bio' => $bio]);
    }

    public function changeRole(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'unique:roles,name,'.$request->id.',id',
        ],[
            'name.unique' => 'Role telah didaftarkan sebelumnya.',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect('/ubah-role')->withErrors($errors);
        }
        
        $role = Role::find($request->id);

        $role->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with("message", "Data berhasil diupdate!");
    }
}
