@extends('layout.app')
@section('title', 'Edit Subject')
@push('styles')

@endpush

@section('content')
<main id="main" class="main">
    <div class="container">
        <div class="pagetitle">
            <h5>Subject Management</h5>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Edit Subject</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
    </div>

    <div class="flash-msg">
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div><!-- flash-msg -->

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- FORM -->
    <div class="row mt-5">
        <div class="col-md-5 mx-auto">
            <div class="form-container">
                <div class="form-header">
                    Create Subject
                </div>
                <div class="form-body">
                    <form action="{{route('subject.update',$subject->id)}}" method="post" class="g-3 row" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="col-md-12">
                            <label for="stream" class="stream">Select Stream</label>
                            <select name="stream" id="stream" class="form-select form-select-sm @error('stream') is-invalid @enderror" required>
                                <option value="">Select</option>
                                @foreach($streams as $stream)
                                    <option value="{{ $stream->id }}" {{$subject->stream && $subject->stream->id == $stream->id ? 'selected' : ''}}>{{ $stream->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label for="stream" class="stream">Subject</label>
                            <input type="text" name="name" id="name" value="{{$subject->name}}" class="form-control form-control-sm @error('name') is-invalid @enderror" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 text-center mt-4 mb-2">
                            <button type="submit" class="btn btn-primary px-4">Update Stream</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

</script>
@endpush
