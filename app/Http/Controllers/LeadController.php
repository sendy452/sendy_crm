<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use App\Models\Transaction;

class LeadController extends Controller
{    
    public function index()
    {
        $lead = Customer::select(
            'customers.*'
        )
        ->where('is_lead', 1)
        ->orderBy('name','asc')
        ->get();

        return view('lead/list-lead', ['lead' => $lead]);
    }

    public function addLead(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|unique:customers,phone'
        ],[
            'name.required' => 'Nama harap diisi!',
            'address.required' => 'Alamat harap diisi!',
            'email.required' => 'Email harap diisi!',
            'email.email' => 'Format Email salah!',
            'email.unique' => 'Email telah didaftarkan sebelumnya',
            'phone.required' => 'No. Hp harap diisi!',
            'phone.unique' => 'No. Hp telah didaftarkan akun lain',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors($errors);
        }

        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);
        
        return redirect()->back()->with("message", "Data berhasil ditambahkan!");
    }    

    public function deleteLead($idlead)
    {
        $cek_customer = Transaction::where('customer_id', $idlead)->get();

        if (count($cek_customer) > 0) {
            return redirect()->back()->with("danger", "Data tidak dapat dihapus tercatat transaksi!");
        } else {
            Customer::destroy($idlead);
            return redirect()->back()->with("message", "Data berhasil dihapus!");
        }
    }

    public function ubahLead(Request $request)
    {
        $lead = Customer::orderBy('name','asc')->where('is_lead', 1)->get();
        $bio = "";

        if ($request != "") {

            $bio = Customer::where('id', $request->idlead)->get();
        }
        
        return view('lead/ubah-lead', ['lead' => $lead,'bio' => $bio]);
    }

    public function changeLead(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:customers,email,'.$request->id.',id',
            'phone' => 'required|unique:customers,phone,'.$request->id.',id'
        ],[
            'name.required' => 'Nama harap diisi!',
            'address.required' => 'Alamat harap diisi!',
            'email.required' => 'Email harap diisi!',
            'email.email' => 'Format Email salah!',
            'email.unique' => 'Email telah didaftarkan akun lain',
            'phone.required' => 'No. Hp harap diisi!',
            'phone.unique' => 'No. Hp telah didaftarkan akun lain',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect('/ubah-lead')->withErrors($errors);
        }
        
        $lead = Customer::find($request->id);

        $lead->update([
            'email' => $request->email,
            'nama' => $request->nama,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->back()->with("message", "Data berhasil diupdate!");
    }
}
