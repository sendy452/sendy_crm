@extends('layouts.template')
@section('title', 'List Karyawan')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>List Data Karyawan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
          <li class="breadcrumb-item">Data Karyawan</li>
          <li class="breadcrumb-item active">List Data Karyawan</li>
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

    @if (auth()->user()->role_id == 1)
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambah Data Karyawan</h5>

              <!-- General Form Elements -->
              <form method="post" action="{{ route('add.karyawan') }}">
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
                  <label for="inpuPassword" class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control" name="password" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputRole" class="col-sm-2 col-form-label">Role</label>
                  <div class="col-sm-10">
                  <select class="form-select" name="role_id">
                      @foreach($roles as $data)
                      <option value="{{$data->id}}">{{$data->name}}</option>
                      @endforeach
                  </select>     
                  </div>
                </div>

                <div class="row mb-3 text-end">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Tambah Karyawan</button>
                  </div>
                </div>

              </form>
              <!-- End General Form Elements -->

            </div>
          </div>

        </div>
      </div>
    </section>
    @endif

    <section class="section">
        <div class="row">
          <div class="col-lg-12">
  
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">List Data Karyawan</h5>
  
                <div class="table-responsive">
                  <!-- Default Table -->
                <table class="table table-bordered dataTable">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Email</th>
                      <th scope="col">Role</th>
                      <th scope="col">Terdaftar</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($karyawan as $no => $data)
                    <tr>
                      <th scope="row">{{$no+1}}</th>
                      <td>{{$data->name}}</td>
                      <td>{{$data->email}}</td>
                      <td>{{$data->role_name}}</td>
                      <td>{{date('d-m-Y', strtotime($data->created_at))}}</td>
                      <td>
                        <a style="width:110px" href="{{$data->is_active == 1 ? url('delete-karyawan').'/'.$data->id : url('approve-karyawan').'/'.$data->id}}" class="btn {{$data->is_active == 1 ? 'btn-success':'btn-danger'  }}" type="button">{{$data->is_active == 1 ? 'Aktivasi':'Deaktivasi' }}</a>
                      </td>
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