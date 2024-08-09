@extends('layout.app')
@section('title', 'Register Teacher')
@push('styles')

@endpush

@section('content')
<main id="main" class="main">
    <div class="container">
        <div class="pagetitle">
            <h5>Teacher Management</h5>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Register Teacher</li>
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
        <div class="col-md-8 mx-auto">
            <div class="form-container">
                <div class="form-header">
                    Register Teacher
                </div>
                <div class="form-body">
                    <form action="{{ route('register') }}" method="post" class="g-3 row" enctype="multipart/form-data">
                        @csrf
                        <!-- Name -->
                        <div class="col-md-4 my-2">
                            <label for="name" class="form-label">Name*</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control form-control-sm @error('name') is-invalid @enderror" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="col-md-4 my-2">
                            <label for="email" class="form-label">Email*</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control form-control-sm @error('email') is-invalid @enderror" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Phone -->
                        <div class="col-md-4 my-2">
                            <label for="phone" class="form-label">Phone*</label>
                            <input type="text" name="number" id="phone" value="{{ old('number') }}" class="form-control form-control-sm @error('number') is-invalid @enderror" required
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="10">
                            @error('number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Stream -->
                        <div class="col-md-4 my-2">
                            <label for="stream" class="form-label">Stream*</label>
                            <select name="stream_id" id="stream" class="form-select form-select-sm @error('stream_id') is-invalid @enderror" required>
                                <option value="" disabled selected>Choose</option>
                                @foreach($streams as $stream)
                                    <option value="{{ $stream->id }}">{{ $stream->name }}</option>
                                @endforeach
                            </select>
                            @error('stream_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Subject -->
                        <div class="col-md-4 my-2">
                            <label for="subject" class="form-label">Subject*</label>
                            <select multiple name="subject_id[]" size="3" id="subject" class="form-select form-select-sm @error('subject_id') is-invalid @enderror" required>
                                {{-- <option value="" disabled selected>Choose</option> --}}
                            </select>
                            @error('subject_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- CV -->
                        <div class="col-md-4 my-2">
                            <label for="cv" class="form-label">CV*</label>
                            <input type="file" name="cv" id="cv" class="form-control form-control-sm @error('cv') is-invalid @enderror" accept=".pdf,image/*" required>
                            @error('cv')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>  

                        <!-- Image -->
                        <div class="col-md-4">
                            <label for="image" class="form-label pt-2">Upload Image</label>
                            <input type="file" name="image" id="image" class="form-control form-control-sm @error('image') is-invalid @enderror" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror 
                        </div>

                        <!-- Password -->
                        <div class="col-md-4">
                            <label for="password" class="form-label">Password*</label>
                            <input type="password" name="password" id="password" class="form-control form-control-sm @error('password') is-invalid @enderror" required minlength="8">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="col-md-4">
                            <label for="confirmPassword" class="form-label">Confirm Password*</label>
                            <input type="password" name="password_confirmation" id="confirmPassword" class="form-control form-control-sm @error('password_confirmation') is-invalid @enderror" required minlength="8">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 text-center mt-4 mb-2">
                            <button type="submit" class="btn btn-primary px-4">Register Teacher</button>
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
    $(document).ready(function() {
        $('#stream').change(function() {
            var streamId = $(this).val();
            if (streamId) {
                $.ajax({
                    url: "{{ route('subjects.byStream', '') }}/" + streamId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // $('#subject').empty().append('<option value="" disabled selected>Choose</option>');
                        $('#subject').empty();
                        $.each(data, function(key, value) {
                            $('#subject').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                    error: function() {
                        $('#subject').empty().append('<option value="" disabled selected>Choose</option>');
                    }
                });
            } else {
                $('#subject').empty().append('<option value="" disabled selected>Choose</option>');
            }
        });
    });
</script>
@endpush
