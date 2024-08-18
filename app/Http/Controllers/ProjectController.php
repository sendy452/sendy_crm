<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Service;
use App\Models\Transaction;

class ProjectController extends Controller
{    
    public function index()
    {
        $customer = Customer::orderBy('name','asc')
            ->where('is_lead', 1)
            ->get();
        $service = Service::orderBy('name','asc')
            ->get();

        $project = Transaction::select(
            'transactions.id',
            'customers.name',
            'services.name as service_name',
            'services.price',
            'users.name as approved_by',
            'transactions.approved_at',
            'transactions.is_approve'
        )
        ->leftJoin('customers', 'customers.id', 'transactions.customer_id')
        ->leftJoin('services', 'services.id', 'transactions.service_id')
        ->leftJoin('users', 'users.id', 'transactions.approved_by')
        ->get();

        return view('project/list-project', ['customer' => $customer, 'service' => $service, 'project' => $project]);
    }

    public function addProject(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'customer_id' => 'string|unique:transactions,customer_id',
        ],[
            'customer_id.unique' => 'Lead telah didaftarkan sebelumnya.',
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors($errors);
        }

        Transaction::create([
            'customer_id' => $request->customer_id,
            'service_id' => $request->service_id,
            'created_by' => auth()->user()->id,
        ]);
        
        return redirect()->back()->with("message", "Data berhasil ditambahkan!");
    }    

    public function deleteProject($idproject)
    {
        $project = Transaction::find($idproject);

        Customer::where('id', $project->customer_id)->update([
            'is_lead' => 1,
        ]);

        $project->delete();

        return redirect()->back()->with("message", "Data berhasil dihapus!");
    }

    
    public function approveProject($idproject)
    {
        $project = Transaction::find($idproject);

        Customer::where('id', $project->customer_id)->update([
            'is_lead' => 0,
        ]);

        $project->update([
            'is_approve' => 1,
            'approved_by' => auth()->user()->id,
            'approved_at' => now(),
        ]);

        return redirect()->back()->with("message", "Data berhasil diapprove!");
    }

    public function ubahProject(Request $request)
    {
        $project = Transaction::select(
            'transactions.id',
            'customers.name',
            'services.name as service_name',
            'services.price',
            'users.name as approved_by',
            'transactions.approved_at',
            'transactions.is_approve'
        )
        ->leftJoin('customers', 'customers.id', 'transactions.customer_id')
        ->leftJoin('services', 'services.id', 'transactions.service_id')
        ->leftJoin('users', 'users.id', 'transactions.approved_by')
        ->get();

        $bio = "";

        if ($request != "") {
            $bio = Transaction::select(
                'transactions.id',
                'customers.name',
                'services.id as service_id',
                'services.name as service_name',
                'services.price',
                'users.name as approved_by',
                'transactions.approved_at',
                'transactions.is_approve'
            )
            ->leftJoin('customers', 'customers.id', 'transactions.customer_id')
            ->leftJoin('services', 'services.id', 'transactions.service_id')
            ->leftJoin('users', 'users.id', 'transactions.approved_by')
            ->where('transactions.id', $request->idproject)->get();

            $services = Service::orderBy('name','asc')
            ->get();
        }
        
        return view('project/ubah-project', ['project' => $project, 'bio' => $bio, 'services' => $services]);
    }

    public function changeProject(Request $request)
    {   
        $transaction = Transaction::find($request->id);

        $transaction->update([
            'service_id' => $request->service_id,
        ]);

        return redirect()->back()->with("message", "Data berhasil diupdate!");
    }
}
