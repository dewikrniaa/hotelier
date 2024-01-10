@extends('layouts.app-master')
@section('content')
@auth
<!-- Transactions -->
<div class="container-fluid">
<div class="row">
  <div class="col-sm-3">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <div class="avatar">
          <div class="avatar-initial bg-primary rounded-circle shadow-sm">
            <i class="mdi mdi-wallet-travel mdi-24px"></i>
          </div>
        </div>
        <div class="dropdown">
          <button class="btn p-0" type="button" id="newProjectID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="newProjectID">
            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
            <a class="dropdown-item" href="javascript:void(0);">Share</a>
            <a class="dropdown-item" href="javascript:void(0);">Update</a>
          </div>
        </div>
      </div>
      <div class="card-body mt-mg-1">
        <h6 class="mb-2">Total Kamar</h6>
        <div class="d-flex flex-wrap align-items-center mb-2 pb-1">
          <h4 class="mb-0 me-2">{{$totalkamar}}</h4>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <div class="avatar">
          <div class="avatar-initial bg-success rounded-circle shadow-sm">
            <i class="mdi mdi-calendar-check-outline mdi-24px"></i>
          </div>
        </div>
        <div class="dropdown">
          <button class="btn p-0" type="button" id="newProjectID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="newProjectID">
            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
            <a class="dropdown-item" href="javascript:void(0);">Share</a>
            <a class="dropdown-item" href="javascript:void(0);">Update</a>
          </div>
        </div>
      </div>
      <div class="card-body mt-mg-1">
        <h6 class="mb-2">Kamar Tersedia</h6>
        <div class="d-flex flex-wrap align-items-center mb-2 pb-1">
          <h4 class="mb-0 me-2">{{$totalkamartersedia}}</h4>
        </div>
        
      </div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <div class="avatar">
          <div class="avatar-initial bg-danger rounded-circle shadow-sm">
            <i class="mdi mdi-close-network-outline mdi-24px"></i>
          </div>
        </div>
        <div class="dropdown">
          <button class="btn p-0" type="button" id="newProjectID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="newProjectID">
            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
            <a class="dropdown-item" href="javascript:void(0);">Share</a>
            <a class="dropdown-item" href="javascript:void(0);">Update</a>
          </div>
        </div>
      </div>
      <div class="card-body mt-mg-1">
        <h6 class="mb-2">Kamar Kotor</h6>
        <div class="d-flex flex-wrap align-items-center mb-2 pb-1">
          <h4 class="mb-0 me-2">{{$totalkamarkotor}}</h4>
        </div>
        
      </div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between">
        <div class="avatar">
          <div class="avatar-initial bg-warning rounded-circle shadow-sm">
            <i class="mdi mdi-cash mdi-24px"></i>
          </div>
        </div>
        <div class="dropdown">
          <button class="btn p-0" type="button" id="newProjectID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          </button>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="newProjectID">
            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
            <a class="dropdown-item" href="javascript:void(0);">Share</a>
            <a class="dropdown-item" href="javascript:void(0);">Update</a>
          </div>
        </div>
      </div>
      <div class="card-body mt-mg-1">
        <h6 class="mb-2">Total Pendapatan</h6>
        <div class="d-flex flex-wrap align-items-center mb-2 pb-1">
          <h4 class="mb-0 me-2">RP. {{$total_pendapatan}}</h4>
        </div>
      </div>
    </div>
</div>
</div>

<!--/ Transactions -->
@endauth
@endsection