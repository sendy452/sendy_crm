<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Service;
use App\Models\Transaction;

class ServiceController extends Controller
{    
    public function index()
    {
        $service = Service::orderBy('name','asc')
        ->get();

        return view('service/list-service', ['service' => $service]);
    }

    public function addService(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|unique:services,name',
            'price' => 'required',
        ],[
            'name.required' => 'Nama Service harap diisi!',
            'name.unique' => 'Service telah didaftarkan sebelumnya',
            'price.required' => 'Harga harap diisi!',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors($errors);
        }

        Service::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);
        
        return redirect()->back()->with("message", "Data berhasil ditambahkan!");
    }    

    public function deleteService($idservice)
    {
        $cek_service = Transaction::where('service_id', $idservice)->get();

        if (count($cek_service) > 0) {
            return redirect()->back()->with("danger", "Data tidak dapat dihapus tercatat transaksi!");
        } else {
            Service::destroy($idservice);
            return redirect()->back()->with("message", "Data berhasil dihapus!");
        }
    }

    public function ubahService(Request $request)
    {
        $service = Service::orderBy('name','asc')->get();
        $bio = "";

        if ($request != "") {
            $bio = Service::where('id', $request->idservice)->get();
        }
        
        return view('service/ubah-service', ['service' => $service,'bio' => $bio]);
    }

    public function changeService(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|unique:services,name,'.$request->id.',id',
            'price' => 'required',
        ],[
            'name.required' => 'Nama Service harap diisi!',
            'name.unique' => 'Service telah didaftarkan sebelumnya',
            'price.required' => 'Harga harap diisi!',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect('/ubah-service')->withErrors($errors);
        }
        
        $service = Service::find($request->id);

        $service->update([
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->back()->with("message", "Data berhasil diupdate!");
    }
}
