@extends('layout.app')
@section('title', 'Dashboard')
@push('styles')
<style>
    .dashboard-tab:hover {
        box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
        transition: all.2s ease-in-out; 
    }
    /* .dashboard-tab i {
        color: white;
    }
    .dashboard-tab .card-content{
        color: white;
    }
    .dashboard-tab .count {
        color: white;
        font-weight: 600; 
        font-size: 2rem; 
        line-height: 1;
    } */
</style>
@endpush

@section('content')
<main id="main" class="main" style="min-height: 83vh;">
    <div class="container">
        <div class="pagetitle">
            <h5>Dashboard</h5>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 p-2">
                <div class="card shadow-sm dashboard-tab" style="border-left: 5px solid blue">
                    <div class="card-body d-flex">
                        <div class="card-icon d-flex align-items-center justify-content-center pe-2" style="border-right: 2px solid lightgray">
                            <div style="font-size: 2.5rem"><i class="bi bi-diagram-3"></i></div>
                        </div>
                        <div class="card-content d-flex align-items-center justify-content-center px-2">
                            <div>
                                <div>Total Stream</div>
                                <div class="count" style="font-weight: 600; font-size: 2rem; color:rgb(1, 1, 46); line-height: 1;">{{$totalStream->count()}}</div>
                                {{-- <div class="count" style="">{{$totalStream->count()}}</div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 p-2">
                <div class="card shadow-sm dashboard-tab" style="border-left: 5px solid blue">
                    <div class="card-body d-flex">
                        <div class="card-icon d-flex align-items-center justify-content-center pe-2" style="border-right: 2px solid lightgray">
                            <div style="font-size: 2.5rem"><i class="bi bi-book"></i></div>
                        </div>
                        <div class="card-content d-flex align-items-center justify-content-center px-2">
                            <div>
                                <div>Total Subject</div>
                                <div class="count" style="font-weight: 600; font-size: 2rem; color:rgb(1, 1, 46); line-height: 1;">{{$totalSubject->count()}}</div>
                                {{-- <div class="count" style="">{{$totalSubject->count()}}</div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 p-2">
                <div class="card shadow-sm dashboard-tab" style="border-left: 5px solid blue">
                    <div class="card-body d-flex">
                        <div class="card-icon d-flex align-items-center justify-content-center pe-2" style="border-right: 2px solid lightgray">
                            <div style="font-size: 2.5rem"><i class="bi bi-person-badge"></i></div>
                        </div>
                        <div class="card-content d-flex align-items-center justify-content-center px-2">
                            <div>
                                <div>Total Teacher</div>
                                <div class="count" style="font-weight: 600; font-size: 2rem; color:rgb(1, 1, 46); line-height: 1;">{{$totalTeacher->count()}}</div>
                                {{-- <div class="count" style="">{{$totalTeacher->count()}}</div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>
@endsection

@push('scripts')

@endpush