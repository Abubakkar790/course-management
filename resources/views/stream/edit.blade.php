@extends('layout.app')
@section('title', 'Edit Stream')
@push('styles')

@endpush

@section('content')
<main id="main" class="main">
    <div class="container">
        <div class="pagetitle">
            <h5>Stream Management</h5>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Edit Stream</li>
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

    <!-- FORM -->
    <div class="row mt-5">
        <div class="col-md-8 mx-auto">
            <div class="form-container">
                <div class="form-header">
                    Edit Stream
                </div>
                <div class="form-body">
                    <form action="{{ route('stream.update', $stream->id) }}" method="post" class="g-3 row" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- or PATCH -->

                        <div class="col-md-6">
                            <label for="name" class="form-label">Stream Name</label>
                            <input type="text" name="name" id="name" value="{{ $stream->name }}" class="form-control form-control-sm @error('name') is-invalid @enderror" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" name="image" id="image" class="form-control form-control-sm @error('image') is-invalid @enderror" accept="image/jpeg, image/png" onchange="previewImage(this);">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <img id="imagePreview" src="{{ asset($stream->image) }}" alt="Current Image" style="display:block;width:100px;height:auto;margin-top:10px;" />
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
    // Function to preview the image before uploading
    function previewImage(input) {
        const file = input.files[0];
        const preview = $('#imagePreview');
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.attr('src', e.target.result);
                preview.show();
            };
            reader.readAsDataURL(file);
        } else {
            preview.attr('src', '{{ asset($stream->image) }}'); // Set back to original image if no new image is selected
        }
    }
</script>
@endpush
