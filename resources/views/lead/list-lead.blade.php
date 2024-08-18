@extends('layouts.template')
@section('title', 'List Lead')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>List Lead</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
          <li class="breadcrumb-item">Lead</li>
          <li class="breadcrumb-item active">List Lead</li>
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
              <h5 class="card-title">Tambah Lead</h5>

              <!-- General Form Elements -->
              <form method="post" action="{{ route('add.lead') }}">
                @csrf

                <div class="row mb-3">
                  <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="address" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputTelepon" class="col-sm-2 col-form-label">Telepon</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" name="phone" required>
                  </div>
                </div>

                <div class="row mb-3 text-end">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Tambah Lead</button>
                  </div>
                </div>

              </form>
              <!-- End General Form Elements -->

            </div>
          </div>

        </div>
      </div>
    </section>
    <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">List Lead</h5>
  
                <div class="table-responsive">
                  <!-- Default Table -->
                <table class="table table-bordered dataTable">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Email</th>
                      <th scope="col">Alamat</th>
                      <th scope="col">Telepon</th>
                      <th scope="col">Terdaftar</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($lead as $no => $data)
                    <tr>
                      <th scope="row">{{$no+1}}</th>
                      <td>{{$data->name}}</td>
                      <td>{{$data->email}}</td>
                      <td>{{$data->address}}</td>
                      <td>{{$data->phone}}</td>
                      <td>{{date('d-m-Y', strtotime($data->created_at))}}</td>
                      <td><a href="{{url('delete-lead').'/'.$data->id}}" class="btn {{'btn-danger'}}" type="button"><i class="bi bi-trash"></i></a></td>
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