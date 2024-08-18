@extends('layouts.template')
@section('title', 'Dashboard')
@section('content')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Columns -->
      <div class="col-lg-12">
        <div class="row">

          <!-- Lead Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Total Lead</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-2">
                    <h6>{{$lead ?? 0}}</h6>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- End Lead Card -->

          <!-- Layanan Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">
              <div class="card-body">
                <h5 class="card-title">Total Layanan</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-clipboard-check"></i>
                  </div>
                  <div class="ps-2">
                    <h6>{{ $layanan ?? 0}}</h6>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- End Layanan Card -->

          <!-- Customer Card -->
          <div class="col-xxl-4 col-xl-12">

            <div class="card info-card customers-card">
              <div class="card-body">
                <h5 class="card-title">Total Customer</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-2">
                    <h6>{{$customer ?? 0}}</h6>
                  </div>
                </div>

              </div>
            </div>

          </div>
          <!-- End Customer Card -->

          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Total Karyawan Tiap Bulan {{date('Y')}}</h5>

                <!-- Line Chart -->
                <canvas id="lineChart" style="max-height: 400px;"></canvas>
                <script>
                  const labels = {!! json_encode($labels) !!};
                  const datas = {!! json_encode($datas) !!};
                  document.addEventListener("DOMContentLoaded", () => {
                    new Chart(document.querySelector('#lineChart'), {
                      type: 'line',
                      data: {
                        labels: labels,
                        datasets: [{
                          label: 'Total Karyawan',
                          data: datas,
                          fill: false,
                          borderColor: 'rgb(75, 192, 192)',
                          tension: 0.1
                        }]
                      },
                      options: {
                        scales: {
                          y: {
                            beginAtZero: true
                          }
                        }
                      }
                    });
                  });
                </script>
                <!-- End Line CHart -->

              </div>
            </div>
          </div>

          <!-- Recent Karyawan -->
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Data Karyawan Terakhir Ditambahkan</h5>
                <div class="table-responsive">
                <table class="table table-borderless">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Email</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Divisi</th>
                      <th scope="col">Tanggal Kerja</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($karyawan as $i => $data)
                    <tr>
                      <th scope="row">{{$i+1}}</th>
                      <td>{{$data->email}}</td>
                      <td>{{$data->name}}</td>
                      <td>{{$data->role_name}}</td>
                      <td>{{date('d-m-Y', strtotime($data->dibuat))}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                </div>
              </div>

            </div>
          </div>
          <!-- End Recent Karyawan -->

        </div>
      </div>
      <!-- End Columns -->
    </div>
  </section>

</main>