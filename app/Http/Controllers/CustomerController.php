<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use App\Models\Transaction;

class CustomerController extends Controller
{    
    public function index()
    {
        $customer = Transaction::select(
            'customers.*',
            'services.name as service_name',
            'services.price',
            'users.name as approved_by',
            'transactions.approved_at',
            'transactions.is_approve'
        )
        ->leftJoin('customers', 'customers.id', 'transactions.customer_id')
        ->leftJoin('services', 'services.id', 'transactions.service_id')
        ->leftJoin('users', 'users.id', 'transactions.approved_by')
        ->where('customers.is_lead', 0)
        ->orderBy('customers.name','asc')
        ->get();

        return view('customer/list-customer', ['customer' => $customer]);
    }

    public function ubahCustomer(Request $request)
    {
        $customer = Customer::orderBy('name','asc')->where('is_lead', 0)->get();
        $bio = "";

        if ($request != "") {

            $bio = Customer::where('id', $request->idcustomer)->get();
        }
        
        return view('customer/ubah-customer', ['customer' => $customer,'bio' => $bio]);
    }

    public function changeCustomer(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'email' => 'unique:customers,email,'.$request->id.',id',
            'phone' => 'unique:customers,phone,'.$request->id.',id'
        ],[
            'email.unique' => 'Email telah didaftarkan akun lain.',
            'phone.unique' => 'No. Hp telah didaftarkan akun lain.',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect('/ubah-customer')->withErrors($errors);
        }
        
        $customer = Customer::find($request->id);

        $customer->update([
            'email' => $request->email,
            'nama' => $request->nama,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->back()->with("message", "Data berhasil diupdate!");
    }
}
