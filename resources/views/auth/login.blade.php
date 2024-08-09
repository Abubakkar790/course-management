@extends('layout.guest')
@push('styles')
    <link rel="stylesheet" href="{{asset('/css/login.css')}}">
@endpush

@section('content')
<div class="container my-4" id="main">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="login-form-container">
        <div class="login-form">
            <div class="form-head text-center py-3 h3 fs-1 fw-bold" style="color: #005093;">
                Sign in
            </div>
            <div class="form-body py-2">
                <form action="{{ route('login') }}" id="login_form" method="POST" class="g-3">
                @csrf
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" maxlength="50" required autofocus autocomplete="off">
                    <div id="email-error" class="invalid-feedback"></div>

                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" maxlength="25" required>
                    <div id="password-error" class="invalid-feedback"></div>

                    <div class="text-end pt-2">
                        <a href="#" class="text-decoration-none form-link">Forgot password?</a>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary px-4">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')

@endpush