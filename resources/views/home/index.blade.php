@extends('layouts.app-master')

@section('content')
    @auth

        <!-- Content wrapper -->
        <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
                <div class="row gy-4">

                    <!-- Deposit / Withdraw -->
                    <div class="col-xl-8">
                        <div class="card h-100">
                            <div class="card-body row g-2">
                                <div class="col-12 col-md-6 card-separator pe-0 pe-md-3">
                                    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                                        <h5 class="m-0 me-2">Status Kamar</h5>
                                        <div class="dropdown">
                                            <div class="dropdown-menu dropdown-menu-end"
                                                aria-labelledby="weeklyOverviewDropdown">
                                                <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Update</a>
                                            </div>
                                            <a class="fw-medium" href="javascript:void(0);">Lihat Semua</a>
                                        </div>
                                        <div class="pt-2">
                                            <ul class="p-0 m-0">
                                        </div>
                                        </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Deposit / Withdraw -->

                </div>
            </div>
            <!-- / Content -->


            <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
    @endauth
@endsection
