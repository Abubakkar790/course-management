@extends('layout.guest')
@push('styles')
    <link rel="stylesheet" href="{{asset('#')}}">
@endpush

@section('content')
<div class="login-form-container">
    <div class="login-form">
        <div class="form-head text-center py-2 h4 fw-bold" style="color: #005093;">
            Create User
        </div>
        <div class="form-body py-2">
            <form action="{{ route('register') }}" id="register_form" method="POST"
                enctype="multipart/form-data" class="g-3">
                @csrf
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control form-control-sm"
                    value="{{ old('name') }}" required maxlength="30" autocomplete="off">
                <div id="name-error" class="invalid-feedback"></div>

                <label for="subject" class="form-label">Subject</label>
                <select class="form-select form-select-sm" name="subject" id="subject"
                    aria-label="subject" required>
                    <option disabled selected>Choose..</option>
                    <option value="Chairman" {{ old('subject') == 'Chairman' ? 'selected' : '' }}>
                        Chairman</option>
                    <option value="Vice Chairman"
                        {{ old('subject') == 'Vice Chairman' ? 'selected' : '' }}>Vice Chairman
                    </option>
                    <option value="Director" {{ old('subject') == 'Director' ? 'selected' : '' }}>
                        Director</option>
                    <option value="CEO" {{ old('subject') == 'CEO' ? 'selected' : '' }}>CEO</option>
                    <option value="CFO" {{ old('subject') == 'CFO' ? 'selected' : '' }}>CFO</option>
                    <option value="CPM" {{ old('subject') == 'CPM' ? 'selected' : '' }}>CPM</option>
                    <option value="COO" {{ old('subject') == 'COO' ? 'selected' : '' }}>COO</option>
                </select>

                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control form-control-sm"
                    value="{{ old('phone') }}" autocomplete="off">
                <div id="phone-error" class="invalid-feedback"></div>

                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control form-control-sm"
                    value="{{ old('email') }}" maxlength="30" required autocomplete="off">
                <div id="email-error" class="invalid-feedback"></div>

                <label for="details" class="form-label">Employee Details</label>
                <textarea class="form-control form-control-sm" id="details" name="details" rows="3" required>{{ old('details') }}</textarea>
                <div id="details-error" class="invalid-feedback"></div>

                <label for="image" class="form-label pt-2">Upload Image</label>
                <input type="file" name="image" id="image" class="form-control form-control-sm"
                    accept="image/*">
                <div id="image-error" class="invalid-feedback"></div>

                <div class="text-center mt-4">
                    <button type="button" class="btn btn-primary px-4" id="submit_button">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection

@push('scripts')

@endpush