@extends('layout.app')
@section('title', 'Create Stream')
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
                    <li class="breadcrumb-item active">Create Stream</li>
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
                    Create Stream
                </div>
                <div class="form-body">
                    <form action="{{route('stream.store')}}" method="post" class="g-3 row" enctype="multipart/form-data">
                    @csrf

                        <div class="table-responsive">
                            <table class="table table-bordered" id="streamTable">
                                <thead>
                                    <tr>
                                        <th>Stream Name</th>
                                        <th>Stream Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <!-- Name -->
                                        <td>
                                            <input type="text" name="name[]" id="name" class="form-control form-control-sm @error('name') is-invalid @enderror" required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </td>

                                        <!-- Image -->
                                        <td>
                                            <input type="file" name="image[]" id="image" class="form-control form-control-sm @error('image') is-invalid @enderror" required accept="image/jpeg, image/png" onchange="previewImage(this);">
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <img id="imagePreview" src="#" alt="Image Preview" style="display:none;width:100px;height:auto;" />
                                        </td>

                                        <!-- Add Row -->
                                        <td>
                                            <button type="button" onclick="addRow();" class="btn btn-sm btn-success" style="width: 110px;">Add Row</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-12 text-center mt-4 mb-2">
                            <button type="submit" class="btn btn-primary px-4">Create Stream</button>
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
    // Function to add a new row in the table
    function addRow() {
        const newRow = `<tr>
                            <td>
                                <input type="text" name="name[]" id="name" value="" class="form-control form-control-sm" required>
                            </td>
                            <td>
                                <input type="file" name="image[]" id="image" class="form-control form-control-sm" required accept="image/jpeg, image/png" onchange="previewImage(this);">
                                <img id="imagePreview" src="#" alt="Image Preview" style="display:none;width:100px;height:auto;" />
                            </td>
                            <td>
                                <button type="button" onclick="removeRow(this);" class="btn btn-sm btn-danger" style="width: 110px;">Remove Row</button>
                            </td>
                        </tr>`;
        $('#streamTable tbody').append(newRow);
    }

    // Function to remove a row from the table
    function removeRow(button) {
        $(button).closest('tr').remove();
    }

    // Function to preview the image before uploading
    // function previewImage(input) {
    //     const file = input.files[0];
    //     const preview = $(input).siblings('img');
    //     if (file) {
    //         const reader = new FileReader();
    //         reader.onload = function(e) {
    //             preview.attr('src', e.target.result);
    //             preview.show();
    //         };
    //         reader.readAsDataURL(file);
    //     } else {
    //         preview.hide();
    //     }
    // }
</script>
@endpush
