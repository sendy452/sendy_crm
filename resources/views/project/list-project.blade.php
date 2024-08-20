@extends('layouts.template')
@section('title', 'List Project')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>List Project</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
          <li class="breadcrumb-item">Project</li>
          <li class="breadcrumb-item active">List Project</li>
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

    <h6 id="alert-ajax"></h6>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tambah Project</h5>

              <!-- General Form Elements -->
              <form id="project_form" method="POST">
                @csrf

                <div class="row mb-3">
                  <label for="inputLead" class="col-sm-2 col-form-label">Lead</label>
                  <div class="col-sm-10">
                  <select class="form-select" name="customer_id" required>
                      @foreach($customer as $data)
                      <option value="{{$data->id}}">{{$data->name}}</option>
                      @endforeach
                  </select>     
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputService" class="col-sm-2 col-form-label">Service</label>
                  <div class="col-sm-10">
                  <select class="form-select" name="service_id" required>
                      @foreach($service as $data)
                      <option value="{{$data->id}}">{{$data->name}} - Rp.{{number_format($data->price)}}</option>
                      @endforeach
                  </select>     
                  </div>
                </div>

                <div class="row mb-3 text-end">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary" id="project_form_btn">Tambah Project</button>
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
                <h5 class="card-title">List Project</h5>
  
                <div class="table-responsive">
                  <!-- Default Table -->
                <table class="table table-bordered dataTable">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Lead</th>
                      <th scope="col">Service</th>
                      <th scope="col">Harga</th>
                      <th scope="col">Disetujui Oleh</th>
                      <th scope="col">Disetujui Pada</th>
                      <th scope="col">Status</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($project as $no => $data)
                    <tr>
                      <th scope="row">{{$no+1}}</th>
                      <td>{{$data->name}}</td>
                      <td>{{$data->service_name}}</td>
                      <td>Rp.{{number_format($data->price)}}</td>
                      <td>{{$data->approved_by}}</td>
                      <td>{{$data->approved_at ? date('d-m-Y H:i:s', strtotime($data->approved_at)):""}}</td>
                      <td>{{$data->is_approve ? "Approve":"Not Approve"}}</td>
                      <td>
                        @if (!$data->is_approve && auth()->user()->role_id < 3) 
                          <a href="{{url('approve-project').'/'.$data->id}}" class="btn {{'btn-success'}}" type="button"><i class="bi bi-check"></i></a>
                        @endif
                        <a 
                          href="{{url('delete-project').'/'.$data->id}}" 
                          class="btn {{'btn-danger'}}" 
                          onclick="return confirm('Are you sure you want to delete this data?')" 
                          type="button">
                          <i class="bi bi-trash"></i>
                        </a>
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
@endsection

@section('script')
<script>
  $(document).ready(function() {    
    $("#project_form_btn").click(function(e) {
      e.preventDefault();
      let form = $('#project_form')[0];
      let data = new FormData(form);

      $.ajax({
        url: "{{ route('add.project') }}",
        type: "POST",
        data: data,
        processData: false,
        contentType: false,
        success: function(response) {
          let successMessage = response.message;
          $('.alert').remove();
          $('#alert-ajax').prepend('<div class="alert alert-success">' + successMessage + '</div>');

          setTimeout(function() {
            window.location.reload();
          }, 500);
        },
        error: function(xhr) {
          $('.alert').remove();
          let errors = xhr.responseJSON.message;
          let errorHtml = '<div class="alert alert-danger">';
          $.each(errors, function(index, error) {
              errorHtml += '- ' + error;
          });
          errorHtml += '</div>';
          $('#alert-ajax').prepend(errorHtml);
        }
      });
    });
  });
</script>
@endsection