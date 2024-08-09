@extends('layout.app')
@section('title', 'View Subject')
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
                    <li class="breadcrumb-item active">View Subject</li>
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
            <h5 class="card-title">View Subject</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Stream Name</th>
                            <th>Subject Name</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subjects as $subject)
                            <tr>
                                <td class="text-nowrap">{{ $subject->stream ? $subject->stream->name : ''}}</td>
                                <td class="text-nowrap">{{ $subject->name }}</td>
                                <td>
                                    <a href="{{ route('subject.edit', $subject->id) }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ route('subject.destroy', $subject->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="deleteSubject({{ $subject->id }})" class="btn btn-sm btn-danger">
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

</main>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Function to handle stream deletion with confirmation
    function deleteSubject(subjectId) {
        if (confirm('Are you sure you want to delete this stream?')) {
            // Submit the form
            // $('form[action*="stream.delete"][method="post"]').submit();
        }
    }
</script>
@endpush
