<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Service;
use Session;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        if(!Session::get('login')){
            return redirect('signin');
        }
        else{
            $lead = Customer::where('is_lead', 1)->count();
            $layanan = Service::count();
            $customer = Customer::where('is_lead', 0)->count();
            $karyawan = User::select('users.created_at as dibuat', 'users.*', 'roles.name as role_name')
                ->leftJoin('roles', 'roles.id', 'users.role_id')
                ->orderBy('users.created_at', 'desc')
                ->where('is_active', 1)
                ->limit(5)->get();
            $labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

            $datas = [];
            foreach ($labels as $value) {
                $datas[] = User::where(\DB::raw("TRIM(TO_CHAR(created_at, 'Month'))"),$value)->where(\DB::raw("TO_CHAR(created_at, 'YYYY')"), date('Y'))->where('is_active', 1)->count();
            }

            return view('home',['karyawan' => $karyawan, 'lead' => $lead, 'layanan' => $layanan, 'customer' => $customer])->with('labels', $labels)->with('datas', $datas);
        }
    }
}
