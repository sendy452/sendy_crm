@extends('layouts.template')
@section('title', 'List Customer')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>List Customer</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
          <li class="breadcrumb-item">Customer</li>
          <li class="breadcrumb-item active">List Customer</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    @if($errors->any())
        @foreach ($errors->all() as $danger)
              <h6 class="alert alert-danger">{{ $danger }}</h6>
        @endforeach
      @endif
    @if (session('message'))
        <h6 class="alert alert-success">{{ session('message') }}</h6>
    @endif

    <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">List Customer</h5>
  
                <div class="table-responsive">
                  <!-- Default Table -->
                <table class="table table-bordered dataTable">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Layanan</th>
                      <th scope="col">Email</th>
                      <th scope="col">Alamat</th>
                      <th scope="col">Telepon</th>
                      <th scope="col">Terdaftar</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($customer as $no => $data)
                    <tr>
                      <th scope="row">{{$no+1}}</th>
                      <td>{{$data->name}}</td>
                      <td>{{$data->service_name}} - Rp.{{number_format($data->price)}}</td>
                      <td>{{$data->email}}</td>
                      <td>{{$data->address}}</td>
                      <td>{{$data->phone}}</td>
                      <td>{{date('d-m-Y', strtotime($data->created_at))}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <!-- End Default Table Example -->
                </div>
              </div>
            </div>

          </div>
        </div>
      </section>

  </main>