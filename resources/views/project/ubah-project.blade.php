@extends('layouts.template')
@section('title', 'Ubah Project')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Ubah Project</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
          <li class="breadcrumb-item">Project</li>
          <li class="breadcrumb-item active">Ubah Project</li>
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
              <h5 class="card-title">Cari Project</h5>

              <!-- General Form Elements -->
              <form method="post" action="{{ url('ubah-project') }}">
                @csrf
                @method("GET")

                <div class="row mb-3">
                    <label for="Jenis Kelamin" class="col-md-4 col-lg-3 col-form-label">Nama</label>
                    <div class="col-md-8 col-lg-9">
                        <select onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();' class="form-select" name="idproject">
                            <option value=""><h1>-----Pilih Project-----</h1></option>
                            @foreach($project as $data)
                            <option value="{{$data->id}}">{{$data->name}} - {{$data->service_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3 text-end">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Pilih Project</button>
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
                  <h5 class="card-title">Ubah Project</h5>
    
                  <!-- Ubah Project Form -->
                  <form class="row g-3" method="post" action="{{ route('change.project') }}">
                    @csrf
                    @method("PUT")

                    @foreach($bio as $data)
                    <div class="col-md-6">
                      <label for="inputName" class="form-label">Nama</label>
                      <input name="id" type="text" class="form-control" value="{{$data->id}}" hidden>
                      <input name="name" type="text" class="form-control" value="{{$data->name}}" readonly>
                    </div>
                    <div class="col-md-6">
                      <label for="inputService" class="form-label">Service</label>
                      <select class="form-select" name="service_id">
                          @foreach($services as $service)
                          <option value="{{$service->id}}" {{ $service->id == $data->service_id ? "selected" : "" }}>{{$service->name}} - Rp.{{number_format($service->price)}}</option>
                          @endforeach
                      </select>
                    </div>
                    <div>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    @endforeach
                  </form>
                  <!-- End Ubah Project Form -->
    
                </div>
            </div>

          </div>
        </div>
      </section>

  </main>