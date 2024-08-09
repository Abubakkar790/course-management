@extends('layout.app')
@section('title', 'View Teacher')
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
                    <li class="breadcrumb-item active">View Teacher</li>
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

    <!-- TEACHER TABLE -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">View Teacher</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Teacher Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Stream</th>
                            <th>Subjects</th>
                            <th>Image</th>
                            <th>CV</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teachers as $teacher)
                            <tr>
                                <td class="text-nowrap">{{ $teacher->name }}</td>
                                <td class="text-nowrap">{{ $teacher->email }}</td>
                                <td class="text-nowrap">{{ $teacher->number }}</td>
                                <td class="text-nowrap">{{ $teacher->stream ? $teacher->stream->name:'' }}</td>
                                <td class="text-nowrap">
                                    @if ($teacher->subjects)
                                        @foreach($teacher->subjects as $subject)
                                        <span class="badge bg-secondary">{{ $subject->name }}</span>
                                    @endforeach
                                    @endif
                                </td>
                                <td class="text-nowrap">
                                    @if($teacher->image)
                                        <button type="button" class="btn btn-sm btn-info" onclick="showImage('{{ asset($teacher->image) }}')">
                                            <i class="bi bi-eye"></i> View Image
                                        </button>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="text-nowrap">
                                    @if($teacher->cv)
                                        <a href="{{ asset($teacher->cv) }}" target="_blank" class="btn btn-sm btn-info">
                                            <i class="bi bi-file-earmark-pdf"></i> View CV
                                        </a>
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td class="text-nowrap">
                                    <a href="{{ route('teacher.edit', $teacher->id) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                </td>
                                <td class="text-nowrap">
                                    <form action="{{ route('teacher.destroy', $teacher->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this teacher?')" class="btn btn-sm btn-danger">
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
                    <h5 class="modal-title" id="imageModalLabel">Teacher Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="#" alt="Teacher Image" class="img-fluid rounded">
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
        $('#imageModal').modal('show');
    }
</script>
@endpush
