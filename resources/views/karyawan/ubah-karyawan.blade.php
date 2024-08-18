@extends('layouts.template')
@section('title', 'Ubah Karyawan')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Ubah Data Karyawan</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
          <li class="breadcrumb-item">Data Karyawan</li>
          <li class="breadcrumb-item active">Ubah Data Karyawan</li>
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
              <h5 class="card-title">Cari Data Karyawan</h5>

              <!-- General Form Elements -->
              <form method="post" action="{{ url('ubah-karyawan') }}">
                @csrf
                @method("GET")

                <div class="row mb-3">
                    <label for="Jenis Kelamin" class="col-md-4 col-lg-3 col-form-label">Nama</label>
                    <div class="col-md-8 col-lg-9">
                        <select onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();' class="form-select" name="idkaryawan">
                            <option value=""><h1>-----Pilih Karyawan-----</h1></option>
                            @foreach($karyawan as $data)
                            <option value="{{$data->id}}">{{$data->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3 text-end">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Pilih Karyawan</button>
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
                  <h5 class="card-title">Ubah Data Karyawan</h5>
    
                  <!-- Ubah Data Karyawan Form -->
                  <form class="row g-3" method="post" action="{{ route('change.karyawan') }}">
                    @csrf
                    @method("PUT")

                    @foreach($bio as $data)
                    <div class="col-md-12">
                      <label for="inputName" class="form-label">Nama</label>
                      <input name="id" type="text" class="form-control" value="{{$data->id}}" hidden>
                      <input name="name" type="text" class="form-control" value="{{$data->name}}">
                    </div>
                    <div class="col-12">
                      <label for="inputEmail" class="form-label">Email</label>
                      <input name="email" type="email" class="form-control" value="{{$data->email}}" required>
                    </div>
                    <div class="col-md-12">
                      <label for="inputNoHP" class="form-label">Password</label>
                      <input name="password" type="number" class="form-control" value="{{$data->password}}">
                    </div>
                    <div class="col-md-12">
                      <label for="inputRole" class="form-label">Role</label>
                      <select class="form-select" name="role_id">
                          @foreach($roles as $role)
                          <option value="{{$role->id}}" {{ $role->id == $data->role_id ? "selected" : "" }}>{{$role->name}}</option>
                          @endforeach
                      </select>
                    </div>
                    <div>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    @endforeach
                  </form>
                  <!-- End Ubah Data Karyawan Form -->
    
                </div>
            </div>

          </div>
        </div>
      </section>

  </main>