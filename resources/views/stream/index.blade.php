@extends('layout.app')
@section('title', 'View Stream')
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
                    <li class="breadcrumb-item active">View Stream</li>
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
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">View Stream</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Stream Name</th>
                            <th>Image</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($streams as $stream)
                            <tr>
                                <td class="text-nowrap">{{ $stream->name }}</td>
                                <td>
                                    <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage('{{ asset($stream->image) }}')">
                                        <img src="{{ asset($stream->image) }}" alt="Stream Image" width="50" height="50" class="rounded">
                                    </button>
                                </td>
                                <td>
                                    <a href="{{ route('stream.edit', $stream->id) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('stream.destroy', $stream->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="deleteStream({{ $stream->id }})" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- IMAGE MODAL -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Stream Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="#" alt="Stream Image" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Function to show the image in the modal
    function showImage(imageSrc) {
        $('#modalImage').attr('src', imageSrc);
    }

    // Function to handle stream deletion with confirmation
    function deleteStream(streamId) {
        if (confirm('Are you sure you want to delete this stream?')) {
            // Submit the form
            $('form[action*="stream.delete"][method="post"]').submit();
        }
    }
</script>
@endpush
